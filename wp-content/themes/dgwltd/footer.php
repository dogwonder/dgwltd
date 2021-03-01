<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dgwltd
 */

?>

  </main><!-- #content -->

	<footer class="dgwltd-footer govuk-footer">
	<div class="govuk-width-container">   

		<h2 class="govuk-visually-hidden"><?php esc_html_e( 'Site links', 'dgwltd' ); ?></h2>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'footer',
				'menu_id'        => 'footer-nav',
				'menu_class'     => 'dgwltd-footer__list govuk-footer__inline-list',
				'container'      => false,
			)
		);
		?>
				

		<h2 class="govuk-visually-hidden"><?php esc_html_e( 'Social Links', 'dgwltd' ); ?></h2>
		<?php get_template_part( 'template-parts/_molecules/social-links' ); ?>

		<h2 class="govuk-visually-hidden"><?php esc_html_e( 'Support links', 'dgwltd' ); ?></h2>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'legal',
				'menu_id'        => 'legal-nav',
				'menu_class'     => 'dgwltd-footer__list govuk-footer__inline-list',
				'container'      => false,
			)
		);
		?>

		<span class="govuk-footer__licence-description">© <?php echo date( 'Y' ); ?></span>

	</div>
  </div>

	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/dist/scripts/govuk-frontend-3.11.0.min.js"></script>
<script>window.GOVUKFrontend.initAll()</script>
<script type="module" src="<?php echo get_template_directory_uri(); ?>/dist/scripts/app.js"></script>
<?php
if ( has_blocks( $post->post_content ) ) {
	$blocks = parse_blocks( $post->post_content );
	foreach ( $blocks as $index => $block ) {
		if ( $index == 0 && 'core/gallery' === $block['blockName'] ) {
			?>
			<?php include locate_template( 'template-parts/_organisms/pswp.php' ); ?>
<script src="<?php echo get_template_directory_uri(); ?>/dist/scripts/photoswipe.min.js"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/dist/scripts/photoswipe-ui-default.min.js"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/dist/scripts/gallery.js"></script>    
			<?php
		}
	}
}
?>
<script>
  if ('serviceWorker' in navigator) {
	window.addEventListener('load', function() {
	  navigator.serviceWorker.register('/sw.js').then(function(registration) {
		// Successfully registered the Service Worker
		console.log('Service Worker registration successful with scope: ', registration.scope);
	  }).catch(function(err) {
		// Failed to register the Service Worker
		console.log('Service Worker registration failed: ', err);
	  });
	});
  }
</script>
</body>
</html>
