<?php namespace Inkwell\HTML;

	$this['title'] = 'Manage Pages';

	$this->expand('content', 'master.html');

	extract($this->get());
	?>
	<form method="post" action="">
		<div class="actions">
			<a class="button-darkblue" href="?action=create"><span class="icon-plus">Create</span></a>
			<button class="button-gray" type="submit" name="action" value="remove"><span class="icon-cross">Remove</span></button>
			<label class="button-orange"><input type="checkbox" name="#select::all" value="ids[]" title="Select all pages on this page" /></label>
		</div>

		<?php if (!count($entities)) { ?>
			<div class="flakes-message information">
				<p>
					There are currently no pages in the system.
				</p>
			</div>
		<?php } else { ?>
			<table class="entities flakes-table">
				<thead>
					<tr>
						<th><a class="icon-contrast" href="#select::invert" target="ids[]" title="Invert the Selection">Invert the Selection</a></th>
						<th>Title</th>
						<th>URL</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($entities as $entity) { ?>
						<tr data-tipped-options="showOn: 'click', hideOn: 'click'" title="<?= html::out($entity->getDescription()) ?>">
							<td><label><input type="checkbox" name="ids[]" value="<?= html::out($entity->getId()) ?>" /></label></td>
							<td><?= html::out($entity->getTitle()) ?></td>
							<td><?= html::out($entity->getUrl()) ?></td>
							<td class="actions">
								<a  class="icon-cogs"
									title="Configure"
									data-tipped-options="position: 'left'"
									href="<?= html::anchor('./[id]-[ws:slug]', [
										'id'   => $entity->getId(),
										'slug' => $entity->getName()
									]) ?>">Configure</a>

								<a  class="icon-pencil"
									title="Edit"
									data-tipped-options="position: 'left'"
									href="<?= html::anchor('./[id]-[ws:slug]', [
										'id'     => $entity->getId(),
										'slug'   => $entity->getName(),
										'action' => 'edit'
									]) ?>">Edit</a>

							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php } ?>
	</form>
