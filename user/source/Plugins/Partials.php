<?php namespace Inkwell\CMS\Plugin
{
	use Partials as Repository;
	use Tenet\Accessor as Agent;
	use IW\HTTP;

	class Partials extends AbstractPlugin
	{
		static protected $description = 'Manage partial content that can be placed in layouts';
		static protected $version = '1.0';


		/**
		 *
		 */
		static public function route($group)
		{
			parent::route($group);

			$group->link('/[+:id]-[!:slug]', static::class . '::update');
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
		public function create()
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
		public function manage()
		{
			$page     = $this->request->params->get('page', '1');
			$entities = $this->repo->build([], 15, $page);

			return $this->render(get_defined_vars());
		}


		/**
		 *
		 */
		public function update()
		{
			$id     = $this->request->params->get('id');
			$slug   = $this->request->params->get('slug');
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
		public function remove()
		{
			$ids      = $this->request->params->get('ids', array());
			$confirm  = $this->request->params->has('confirm');
			$entities = $this->repo->findById($ids);

			if ($confirm) {
				$entities->map(function($entity) {
					$this->repo->remove($entity);
				});

				return $this->router->redirect('./');
			}

			return $this->render(get_defined_vars());
		}
	}
}
