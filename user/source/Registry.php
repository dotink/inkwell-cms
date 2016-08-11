<?php namespace Inkwell\CMS\Plugin
{

	use Inkwell\Core;

	/**
	 *
	 */
	class Registry
	{
		private $baseURL = '/';

		private $plugins = array();

		/**
		 *
		 */
		public function add($entry, $plugin, array $settings = array())
		{
			list($module, $tool) = explode('.', strtolower($entry));

			if (!$this->hasModule($module)) {
				$this->plugins[$module] = [$tool => $plugin];
			} else {
				$this->plugins[$module][$tool] = $plugin;
			}
		}


		/**
		 *
		 */
		public function anchor($module = NULL, $tool = NULL, $collection = TRUE)
		{
			if (!$module) {
				$url = $this->baseURL;
			} else {
				if (!$tool) {
					$tool = $this->getTools($module)[0];
				}

				$url = implode('/', [$this->baseURL, $module, $tool]);
			}

			return $url . ($collection ? '/' : '');
		}


		/**
		 *
		 */
		public function checkModule($plugin, $module)
		{
			if (!$this->hasModule($module)) {
				return FALSE;
			}

			return array_search(get_class($plugin), $this->plugins[$module]);
		}


		/**
		 *
		 */
		public function getModules()
		{
			return array_keys($this->plugins);
		}


		/**
		 *
		 */
		public function getTools($module)
		{
			if (!$this->hasModule($module)) {
				return array();
			}

			return array_keys($this->plugins[strtolower($module)]);
		}


		/**
		 *
		 */
		public function getPath($plugin)
		{
			return array_search($plugin, $this->getPlugins());
		}


		/**
		 *
		 */
		public function getPlugin($module, $tool)
		{
			return isset($this->plugins[$module][$tool])
				? $this->plugins[$module][$tool]
				: NULL;
		}


		/**
		 *
		 */
		public function getPlugins()
		{
			$plugins = array();

			foreach ($this->plugins as $module => $tools) {
				foreach ($tools as $tool => $plugin) {
					$plugins[$module . '/' . $tool] = $plugin;
				}
			}

			return $plugins;
		}


		/**
		 *
		 */
		public function hasModule($module)
		{
			return isset($this->plugins[strtolower($module)]);
		}


		/**
		 *
		 */
		public function setBaseUrl($base_url)
		{
			$this->baseURL = $base_url;
		}
	}
}
