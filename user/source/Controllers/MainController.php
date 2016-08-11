<?php namespace Inkwell\CMS
{
	use Pages;
	use Inkwell\Core;
	use Inkwell\Controller\BaseController;
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
		public function page(Pages $pages)
		{
			$page = $pages->load($this->request, $this->response);

			if (!$this->response->checkStatus(HTTP\OK)) {
				return $this->response;
			}

			var_dump($this->request->params->get());
			exit();
		}
	}
}
