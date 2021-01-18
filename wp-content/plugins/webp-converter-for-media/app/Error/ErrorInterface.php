<?php

  namespace WebpConverter\Error;

  interface ErrorInterface
  {
    /* ---
      Functions
    --- */

    public function getSettings();

    public function getErrorCodes();
  }