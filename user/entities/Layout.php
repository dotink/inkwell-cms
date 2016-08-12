<?php

	/**
	 *
	 */
	class Layout extends Base\Layout
	{
		/**
		 * Instantiate a new Layout
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
