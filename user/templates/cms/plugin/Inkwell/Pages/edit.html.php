<?php namespace Inkwell\HTML;

	$this['title'] = 'Edit Page: ';

	$this->expand('main', 'editor.html');
	$this->append('styles', 'plugin/Inkwell/Pages/editor/styles.html');
	$this->append('scripts', 'plugin/Inkwell/Pages/editor/scripts.html');

	extract($this->get());

	?>
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
					<li v-for="(i, module) in containerComponents()" data-idx="{{ i }}">
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
			<a class="button-green icon-check" v-on:click="store">Ok</a>
			<a class="button-gray icon-cross" v-on:click="hide">Cancel</a>
		</footer>
	</div>
