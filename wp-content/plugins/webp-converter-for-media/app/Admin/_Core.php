<?php

  namespace WebpConverter\Admin;

  class _Core
  {
    public function __construct()
    {
      new Modal();
      new Notice();
      new Plugin();
    }
  }