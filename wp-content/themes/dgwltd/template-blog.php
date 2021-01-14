<?php
/**
 * Template Name: Blog posts
 *
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dgwltd
 */

get_header();

global $post;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$numberposts = '10';

$post_args = array(
	'post_type' => 'post',
	'posts_per_page' => $numberposts,
	'post_status' => 'publish',
	'paged' => $paged, 
);

$blog_query = new WP_Query($post_args);
?>
	<div id="primary" class="govuk-width-container">
		<div class="govuk-main-wrapper">
				<?php
				while (have_posts()) :
					the_post();
					get_template_part('template-parts/_templates/content', 'page');
				endwhile; // End of the loop.
				?>
				<hr />
				<?php if ($blog_query->have_posts()) : ?>
					<div class="dgwltd-list">
					<?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
						<?php get_template_part('template-parts/_templates/content-list'); ?>
					<?php endwhile; // End of the loop. ?>
					</div>
					<?php wp_reset_postdata(); ?>

					<?php
					//Get pagination
					$totalPages = $blog_query->max_num_pages;
					include(locate_template('template-parts/_molecules/pagination-query.php'));
					else :
					get_template_part( 'template-parts/_templates/content', 'none' );
					endif;
					?>
					<?php wp_reset_query(); ?>
		</div><!-- .govuk-main-wrapper -->		
	</div><!-- #primary -->


<?php
get_footer();
