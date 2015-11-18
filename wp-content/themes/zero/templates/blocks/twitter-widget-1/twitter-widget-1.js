(function($) {

	// Using strict mode
	'use strict';

	$('.twitter-widget-1.ff-block').each(function(index){

		// Index

		$(this).addClass('twitter-widget-1--id--' + index);

		var this_block = '.twitter-widget-1--id--' + index + '.ff-block';
		var $this_block = $(this_block);

		// Selectors

		var $swiperContainer = $this_block.find('.swiper-container');
		var $swiperPagination = $this_block.find('.twitter-pagination');

		// Do

		function initSwiper(){

			var mySwiper;
			mySwiper = new Swiper ($swiperContainer, {

				direction: 'horizontal',
				grabCursor: true,
				effect: 'slide',

				pagination: $swiperPagination,
				paginationClickable: true,

		        onSlideChangeStart: function (s) {

					var activeSlideHeight = s.slides.eq(s.activeIndex).find('.tweet-inner').outerHeight();
			        $swiperContainer.animate({
			        	height : activeSlideHeight
			        },200);

				},

				onInit: function (s) {
					$this_block.removeClass('swiper-init--no');
					$this_block.addClass('swiper-init--yes');
				}

			});

			$(window).resize(function(){
				var activeSlideHeight = $swiperContainer.find('.swiper-slide-active .tweet-inner').outerHeight();
		        $swiperContainer.css('height', activeSlideHeight);
			});
			$(window).resize();

		}

		// Swiper Init

		initSwiper();

	});

})(jQuery);