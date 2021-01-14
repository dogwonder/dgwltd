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
$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className"
$className = 'dgwltd-block dgwltd-block--summary-list';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
$summaryList = get_field('summary_list') ? : '';

//Title and Content
$title = get_field('title') ? : '';
$content = get_field('content') ? : '';
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

    <?php if(!empty($title)) : ?><h2><?php echo $title; ?></h2><?php endif; ?>
    <?php if(!empty($content)) : ?><?php echo $content; ?><?php endif; ?>

    <dl class="govuk-summary-list">
        
        <?php if( have_rows('summary_list') ): while ( have_rows('summary_list') ) : the_row();  ?>
        <?php //print_r($summaryList); ?>
        <?php 
        $summaryListText = get_sub_field('term') ? : '';
        $summaryListDetailsType = get_sub_field('details_type') ? : 'text';
        $summaryListDetails = get_sub_field('details') ? : '';
        $summaryListDetailsLink = get_sub_field('details_link') ? : '';
        $summaryListDetailsHTML = get_sub_field('details_embed') ? : '';
        ?>
        <div class="govuk-summary-list__row">
        <?php if(!empty($summaryListText)) : ?>
        <dt class="govuk-summary-list__key">    
            <?php echo $summaryListText; ?>
        </dt>
        <?php endif; ?>
        <?php if($summaryListDetailsType == "html"): ?>
            <?php if(!empty($summaryListDetailsHTML)) : ?>
            <dd class="govuk-summary-list__value">
                <?php echo $summaryListDetailsHTML; ?>
            </dd>
            <?php endif; ?>
        <?php else : ?>
            <?php if(!empty($summaryListDetails)) : ?>
            <dd class="govuk-summary-list__value">
                <?php if(!empty($summaryListDetailsLink)) : ?>
                <a href="<?php echo $summaryListDetailsLink ?>"><?php echo $summaryListDetails; ?></a>
                <?php else : ?>
                <?php echo $summaryListDetails; ?>
                <?php endif; ?>
            </dd>
            <?php endif; ?>
        <?php endif; ?>
        
        </div>
        <?php endwhile; endif; ?>   
        
    </dl>
</div>