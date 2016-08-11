<?php namespace {

	class Layout extends Base\Layout implements Tenet\AccessInterface
	{
		use Tenet\Access\AccessibleTrait;

		/**
		 * Instantiate a new Layout
		 */
		public function __construct()
		{
			return parent::__construct();
		}
	}
}
