<?php

  namespace WebpConverter\Settings;

  use WebpConverter\Method\MethodIntegrator;

  class Methods
  {
    private $cache = null;

    public function __construct()
    {
      add_filter('webpc_get_methods', [$this, 'getAvaiableMethods']);
    }

    /* ---
      Functions
    --- */

    public function getAvaiableMethods()
    {
      if ($this->cache !== null) return $this->cache;

      $this->cache = (new MethodIntegrator())->getMethodsActive();
      return $this->cache;
    }
  }