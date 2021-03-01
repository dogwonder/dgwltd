<?php
/**
 * Related pages Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Create id attribute allowing for custom "anchor" value.
$id = 'block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}
// Create class attribute allowing for custom "className"
$className = 'dgwltd-block dgwltd-block--related';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
$relatedPages = get_field( 'related' ) ? : '';
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
	<?php if ( $relatedPages ) : ?>
	<div class="contextual-footer">
		<h2 class="govuk-heading-m"><?php esc_html_e( 'Related', 'dgwltd' ); ?></h2>
		<ul class="dgwltd-list">
			<?php foreach ( $relatedPages as $related ) : ?>
			<li><a class="govuk-link" href="<?php echo get_permalink( $related->ID ); ?>"><?php echo get_the_title( $related->ID ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php endif; ?>
</div>
