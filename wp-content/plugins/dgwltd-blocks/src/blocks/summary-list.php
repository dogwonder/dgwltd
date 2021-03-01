<?php
/**
 * Summary List Block Template.
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
$class_name = 'dgwltd-block dgwltd-block--summary-list';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
$summary_list = get_field( 'summary_list' ) ? : '';

// Title and Content
$title   = get_field( 'title' ) ? : '';
$content = get_field( 'content' ) ? : '';
?>
<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">

	<?php
	if ( ! empty( $title ) ) :
		?>
		<h2><?php echo $title; ?></h2><?php endif; ?>
	<?php
	if ( ! empty( $content ) ) :
		?>
		<?php echo $content; ?><?php endif; ?>

	<dl class="govuk-summary-list">
		
		<?php
		if ( have_rows( 'summary_list' ) ) :
			while ( have_rows( 'summary_list' ) ) :
				the_row();
				?>
				<?php // print_r($summary_list); ?>
				<?php
				$summary_list_text        = esc_html( get_sub_field( 'term' ) ) ? : '';
				$summary_list_details_type = get_sub_field( 'details_type' ) ? : 'text';
				$summary_list_details     = esc_html( get_sub_field( 'details' ) )? : '';
				$summary_list_details_link = esc_url( get_sub_field( 'details_link' ) ) ? : '';
				$summary_list_details_html = get_sub_field( 'details_embed' )	? : '';
				?>
		<div class="govuk-summary-list__row">
				<?php if ( ! empty( $summary_list_text ) ) : ?>
		<dt class="govuk-summary-list__key">    
					<?php echo $summary_list_text; ?>
		</dt>
		<?php endif; ?>
				<?php if ( $summary_list_details_type === 'html' ) : ?>
					<?php if ( ! empty( $summary_list_details_html ) ) : ?>
			<dd class="govuk-summary-list__value">
						<?php echo $summary_list_details_html; ?>
			</dd>
			<?php endif; ?>
		<?php else : ?>
			<?php if ( ! empty( $summary_list_details ) ) : ?>
			<dd class="govuk-summary-list__value">
				<?php if ( ! empty( $summary_list_details_link ) ) : ?>
				<a href="<?php echo $summary_list_details_link; ?>"><?php echo $summary_list_details; ?></a>
				<?php else : ?>
					<?php echo $summary_list_details; ?>
				<?php endif; ?>
			</dd>
			<?php endif; ?>
		<?php endif; ?>
		
		</div>
					<?php
		endwhile;
endif;
		?>
		   
		
	</dl>
</div>
