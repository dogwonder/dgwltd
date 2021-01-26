<?php 
/**
 * Details Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className"
$className = 'dgwltd-block dgwltd-block--details';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
$summary = get_field('summary') ? : '';
$details = get_field('details') ? : '';
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
  <details class="govuk-details" data-module="govuk-details">
    <summary class="govuk-details__summary">
    <?php if( !empty( $summary ) ) : ?>
      <span class="govuk-details__summary-text">
        <?php echo $summary; ?>    
      </span>
    <?php endif; ?>
    </summary>
    <?php if( !empty( $details ) ) : ?>
    <div class="govuk-details__text">
      <?php echo $details; ?>
    </div>
    <?php endif; ?>
  </details>
</div>