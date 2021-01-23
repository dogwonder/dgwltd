<?php
/**
 * Plugin Name:       dgwltd: Blocks ACF
 * Plugin URI:        https://richholman.com
 * Description:       A collection of ACF blocks for displaying content.
 * Version:           1.0.0
 * License:           GPL version 3 or any later version
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       dgwltd-blocks
 *
 *     This plugin is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     any later version.
 *
 *     This plugin is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *     GNU General Public License for more details.
 */

// Do not load directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// if ( !class_exists( 'dgwltd__Blocks' ) ) {
// 	class dgwltd__Blocks {

// 	}
// 	// Initialize the plugin
// 	$initialisation = new dgwltd__Blocks();
// }

function dgwltd_register_blocks() {
	
	if( ! function_exists( 'acf_register_block_type' ) )
		return;

	acf_register_block_type( array(
		'name'				=> 'dgwltd-hero',
		'title'				=> __( 'DGW.ltd Hero', 'dgwltd' ),
		'description'		=> __( 'Hero block', 'dgwltd' ),
		'render_template'	=> 'blocks/hero.php',
		'mode' 				=> 'preview',
		'category'			=> 'common',
		'icon'				=> 'tide',
		'keywords'			=> array( 'dgwltd' ),
		'supports'			=> [
			'align'				=> false,
			'anchor'			=> true,
			'customClassName'	=> true,
			'jsx' 				=> true,
		]
	));

	acf_register_block_type( array(
		'name'				=> 'dgwltd-embed',
		'title'				=> __( 'DGW.ltd Embed', 'dgwltd' ),
		'description'		=> __( 'Embed block', 'dgwltd' ),
		'render_template'	=> 'blocks/embed.php',
		'mode' 				=> 'edit',
		'category'			=> 'common',
		'icon'				=> 'format-video',
		'keywords'			=> array( 'dgwltd' ),
		'supports'			=> [
			'align'				=> false,
			'anchor'			=> true,
			'customClassName'	=> true,
			'jsx' 				=> true,
		]
	));

	acf_register_block_type( array(
		'name'				=> 'dgwltd-feature',
		'title'				=> __( 'DGW.ltd Feature', 'dgwltd' ),
		'description'		=> __( 'Feature block', 'dgwltd' ),
		'render_template'	=> 'blocks/feature.php',
		'mode' 				=> 'preview',
		'category'			=> 'common',
		'icon'				=> 'cover-image',
		'keywords'			=> array( 'dgwltd' ),
		'supports'			=> [
			'align'				=> false,
			'anchor'			=> true,
			'customClassName'	=> true,
			'jsx' 				=> true,
		]
	));

	acf_register_block_type( array(
		'name'				=> 'dgwltd-cards',
        'title'				=> __( 'DGW.ltd Cards', 'dgwltd' ),
        'description'		=> __( 'Card block for related pages', 'dgwltd' ),
		'render_template'	=> 'blocks/cards.php',
		'mode' 				=> 'preview',
		'category'			=> 'common',
		'icon'				=> 'schedule',
		'keywords'			=> array( 'dgwltd' ),
		'supports'			=> [
			'align'				=> false,
			'anchor'			=> true,
			'customClassName'	=> true,
			'jsx' 				=> true,
		]
	));

	acf_register_block_type( array(
		'name'				=> 'dgwltd-cta',
        'title'				=> __( 'DGW.ltd CTA', 'dgwltd' ),
        'description'		=> __( 'Call to action', 'dgwltd' ),
		'render_template'	=> 'blocks/cta.php',
		'mode' 				=> 'preview',
		'category'			=> 'common',
		'icon'				=> 'tide',
		'keywords'			=> array( 'dgwltd' ),
		'supports'			=> [
			'align'				=> false,
			'anchor'			=> true,
			'customClassName'	=> true,
			'jsx' 				=> true,
		]
	));

	acf_register_block_type( array(
		'name'				=> 'dgwltd-details',
        'title'				=> __( 'DGW.ltd Details', 'dgwltd' ),
        'description'		=> __( 'Detailed information', 'dgwltd' ),
		'render_template'	=> 'blocks/details.php',
		'mode' 				=> 'preview',
		'category'			=> 'common',
		'icon'				=> 'arrow-down',
		'keywords'			=> array( 'dgwltd' ),
		'supports'			=> array( 'align' => false )
	));

	acf_register_block_type( array(
		'name'				=> 'dgwltd-image',
        'title'				=> __( 'DGW.ltd Image', 'dgwltd' ),
        'description'		=> __( 'Image', 'dgwltd' ),
		'render_template'	=> 'blocks/image.php',
		'mode' 				=> 'edit',
		'category'			=> 'common',
		'icon'				=> 'format-image',
		'keywords'			=> array( 'dgwltd' ),
		'supports'			=> array( 'align' => false )
	));

	acf_register_block_type( array(
		'name'				=> 'dgwltd-accordion',
        'title'				=> __( 'DGW.ltd Accordion', 'dgwltd' ),
        'description'		=> __( 'Show and hide sections', 'dgwltd' ),
		'render_template'	=> 'blocks/accordion.php',
		'mode' 				=> 'edit',
		'category'			=> 'common',
		'icon'				=> 'menu',
		'keywords'			=> array( 'dgwltd' ),
		'supports'			=> array( 'align' => false )
	));

	acf_register_block_type( array(
		'name'				=> 'dgwltd-summary-list',
        'title'				=> __( 'DGW.ltd Summary list', 'dgwltd' ),
        'description'		=> __( 'Summarise information', 'dgwltd' ),
		'render_template'	=> 'blocks/summary-list.php',
		'mode' 				=> 'edit',
		'category'			=> 'common',
		'icon'				=> 'list-view',
		'keywords'			=> array( 'dgwltd' ),
		'supports'			=> array( 'align' => false )
	));

	acf_register_block_type( array(
		'name'				=> 'dgwltd-related',
        'title'				=> __( 'DGW.ltd Related pages', 'dgwltd' ),
        'description'		=> __( 'List of related links', 'dgwltd' ),
		'render_template'	=> 'blocks/related.php',
		'mode' 				=> 'edit',
		'category'			=> 'common',
		'icon'				=> 'admin-links',
		'keywords'			=> array( 'dgwltd' ),
		'supports'			=> array( 'align' => false )
	));

}
add_action('acf/init', 'dgwltd_register_blocks' );


// save jsonwith fields
function dgwltd_acf_json_save_point( $path ) {

    // update path
    $path = plugin_dir_path( __DIR__ ) . '/acf-json';
    // return
	return $path;
	
  }
  
  
// load json with fields
function dgwltd_acf_json_load_point( $paths ) {

	unset($paths[0]);

	// append path
	$paths[] = plugin_dir_path( __DIR__ ) . 'dgwltd-blocks/acf-json';
	// return
	return $paths;


}

add_filter('acf/settings/save_json', 'dgwltd_acf_json_save_point', 1);
add_filter('acf/settings/load_json', 'dgwltd_acf_json_load_point', 1);