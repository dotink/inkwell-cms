<?php namespace Inkwell\CMS
{
	use Page;
	use Twig_Environment;
	use Dotink\Flourish\Collection;

	class Composer
	{
		/**
		 *
		 */
		public function __construct(Twig_Environment $twig)
		{
			$this->twig = $twig;
		}


		/**
		 *
		 */
		public function addModule(PageModule $module, Collection $data)
		{

		}


		/**
		 *
		 */
		public function render(Page $page, Collection $data)
		{
			return $this->twig->render($page->getLayout()->getContent()->getId(), $data->get());
		}
	}
}
