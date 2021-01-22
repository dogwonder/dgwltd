<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://dgw.ltd
 * @since      1.0.0
 *
 * @package    Dgwltd_Blocks
 * @subpackage Dgwltd_Blocks/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Dgwltd_Blocks
 * @subpackage Dgwltd_Blocks/public
 * @author     Rich Holman <dogwonder@gmail.com>
 */
class Dgwltd_Blocks_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $Dgwltd_Blocks    The ID of this plugin.
	 */
	private $Dgwltd_Blocks;
	

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $Dgwltd_Blocks       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $Dgwltd_Blocks, $version ) {

		$this->Dgwltd_Blocks = $Dgwltd_Blocks;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dgwltd_Blocks_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dgwltd_Blocks_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->Dgwltd_Blocks, plugin_dir_url( __FILE__ ) . 'css/dgwltd-blocks-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dgwltd_Blocks_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dgwltd_Blocks_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->Dgwltd_Blocks, plugin_dir_url( __FILE__ ) . 'scripts/app.js', array( 'jquery' ), $this->version, false );

	}

	public function dgwltd_parse_video_uri( $url ) {	
		
		// Parse the url 
		$parse = parse_url( $url );
		
		// Set blank variables
		$video_type = '';
		$video_id = '';
		
		// Url is http://youtu.be/xxxx
		if ( isset( $parse['host'] ) && $parse['host'] == 'youtu.be' ) {
		
			$video_type = 'youtube';
			$video_id = ltrim( $parse['path'],'/' );	
			
		}
		
		// Url is http://www.youtube.com/watch?v=xxxx 
		// or http://www.youtube.com/watch?feature=player_embedded&v=xxx
		// or http://www.youtube.com/embed/xxxx
		if ( isset( $parse['host'] ) && ( $parse['host'] == 'youtube.com' ) || isset( $parse['host'] ) && ( $parse['host'] == 'www.youtube.com' ) ) {
		
			$video_type = 'youtube';
			
			parse_str( $parse['query'], $output  );
	
			// print_r($output);
			
			$video_id = $output['v'];	
			
			if ( !empty( $feature ) )
				$video_id = end( explode( 'v=', $parse['query'] ) );
				
			if ( strpos( $parse['path'], 'embed' ) == 1 )
				$video_id = end( explode( '/', $parse['path'] ) );
			
		}
		
		// Url is http://www.vimeo.com
		if ( isset( $parse['host'] ) && ( $parse['host'] == 'vimeo.com' ) || isset( $parse['host'] ) && ( $parse['host'] == 'www.vimeo.com' ) ) {
		
			$video_type = 'vimeo';
			
			$video_id = ltrim( $parse['path'],'/' );	
						
		}
	
		// If recognised type return video array
		if ( !empty( $video_type ) ) {
		
			$video_array = array(
				'type' => $video_type,
				'id' => $video_id
			);
		
			return $video_array;
			
		} else {
		
			return false;
			
		}
	}

}
