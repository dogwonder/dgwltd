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
		<h2 class="govuk-heading-m">
		<?php esc_html_e( 'No posts found', 'dgwltd' ); ?>
		</h2>
	</div><!-- .page-header -->

	<div class="page-content">
		<p class="govuk-body"><?php esc_html_e( 'We can’t seem to find what you’re looking for. Perhaps searching can help.', 'dgwltd' ); ?></p>
	</div><!-- .page-content -->
</article><!-- .no-results -->