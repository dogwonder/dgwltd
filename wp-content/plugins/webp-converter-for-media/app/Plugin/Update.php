<?php

  namespace WebpConverter\Plugin;

  use WebpConverter\Loader\LoaderAbstract;
  use WebpConverter\Settings\Save;
  use WebpConverter\Plugin\Uninstall;

  class Update
  {
    const VERSION_OPTION = 'webpc_latest_version';

    public function __construct()
    {
      add_action('admin_init', [$this, 'runActionsAfterUpdate']);
    }

    /* ---
      Functions
    --- */

    public function runActionsAfterUpdate()
    {
      $version = get_option(self::VERSION_OPTION, null);
      if ($version === WEBPC_VERSION) return;

      if ($version !== null) {
        update_option(Save::SETTINGS_OPTION, $this->updateSettingsForOldVersions($version));
        $this->moveFilesToUploadsSubdirectory($version);

        update_option(Activation::NEW_INSTALLATION_OPTION, '0');
        remove_action('admin_notices', ['WebpConverter\Admin\Notice', 'loadWelcomeNotice']);
      }

      do_action(LoaderAbstract::ACTION_NAME, true);
      update_option(self::VERSION_OPTION, WEBPC_VERSION);
    }

    private function updateSettingsForOldVersions($version)
    {
      $settings = apply_filters('webpc_get_values', []);

      if (version_compare($version, '1.1.2', '<=')) {
        $settings['features'][] = 'only_smaller';
      }

      if (version_compare($version, '1.2.7', '<=') && !isset($settings['dirs'])) {
        $settings['dirs'] = ['uploads'];
      }

      if (version_compare($version, '1.3.1', '<=')) {
        $settings['features'][] = 'debug_enabled';
      }

      if (version_compare($version, '1.6.0', '<=') && !isset($settings['loader_type'])) {
        $settings['loader_type'] = 'htaccess';
      }

      $settings['features'] = array_unique($settings['features']);
      return $settings;
    }

    private function moveFilesToUploadsSubdirectory($version)
    {
      if (version_compare($version, '1.2.7', '>')) return;

      Uninstall::removeWebpFiles();
      do_action('webpc_regenerate_all');
    }
  }