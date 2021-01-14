<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dgwltd
 */

?>

  </main><!-- #content -->

	<footer class="dgwltd-footer govuk-footer">
	<div class="govuk-width-container">   

        <h2 class="govuk-visually-hidden"><?php esc_html_e('Site links', 'dgwltd') ?></h2>
        <?php
        wp_nav_menu(array(
          'theme_location' => 'footer',
          'menu_id' => 'footer-nav',
          'menu_class' => 'dgwltd-footer__list govuk-footer__inline-list',
          'container' => false
        ));
        ?>        

        <h2 class="govuk-visually-hidden"><?php esc_html_e('Social Links', 'dgwltd') ?></h2>
        <?php get_template_part('template-parts/_molecules/social-links'); ?>

        <h2 class="govuk-visually-hidden"><?php esc_html_e('Support links', 'dgwltd') ?></h2>
        <?php
        wp_nav_menu(array(
          'theme_location' => 'legal',
          'menu_id' => 'legal-nav',
          'menu_class' => 'dgwltd-footer__list govuk-footer__inline-list',
          'container' => false
        ));
        ?>

        <span class="govuk-footer__licence-description">© <?php echo date("Y"); ?></span>

    </div>
  </div>

	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/dist/scripts/govuk-frontend-3.5.0.min.js"></script>
<script>window.GOVUKFrontend.initAll()</script>
<script type="module" src="<?php echo get_template_directory_uri(); ?>/dist/scripts/app.js"></script>
<?php /* ?>
<?php include(locate_template('template-parts/_organisms/pswp.php')); ?>
<script src="<?php echo get_template_directory_uri(); ?>/dist/scripts/gallery.js"></script>
<?php */ ?>
</body>
</html>