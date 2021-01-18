<?php

  namespace WebpConverter\Method;

  use WebpConverter\Convert\Directory;
  use WebpConverter\Convert\Server;

  interface MethodInterface
  {
    /* ---
      Functions
    --- */

    public function getSettings($settingsKey);

    public static function isMethodInstalled();

    public static function isMethodActive();

    public function convertImage($path);

    public function getImageSourcePath($sourcePath);

    public function createImageByPath($sourcePath);

    public function getImageOutputPath($sourcePath);

    public function convertImageToWebP($image, $sourcePath, $outputPath);

    public function getConversionStats($sourcePath, $outputPath);
  }