<?php

/**
 * Template part for displaying cards - based on ID variable
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dgwltd
 */
?>
<?php
$image             = wp_get_attachment_image_url( get_post_thumbnail_id( $card->ID ), 'dgwltd-small' );
$image_medium      = wp_get_attachment_image_url( get_post_thumbnail_id( $card->ID ), 'dgwltd-medium' );
$image_alt         = get_post_meta( get_post_thumbnail_id( $card->ID ), '_wp_attachment_image_alt', true );
$image_placeholder = get_template_directory_uri() . '/dist/images/placeholder.png';

$dgwltd_tags = get_the_terms( $card->ID, 'category' );

// print_r($pdTags);
if ( ! empty( $dgwltd_tags ) ) {
	$first_tag    = reset( $dgwltd_tags );
	$term_display = $first_tag->name;
	$term_link    = get_category_link( $first_tag->term_id );
} else {
	$category_display = '';
	$term_display     = '';
}
?>
<div class="dgwltd-card<?php echo ( has_post_thumbnail( $card->ID ) ? ' has-image' : '' ); ?> card-<?php echo $card_index; ?>" data-url="<?php echo esc_url( get_permalink( $card->ID ) ); ?>" data-theme="<?php echo ( $inverse ? 'light' : 'dark' ); ?>"<?php echo ( $reversed ? ' data-state="reversed"' : '' ); ?>> 
	<div class="dgwltd-card__inner">
	
		<?php if ( $has_image ) : ?>
		<figure class="dgwltd-card__image">
		  <picture class="frame">
			<?php if ( has_post_thumbnail( $card->ID ) ) { ?>
			<source media="(min-width: 769px)" srcset="<?php echo ( $image_medium ? $image_medium : $image ); ?>">
			<img src="<?php echo $image; ?>" alt="<?php echo ( $image_alt ? $image_alt : '' ); ?>" loading="lazy" />
			<?php } else { ?>
			<source media="(min-width: 769px)" srcset="<?php echo $image_placeholder; ?>">
			<img src="<?php echo $image_placeholder; ?>" alt="" loading="lazy" />
			<?php } ?>
		  </picture>
		</figure>
		<?php endif; ?>
		
		<div class="dgwltd-card__content">
			<?php if ( ! empty( $term_display ) ) { ?>
				<?php
				if ( ! empty( $term_link ) ) {
					?>
					<span class="dgwltd-card__caption"><a href="<?php echo esc_attr( $term_link ); ?>"><?php echo esc_attr( $term_display ); ?></a></span>
					<?php
				} else {
					?>
					<span class="dgwltd-card__caption"><?php echo esc_attr( $term_display ); ?></span>
					<?php
				}
			}
			?>

			<h3 class="dgwltd-card__heading"><a href="<?php echo esc_url( get_permalink( $card->ID ) ); ?>"><?php echo esc_html( get_the_title( $card->ID ) ); ?></a></h3>
			
			<div class="dgwltd-card__description">
			<?php
			// Display the excerpt is exists
			if ( has_excerpt( $card->ID ) ) {
				echo esc_html( get_the_excerpt( $card->ID ) );
			} else {
				echo esc_html( dgwltd_standfirst( 20, $card->ID ) );
			}
			?>
			</div>
		</div>
	</div>
</div>
