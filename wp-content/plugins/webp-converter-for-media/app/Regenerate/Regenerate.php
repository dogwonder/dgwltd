<?php

  namespace WebpConverter\Regenerate;

  use WebpConverter\Method\MethodIntegrator;

  class Regenerate
  {
    /* ---
      Functions
    --- */

    public function convertImages($paths)
    {
      $settings   = apply_filters('webpc_get_values', []);
      $errors     = [];
      $sizeBefore = 0;
      $sizeAfter  = 0;

      $convertMethod = (new MethodIntegrator())->getMethodUsed($settings['method']);
      if ($convertMethod === null) {
        return false;
      }

      foreach ($paths as $path) {
        $response = $convertMethod->convertImage($path);

        if ($response['success'] !== true) {
          $errors[] = $response['message'];
        } else {
          $sizeBefore += $response['data']['size_before'];
          $sizeAfter  += $response['data']['size_after'];
        }
      }
      $errors = array_filter($errors);

      return [
        'errors' => apply_filters('webpc_convert_errors', $errors),
        'size'   => [
          'before' => $sizeBefore,
          'after'  => $sizeAfter,
        ],
      ];
    }
  }