<div id="cookieNotice" class="cookie-notice" role="region" aria-label="cookie banner">
    <noscript>
    <style>
    #cookieNotice {display:block;}
    #cookieButton {display:none;}
    </style>
    </noscript>
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
    <div class="cookie-notice__buttons">
    <button id="cookieButton" class="dgwltd-button" type="button" aria-label="Accept cookies and close notice">
        <?php esc_html_e('Accept and close', 'dgwltd') ?>
    </button>
    </div>
    </div>
</div>