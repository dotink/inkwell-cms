<?php

	class Partial extends Base\Partial
	{

		/**
		 * Instantiate a new Partial
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
