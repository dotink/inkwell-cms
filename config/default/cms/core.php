<?php

	use IW\HTTP;

	return Affinity\Config::create(['routes', 'providers'], [
		'@providers' => [
			'mapping' => [
				'Twig_LoaderInterface' => 'Inkwell\CMS\Loader'
			]
		],

		'base_urls' => [
			'plugins'  => $app->getEnvironment('PLUGIN_BASE_URL', '/admin'),
			'routines' => $app->getEnvironment('ROUTINE_BASE_URL', '/api')
		]
	]);
