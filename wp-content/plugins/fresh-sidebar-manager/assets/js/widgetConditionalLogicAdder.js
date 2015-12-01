(function($){
	
	$(document).ready(function(){
		
		var customCodeLogic = '';
	//	customCodeLogic += '<div class="ff-custom-code-logic-modal-wrapper">';
	//	customCodeLogic += '<input type="text" value="" class="ff-custom-code-logic-modal-input" name="ff-custom-code-logic-modal-input">';
	//	customCodeLogic += '</div>';
		
		
		customCodeLogic += '<div class="ff-custom-code-logic-modal-wrapper">';
		customCodeLogic += '<input type="text" name="ff-custom-code-logic-modal-input" class="ff-custom-code-logic-modal-input hidden" value="">';
		customCodeLogic += '<button name="" class="button button-small" type="submit">Set Visibility</button>';
		customCodeLogic += '</div>';
		
		// ADDING THE CUSTOMCODE LOGIC CONTROL
		var addCustomCodeLogicToOneWidget = function( $widget ) {
			$widget.find('.widget-control-actions').before( customCodeLogic );
		};
		
		var addCustomCodeToAllWidgets = function() {
			$('.widgets-holder-wrap').find('.widget').each(function(){
				
				addCustomCodeLogicToOneWidget( $(this) );
			});
		};
		
		addCustomCodeToAllWidgets();
		
/******************************************************************************/
/* GET THE CUSTOM LOGIC VAlUE
/******************************************************************************/
		// get ID's for all used widgets
		var getUsedWidgetsIds = function() {
			var sumOfIds = new Array();
			
			$('#widgets-right .widget, .inactive-sidebar .widget').each(function() {
				var oneId = $(this).find('.widget-id').attr('value');
				
				sumOfIds.push( oneId );
			});
			
			return sumOfIds;
		};
		
		
		(function() {
			var allWidgetIds = getUsedWidgetsIds();
			
			var ajaxData = {};
			ajaxData.widgetIds = allWidgetIds;
			
			frslib.ajax.frameworkRequest( 'ffSidebarWidgetLogicManager', 'gather-widget-logic', ajaxData, function(response){
				var widgetDatas = jQuery.parseJSON(response);
				

				$('#widgets-right .widget, .inactive-sidebar .widget').each(function() {
					var currentId =  $(this).find('.widget-id').attr('value');
					
					if( widgetDatas.hasOwnProperty(currentId) ) {
						$(this).find('.ff-custom-code-logic-modal-input').val( widgetDatas[ currentId ] );
						
						var apply = isLogicApplied( $(this).find('.ff-custom-code-logic-modal-input').val() );
						//console.log( apply );
						if( apply == true ) {
							$(this).find('.ff-custom-code-logic-modal-wrapper .button').addClass('logic-is-applied');
						}
						
					}
				});
			});
			
 
		})();
		
		var isLogicApplied = function( value ) {
			var detector = 'a%5Blogic-use-or-not%5D%5Blogic_use_or_not%5D=0&a%5Blogic-use-or-not%5D%5Blogic_use_or_not%5D=1';
			
			if( value.indexOf( detector ) == 0 ) {
				return true;
			} else {
				return false;
			}
		};
		
		$(document).on('click', '.ff-custom-code-logic-modal-wrapper .button', function(){
			frslib.modal.conditional_logic.set_content( $(this).parents('.ff-custom-code-logic-modal-wrapper').find('input').val() );
			frslib.modal.conditional_logic.show();

			frslib.modal.conditional_logic.current_input = $(this).parents('.ff-custom-code-logic-modal-wrapper').find('input');
			
			return false;
		});
		
		frslib.callbacks.addCallback('ff-logic-form-submitted', function( $currentInput ){
			var apply = isLogicApplied( $currentInput.val() );
			
			if( apply ) {
				$currentInput.parents('.ff-custom-code-logic-modal-wrapper').find('.button').addClass('logic-is-applied');
			} else {
				$currentInput.parents('.ff-custom-code-logic-modal-wrapper').find('.button').removeClass('logic-is-applied');
			}
		});
		
	});
	
	
	
	

	//$('.ff-custom-code-logic-modal-wrapper').
	
})(jQuery);