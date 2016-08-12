<?php namespace Base {

	use Doctrine\Common\Collections\ArrayCollection;
	use Entity;

	class BlockCategory extends Entity
	{
		/**
		 * @access protected
		 * @var string
		 */
		protected $name;


		/**
		 * Instantiate a new BlockCategory
		 */
		public function __construct()
		{
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
		 * Set the value of name
		 *
		 * @access public
		 * @param string $value The value to set to name
		 * @return BlockCategory The object instance for method chaining
		 */
		public function setName($value)
		{
			$this->name = $value;

			return $this;
		}

	}

}
