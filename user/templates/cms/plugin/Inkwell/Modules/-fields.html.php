<?php namespace Inkwell\HTML;

	extract($this->get());

	?>
	<fieldset>
		<legend><?= html::out($title) ?></legend>
		<div data-row-span="2">
			<div data-field-span="1">
				<label>Title</label>
				<input type="text" name="entity[title]" value="<?= html::out($entity->getTitle()) ?>" placeholder="e.g. Split-Two">
			</div>
			<div data-field-span="1">
				<label>Name</label>
				<input type="text" name="entity[name]" value="<?= html::out($entity->getName()) ?>" />
			</div>
		</div>
		<div data-row-span="1">
			<div data-field-span="1">
				<label>Description</label>
				<input type="text" name="entity[description]" value="<?= html::out($entity->getDescription()) ?>" placeholder="e.g. An even two column split module." />
			</div>
		</div>
		<div data-row-span="1">
			<div data-field-span="1">
				<label>Template</label>
				<textarea class="ace" name="entity[content][data]" cols="1" rows="30" data-lang="html"><?=
					html::out($entity->fetchContent())
				?></textarea>
			</div>
		</div>
	</fieldset>
