<div id="cookieNotice" class="cookie-notice" role="region" aria-label="cookie banner">
    <noscript>
    <style>
    #cookieNotice {display:block;}
    #cookieButton {display:none;}
    </style>
    </noscript>
    <?php 
    if (class_exists('acf') && get_field('cookie_notice_text', 'options')) :
        echo get_field('cookie_notice_text', 'options');
    else : ?>
    <div class="cookie-notice__content">
    <p class="cookie-notice__text">
        <?php
        $cookieUrl = '<a href="' . esc_url(home_url('/cookie-policy/')) . '">' . __('our cookie statement', 'dgwltd') . '</a>';
        printf(
            esc_html__('We use cookies to give you the best experience, read %s.', 'dgwltd'),
            $cookieUrl
        );
        ?>
    </p>
    <?php endif; ?>
    <div class="cookie-notice__buttons">
    <?php 
    if (class_exists('acf') && get_field('cookie_notice_button_text', 'options')) : ?>
    <button id="cookieButton" class="dgwltd-button" type="button">
        <?php echo get_field('cookie_notice_button_text', 'options'); ?>
    </button>
    <?php else : ?>
    <button id="cookieButton" class="dgwltd-button" type="button" aria-label="Accept cookies and close notice">
        <?php esc_html_e('Accept and close', 'dgwltd') ?>
    </button>
    <?php endif; ?>
    </div>
    </div>
</div>