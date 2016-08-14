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
			pageModules: [],

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
			this.module.map = 'module-' + ++this.moduleCount;

			$module.attr(this.moduleNameAttr, this.module.map);
		},


		/**
		 * Assign a node ID to a node based on the highest current node count
		 */
		assignNodeId: function($node) {
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
					this.controller.insert();
				}},
				{html: '<a data-control="manage">Manage Modules</a>', callback: function(e) {
					this.controller.manage();
				}},
			]);
		},


		/**
		 * Insert a new module
		 */
		insert: function() {
			this.show('select');
		},


		/**
		 *
		 */
		load: function() {

		},


		/**
		 *
		 */
		reset: function() {
			this.module  = {};
			this.modules = [];
		},


		/**
		 *
		 */
		save: function(event) {
			if (this.module) {
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

				this.module.el.insertBefore(this.focus.find('.inkwell-controls'));
				this.pageModules.push(this.module);

				this.reset();
				this.sync();
			}

			this.hide();
		},

		/**
		 *
		 */
		select: function(event) {
			var $selectedModule = $(event.currentTarget);

			$selectedModule.addClass('selected');

			this.module = {
				id: null,
				map: null,
				nodes: [],
				title: $selectedModule.data('title'),
				module: $selectedModule.data('id'),
				container: this.focus.data('container'),
				position: this.focus.find(this.moduleSelector).length + 1,
				el: $('<div data-module>' + $selectedModule.data('content') + '</div>')
			}

			this.show('settings');
		},

		/**
		 *
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
		 *
		 */
		sync: function() {
			this.editor.syncRegions($(this.subdoc).find(this.nodeSelector).toArray());
		},

		/**
		 *
		 */
		manage: function() {
			var container = this.focus.data('container');

			for (x = 0; x < this.pageModules.length; x++) {
				if (this.pageModules[x].container == container) {
					this.modules.push(this.pageModules[x]);
				}
			}

			this.show('manage');
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
