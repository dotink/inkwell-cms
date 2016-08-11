<?php namespace Inkwell\CMS
{
	use Page;
	use Twig_Environment;

	class Composer
	{
		/**
		 *
		 */
		public function __construct(Twig_Environment $layout)
		{
			$this->layout = $layout;
		}


		/**
		 *
		 */
		public function render(Page $page, $params = array())
		{
			return $this->layout->render($page->getLayout()->getName(), [
				'this' => $params
			]);
		}
	}
}
