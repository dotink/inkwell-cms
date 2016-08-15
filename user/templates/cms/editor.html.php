<?php namespace Inkwell\HTML; ?>

<!doctype html>
<html class="editor">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?= $this('title') ?: 'Welcome' ?> :: inKWell CMS</title>

		<link rel="stylesheet" type="text/css" href="/assets/cms/styles/editor.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/fonts/icomoon.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/vendor/flakes/css/all.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/vendor/flakes/lib/gridforms/gridforms/gridforms.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/vendor/tipped/css/tipped/tipped.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/vendor/content-tools/content-tools.min.css" data-copy />

		<?php $this->insert('styles') ?>
	</head>

	<body>
		<iframe id="viewpane" src="<?= html::out($this['source_url']); ?>"></iframe>

		<?php $this->insert('main') ?>
	</body>

	<script src="/assets/cms/vendor/vue.js" type="text/javascript"></script>
	<script src="/assets/cms/vendor/flakes/lib/jquery/dist/jquery.js"></script>
	<script src="/assets/cms/vendor/flakes/lib/snapjs/snap.js" type="text/javascript"></script>
	<script src="/assets/cms/vendor/flakes/lib/responsive-elements/responsive-elements.js" type="text/javascript"></script>
	<script src="/assets/cms/vendor/flakes/lib/gridforms/gridforms/gridforms.js"></script>
	<script src="/assets/cms/vendor/flakes/js/base.js" type="text/javascript"></script>
	<script src="/assets/cms/vendor/tipped/js/tipped/tipped.js" type="text/javascript"></script>
	<script src="/assets/cms/vendor/content-tools/content-tools.js" type="text/javascript" data-copy></script>
	<script src="/assets/cms/scripts/editor.js" type="text/javascript"></script>

	<?php $this->insert('scripts') ?>

</html>
