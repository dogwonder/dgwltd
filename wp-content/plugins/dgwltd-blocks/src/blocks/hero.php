<?php 
/**
 * Hero Block Template.
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
$className = 'dgwltd-block dgwltd-block--hero';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
//Random ID
$rand = substr(md5(microtime()),rand(0,26),5);

//Block Fields
$block_type = get_field('block_type') ? : '';
$image = get_field('background_image') ? : '';
$video = get_field('video', false, false);
$vertical_height = get_field('vertical_height') ? : '';

//Classes
$block_image = $image ? 'has-image ' : '';
$block_video = $video ? 'has-video ' : '';
$block_height = $vertical_height ? 'height--' . $vertical_height : '';
$block_classes = array($className, $block_image, $block_video, $block_height);

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

<div id="<?php echo $id; ?>" class="<?php echo esc_attr(implode(" ", $block_classes)); ?>">

            <?php if( !empty( $image ) && $block_type == "image" ) : ?>
                <?php //print_r($image) ?>
                <?php 
                $imageTiny = $image['sizes']['dgwltd-tiny']; 
                $imageSmall = $image['sizes']['dgwltd-medium']; 
                $imageLarge = $image['sizes']['dgwltd-large']; 
                $imageAlt = esc_attr($image['alt']);  
                $imageWidth = esc_attr($image['width']);  
                $imageHeight = esc_attr($image['height']);  
                $imageSmallWidth = esc_attr($image['sizes'][ 'dgwltd-small-width' ]);    
                $imageSmallHeight = esc_attr($image['sizes'][ 'dgwltd-small-height' ]);
                $type = pathinfo($imageTiny, PATHINFO_EXTENSION);
                $data = file_get_contents($imageTiny);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                ?>
                <link rel="preload" href="<?php echo $imageSmall; ?>" as="image" media="(max-width: 39.6875em)">
                <link rel="preload" href="<?php echo $imageLarge; ?>" as="image" media="(min-width: 40.0625em)">
                <div class="block__background">
                <?php 
                //Is the AMP plugin (https://wordpress.org/plugins/amp/) enabled if so provide a dominant background color based on the image
                if(function_exists('amp_is_request') && amp_is_request()) : ?>
                    <?php 
                        $i = imagecreatefromjpeg($imageSmall); 
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
                    ?>
                    <figure style="background-color:rgb(<?php echo $rAverage; ?>, <?php echo $gAverage; ?>, <?php echo $bAverage; ?>);"></figure>
                <?php else : ?>
                    <figure>
                    <picture>
                        <source media="(min-width: 64em)" srcset="<?php echo $imageLarge; ?>">
                        <img src="<?php echo $imageSmall; ?>" alt="" loading="lazy" width="<?php echo $imageSmallWidth; ?>" height="<?php echo $imageSmallHeight; ?>" style="background-image: url(<?php echo $base64; ?>)" />
                    </picture>
                    </figure>
                <?php endif; ?>    
                </div>
            <?php endif; ?>    

            <div class="dgwltd-hero__wrapper">
                <div class="dgwltd-hero__inner">   

                <div class="dgwltd-hero__content">

                    <InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" template="<?php echo esc_attr( wp_json_encode( $block_template ) ); ?>" />

                    <?php if(!empty( $video ) && $block_type == "video") : ?>
                        <div class="dgwltd-hero__play">
                            <a class="dgwltd-button popup-trigger"  data-popup-trigger="videoModal<?php echo $rand; ?>">
                                <?php esc_html_e('Watch', 'dgwltd' ) ?>            
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
                
                </div>
            </div>

            <?php if(!empty( $video ) && $block_type == "video") : ?>
                <?php 
                    // echo $video;
                    $parse = parse_url( $video );
                    // echo $parse['host'];
                    if ( $parse['host'] == 'youtu.be' ) {
                        $video_type = 'youtube';
                        $video_id = ltrim( $parse['path'],'/' );
                    }
                    if ( ( $parse['host'] == 'youtube.com' ) || ( $parse['host'] == 'www.youtube.com' ) ) {
		
                        $video_type = 'youtube';
                        parse_str( $parse['query'] );
                        $video_id = $v;	
                            
                        if ( strpos( $parse['path'], 'embed' ) == 1 )
                            $video_id = end( explode( '/', $parse['path'] ) );
                        
                    }
                    if ( ( $parse['host'] == 'vimeo.com' ) || ( $parse['host'] == 'www.vimeo.com' ) ) {
                        $video_type = 'vimeo';
			            $video_id = ltrim( $parse['path'],'/' );
                    }
                ?>
                <?php if ( ( $parse['host'] == 'youtube.com' ) || ( $parse['host'] == 'www.youtube.com' ) ) { ?>
                <div class="video-wrapper dgwltd-hero__video">
                <iframe id="youtube_player" src="http://www.youtube.com/embed/<?php echo $video_id; ?>?enablejsapi=1&rel=0&autoplay=1&loop=1&controls=0" frameborder="0" volume="0" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                <script src="//www.youtube.com/player_api"></script>    
                <script type="text/javascript">
                        //youtube api
                        var player;
                        function onYouTubeIframeAPIReady() {
                        player = new YT.Player('youtube_player', {
                            events: {
                            'onStateChange': onPlayerStateChange
                            }
                        });
                        }
                        function onPlayerStateChange() {
                        //...
                        }
                    </script>
                </div>
                <?php } ?>    

                <?php if ( ( $parse['host'] == 'vimeo.com' ) || ( $parse['host'] == 'www.vimeo.com' ) ) { ?>

                <div class="vimeo-wrapper dgwltd-hero__video">
                <iframe id="vimeo_player" src="https://player.vimeo.com/video/<?php echo $video_id; ?>?background=1&muted=1&autoplay=1&loop=1&byline=0&title=0&controls=0" frameborder="0" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                <script src="https://player.vimeo.com/api/player.js"></script>
                </div>
                <?php } ?>

        <?php endif; ?>

 <?php if(!empty( $video ) && $block_type == "video") : ?>

 <div 
  class="popup-modal shadow" 
  data-popup-modal="videoModal<?php echo $rand; ?>"
  role="dialog"
  aria-labelledby="dialog-title"
  aria-modal="true"
  >
  <i class="popup-modal__close" aria-label="Close">
  <svg class="icon" viewBox="0 0 10 10" width="0.75em" height="0.75em" stroke="currentColor" stroke-width="2" role="presentation" focusable="false">
    <path d="M1,1 9,9 M9,1 1,9" />
  </svg>
  </i>
  <h2 id="dialog-title" tabindex="-1"><?php esc_html_e('Play the video', 'dgwltd') ?></h2>
  <?php if ( ( $parse['host'] == 'youtube.com' ) || ( $parse['host'] == 'www.youtube.com' ) ) { ?>
    <iframe id="youtube_player" src="http://www.youtube.com/embed/<?php echo $video_id; ?>" frameborder="0"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
  <?php } ?>
  <?php if ( ( $parse['host'] == 'vimeo.com' ) || ( $parse['host'] == 'www.vimeo.com' ) ) { ?>
    <iframe id="vimeo_player" src="https://player.vimeo.com/video/<?php echo $video_id; ?>" frameborder="0"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
  <?php } ?>
</div>


<script>
 /*
 //https://medium.com/@GistCoding/simple-popup-modal-with-vanilla-javascript-a14515ec630b
*/

 document.addEventListener("DOMContentLoaded", function() {
    const modalTriggers = document.querySelectorAll('.popup-trigger');
    const modalCloseTrigger = document.querySelector('.popup-modal__close');

    modalTriggers.forEach(trigger => {
    trigger.addEventListener('click', () => {
        const { popupTrigger } = trigger.dataset
        const popupModal = document.querySelector(`[data-popup-modal="${popupTrigger}"]`);
        const popupModalTitle = document.querySelector('#dialog-title');

        popupModal.classList.add('is--visible');
        document.body.classList.add('is-blacked-out');

        //allocate focus to the title 
        popupModalTitle.focus();

        popupModal.querySelector('.popup-modal__close').addEventListener('click', () => {
            popupModal.classList.remove('is--visible');
            document.body.classList.remove('is-blacked-out');
            //return focus on trigger
            // trigger.focus();
        });

    })

    })

});
</script>

<?php endif; ?>

</div>