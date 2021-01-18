<?php

  namespace WebpConverter\Error;

  use WebpConverter\Error\ErrorAbstract;
  use WebpConverter\Error\ErrorInterface;

  class SettingsError extends ErrorAbstract implements ErrorInterface
  {
    /* ---
      Functions
    --- */

    public function getErrorCodes()
    {
      $errors = [];

      if ($this->ifSettingsAreCorrect() !== true) {
        $errors[] = 'settings_incorrect';
      }

      return $errors;
    }

    private function ifSettingsAreCorrect()
    {
      $settings = $this->getSettings();
      if ((!isset($settings['extensions']) || !$settings['extensions'])
        || (!isset($settings['dirs']) || !$settings['dirs'])
        || (!isset($settings['method']) || !in_array($settings['method'], apply_filters('webpc_get_methods', [])))
        || (!isset($settings['quality']) || !$settings['quality'])) return false;

      return true;
    }
  }