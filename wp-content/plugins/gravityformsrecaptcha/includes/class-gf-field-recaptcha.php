<?php

namespace Gravity_Forms\Gravity_Forms_RECAPTCHA;

use GF_Field;
use GFCommon;
use GFAPI;

/**
 * Class GF_Field_RECAPTCHA
 *
 * @since 1.0
 *
 * @package Gravity_Forms\Gravity_Forms_RECAPTCHA
 */
class GF_Field_RECAPTCHA extends GF_Field {
	/**
	 * Recaptcha field type.
	 *
	 * @since 1.0
	 * @var string
	 */
	public $type = 'recaptcha';

	/**
	 * Decoded field data.
	 *
	 * @since 1.0
	 * @var object
	 */
	private $data;

	/**
	 * Return empty array to prevent the field from showing up in the form editor.
	 *
	 * @since 1.0
	 * @return array
	 */
	public function get_form_editor_button() {
		return array();
	}

	/**
	 * The field markup.
	 *
	 * @since 1.0
	 *
	 * @param array      $form  The form array.
	 * @param string     $value The field value.
	 * @param array|null $entry The entry array.
	 *
	 * @return string
	 */
	public function get_field_input( $form, $value = '', $entry = null ) {
		$plugin_settings = gf_recaptcha()->get_plugin_settings_instance();
		$site_key        = $plugin_settings->get_recaptcha_key( 'site_key_v3' );
		$secret_key      = $plugin_settings->get_recaptcha_key( 'secret_key_v3' );

		if ( empty( $site_key ) || empty( $secret_key ) ) {
			GFCommon::log_error( __METHOD__ . sprintf( '(): reCAPTCHA secret keys not saved in the reCAPTCHA Settings (%s). The reCAPTCHA field will always fail validation during form submission.', admin_url( 'admin.php' ) . '?page=gf_settings&subview=recaptcha' ) );
		}

		$field_id = "input_{$form['id']}_{$this->id}";
		$tabindex = GFCommon::$tab_index > 0 ? GFCommon::$tab_index ++ : 0;

		return "<div id='field-" . esc_attr( $field_id ) . "' class='ginput_container ginput_recaptchav3' data-sitekey='" . esc_attr( $site_key ) . "' data-tabindex='{$tabindex}'>"
		       . '<input id="' . esc_attr( $field_id ) . '" class="gfield_recaptcha_response" type="hidden" name="' . esc_attr( "input_{$this->id}" ) . '" value=""/>'
		       . '</div>';
	}

	/**
	 * Modify the validation result if the Recaptcha response has been altered.
	 *
	 * This is a callback to the gform_validation filter to allow us to validate the values in the hidden field.
	 *
	 * @since 1.0
	 *
	 * @see   GF_RECAPTCHA::init()
	 *
	 * @param array $validation_data The validation data.
	 *
	 * @return bool
	 */
	public function validation_check( $validation_data ) {
		$form   = rgar( $validation_data, 'form' );
		$fields = GFAPI::get_fields_by_type( $form, $this->type );

		// Nothing to validate.
		if ( empty( $fields ) ) {
			return $validation_data;
		}

		return $this->is_valid_field_data( $fields ) ? $validation_data : $this->invalidate( $validation_data );
	}

	/**
	 * Validates that the data in the hidden input is a valid Recaptcha entry.
	 *
	 * @since 1.0
	 *
	 * @param array $fields The Recaptcha fields from the form.
	 *
	 * @return false
	 */
	private function is_valid_field_data( $fields ) {
		// There should only be one Recaptcha field.
		if ( count( $fields ) > 1 ) {
			return false;
		}

		$data = rgpost( "input_{$fields[0]->id}" );

		if ( empty( $data ) ) {
			return false;
		}

		return gf_recaptcha()->get_token_verifier()->verify_submission( $data );
	}

	/**
	 * Set is_valid to false on the validation data.
	 *
	 * @since 1.0
	 *
	 * @param array $validation_data The validation data.
	 *
	 * @return mixed
	 */
	private function invalidate( $validation_data ) {
		$validation_data['is_valid'] = false;

		return $validation_data;
	}
}
