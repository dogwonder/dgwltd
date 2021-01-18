<?php

  /**
   * Loads images in WebP format or original images if browser does not support WebP.
   *
   * @category WordPress Plugin
   * @package  WebP Converter for Media
   * @author   Mateusz Gbiorczyk
   * @link     https://wordpress.org/plugins/webp-converter-for-media/
   */

  class PassthruLoader
  {
    const PATH_UPLOADS = '';
    const PATH_UPLOADS_WEBP = '';

    public function __construct()
    {
      if (!isset($_GET['src'])) {
        return;
      }

      $this->loadImageWebP($_GET['src']);
    }

    private function loadImageWebP($imageUrl)
    {
      $header = getallheaders()['Accept'] ?? '';
      if ((strpos($header, 'image/webp') === false)
        || (!$source = $this->loadWebpSource($imageUrl))) {
        return $this->loadImageDefault($imageUrl);
      }

      header('Content-Type: image/webp');
      echo $source;
    }

    private function loadImageDefault($imageUrl)
    {
      header('Location: ' . $imageUrl);
    }

    private function loadWebpSource($imageUrl)
    {
      $url = $this->generateWebpUrl($imageUrl);
      $ch  = curl_init($url);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

      $response = curl_exec($ch);
      $code     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);

      if (($code !== 200) || !$response) {
        return null;
      } else {
        return $response;
      }
    }

    private function generateWebpUrl($imageUrl)
    {
      return str_replace(self::PATH_UPLOADS, self::PATH_UPLOADS_WEBP, $imageUrl) . '.webp';
    }
  }

  new PassthruLoader();