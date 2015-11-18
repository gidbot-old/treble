(function($) {

	// Using strict mode
	'use strict';

	$('.featured-slider-1.ff-section').each(function(index){

		// Index

		$(this).addClass('featured-slider-1--id--' + index);

		var this_section = '.featured-slider-1--id--' + index + '.ff-section';
		var $this_section = $(this_section);

		////////////
		// Swiper //
		////////////

		// Classes

		var initializedNo = 'swiper-init--no';
		var initializedYes = 'swiper-init--yes';

		// Selectors

		var $swiperContainer = $this_section.find('.swiper-container');
		var $pagination = $this_section.find('.swiper-pagination');
		var $prevButton = $this_section.find('.swiper-button-prev');
		var $nextButton = $this_section.find('.swiper-button-next');
		var $firstImage = $this_section.find('.swiper-slide:first-child img');

		function swiperPaginationBottom(){
			var headerHeight = $('.header-1.ff-section').outerHeight();
			if ( $('.breakpoint').width() >= 3 ){
				$this_section.find('.swiper-pagination').css('bottom', headerHeight/2);
			} else {
				$this_section.find('.swiper-pagination').css('bottom', '');
			}
		}

		function initSwiper(){

			var mySwiper;
			mySwiper = new Swiper ($swiperContainer, {

				direction: 'horizontal',
				grabCursor: true,
				effect: 'slide',
				prevButton: '.swiper-arrow__left',
				nextButton: '.swiper-arrow__right',
				loop: true,
				runCallbacksOnInit: false, // must-have for loop:true
				// speed: 400,

				pagination: $pagination,
				paginationClickable: true,

				onSlideChangeStart: function (s) {

					var activeSlideHeight = s.slides.eq(s.activeIndex).find('img').height();
					s.container.css({height: activeSlideHeight+'px'});

					setTimeout(function() {
						if( ! $('body').hasClass('is-mobile') ){
							BackgroundCheck.refresh();
						}
					}, 300);

					// Scroll To Nice Position

					var swiperContainerOffset = $swiperContainer.offset().top;

					if ( $('.breakpoint').width() <= 1 ){

						var mobileHeaderHeight = $('.header-1.ff-section').outerHeight();

						setTimeout(function() {
							$("html, body").animate({ scrollTop: swiperContainerOffset - mobileHeaderHeight + 1}, 300); // +1
						}, 320);
						
					} else {

						setTimeout(function() {
							$("html, body").animate({ scrollTop: swiperContainerOffset + 1}, 300); // +1
						}, 320);

					}

				},
				onTransitionEnd: function (s) {
					if( ! $('body').hasClass('is-mobile') ){
						BackgroundCheck.refresh();
						backgroundCheckRefreshImages();
					}
				},
				onInit: function (s) {
					$this_section.removeClass('swiper-init--no');
					$this_section.addClass('swiper-init--yes');

					var firstImageHeight = $firstImage.height();
					s.container.css({height: firstImageHeight+'px'});

					setTimeout( function(){
						$this_section.find('.swiper-pagination').css('margin-left', -($this_section.find('.swiper-pagination').outerWidth()/2));
						swiperPaginationBottom();
					}, 10 );

				}

			});

			$(window).resize(function(){
				setTimeout( function(){
					var imgH = $this_section.find('.swiper-slide-active img').outerHeight();
					$this_section.find('.swiper-container').css('height', imgH);
				}, 10 );
			});

		}

		$this_section.addClass('swiper-init--no');

		var img = new Image();
		img.src = $firstImage.attr('src');
		if (img.success) img.onload();
		img.onload = function() {
			initSwiper();
			if( ! $('body').hasClass('is-mobile') ){
				BackgroundCheck.refresh();
			}
		};

		$(window).resize(function(){
			swiperPaginationBottom();
		});

	});
})(jQuery);



