<?php

  $apiPaths      = apply_filters('webpc_rest_api_paths', '');
  $apiRegenerate = apply_filters('webpc_rest_api_regenerate', '');

?>
<div class="webpPage__widget">
  <h3 class="webpPage__widgetTitle">
    <?= esc_html(__('Regenerate images', 'webp-converter-for-media')); ?>
  </h3>
  <div class="webpLoader webpContent"
    data-api-paths="<?= esc_url($apiPaths); ?>"
    data-api-regenerate="<?= esc_url($apiRegenerate); ?>"
    data-api-error-message="<?= esc_attr(__('An unknown error occurred while converting the images: %s', 'webp-converter-for-media')); ?>">
    <div class="webpPage__widgetRow">
      <p>
        <?= wp_kses_post(__('Convert all existing images with just one click! This tool uses the WordPress REST API by downloading addresses of all images and converting all files gradually. This is a process that may take a few or more than ten minutes depending on the number of files. During this process, please do not close your browser window.', 'webp-converter-for-media')); ?>
      </p>
      <p>
        <?= wp_kses_post(__('This operation should be performed only once after installing the plugin. New images from the Media Library will be converted automatically. For other images, e.g. from the /themes or /uploads directory that are not from the Media Library, you must start manual conversion after adding new images.', 'webp-converter-for-media')); ?>
      </p>
      <div class="webpLoader__status" hidden>
        <div class="webpLoader__bar">
          <div class="webpLoader__barProgress" data-percent="0">
            <div class="webpLoader__barCount"></div>
          </div>
          <div class="webpLoader__size">
            <?= sprintf(
              wp_kses_post(__('Saving the weight of your images: %s', 'webp-converter-for-media')),
              '<span class="webpLoader__sizeProgress">0 kB</span>'
            ); ?>
          </div>
        </div>
        <div class="webpLoader__success" hidden>
          <div class="webpLoader__successContent">
            <?= wp_kses_post(__('The process was completed successfully. Your images have been converted!', 'webp-converter-for-media')); ?>
            <?= wp_kses_post(__('Please flush cache if you use caching plugin or caching via hosting.', 'webp-converter-for-media')); ?>
            <br>
            <?= wp_kses_post(sprintf(
              __('Do you want to know how a plugin works and how to check if it is working properly? Read our %splugin FAQ%s.', 'webp-converter-for-media'),
              '<a href="https://wordpress.org/plugins/webp-converter-for-media/#faq" target="_blank">',
              '</a>'
            )); ?>
          </div>
        </div>
        <div class="webpLoader__popup webpPopup" hidden>
          <div class="webpPopup__inner">
            <div class="webpPopup__image"></div>
            <div class="webpPopup__content">
              <p><?= wp_kses_post(__('Hi, I\'m Mateusz! I\'m glad you managed to reduce the weight of your website. If you would like to support me in developing this plugin, I will be very grateful to you!', 'webp-converter-for-media')); ?></p>
              <p>
                <a href="https://ko-fi.com/gbiorczyk/?utm_source=webp-converter-for-media&utm_medium=notice-regenerate"
                  target="_blank"
                  class="webpButton webpButton--blue dashicons-coffee">
                  <?= wp_kses_post(__('Provide me a coffee', 'webp-converter-for-media')); ?>
                </a>
              </p>
            </div>
          </div>
        </div>
        <div class="webpLoader__errors" hidden>
          <div class="webpLoader__errorsTitle">
            <?= esc_html(__('Additional informations about process:', 'webp-converter-for-media')); ?>
          </div>
          <div class="webpLoader__errorsContent">
            <div class="webpLoader__errorsContentList"></div>
            <div class="webpLoader__errorsContentMessage" hidden>
              <?= wp_kses_post(__('An error occurred while connecting to REST API. Please try again.', 'webp-converter-for-media')); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="webpPage__widgetRow">
      <table class="webpTable">
        <tr>
          <td>
            <input type="checkbox" name="regenerate_force" value="1"
              id="webpc-regenerate-force" class="webpCheckbox__input">
            <label for="webpc-regenerate-force"></label>
          </td>
          <td>
            <label for="webpc-regenerate-force" class="webpCheckbox__label">
              <?= __('Force convert all images again', 'webp-converter-for-media'); ?>
            </label>
          </td>
        </tr>
      </table>
      <button type="button" target="_blank"
        class="webpLoader__button webpButton webpButton--green"
        <?= (apply_filters('webpc_server_errors', [])) ? 'disabled' : ''; ?>>
        <?= esc_html(__('Regenerate All', 'webp-converter-for-media')); ?>
      </button>
    </div>
  </div>
</div>