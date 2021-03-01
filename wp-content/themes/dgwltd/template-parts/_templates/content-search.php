<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dgwltd
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'dgwltd-list__item' ); ?> itemscope itemtype="http://schema.org/BlogPosting">

	<div class="entry-header">
			<?php the_title( '<h2 class="entry-title dgwltd-list__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<?php if ( $post_type === 'post' ) { ?>
			<div class="entry-meta dgwltd-list__meta">
				<?php dgwltd_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php } ?>
	</div><!-- .entry-header -->
	
	<div class="dgwltd-list__wrapper">        

		<div class="dgwltd-list__content">
			<div class="entry-content">
				<?php
				// Display the excerpt is exists
				if ( has_excerpt( $post->ID ) ) {
					echo esc_html( get_the_excerpt( $post->ID ) );
				} else {
					echo esc_html( dgwltd_standfirst( 80, $post->ID ) );
				}
				?>
			</div><!-- .entry-content -->
		</div><!-- /content-->   

	 </div><!-- /wrapper-->   

</article><!-- #post-<?php the_ID(); ?> -->
