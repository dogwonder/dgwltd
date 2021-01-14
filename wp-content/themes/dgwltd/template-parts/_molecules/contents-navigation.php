<?php
//Get current post
$currentpostID = $post->ID;  

//Post parent ID (which can be 0 if there is no parent);
$parent = wp_get_post_parent_id( $currentpostID );

//Check the page template so we can ignore stray parents
$page_template = get_page_template_slug( $parent );

if($page_template !== 'template-guide.php') :
    $parentID = $post->ID;
else : 
    $parentID = $parent;
endif;

if ($parent) :

    //Get all the children of the parent based on menu order
    $childpages = get_pages( array(
        'child_of' => $parentID, 
        'sort_column' => 'menu_order',
        'sort_order' => 'asc', 
        'posts_per_page' 	=> -1, 
    ));

    //Get the child page IDs and add the parent to the beginning
    $childrenIds = wp_list_pluck( $childpages, 'ID' );
    $ids = array_merge(array($parent), $childrenIds);

else :

    //Get all the children of this page based on menu order
    $childpages = get_pages( array(
        'child_of' => $post->ID,
        'sort_column' => 'menu_order',
        'sort_order' => 'asc', 
        'posts_per_page' 	=> -1, 
    ));

    //Get the child page IDs
    $childrenIds = wp_list_pluck( $childpages, 'ID' );
    $ids = $childrenIds;

endif;

if (is_page() && count( $childpages ) > 0) :
    
//Now get all the pages
$args = array(
    'include' => $ids,
    'sort_column' => 'menu_order',
    'sort_order' => 'asc', 
    'posts_per_page' 	=> -1, 
);
$pages = get_pages($args);

//Include the parent ID
$pageIds = wp_list_pluck( $pages, 'ID' );

//Get current index
$current = array_search( get_the_ID(), $pageIds );

//Get next and prev IDs for child pages
if ($parent) :
    //If the parent is not a guide template that don't link to it
    if($page_template == 'template-guide.php') :
    $prevId = ( isset($pageIds[$current-1]) ) ? $pageIds[$current-1] : '';
    else :
    $prevId = '';    
    endif;
    $nextId = ( isset($pageIds[$current+1]) ) ? $pageIds[$current+1] : '';
else :
    //We dont have a previous as this is a parent
    $prevId = '';
    $nextId = ( isset($pageIds[$current]) ) ? $pageIds[$current] : '';
endif;
?>
<nav class="dgwltd-pagination dgwltd-pagination--pages<?php echo (empty($prevId) ? ' dgwltd-pagination--noprev' : ''); ?><?php echo (empty($nextId) ? ' dgwltd-pagination--nonext' : ''); ?>" aria-label="Pagination">
    <ul class="dgwltd-pagination__list">

    <?php if (!empty($prevId)) : ?>
        <li class="dgwltd-pagination__item dgwltd-pagination__item--previous">
        <a href="<?php echo get_permalink($prevId); ?>" class="dgwltd-pagination__link" rel="prev">
            <span class="dgwltd-pagination__link-title">
            <svg class="dgwltd-pagination__link-icon" xmlns="http://www.w3.org/2000/svg" height="13" width="17" viewBox="0 0 17 13">
              <path d="m6.5938-0.0078125-6.7266 6.7266 6.7441 6.4062 1.377-1.449-4.1856-3.9768h12.896v-2h-12.984l4.2931-4.293-1.414-1.414z"></path>
            </svg>
            <span class="dgwltd-pagination__link-text">
            <?php esc_html_e('Previous page', 'rnid') ?>
            </span>
            </span>
            <span class="visually-hidden">:</span>
            <?php if ($parent) : ?>
            <span class="dgwltd-pagination__link-label">
                <?php 
                if(get_field('overide_title', $prevId)) : 
                    echo get_field('overide_title', $prevId); 
                else : 
                    echo get_the_title( $prevId );
                endif; 
                 ?>
            </span>
            <?php endif; ?>
		</a>
        </li>
    <?php endif; ?>
   
    <?php if (!empty($nextId)) : ?>
        <li class="dgwltd-pagination__item dgwltd-pagination__item--next" rel="next">
        <a href="<?php echo get_permalink($nextId); ?>" class="dgwltd-pagination__link">
            <span class="dgwltd-pagination__link-title">
            <svg class="dgwltd-pagination__link-icon" xmlns="http://www.w3.org/2000/svg" height="13" width="17" viewBox="0 0 17 13">
              <path d="m10.107-0.0078125-1.4136 1.414 4.2926 4.293h-12.986v2h12.896l-4.1855 3.9766 1.377 1.4492 6.7441-6.4062-6.7246-6.7266z"></path>
            </svg>
            <span class="dgwltd-pagination__link-text">
            <?php esc_html_e('Next page', 'rnid') ?>
            </span>
            </span>
             <span class="visually-hidden">:</span>
		     <span class="dgwltd-pagination__link-label">
                <?php echo get_the_title( $nextId ); ?>
             </span>
		</a>
        </li>
    <?php endif; ?>
    </ul>
</nav>
<?php endif; ?>