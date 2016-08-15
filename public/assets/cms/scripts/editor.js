var Inkwell = {};

Inkwell.Editor = Vue.extend({
	el: function() {
		return '#editor';
	},

	data: function() {
		return {
			/**
			 * The underlying content editor (ContentTools Editor)
			 */
			app: null,

			/**
			 *
			 */
			componentAttribute: 'data-component',

			/**
			 *
			 */
			componentCount: 0,

			/**
			 * The list of all components.  Components are modules which have been added to the doc.
			 */
			components: [],

			/**
			 *
			 */
			containerAttribute: 'data-container',

			/**
			 *
			 */
			controlsClass: 'iw-container-controls',

			/**
			 * The document we're editing.
			 */
			doc: null,

			/**
			 * The element which represents our editor view.
			 */
			el: null,

			/**
			 * The current focus for the editor (this is usually a container)
			 */
			focus: null,

			/**
			 *
			 */
			modal: null,

			/**
			 * A temporary working space for a single module
			 */
			module: {},

			/**
			 *
			 */
			moduleSelector: '*[data-module]',

			/**
			 * A temporary working space for a list of modules
			 */
			modules: [],

			/**
			 *
			 */
			nodeCount: 0,

			/**
			 *
			 */
			nodeAttribute: 'data-node',

			/**
			 *
			 */
			page: {},

			/**
			 *
			 */
			pull: function() {

			},

			/**
			 *
			 */
			push: function () {

			},

			/**
			 *
			 */
			selectedModule: {},

			/**
			 *
			 */
			title: null
		};
	},

	methods: {
		/**
		 * Assign a module ID to a module based on the highest current module count
		 */
		assignComponentId: function($module) {
			if ($module.attr(this.componentAttribute)) {
				return;
			}

			$module.attr(this.componentAttribute, 'c' + ++this.componentCount);
		},


		/**
		 * Assign a node ID to a node based on the highest current node count
		 */
		assignNodeId: function($node) {
			if ($node.attr(this.nodeAttribute)) {
				return;
			}

			$node.attr(this.nodeAttribute, 'n' + ++this.nodeCount);
		},


		/**
		 * Initialized containers and add controls to each one.
		 */
		createControls: function(controls) {
			var $containers = $(this.doc).find('[' + this.containerAttribute + ']');
			var $controls   = $('<div class="' + this.controlsClass + '">');

			//
			// Focus a container every time we mousenter on one.  This is a sloppy type focus
			// which makes sure our focused editor is set any time we do anything on it.
			//

			$containers
				.on('mouseenter', function() {
					this.ownerDocument.editor.focus = $(this);
				});
			;

			for (var i in controls) {
				$controls.append(
					$(controls[i].html)
						.on('click', controls[i].callback)
				);
			}

			$containers.append($controls.clone(true, true));
		},


		/**
		 * Hide the modules dialog completely
		 */
		hide: function() {
			this.el.removeClass('open');
			this.el.find('.module.selected').removeClass('selected');

			this.modal.hide();
		},


		/**
		 *
		 */
		 init: function() {
			this.el = $(this.$el);
			this.ct = this.doc.defaultView.ContentTools;
			this.app = this.ct.EditorApp.get();
			this.modal = new this.ct.ModalUI();
			this.doc.editor = this;
			document.editor = this;

			this.app.attach(this.modal);
			this.app.init('', '');

			this.app.addEventListener('saved', (function(editor) {
				return function(ev) {
					editor.push(editor, ev)
				};
			})(this));

			this.createControls([
				{html: '<a data-action="insert">Add Modules</a>', callback: function(e) {
					this.ownerDocument.editor.insert(e);
				}},
				{html: '<a data-action="manage">Manage Modules</a>', callback: function(e) {
					this.ownerDocument.editor.manage(e);
				}},
			]);

			this.pull(this, function(editor, data, status) {
				var components = data.components;
				editor.page = data;

				for (var i in components) {
					editor.module = {
						id: components[i].id,
						page: components[i].page,
						title: components[i].title,
						module: components[i].module,
						container: components[i].container,
						position: components[i].position,
						el: $(components[i].content)
					}

					editor.focus = $(editor.doc).find(
						'[' + editor.containerAttribute + '=' + components[i].container + ']'
					);

					editor.store();
				}
			});
		},


		/**
		 * Insert a module in the focused container.
		 */
		insert: function(event) {

			//
			// There's really not much to do before an insert.
			//

			this.show('select');
		},


		/**
		 *
		 */
		load: function(event) {

			//
			// Load a component based on the eventTarget's data-target value
			//

			this.show('settings');
		},


		/**
		 * Manage modules in the focused container.
		 */
		manage: function(event) {
			var container = this.focus.data('container');

			for (x = 0; x < this.components.length; x++) {
				if (this.components[x].container == container) {
					this.modules.push(this.components[x]);
				}
			}

			this.show('manage');
		},


		/**
		 * Remove a component based on the eventTarget's data-target value
		 */
		remove: function(event)
		{

		},


		/**
		 * We either select a module (here), or load one (see: load)
		 */
		select: function(event) {
			var $target = $(event.currentTarget), $componentElement;
			this.selectedModule = this.page.modules[$target.data('idx')];
			$componentElement = $(this.selectedModule.content);

			if ($componentElement.length > 1) {
				$componentElement = $componentElement.wrap('<div></div>');
			}

			$componentElement.attr(this.componentAttribute);
			$target.addClass('selected');

			this.module = {
				id: null,
				page: this.page.id,
				title: this.selectedModule.title,
				module: this.selectedModule.id,
				container: this.focus.data('container'),
				position: this.focus.find('[' + this.componentAttribute + ']').length + 1,
				el: $componentElement
			}

			this.show('settings');
		},


		/**
		 * Show the requested view.
		 */
		show: function(view) {
			var $active = this.el
				.find('.view')
				.removeClass('active')
				.filter('[data-name=' + view + ']')
				.addClass('active')
			;

			this.title = $active.attr('title');

			this.modal.show();

			if (!this.el.hasClass('open')) {
				this.el.addClass('open');
			}
		},


		/**
		 * Store all the workspaces.
		 */
		store: function(event) {
			this.module.el
				.each(function() {
					this.ownerDocument.editor.assignComponentId($(this));
				})
				.find('[' + this.nodeAttribute + ']')
				.addBack('[' + this.nodeAttribute + ']')
				.each(function() {
					this.ownerDocument.editor.assignNodeId($(this));
				})
			;

			this.sync();
			this.hide();
		},


		/**
		 * Clear the workspace and resync all nodes for editing.
		 */
		sync: function() {

			//
			// Figure out if the module exists in the components list, if not, add it.  Then look
			// for the module in the container and insert there if need be.
			//

			this.module.el.insertBefore(this.focus.find('.' + this.controlsClass));
			this.components.push(this.module);

			this.module  = {};
			this.modules = [];

			this.app.syncRegions($(this.doc).find('[' + this.nodeAttribute + ']').toArray());
		}
	},

	/**
	 *
	 */
	created: function() {
		var load = function(editor, time) {
			setTimeout(function() {
				if (editor.doc.defaultView.ContentTools == undefined) {
					return load(editor, time * 10);
				}

				editor.init();

			}, time);
		};

		load(this, 1);
	}
});


$(function() {
	var doc = document.getElementById('viewpane').contentWindow.document;

	$('link[data-copy], script[data-copy]').each(function() {
		var element = doc.createElement(this.localName);

		if (element.localName == 'script') {
			element.src = this.src;
		} else {
			element.href = this.href;
			element.rel  = this.rel;
		}

		doc.body.appendChild(element);
	});

	new Inkwell.Editor({
		data: {
			el: '#editor',
			doc: doc,
			push: function(editor, ev) {
				var components = $.extend([], editor.components);
				var postData = [];

				for (var x = 0; x < editor.components.length; x++) {
					var component = $.extend({}, components[x]);

					delete component.el;

					component.content = {
						data: components[x].el[0].outerHTML
					};

					postData.push(component);
				}

				$.ajax({
					type: "POST",
					url: window.location,
					dataType: 'json',
					contentType: 'application/json; charset=utf-8',
					data: JSON.stringify({
						components: postData
					}),
					success: function(data, status) {
						console.log(data);
					}
				});
			},
			pull: function(editor, callback) {
				$.ajax({
					type: "GET",
					url: window.location,
					dataType: 'json',
					success: function(data, status) {
						callback(editor, data, status);
					}
				});
			}
		}
	});
})
