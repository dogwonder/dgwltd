<?php

  namespace WebpConverter\Method;

  use WebpConverter\Method\MethodAbstract;
  use WebpConverter\Method\MethodInterface;

  class Imagick extends MethodAbstract implements MethodInterface
  {
    const METHOD_NAME = 'imagick';

    /* ---
      Functions
    --- */

    public static function isMethodInstalled()
    {
      return (extension_loaded('imagick') && class_exists('\Imagick'));
    }

    public static function isMethodActive()
    {
      if (!self::isMethodInstalled()) {
        return false;
      }

      $formats = (new \Imagick)->queryformats();
      return (in_array('WEBP', $formats));
    }

    public function createImageByPath($sourcePath)
    {
      $extension = strtolower(pathinfo($sourcePath, PATHINFO_EXTENSION));
      if (!extension_loaded('imagick') || !class_exists('Imagick')) {
        $e         = new \Exception('Server configuration: Imagick module is not available with this PHP installation.');
        $e->status = 'server_configuration';
        throw $e;
      } else if (!$image = new \Imagick($sourcePath)) {
        $e         = new \Exception(sprintf('"%s" is not a valid image file.', $sourcePath));
        $e->status = 'invalid_image';
        throw $e;
      }

      if (!isset($image)) {
        $e         = new \Exception(sprintf('Unsupported extension "%s" for file "%s"', $extension, $sourcePath));
        $e->status = 'unsupported_extension';
        throw $e;
      }

      return $image;
    }

    public function convertImageToWebP($image, $sourcePath, $outputPath)
    {
      $image = apply_filters('webpc_imagick_before_saving', $image, $sourcePath);

      if (!in_array('WEBP', $image->queryFormats())) {
        $e         = new \Exception('Server configuration: Imagick does not support WebP format.');
        $e->status = 'server_configuration';
        throw $e;
      }

      $image->setImageFormat('WEBP');
      if (!in_array('keep_metadata', $this->getSettings('features'))) {
        $image->stripImage();
      }
      $image->setImageCompressionQuality($this->getSettings('quality'));
      $blob = $image->getImageBlob();

      $success = file_put_contents($outputPath, $blob);
      if (!$success) {
        $e         = new \Exception('Error occurred while converting image.');
        $e->status = 'convert_error';
        throw $e;
      }
    }
  }