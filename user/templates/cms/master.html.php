<?php namespace Inkwell\HTML; ?>

<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?= $this('title') ?: 'Welcome' ?> :: inKWell CMS</title>

		<link rel="stylesheet" type="text/css" href="/assets/cms/plugin/flakes/css/all.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/fonts/icomoon.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/styles/main.css" />
	</head>

	<body class="grid-12 gutter-80">
		<?php $this->inject('-header.html') ?>
		<?php $this->insert('content') ?>
		<?php $this->inject('-footer.html') ?>
	</body>

	<link rel="stylesheet" type="text/css" href="/assets/cms/plugin/flakes/lib/gridforms/gridforms/gridforms.css">
	<script src="/assets/cms/plugin/ace/ace.js" type="text/javascript"></script>
	<script src="/assets/cms/plugin/flakes/lib/jquery/dist/jquery.js"></script>
	<script src="/assets/cms/plugin/flakes/lib/snapjs/snap.js"></script>
	<script src="/assets/cms/plugin/flakes/lib/responsive-elements/responsive-elements.js"></script>
	<script src="/assets/cms/plugin/flakes/lib/gridforms/gridforms/gridforms.js"></script>
	<script src="/assets/cms/plugin/flakes/js/base.js"></script>
	<script src="/assets/cms/scripts/main.js" type="text/javascript"></script>
</html>