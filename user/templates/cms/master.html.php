<?php namespace Inkwell\HTML; ?>

<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?= $this('title') ?: 'Welcome' ?> :: inKWell CMS</title>

		<link rel="stylesheet" type="text/css" href="/assets/cms/fonts/icomoon.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/vendor/flakes/css/all.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/vendor/flakes/lib/gridforms/gridforms/gridforms.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/vendor/tipped/css/tipped/tipped.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/styles/main.css" />
	</head>

	<body class="grid-12 gutter-40">
		<?php $this->inject('-header.html') ?>

		<section class="span-10" role="main">
			<?php $this->insert('content') ?>
		</section>

		<?php $this->inject('-footer.html') ?>
	</body>

	<script src="/assets/cms/vendor/ace/ace.js" type="text/javascript"></script>
	<script src="/assets/cms/vendor/flakes/lib/jquery/dist/jquery.js"></script>
	<script src="/assets/cms/vendor/flakes/lib/snapjs/snap.js"></script>
	<script src="/assets/cms/vendor/flakes/lib/responsive-elements/responsive-elements.js"></script>
	<script src="/assets/cms/vendor/flakes/lib/gridforms/gridforms/gridforms.js"></script>
	<script src="/assets/cms/vendor/flakes/js/base.js"></script>
	<script src="/assets/cms/vendor/tipped/js/tipped/tipped.js"></script>
	<script src="/assets/cms/scripts/main.js" type="text/javascript"></script>
</html>
