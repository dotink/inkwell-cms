<?php

	return Affinity\Action::create(['routing'], function($app, $broker) {
		//
		// Register any plugins
		//

		$plugin_base_url  = $this->fetch('cms/core', 'base_urls.plugins', '/admin');
		$routine_base_url = $this->fetch('cms/core', 'base_urls.routines', '/api');
		$app['registry']  = $broker->make('Inkwell\CMS\Plugin\Registry');

		$app['registry']->setPluginBaseUrl($plugin_base_url);
		$app['registry']->setRoutineBaseUrl($routine_base_url);

		foreach ($this->fetch('@cms:plugins', 'entries', array()) as $id => $plugins) {
			foreach ($plugins as $entry => $plugin) {
				$app['registry']->addPlugin($plugin, $entry);
				$app['routes']->base($plugin_base_url . '/' . $entry, [$plugin, 'route']);
			}
		}

		foreach ($this->fetch('@cms:routines', 'entries', array()) as $id => $routines) {
			foreach ($routines as $entry => $routine) {
				$app['registry']->addRoutine($routine, $entry);
				$app['routes']->base($routine_base_url . '/' . $entry, [$routine, 'route']);
			}
		}

		$app['routes']->link($plugin_base_url, '/', 'Inkwell\CMS\MainController::dashboard');

		//
		// Create a catch all route (must be last) for our main controller
		//

		$app['routes']->link('/', '[(?:.*):1]', 'Inkwell\CMS\MainController::page');

		$broker->share($app['registry']);

		$broker->prepare('Inkwell\CMS\Plugin', function($plugin, $broker) use ($app) {
			$view = $broker->make('Inkwell\View', [
				':root_directory' => $app->getDirectory('user/templates/cms')
			])->set([
				'plugin'   => $plugin,
				'registry' => $app['registry'],
			]);

			$plugin->setView($view);
		});
	});
