<?php namespace Base {

	use Doctrine\Common\Collections\ArrayCollection;

	class Block
	{
		/**
		 * @access protected
		 * @var BlockCategory
		 */
		protected $category;

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
		 * @var BlockRoutine
		 */
		protected $routine;

		/**
		 * @access protected
		 * @var string
		 */
		protected $template;

		/**
		 * @access protected
		 * @var string
		 */
		protected $title;


		/**
		 * Instantiate a new Block
		 */
		public function __construct()
		{
		}


		/**
		 * Get the value of category
		 *
		 * @access public
		 * @return BlockCategory The value of category
		 */
		public function getCategory()
		{
			return $this->category;
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
		 * Get the value of routine
		 *
		 * @access public
		 * @return BlockRoutine The value of routine
		 */
		public function getRoutine()
		{
			return $this->routine;
		}


		/**
		 * Get the value of template
		 *
		 * @access public
		 * @return string The value of template
		 */
		public function getTemplate()
		{
			return $this->template;
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
		 * Set the value of category
		 *
		 * @access public
		 * @param BlockCategory $value The value to set to category
		 * @return Block The object instance for method chaining
		 */
		public function setCategory(\BlockCategory $value)
		{
			$this->category = $value;

			return $this;
		}


		/**
		 * Set the value of description
		 *
		 * @access public
		 * @param string $value The value to set to description
		 * @return Block The object instance for method chaining
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
		 * @return Block The object instance for method chaining
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
		 * @return Block The object instance for method chaining
		 */
		public function setName($value)
		{
			$this->name = $value;

			return $this;
		}


		/**
		 * Set the value of routine
		 *
		 * @access public
		 * @param BlockRoutine $value The value to set to routine
		 * @return Block The object instance for method chaining
		 */
		public function setRoutine(\BlockRoutine $value)
		{
			$this->routine = $value;

			return $this;
		}


		/**
		 * Set the value of template
		 *
		 * @access public
		 * @param string $value The value to set to template
		 * @return Block The object instance for method chaining
		 */
		public function setTemplate($value)
		{
			$this->template = $value;

			return $this;
		}


		/**
		 * Set the value of title
		 *
		 * @access public
		 * @param string $value The value to set to title
		 * @return Block The object instance for method chaining
		 */
		public function setTitle($value)
		{
			$this->title = $value;

			return $this;
		}

	}

}
