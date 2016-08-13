var Inkwell = {};

Inkwell.ModulesDialog = Vue.extend({
	el: function() {
		return '#modules';
	},

	data: function() {
		return {
			el: null,
			doc: null,
			modal: null,
			editor: null,
			nodeCount: 0,
			nodeSelector: '*[data-node]',
			nodeNameAttr: 'data-name',
			focusedContainer: null,
			title: 'Modules',
		};
	},

	methods: {

		/**
		 *
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

		createControls: function(controllerName, controls) {
			var $containers = this.doc.find('[data-container]');

			$containers
				.prop(controllerName, this)
				.on('click', function() {
					this[controllerName].focusedContainer = $(this);
				});
			;

			for (var i in controls) {
				$containers.append(
					$(controls[i].html)
						.prop(controllerName, this)
						.on('click', controls[i].callback)
				);
			}
		},

		assignNodeId: function($node) {
			$node.attr(this.nodeNameAttr, 'node-' + ++this.nodeCount);
		},

		appendModule: function($module) {
			var $content    = $module.find('.content');
			var $pageModule = $('<div data-module>' + $content.text() + '</div>');

			$pageModule
				.find(this.nodeSelector)
				.prop('modulesDialog', this)
				.each(function() {
					this.modulesDialog.assignNodeId($(this));
				})
			;

			this.focusedContainer.prepend($pageModule);
			this.sync();
			this.hide();
		},

		sync: function() {
			var $nodes = this.doc.find(this.nodeSelector);

			if (this.editor.getState() == 'dormant') {
				if ($nodes.length) {
					$nodes
						.prop('modulesDialog', this)
						.each(function() {
							this.modulesDialog.assignNodeId($(this));
						})
					;

					this.editor.syncRegions($nodes.toArray());

				} else {
					this.editor.init('', this.nodeNameAttr);

				}

			} else {
				this.editor.syncRegions($nodes.toArray());


			}
		}
	},

	created: function() {
		if (this.jQuery == undefined) {
			console.error('Modules Vue requires you to define jQuery');
		}

		if (this.contentTools == undefined) {
			console.error('Modules Vue requires you to define contentTools');
		}

		this.modal  = new this.contentTools.ModalUI(false, true);
		this.editor = this.contentTools.EditorApp.get();

		this.createControls('modulesDialog', [
			{html: '<a>Add Modules</a>', callback: function(e) {
				this.modulesDialog.show('selection');
			}}
		]);
	},

	ready: function() {
		this.el = this.jQuery(this.$el);

		this.el.find('.module').prop('modulesDialog', this).on('click', function(e) {
			this.modulesDialog.appendModule($(this));
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
