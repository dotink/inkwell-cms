Inkwell = {};

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
			 * The document we're editing.
			 */
			doc: null,

			/**
			 * The element which represents our editor view.
			 */
			el: null,

			/**
			 *
			 */
			modal: null,

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
			title: null
		};
	},

	methods: {
		/**
		 *
		 */
		createElement: function() {
			return this.doc.createElement('div');
		},


		/**
		 * Hide the modules dialog completely
		 */
		hide: function() {
			this.el.removeClass('open');

			this.modal.hide();
		},


		/**
		 * Initialize additional controls or interfaces.
		 */
		init: function() {

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
		}
	},

	/**
	 *
	 */
	created: function() {
		var doc  = $(this.doc)[0].contentWindow.document;
		var load = function(editor, time) {
			setTimeout(function() {
				if (doc.defaultView.ContentTools == undefined) {
					return load(editor, time * 10);
				}

				doc.editor   = editor;
				editor.el    = $(editor.$el);
				editor.ct    = doc.defaultView.ContentTools;
				editor.app   = doc.defaultView.ContentTools.EditorApp.get();
				editor.modal = new doc.defaultView.ContentTools.ModalUI();
				editor.doc   = doc;

				editor.app.attach(editor.modal);
				editor.app.init('', '');

				editor.app.addEventListener('saved', function(ev) {
					editor.push(editor, ev)
				});

				editor.init();
				editor.pull(editor);

			}, time);
		};

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

		this.doc = doc;

		load(this, 1);
	}
});

/**
 *
 * This is an example
 *
 *

$(function() {
	new Inkwell.Editor({
		data: {
			el:  '#editor',
			doc: '#viewpane',
			init: function() {

				//
				// Replace with initialization functionality
				//

			},
			push: function(editor, ev) {

				//
				// Replace with ajax call to push your data back
				//

			},

			pull: function(editor) {

				//
				// Replace with ajax call and data loading
				//

			}
		}
	});
});

*
*
*/
