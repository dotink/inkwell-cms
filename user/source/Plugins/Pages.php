<?php namespace Inkwell\CMS\Plugin
{
	use Layouts;
	use Pages as Repository;
	use Tenet\Accessor as Agent;
	use Inkwell\CMS;
	use IW\HTTP;

	class Pages extends AbstractPlugin
	{
		static protected $description = 'Create pages quickly and easily.';
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
		public function add(Layouts $layouts)
		{
			$entity  = $this->repo->create();
			$layouts = $layouts->findAll();

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
		public function edit(Layouts $layouts)
		{
			$id      = $this->request->params->get('id');
			$name    = $this->request->params->get('name');
			$entity  = $this->repo->findOneById($id);
 			$layouts = $layouts->findAll();

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
