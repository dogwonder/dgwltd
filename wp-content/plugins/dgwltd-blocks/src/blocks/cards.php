<?php
/**
 * Details Cards Template.
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
$class_name = 'dgwltd-block dgwltd-block--cards';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

// Content & Layout
$cards        = get_field( 'cards' ) ? : '';
$cards_manual = get_field( 'cards_manual' ) ? : '';
$cards_type   = get_field( 'cards_type' ) ? : '';

// Block options
$heading_type = get_field( 'heading_type' ) ? : '';
$reversed     = get_field( 'reversed' ) ? : '';
$inverse      = get_field( 'inverse' ) ? : '';

// Count the cards
if ( $cards_type == 'relationship' && ! empty( $cards ) ) :
	$cards_count = count( $cards ) ? 'dgwltd-cards-' . count( $cards ) : '0';
elseif ( $cards_type == 'manual' && ! empty( $cards_manual ) ) :
	$cards_count = count( $cards_manual ) ? 'dgwltd-cards-' . count( $cards_manual ) : '0';
else :
	$cards_count = '0';
endif;

// Classes
$block_classes = array( $class_name, $cards_count );

// Card index
$card_index = 0;

// JSX Innerblocks - https://www.billerickson.net/innerblocks-with-acf-blocks/
$allowed_blocks = array( 'core/heading', 'core/paragraph' );
$block_template = array(
	array(
		'core/heading',
		array(
			'level'       => 1,
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
<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( implode( ' ', $block_classes ) ); ?>">

	<InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" template="<?php echo esc_attr( wp_json_encode( $block_template ) ); ?>" />

	<div class="dgwltd-block--cards_inner">
  
	<?php if ( $cards_type == 'relationship' ) : ?>
		<?php
		if ( $cards ) :
			?>
			<?php foreach ( $cards as $card ) : ?>
				<?php // print_r($card) ?>
				<?php $card_index++; ?>
				<?php include locate_template( 'template-parts/_organisms/card-id.php' ); ?>
	<?php endforeach; ?>
			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
		<?php endif; ?>

	<?php elseif ( $cards_type == 'manual' ) : ?>
		<?php
		if ( ! empty( $cards_manual ) ) :
			// check if the repeater field has rows of data
			if ( have_rows( 'cards_manual' ) ) :
				// loop through the rows of data
				while ( have_rows( 'cards_manual' ) ) :
					the_row();
					?>
					<?php $card_index++; ?>
					<?php include locate_template( 'template-parts/_organisms/card-manual.php' ); ?>
					<?php
				endwhile;
		endif;
			?>
		<?php endif; ?>

	<?php endif; // end cards type check ?>
	</div>
</div>
