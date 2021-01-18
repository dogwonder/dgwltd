<?php

  use WebpConverter\Loader\Passthru;

  $url = Passthru::getLoaderUrl();

?>
<p>
  <?= wp_kses_post(sprintf(
    __('Execution of the PHP file from path "%s" is blocked on your server, or access to this file is blocked. Add an exception and enable this file to be executed via HTTP request. To do this, check the security plugin settings (if you are using) or the security settings of your server.%sIn this case, please contact your server administrator.', 'webp-converter-for-media'),
    '<a href="' . $url . '" target="_blank">' . $url . '</a>',
    '<br><br>'
  )); ?>
</p>