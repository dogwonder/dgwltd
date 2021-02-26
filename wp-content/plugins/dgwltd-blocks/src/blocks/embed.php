<?php 
/**
 * Lite Embed Block Template.
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