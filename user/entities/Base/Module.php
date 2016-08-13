<?php namespace Base {

	use Doctrine\Common\Collections\ArrayCollection;
	use Entity;

	class Module extends Entity
	{
		/**
		 * @access protected
		 * @var Content
		 */
		protected $content;

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
		protected $type;


		/**
		 * Instantiate a new Module
		 */
		public function __construct()
		{
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
		 * Get the value of type
		 *
		 * @access public
		 * @return string The value of type
		 */
		public function getType()
		{
			return $this->type;
		}


		/**
		 * Set the value of content
		 *
		 * @access public
		 * @param Content $value The value to set to content
		 * @return Module The object instance for method chaining
		 */
		public function setContent(\Content $value)
		{
			$this->content = $value;

			return $this;
		}


		/**
		 * Set the value of description
		 *
		 * @access public
		 * @param string $value The value to set to description
		 * @return Module The object instance for method chaining
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
		 * @return Module The object instance for method chaining
		 */
		public function setId($value)
		{
			$this->id = $value;

			return $this;
		}


		/**
		 * Set the value of name
		 *
		 * @access public
		 * @param string $value The value to set to name
		 * @return Module The object instance for method chaining
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
		 * @return Module The object instance for method chaining
		 */
		public function setTitle($value)
		{
			$this->title = $value;

			return $this;
		}


		/**
		 * Set the value of type
		 *
		 * @access public
		 * @param string $value The value to set to type
		 * @return Module The object instance for method chaining
		 */
		public function setType($value)
		{
			$this->type = $value;

			return $this;
		}

	}

}
