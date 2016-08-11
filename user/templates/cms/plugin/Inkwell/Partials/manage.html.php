<?php namespace Inkwell\HTML;

	$this['title']    = 'Manage Partials';
	$this['partials'] = array();

	$this->expand('content', 'master.html');

	extract($this->get());
	?>
	<section class="span-11" role="main">
		<form method="post" action="">
			<div class="actions">
				<a class="button-darkblue" href="?action=add"><span class="icon-plus">Add</span></a>
				<button class="button-gray" type="submit" name="action" value="delete"><span class="icon-cross">Delete</span></button>
			</div>

			<?php if (!count($partials)) { ?>
				<div class="flakes-message information">
					<p>
						There are currently no partials in the system.
					</p>
				</div>
			<?php } else { ?>
				<table class="flakes-table">
					<thead>
						<tr>
							<td><input type="checkbox" name="all" value="id[]" /></td>
							<td>Name</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="checkbox" name="id[]" value="1" /></td>
							<td>This is an example title of this page</td>
						</tr>
					</tbody>
				</table>
			<?php } ?>

		</form>
	</section>
