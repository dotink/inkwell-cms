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
		static public function sortComponents($a, $b) {
			if ($a->getContainer() < $b->getContainer()) {
				return -1;
			} elseif ($a->getContainer() > $b->getContainer()) {
				return 1;
			} elseif ($a->getPosition() > $b->getPosition()) {
				return -1;
			} elseif ($a->getPosition() > $b->getPosition()) {
				return 1;
			} else {
				return 0;
			}
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
			$mime_type  = $this->acceptMimeTypes(['text/html','application/json']);
			$source_url = $this->request->getUri()->modify('?action=preview');
			$headers    = $this->request->headers;
			$modules    = $modules->findAll();

			if ($mime_type != 'application/json') {
				return $this->render(get_defined_vars());
			}

			//
			// JSON Handling
			//

			$id   = $this->request->params->get('id', NULL);
			$page = $this->repo->findOneById($id);

			if ($this->request->checkMethod(HTTP\POST)) {
				$data = json_decode($this->request->get(), TRUE);

				$this->agent->fill($page, $data);
				$this->repo->save($page);

				$this->response->headers->set('Content-Type', 'application/json; charset=utf-8');
				return json_encode(TRUE);
			}

			$components = $page->getComponents()->getIterator();
			$modules    = $modules->getIterator();

			$components->uasort([self::class, 'sortComponents']);

			return json_encode([
				'id'         => $id,
				'modules'    => $modules,
				'components' => $components
			]);
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
