<?php 
/**
 * Feature Block Template.
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
$className = 'dgwltd-block dgwltd-block--feature';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
//Random ID
$rand = substr(md5(microtime()),rand(0,26),5);

//Block Fields
$image = get_field('background_image') ? : '';
$overlay = get_field('overlay') ? : '';
$parallax = get_field('parallax') ? : '';

//Classes
$block_image = $image ? 'has-image ' : '';
$block_overlay = $overlay ? 'has-overlay ' : '';
$block_parallax = $parallax ? 'is-parallax ' : '';
$block_classes = array($className, $block_image, $block_overlay, $block_parallax);

/*
NEEDS PARALAX
NEEDS OVERLAY
*/

//JSX Innerblocks - https://www.billerickson.net/innerblocks-with-acf-blocks/
$allowed_blocks = array( 'core/heading', 'core/paragraph', 'core/button' );
$block_template = array(
    array('core/heading', array(
		'level' => 3,
		'placeholder' => 'Add lede...',
	)),
	array('core/heading', array(
		'level' => 2,
		'placeholder' => 'Add title...',
	)),
    array( 'core/paragraph', array(
        'placeholder' => 'Add content...',
    ) )
);
?>

<?php 
//Is the AMP plugin enabled if so get the dominant color for the image and set it as a background color
if(function_exists('amp_is_request') && amp_is_request()) : 
    $i = imagecreatefromjpeg($image['sizes']['dgwltd-small']); 
    for ($x=0;$x<imagesx($i);$x++) {
        for ($y=0;$y<imagesy($i);$y++) {
            $rgb = imagecolorat($i,$x,$y);
            $r   = ($rgb >> 16) & 0xFF;
            $g   = ($rgb >> 8) & 0xFF;
            $b   = $rgb & 0xFF;
            $rTotal += $r;
            $gTotal += $g;
            $bTotal += $b;
            $total++;
        }
    }
    $rAverage = round($rTotal/$total);
    $gAverage = round($gTotal/$total);
    $bAverage = round($bTotal/$total);
    $hasrgb = true;
else :
    $hasrgb = false;
endif; ?>

 <div id="<?php echo $id; ?>" class="<?php echo esc_attr(implode(" ", $block_classes)); ?>"<?php echo $rgb = $hasrgb ? ' style="background-color:rgb('. $rAverage . ',' . $gAverage . ',' . $bAverage . ')"' : ''; ?>>

            <?php if( !empty( $image ) ) : ?>
                <?php //print_r($image) ?>
                <?php 
                $imageSmall = $image['sizes']['dgwltd-medium']; 
                $imageLarge = $image['sizes']['dgwltd-large']; 
                $imageAlt =  esc_attr($image['alt']); 
                $imageWidth = esc_attr($image['width']);  
                $imageHeight = esc_attr($image['height']);
                $imageSmallWidth = esc_attr($image['sizes'][ 'dgwltd-medium-width' ]);    
                $imageSmallHeight = esc_attr($image['sizes'][ 'dgwltd-medium-height' ]); 
                ?>
                <?php if($block_parallax) : ?>
                <style>
                    #<?php echo $id; ?>.dgwltd-block--feature {
                        background: url('<?php echo $imageSmall; ?>') no-repeat fixed;
                        background-size: cover;
                        background-position: center center;
                        width: 100%;
                    }
                    @media only screen and (min-width: 641px) {
                        #<?php echo $id; ?>.dgwltd-block--feature {
                            background-image:url('<?php echo $imageLarge; ?>');
                        }
                    }
                    <?php if($block_overlay) : ?>
                    #<?php echo $id; ?>.dgwltd-block--feature:before {
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
                    <?php if($block_overlay) : ?>
                        <style>
                        #<?php echo $id; ?>.dgwltd-block--feature:before {
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
                        #<?php echo $id; ?>.dgwltd-block--feature .block__background img {
                            filter: grayscale(100%) contrast(200%);
                        }
                        
                        </style>
                    <?php endif; ?>
                    <div class="block__background">
                        <figure>
                        <picture>
                            <source media="(min-width: 900px)" srcset="<?php echo $imageLarge; ?>">
                            <img src="<?php echo $imageSmall; ?>" alt="" loading="lazy" />
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