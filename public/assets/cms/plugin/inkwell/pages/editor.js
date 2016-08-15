Inkwell.PageEditor = Inkwell.Editor.extend({
	data: function() {
		return {
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
			 * The current focus for the editor (this is usually a container)
			 */
			scope: null
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
		 *
		 */
		containerComponents: function() {
			var data = {};

			for (i in this.components) {
				if (this.components[i].container == this.scope.data('container')) {
					data[i] = this.components[i];
				}
			}

			return data;
		},


		/**
		 *
		 */
		createElement: function() {
			return this.doc.createElement('div');
		},


		/**
		 * Initialized containers and add controls to each one.
		 */
		createControls: function(controls) {
			var $containers = $(this.doc).find('[' + this.containerAttribute + ']');
			var $controls   = $(this.createElement()).addClass(this.controlsClass);

			//
			// Focus a container every time we mousenter on one.  This is a sloppy type focus
			// which makes sure our focused editor is set any time we do anything on it.
			//

			$containers
				.on('mouseenter', function() {
					this.ownerDocument.editor.focus($(this));
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

			this.modal.hide();
		},


		/**
		 *
		 */
		focus: function(focus) {
			this.scope = focus;
		},


		/**
		 *
		 */
		 init: function() {
			this.createControls([
				{html: '<a data-action="insert">Add Modules</a>', callback: function(e) {
					this.ownerDocument.editor.insert(e);
				}},
				{html: '<a data-action="manage">Manage Modules</a>', callback: function(e) {
					this.ownerDocument.editor.manage(e);
				}},
			]);
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
			var container = this.scope.data('container');

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
			var modules = this.page.modules;
			var $target = $(event.currentTarget);
			var selected = modules[$target.data('idx')];
			var $component = $(this.createElement()).append(selected.content);

			if ($component.children().length == 1) {
				$component = $component.children();
			}

			$component.attr(this.componentAttribute);
			$target.addClass('selected');

			this.module = {
				id: null,
				page: this.page.id,
				title: selected.title,
				module: selected.id,
				container: this.scope.data('container'),
				position: this.scope.find('[' + this.componentAttribute + ']').length + 1,
				el: $component
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

			this.el.find('.module.selected').removeClass('selected');

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

			this.module.el.insertBefore(this.scope.find('.' + this.controlsClass));
			this.components.push(this.module);

			this.module = {};

			this.app.syncRegions($(this.doc).find('[' + this.nodeAttribute + ']').toArray());
		}
	}
});


$(function() {
	new Inkwell.PageEditor({
		data: {
			el: '#editor',
			doc: '#viewpane',
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
			pull: function(editor) {
				$.ajax({
					type: "GET",
					url: window.location,
					dataType: 'json',
					success: function(data, status) {
						var components = data.components;
						editor.page    = data;

						for (var i in components) {
							editor.module = {
								id: components[i].id,
								page: components[i].page,
								title: components[i].title,
								module: components[i].module,
								container: components[i].container,
								position: components[i].position,
								el: $(editor.createElement()).append(components[i].content).children() // hacky
							}

							editor.focus($(editor.doc).find(
								'[' + editor.containerAttribute + '=' + components[i].container + ']'
							), true);

							editor.store();
						}
					}
				});
			}
		}
	});
});
