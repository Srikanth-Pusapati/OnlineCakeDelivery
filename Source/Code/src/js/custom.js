/**
  Custom JS  

  1. CARTBOX  
  2. SCROLL TOP BUTTON 
  3. PRELOADER
  4. GRID AND LIST LAYOUT CHANGER 
  5. TOP SLIDER (SLICK SLIDER)
  
**/

jQuery(function($){

  /* ----------------------------------------------------------- */
  /*  1. CARTBOX 
  /* ----------------------------------------------------------- */
    
     jQuery(".aa-cartbox").hover(function(){
      jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
    }
      ,function(){
          jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
      }
     );
  /* ----------------------------------------------------------- */
  /*  2. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button
    jQuery(window).scroll(function(){
      if ($(this).scrollTop() > 300) {
        $('.scrollToTop').fadeIn();
      } else {
        $('.scrollToTop').fadeOut();
      }
    });
     
    //Click event to scroll to top
    jQuery('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
    });
  
  /* ----------------------------------------------------------- */
  /*  3. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded      
      jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out      
    });

  /* ----------------------------------------------------------- */
  /*  4. GRID AND LIST LAYOUT CHANGER 
  /* ----------------------------------------------------------- */

  jQuery("#list-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });

    /* ----------------------------------------------------------- */
	/*  5. TOP SLIDER (SLICK SLIDER)
	/* ----------------------------------------------------------- */     
    
    jQuery('.seq-canvas').slick({
		dots: false,
		infinite: true,
		speed: 500,
		fade: true,
		cssEase: 'linear'
    });
});

