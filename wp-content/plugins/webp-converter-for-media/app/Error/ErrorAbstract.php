<?php

  namespace WebpConverter\Error;

  use WebpConverter\Error\ErrorInterface;

  abstract class ErrorAbstract implements ErrorInterface
  {
    private $settings = [];

    public function __construct()
    {
      $this->settings = apply_filters('webpc_get_values', []);
    }

    /* ---
      Functions
    --- */

    public function getSettings()
    {
      return $this->settings;
    }
  }