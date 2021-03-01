<?php
/**
 * Feature Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
$block_id = 'block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}
// Create class attribute allowing for custom "className"
$class_name = 'dgwltd-block dgwltd-block--feature';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
// Random ID
$rand = substr( md5( microtime() ), rand( 0, 26 ), 5 );

// Block Fields
$image    = get_field( 'background_image' ) ? : '';
$overlay  = get_field( 'overlay' ) ? : '';
$parallax = get_field( 'parallax' ) ? : '';

// Classes
$block_image    = $image ? 'has-image ' : '';
$block_overlay  = $overlay ? 'has-overlay ' : '';
$block_parallax = $parallax ? 'is-parallax ' : '';
$block_classes  = array( $class_name, $block_image, $block_overlay, $block_parallax );

/*
NEEDS PARALAX
NEEDS OVERLAY
*/

// JSX Innerblocks - https://www.billerickson.net/innerblocks-with-acf-blocks/
$allowed_blocks = array( 'core/heading', 'core/paragraph', 'core/button' );
$block_template = array(
	array(
		'core/heading',
		array(
			'level'       => 3,
			'placeholder' => 'Add lede...',
		),
	),
	array(
		'core/heading',
		array(
			'level'       => 2,
			'placeholder' => 'Add title...',
		),
	),
	array(
		'core/paragraph',
		array(
			'placeholder' => 'Add content...',
		),
	),
);
?>

 <div id="<?php echo $block_id; ?>" class="<?php echo esc_attr( implode( ' ', $block_classes ) ); ?>">

			<?php if ( ! empty( $image ) ) : ?>    
				<?php // print_r($image) ?>
				<?php
				$image_tiny        = $image['sizes']['dgwltd-tiny'];
				$image_small       = $image['sizes']['dgwltd-medium'];
				$imageLarge       = $image['sizes']['dgwltd-large'];
				$image_alt         = esc_attr( $image['alt'] );
				$image_width       = esc_attr( $image['width'] );
				$image_height      = esc_attr( $image['height'] );
				$image_small_width  = esc_attr( $image['sizes']['dgwltd-medium-width'] );
				$image_small_height = esc_attr( $image['sizes']['dgwltd-medium-height'] );
				// For Low quality image placeholders (LQIP)
				$type   = pathinfo( $image_tiny, PATHINFO_EXTENSION );
				$data   = file_get_contents( $image_tiny );
				$base64 = 'data:image/' . $type . ';base64,' . base64_encode( $data );
				?>
				<?php if ( $block_parallax ) : ?>
				<style>
					#<?php echo $block_id; ?>.dgwltd-block--feature {
						background: url('<?php echo $image_small; ?>') no-repeat fixed;
						background-size: cover;
						background-position: center center;
						width: 100%;
					}
					@media only screen and (min-width: 641px) {
						#<?php echo $block_id; ?>.dgwltd-block--feature {
							background-image:url('<?php echo $imageLarge; ?>');
						}
					}
					<?php if ( $block_overlay ) : ?>
					#<?php echo $block_id; ?>.dgwltd-block--feature:before {
						display: block;
						z-index: 2;
						content: '';
						position: absolute;
						top: 0;
						right: 0;
						bottom: 0;
						left: 0;
						background-color: <?php echo $overlay; ?>;
						opacity:0.7;
					}
					<?php endif; ?>
				</style>
				<?php else : ?>
					<?php if ( $block_overlay ) : ?>
						<style>
						#<?php echo $block_id; ?>.dgwltd-block--feature:before {
							display: block;
							z-index: 2;
							content: '';
							position: absolute;
							top: 0;
							right: 0;
							bottom: 0;
							left: 0;
							background-color: <?php echo $overlay; ?>;
							opacity:0.8;
						}
						#<?php echo $block_id; ?>.dgwltd-block--feature .block__background img {
							filter: grayscale(100%) contrast(200%);
						}
						</style>
					<?php endif; ?>
					<div class="block__background">
						<figure>
						<picture>
							<source media="(min-width: 900px)" srcset="<?php echo $imageLarge; ?>">
							<img src="<?php echo $image_small; ?>" width="<?php echo $image_small_width; ?>" height="<?php echo $image_small_height; ?>" alt="" loading="lazy" style="background-image: url(<?php echo $base64; ?>)" />
						</picture>
						</figure>
					</div>
				<?php endif; ?>
				
			<?php endif; ?>    

			<div class="dgwltd-feature__wrapper">
				<div class="dgwltd-feature__inner">   

				<div class="dgwltd-feature__content">
					<InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" template="<?php echo esc_attr( wp_json_encode( $block_template ) ); ?>" />
				</div>
				
				</div>
			</div>

</div>
