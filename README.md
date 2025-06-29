# Kirby Lottie File Preview

A Kirby CMS plugin that adds [Lottie](https://lottiefiles.com/) animation file previews to the panel.

![Kirby Lottie File Preview](https://raw.githubusercontent.com/trych/kirby-lottie-file-preview/refs/heads/assets/screenshots/lottie-field-preview.webp)

## Features

- 🎬 Preview Lottie animations directly in the Kirby Panel
- ⚙️ Configurable player options (controls, autoplay, loop, speed, etc.)
- 🔧 Custom detail fields support

## Installation

### Via Composer (recommended)

```bash
composer require trych/kirby-lottie-file-preview
```

### Manual Installation

1. Download the latest release
2. Extract to `site/plugins/lottie-file-preview`

### Via Git Submodule

```bash
git submodule add https://github.com/trych/kirby-lottie-file-preview.git site/plugins/lottie-file-preview
```

## Requirement

- Kirby v5

## Usage

The plugin automatically adds a preview for Lottie JSON files in the panel file view. No additional configuration is required for basic usage.

## Configuration

You can customize the plugin behavior with the following properties in your `config.php` (shown are the default values):

```php
<?php
return [
  'trych.lottie-file-preview' => [
    'controls' => true,            // show player controls
    'autoplay' => true,            // auto-play animations
    'loop' => true,                // loop animations
    'speed' => 1,                  // playback speed
    'background' => 'transparent', // background color
    'direction' => 1,              // 1 = forward, -1 = reverse
    'mode' => 'normal',            // 'normal' or 'bounce'

    // custom detail fields
    'details' => [
      [
        'title' => 'Author',
        'text' => '{{ file.author }}',
        'link' => '{{ file.authorlink.toUrl }}'
      ],
      [
        'title' => 'License',
        'text' => '{{ file.license }}',
        'link' => '{{ file.licenselink.toUrl }}'
      ]
    ]
  ]
];
```

As shown above, the detail text and link accepts Kirby query strings.

## Asset Loading

The plugin automatically handles loading the Lottie player library:

- **Default**: Uses CDN ([unpkg.com](https://unpkg.com/)) - cached by browser, always up-to-date
- **Offline support**: Automatically uses local copy if `assets/lottie-player.js` exists

### For Offline Usage (Optional)

If you need offline support, simply download the Lottie player:

```bash
# Download latest version
curl -o assets/lottie-player.js https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js
```
Or download it manually and place it in `site/plugins/lottie-file-preview/assets/lottie-player.js`.

The plugin will detect and use the local file.

## Credits

- Built with [LottieFiles Lottie Player](https://github.com/LottieFiles/lottie-player)
- Powered by [Kirby CMS](https://getkirby.com)
- Preview animation by [Paul Voggenreiter](https://paulvoggenreiter.eu/)

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for details.

## License

[MIT](./LICENSE) License © 2025 [Timo Rychert](https://github.com/trych)
