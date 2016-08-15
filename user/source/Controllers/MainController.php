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

			foreach ($page->getComponents() as $component) {
/*
				$routine = $component->getRoutine();

				if (!$routine || !($routine->getClass() instanceof Routine)) {
					continue;
				}

				$response = $this->app['broker']->make($routine->getClass())(
					$this->request,
					$this->response,
					$component,
					$data  // this data object should have a 'this.module' element set with component settings
				);

				if ($response->getStatus() != HTTP\OK) {
					return $response;
				}
*/
				$composer->addComponent($component, $data);
			}

			return $composer->render($page, $data);
		}
	}
}
