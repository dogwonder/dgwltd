<?php

  namespace WebpConverter\Error;

  use WebpConverter\Error\ErrorAbstract;
  use WebpConverter\Error\ErrorInterface;

  class RestapiError extends ErrorAbstract implements ErrorInterface
  {
    /* ---
      Functions
    --- */

    public function getErrorCodes()
    {
      $errors = [];

      if ($this->ifRestApiIsEnabled() !== true) {
        $errors[] = 'rest_api_disabled';
      }

      return $errors;
    }

    private function ifRestApiIsEnabled()
    {
      return ((apply_filters('rest_enabled', true) === true)
        && (apply_filters('rest_jsonp_enabled', true) === true)
        && (apply_filters('rest_authentication_errors', true) === true));
    }
  }