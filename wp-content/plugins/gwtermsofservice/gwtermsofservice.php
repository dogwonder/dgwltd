<?php 
/**
 * Plugin Name: GP Terms of Service
 * Description: Add a "Terms of Service" field to your forms.
 * Plugin URI: https://gravitywiz.com/documentation/gravity-forms-terms-of-service/
 * Version: 1.3.14
 * Author: Gravity Wiz
 * Author URI: http://gravitywiz.com
 * License: GPLv2
 * Text Domain: gp-terms-of-service
 * Domain Path: /languages
 * Perk: True
 */

define( 'GP_TERMS_OF_SERVICE_VERSION', '1.3.14' );

require 'includes/class-gp-bootstrap.php';

$gp_terms_of_service_bootstrap = new GP_Bootstrap( 'class-gp-terms-of-service.php', __FILE__ );