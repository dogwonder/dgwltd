<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin. Based on http://wppb.io // https://github.com/DevinVinson/WordPress-Plugin-Boilerplate
 *
 * @link              https://dgw.ltd
 * @since             1.0.0
 * @package           Dgwltd_Blocks
 *
 * @wordpress-plugin
 * Plugin Name:       dgwltd: Blocks
 * Plugin URI:        http://dgw.ltd
 * Description:       A collection of custom ACF blocks
 * Version:           1.0.1
 * Author:            Dogwonder Ltd
 * Author URI:        http://richholman.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dgwltd-blocks
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DGWLTD_BLOCKS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dgwltd-blocks-activator.php
 */
function activate_dgwltd_blocks() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dgwltd-blocks-activator.php';
	Dgwltd_Blocks_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dgwltd-blocks-deactivator.php
 */
function deactivate_dgwltd_blocks() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dgwltd-blocks-deactivator.php';
	Dgwltd_Blocks_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dgwltd_blocks' );
register_deactivation_hook( __FILE__, 'deactivate_dgwltd_blocks' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dgwltd-blocks.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dgwltd_blocks() {

	$plugin = new Dgwltd_Blocks();
	$plugin->run();

}
run_dgwltd_blocks();
