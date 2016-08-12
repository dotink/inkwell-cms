<?php namespace Inkwell\CMS
{
	use Layouts;
	use Contents;
	use Twig_LoaderInterface;

	class Loader implements Twig_LoaderInterface
	{
		/**
		 *
		 */
		public function __construct(Contents $contents, Layouts $layouts)
		{
			$this->contents = $contents;
			$this->layouts  = $layouts;
		}


		/**
		 *
		 */
		public function getSource($name)
		{
			if (is_numeric($name)) {
				$content = $this->contents->findOneById($name);
			} else {
				$content = $this->layouts->findOneByName($name)->getContent();
			}

			return $content
				? $content->getData()
				: NULL;
		}


		/**
		 *
		 */
		public function getCacheKey($name)
		{
			return __NAMESPACE__ . '::Content::' . $name;
		}


		/**
		 *
		 */
		public function isFresh($name, $time)
		{
			return FALSE;
		}
	}
}
