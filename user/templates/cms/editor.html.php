<?php namespace Inkwell\HTML; ?>

<!doctype html>
<html class="editor">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?= $this('title') ?: 'Welcome' ?> :: inKWell CMS</title>

		<link rel="stylesheet" type="text/css" href="/assets/cms/styles/editor.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/fonts/icomoon.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/plugin/flakes/css/all.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/plugin/flakes/lib/gridforms/gridforms/gridforms.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/plugin/tipped/css/tipped/tipped.css" />
		<link rel="stylesheet" type="text/css" href="/assets/cms/plugin/content-tools/content-tools.min.css" data-copy />
		<link rel="stylesheet" type="text/css" href="/assets/cms/styles/controls.css" data-copy />
	</head>

	<body>
		<iframe id="viewpane" src="<?= html::out($this['source_url']); ?>"></iframe>

		<?php $this->insert('tool') ?>

		<div id="editor">
			<header>
				<h5 class="title">{{ title }}</h5>
			</header>
			<div class="views">

				<!-- Selection View -->

				<div class="view grid-12 gutter-20" title="Add a New Component" data-name="select">
					<div v-for="(i, module) in page.modules" class="span-4">
						<div class="module" data-idx="{{ i }}" v-on:click="select">
							<h6>{{ module.title }}</h6>
						</div>
					</div>
				</div>

				<!-- Module Settings View -->

				<div class="view grid-form" title="Component Settings"  data-name="settings">
					<div data-row-span="1">
						<div data-field-span="1">
							<label>Title</label>
							<input type="text" v-model="module.title" />
						</div>
					</div>
				</div>

				<!-- Manage Modules View -->

				<div class="view" title="Manage Components" data-name="manage">
					<ol class="sortable">
						<li v-for="module in modules" data-map="module.map">
							<h6 class="title">{{ module.title }}</h6>
							<div class="actions">
								<a href=""></a>
							</div>
							<div class="handle"></div>
						</li>
					</ol>
				</div>
			</div>
			<footer>
				<a class="button-green icon-check" v-on:click="store">Save</a>
				<a class="button-gray icon-cross" v-on:click="hide">Cancel</a>
			</footer>
		</div>
	</body>

	<script src="/assets/cms/plugin/vue.js" type="text/javascript"></script>
	<script src="/assets/cms/plugin/flakes/lib/jquery/dist/jquery.js"></script>
	<script src="/assets/cms/plugin/flakes/lib/snapjs/snap.js" type="text/javascript"></script>
	<script src="/assets/cms/plugin/flakes/lib/responsive-elements/responsive-elements.js" type="text/javascript"></script>
	<script src="/assets/cms/plugin/flakes/lib/gridforms/gridforms/gridforms.js"></script>
	<script src="/assets/cms/plugin/flakes/js/base.js" type="text/javascript"></script>
	<script src="/assets/cms/plugin/tipped/js/tipped/tipped.js" type="text/javascript"></script>
	<script src="/assets/cms/plugin/content-tools/content-tools.js" type="text/javascript" data-copy></script>
	<script src="/assets/cms/scripts/editor.js" type="text/javascript"></script>
</html>
