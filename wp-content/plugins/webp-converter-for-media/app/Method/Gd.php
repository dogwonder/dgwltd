<?php

  namespace WebpConverter\Method;

  use WebpConverter\Method\MethodAbstract;
  use WebpConverter\Method\MethodInterface;

  class Gd extends MethodAbstract implements MethodInterface
  {
    const METHOD_NAME = 'gd';

    /* ---
      Functions
    --- */

    public static function isMethodInstalled()
    {
      return (extension_loaded('gd'));
    }

    public static function isMethodActive()
    {
      return (self::isMethodInstalled() && function_exists('imagewebp'));
    }

    public function createImageByPath($sourcePath)
    {
      $extension = strtolower(pathinfo($sourcePath, PATHINFO_EXTENSION));
      $methods   = apply_filters('webpc_gd_create_methods', [
        'imagecreatefromjpeg' => ['jpg', 'jpeg'],
        'imagecreatefrompng'  => ['png'],
        'imagecreatefromgif'  => ['gif'],
      ]);

      foreach ($methods as $method => $extensions) {
        if (!in_array($extension, $extensions)) {
          continue;
        } else if (!function_exists($method)) {
          $e         = new \Exception(sprintf('Server configuration: "%s" function is not available.', $method));
          $e->status = 'server_configuration';
          throw $e;
        } else if (!$image = @$method($sourcePath)) {
          $e         = new \Exception(sprintf('"%s" is not a valid image file.', $sourcePath));
          $e->status = 'invalid_image';
          throw $e;
        }
      }

      if (!isset($image)) {
        $e         = new \Exception(sprintf('Unsupported extension "%s" for file "%s"', $extension, $sourcePath));
        $e->status = 'unsupported_extension';
        throw $e;
      }

      return $this->updateImageResource($image);
    }

    private function updateImageResource($image)
    {
      if (!function_exists('imageistruecolor')) {
        $e         = new \Exception(sprintf('Server configuration: "%s" function is not available.', 'imageistruecolor'));
        $e->status = 'server_configuration';
        throw $e;
      }

      if (!imageistruecolor($image)) {
        if (!function_exists('imagepalettetotruecolor')) {
          $e         = new \Exception(sprintf('Server configuration: "%s" function is not available.', 'imagepalettetotruecolor'));
          $e->status = 'server_configuration';
          throw $e;
        }
        imagepalettetotruecolor($image);
      }

      return $image;
    }

    public function convertImageToWebP($image, $sourcePath, $outputPath)
    {
      $image = apply_filters('webpc_gd_before_saving', $image, $sourcePath);

      if (!function_exists('imagewebp')) {
        $e         = new \Exception(sprintf('Server configuration: "%s" function is not available.', 'imagewebp'));
        $e->status = 'server_configuration';
        throw $e;
      } else if ((imagesx($image) > 8192) || (imagesy($image) > 8192)) {
        $e         = new \Exception(sprintf('Image is larger than maximum 8K resolution: "%s".', $sourcePath));
        $e->status = 'max_resolution';
        throw $e;
      } else if (!$success = imagewebp($image, $outputPath, $this->getSettings('quality'))) {
        $e         = new \Exception(sprintf('Error occurred while converting image: "%s".', $sourcePath));
        $e->status = 'convert_error';
        throw $e;
      }

      if (filesize($outputPath) % 2 === 1) {
        file_put_contents($outputPath, "\0", FILE_APPEND);
      }
    }
  }