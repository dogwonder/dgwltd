<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dgwltd
 */
?>
<!doctype html>
<html <?php language_attributes(); ?> >
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="shortcut icon" sizes="16x16 32x32 48x48" href="<?php echo get_template_directory_uri(); ?>/dist/images/fav/favicon.png" type="image/x-icon">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/dist/images/fav/dgwltd-apple-touch-icon-180x180.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/dist/images/fav/apple-icon-152x152.png">
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/fav/apple-icon.png">
<!-- Firefox, Chrome, Safari, IE 11+ and Opera. 192x192 pixels in size. -->
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/fav/favicon-192x192.png">
<!-- Touch Icons - iOS and Android 2.1+ 180x180 pixels in size. --> 
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/fav/favicon-180x180.png">
<!-- Safari pinned tab -->
<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/fav/favicon.svg" color="#000000">
<!-- Web app manifest 192x192 and 512x512 -->
<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/dist/images/fav/manifest.json">
<meta name="apple-mobile-web-app-title" content="<?php echo get_bloginfo('name') ?>" />
<meta name="apple-mobile-web-app-status-bar-style" content="white" />
<meta name="msapplication-TileColor" content="#373b47">
<meta name="theme-color" content="#373b47">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dist/css/vendor.css" />
<style type="text/css">
<?php include(locate_template('dist/css/critical.php')); ?>
</style>
<?php wp_head(); ?>
<?php
//SEO plugin check
if ( !is_plugin_active( 'wordpress-seo/wp-seo.php' ) || !is_plugin_active( 'wordpress-seo-premium/wp-seo-premium.php' ) ) : 
$site_description = get_bloginfo( 'description', 'display' );
$pdMetaInfo['title'] = 'DGW.ltd - ' . $post->post_title ?? '';
$pdMetaInfo['description'] = strip_shortcodes(wp_trim_words(get_post_field('post_content', $post), 20));
$pdMetaInfo['description'] = rtrim(str_replace('&hellip;', '', $pdMetaInfo['description']), '');
if (has_post_thumbnail()) {
	$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'dgwltd-social-image');
	$pdMetaInfo['image'] = $image[0];
}
if(!is_single() || empty($pdMetaInfo['image'])) {
	$pdMetaInfo['image'] = get_template_directory_uri() . '/dist/images/og/og-image.png';
}
if (!is_single() && !is_page() || empty($pdMetaInfo['title'])) {
	$pdMetaInfo['title'] = strip_shortcodes(esc_attr(get_bloginfo('name')));
}
if (!is_single() && !is_page() || empty($pdMetaInfo['description'])) {
	$pdMetaInfo['description'] = strip_shortcodes(esc_attr(get_bloginfo('description')));
}
if(is_search() || is_404()) {
	$pdMetaInfo['url'] = 'https://dgw.ltd';
} else {
	$pdMetaInfo['url'] = get_the_permalink($post->ID);
}
?>
<meta name="description" content="<?php echo esc_attr($pdMetaInfo['description']); ?>">
<meta property="og:title" content="<?php echo esc_attr($pdMetaInfo['title']) ?>">
<meta property="og:description" content="<?php echo esc_attr($pdMetaInfo['description']) ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image" content="<?php echo $pdMetaInfo['image'] ?>">
<meta property="og:url" content="<?php echo $pdMetaInfo['url'] ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo esc_attr($pdMetaInfo['title']) ?>">
<meta name="twitter:description" content="<?php echo esc_attr($pdMetaInfo['description']) ?>">
<meta name="twitter:image" content="<?php echo $pdMetaInfo['image'] ?>">
<?php endif; //SEO plugin check ?>
<script async defer data-domain="dgw.ltd" src="https://plausible.io/js/plausible.js"></script>
</head>
<body <?php body_class('no-js'); ?>>
<script>document.body.className = document.body.className.replace('no-js', 'js-enabled');</script>
<div id="page" class="dgwltd-wrapper">
	<header id="masthead" class="dgwltd-masthead" enabled="false">
		
		<?php 
		// Optional - if you need a cookie notice - also needs JS cookienotice() and cookies.scss
		//get_template_part('template-parts/_organisms/cookie-notice'); ?>

		<div id="skiplink-container">
			<a href="#content" class="govuk-skip-link"><?php esc_html_e('Skip to main content', 'dgwltd') ?></a>
		</div>

		<div class="dgwltd-masthead-container govuk-width-container">

				<div class="dgwltd-masthead__logo">
					<a href="<?php echo home_url( '/' ); ?>" rel="home" title="Go to the homepage for <?php bloginfo('name'); ?>">
					<?php get_template_part('template-parts/_atoms/logo'); ?>
					<span class="visually-hidden"><?php esc_html_e('DGW.ltd', 'dgwltd' ) ?></span>
					</a>
				</div><!-- .masthead__logo -->

				<nav id="site-navigation" class="main-navigation dgwltd-nav" aria-label="primary" >
				<button class="nav-toggle" id="nav-toggle" aria-label="Show or hide Top Level Navigation" aria-controls="nav-primary" aria-expanded="false">
					<svg class="open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M436 124H12c-6.627 0-12-5.373-12-12V80c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12z"/></svg>
					<svg class="close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><line x1="75" y1="75" x2="439" y2="439"/><line x1="439" y1="75" x2="75" y2="439"/></svg>
					<span class="visually-hidden"><?php esc_html_e('Menu', 'dgwltd' ) ?></span>
				</button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id' => 'nav-primary',
					'menu_class' => 'dgwltd-menu',
					'container'	=> false
				) );
				?>
				</nav><!-- #site-navigation -->
	
		</div><!--/container-->

	</header><!-- #masthead -->
	
	<main id="content" class="dgwltd-container">
