<p>
  <?= wp_kses_post(sprintf(
    __('The paths for /uploads files and for saving converted WebP files are the same. Change them using filter %s. The current path for them is: %s.', 'webp-converter-for-media'),
    '<strong>webpc_dir_path</strong>',
    '<strong>' . apply_filters('webpc_dir_path', '', 'uploads') . '</strong>'
  )); ?>
</p>