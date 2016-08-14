var Inkwell = {};

Inkwell.Editor = Vue.extend({
	el: function() {
		return '#modules';
	},

	data: function() {
		return {
			/**
			 *
			 */
			components: [],

			/**
			 *
			 */
			containerSelector: '[data-container]',

			/**
			 *
			 */
			editor: null,

			/**
			 *
			 */
			el: null,

			/**
			 *
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
			moduleCount: 0,

			/**
			 *
			 */
			moduleNameAttr: 'data-module',

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
			nodeNameAttr: 'data-node',

			/**
			 *
			 */
			nodeSelector: '*[data-node]',

			/**
			 *
			 */
			subdoc: null,

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
		assignModuleId: function($module) {
			if ($module.attr(this.moduleNameAttr)) {
				return;
			}

			this.module.map = 'module-' + ++this.moduleCount;

			$module.attr(this.moduleNameAttr, this.module.map);
		},


		/**
		 * Assign a node ID to a node based on the highest current node count
		 */
		assignNodeId: function($node) {
			if ($node.attr(this.nodeNameAttr)) {
				return;
			}

			var nodeName = 'node-' + ++this.nodeCount;

			$node.attr(this.nodeNameAttr, nodeName);

			this.module.nodes.push(nodeName);
		},


		/**
		 * Initialized containers and add controls to each one.
		 */
		createControls: function(controls) {
			var $containers = $(this.subdoc).find(this.containerSelector);
			var $controls   = $('<div class="inkwell-controls">');

			//
			// Focus a container every time we mousenter on one.  This is a sloppy type focus
			// which makes sure our focused controller is set any time we do anything on it.
			//

			$containers
				.prop('controller', this)
				.on('mouseenter', function() {
					this.controller.focus = $(this);
				});
			;

			for (var i in controls) {
				$controls.append(
					$(controls[i].html)
						.prop('controller', this)
						.on('click', controls[i].callback)
				);
			}

			$containers.append($controls);
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
			this.el     = $(this.$el);
			this.ct     = this.subdoc.defaultView.ContentTools;
			this.editor = this.ct.EditorApp.get();
			this.modal  = new this.ct.ModalUI();

			this.editor.attach(this.modal);
			this.editor.init('', '');
			this.load();

			this.createControls([
				{html: '<a data-control="insert">Add Modules</a>', callback: function(e) {
					this.controller.insert(e);
				}},
				{html: '<a data-control="manage">Manage Modules</a>', callback: function(e) {
					this.controller.manage(e);
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
			var $selectedModule = $(event.currentTarget);
			var $moduleContent  = $($selectedModule.data('content'));

			$selectedModule.addClass('selected');

			if ($moduleContent.length > 1) {
				$moduleContent = $moduleContent.wrap('<div></div>').attr(moduleNameAttr);
			}

			this.module = {
				id: null,
				map: null,
				nodes: [],
				title: $selectedModule.data('title'),
				module: $selectedModule.data('id'),
				container: this.focus.data('container'),
				position: this.focus.find(this.moduleSelector).length + 1,
				el: $moduleContent
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
				.prop('controller', this) // Add controller the page module
				.each(function() {
					this.controller.assignModuleId($(this));
				})
				.find(this.nodeSelector)
				.prop('controller', this) // Add controller to any nodes underneath it
				.each(function() {
					this.controller.assignNodeId($(this));
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

			this.module.el.insertBefore(this.focus.find('.inkwell-controls'));
			this.components.push(this.module);

			this.module  = {};
			this.modules = [];

			this.editor.syncRegions($(this.subdoc).find(this.nodeSelector).toArray());
		}
	},

	/**
	 *
	 */
	created: function() {
		var load = function(controller, time) {
			setTimeout(function() {
				if (controller.subdoc.defaultView.ContentTools == undefined) {
					return load(controller, time * 10);
				}

				controller.init();

			}, time);
		};

		load(this, 1);
	}
});


$(function() {
	var subdoc = document.getElementById('viewpane').contentWindow.document;

	$('link[data-copy], script[data-copy]').each(function() {
		var element = subdoc.createElement(this.localName);

		if (element.localName == 'script') {
			element.src = this.src;
		} else {
			element.href = this.href;
			element.rel  = this.rel;
		}

		subdoc.body.appendChild(element);
	});

	new Inkwell.Editor({
		data: {
			subdoc: subdoc
		}
	});
})
