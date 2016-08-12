<?php namespace Inkwell\CMS
{
	use Dotink\Flourish\Collection;
	use Inkwell\Transport\Resource\RequestInterface as Request;
	use Inkwell\Transport\Resource\ResponseInterface as Response;

	/**
	 *
	 */
	interface Routine
	{
		public function __invoke(Request $request, Response $response, Collection $data, PageModule $page_module);
	}
}
