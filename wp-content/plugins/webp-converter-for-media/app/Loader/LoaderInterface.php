<?php

  namespace WebpConverter\Loader;

  interface LoaderInterface
  {
    /* ---
      Functions
    --- */

    public function hooks();

    public static function isActiveLoader();

    public function refreshLoader($isActive);

    public function activateLoader();

    public function deactivateLoader();
  }