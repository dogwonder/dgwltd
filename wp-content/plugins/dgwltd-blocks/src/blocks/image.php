<?php
/**
 * Image Block Template.
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
$class_name = 'dgwltd-block dgwltd-block--image';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
$image              = get_field( 'image' ) ? : '';
$image_medium        = $image['sizes']['dgwltd-medium'];
$imageLarge         = $image['sizes']['dgwltd-large'];
$image_alt           = esc_attr( $image['alt'] ) ? : '';
$x                  = get_field( 'x' ) ? : '1';
$y                  = get_field( 'y' ) ? : '1';
$full_width         = get_field( 'full_width' ) ? : '';
$block_full_width   = $full_width ? 'full-width ' : '';
$block_aspect_ratio = 'aspect-' . $x . '_' . $y ? : '';
$block_classes      = array( $class_name, $block_aspect_ratio, $block_full_width );
?>
<?php if ( $block_aspect_ratio ) : ?>
  <style>
	#<?php echo $block_id; ?> .frame {
		--x: <?php echo $x; ?>;
		--y: <?php echo $y; ?>;
	}
  </style>
<?php endif; ?>
<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( implode( ' ', $block_classes ) ); ?>">
	  <?php if ( $image ) : ?>
		<figure class="dgwltd-block__image">
		  <picture class="frame">
			<source media="(min-width: 769px)" srcset="<?php echo ( $imageLarge ? $imageLarge : $image_medium ); ?>">
			<img src="<?php echo $image_medium; ?>" alt="<?php echo ( $image_alt ? $image_alt : '' ); ?>" loading="lazy" />
		  </picture>
		</figure>
		<?php endif; ?>
</div>
