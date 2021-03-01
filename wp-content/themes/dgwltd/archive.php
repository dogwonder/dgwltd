<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dgwltd
 */

get_header();
?>

	<div id="primary" class="govuk-width-container">
		<div class="govuk-main-wrapper">

				<?php if ( have_posts() ) : ?>

					<div class="page-header">
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</div><!-- .page-header -->

					<hr />

					<div class="dgwltd-list">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/_templates/content-list' );

					endwhile;
					?>
					</div><!-- .dgwltd-list -->
					<?php
						get_template_part( 'template-parts/_molecules/pagination' );
					else :
						get_template_part( 'template-parts/_templates/content', 'none' );
					endif;
					?>

		</div><!-- .govuk-main-wrapper -->
	</div><!-- #primary -->

<?php
get_footer();
