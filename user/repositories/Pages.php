<?php namespace {

	use Doctrine\ORM\EntityManager;
	use Inkwell\Doctrine\Repository;
	use Inkwell\HTTP\Resource\Request;
	use Inkwell\HTTP\Resource\Response;
	use Inkwell\Routing\Parser;
	use IW\HTTP;

	class Pages extends Repository
	{
		/**
		 *
		 */
		public function __construct(EntityManager $em, Parser $parser)
		{
			parent::__construct($em);

			$this->parser = $parser;
		}


		/**
		 *
		 */
		public function load(Request $request, Response $response)
		{
			$candidates = $this->query(function($builder) {
				$builder->select('data.id, data.url');
			});

			foreach ($candidates->getResult() as $candidate) {
				$regex = '#^' . $this->parser->regularize($candidate['url'], '#', $params) . '$#';

				if (preg_match($regex, $request->getUri()->getPath(), $matches)) {
					$request->params->set(array_combine($params, array_slice($matches, 1)));

					return $this->findOneById($candidate['id']);
				}
			}

			$response->set(NULL);
			$response->setStatus(HTTP\NOT_FOUND);

			return NULL;
		}
	}
}
