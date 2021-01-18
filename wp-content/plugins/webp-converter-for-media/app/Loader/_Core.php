<?php

  namespace WebpConverter\Loader;

  class _Core
  {
    public function __construct()
    {
      new Htaccess();
      new Passthru();
    }
  }