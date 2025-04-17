/* 
 * overlay.js v1.1.0
 * Copyright 2014 Joah Gerstenberg (www.joahg.com)
 */
(function($) { 
  $.fn.overlay = function() {
    overlay = $('.overlay');

    overlay.ready(function() {
      overlay.on('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function(e) {
        if (!$(this).hasClass('shown')) return $(this).css('visibility', 'hidden');
      });

      overlay.on('show', function() {
        $(this).css('visibility', 'visible');
        $(this).addClass('shown');
        return true;
      });

      overlay.on('hide', function() {
        $(this).removeClass('shown');
        return true;
      });

      overlay.on('click', function(e) {
        if (e.target.className === $(this).attr('class')) return $(this).trigger('hide');
      })

      $('a[data-overlay-trigger=""]').on('click', function() {
        overlay.trigger('show');
      });

      $('a[data-overlay-trigger]:not([data-overlay-trigger=""])').on('click', function() {
        console.log($('.overlay#' + $(this).attr('data-overlay-trigger')))
        $('.overlay#' + $(this).attr('data-overlay-trigger')).trigger('show');
      });
    })
  }; 
})(jQuery);

$(document).ready(function() {
$('body').on("contextmenu",function(e){
	//alert('Right click not allowed.');
	return false;
});

$(".overlay").overlay();
});

$(document).keydown(function(event){
	if(event.keyCode==123){
		return false;
	}
	else if (event.ctrlKey && event.shiftKey && event.keyCode==73){        
			 return false;
	}
});



document.onkeydown = function(e) {
	if (e.ctrlKey && 
		(e.keyCode === 67 || 
		 e.keyCode === 86 || 
		 e.keyCode === 85 || 
		 e.keyCode === 117)) {
		//alert('not allowed');
		return false;
	} else {
		return true;
	}
};
	
	