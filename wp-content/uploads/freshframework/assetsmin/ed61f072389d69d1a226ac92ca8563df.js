(function($){'use strict'
function shuffle(array){var currentIndex=array.length,temporaryValue,randomIndex;while(0!==currentIndex){randomIndex=Math.floor(Math.random()*currentIndex);currentIndex-=1;temporaryValue=array[currentIndex];array[currentIndex]=array[randomIndex];array[randomIndex]=temporaryValue};return array};$('.loader-1.ff-block').each(function(index){$(this).addClass('loader-1--id--'+index);var this_block='.loader-1--id--'+index+'.ff-block',$this_block=$(this_block);if($this_block.hasClass('loader-type-2')){var $animatedLogo=$this_block.find('.logo-animated__wrapper'),imageArray=JSON.parse($animatedLogo.attr('data-images'));shuffle(imageArray);var FADING_LENGTH=0,FADING_DELAY=150,imageIndex=0,animateLogoFunction=function(){imageIndex++;if(imageIndex>=imageArray.length)imageIndex=0;var $dummyImage=$('<img />',{class:'dummy-image',src:imageArray[imageIndex]});$dummyImage.appendTo($this_block.find('.logo-animated__wrapper')).hide().fadeIn(FADING_LENGTH,function(){$dummyImage.siblings('.dummy-image').remove()})},imageInterval=window.setInterval(animateLogoFunction,FADING_DELAY)};$(window).load(function(){window.clearInterval(imageInterval);$this_block.fadeOut('250');if(!$('body').hasClass('is-mobile'))BackgroundCheck.refresh()});$(window).bind('beforeunload',function(){$this_block.css('display','block').css('opacity','0').animate({opacity:1},250);if($this_block.hasClass('loader-type-2'))window.setInterval(animateLogoFunction,FADING_DELAY)})})})(jQuery);