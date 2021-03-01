<?php
// Get current post
$currentpost_id = $post->ID;

// Post parent ID (which can be 0 if there is no parent)
$parent = wp_get_post_parent_id( $currentpost_id );

// Check the page template so we can ignore stray parents
$page_template = get_page_template_slug( $parent );

// If the parent page is NOT a guide template then we want the current ID // Title
if ( $page_template !== 'template-guide.php' ) :

	$parent_id  = $post->ID;
	$page_title = esc_html( get_the_title( $post->ID ) );

else :

	// Parent ID is the parent's ID
	$parent_id  = $parent;
	$page_title = esc_html( get_the_title( $parent ) );

endif;

// If we are on a parent page
if ( $parent ) :

	$childpages = get_pages(
		array(
			'child_of'       => $parent_id,
			'sort_column'    => 'menu_order',
			'sort_order'     => 'asc',
			'posts_per_page' => -1,
		)
	);

	// Get the child page IDs
	$children_ids = wp_list_pluck( $childpages, 'ID' );
	$ids          = $children_ids;

	// Otherwise get the children on the current page
else :

	$childpages = get_pages(
		array(
			'child_of'       => $post->ID,
			'sort_column'    => 'menu_order',
			'sort_order'     => 'asc',
			'posts_per_page' => -1,
		)
	);

	// Get the child page IDs
	$children_ids = wp_list_pluck( $childpages, 'ID' );
	$ids          = $children_ids;

endif;

if ( $children_ids ) : ?>

	<aside class="dgwltd-navigation-container" role="complementary">
	<nav class="dgwltd-contents-list dgwltd-contents-list--pages" aria-label="Pages in this section" role="navigation">
		<h4 class="dgwltd-contents-list__title"><?php esc_html_e( 'Contents', 'dgwltd' ); ?></h4>
		<ol class="dgwltd-contents-list__list">

			<?php // First get the parent title if it exists and if parent remove link ?>
			<li class="page_item<?php echo ( $parent_id === 0 || $parent_id === $post->ID ? ' current_page_item' : '' ); ?>"<?php echo ( $post->ID === $currentpost_id ? ' aria-current="page"' : '' ); ?>>
										   <?php
											if ( $parent_id === $currentpost_id ) :
												?>
												<?php echo $page_title; ?>
												<?php
else :
	?>
				<a href="<?php echo esc_url( get_permalink( $parent ) ); ?>"><?php echo $page_title; ?></a><?php endif; ?></li>

			<?php
			// Now get all the children of the parent // current page
			$child_args = array(
				'post_type'      => 'page',
				'post__in'       => $children_ids,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'posts_per_page' => -1,
			);
			?>

			<?php $childpages_query = new WP_Query( $child_args ); ?>
			
			<?php if ( $childpages_query->have_posts() ) : ?>
				<?php
				while ( $childpages_query->have_posts() ) :
					$childpages_query->the_post();
					?>
					<?php // $current = array_search( $post->ID, $children_ids ); ?>
					<?php // echo $current ?>
					<?php $child_title = esc_html( get_the_title( $post->ID ) ); ?>
				<li class="page_item<?php echo ( $post->ID === $currentpost_id ? ' current_page_item' : '' ); ?>"<?php echo ( $post->ID === $currentpost_id ? ' aria-current="page"' : '' ); ?>><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo $child_title; ?></a></li>
			<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
			<?php wp_reset_query(); // results query ?>

		</ol>
	</nav>
	</aside>
<?php endif; ?>
