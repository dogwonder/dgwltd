<p>
  <?= wp_kses_post(sprintf(
    __('%sAlso try changing option "Image loading mode" to a different one.%s Issues about rewrites can often be resolved by setting this option to "%s". You can do this in plugin settings below. After changing settings, remember to flush cache if you use caching plugin or caching via hosting.', 'webp-converter-for-media'),
    '<strong>',
    '</strong>',
    'Pass Thru'
  )); ?>
</p>