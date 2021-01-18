<?php

  namespace WebpConverter\Convert;

  class Directory
  {
    /* ---
      Functions
    --- */

    public static function getPath($path, $createDirectory = false)
    {
      $webpRoot    = apply_filters('webpc_dir_path', '', 'webp');
      $uploadsRoot = dirname($webpRoot);
      $outputPath  = str_replace(realpath($uploadsRoot), '', realpath($path));
      $outputPath  = trim($outputPath, '\/');

      $newPath = sprintf('%s/%s.webp', $webpRoot, $outputPath);
      if (!$createDirectory) return $newPath;

      if (!$paths = self::checkDirectories($newPath)) return $newPath;
      else if (!self::makeDirectories($paths)) return null;
      else return $newPath;
    }

    private static function checkDirectories($path)
    {
      $current = dirname($path);
      $paths   = [];
      while (!file_exists($current)) {
        $paths[] = $current;
        $current = dirname($current);
      }
      return $paths;
    }

    private static function makeDirectories($paths)
    {
      $paths = array_reverse($paths);
      foreach ($paths as $path) {
        if (!is_writable(dirname($path))) return false;
        mkdir($path);
      }
      return true;
    }
  }