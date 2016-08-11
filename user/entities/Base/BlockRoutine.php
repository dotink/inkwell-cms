<?php namespace Base {

	use Doctrine\Common\Collections\ArrayCollection;

	class BlockRoutine
	{
		/**
		 * @access protected
		 * @var string
		 */
		protected $class;


		/**
		 * Instantiate a new BlockRoutine
		 */
		public function __construct()
		{
		}


		/**
		 * Get the value of class
		 *
		 * @access public
		 * @return string The value of class
		 */
		public function getClass()
		{
			return $this->class;
		}


		/**
		 * Set the value of class
		 *
		 * @access public
		 * @param string $value The value to set to class
		 * @return BlockRoutine The object instance for method chaining
		 */
		public function setClass($value)
		{
			$this->class = $value;

			return $this;
		}

	}

}
