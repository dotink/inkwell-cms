<?php namespace Inkwell\CMS
{
	use Pages;
	use Inkwell\Core;
	use Inkwell\Controller\BaseController;
	use Dotink\Flourish\Collection;
	use IW\HTTP;

	/**
	 *
	 */
	class MainController extends BaseController
	{
		public function __construct(Core $app)
		{
			$this->app = $app;
		}

		/**
		 *
		 */
		public function page(Pages $pages, Collection $data, Composer $composer)
		{
			$page = $pages->load($this->request, $this->response);

			if (!$this->response->checkStatus(HTTP\OK)) {
				return $this->response;
			}

			$data->set('this.page',   $page);
			$data->set('this.params', $this->request->params->get());

/*
			foreach ($page->getPageModules() as $page_module) {
				$routine = $page_module->getRoutine();

				if (!$routine || !($routine->getClass() instanceof Routine)) {
					continue;
				}

				$response = $this->app['broker']->make($routine->getClass())(
					$this->request,
					$this->response,
					$collection,
					$page_module
				);

				if ($response->getStatus() != HTTP\OK) {
					return $response;
				}
			}
*/

			return $composer->render($page, $data);
		}
	}
}
