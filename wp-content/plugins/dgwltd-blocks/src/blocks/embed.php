<?php 
/**
 * Lite Embed Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// function dgwltd_parse_video_uri( $url ) {
		
//     // Parse the url 
//     $parse = parse_url( $url );
    
//     // Set blank variables
//     $video_type = '';
//     $video_id = '';
    
//     // Url is http://youtu.be/xxxx
//     if ( isset( $parse['host'] ) && $parse['host'] == 'youtu.be' ) {
    
//         $video_type = 'youtube';
//         $video_id = ltrim( $parse['path'],'/' );	
        
//     }
    
//     // Url is http://www.youtube.com/watch?v=xxxx 
//     // or http://www.youtube.com/watch?feature=player_embedded&v=xxx
//     // or http://www.youtube.com/embed/xxxx
//     if ( isset( $parse['host'] ) && ( $parse['host'] == 'youtube.com' ) || isset( $parse['host'] ) && ( $parse['host'] == 'www.youtube.com' ) ) {
    
//         $video_type = 'youtube';
        
//         parse_str( $parse['query'], $output  );

//         // print_r($output);
        
//         $video_id = $output['v'];	
        
//         if ( !empty( $feature ) )
//             $video_id = end( explode( 'v=', $parse['query'] ) );
            
//         if ( strpos( $parse['path'], 'embed' ) == 1 )
//             $video_id = end( explode( '/', $parse['path'] ) );
        
//     }
    
//     // Url is http://www.vimeo.com
//     if ( isset( $parse['host'] ) && ( $parse['host'] == 'vimeo.com' ) || isset( $parse['host'] ) && ( $parse['host'] == 'www.vimeo.com' ) ) {
    
//         $video_type = 'vimeo';
        
//         $video_id = ltrim( $parse['path'],'/' );	
                    
//     }

//     // If recognised type return video array
//     if ( !empty( $video_type ) ) {
    
//         $video_array = array(
//             'type' => $video_type,
//             'id' => $video_id
//         );
    
//         return $video_array;
        
//     } else {
    
//         return false;
        
//     }
// }

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}
// Create class attribute allowing for custom "className"
$className = 'dgwltd-block dgwltd-block--embed';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$embed = get_field('embed', false, false) ? : '';
$v = Dgwltd_Blocks_Public::dgwltd_parse_video_uri( $embed ); 
$vid = $v['id'];
//Classes
$block_classes = array($className);
?>
 <div id="<?php echo $id; ?>" class="<?php echo esc_attr(implode(" ", $block_classes)); ?>">
    <div class="dgwltd-embed__inner">
            <div class="dgwltd-embed__content">
                <?php if($v['type'] == 'youtube') : ?>
                <lite-youtube videoid="<?php echo $vid; ?>"></lite-youtube>    
                <?php elseif ($v['type'] == 'vimeo') : ?>
                <lite-vimeo videoid="<?php echo $vid; ?>"></lite-vimeo>
                <?php else : ?>
                <?php the_field('embed'); ?>
                <?php endif; ?>
            </div>
        </div>
 </div>