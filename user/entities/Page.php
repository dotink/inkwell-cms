<?php

	/**
	 *
	 */
	class Page extends Base\Page
	{
		/**
		 * Instantiate a new Page
		 */
		public function __construct()
		{
			$this->setDateCreated(new DateTime());

			return parent::__construct();
		}
	}
