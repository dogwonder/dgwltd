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
$id = 'block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}
// Create class attribute allowing for custom "className"
$className = 'dgwltd-block dgwltd-block--image';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
$image              = get_field( 'image' ) ? : '';
$imageMedium        = $image['sizes']['dgwltd-medium'];
$imageLarge         = $image['sizes']['dgwltd-large'];
$imageAlt           = esc_attr( $image['alt'] ) ? : '';
$x                  = get_field( 'x' ) ? : '1';
$y                  = get_field( 'y' ) ? : '1';
$full_width         = get_field( 'full_width' ) ? : '';
$block_full_width   = $full_width ? 'full-width ' : '';
$block_aspect_ratio = 'aspect-' . $x . '_' . $y ? : '';
$block_classes      = array( $className, $block_aspect_ratio, $block_full_width );
?>
<?php if ( $block_aspect_ratio ) : ?>
  <style>
	#<?php echo $id; ?> .frame {
		--x: <?php echo $x; ?>;
		--y: <?php echo $y; ?>;
	}
  </style>
<?php endif; ?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( implode( ' ', $block_classes ) ); ?>">
	  <?php if ( $image ) : ?>
		<figure class="dgwltd-block__image">
		  <picture class="frame">
			<source media="(min-width: 769px)" srcset="<?php echo ( $imageLarge ? $imageLarge : $imageMedium ); ?>">
			<img src="<?php echo $imageMedium; ?>" alt="<?php echo ( $imageAlt ? $imageAlt : '' ); ?>" loading="lazy" />
		  </picture>
		</figure>
		<?php endif; ?>
</div>
