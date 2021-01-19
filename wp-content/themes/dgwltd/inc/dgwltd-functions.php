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
        $atts['aria-haspopup'] = "true";
		$atts['aria-expanded'] = "false";
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
function dgwltd_the_category_filter( $thelist, $separator=' ' ) {
    if( !defined( 'WP_ADMIN' ) ) {
        $exclude = array( 1 );

        $exclude2 = array();
        foreach( $exclude as $c ) {
            $exclude2[] = get_cat_name( $c );
        }

        $cats = explode( $separator, $thelist );
        $newlist = array();
        foreach( $cats as $cat ) {
            $catname = trim( strip_tags( $cat ) );
            if( !in_array( $catname, $exclude2 ) )
                $newlist[] = $cat;
        }
        return implode( $separator, $newlist );
    } else {
        return $thelist;
    }
}
add_filter( 'the_category', 'dgwltd_the_category_filter', 10, 2 );


if ( ! function_exists( 'dgwltd_env' ) ) :
	function dgwltd_env($env) {
		$site_url = site_url();
		switch ($env) {
			case 'dev':
				if(strpos($site_url, 'localhost:3000') !== FALSE) {
					return true;
				}
				break;
			default:
				'prod';
			break;
		}
	}
endif;


// Callable for usort. Sorts the array based on the 'distance' array value - using spaceship operator <=> PHP 7+
if ( ! function_exists( 'dgwltd_sort_dates' ) ) :
function dgwltd_sort_dates( $a, $b ) {
	
	// order by date (closest first) - php 7
	return new DateTime($a['start']) <=> new DateTime($b['start']);
	
}
endif;

if ( ! function_exists( 'dgwltd_parse_video_uri' ) ) :
	/* Parse the video uri/url to determine the video type/source and the video id */
	function dgwltd_parse_video_uri( $url ) {
			
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
	
		// if (isset( $parse['host'] ) ) {
		// 	$host_names = explode(".", $parse['host'] );
		// 	$rebuild = ( ! empty( $host_names[1] ) ? $host_names[1] : '') . '.' . ( ! empty($host_names[2] ) ? $host_names[2] : '');
		// }
	
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
endif;