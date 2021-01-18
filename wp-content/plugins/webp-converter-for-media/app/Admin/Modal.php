<?php

  namespace WebpConverter\Admin;

  use WebpConverter\Admin\Assets;

  class Modal
  {
    public function __construct()
    {
      add_action('admin_init', [$this, 'showDeactivationModal']);
    }

    /* ---
      Functions
    --- */

    public function showDeactivationModal()
    {
      if (basename(($_SERVER['SCRIPT_FILENAME'] ?? ''), '.php') !== 'plugins') {
        return;
      }

      new Assets();
      add_action('admin_footer', ['WebpConverter\Admin\Modal', 'loadDeactivationModal']);
    }

    public static function loadDeactivationModal()
    {
      require_once WEBPC_PATH . 'resources/views/deactivation-modal.php';
    }
  }