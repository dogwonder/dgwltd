<p>
  <?= wp_kses_post(sprintf(
    __('Unable to create or edit .htaccess file %s(function is_readable() or is_writable() returns false)%s. Change directory permissions. The current using path of file is: %s. Please contact your server administrator.', 'webp-converter-for-media'),
    '<em>',
    '</em>',
    '<strong>' . apply_filters('webpc_dir_path', '', 'uploads') . '/.htaccess</strong>'
  )); ?>
</p>