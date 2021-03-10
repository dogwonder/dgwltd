<?php
/**
 * Template Name: Cookie settings page
 *
 * The template for displaying the cookie settings
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dgwltd
 */

get_header();
?>
<div id="primary" class="govuk-width-container">

	<?php get_template_part( 'template-parts/_molecules/breadcrumb' ); ?>

	<div class="govuk-main-wrapper">
	
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="govuk-notification-banner govuk-notification-banner--success" role="alert" aria-labelledby="govuk-notification-banner-title" data-module="govuk-notification-banner" style="display: none;">
			<div class="govuk-notification-banner__header">
				<h2 class="govuk-notification-banner__title" id="govuk-notification-banner-title">
				<?php esc_html_e( 'Success', 'dgwltd' ); ?>
				</h2>
			</div>
			<div class="govuk-notification-banner__content">
				<p class="govuk-notification-banner__heading">
				<?php esc_html_e( 'You’ve set your cookie preferences.', 'dgwltd' ); ?>
				</p>
			</div>
			</div>
			
			<div class="govuk-grid-row">
				<div class="govuk-grid-column-two-thirds">
					<h2 class="govuk-heading-l"><?php esc_html_e( 'Change your cookie settings', 'dgwltd' ); ?></h2>
					<form action="<?php echo get_permalink(); ?>" method="post" novalidate id="cookies_form">

					<div class="govuk-form-group">
						<fieldset class="govuk-fieldset">
						<legend class="govuk-fieldset__legend govuk-fieldset__legend--s">
							<?php esc_html_e( 'Do you want to accept functional cookies?', 'dgwltd' ); ?>
						</legend>
						<div class="govuk-radios">
							<div class="govuk-radios__item">
							<input class="govuk-radios__input" id="functional-cookies" name="cookies-functional" type="radio" value="yes">
							<label class="govuk-label govuk-radios__label" for="functional-cookies">
								<?php esc_html_e( 'Yes', 'dgwltd' ); ?>
							</label>
							</div>
							<div class="govuk-radios__item">
							<input class="govuk-radios__input" id="functional-cookies-2" name="cookies-functional" type="radio" value="no" checked>
							<label class="govuk-label govuk-radios__label" for="functional-cookies-2">
								<?php esc_html_e( 'No', 'dgwltd' ); ?>
							</label>
							</div>
						</div>

						</fieldset>
					</div>

					<div class="govuk-form-group">
						<fieldset class="govuk-fieldset">
						<legend class="govuk-fieldset__legend govuk-fieldset__legend--s">
							<?php esc_html_e( 'Do you want to accept performance cookies?', 'dgwltd' ); ?>
						</legend>
						<div class="govuk-radios">
							<div class="govuk-radios__item">
							<input class="govuk-radios__input" id="performance-cookies" name="cookies-performance" type="radio" value="yes">
							<label class="govuk-label govuk-radios__label" for="performance-cookies">
								<?php esc_html_e( 'Yes', 'dgwltd' ); ?>
							</label>
							</div>
							<div class="govuk-radios__item">
							<input class="govuk-radios__input" id="performance-cookies-2" name="cookies-performance" type="radio" value="no" checked>
							<label class="govuk-label govuk-radios__label" for="performance-cookies-2">
								<?php esc_html_e( 'No', 'dgwltd' ); ?>
							</label>
							</div>
						</div>

						</fieldset>
					</div>

					<div class="govuk-form-group">
						<fieldset class="govuk-fieldset">
						<legend class="govuk-fieldset__legend govuk-fieldset__legend--s">
							<?php esc_html_e( 'Do you want to accept advertising cookies?', 'dgwltd' ); ?>
						</legend>
						<div class="govuk-radios">
							<div class="govuk-radios__item">
							<input class="govuk-radios__input" id="advertising-cookies" name="cookies-advertising" type="radio" value="yes">
							<label class="govuk-label govuk-radios__label" for="advertising-cookies">
								<?php esc_html_e( 'Yes', 'dgwltd' ); ?>
							</label>
							</div>
							<div class="govuk-radios__item">
							<input class="govuk-radios__input" id="advertising-cookies-2" name="cookies-advertising" type="radio" value="no" checked>
							<label class="govuk-label govuk-radios__label" for="advertising-cookies-2">
								<?php esc_html_e( 'No', 'dgwltd' ); ?>
							</label>
							</div>
						</div>

						</fieldset>
					</div>

					<button class="govuk-button" data-module="govuk-button">
						<?php esc_html_e( 'Save cookie settings', 'dgwltd' ); ?>
					</button>
					</form>
				</div>
				</div>

			</article><!-- #post-<?php the_ID(); ?> -->
			</div>
		</div>       
		<?php endwhile; // End of the loop. ?>
<?php
get_footer();
