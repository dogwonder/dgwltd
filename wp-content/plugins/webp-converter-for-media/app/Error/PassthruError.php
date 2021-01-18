<?php

  namespace WebpConverter\Error;

  use WebpConverter\Error\ErrorAbstract;
  use WebpConverter\Error\ErrorInterface;
  use WebpConverter\Loader\Passthru;

  class PassthruError extends ErrorAbstract implements ErrorInterface
  {
    /* ---
      Functions
    --- */

    public function getErrorCodes()
    {
      $errors = [];

      if ($this->ifPassthruExecutionAllowed() !== true) {
        $errors[] = 'passthru_execution';
      }

      return $errors;
    }

    private function ifPassthruExecutionAllowed()
    {
      if (Passthru::isActiveLoader() !== true) {
        return true;
      }

      $url = Passthru::getLoaderUrl() . '?nocache=1';
      $ch  = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_NOBODY, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_TIMEOUT, 3);
      curl_exec($ch);
      $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);

      return ($code === 200);
    }
  }