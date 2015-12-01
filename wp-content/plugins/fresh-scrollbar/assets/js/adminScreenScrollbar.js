(function($){
	$(document).ready(function(){
		
		var $allTabs = $('.ff-tabs-contents').find('.ff-tabs-content');
		var $allLinks = $('.nav-tab-wrapper').find('a');
		
		$allLinks.click(function(){
			$(this).addClass('nav-tab-active');
			$allLinks.not($(this)).removeClass('nav-tab-active');
			$allTabs.css('display', 'none');
			
			var index = ( $(this).index() );
			
			$allTabs.eq( index ).css('display','block').css('opacity','0').animate({ opacity: 1 }, 'fast');;
			return false;
		});
	});
})(jQuery);