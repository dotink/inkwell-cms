<?php namespace Inkwell\CMS\Plugin
{

	use Layouts;
	use Modules;
	use Pages as Repository;
	use Inkwell\CMS\Composer;
	use Tenet\Accessor as Agent;
	use Dotink\Flourish\Collection;
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

			$group->link('/[+:id]-[!:slug]', static::class . '::configure');
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
		public function configure(Layouts $layouts)
		{
			$id      = $this->request->params->get('id');
			$slug    = $this->request->params->get('slug');
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
		public function create(Layouts $layouts)
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
		public function edit(Modules $modules)
		{
			$source_url = $this->request->getUri()->modify('?action=preview');
			$modules    = $modules->findAll();

			return $this->render(get_defined_vars());
		}


		/**
		 *
		 */
		public function preview(Collection $data, Composer $composer)
		{
			$id   = $this->request->params->get('id', NULL);
			$page = $this->repo->findOneById($id);

			if (!$page) {
				return $this->response->setStatus(HTTP\NOT_FOUND);
			}

			$data->set('this.page', $page);
			$data->set('this.params', $this->request->params->get());
			$composer->setEditable(TRUE);

			return $composer->render($page, $data);
		}


		/**
		 *
		 */
		public function remove()
		{

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
