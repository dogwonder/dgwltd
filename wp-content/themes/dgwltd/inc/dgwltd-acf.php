<?php 
/**
 * ACF functionality
 *
 * @package dgwltd
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Site General Settings',
		'menu_title'	=> 'Site Settings',
		'menu_slug' 	=> 'site-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

//ACF Google Maps
if ( ! function_exists( 'dgwltd_acf_google_map_api' ) ) :
function dgwltd_acf_google_map_api( $api ){
    $api['key'] = get_field('google_api_key', 'options');
    return $api;
}
add_filter('acf/fields/google_map/api', 'dgwltd_acf_google_map_api');
endif;