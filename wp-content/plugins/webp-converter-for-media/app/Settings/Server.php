<?php

  namespace WebpConverter\Settings;

  use WebpConverter\Loader\LoaderAbstract;
  use WebpConverter\Settings\Errors;
  use WebpConverter\Error\RewritesError;
  use WebpConverter\Traits\FileLoaderTrait;

  class Server
  {
    use FileLoaderTrait;

    private $extensions = ['gd', 'imagick', 'core'];

    public function __construct()
    {
      add_filter('webpc_server_info', [$this, 'getContent']);
    }

    /* ---
      Functions
    --- */

    public function getContent($content = '')
    {
      ob_start();

      add_filter('webpc_get_values', ['WebpConverter\Settings\Errors', 'setExtensionsForDebug']);
      do_action(LoaderAbstract::ACTION_NAME, true);
      echo $this->getFiltersInfo();
      remove_filter('webpc_get_values', ['WebpConverter\Settings\Errors', 'setExtensionsForDebug']);
      do_action(LoaderAbstract::ACTION_NAME, true);

      foreach ($this->extensions as $extension) {
        $this->getExtensionInfo($extension);
      }

      $content = ob_get_contents();
      ob_end_clean();
      return $content;
    }

    private function getExtensionInfo($extension)
    {
      ?>
        <h4><?= $extension; ?></h4>
      <?php
      if (!extension_loaded($extension)) :
        ?>
          <p>-</p>
        <?php
      else :
        $ext = new \ReflectionExtension($extension);
        $ext->info();
      endif;
    }

    private function getFiltersInfo()
    {
      $uploadsUrl  = apply_filters('webpc_dir_url', '', 'uploads');
      $uploadsPath = apply_filters('webpc_dir_path', '', 'uploads');

      ob_start();

      ?>
      <h4>Filters</h4>
      <table>
        <tbody>
          <tr>
            <td class="e">webpc_get_values</td>
            <td class="v">
              <?= json_encode(apply_filters('webpc_get_values', [], null)); ?>
            </td>
          </tr>
          <tr>
            <td class="e">webpc_get_methods</td>
            <td class="v">
              <?= implode(' | ', apply_filters('webpc_get_methods', [])); ?>
            </td>
          </tr>
          <tr>
            <td class="e">webpc_site_root</td>
            <td class="v">
              <?= apply_filters('webpc_site_root', ABSPATH); ?>
            </td>
          </tr>
          <tr>
            <td class="e">webpc_site_url</td>
            <td class="v">
              <?= apply_filters('webpc_site_url', get_site_url()); ?>
            </td>
          </tr>
            <td class="e">webpc_dir_path <em>(plugins)</em></td>
            <td class="v">
              <?= apply_filters('webpc_dir_path', '', 'plugins'); ?>
            </td>
          </tr>
          <tr>
            <td class="e">webpc_dir_path <em>(themes)</em></td>
            <td class="v">
              <?= apply_filters('webpc_dir_path', '', 'themes'); ?>
            </td>
          </tr>
          <tr>
            <td class="e">webpc_dir_path <em>(uploads)</em></td>
            <td class="v">
              <?= apply_filters('webpc_dir_path', '', 'uploads'); ?>
            </td>
          </tr>
          <tr>
            <td class="e">webpc_dir_path <em>(webp)</em></td>
            <td class="v">
              <?= apply_filters('webpc_dir_path', '', 'webp'); ?>
            </td>
          </tr>
          <tr>
            <td class="e">webpc_uploads_prefix</td>
            <td class="v">
              <?= apply_filters('webpc_uploads_prefix', '/'); ?>
            </td>
          </tr>
          <tr>
          <tr>
            <td class="e">webpc_dir_excluded</td>
            <td class="v">
              <?= implode(' | ', apply_filters('webpc_dir_excluded', [])); ?>
            </td>
          </tr>
        </tbody>
      </table>
      <h4>WordPress</h4>
      <table>
        <tbody>
          <tr>
            <td class="e">ABSPATH</td>
            <td class="v">
              <?= ABSPATH; ?>
            </td>
          </tr>
        </tbody>
      </table>
      <h4>Errors debug</h4>
      <table>
        <tbody>
          <tr>
            <td class="e">Size of PNG <em>(by server path)</em></td>
            <td class="v">
              <?= $this->getFileSizeByPath($uploadsPath . RewritesError::PATH_OUTPUT_FILE_PNG); ?>
            </td>
          </tr>
          <tr>
            <td class="e">Size of PNG2 <em>(by server path)</em></td>
            <td class="v">
              <?= $this->getFileSizeByPath($uploadsPath . RewritesError::PATH_OUTPUT_FILE_PNG2); ?>
            </td>
          </tr>
          <tr>
            <td class="e">Size of PNG as WEBP <em>(by URL)</em></td>
            <td class="v">
              <?= $this->getFileSizeByUrl($uploadsUrl . RewritesError::PATH_OUTPUT_FILE_PNG); ?>
            </td>
          </tr>
          <tr>
            <td class="e">Size of PNG as PNG <em>(by URL)</em></td>
            <td class="v">
              <?= $this->getFileSizeByUrl($uploadsUrl . RewritesError::PATH_OUTPUT_FILE_PNG, false); ?>
            </td>
          </tr>
          <tr>
            <td class="e">Size of PNG2 as WEBP <em>(by URL)</em></td>
            <td class="v">
              <?= $this->getFileSizeByUrl($uploadsUrl . RewritesError::PATH_OUTPUT_FILE_PNG2); ?>
            </td>
          </tr>
          <tr>
            <td class="e">Size of PNG2 as PNG2 <em>(by URL)</em></td>
            <td class="v">
              <?= $this->getFileSizeByUrl($uploadsUrl . RewritesError::PATH_OUTPUT_FILE_PNG2, false); ?>
            </td>
          </tr>
        </tbody>
      </table>
      <?php

      $content = ob_get_contents();
      ob_end_clean();
      return $content;
    }
  }