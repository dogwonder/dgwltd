<?php if ($errors = apply_filters('webpc_server_errors', [])) : ?>
  <div class="webpPage__widget">
    <h3 class="webpPage__widgetTitle webpPage__widgetTitle--error">
      <?= esc_html(__('Server configuration error', 'webp-converter-for-media')); ?>
    </h3>
    <div class="webpContent webpContent--wide">
      <?= implode('<p>---</p>', $errors); ?>
      <p>---</p>
      <p>
        <?= sprintf(
          __('%sError codes:%s %s', 'webp-converter-for-media'),
          '<strong>',
          '</strong>',
          implode(', ', array_keys($errors))
        ); ?>
      </p>
    </div>
  </div>
<?php endif; ?>