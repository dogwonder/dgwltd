<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package dgwltd
 */

get_header();
?>

	<div id="primary" class="govuk-width-container">
		<div class="govuk-main-wrapper">

			<section class="error-404 not-found">
				<div class="page-header">
					<h1 class="page-title"><?php esc_html_e( '404, page not found', 'dgwltd' ); ?></h1>
				</div><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'There may be an error in the link you followed to get here. ', 'dgwltd' ); ?></p>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-nav',
							'menu_class'     => 'dgwltd-menu-404',
							'container'      => false,
						)
					);
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
			
		</div><!-- .govuk-main-wrapper -->
	</div><!-- #primary -->

<?php
get_footer();
