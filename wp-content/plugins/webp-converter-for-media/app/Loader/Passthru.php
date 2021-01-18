<?php

  namespace WebpConverter\Loader;

  use WebpConverter\Loader\LoaderAbstract;
  use WebpConverter\Loader\LoaderInterface;

  class Passthru extends LoaderAbstract implements LoaderInterface
  {
    const LOADER_TYPE = 'passthru';
    const PATH_LOADER = '/webpc-passthru.php';

    /* ---
      Functions
    --- */

    public function hooks()
    {
      add_action('get_header', [$this, 'startBuffer']);
    }

    public static function isActiveLoader()
    {
      $settings = apply_filters('webpc_get_values', []);
      return (isset($settings['loader_type']) && ($settings['loader_type'] === self::LOADER_TYPE));
    }

    public function activateLoader()
    {
      $pathSource = WEBPC_PATH . 'libs/passthru.php';
      $sourceCode = (is_readable($pathSource)) ? file_get_contents($pathSource) : '';
      if (!$sourceCode) {
        return;
      }

      $pathDirUploads = apply_filters('webpc_dir_name', '', 'uploads');
      $pathDirWebp    = apply_filters('webpc_dir_name', '', 'webp');
      $uploadSuffix   = implode('/', array_diff(explode('/', $pathDirUploads), explode('/', $pathDirWebp)));

      $sourceCode = preg_replace(
        '/(PATH_UPLOADS = \')(\')/',
        '$1' . $pathDirUploads . '$2',
        $sourceCode);
      $sourceCode = preg_replace(
        '/(PATH_UPLOADS_WEBP = \')(\')/',
        '$1' . $pathDirWebp . '/' . $uploadSuffix . '$2',
        $sourceCode);

      $dirOutput = dirname(apply_filters('webpc_dir_path', '', 'uploads'));
      if (is_writable($dirOutput)) {
        file_put_contents($dirOutput . self::PATH_LOADER, $sourceCode);
      }
    }

    public function deactivateLoader()
    {
      $pathOutput = dirname(apply_filters('webpc_dir_path', '', 'uploads')) . self::PATH_LOADER;
      if (is_writable($pathOutput)) unlink($pathOutput);
    }

    public function startBuffer()
    {
      ob_start(['WebpConverter\Loader\Passthru', 'updateImageUrls']);
    }

    public static function updateImageUrls($buffer)
    {
      if (!self::isActiveLoader()) {
        return $buffer;
      }

      $settings   = apply_filters('webpc_get_values', []);
      $extensions = implode('|', $settings['extensions'] ?? []);
      if (!$extensions || (!$sourceDir = self::getLoaderUrl())
        || (!$allowedDirs = self::getAllowedDirs())) {
        return $buffer;
      }

      $dirPaths = str_replace('/', '\\/', implode('|', self::getAllowedDirs()));
      return preg_replace(
        '/(https?:\/\/(?:[^\s()"\']+)(?:' . $dirPaths . ')(?:[^\s()"\']+)\.(?:' . $extensions . '))/',
        $sourceDir . '?src=$1&nocache=1',
        $buffer);
    }

    public static function getLoaderUrl()
    {
      if (!$sourceDir = dirname(apply_filters('webpc_dir_url', '', 'uploads'))) {
        return null;
      }
      return $sourceDir . self::PATH_LOADER;
    }

    public static function getAllowedDirs()
    {
      $settings = apply_filters('webpc_get_values', []);
      $dirs     = [];
      foreach ($settings['dirs'] as $dir) {
        $dirs[] = apply_filters('webpc_dir_name', null, $dir);
      }
      return array_filter($dirs);
    }
  }