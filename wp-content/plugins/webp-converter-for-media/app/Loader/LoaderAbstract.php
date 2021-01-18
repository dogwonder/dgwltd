<?php

  namespace WebpConverter\Loader;

  use WebpConverter\Loader\LoaderInterface;
  use WebpConverter\Settings\Errors;

  abstract class LoaderAbstract implements LoaderInterface
  {
    const ACTION_NAME = 'webpc_rewrite_htaccess';

    public function __construct()
    {
      add_action(self::ACTION_NAME, [$this, 'refreshLoader']);
      add_action('plugins_loaded',  [$this, 'initHooks']);
    }

    /* ---
      Functions
    --- */

    public function initHooks()
    {
      if (!static::isActiveLoader() || get_option(Errors::ERRORS_CACHE_OPTION, [])) {
        return;
      }
      $this->hooks();
    }

    public function hooks() {}

    public function refreshLoader($isActive) {
      if ($isActive && static::isActiveLoader()) {
        $this->activateLoader();
      } else {
        $this->deactivateLoader();
      }
    }

    public function activateLoader() {}

    public function deactivateLoader() {}
  }