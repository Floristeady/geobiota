/*
	Any site-specific scripts you might have.
	Note that <html> innately gets a class of "no-js".
	This is to allow you to react to non-JS users.
	Recommend removing that and adding "js" as one of the first things your script does.
	Note that if you are using Modernizr, it already does this for you. :-)
*/

/*isotope*/
$(function() {
	
	var $container = $('#list-articles');
	
	$container.isotope({
	  // options
	  itemSelector : '.item',
	  layoutMode : 'masonry',
	  masonry: {
        columnWidth: $container.width() /3
      }
	});
});


/*Scroll Up*/
$(document).ready(function(){ 
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    }); 

    $('.scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });

});

/*Up inner header*/
$(function() {
	
	 $('.home .manifiesto').addClass('current-menu-item');	
	 $('.close').click(function(){
	 	$('#inner-header').hide();
	 	$('.manifiesto').removeClass('current-menu-item');
	 	$('#back-img').slideUp();
	 	return false;
	});
	
	$('.manifiesto a').click(function(){
		if ($('body').hasClass('home')) {
			$(this).parent().addClass('current-menu-item');
		}
	 	$('#inner-header').show();
	 	$('#back-img').slideDown();
	 	return false;
	});
	
	if (!$('body').hasClass('home')) {
		$('#inner-header').hide();
	 	$('.manifiesto').removeClass('current-menu-item');
	 	$('#back-img').hide();
	}
	
});

