<?php namespace Inkwell\CMS
{
	use Layouts;
	use Partials;
	use Contents;
	use Twig_LoaderInterface;
	use Dotink\Flourish;

	class Loader implements Twig_LoaderInterface
	{
		/**
		 *
		 */
		public function __construct(Contents $contents, Layouts $layouts, Partials $partials)
		{
			$this->contents = $contents;
			$this->layouts  = $layouts;
			$this->partials = $partials;
		}


		/**
		 *
		 */
		public function getSource($name)
		{
			if (is_numeric($name)) {
				$content = $this->contents->findOneById($name);

			} else {
				if (preg_match('#^\((partials)\)\s(.*)$#', $name, $matches)) {
					$repo = $matches[1];
					$name = $matches[2];
				} else {
					$repo = 'layouts';
				}

				$entity = $this->$repo->findOneByName($name);

				if (!$entity) {
					throw new Flourish\ProgrammerException(
						'Failed to load %s from %s',
						$name,
						$repo
					);
				}

				$content = $entity->getContent();
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
			return TRUE;
		}
	}
}
