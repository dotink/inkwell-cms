<?php namespace Base {

	use Doctrine\Common\Collections\ArrayCollection;
	use Entity;

	class Page extends Entity
	{
		/**
		 * @access protected
		 * @var ArrayCollection
		 */
		protected $components;

		/**
		 * @access protected
		 * @var string
		 */
		protected $description;

		/**
		 * @access protected
		 * @var integer
		 */
		protected $id;

		/**
		 * @access protected
		 * @var Layout
		 */
		protected $layout;

		/**
		 * @access protected
		 * @var string
		 */
		protected $metaDescription;

		/**
		 * @access protected
		 * @var string
		 */
		protected $name;

		/**
		 * @access protected
		 * @var string
		 */
		protected $title;

		/**
		 * @access protected
		 * @var string
		 */
		protected $url;


		/**
		 * Instantiate a new Page
		 */
		public function __construct()
		{
			$this->components = new ArrayCollection();
		}


		/**
		 * Get the value of components
		 *
		 * @access public
		 * @return ArrayCollection The value of components
		 */
		public function getComponents()
		{
			return $this->components;
		}


		/**
		 * Get the value of description
		 *
		 * @access public
		 * @return string The value of description
		 */
		public function getDescription()
		{
			return $this->description;
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
		 * Get the value of layout
		 *
		 * @access public
		 * @return Layout The value of layout
		 */
		public function getLayout()
		{
			return $this->layout;
		}


		/**
		 * Get the value of metaDescription
		 *
		 * @access public
		 * @return string The value of metaDescription
		 */
		public function getMetaDescription()
		{
			return $this->metaDescription;
		}


		/**
		 * Get the value of name
		 *
		 * @access public
		 * @return string The value of name
		 */
		public function getName()
		{
			return $this->name;
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
		 * Get the value of url
		 *
		 * @access public
		 * @return string The value of url
		 */
		public function getUrl()
		{
			return $this->url;
		}


		/**
		 * Set the value of description
		 *
		 * @access public
		 * @param string $value The value to set to description
		 * @return Page The object instance for method chaining
		 */
		public function setDescription($value)
		{
			$this->description = $value;

			return $this;
		}


		/**
		 * Set the value of id
		 *
		 * @access public
		 * @param integer $value The value to set to id
		 * @return Page The object instance for method chaining
		 */
		public function setId($value)
		{
			$this->id = $value;

			return $this;
		}


		/**
		 * Set the value of layout
		 *
		 * @access public
		 * @param Layout $value The value to set to layout
		 * @return Page The object instance for method chaining
		 */
		public function setLayout(\Layout $value)
		{
			$this->layout = $value;

			return $this;
		}


		/**
		 * Set the value of metaDescription
		 *
		 * @access public
		 * @param string $value The value to set to metaDescription
		 * @return Page The object instance for method chaining
		 */
		public function setMetaDescription($value)
		{
			$this->metaDescription = $value;

			return $this;
		}


		/**
		 * Set the value of name
		 *
		 * @access public
		 * @param string $value The value to set to name
		 * @return Page The object instance for method chaining
		 */
		public function setName($value)
		{
			$this->name = $value;

			return $this;
		}


		/**
		 * Set the value of title
		 *
		 * @access public
		 * @param string $value The value to set to title
		 * @return Page The object instance for method chaining
		 */
		public function setTitle($value)
		{
			$this->title = $value;

			return $this;
		}


		/**
		 * Set the value of url
		 *
		 * @access public
		 * @param string $value The value to set to url
		 * @return Page The object instance for method chaining
		 */
		public function setUrl($value)
		{
			$this->url = $value;

			return $this;
		}

	}

}
