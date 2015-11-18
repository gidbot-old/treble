(function($) {

	// Using strict mode
	'use strict';

	$('.footer-1.ff-section').each(function(index){

		// Index

		$(this).addClass('footer-1--id--' + index);

		var this_section = '.footer-1--id--' + index + '.ff-section';
		var $this_section = $(this_section);


		// Do

		var defaultSearchButtonValue = $this_section.find('#searchsubmit').val();
		var searchIcon = $('<span>&#xf002;</span>').html();

		$this_section.find('#searchsubmit').val(searchIcon);
		$this_section.find('#s').attr('placeholder', defaultSearchButtonValue);

	});

})(jQuery);