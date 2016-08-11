<?php namespace Inkwell\HTML;

	$this['title']    = 'Manage Partials';
	$this['partials'] = array();

	$this->expand('content', 'master.html');

	extract($this->get());
	?>
