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
$block_id = 'block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}
// Create class attribute allowing for custom "className"
$class_name = 'dgwltd-block dgwltd-block--related';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
$related_pages = get_field( 'related' ) ? : '';
?>
<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<?php if ( $related_pages ) : ?>
	<div class="contextual-footer">
		<h2 class="govuk-heading-m"><?php esc_html_e( 'Related', 'dgwltd' ); ?></h2>
		<ul class="dgwltd-list">
			<?php foreach ( $related_pages as $related ) : ?>
			<li><a class="govuk-link" href="<?php echo get_permalink( $related->ID ); ?>"><?php echo get_the_title( $related->ID ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php endif; ?>
</div>
