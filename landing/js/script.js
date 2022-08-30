(function($){'use strict';var $window=$(window);$window.on("scroll",function(){if
($(document).scrollTop()>86){$("#banner").addClass("shrink");}
else
{$("#banner").removeClass("shrink");}});if($.fn.owlCarousel){$(".client_slides").owlCarousel({responsive:{0:{items:1},991:{items:2},767:{items:1}},loop:true,autoplay:true,smartSpeed:700,dots:true});var dot=$('.client_slides .owl-dot');dot.each(function(){var index=$(this).index()+1;if(index<10){$(this).html('0').append(index);}else{$(this).html(index);}});}
$window.on('load',function(){$('#preloader').fadeOut('1000',function(){$(this).remove();});});if($.fn.magnificPopup){$('#videobtn').magnificPopup({type:'iframe'});$('.gallery_img').magnificPopup({type:'image',gallery:{enabled:true},removalDelay:300,mainClass:'mfp-fade',preloader:true});}
if($window.width()>767){new WOW().init();}
$("a[href='#']").on('click',function($){$.preventDefault();});(function(){var dd=$('dd');dd.filter(':nth-child(n+3)').hide();$('dl').on('click','dt',function(){$(this).next().slideDown(500).siblings('dd').slideUp(500);})})();})(jQuery);