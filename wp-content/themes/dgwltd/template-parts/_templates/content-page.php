<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dgwltd
 */

?>
<?php
// Hide title via custom field
if ( class_exists( 'acf' ) ) {
	$hiddenTitle = get_field( 'hide_title' );
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( ! $hiddenTitle ) : ?>
	<div class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</div><!-- .entry-header -->
	<?php else : ?>
	<div class="entry-header">
		<?php the_title( '<h1 class="entry-title visually-hidden">', '</h1>' ); ?>
	</div><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
