<?php namespace Inkwell\CMS
{
	interface Plugin
	{
		static public function getDescription();
		static public function getName();
		static public function getVersion();
		static public function getVendor();
		public function manage();
	}
}
