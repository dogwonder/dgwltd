<?php

  use WebpConverter\Settings\Errors;

  $errors = implode(', ', get_option(Errors::ERRORS_CACHE_OPTION, []));
  $items  = [
    [
      'key'         => 'server_config',
      'label'       => __('I have "Server configuration error" in plugin settings', 'webp-converter-for-media'),
      'placeholder' => esc_attr(__('What is your error? Have you been looking for solution to this issue?', 'webp-converter-for-media')),
    ],
    [
      'key'         => 'website_broken',
      'label'       => __('This plugin broke my website', 'webp-converter-for-media'),
      'placeholder' => esc_attr(__('What exactly happened?', 'webp-converter-for-media')),
    ],
    [
      'key'         => 'better_plugin',
      'label'       => __('I found a better plugin', 'webp-converter-for-media'),
      'placeholder' => esc_attr(__('What is name of this plugin? Why is it better?', 'webp-converter-for-media')),
    ],
    [
      'key'         => 'misunderstanding',
      'label'       => __('I do not understand how the plugin works', 'webp-converter-for-media'),
      'placeholder' => esc_attr(__('What is non-understandable to you? Did you search for this in plugin FAQ?', 'webp-converter-for-media')),
    ],
    [
      'key'         => 'temporary_deactivation',
      'label'       => __('This is a temporary deactivation', 'webp-converter-for-media'),
      'placeholder' => '',
    ],
    [
      'key'         => 'other',
      'label'       => __('Other reason', 'webp-converter-for-media'),
      'placeholder' => esc_attr(__('What is reason? What can we improve for you?', 'webp-converter-for-media')),
    ],
  ];

?>
<div class="webpModal" hidden>
  <div class="webpModal__outer">
    <form action="https://feedback.gbiorczyk.pl/" method="POST" class="webpModal__form">
      <h2 class="webpModal__headline">
        <?= esc_html(__('We are sorry that you are leaving our plugin WebP Converter for Media', 'webp-converter-for-media')); ?>
      </h2>
      <div class="webpModal__desc">
        <?= esc_html(__('Can you please take a moment to tell us why you are deactivating this plugin (your answer is completely anonymous)?', 'webp-converter-for-media')); ?>
      </div>
      <table class="webpModal__table webpTable">
        <?php foreach ($items as $index => $item) : ?>
          <tr>
            <td>
              <input type="radio" name="webpc_reason" value="<?= esc_attr($item['key']); ?>"
                id="webpc-option<?= $index; ?>" class="webpCheckbox__input"
                data-placeholder="<?= esc_attr($item['placeholder']); ?>">
              <label for="webpc-option<?= $index; ?>"></label>
            </td>
            <td>
              <label for="webpc-option<?= $index; ?>"
                class="webpCheckbox__label"><?= esc_html($item['label']); ?></label>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
      <textarea class="webpModal__textarea" name="webpc_comment" rows="2"></textarea>
      <ul class="webpModal__buttons">
        <li class="webpModal__button">
          <button type="submit" class="webpModal__buttonInner webpButton webpButton--green">
            <?= esc_html(__('Submit and Deactivate', 'webp-converter-for-media')); ?>
          </button>
        </li>
        <li class="webpModal__button">
          <button type="button" class="webpModal__buttonInner webpButton webpButton--blue">
            <?= esc_html(__('Skip and Deactivate', 'webp-converter-for-media')); ?>
          </button>
        </li>
      </ul>
      <input type="hidden" name="webpc_error_codes"
        value="<?= esc_attr($errors); ?>">
      <input type="hidden" name="webpc_plugin_settings"
        value='<?= json_encode(apply_filters('webpc_get_values', [])); ?>'>
      <input type="hidden" name="webpc_plugin_version"
        value="<?= esc_attr(WEBPC_VERSION); ?>">
    </form>
  </div>
</div>