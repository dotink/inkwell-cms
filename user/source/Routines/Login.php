<?php namespace Inkwell\CMS\Routine
{
	use Inkwell\Auth;
	use Dotink\Flourish\Messaging;
	use Dotink\Flourish\Collection;
	use Pages;

	/**
	 *
	 */
	class LoginRoutine extends Routine
	{
		static public function getSettings()
		{
			return [
				'login_param' => ['string', 'login'],
				'pass_param'  => ['string', 'password'],
				'login_page'  => ['page',   ''],
				'on_success'  => ['page',   '']
			];
		}

		/**
		 *
		 */
		public function __construct(Pages $pages, Auth $auth, Messaging $flash)
		{
			$this->flash = $flash;
			$this->pages = $pages;
			$this->auth  = $auth;
		}


		/**
		 *
		 */
		public function __invoke(Request $request, Response $response, Collection $data, Block $block)
		{
			$settings    = $block->getSettings();
			$login_param = $this->settings->get('login_param');
			$pass_param  = $this->settings->get('pass_param');
			$login_page  = $this->pages->findOneById($this->settings->get('login_page'));
			$on_success  = $this->pages->findOneById($this->settings->get('on_success'));
			$login       = $request->params->get($login_param);
			$pass        = $request->params->get($pass_param);

			if ($this->auth->login($login, $pass)) {
				$this->flash->record('success', 'You have successfully logged in.');
				$response->setStatus(HTTP\REDIRECT_SEE_OTHER)->headers->set(
					'Location', !$on_success
						? $request->getUrl()->modify('/')
						: $on_success->getUrl()
				);

			} else {
				$this->flash->record('error', 'Your login or password were incorrect, please try again');
				$response->setStatus(HTTP\REDIRECT_SEE_OTHER)->headers->set(
					'Location', $login_page
						? $login_page->getUrl()
						: $request->getUrl()
				);
			}
		}
	}
}
