<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://dgw.ltd
 * @since      1.0.0
 *
 * @package    Dgwltd_Blocks
 * @subpackage Dgwltd_Blocks/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Dgwltd_Blocks
 * @subpackage Dgwltd_Blocks/includes
 * @author     Rich Holman <dogwonder@gmail.com>
 */
class Dgwltd_Blocks_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'dgwltd-blocks',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
