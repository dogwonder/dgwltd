<div id="cookieNotice" class="govuk-cookie-banner " role="region" aria-label="<?php printf( esc_html__( 'Cookies on %s.', 'dgwltd' ), get_bloginfo( 'name' ) ); ?>">
  <div class="govuk-cookie-banner__message govuk-width-container">

    <div class="govuk-grid-row">
      <div class="govuk-grid-column-two-thirds">
        <h2 class="govuk-cookie-banner__heading govuk-heading-m"><?php printf( esc_html__( 'Cookies on %s.', 'dgwltd' ), get_bloginfo( 'name' ) ); ?></h2>
        <div class="govuk-cookie-banner__content">
          <p><?php esc_html_e( 'We use some essential cookies to make this service work.', 'dgwltd' ); ?></p>
          <p><?php esc_html_e( 'We’d like to set additional cookies so we can remember your settings, understand how people use the service and make improvements.', 'dgwltd' ); ?></p>
          <noscript>
          <p><?php esc_html_e( 'To accept or reject cookies, turn on JavaScript in your browser settings or reload this page.', 'dgwltd' ); ?></p>
          </noscript>
        </div>
      </div>
    </div>

    <div class="govuk-button-group">
      <button id="cookieAccept" value="accept" type="button" name="cookies" class="govuk-button" data-module="govuk-button">
        <?php esc_html_e( 'Accept additional cookies', 'dgwltd' ); ?>
      </button>
      <button id="cookieReject" value="reject" type="button" name="cookies" class="govuk-button" data-module="govuk-button">
        <?php esc_html_e( 'Reject additional cookies', 'dgwltd' ); ?>
      </button>
      <a class="govuk-link" href="<?php echo esc_url( home_url( '/cookie-settings' ) ); ?>"><?php esc_html_e( 'View cookies', 'dgwltd' ); ?></a>
    </div>
  </div>
</div>
