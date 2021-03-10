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
<title><?php bloginfo( 'name' ); ?> &ndash; <?php is_front_page() ? bloginfo( 'description' ) : wp_title( '' ); ?></title>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/dist/scripts/cookies.js"></script>
<link rel="preconnect" href="https://plausible.io">
<link rel="preconnect" href="<?php echo esc_url( site_url() ); ?>" crossorigin>
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dist/css/vendor.css" />
<style type="text/css">
<?php require locate_template( 'dist/css/critical.php' ); ?>
</style>
<script async defer data-domain="dgw.ltd" src="https://plausible.io/js/plausible.js"></script>
<link rel="shortcut icon" sizes="16x16 32x32 48x48" href="<?php echo get_template_directory_uri(); ?>/dist/images/fav/favicon-128x128.png" type="image/x-icon">
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/fav/favicon-128x128.png">
<meta name="apple-mobile-web-app-title" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
<meta name="theme-color" content="#75e6ef">
<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/dist/images/fav/manifest.json">
<?php
// SEO plugin check
if ( ! is_plugin_active( 'wordpress-seo/wp-seo.php' ) || ! is_plugin_active( 'wordpress-seo-premium/wp-seo-premium.php' ) ) :
	$site_description           = esc_attr( get_bloginfo( 'description', 'display' ) );
	$dgwltd_meta['title']       = 'DGW.ltd - ' . $post->post_title ?? '';
	$dgwltd_meta['description'] = strip_shortcodes( wp_trim_words( get_post_field( 'post_content', $post ), 20 ) );
	$dgwltd_meta['description'] = rtrim( str_replace( '&hellip;', '', $dgwltd_meta['description'] ), '' );
	if ( has_post_thumbnail() ) {
		$image                = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'dgwltd-social-image' );
		$dgwltd_meta['image'] = $image[0];
	}
	if ( ! is_single() || empty( $dgwltd_meta['image'] ) ) {
		$dgwltd_meta['image'] = get_template_directory_uri() . '/dist/images/og/og-image.png';
	}
	if ( ! is_single() && ! is_page() || empty( $dgwltd_meta['title'] ) ) {
		$dgwltd_meta['title'] = strip_shortcodes( esc_attr( get_bloginfo( 'name' ) ) );
	}
	if ( ! is_single() && ! is_page() || empty( $dgwltd_meta['description'] ) ) {
		$dgwltd_meta['description'] = strip_shortcodes( esc_attr( get_bloginfo( 'description' ) ) );
	}
	if ( is_search() || is_404() ) {
		$dgwltd_meta['url'] = esc_url( site_url() );
	} else {
		$dgwltd_meta['url'] = esc_url( get_the_permalink( $post->ID ) );
	}
	?>
<meta name="description" content="<?php echo esc_attr( $dgwltd_meta['description'] ); ?>">
<meta property="og:title" content="<?php echo esc_attr( $dgwltd_meta['title'] ); ?>">
<meta property="og:description" content="<?php echo esc_attr( $dgwltd_meta['description'] ); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image" content="<?php echo $dgwltd_meta['image']; ?>">
<meta property="og:url" content="<?php echo $dgwltd_meta['url']; ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo esc_attr( $dgwltd_meta['title'] ); ?>">
<meta name="twitter:description" content="<?php echo esc_attr( $dgwltd_meta['description'] ); ?>">
<meta name="twitter:image" content="<?php echo $dgwltd_meta['image']; ?>">
<?php endif; // SEO plugin check ?>
</head>
<body <?php body_class( 'no-js' ); ?>>
<script>document.body.className = document.body.className.replace('no-js', 'js-enabled');</script>
<div id="page" class="dgwltd-wrapper">
	<header id="masthead" class="dgwltd-masthead" enabled="false">
		<?php
		// Optional - if you need a cookie notice - also needs JS cookienotice() and cookies.scss
		get_template_part('template-parts/_organisms/cookie-notice');
		?>

		<div id="skiplink-container">
			<a href="#content" class="govuk-skip-link"><?php esc_html_e( 'Skip to main content', 'dgwltd' ); ?></a>
		</div>

		<div class="dgwltd-masthead-container">

				<div class="dgwltd-masthead__logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="Go to the homepage for <?php bloginfo( 'name' ); ?>">
					<?php get_template_part( 'template-parts/_atoms/logo' ); ?>
					<span class="visually-hidden"><?php esc_html_e( 'DGW.ltd', 'dgwltd' ); ?></span>
					</a>
				</div><!-- .masthead__logo -->

				<nav id="site-navigation" class="main-navigation dgwltd-nav" aria-label="primary" >
				<button class="nav-toggle" id="nav-toggle" aria-label="Show or hide Top Level Navigation" aria-controls="nav-primary" aria-expanded="false">
					<svg class="open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M436 124H12c-6.627 0-12-5.373-12-12V80c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12z"/></svg>
					<svg class="close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><line x1="75" y1="75" x2="439" y2="439"/><line x1="439" y1="75" x2="75" y2="439"/></svg>
					<span class="visually-hidden"><?php esc_html_e( 'Menu', 'dgwltd' ); ?></span>
				</button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'nav-primary',
						'menu_class'     => 'dgwltd-menu',
						'container'      => false,
					)
				);
				?>
				</nav><!-- #site-navigation -->
	
		</div><!--/container-->

	</header><!-- #masthead -->
	
	<main id="content" class="dgwltd-container">

