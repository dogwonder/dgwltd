<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dgwltd
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'dgwltd-post' ); ?> itemscope itemtype="http://schema.org/BlogPosting">

	<div class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php dgwltd_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	</div><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<div class="entry-footer">
	<?php
	$categories_list = get_the_category_list( esc_html__( ', ', 'dgwltd' ) );
	if ( $categories_list ) {
		/* translators: 1: list of categories. */
		printf( '<span class="cat-links">' . esc_html__( '%1$s', 'dgwltd' ) . '</span>', $categories_list ); // WPCS: XSS OK.
	}
	?>
	</div><!-- .entry-content -->
	
</article><!-- #post-<?php the_ID(); ?> -->
