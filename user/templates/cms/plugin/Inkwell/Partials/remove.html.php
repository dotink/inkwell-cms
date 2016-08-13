<?php namespace Inkwell\HTML;

	$this['title'] = 'Remove Partials';

	$this->expand('content', 'master.html');

	extract($this->get());
	?>
	<form class="grid-form" method="post" action="?action=remove">
		<div class="actions">
			<button type="submit" name="confirm" value="" class="button-red"><span class="icon-arrow-right">Confirm</span></button>
			<a class="button-gray" href="./"><span class="icon-cancel-circle">Cancel</span></a>
		</div>

		<?php foreach ($entities as $entity) { ?>
			<input type="hidden" name="ids[]" value="<?= html::out($entity->getId()) ?>" />
		<?php } ?>
	</form>
