<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dgwltd
 */

?>
<article class="no-results not-found">
	<div class="page-header">
		<?php if ( ! empty( $_GET['s'] ) ) : ?>
		<h2 class="govuk-heading-m">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'No results found for %s', 'dgwltd' ), '<span>' . get_search_query() . '</span>' );
			?>
		</h2>
		<?php else : ?>
		<h2 class="govuk-heading-m"><?php esc_html_e( 'No results found', 'dgwltd' ); ?></h2>
		<?php endif; ?>
	</div><!-- .page-header -->

	<div class="page-content">
		<p class="govuk-body"><?php esc_html_e( 'You could try:', 'dgwltd' ); ?></p>
		<ul>
			<li><?php esc_html_e( 'check your spelling', 'dgwltd' ); ?></li>
			<li><?php esc_html_e( 'searching again using other words', 'dgwltd' ); ?></li>
			<li><?php esc_html_e( 'contacting our helpline', 'dgwltd' ); ?></li>
		</ul>
	</div><!-- .page-content -->
</article><!-- .no-results -->
