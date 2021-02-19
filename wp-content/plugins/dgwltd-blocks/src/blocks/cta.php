<?php 
/**
 * CTA Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className"
$className = 'dgwltd-block dgwltd-block--cta';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

//Block fields
$image = get_field('image') ? : '';

//Block options
$reversed = get_field('reversed') ? : '';
$background_color = get_field('background_color') ? : '';
$aspect_ratio = get_field('image_aspect_ratio') ? : '';
//Use if becuase of illegal offset error https://www.craigwilcox.com/acf-illegal-string-offset/
if ( $aspect_ratio ) :
    $x = $aspect_ratio['x'] ? : '4';
    $y = $aspect_ratio['y'] ? : '3';
    $block_aspect_ratio = 'aspect-' . $x . '_' . $y;
else :
    $block_aspect_ratio = '';
endif;

//Classes
$block_color = $background_color ? 'dgwltd-section dgwltd-section--' . $background_color : '';
$block_image = $image ? 'has-image ' : '';
$block_classes = array($className, $block_image, $block_color, $block_aspect_ratio);

//JSX Innerblocks - https://www.billerickson.net/innerblocks-with-acf-blocks/
$allowed_blocks = array( 'core/heading', 'core/paragraph', 'core/button' );
$block_template = array(
	array('core/heading', array(
		'level' => 1,
		'placeholder' => 'Add title...',
	)),
    array( 'core/paragraph', array(
        'placeholder' => 'Add content...',
    ) )
);
?>
<?php if($block_aspect_ratio) : ?>
  <style>
    #<?php echo $id; ?> .dgwltd-cta__image .frame {
        --x: <?php echo $x; ?>;
        --y: <?php echo $y; ?>;
    }
  </style>
<?php endif; ?>
 <div id="<?php echo $id; ?>" class="<?php echo esc_attr(implode(" ", $block_classes)); ?>"<?php echo ($reversed ? ' data-state="reversed"' : ''); ?>>
    <div class="dgwltd-cta__inner">

            <div class="dgwltd-cta__content">
                <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" template="<?php echo esc_attr( wp_json_encode( $block_template ) ); ?>" />
            </div>

             <?php if( !empty( $image ) ) : ?>
                <?php //print_r($image) ?>
                <?php 
                $imageSmall = $image['sizes']['dgwltd-small']; 
                $imageMedium = $image['sizes']['dgwltd-medium']; 
                $imageAlt =  esc_attr($image['alt']); 
                $imageWidth =  esc_attr($image['width']);  
                $imageHeight =  esc_attr($image['height']);  
                ?>
                <figure class="dgwltd-cta__image transform">
                <picture class="frame">
                <source media="(min-width: 769px)" srcset="<?php echo ($imageMedium ?  $imageMedium : $imageSmall); ?>">
                <img src="<?php echo $imageSmall; ?>" alt="<?php echo ($imageAlt ?  $imageAlt : ''); ?>" width="<?php echo $imageWidth ?>" height="<?php echo $imageHeight ?>" loading="lazy" />
                </picture>
                </figure>
            <?php endif; ?>    
        </div>
 </div>