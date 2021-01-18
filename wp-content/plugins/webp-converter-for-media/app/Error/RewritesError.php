<?php

  namespace WebpConverter\Error;

  use WebpConverter\Error\ErrorAbstract;
  use WebpConverter\Error\ErrorInterface;
  use WebpConverter\Traits\FileLoaderTrait;
  use WebpConverter\Convert\Directory;
  use WebpConverter\Loader\LoaderAbstract;

  class RewritesError extends ErrorAbstract implements ErrorInterface
  {
    use FileLoaderTrait;

    const PATH_SOURCE_FILE_PNG          = '/public/img/icon-test.png';
    const PATH_SOURCE_FILE_WEBP         = '/public/img/icon-test.webp';
    const PATH_OUTPUT_FILE_PNG          = '/webp-converter-for-media-test.png';
    const PATH_OUTPUT_FILE_PNG2         = '/webp-converter-for-media-test.png2';
    const PATH_OUTPUT_FILE_PNG_AS_WEBP  = self::PATH_OUTPUT_FILE_PNG . '.webp';
    const PATH_OUTPUT_FILE_PNG2_AS_WEBP = self::PATH_OUTPUT_FILE_PNG2 . '.webp';

    /* ---
      Functions
    --- */

    public function getErrorCodes()
    {
      $this->convertImagesForDebug();
      $errors = [];

      if ($this->ifRedirectsAreWorks() !== true) {
        if ($this->ifBypassingApacheIsActive() === true) {
          $errors[] = 'bypassing_apache';
        } else {
          $errors[] = 'rewrites_not_working';
        }
      } else if ($this->ifRedirectsAreCached() === true) {
        $errors[] = 'rewrites_cached';
      }

      return $errors;
    }

    private function convertImagesForDebug()
    {
      $uploadsDir   = apply_filters('webpc_dir_path', '', 'uploads');
      $pathFilePng  = $uploadsDir . self::PATH_OUTPUT_FILE_PNG;
      $pathFilePng2 = $uploadsDir . self::PATH_OUTPUT_FILE_PNG2;
      if (!is_writable($uploadsDir)) {
        return;
      }

      if (!file_exists($pathFilePng) || !file_exists($pathFilePng2)) {
        copy(WEBPC_PATH . self::PATH_SOURCE_FILE_PNG, $pathFilePng);
        copy(WEBPC_PATH . self::PATH_SOURCE_FILE_PNG, $pathFilePng2);
      }

      if (($outputPath = Directory::getPath($pathFilePng, true)) && !file_exists($outputPath)) {
        copy(WEBPC_PATH . self::PATH_SOURCE_FILE_WEBP, $outputPath);
      }
      if (($outputPath = Directory::getPath($pathFilePng2, true)) && !file_exists($outputPath)) {
        copy(WEBPC_PATH . self::PATH_SOURCE_FILE_WEBP, $outputPath);
      }
    }

    private function ifRedirectsAreWorks()
    {
      $uploadsDir = apply_filters('webpc_dir_path', '', 'uploads');
      $uploadsUrl = apply_filters('webpc_dir_url', '', 'uploads');

      $fileSize = $this->getFileSizeByPath($uploadsDir . self::PATH_OUTPUT_FILE_PNG);
      $fileWebp = $this->getFileSizeByUrl($uploadsUrl . self::PATH_OUTPUT_FILE_PNG);

      return ($fileWebp < $fileSize);
    }

    private function ifBypassingApacheIsActive()
    {
      $uploadsUrl = apply_filters('webpc_dir_url', '', 'uploads');

      add_filter('webpc_get_values', ['WebpConverter\Settings\Errors', 'setExtensionsForDebug']);
      do_action(LoaderAbstract::ACTION_NAME, true);

      $filePng  = $this->getFileSizeByUrl($uploadsUrl . self::PATH_OUTPUT_FILE_PNG);
      $filePng2 = $this->getFileSizeByUrl($uploadsUrl . self::PATH_OUTPUT_FILE_PNG2);

      remove_filter('webpc_get_values', ['WebpConverter\Settings\Errors', 'setExtensionsForDebug']);
      do_action(LoaderAbstract::ACTION_NAME, true);

      return ($filePng > $filePng2);
    }

    private function ifRedirectsAreCached()
    {
      $uploadsUrl = apply_filters('webpc_dir_url', '', 'uploads');

      $fileWebp     = $this->getFileSizeByUrl($uploadsUrl . self::PATH_OUTPUT_FILE_PNG);
      $fileOriginal = $this->getFileSizeByUrl($uploadsUrl . self::PATH_OUTPUT_FILE_PNG, false);

      return (($fileWebp > 0) && ($fileWebp === $fileOriginal));
    }
  }