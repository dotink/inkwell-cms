<?php namespace Inkwell\HTML;

	$this['title'] = 'Add Layout';

	$this->expand('content', 'master.html');

	extract($this->get());
	?>
	<section class="span-11" role="main">
		<form class="grid-form" method="post" action="">
			<div class="actions">
				<button type="submit" class="button-green"><span class="icon-checkmark">Save</span></button>
				<a class="button-gray" href="./"><span class="icon-cancel-circle">Cancel</span></a>
			</div>

			<?php $this->inject('plugin/Inkwell/Layouts/-fields.html') ?>

		</form>
	</section>