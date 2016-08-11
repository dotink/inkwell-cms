<?php namespace Inkwell\HTML;

	$this['title'] = 'Manage Pages';

	$this->expand('content', 'master.html');

	extract($this->get());
	?>
	<section class="span-11" role="main">
		<form method="post" action="">
			<div class="actions">
				<a class="button-darkblue" href="?action=add"><span class="icon-plus">Add</span></a>
				<button class="button-gray" type="submit" name="action" value="delete"><span class="icon-cross">Delete</span></button>
			</div>

			<?php if (!count($entities)) { ?>
				<div class="flakes-message information">
					<p>
						There are currently no pages in the system.
					</p>
				</div>
			<?php } else { ?>
				<table class="flakes-table">
					<thead>
						<tr>
							<td><input type="checkbox" name="all" value="id[]" /></td>
							<td>Title</td>
							<td>URL</td>
							<td>Actions</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($entities as $entity) { ?>
							<tr>
								<td><input type="checkbox" name="id[]" value="<?= html::out($entity->getId()) ?>" /></td>
								<td><?= html::out($entity->getTitle()) ?></td>
								<td><?= html::out($entity->getUrl()) ?></td>
								<td>
									<a class="icon-pencil"
										href="<?= html::anchor('./[id]-[name]', [
											'id' => $entity->getId(),
											'name' => $entity->getName()
										]) ?>">edit</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<?php } ?>
		</form>
	</section>
