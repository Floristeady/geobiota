/*
	Any site-specific scripts you might have.
	Note that <html> innately gets a class of "no-js".
	This is to allow you to react to non-JS users.
	Recommend removing that and adding "js" as one of the first things your script does.
	Note that if you are using Modernizr, it already does this for you. :-)
*/

//Efectos y detalles
$(function() {
	// if PDF in page
	$('a[href$=".pdf"]').append('<span></span>'); 	
	$('.content-page a[href$=".pdf"]').attr('target', '_blank');
	
	var menuw = $( '#menu-menu-principal' ).width();	
	$('.menu-header').css('width',menuw);
	
});

/*Header Gallery*/
$(window).load(function() {
  $('.header-gallery').flexslider({
    animation: 'fade',
    slideshowSpeed : 6000,
    directionNav:false
  });
  
  $('.logo-slider').flexslider({
    animation: 'fade',
    slideshowSpeed : 6000,
    directionNav:false,
    controlNav:false
  });
  
});

/*isotope*/
$(window).load(function() {
	
	var $container = $('#list-articles');
	  if( !/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ) { 
		$container.isotope({
		  // options
		  itemSelector : '.item',
		  layoutMode : 'masonry',
		  masonry: {
	        columnWidth: $container.width() /3
	      }
		});
		}
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

/*----------- Menu principal open mobile -----------*/
$(function() {

   $('header')      
      .find('a.btn-menu')
         .bind('click focus', function(){
            $(this).toggleClass('expanded');
            $('#access').slideToggle();
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
	 	$('#inner-header').delay(800).toggle();
	 	$('#back-img').slideToggle();
	 	return false;
	});
	
	if (!$('body').hasClass('home')) {
		$('#inner-header').hide();
	 	$('.manifiesto').removeClass('current-menu-item');
	 	$('#back-img').hide();
	} 
	
	$('.home article.img img').addClass('grayscale');
	$('.home article .img img').addClass('grayscale');
	
});

// Scroll image grayscale
$(window).scroll(function() { 
	$('#article-1 img').waypoint(function(direction) {
		if (direction == 'down') {
	    	$(this).removeClass('grayscale');
	    	return;
		}
		else {
	    	$(this).addClass('grayscale');
	    	return;
		}
  	}, { offset: '100' });
  	
  	$('#article-2 img').waypoint(function(direction) {
		if (direction == 'down') {
	    	$(this).removeClass('grayscale');
	    	return;
		}
		else {
	    	$(this).addClass('grayscale');
	    	return;
		}
  	}, { offset: '150' });
  	
  	$('#article-4 img').waypoint(function(direction) {
		if (direction == 'down') {
	    	$(this).removeClass('grayscale');
	    	return;
		}
		else {
	    	$(this).addClass('grayscale');
	    	return;
		}
  	}, { offset: '150' });
  	
  	
  	$('#article-6 img').waypoint(function(direction) {
		if (direction == 'down') {
	    	$(this).removeClass('grayscale');
	    	return;
		}
		else {
	    	$(this).addClass('grayscale');
	    	return;
		}
  	}, { offset: '300' });
  	
  	
});


