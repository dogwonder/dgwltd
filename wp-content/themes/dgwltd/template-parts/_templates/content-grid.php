<?php

/**
 * Template part for displaying grid items
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dgwltd
 */
?>
<?php 
if (class_exists('acf')) {
    $title = get_field('title');
}
?>
<div class="dgwltd-grid__item">
    <div id="post-<?php the_ID(); ?>" class="dgwltd-bio">		

        <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
        <?php if(has_post_thumbnail()) { ?>
            <?php
            the_post_thumbnail('dgwltd-medium', array(
                'alt' => the_title_attribute(array(
                    'echo' => false,
                )),
            ));
            ?>
        <?php } else { ?>
            <img src="<?php echo get_template_directory_uri(); ?>/dist/images/placeholder.png" alt="Associate placeholder image" loading="lazy">
        <?php } ?>
        </a>
        <div class="dgwltd-bio__deets">
            <h2 class="dgwltd-bio__name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php if(!empty($title)) : ?>
            <h3 class="dgwltd-bio__title"><?php echo $title; ?></h3>
            <?php endif; ?>
        </div><!-- .deets-->
    </div><!-- .bio-->
</div>