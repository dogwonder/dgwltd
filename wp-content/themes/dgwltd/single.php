<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dgwltd
 */

get_header();
?>

	<div id="primary" class="govuk-width-container">
		
		<div class="govuk-main-wrapper">
				<?php
				while ( have_posts() ) :

					the_post();

					get_template_part( 'template-parts/_templates/content', get_post_type() );

				endwhile; // End of the loop.
				?>
		</div><!-- .govuk-main-wrapper -->
	</div><!-- #primary -->

<?php
get_footer();
