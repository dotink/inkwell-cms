<?php
	return Affinity\Config::create(['cms:plugins'], [
		'@cms:plugins' => [
			'entries' => [
				'content.pages'          => 'Inkwell\CMS\Plugin\Pages',
				'content.layouts'        => 'Inkwell\CMS\Plugin\Layouts',
				'content.partials'       => 'Inkwell\CMS\Plugin\Partials',
				'content.blocks'         => 'Inkwell\CMS\Plugin\Blocks',
				'entities.people'        => 'Inkwell\CMS\Plugin\People',
				'entities.organizations' => 'Inkwell\CMS\Plugin\Organizations',
			]
		]
	]);
