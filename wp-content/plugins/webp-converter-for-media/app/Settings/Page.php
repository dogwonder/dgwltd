<?php

  namespace WebpConverter\Settings;

  use WebpConverter\Admin\Assets;
  use WebpConverter\Plugin\Activation;
  use WebpConverter\Settings\Save;

  class Page
  {
    private $filePath = WEBPC_PATH . '/resources/views/settings.php';

    public function __construct()
    {
      add_action('admin_menu',         [$this, 'addSettingsPageForAdmin']);
      add_action('network_admin_menu', [$this, 'addSettingsPageForNetwork']);
    }

    /* ---
      Functions
    --- */

    public static function getSettingsPageUrl()
    {
      if (!is_multisite()) {
        return menu_page_url('webpc_admin_page', false);
      } else {
        return network_admin_url('settings.php?page=webpc_admin_page');
      }
    }

    public function addSettingsPageForAdmin()
    {
      if (is_multisite()) {
        return;
      }
      $this->addSettingsPage('options-general.php');
    }

    public function addSettingsPageForNetwork()
    {
      $this->addSettingsPage('settings.php');
    }

    private function addSettingsPage($menuPage)
    {
      $page = add_submenu_page(
        $menuPage,
        'WebP Converter for Media',
        'WebP Converter',
        'manage_options',
        'webpc_admin_page',
        [$this, 'showSettingsPage']
      );
      add_action('load-' . $page, [$this, 'loadScriptsForPage']);
    }

    public function showSettingsPage()
    {
      new Save();
      require_once $this->filePath;
    }

    public function loadScriptsForPage()
    {
      update_option(Activation::NEW_INSTALLATION_OPTION, '0');
      remove_action('admin_notices',         ['WebpConverter\Admin\Notice', 'loadWelcomeNotice']);
      remove_action('network_admin_notices', ['WebpConverter\Admin\Notice', 'loadWelcomeNotice']);

      new Assets();
    }
  }