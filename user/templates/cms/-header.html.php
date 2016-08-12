<?php namespace Inkwell\HTML;

	extract($this->get());

	?>
	<nav class="components span-12 grid-12 gutter-80">
		<a class="logo span-1" href="<?= $registry->getPluginBaseUrl() ?>">Logo</a>
		<ul class="span-11">
			<?php foreach ($registry->getPluginMap() as $module => $tools) { ?>
				<li class="<?= html::out($module) ?>">
					<a class="icon" href="<?= $registry->anchor(array_values($tools)[0]) ?>"><?= html::out(ucwords($module)) ?></a>
				</li>
			<?php } ?>
		</ul>
	</nav>

	<nav class="tools span-1">
		<ul>
			<?php foreach ($registry->getPluginMap() as $module => $tools) { ?>
				<?php if(in_array(get_class($plugin), $tools)) { ?>
					<?php foreach ($tools as $tool => $class) { ?>
						<li class="<?= html::out($tool) ?>" <?= is_a($plugin, $class) ? 'data-active' : '' ?>>
							<a class="icon" href="<?= $registry->anchor($class) ?>"><?= html::out($class::getName()) ?></a>
						</li>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</ul>
	</nav>
