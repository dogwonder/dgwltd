<?php 
//Get current post

$currentpostID = $post->ID;

//get ancestors of current post
$ancestors = get_post_ancestors( $post->ID );

//Post parent ID (which can be 0 if there is no parent)
$parent = wp_get_post_parent_id( $currentpostID );

//Lets set if there is a grandparent
if( ! empty( $parent ) ) :
    $grandparent = wp_get_post_parent_id( $parent );
else :
    //No parent
    $grandparent = 0;
endif;
?>

<div class="govuk-breadcrumbs">
	<ol class="govuk-breadcrumbs__list">

		<li class="govuk-breadcrumbs__list-item">
		    <a class="govuk-breadcrumbs__link" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'rnid') ?></a>
        </li>

        <?php if(is_page() && $parent > 0) : ?>
        <?php 
            //Get all ancestors and loop through them in reverse order
            $ancestorPages = array_reverse($ancestors);
            foreach ( $ancestorPages as $ancestor ) { ?>
            <li class="govuk-breadcrumbs__list-item">
            <a class="govuk-breadcrumbs__link" href="<?php echo get_permalink( $ancestor ) ?>">
            <?php 
                //get the title or the override title
                if(get_field('breadcrumb_title', $ancestor)) :
                    echo get_field('breadcrumb_title', $ancestor);
                else :
                    echo get_the_title( $ancestor);
                endif;
                ?>
            </a>
            </li>
        <?php } ?>
        
        <?php wp_reset_query(); //results query  ?>
        <?php endif; ?>

        <?php if(!is_front_page()) : ?>
            <li class="govuk-breadcrumbs__list-item" aria-current="page">
            <?php if(is_search()) : ?>
                <?php esc_html_e('Search results', 'rnid' ); ?>    
            <?php elseif(is_404()) : ?>
                <?php esc_html_e('404, page not found', 'rnid' ); ?>
            <?php elseif (is_category()) : ?>
                <?php single_cat_title(); ?>
            <?php elseif (is_tag()) : ?>
                <?php single_tag_title(); ?>
            <?php elseif(is_page() || is_single()) : ?>
                <?php 
                //get the title or the override title
                if(get_field('breadcrumb_title', $post->ID)) :
                    echo get_field('breadcrumb_title', $post->ID);
                else :
                    echo get_the_title($post->ID);
                endif;
                ?>
            <?php endif; ?>
            </li>
        <?php endif; ?>
	</ol>
</div>