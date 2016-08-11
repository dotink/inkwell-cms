<?php

	return Affinity\Action::create(['routing'], function($app, $broker) {
		//
		// Register any plugins
		//

		$base_url = $this->fetch('cms/core', '@routes.base_url', '/admin');
		$registry = $broker->make('Inkwell\CMS\Plugin\Registry');

		$registry->setBaseUrl($base_url);

		foreach ($this->fetch('@cms:plugins', 'entries', array()) as $id => $plugins) {
			foreach ($plugins as $entry => $plugin) {
				$registry->add($entry, $plugin);
			}
		}

		foreach ($registry->getPlugins() as $path => $plugin) {
			$app['routes']->base($base_url . '/' . $path, [$plugin, 'route']);
		}

		//
		// Create a catch all route (must be last) for our main controller
		//

		$app['routes']->link('/', '[(?:.*):1]', 'Inkwell\CMS\MainController::page');


		$broker->share($registry);
		$broker->delegate('Inkwell\CMS\Composer', function() {});
		$broker->prepare('Inkwell\CMS\Plugin', function($plugin, $broker) use ($app, $registry) {
			$view = $broker->make('Inkwell\View', [
				':root_directory' => $app->getDirectory('user/templates/cms')
			])->set([
				'plugin'   => $plugin,
				'registry' => $registry,
			]);

			$plugin->setView($view);
		});
	});
