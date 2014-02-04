/*Any site-specific scripts you might have.*/

/*Up inner header*/
$(function() {

	if( !/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ) { 
		var menuw = $( '#menu-menu-principal' ).width();	
		$('.menu-header').css('width',menuw);
	}
			
	if (!$('body').hasClass('home')) {
		$('#inner-header').hide();
	 	$('.manifiesto').removeClass('current-menu-item');
	 	$('#back-img').hide();
	} else if( /Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ) { 
		$('#inner-header').css('display','none');
	 	$('.manifiesto').removeClass('current-menu-item');
	 	$('#back-img').hide();	
	}
	
	$('.home article.img img').addClass('grayscale');
	$('.home article .img img').addClass('grayscale');
	
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

/*Header Gallery*/
$(window).load(function() {
  $('.header-gallery').flexslider({
    animation: 'fade',
    slideshowSpeed : 9000,
    directionNav:false,
    controlNav:false
  });
  
  $('.logo-slider').flexslider({
    animation: 'fade',
    slideshowSpeed : 6000,
    directionNav:false,
    randomize: true, 
    controlNav:false
  });
  
});

//Efectos y detalles
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

	// if PDF in page
	$('a[href$=".pdf"]').append('<i class="icon-attach"></i>'); 	
	$('.content-page a[href$=".pdf"]').attr('target', '_blank');
	
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


// Scroll image grayscale
$(window).scroll(function() { 
	$('#article-1 img').waypoint(function(direction) {
		if (direction == 'down') {
	    	$(this).removeClass('grayscale');
	    	return;
		}
		else {
	    	$(this).delay(500).addClass('grayscale');
	    	return;
		}
  	}, { offset: '100' });
  	
  	$('#article-2 img').waypoint(function(direction) {
		if (direction == 'down') {
	    	$(this).removeClass('grayscale');
	    	return;
		}
		else {
	    	$(this).delay(500).addClass('grayscale');
	    	return;
		}
  	}, { offset: '150' });
  	
  	$('#article-4 img').waypoint(function(direction) {
		if (direction == 'down') {
	    	$(this).removeClass('grayscale');
	    	return;
		}
		else {
	    	$(this).delay(500).addClass('grayscale');
	    	return;
		}
  	}, { offset: '150' });
  	
  	
  	$('#article-6 img').waypoint(function(direction) {
		if (direction == 'down') {
	    	$(this).removeClass('grayscale');
	    	return;
		}
		else {
	    	$(this).delay(500).addClass('grayscale');
	    	return;
		}
  	}, { offset: '400' });
  		
});


