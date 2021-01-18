<?php

  namespace WebpConverter\Error;

  use WebpConverter\Error\ErrorAbstract;
  use WebpConverter\Error\ErrorInterface;
  use WebpConverter\Method\Gd;
  use WebpConverter\Method\Imagick;

  class LibsError extends ErrorAbstract implements ErrorInterface
  {
    /* ---
      Functions
    --- */

    public function getErrorCodes()
    {
      $errors = [];

      if ($this->ifLibsAreInstalled() !== true) {
        $errors[] = 'libs_not_installed';
      } else if ($this->ifLibsSupportWebp() !== true) {
        $errors[] = 'libs_without_webp_support';
      }

      return $errors;
    }

    private function ifLibsAreInstalled()
    {
      return (Gd::isMethodInstalled() || Imagick::isMethodInstalled());
    }

    private function ifLibsSupportWebp()
    {
      $methods = apply_filters('webpc_get_methods', []);
      return (count($methods) > 0);
    }
  }