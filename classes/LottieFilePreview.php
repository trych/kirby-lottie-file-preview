<?php

namespace trych\LottieFilePreview;

use Kirby\Cms\File;
use Kirby\Panel\Ui\FilePreview;
use Kirby\Toolkit\Str;
use Exception;

class LottieFilePreview extends FilePreview
{
  public function __construct(
    public File $file,
    public string $component = 'k-lottie-file-preview'
  ) {
  }

  public static function accepts(File $file): bool
  {
    // only check JSON files
    if ($file->extension() !== 'json') {
      return false;
    }

    // try to parse and check for Lottie properties
    try {
      $content = $file->read();
      $data = json_decode($content, true);

      if (!is_array($data)) {
        return false;
      }

      // check for essential Lottie properties
      // 'v' = version, 'fr' = framerate, 'ip' = in point, 'op' = out point
      return isset($data['v']) &&
             isset($data['fr']) &&
             isset($data['ip']) &&
             isset($data['op']) &&
             isset($data['layers']);
    } catch (Exception $e) {
      return false;
    }
  }

  public function details(): array
  {
    $baseDetails = parent::details();

    // Get custom details configuration
    $customDetails = option('trych.lottie-file-preview.details');

    // If details are disabled, return only base details
    if ($customDetails === false || $customDetails === null) {
      return $baseDetails;
    }

    // Build custom detail items
    foreach ($customDetails as $detail) {

      if (!isset($detail['title'])) {
         continue;
      }

      $detailItem = [
        'title' => $this->resolveTemplate($detail['title'])
      ];

      if (isset($detail['text'])) {
        $detailItem['text'] = $this->resolveTemplate($detail['text']);
      }

      if (isset($detail['link'])) {
        $detailItem['link'] = $this->resolveTemplate($detail['link']);
      }

      $baseDetails[] = $detailItem;
    }

    return $baseDetails;
  }

  private function resolveTemplate(string $template): string
  {
    $result = Str::template($template, [
      'kirby' => kirby(),
      'site' => site(),
      'page' => $this->file->page(),
      'file' => $this->file,
      'user' => kirby()->user()
    ], ['fallback' => '-']);

    // return fallback if result is empty
    return !empty(trim($result)) ? $result : '-';
  }

  public function props(): array
  {
    // check if local file exists
    $localAsset = $this->file->kirby()->plugin('trych/lottie-file-preview')->asset('lottie-player.js');

    if ($localAsset && file_exists($localAsset->root())) {
      $assetUrl = $localAsset->mediaUrl();
    } else {
      // fallback to CDN
      $assetUrl = 'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js';
    }

    return [
      ...parent::props(),
      'asset' => $assetUrl,
      'playerOptions' => [
        'controls' => option('trych.lottie-file-preview.controls', false),
        'autoplay' => option('trych.lottie-file-preview.autoplay', true),
        'loop' => option('trych.lottie-file-preview.loop', true),
        'speed' => option('trych.lottie-file-preview.speed', 1),
        'background' => option('trych.lottie-file-preview.background', 'transparent'),
        'direction' => option('trych.lottie-file-preview.direction', 1),
        'mode' => option('trych.lottie-file-preview.mode', 'normal')
      ]
    ];
  }
}
