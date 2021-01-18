<?php

  namespace WebpConverter\Admin;

  use WebpConverter\Settings\Page;

  class Plugin
  {
    public function __construct()
    {
      add_filter('plugin_action_links_' . WEBPC_NAME,               [$this, 'addLinkToSettingsForAdmin']);
      add_filter('network_admin_plugin_action_links_' . WEBPC_NAME, [$this, 'addLinkToSettingsForNetwork']);
      add_filter('plugin_action_links_' . WEBPC_NAME,               [$this, 'addLinkToDonate']);
      add_filter('network_admin_plugin_action_links_' . WEBPC_NAME, [$this, 'addLinkToDonate']);
    }

    /* ---
      Functions
    --- */

    public function addLinkToSettingsForAdmin($links)
    {
      if (is_multisite()) {
        return $links;
      }

      return $this->addLinkToSettings($links);
    }

    public function addLinkToSettingsForNetwork($links)
    {
      return $this->addLinkToSettings($links);
    }

    private function addLinkToSettings($links)
    {
      array_unshift($links, sprintf(
        esc_html(__('%sSettings%s', 'webp-converter-for-media')),
        '<a href="' . Page::getSettingsPageUrl() . '">',
        '</a>'
      ));
      return $links;
    }

    public function addLinkToDonate($links)
    {
      $links[] = sprintf(
        esc_html(__('%sProvide us a coffee%s', 'webp-converter-for-media')),
        '<a href="https://ko-fi.com/gbiorczyk/?utm_source=webp-converter-for-media&utm_medium=plugin-links" target="_blank">',
        '</a>'
      );
      return $links;
    }
  }