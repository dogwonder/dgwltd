<?php

  namespace WebpConverter\Plugin;

  use WebpConverter\Action\Cron;
  use WebpConverter\Loader\LoaderAbstract;

  class Deactivation
  {
    public function __construct()
    {
      register_deactivation_hook(WEBPC_FILE, [$this, 'refreshRewriteRules']);
      register_deactivation_hook(WEBPC_FILE, [$this, 'resetCronEvent']);
    }

    /* ---
      Functions
    --- */

    public function refreshRewriteRules()
    {
      do_action(LoaderAbstract::ACTION_NAME, false);
    }

    public function resetCronEvent()
    {
      wp_clear_scheduled_hook(Cron::CRON_ACTION);
    }
  }