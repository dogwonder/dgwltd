<?php

/**
 * Template part for displaying cards
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dgwltd
 */
?>
<div class="dgwltd-card<?php echo ( has_post_thumbnail() ? ' has-image' : '' ); ?>">
	<a class="dgwltd-card__link-wrapper" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) { ?>
			<?php
			the_post_thumbnail(
				'dgwltd-medium',
				array(
					'alt'   => the_title_attribute(
						array(
							'echo' => false,
						)
					),
					'class' => 'dgwltd-card__image',
				)
			);
			?>
		<?php } ?>
		<div class="dgwltd-card__content">
			<h2 class="dgwltd-card__heading"><?php the_title(); ?></h2>
			<div class="dgwltd-card__description">
			<?php
			// Display the excerpt is exists
			if ( has_excerpt( $post->ID ) ) {
				echo get_the_excerpt( $post->ID );
			} else {
				echo dgwltd_standfirst( 30, $post->ID );
			}
			?>
			</div>
		</div>
	</a>
</div>
