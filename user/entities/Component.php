<?php namespace {

	class Component extends Base\Component implements JsonSerializable
	{
		use Inkwell\Doctrine\JsonEntity;

		static $jsonObjectConfig = [
			'content' => 'getData',
			'module'  => 'getId'
		];

		/**
		 * Instantiate a new Component
		 */
		public function __construct()
		{
			return parent::__construct();
		}


		/**
		 *
		 */
		public function fetchContent()
		{
			return $this->getContent()
				? $this->getContent()->getData()
				: NULL;
		}
	}
}
