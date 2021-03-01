<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package dgwltd
 */

get_header();
?>

	<div id="primary" class="govuk-width-container">
		<div class="govuk-main-wrapper">

		<?php if ( have_posts() && ! empty( $_GET['s'] ) ) : ?>

			<div class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search results for %s', 'dgwltd' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
				<?php get_template_part( 'template-parts/_organisms/site-search' ); ?>
				
				<h2 class="govuk-heading-l">
				<?php
				printf( esc_html__( '%1$s for %2$s', 'dgwltd' ), $wp_query->found_posts . ( $wp_query->found_posts == 1 ? ' result' : ' results' ), get_search_query() );
				')';
				?>
				</h2>
				<hr />
			</div><!-- .page-header -->

			<div class="site-search__results">
			
			<div class="dgwltd-list">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/_templates/content', 'search' );

			endwhile;
			?>
			</div><!--end list-->
			<?php
			get_template_part( 'template-parts/_molecules/pagination' );
			else :
				?>
			<div class="page-header">
				<?php if ( ! empty( $_GET['s'] ) ) : ?>
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search results for %s', 'dgwltd' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
				<?php else : ?>
				<h1 class="page-title"><?php esc_html_e( 'Search results', 'dgwltd' ); ?></h1>
				<?php endif; ?>
			</div><!-- .page-header -->
				<?php get_template_part( 'template-parts/_organisms/site-search' ); ?>
				<?php
				get_template_part( 'template-parts/_templates/content-no-results' );
			endif;
			?>
		</div><!-- .govuk-main-wrapper -->
	</div><!-- #primary -->

<?php
get_footer();
