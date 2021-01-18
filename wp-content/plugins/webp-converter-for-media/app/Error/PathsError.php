<?php

  namespace WebpConverter\Error;

  use WebpConverter\Error\ErrorAbstract;
  use WebpConverter\Error\ErrorInterface;

  class PathsError extends ErrorAbstract implements ErrorInterface
  {
    /* ---
      Functions
    --- */

    public function getErrorCodes()
    {
      $errors = [];

      if ($this->ifUploadsPathExists() !== true) {
        $errors[] = 'path_uploads_unavailable';
      } else if ($this->ifHtaccessIsWriteable() !== true) {
        $errors[] = 'path_htaccess_not_writable';
      }
      if ($this->ifPathsAreDifferent() !== true) {
        $errors[] = 'path_webp_duplicated';
      } else if ($this->ifWebpPathIsWriteable() !== true) {
        $errors[] = 'path_webp_not_writable';
      }

      return $errors;
    }

    private function ifUploadsPathExists()
    {
      $path = apply_filters('webpc_dir_path', '', 'uploads');
      return (is_dir($path) && ($path !== ABSPATH));
    }

    private function ifHtaccessIsWriteable()
    {
      $pathDir  = apply_filters('webpc_dir_path', '', 'uploads');
      $pathFile = $pathDir . '/.htaccess';
      if (file_exists($pathFile)) return (is_readable($pathFile) && is_writable($pathFile));
      else return is_writable($pathDir);
    }

    private function ifPathsAreDifferent()
    {
      $pathUploads = apply_filters('webpc_dir_path', '', 'uploads');
      $pathWebp    = apply_filters('webpc_dir_path', '', 'webp');
      return ($pathUploads !== $pathWebp);
    }

    private function ifWebpPathIsWriteable()
    {
      $path = apply_filters('webpc_dir_path', '', 'webp');
      return (is_dir($path) || is_writable(dirname($path)));
    }
  }