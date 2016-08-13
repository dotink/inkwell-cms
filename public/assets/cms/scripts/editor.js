var Inkwell = {};

Inkwell.ModulesDialog = Vue.extend({
	el: function() {
		return '#modules';
	},

	data: function() {
		return {
			/**
			 *
			 */
			el: null,

			/**
			 *
			 */
			doc: null,

			/**
			 *
			 */
			modal: null,

			/**
			 *
			 */
			editor: null,

			/**
			 *
			 */
			nodeCount: 0,

			/**
			 *
			 */
			containerSelector: '[data-container]',

			/**
			 *
			 */
			focusedContainer: null,

			/**
			 *
			 */
			nodeSelector: '*[data-node]',

			/**
			 *
			 */
			nodeNameAttr: 'data-name',

			/**
			 *
			 */
			title: 'Modules',

			/**
			 *
			 */
			activeModules: []
		};
	},

	methods: {


		/**
		 *
		 */
		appendModule: function($module) {
			var $pageModule = $('<div data-module>' + $module.data('content') + '</div>');

			$pageModule
				.data('module', $module.id)
				.find(this.nodeSelector)
				.prop('controller', this)
				.each(function() {
					this.controller.assignNodeId($(this));
				})
			;

			$pageModule.insertBefore(this.focusedContainer.find('.inkwell-controls'));

			this.sync();
			this.hide();
		},


		/**
		 * Assign a node ID to a node based on the highest current node count
		 */
		assignNodeId: function($node) {
			$node.attr(this.nodeNameAttr, 'node-' + ++this.nodeCount);
		},


		/**
		 * Initialized containers and add controls to each one.
		 */
		createControls: function(controls) {
			var $containers = this.doc.find(this.containerSelector);
			var $controls   = $('<div class="inkwell-controls">');

			//
			// Focus a container every time we click on one.  The click is actually for the button
			// but it should propagate.
			//

			$containers
				.prop('controller', this)
				.on('click', function() {
					this.controller.focusedContainer = $(this);
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
			if (this.el.hasClass('open')) {
				this.el.removeClass('open');
			}

			this.modal.hide();
		},


		/**
		 *
		 */
		show: function(view) {
			var active = this.el
				.find('.view')
				.removeClass('active')
				.filter('[data-view=' + view + ']')
				.addClass('active')
			;

			this.title = active.attr('title');

			this.modal.show();

			if (!this.el.hasClass('open')) {
				this.el.addClass('open');
			}
		},


		/**
		 *
		 */
		sync: function() {
			var $nodes = this.doc.find(this.nodeSelector);

			if (this.editor.getState() == 'dormant') {
				if ($nodes.length) {
					$nodes
						.prop('controller', this)
						.each(function() {
							this.controller.assignNodeId($(this));
						})
					;

					this.editor.syncRegions($nodes.toArray());

				} else {
					this.editor.init('', this.nodeNameAttr);

				}

			} else {
				this.editor.syncRegions($nodes.toArray());


			}
		},

		insert: function() {
			this.show('insert');
		},

		manage: function() {
			this.activeModules = [];

			this.focusedContainer.find('[data-module]').each(function() {
				this.controller.activeModules.push(this.data);
			})

			this.show('manage');
		},

		settings: function() {

		}
	},

	/**
	 *
	 */
	created: function() {
		if (this.jQuery == undefined) {
			console.error('Modules Vue requires you to define jQuery');
		}

		if (this.contentTools == undefined) {
			console.error('Modules Vue requires you to define contentTools');
		}

		this.modal  = new this.contentTools.ModalUI(false, true);
		this.editor = this.contentTools.EditorApp.get();

		this.createControls([
			{html: '<a data-control="insert">Add Modules</a>', callback: function(e) {
				this.controller.insert();
			}},
			{html: '<a data-control="manage">Add Modules</a>', callback: function(e) {
				this.controller.manage();
			}},
		]);
	},

	/**
	 *
	 */
	ready: function() {
		this.el = this.jQuery(this.$el);

		this.el.find('.module').prop('controller', this).on('click', function(e) {
			this.controller.appendModule($(this));
		});

		this.editor.attach(this.modal);
		this.sync();
	}
});
























$(function() {
	var $viewpane = $('.editor #viewpane');

	$('link[data-copy], script[data-copy]').clone()
		.appendTo($viewpane.contents().find('body'))
	;

	var modules = new Inkwell.ModulesDialog({
		data: {
			doc: $viewpane.contents().find('body'),
			contentTools: $viewpane[0].contentWindow.content.ContentTools,
			jQuery: $
		}
	});

});
