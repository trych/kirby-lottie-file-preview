<?php

if (class_exists('Kirby\Panel\Ui\FilePreview') === false) {
	return;
}

use trych\LottieFilePreview\LottieFilePreview;

@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('trych/lottie-file-preview', [
	'filePreviews' => [
	  LottieFilePreview::class
	],

	'translations' => [
		'en' => [
			'trych.lottie-file-preview.author' => 'Author',
			'trych.lottie-file-preview.license' => 'License'
		],
		'de' => [
			'trych.lottie-file-preview.author' => 'Autor',
			'trych.lottie-file-preview.license' => 'Lizenz'
		]
	],

	'options' => [

		'controls' => true,
		'autoplay' => true,
		'loop' => true,
		'controls' => true,
		'autoplay' => true,
		'loop' => true,
		'speed' => 1,
		'background' => 'transparent',
		'direction' => 1, // 1 = forward, -1 = reverse
		'mode' => 'normal', // 'normal' or 'bounce'

		'details' => [
			[
				'title' => '{{ t("trych.lottie-file-preview.author", "Author") }}',
				'text' => '{{ file.author }}',
				'link' => '{{ file.authorlink.toUrl }}'
			],
			[
				'title' => '{{ t("trych.lottie-file-preview.license", "License") }}',
				'text' => '{{ file.license }}',
				'link' => '{{ file.licenselink.toUrl }}'
			]
		]

	]
]);
