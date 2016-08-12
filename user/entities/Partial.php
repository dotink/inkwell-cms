<?php

	class Partial extends Base\Partial
	{

		/**
		 * Instantiate a new Partial
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
