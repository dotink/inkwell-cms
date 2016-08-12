$(function() {
	$('textarea.ace').each(function() {
		var $textarea  = $(this);
		var $container = $('<div>');
		var editor     = ace.edit($container[0]);

		$textarea.css({'display': 'none'});
		$container.insertBefore($textarea).css({
			'width': '100%',
			'height': $(document).height() - $container.offset().top - 30 +  'px'
		});

		editor.getSession().setValue($textarea.val());
		editor.getSession().setMode('ace/mode/' + $textarea.data('lang'));
		editor.setTheme('ace/theme/clouds');
		editor.setFontSize('18px');

		editor.getSession().on('change', function(){
			$textarea.val(editor.getSession().getValue());
		});
	});

	Tipped.create('*[title]');
});
