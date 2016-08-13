<?php namespace Inkwell\HTML;

	$this['title'] = 'Manage Modules';

	$this->expand('content', 'master.html');

	extract($this->get());
	?>
	<form method="post" action="">
		<div class="actions">
			<a class="button-darkblue" href="?action=create"><span class="icon-plus">Create</span></a>
			<button class="button-gray" type="submit" name="action" value="remove"><span class="icon-cross">Remove</span></button>
			<span class="button-orange"><label><input type="checkbox" name="all" value="ids[]" title="Select all modules on this page" /></label></span>
		</div>

		<?php if (!count($entities)) { ?>
			<div class="flakes-message information">
				<p>
					There are currently no modules in the system.
				</p>
			</div>
		<?php } else { ?>
			<div class="entities grid-4 gutter-20">
				<?php foreach($entities as $entity) { ?>
					<div class="span-1">
						<div class="module" data-tipped-options="showOn: 'click', hideOn: 'click'" title="<?= html::out($entity->getDescription()) ?>">
							<?= html::out($entity->getTitle()) ?>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</form>
