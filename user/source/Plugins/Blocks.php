<?php namespace Inkwell\CMS\Plugin
{
	use Inkwell\CMS;

	class Blocks extends AbstractPlugin
	{
		static protected $description = 'Manage partial content that can be placed in layouts';
		static protected $version = '1.0';


		/**
		 *
		 */
		public function manage()
		{
			return $this->render();
		}
	}
}
