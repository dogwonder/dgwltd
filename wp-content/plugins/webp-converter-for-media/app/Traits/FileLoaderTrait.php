<?php

  namespace WebpConverter\Traits;

  use WebpConverter\Loader\Passthru;

  trait FileLoaderTrait
  {
    /* ---
      Functions
    --- */

    private function getFileSizeByUrl($url, $setHeaders = true)
    {
      $headers = [
        'Accept: image/webp',
        'Referer: ' . WEBPC_URL,
      ];

      $imageUrl = Passthru::updateImageUrls($url);
      return $this->getFileSizeForLoadedFile($imageUrl, ($setHeaders) ? $headers : []);
    }

    private function getFileSizeByPath($path)
    {
      if (!file_exists($path)) return 0;
      return filesize($path);
    }

    private function getFileSizeForLoadedFile($url, $headers)
    {
      foreach (wp_get_nocache_headers() as $headerKey => $headerValue) {
        $headers[] = sprintf('%s: %s', $headerKey, $headerValue);
      }

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 10);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      $response = curl_exec($ch);
      $code     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);

      return ($code === 200) ? strlen($response) : 0;
    }
  }