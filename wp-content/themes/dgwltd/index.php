<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dgwltd
 */

get_header();
?>

	<div id="primary" class="govuk-width-container">
		<div class="govuk-main-wrapper">

		<h1 class="dgwltd-heading-xl"><?php echo get_bloginfo( 'name' ); ?></h1>

		<!-- Use the element. You may use it before the lite-yt-embed JS is executed. -->
		<!-- <lite-youtube videoid="ogfYd705cRs" playlabel="Play: Keynote (Google I/O '18)"></lite-youtube>
		<lite-vimeo videoid="364402896" videotitle="This is a video title"></lite-vimeo> -->

		<?php
		if ( have_posts() ) :
			?>
			<div class="dgwltd-list">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

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
