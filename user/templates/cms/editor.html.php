<?php namespace Inkwell\HTML; ?>

<!doctype html>
<html class="editor">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?= $this('title') ?: 'Welcome' ?> :: inKWell CMS</title>

		<link rel="stylesheet" type="text/css" href="/assets/cms/fonts/icomoon.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/plugin/content-tools/content-tools.min.css" data-copy />
		<link rel="stylesheet" type="text/css" href="/assets/cms/plugin/flakes/css/all.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/plugin/tipped/css/tipped/tipped.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/styles/editor.css" />
	</head>

	<body>
		<iframe id="viewpane" src="<?= html::out($this['source_url']); ?>"></iframe>

		<?php $this->insert('tool') ?>

		<div id="modules">
			<header>
				<h5 class="title">{{ title }}</h5>
			</header>
			<div class="views">
				<div class="view" title="Select a Module" data-view="selection">
					<?php foreach ($this['modules'] as $module) { ?>
						<div class="module" data-id="<?= html::out($module->getId()) ?>">
							<h6><?= html::out($module->getTitle()) ?></h6>
							<pre class="content"><?= html::out($module->fetchContent()) ?></div>
						</div>
					<?php } ?>
				</div>
				<div class="settings view" title="Adjust Settings">
				</div>
				<div class="reorder view" title="Drag and Drop Your Module Tags To Re-Order">
				</div>
			</div>
		</div>
	</body>

	<script src="/assets/cms/plugin/vue.js"></script>
	<script src="/assets/cms/plugin/content-tools/content-tools.js" data-copy></script>
	<script src="/assets/cms/plugin/flakes/lib/jquery/dist/jquery.js"></script>
	<script src="/assets/cms/plugin/flakes/lib/snapjs/snap.js"></script>
	<script src="/assets/cms/plugin/flakes/lib/responsive-elements/responsive-elements.js"></script>
	<script src="/assets/cms/plugin/flakes/js/base.js"></script>
	<script src="/assets/cms/plugin/tipped/js/tipped/tipped.js"></script>
	<script src="/assets/cms/scripts/editor.js" type="text/javascript"></script>
</html>
