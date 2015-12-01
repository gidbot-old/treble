(function($) {

	// Using strict mode
	'use strict';

	$('.portfolio-cat-1.ff-section').each(function(index){

		// Index

		$(this).addClass('portfolio-cat-1--id--' + index);

		var this_section = '.portfolio-cat-1--id--' + index + '.ff-section';
		var $this_section = $(this_section);

		// Objects

		var $isotopeFilters = $this_section.find('.isotope-filters');
		var $isotopeFilter = $this_section.find('.isotope-filter');

		// Do

		$this_section.find('.isotope-item').mouseenter( function(){
			if ( $('.breakpoint').width() >= 3 ){
				setTimeout(function() {
					BackgroundCheck.refresh();
				}, 300);
			}
		}).mouseleave( function(){
			if ( $('.breakpoint').width() >= 3 ){
				setTimeout(function() {
					BackgroundCheck.refresh();
				}, 300);
			}
		});

		// Isotope Filters Calculate Height

		function isotopeFiltersCalcHeight(){

			var headerHeight = $('.header-1.ff-section').outerHeight();
			if ( $('.breakpoint').width() >= 3 ){
				$isotopeFilters.css('height', headerHeight);
			} else {
				$isotopeFilters.css('height', '');
			}

		}

		$this_section.find('.isotope').imagesLoaded( function(){
			$this_section.find('.isotope').isotope({
				itemSelector: '.isotope-item',
				layoutMode: 'masonry',
	            	masonry: {
	          		  	columnWidth:'.isotope-item'
	            	},
				resizesContainer: true
			});
		});
		$this_section.find('.isotope').isotope(); // re-init isotope, gap fix

		// Filter

		$isotopeFilter.click(function(e){
			e.preventDefault();

			$isotopeFilter.removeClass('isotope-filter--active button--active');
			$(this).addClass('isotope-filter--active button--active');

			// Filtering
			var filterValue = $(this).attr('data-filter');
			$this_section.find('.isotope').isotope({ filter: filterValue });

		});

		
		$(window).resize(function(){
			isotopeFiltersCalcHeight();
		}).resize();

		$(window).load(function(){
			$this_section.find('.isotope').isotope(); // re-init isotope
		});

	});

})(jQuery);