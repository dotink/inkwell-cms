<?php namespace Inkwell\CMS\Plugin
{
	use Inkwell\CMS;

	class People extends AbstractPlugin
	{
		static protected $description = 'Manage people and give them access as users';
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
