<?php

  use WebpConverter\Settings\Page;

  $info = apply_filters('webpc_server_info', '');

?>
<div class="webpPage__widget">
  <h3 class="webpPage__widgetTitle webpPage__widgetTitle--second">
    <?= esc_html(__('Your server configuration', 'webp-converter-for-media')); ?>
  </h3>
  <div class="webpContent">
    <div class="webpPage__widgetRow">
      <p>
        <?= wp_kses_post(sprintf(__('Please compare your configuration with the configuration that is given in the technical requirements in %sthe plugin FAQ%s. If your server does not meet the technical requirements, please contact your server Administrator.', 'webp-converter-for-media'),
          '<a href="https://wordpress.org/plugins/webp-converter-for-media/#faq" target="_blank">',
          '</a>'
        )); ?>
      </p>
      <a href="<?= esc_url(Page::getSettingsPageUrl()); ?>" class="webpLoader__button webpButton webpButton--blue">
        <?= esc_html(__('Back to settings', 'webp-converter-for-media')); ?>
      </a>
    </div>
    <div class="webpPage__widgetRow">
      <div class="webpServerInfo"><?= wp_kses_post($info); ?></div>
    </div>
    <div class="webpPage__widgetRow">
      <a href="<?= esc_url(Page::getSettingsPageUrl()); ?>" class="webpLoader__button webpButton webpButton--blue">
        <?= esc_html(__('Back to settings', 'webp-converter-for-media')); ?>
      </a>
    </div>
  </div>
</div>