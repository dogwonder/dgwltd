<?php

/**
 * Template part for displaying cards - manual selection
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dgwltd
 */
?>
<?php
	$image         = get_sub_field( 'image' );
	$heading       = get_sub_field( 'heading' );
	$description   = get_sub_field( 'description' );
	$link_type     = get_sub_field( 'link_type' ) ? : '';
	$link          = get_sub_field( 'link' );
	$link_external = get_sub_field( 'link_external' );
	$url           = ( $link_type === 'internal' ) ? $link : $link_external;
?>
<div class="dgwltd-card card-<?php echo $cardIndex; ?>" data-theme="<?php echo ( $inverse ? 'light' : 'dark' ); ?>"<?php echo ( $reversed ? ' data-state="reversed"' : '' ); ?>><?php echo ( $url ? ' data-url="' . echo $url . '"' : '' ); ?>
<div class="dgwltd-card__inner">
	<?php if ( ! empty( $image ) ) : ?>
		<?php // print_r($image) ?>
		<?php
		$imageSmall  = $image['sizes']['dgwltd-small'];
		$imageMedium = $image['sizes']['dgwltd-medium'];
		$imageAlt    = esc_attr( $image['alt'] );
		?>
		<figure class="dgwltd-card__image">
		<picture class="frame">
		<source media="(min-width: 769px)" srcset="<?php echo ( $imageMedium ? $imageMedium : $imageSmall ); ?>">
		<img src="<?php echo $imageSmall; ?>" alt="<?php echo ( $imageAlt ? $imageAlt : '' ); ?>" loading="lazy" />
		</picture>
	</figure>
	<?php endif; ?>
	<div class="dgwltd-card__content">
	<?php if ( ! empty( $heading ) ) : ?>
		<?php if ( $heading_type == 'h3' ) : ?>
		<h3 class="dgwltd-card__heading"><?php echo $heading; ?></h3>
		<?php else : ?>
		<h2 class="dgwltd-card__heading"><?php echo $heading; ?></h2>
		<?php endif; ?>
	<?php endif; ?>  
	<?php if ( ! empty( $description ) ) : ?>
		<div class="dgwltd-card__description">
		<?php echo $description; ?>
		</div>
	<?php endif; ?>  
	</div>
</div>
</div>
