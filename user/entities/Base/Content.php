<?php namespace Base {

	use Doctrine\Common\Collections\ArrayCollection;
	use Entity;

	class Content extends Entity
	{
		/**
		 * @access protected
		 * @var string
		 */
		protected $data;

		/**
		 * @access protected
		 * @var integer
		 */
		protected $id;


		/**
		 * Instantiate a new Content
		 */
		public function __construct()
		{
		}


		/**
		 * Get the value of data
		 *
		 * @access public
		 * @return string The value of data
		 */
		public function getData()
		{
			return $this->data;
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
		 * Set the value of data
		 *
		 * @access public
		 * @param string $value The value to set to data
		 * @return Content The object instance for method chaining
		 */
		public function setData($value)
		{
			$this->data = $value;

			return $this;
		}


		/**
		 * Set the value of id
		 *
		 * @access public
		 * @param integer $value The value to set to id
		 * @return Content The object instance for method chaining
		 */
		public function setId($value)
		{
			$this->id = $value;

			return $this;
		}

	}

}
