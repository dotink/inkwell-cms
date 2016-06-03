<?php namespace Inkwell
{
	use IW;
	use Affinity;
	use Auryn\Injector;
	use Dotenv\Dotenv;

	use Whoops;
	use Whoops\Exception\Inspector;
	use Whoops\Handler\PlainTextHandler;
	use Whoops\Handler\PrettyPageHandler;

	use InvalidArgumentException;

	ini_set('error_reporting', E_ALL);

	//
	// Autoloading
	//

	$loader = require 'vendor/autoload.php';

	//
	// Load Environment
	//

	if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . '.env')) {
		$dotenv = new Dotenv(__DIR__);
		$dotenv->load();
	}

	//
	// Load Constants
	//

	$constants = require 'constants.php';

 	foreach ($constants as $const => $value) {
		define('IW\\' . $const, $value);
	}

	$error_target  = getenv('ERROR_TARGET');
	$debug_manager = new Whoops\Run;

	if ($error_target && $error_target != IW\ERROR\TARGET_NULL) {
		switch ($error_target) {
			case IW\ERROR\TARGET_RESPONSE:
				$debug_manager->pushHandler(new PlainTextHandler());
				$debug_manager->pushHandler(new PrettyPageHandler());
				break;

			default:
				$debug_manager->pushHandler(function($exception, $inspector, $manager) use ($error_target) {

					$body = sprintf("%s: %s in file %s on line %d",
						get_class($exception),
						$exception->getMessage(),
						$exception->getFile(),
						$exception->getLine()
					);

					$body .= "\n\nENVIRONMENT: \n\n" . print_r($_ENV, TRUE);
					$body .= "\n\nSERVER: \n\n" . print_r($_SERVER, TRUE);
					$body .= "\n\nPOST: \n\n" . print_r($_POST, TRUE);
					$body .= "\n\nGET: \n\n" . print_r($_GET, TRUE);

					mail(
						$error_target,
						sprintf(
							'Site/Application Error: %s',
							isset($_SERVER['SERVER_NAME'])
								? $_SERVER['SERVER_NAME']
								: __DIR__
						),
						$body
					);

					include(__DIR__ . '/500.php');
				});

				break;
		}

		$debug_manager->register();
	}

	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);

	$app  	= new Core(realpath(__DIR__));
	$broker = new Injector();

	$broker->share($app);

	$action_dir    = $app->getDirectory($app->getEnvironment('IW_ACTION_ROOT', 'boot'));
	$config_dir    = $app->getDirectory($app->getEnvironment('IW_CONFIG_ROOT', 'config'));
	$environment   = $app->getEnvironment('IW_ENVIRONMENT', 'prod');

	$app['broker'] = $broker;
	$app['loader'] = $loader;
	$app['engine'] = new DefaultEngine(
		new Affinity\NativeDriver($config_dir),
		new Affinity\NativeDriver($action_dir)
	);

	$app['engine']->start($environment, ['app' => $app, 'broker' => $broker]);

	return $app;
}
