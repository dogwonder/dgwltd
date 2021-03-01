<?php
/**
 * Template Name: Blocks layout page
 *
 * The template for displaying blocks
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dgwltd
 */
get_header();
?>
	<div id="primary" class="dgwltd-full-container">
		<div class="dgwltd-main-wrapper">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		</article><!-- #post-<?php the_ID(); ?> -->
		<?php endwhile; // End of the loop. ?>
		
		</div><!-- .dgwltd-main-wrapper -->		
	</div><!-- #primary -->


<?php
get_footer();
