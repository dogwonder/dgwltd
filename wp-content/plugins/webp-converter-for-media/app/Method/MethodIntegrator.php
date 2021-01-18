<?php

  namespace WebpConverter\Method;

  use WebpConverter\Method\Gd;
  use WebpConverter\Method\Imagick;
  use WebpConverter\Settings\Errors;

  class MethodIntegrator
  {
    /* ---
      Functions
    --- */

    public function getMethodsActive()
    {
      $list = [];
      if (Gd::isMethodActive()) {
        $list[] = Gd::METHOD_NAME;
      }
      if (Imagick::isMethodActive()) {
        $list[] = Imagick::METHOD_NAME;
      }
      return $list;
    }

    public function getMethodUsed($methodKey)
    {
      if (get_option(Errors::ERRORS_CACHE_OPTION, [])) {
        return null;
      }

      if ($methodKey === Gd::METHOD_NAME) {
        return (new Gd());
      } else if ($methodKey === Imagick::METHOD_NAME) {
        return (new Imagick());
      }
      return null;
    }
  }