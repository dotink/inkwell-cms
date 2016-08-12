<?php namespace Inkwell\CMS\Plugin
{

	use Inkwell\Core;
	use Dotink\Flourish;

	/**
	 *
	 */
	class Registry
	{
		protected $pluginBaseUrl  = '/admin';
		protected $pluginMap = array();
		protected $plugins = array();

		protected $routineBaseUrl = '/api';
		protected $routineMap = array();
		protected $routines = array();


		/**
		 *
		 */
		public function addPlugin($plugin, $entry)
		{
			if (isset($this->plugins[$entry])) {
				throw new Flourish\ProgrammerException();
			}

			$parts = explode('/', $entry);

			if (count($parts) != 2) {
				throw new Flourish\ProgrammerException();
			}

			if (!isset($this->pluginMap[$parts[0]])) {
				$this->pluginMap[$parts[0]] = [$parts[1] => $plugin];
			} else {
				$this->pluginMap[$parts[0]][$parts[1]] = $plugin;
			}

			$this->plugins[$entry] = $plugin;
		}


		/**
		 *
		 */
		public function addRoutine($routine, $entry)
		{
			if (isset($this->routine[$entry])) {
				throw new Flourish\ProgrammerException();
			}

			$parts = explode('/', $entry);

			if (count($parts) != 2) {
				throw new Flourish\ProgrammerException();
			}

			if (!isset($this->routineMap[$parts[0]])) {
				$this->routineMap[$parts[0]] = [$parts[1] => $routine];
			} else {
				$this->routineMap[$parts[0]][$parts[1]] = $routine;
			}

			$this->routines[$entry] = $routine;
		}


		/**
		 *
		 */
		public function getPluginBaseUrl()
		{
			return $this->pluginBaseUrl;
		}


		/**
		 *
		 */
		public function getPluginMap()
		{
			return $this->pluginMap;
		}


		/**
		 *
		 */
		public function getRoutineBaseUrl()
		{
			return $this->routineBaseUrl;
		}


		/**
		 *
		 */
		public function getRoutineMap()
		{
			return $this->routineMap;
		}


		/**
		 *
		 */
		public function anchor($class)
		{
			if ($entry = array_search($class, $this->plugins)) {
				$base = $this->pluginBaseUrl;
			} elseif ($entry = array_search($class, $this->routines)) {
				$base = $this->routineBaseUrl;
			} else {
				throw new Flourish\ProgrammerException();
			}

			return implode('/', [$base, $entry]);
		}


		/**
		 *
		 */
		public function setPluginBaseUrl($plugin_base_url)
		{
			$this->pluginBaseUrl = $plugin_base_url;
		}


		/**
		 *
		 */
		public function setRoutineBaseUrl($routine_base_url)
		{
			$this->routineBaseUrl = $routine_base_url;
		}
	}
}
