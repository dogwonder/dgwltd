<?php 
/**
 * Accordion Block Template.
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
$className = 'dgwltd-block dgwltd-block--accordion';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

//Classes
$block_classes = array($className);

//Block fields
$accordionSections = get_field('accordion_sections') ? : '';
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr(implode(" ", $block_classes)); ?>">
        
    <div class="govuk-accordion" data-module="govuk-accordion" id="accordion-default">
    <?php if( have_rows('accordion_sections') ): while ( have_rows('accordion_sections') ) : the_row();  ?>
    <?php //print_r($accordionSections); ?>
    <?php 
    $accordionSectionHeading = get_sub_field('heading') ? : '';
    $accordionSectionContent = get_sub_field('content') ? : '';
    ?>
      <div class="govuk-accordion__section">
        <div class="govuk-accordion__section-header">
        <h4 class="govuk-accordion__section-heading">
            <?php if(!empty($accordionSectionHeading)) : ?>
              <span class="govuk-accordion__section-button" id="accordion-default-heading-<?php echo get_row_index(); ?>">
                <?php echo $accordionSectionHeading; ?>
              </span>
            <?php endif; ?>
        </h4>
        </div>
        <div id="accordion-default-content-<?php echo get_row_index(); ?>" class="govuk-accordion__section-content" aria-labelledby="accordion-default-heading-1" role="region">
            <?php if(!empty($accordionSectionContent)) : ?>
                <?php echo $accordionSectionContent; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php endwhile; endif; ?>   
    </div>
</div>