<?php namespace Inkwell\CMS\Plugin
{
	use Inkwell\CMS;

	class Organizations extends AbstractPlugin
	{
		static protected $description = 'Manage organizations and companies that link to people';
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
