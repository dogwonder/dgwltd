<?php
/**
 * Custom functions for this theme
 *
 * @package dgwltd
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'dgwltd_body_classes' ) ) :
	function dgwltd_body_classes( $classes ) {
		// Adds a class of hfeed to non-singular pages.

		global $post;

		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class of no-sidebar when there is no sidebar present.
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}
	add_filter( 'body_class', 'dgwltd_body_classes' );
endif;

/**
 * WCAG 2.0 Attributes for Dropdown Menus
 *
 * Adjustments to menu attributes tot support WCAG 2.0 recommendations
 * for flyout and dropdown menus.
 *
 * @ref https://www.w3.org/WAI/tutorials/menus/flyout/
 */
if ( ! function_exists( 'wcag_nav_menu_link_attributes' ) ) :
	function wcag_nav_menu_link_attributes( $atts, $item, $args, $depth ) {

		// Add [aria-haspopup] and [aria-expanded] to menu items that have children
		$item_has_children = in_array( 'menu-item-has-children', $item->classes );
		if ( $item_has_children ) {
			$atts['aria-haspopup'] = 'true';
			$atts['aria-expanded'] = 'false';
		}

		return $atts;
	}
	add_filter( 'nav_menu_link_attributes', 'wcag_nav_menu_link_attributes', 10, 4 );
endif;

/*
 * Exclude Uncategorized from get_the_category_list function.
 *
 * @access public
 */
function dgwltd_the_category_filter( $thelist, $separator = ' ' ) {
	if ( ! defined( 'WP_ADMIN' ) ) {
		$exclude = array( 1 );

		$exclude2 = array();
		foreach ( $exclude as $c ) {
			$exclude2[] = get_cat_name( $c );
		}

		$cats    = explode( $separator, $thelist );
		$newlist = array();
		foreach ( $cats as $cat ) {
			$catname = trim( wp_strip_all_tags( $cat ) );
			if ( ! in_array( $catname, $exclude2 ) ) {
				$newlist[] = $cat;
			}
		}
		return implode( $separator, $newlist );
	} else {
		return $thelist;
	}
}
add_filter( 'the_category', 'dgwltd_the_category_filter', 10, 2 );


if ( ! function_exists( 'dgwltd_env' ) ) :
	function dgwltd_env( $env ) {
		$site_url = esc_url( site_url() );
		switch ( $env ) {
			case 'dev':
				if ( strpos( $site_url, 'localhost:3000' ) !== false ) {
					return true;
				}
				break;
			default:
				'prod';
				break;
		}
	}
endif;

//Check cookie state
// if(dgwltd_cookie_var('functional')) { echo 'functional'; }
// if(dgwltd_cookie_var('analytics')) { echo 'analytics'; }
if ( ! function_exists( 'dgwltd_cookie_var' ) ) :
	function dgwltd_cookie_var($env) {

		//First of all does the cookie exist?
		if(!isset($_COOKIE['dgwltd_cookies_policy'])) return;

		$cookie = $_COOKIE["dgwltd_cookies_policy"];
		$cookie = stripslashes($cookie);
		$cookie_vars = json_decode($cookie, true);
		switch ($env) {
		case 'functional':
			if($cookie_vars[functional]) {
				return true;
			}
		break;
		case 'analytics':
			if($cookie_vars[analytics]) {
				return true;
			}
		break;
		default:
			'essential';
		break;
		}
	}
endif;


// Callable for usort. Sorts the array based on the 'distance' array value - using spaceship operator <=> PHP 7+
if ( ! function_exists( 'dgwltd_sort_dates' ) ) :
	function dgwltd_sort_dates( $a, $b ) {

		// order by date (closest first) - php 7
		return new DateTime( $a['start'] ) <=> new DateTime( $b['start'] );

	}
endif;
