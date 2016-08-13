<?php namespace Inkwell\CMS
{
	use Page;
	use Twig_Environment;
	use Dotink\Flourish\Collection;
	use Wa72\HtmlPageDom\HtmlPageCrawler;

	class Composer
	{
		/**
		 *
		 */
		public function __construct(Twig_Environment $twig, HtmlPageCrawler $dom)
		{
			$this->twig = $twig;
			$this->dom  = $dom;

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
			$output = $this->twig->render($page->getLayout()->getContent()->getId(), $data->get());
			$dom    = $this->dom->create($output);

			return $dom;

		}


		/**
		 *
		 */
		public function setEditable($editable)
		{
			$this->editable = TRUE;
		}
	}
}
