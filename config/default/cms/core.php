<?php

	use IW\HTTP;

	return Affinity\Config::create(['routes'], [
		//
		// Global routing configuration
		//

		'@routes' => [

			//
			// The base URL for all configured anchors, handlers, and redirects in this
			// context
			//

			'base_url' => '/admin',

			//
			//
			//

			'links' => [
				'/'             => 'Inkwell\CMS\MainController::dashboard',
				'/[!:section]/' => 'Inkwell\CMS\MainController::section'
			],

			//
			//
			//

			'handlers' => [

			],

			//
			//
			//

			'redirects' => [

			]
		]
	]);
