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

	$('.ff-cform').submit(function( event ) {

		var test_name    = testText(  $(this).find('.contact-form-1__p-name input') );
		var test_email   = testEmail( $(this).find('.contact-form-1__p-email input') );
		var test_subject = testText(  $(this).find('.contact-form-1__p-subject input') );
		var test_message = testText(  $(this).find('.contact-form-1__p-message textarea') );

		if( ! test_name || ! test_email || ! test_subject || ! test_message ){
			event.preventDefault();
			return false;
		}

        var $contactForm = $(this);

        var serializedContent = $contactForm.serialize();


        var data = {};
        data.formInput = serializedContent;
        data.contactInfo = $contactForm.find('.ff-contact-info').html();

        frslib.ajax.frameworkRequest('contactform-send-ajax', null, data, function( response ) {


            if( response == 'true' ) {
                $contactForm.find('.ff-email-has-been-sent, .ff-email-failed').hide();
                $contactForm.find('.ff-email-has-been-sent').fadeIn();
            } else {
                $contactForm.find('.ff-email-has-been-sent, .ff-email-failed').hide();
                $contactForm.find('.ff-email-failed').fadeIn();
            }
        });

        return false;

	});

})(jQuery);