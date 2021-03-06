<?php namespace Inkwell\HTML;

	extract($this->get());

	?>
	<fieldset>
		<legend><?= html::out($title) ?></legend>
		<div data-row-span="2">
			<div data-field-span="1">
				<label>Title</label>
				<input type="text" name="entity[title]" value="<?= html::out($entity->getTitle()) ?>" placeholder="e.g. How to Use Titles to Increase Search Engine Optimization">
			</div>
			<div data-field-span="1">
				<label>Layout</label>
				<select name="entity[layout]">
					<option value=""></option>
					<?php foreach ($layouts as $layout) { ?>
						<option value="<?= html::out($layout->getId()) ?>" <?= html::active($layout, $entity->getLayout(), 'selected') ?>>
							<?= html::out($layout->getTitle()) ?>
						</option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div data-row-span="2">
			<div data-field-span="1">
				<label>Url</label>
				<input type="text" name="entity[url]" value="<?= html::out($entity->getUrl()) ?>" placeholder="e.g. /articles/using-titles-effectively-for-seo" />
			</div>
			<div data-field-span="1">
				<label>Name</label>
				<input type="text" name="entity[name]" value="<?= html::out($entity->getName()) ?>" />
			</div>
		</div>
		<div data-row-span="1">
			<div data-field-span="1">
				<label>Description</label>
				<input type="text" name="entity[description]" value="<?= html::out($entity->getDescription()) ?>" placeholder="e.g. This one line describes what this page is." />
			</div>
		</div>
		<div data-row-span="1">
			<div data-field-span="1">
				<label>Meta Description</label>
				<textarea name="entity[metaDescription]"><?= html::out($entity->getmetaDescription()) ?></textarea>
			</div>
		</div>
	</fieldset>
