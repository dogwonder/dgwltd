<?php

  namespace WebpConverter\Settings;

  use WebpConverter\Error\LibsError;
  use WebpConverter\Error\PassthruError;
  use WebpConverter\Error\PathsError;
  use WebpConverter\Error\RestapiError;
  use WebpConverter\Error\RewritesError;
  use WebpConverter\Error\SettingsError;

  class Errors
  {
    const ERRORS_CACHE_OPTION = 'webpc_errors_cache';

    private $cache    = null;
    private $filePath = WEBPC_PATH . '/resources/components/errors/%s.php';

    public function __construct()
    {
      add_filter('webpc_server_errors', [$this, 'getServerErrors']);
    }

    /* ---
      Functions
    --- */

    public function getServerErrors()
    {
      if ($this->cache !== null) return $this->cache;

      $this->cache = $this->loadErrorMessages();
      return $this->cache;
    }

    private function loadErrorMessages()
    {
      $errors = $this->getErrorsList();
      $list   = [];
      foreach ($errors as $error) {
        ob_start();
        include sprintf($this->filePath, str_replace('_', '-', $error));
        $list[$error] = ob_get_clean();
      }

      update_option(self::ERRORS_CACHE_OPTION, array_keys($list));
      return $list;
    }

    private function getErrorsList()
    {
      $errors = [];
      if ($newErrors = (new LibsError())->getErrorCodes()) {
        $errors = array_merge($errors, $newErrors);
      }
      if ($newErrors = (new RestapiError())->getErrorCodes()) {
        $errors = array_merge($errors, $newErrors);
      }
      if ($newErrors = (new PathsError())->getErrorCodes()) {
        $errors = array_merge($errors, $newErrors);
      }
      if ($newErrors = (new PassthruError())->getErrorCodes()) {
        $errors = array_merge($errors, $newErrors);
      } else if ($newErrors = (new RewritesError())->getErrorCodes()) {
        $errors = array_merge($errors, $newErrors);
      }
      if (!$errors && ($newErrors = (new SettingsError())->getErrorCodes())) {
        $errors = array_merge($errors, $newErrors);
      }

      return $errors;
    }

    public static function setExtensionsForDebug($settings)
    {
      $settings['extensions'] = array_unique(array_merge(
        ['png2', 'png'],
        $settings['extensions']
      ));
      return $settings;
    }
  }