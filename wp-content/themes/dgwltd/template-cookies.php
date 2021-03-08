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
				Success
				</h2>
			</div>
			<div class="govuk-notification-banner__content">
				<p class="govuk-notification-banner__heading">
				You’ve set your cookie preferences.
				</p>
			</div>
			</div>

			<?php 
			// if(dgwltd_cookie_var('functional')) { echo 'functional'; }
			// if(dgwltd_cookie_var('analytics')) { echo 'analytics'; }
			?>
			
			<div class="govuk-grid-row">
				<div class="govuk-grid-column-two-thirds">
					<h2 class="govuk-heading-l">Change your cookie settings</h2>
					<form action="<?php echo get_permalink(); ?>" method="post" novalidate id="cookies_form">

					<div class="govuk-form-group">
						<fieldset class="govuk-fieldset">
						<legend class="govuk-fieldset__legend govuk-fieldset__legend--s">
							Do you want to accept functional cookies?
						</legend>
						<div class="govuk-radios">
							<div class="govuk-radios__item">
							<input class="govuk-radios__input" id="functional-cookies" name="cookies-functional" type="radio" value="yes">
							<label class="govuk-label govuk-radios__label" for="functional-cookies">
								Yes
							</label>
							</div>
							<div class="govuk-radios__item">
							<input class="govuk-radios__input" id="functional-cookies-2" name="cookies-functional" type="radio" value="no" checked>
							<label class="govuk-label govuk-radios__label" for="functional-cookies-2">
								No
							</label>
							</div>
						</div>

						</fieldset>
					</div>

					<div class="govuk-form-group">
						<fieldset class="govuk-fieldset">
						<legend class="govuk-fieldset__legend govuk-fieldset__legend--s">
							Do you want to accept analytics cookies?
						</legend>
						<div class="govuk-radios">
							<div class="govuk-radios__item">
							<input class="govuk-radios__input" id="analytics-cookies" name="cookies-analytics" type="radio" value="yes">
							<label class="govuk-label govuk-radios__label" for="analytics-cookies">
								Yes
							</label>
							</div>
							<div class="govuk-radios__item">
							<input class="govuk-radios__input" id="analytics-cookies-2" name="cookies-analytics" type="radio" value="no" checked>
							<label class="govuk-label govuk-radios__label" for="analytics-cookies-2">
								No
							</label>
							</div>
						</div>

						</fieldset>
					</div>

					<button class="govuk-button" data-module="govuk-button">
						Save cookie settings
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
