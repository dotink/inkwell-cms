<?php namespace {

	class Page extends Base\Page implements Tenet\AccessInterface
	{
		use Tenet\Access\AccessibleTrait;

		/**
		 * Instantiate a new Page
		 */
		public function __construct()
		{
			return parent::__construct();
		}

	}

}
