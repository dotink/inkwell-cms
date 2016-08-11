<?php namespace Inkwell\CMS\Plugin
{
	use Inkwell\CMS;
	use Inkwell\View;
	use Inkwell\Controller\BaseController;

	/**
	 *
	 */
	abstract class AbstractPlugin extends BaseController implements CMS\Plugin
	{
		/**
		 *
		 */
		static protected $description = NULL;


		/**
		 *
		 */
		static protected $name = NULL;


		/**
		 *
		 */
		static protected $vendor = NULL;


		/**
		 *
		 */
		static protected $version = NULL;


		/**
		 *
		 */
		static public function getDescription()
		{
			if (!static::$description) {
				return 'A non-descript plugin.';
			}

			return static::$description;
		}


		/**
		 *
		 */
		static public function getName()
		{
			if (!static::$name) {
				$class_parts = explode('\\', static::class);

				return array_pop($class_parts);
			}

			return static::$name;
		}


		/**
		 *
		 */
		static public function getVersion()
		{
			if (!static::$version) {
				return '1.0';
			}

			return static::$version;
		}


		/**
		 *
		 */
		static public function getVendor()
		{
			if (!static::$vendor) {
				$class_parts = explode('\\', static::class);

				return array_shift($class_parts);
			}

			return static::$vendor;
		}


		/**
		 *
		 */
		static public function route($group)
		{
			$group->link('/', get_called_class() . '::manage');
		}


		/**
		 *
		 */
		public function manage()
		{
			return $this->response->set('This plugin is not configured properly.');
		}


		/**
		 *
		 */
		public function render($data = array())
		{
			$action = $this->router->getAction()[1];

			$this->view->load(implode('/', [
				'plugin',
				$this->getVendor(),
				$this->getName(),
				$action . '.html'
			]), $data);

			return $this->response->set($this->view);
		}


		/**
		 *
		 */
		public function setView(View $view)
		{
			$this->view = $view;
		}
	}
}
