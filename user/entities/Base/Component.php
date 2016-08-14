<?php namespace Base {

	use Doctrine\Common\Collections\ArrayCollection;
	use Entity;

	class Component extends Entity
	{
		/**
		 * @access protected
		 * @var string
		 */
		protected $container;

		/**
		 * @access protected
		 * @var Content
		 */
		protected $content;

		/**
		 * @access protected
		 * @var integer
		 */
		protected $id;

		/**
		 * @access protected
		 * @var Module
		 */
		protected $module;

		/**
		 * @access protected
		 * @var Page
		 */
		protected $page;

		/**
		 * @access protected
		 * @var integer
		 */
		protected $position;

		/**
		 * @access protected
		 * @var string
		 */
		protected $title;


		/**
		 * Instantiate a new Component
		 */
		public function __construct()
		{
		}


		/**
		 * Get the value of container
		 *
		 * @access public
		 * @return string The value of container
		 */
		public function getContainer()
		{
			return $this->container;
		}


		/**
		 * Get the value of content
		 *
		 * @access public
		 * @return Content The value of content
		 */
		public function getContent()
		{
			return $this->content;
		}


		/**
		 * Get the value of id
		 *
		 * @access public
		 * @return integer The value of id
		 */
		public function getId()
		{
			return $this->id;
		}


		/**
		 * Get the value of module
		 *
		 * @access public
		 * @return Module The value of module
		 */
		public function getModule()
		{
			return $this->module;
		}


		/**
		 * Get the value of page
		 *
		 * @access public
		 * @return Page The value of page
		 */
		public function getPage()
		{
			return $this->page;
		}


		/**
		 * Get the value of position
		 *
		 * @access public
		 * @return integer The value of position
		 */
		public function getPosition()
		{
			return $this->position;
		}


		/**
		 * Get the value of title
		 *
		 * @access public
		 * @return string The value of title
		 */
		public function getTitle()
		{
			return $this->title;
		}


		/**
		 * Set the value of container
		 *
		 * @access public
		 * @param string $value The value to set to container
		 * @return Component The object instance for method chaining
		 */
		public function setContainer($value)
		{
			$this->container = $value;

			return $this;
		}


		/**
		 * Set the value of content
		 *
		 * @access public
		 * @param Content $value The value to set to content
		 * @return Component The object instance for method chaining
		 */
		public function setContent(\Content $value)
		{
			$this->content = $value;

			return $this;
		}


		/**
		 * Set the value of id
		 *
		 * @access public
		 * @param integer $value The value to set to id
		 * @return Component The object instance for method chaining
		 */
		public function setId($value)
		{
			$this->id = $value;

			return $this;
		}


		/**
		 * Set the value of module
		 *
		 * @access public
		 * @param Module $value The value to set to module
		 * @return Component The object instance for method chaining
		 */
		public function setModule(\Module $value)
		{
			$this->module = $value;

			return $this;
		}


		/**
		 * Set the value of page
		 *
		 * @access public
		 * @param Page $value The value to set to page
		 * @return Component The object instance for method chaining
		 */
		public function setPage(\Page $value)
		{
			$this->page = $value;

			return $this;
		}


		/**
		 * Set the value of position
		 *
		 * @access public
		 * @param integer $value The value to set to position
		 * @return Component The object instance for method chaining
		 */
		public function setPosition($value)
		{
			$this->position = $value;

			return $this;
		}


		/**
		 * Set the value of title
		 *
		 * @access public
		 * @param string $value The value to set to title
		 * @return Component The object instance for method chaining
		 */
		public function setTitle($value)
		{
			$this->title = $value;

			return $this;
		}

	}

}
