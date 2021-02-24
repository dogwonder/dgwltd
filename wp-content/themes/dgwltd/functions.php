<?php
/**
 * dgwltd functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dgwltd
 */

if ( ! function_exists( 'dgwltd_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dgwltd_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on dgwltd, use a find and replace
		 * to change 'dgwltd' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'dgwltd', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		//Image sizes;
		add_image_size('dgwltd-tiny', 16, 0, false); //For Low quality image placeholders (LQIP)
		add_image_size('dgwltd-small', 320, 0, false);
		add_image_size('dgwltd-medium', 640, 0, false);
		add_image_size('dgwltd-large', 1536, 0, false );
		add_image_size('dgwltd-social-image', 1200, 630);	

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'dgwltd' ),
			'footer' => esc_html__('Footer', 'dgwltd'), 
			'legal' => esc_html__('Legal', 'dgwltd'), 
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'dgwltd_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );


		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		//Add editor style
		add_theme_support( 'editor-styles' );
		// add_editor_style(get_template_directory_uri() . '/dist/css/editor.css');

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if ( is_customize_preview() ) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support( 'starter-content', dgwltd_get_starter_content() );
		}
		
	}
	
endif;
add_action( 'after_setup_theme', 'dgwltd_setup' );


if ( ! function_exists( 'add_cors_http_header' ) ) :
//Add Access-Control-Allow-Origin
function add_cors_http_header() { 
	header("Access-Control-Allow-Origin: *"); 
	header("Access-Control-Allow-Methods: GET"); 
	header("Access-Control-Allow-Headers: origin"); 
}
endif;
add_action( 'wp_headers', 'add_cors_http_header', 11, 1 );

// add_filter( 'wp_headers', 'send_cors_headers', 11, 1 );
// function send_cors_headers( $headers ) {
//     $allowed_domains = array( 'https://dgw.ltd');
//     if ( ! in_array( $_SERVER[ 'HTTP_ORIGIN' ] , $allowed_domains ) ) return $headers;
//     $headers['Access-Control-Allow-Origin'] = $_SERVER[ 'HTTP_ORIGIN' ];
//     return $headers;
// }


//Remove admin stuff - e.g. Emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dgwltd_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'dgwltd_content_width', 640 );
}
add_action( 'after_setup_theme', 'dgwltd_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dgwltd_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'dgwltd' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'dgwltd' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'dgwltd_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dgwltd_scripts() {

	$cache_buster = filemtime(get_template_directory() . '/dist/css/critical.css');
	if(empty($cache_buster)) {
		$cache_buster = date('U');
	}

	wp_enqueue_style( 'dgwltd-style', get_stylesheet_uri() );

	// wp_enqueue_style('dgwltd-main', get_template_directory_uri() . '/dist/css/vendor.css', false, $cache_buster);

	// wp_enqueue_style('dgwltd-print', get_template_directory_uri() . '/dist/css/print.css', false, $cache_buster, 'print');

	// wp_enqueue_script('dgwltd-js', get_template_directory_uri() . '/dist/scripts/app.js', array('jquery'), $cache_buster, false); 

	// 3.5.1
	wp_deregister_script('jquery');
	wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js", false, null);
	wp_enqueue_script('jquery');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dgwltd_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/dgwltd-template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/dgwltd-functions.php';

/**
 * Functions for Advanced Custom Fields
 */
require get_template_directory() . '/inc/dgwltd-acf.php';

/**
 * Functions for Google AMP 
 */
require get_template_directory() . '/inc/dgwltd-amp.php';

/**
 * Functions for forms
 */
require get_template_directory() . '/inc/dgwltd-forms.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';