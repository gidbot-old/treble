(function($) {

	// Using strict mode
	'use strict';

	function shakeIT($el){
		$el.addClass('error');
		window.setTimeout(function(){
			$el.removeClass('error');
		},500);
	}

	function testText( $el ){
		if( 0 == $el.size() ){ return true; }
		var ret= ( '' != $el.val().replace(/\s+/g, '') );
		if( !ret ){
			shakeIT($el);
		}
		return ret;
	}

	function testEmail( $el ){
		if( 0 == $el.size() ){ return true; }
		var re = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
		var ret = re.test( $el.val() );
		if( !ret ){
			shakeIT($el);
		}
		return ret;
	}

	$('body').on('submit', '#commentform', function( event ) {

		var test_name    = testText(  $(this).find('input.ff-field-author') );
		var test_email   = testEmail( $(this).find('input.ff-field-email') );
		// website -> not mandatory
		var test_message = testText(  $(this).find('textarea#comment') );

		if( ! test_name || ! test_email || ! test_message ){
			event.preventDefault();
			return false;
		}
	});

})(jQuery);