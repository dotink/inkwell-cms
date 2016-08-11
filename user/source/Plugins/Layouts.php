<?php namespace Inkwell\CMS\Plugin
{
	use Layouts as Repository;
	use Tenet\Accessor as Agent;
	use Inkwell\CMS;
	use IW\HTTP;

	class Layouts extends AbstractPlugin
	{
		static protected $description = 'Create layouts to build foundations for pages.';
		static protected $version = '1.0';

		/**
		 *
		 */
		static public function route($group)
		{
			parent::route($group);

			$group->link('/[+:id]-[!:name]', static::class . '::edit');
		}

		/**
		 *
		 */
		public function __construct(Repository $repo, Agent $agent)
		{
			$this->agent = $agent;
			$this->repo  = $repo;
		}


		/**
		 *
		 */
		public function add()
		{
			$entity = $this->repo->create();

			if ($this->request->checkMethod(HTTP\POST)) {
				$this->agent->fill($entity, $this->request->params->get('entity', array()));
				$this->repo->save($entity);

				return $this->router->redirect('./');
			}

			return $this->render(get_defined_vars());
		}


		/**
		 *
		 */
		public function edit()
		{
			$id     = $this->request->params->get('id');
			$name   = $this->request->params->get('name');
			$entity = $this->repo->findOneById($id);

			if (!$entity) {
				return $this->response->setStatus(HTTP\NOT_FOUND);
			}

			if ($this->request->checkMethod(HTTP\POST)) {
				$this->agent->fill($entity, $this->request->params->get('entity', array()));
				$this->repo->save($entity);

				return $this->router->redirect('./');
			}

			return $this->render(get_defined_vars());
		}


		/**
		 *
		 */
		public function manage()
		{
			$page     = $this->request->params->get('page', '1');
			$entities = $this->repo->build([], 15, $page);

			return $this->render(get_defined_vars());
		}
	}
}
