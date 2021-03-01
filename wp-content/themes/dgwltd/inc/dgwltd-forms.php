<?php
// Error messages

// Include field validation errors
add_filter(
	'gform_validation_message',
	function ( $message, $form ) {
		if ( gf_upgrade()->get_submissions_block() ) {
			return $message;
		}

		$message  = '<div class="govuk-error-summary" aria-labelledby="error-summary-title" role="alert" tabindex="-1" data-module="govuk-error-summary">';
		$message .= '<h2 class="govuk-error-summary__title" id="error-summary-title">There is a problem</h2>';
		$message .= '<div class="govuk-error-summary__body">';
		$message .= '<ul class="govuk-list govuk-error-summary__list">';

		foreach ( $form['fields'] as $field ) {
			if ( $field->failed_validation ) {
				// print_r($field);
				// $message .= sprintf( '<li>%s - %s</li>', GFCommon::get_label( $field ), $field->validation_message );
				$message .= sprintf( '<li><a href="#field_%s_%s">%s</a></li>', $field->formId, $field->id, $field->validation_message );
			}
		}

		$message .= '</ul></div></div>';

		return $message;
	},
	10,
	2
);


// WGAC compliance
// Add autocomplete to fields
// Email
add_filter(
	'gform_field_content',
	function ( $field_content, $field ) {
		if ( $field->type === 'email' ) {
			return str_replace( 'type=', "autocomplete='email' type=", $field_content );
		}
		return $field_content;
	},
	10,
	2
);

// Phone
add_filter(
	'gform_field_content',
	function ( $field_content, $field ) {
		if ( $field->type === 'tel' ) {
			return str_replace( 'type=', "autocomplete='tel' type=", $field_content );
		}
		return $field_content;
	},
	10,
	2
);
