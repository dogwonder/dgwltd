<?php

/**
 * Define the blocks functionality
 *
 * Loads and defines the ACF blocks for this plugin
 *
 * @link       https://dgw.ltd
 * @since      1.0.0
 *
 * @package    Dgwltd_Blocks
 * @subpackage Dgwltd_Blocks/includes
 */

/**
 * Define the blocks functionality.
 *
 * Loads and defines the ACF blocks for this plugin
 *
 * @since      1.0.0
 * @package    Dgwltd_Blocks
 * @subpackage Dgwltd_Blocks/includes
 * @author     Rich Holman <dogwonder@gmail.com>
 */
class Dgwltd_Blocks_ACF {


	public function dgwltd_register_blocks() {

		// dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		if( ! function_exists( 'acf_register_block_type' ) )
		return;

		acf_register_block_type( array(
			'name'				=> 'dgwltd-hero',
			'title'				=> __( 'DGW.ltd Hero', 'dgwltd' ),
			'description'		=> __( 'Hero block', 'dgwltd' ),
			'render_template'	=> plugin_dir_path(__DIR__) . 'src/blocks/hero.php',
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
			'render_template'	=> plugin_dir_path(__DIR__) . 'src/blocks/embed.php',
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
			'render_template'	=> plugin_dir_path(__DIR__) . 'src/blocks/feature.php',
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
			'render_template'	=> plugin_dir_path(__DIR__) . 'src/blocks/cards.php',
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
			'render_template'	=> plugin_dir_path(__DIR__) . 'src/blocks/cta.php',
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
			'render_template'	=> plugin_dir_path(__DIR__) . 'src/blocks/details.php',
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
			'render_template'	=> plugin_dir_path(__DIR__) . 'src/blocks/image.php',
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
			'render_template'	=> plugin_dir_path(__DIR__) . 'src/blocks/accordion.php',
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
			'render_template'	=> plugin_dir_path(__DIR__) . 'src/blocks/summary-list.php',
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
			'render_template'	=> plugin_dir_path(__DIR__) . 'src/blocks/related.php',
			'mode' 				=> 'edit',
			'category'			=> 'common',
			'icon'				=> 'admin-links',
			'keywords'			=> array( 'dgwltd' ),
			'supports'			=> array( 'align' => false )
		));

	}

	// save jsonwith fields
	public function dgwltd_acf_json_save_point( $path ) {

		// update path
		$path = plugin_dir_path( dirname( __FILE__ ) ) . 'src/acf-json';
		// return
		return $path;
	
  	}
  
	// load json with fields
	public function dgwltd_acf_json_load_point( $paths ) {

		unset($paths[0]);

		// append path
		$paths[] = plugin_dir_path( dirname( __FILE__ ) ) . 'src/acf-json';
		// return
		return $paths;

	}

}