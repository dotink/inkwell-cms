<?php namespace Inkwell\CMS
{
	use Page;
	use Component;
	use Twig_Environment;
	use Dotink\Flourish\Collection;
	use Wa72\HtmlPageDom\HtmlPageCrawler;

	class Composer
	{
		private $components = array();


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
		public function addComponent(Component $component, Collection $data)
		{
			$container = $component->getContainer();
			$position  = $component->getPosition();
			$output    = $this->twig->render($component->getContent()->getId(), $data->get());

			if (!isset($this->components[$container])) {
				$this->components[$container] = array();
			}

			$this->components[$container][$position] = $this->dom->create($output);
		}


		/**
		 *
		 */
		public function render(Page $page, Collection $data)
		{
			$layout = $page->getLayout();
			$output = $this->twig->render($layout->getContent()->getId(), $data->get());
			$dom    = $this->dom->create($output);

			foreach ($this->components as $container => $components) {
				ksort($components);

				$container = $dom->filter('[data-container=' . $container . ']');

				foreach ($components as $component) {
					$container->append($component);
				}
			}

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
