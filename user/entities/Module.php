<?php

	class Module extends Base\Module implements JsonSerializable
	{
		use Inkwell\Doctrine\JsonEntity;

		static $jsonObjectConfig = [
			'content' => 'getData'
		];

		/**
		 * Instantiate a new Module
		 */
		public function __construct()
		{
			$this->setDateCreated(new DateTime());

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
