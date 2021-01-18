<?php

  namespace WebpConverter\Convert;

  class Paths
  {
    const PATH_PLUGINS  = 'wp-content/plugins';
    const PATH_THEMES   = 'wp-content/themes';
    const PATH_UPLOADS  = 'wp-content/uploads';
    const PATH_OUTPUT   = 'wp-content/uploads-webpc';
    const DIRS_EXCLUDED = ['.', '..', '.git', '.svn', 'node_modules'];

    public function __construct()
    {
      add_filter('webpc_dir_name',       [$this, 'getDirAsName'],    0, 2);
      add_filter('webpc_dir_path',       [$this, 'getDirAsPath'],    0, 2);
      add_filter('webpc_dir_url',        [$this, 'getDirAsUrl'],     0, 2);
      add_filter('webpc_uploads_prefix', [$this, 'getPrefixPath'],   0);
      add_filter('webpc_dir_excluded',   [$this, 'getExcludedDirs'], 0);
    }

    /* ---
      Functions
    --- */

    public function getDirAsName($value, $directory)
    {
      switch ($directory) {
        case 'plugins':
          return self::PATH_PLUGINS;
          break;
        case 'themes':
          return self::PATH_THEMES;
          break;
        case 'uploads':
          return self::PATH_UPLOADS;
          break;
        case 'webp':
          return self::PATH_OUTPUT;
          break;
      }
      return null;
    }

    public function getDirAsPath($value, $directory)
    {
      $sourcePath = apply_filters('webpc_site_root', realpath(ABSPATH));
      switch ($directory) {
        default:
          if ($path = apply_filters('webpc_dir_name', null, $directory)) {
            return $sourcePath . '/' . $path;
          }
          break;
      }
      return null;
    }

    public function getDirAsUrl($value, $directory)
    {
      $sourceUrl = apply_filters('webpc_site_url', get_site_url());
      switch ($directory) {
        default:
          if ($path = apply_filters('webpc_dir_name', null, $directory)) {
            return $sourceUrl . '/' . $path;
          }
          break;
      }
    }

    public function getPrefixPath($value)
    {
      $docDir   = realpath($_SERVER['DOCUMENT_ROOT']);
      $wpDir    = apply_filters('webpc_site_root', realpath(ABSPATH));
      $diffDir  = trim(str_replace($docDir, '', $wpDir), '\/');
      $diffPath = sprintf('/%s/', $diffDir);

      return str_replace('//', '/', $diffPath);
    }

    public function getExcludedDirs($value)
    {
      return self::DIRS_EXCLUDED;
    }
  }