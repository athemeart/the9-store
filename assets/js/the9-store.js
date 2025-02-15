;(function($) {
'use strict'
// Dom Ready

	var back_to_top_scroll = function() {
			
			$('#backToTop').on('click', function() {
				$("html, body").animate({ scrollTop: 0 }, 500);
				return false;
			});
			
			$(window).scroll(function() {
				if ( $(this).scrollTop() > 500 ) {
					
					$('#backToTop').addClass('active');
				} else {
				  
					$('#backToTop').removeClass('active');
				}
				
			});
			
		}; // back_to_top_scroll   
	
	
		//Trap focus inside mobile menu modal
		//Based on https://codepen.io/eskjondal/pen/zKZyyg	
		var trapFocusInsiders = function(elem) {
			
				
			var tabbable = elem.find('select, input, textarea, button, a').filter(':visible');
			
			var firstTabbable = tabbable.first();
			var lastTabbable = tabbable.last();
			/*set focus on first input*/
			firstTabbable.focus();
			
			/*redirect last tab to first input*/
			lastTabbable.on('keydown', function (e) {
			   if ((e.which === 9 && !e.shiftKey)) {
				   e.preventDefault();
				   
				   firstTabbable.focus();
				  
			   }
			});
			
			/*redirect first shift+tab to last input*/
			firstTabbable.on('keydown', function (e) {
				if ((e.which === 9 && e.shiftKey)) {
					e.preventDefault();
					lastTabbable.focus();
				}
			});
			
			/* allow escape key to close insiders div */
			elem.on('keyup', function(e){
			  if (e.keyCode === 27 ) {
				elem.hide();
			  };
			});
			
		};

		var focus_to = function(action,element) {

			$(action).keyup(function (e) {
			    e.preventDefault();
				var code = e.keyCode || e.which;
				if(code == 13) { 
					$(element).focus();
				}
			});		
			
		}
	
	$(function() {
		
		back_to_top_scroll();
		
		
		if( $('.owlGallery,.img-box ul.blocks-gallery-grid').length ){
			$(".owlGallery,.img-box ul.blocks-gallery-grid").owlCarousel({
				stagePadding: 0,
				loop: true,
				autoplay: true,
				autoplayTimeout: 2000,
				margin: 20,
				nav: false,
				dots: false,
				smartSpeed: 1000,
				rtl: ( $("body.rtl").length ) ? true : false, 
				responsive: {
					0: {
						items: 1
					},
					600: {
						items: 2
					},
					1000: {
						items: 2
					}
				}
			});
		}
	 
 	
		if(  $('.navsticky').length ){
		var stickyTop = $('.navsticky').offset().top;
			
		  $(window).scroll(function() {
			var windowTop = $(window).scrollTop();
		   if ( matchMedia( 'only screen and (min-width: 992px)' ).matches ) {
				if (stickyTop < (windowTop - 50 ) ) {
				  $('.navsticky').addClass('active');
				} else {
				  $('.navsticky').removeClass('active');
		
				}
			}
		  });
		}
		
		
	
		/*=============================================
	    =            Main Menu         =
	    =============================================*/
	   
		$('#navbar .navigation-menu li > a').keyup(function (e) {
			if ( matchMedia( 'only screen and (min-width: 992px)' ).matches ) {
				$("#navbar .navigation-menu li").removeClass('focus');
				$(this).parents('li.menu-item-has-children').addClass('focus');
				$("#navbar").addClass('keyfocus');
			}
		});	

		$( "#navbar, #navbar a, body" ).hover(function() {
			$("#navbar").removeClass('keyfocus');
		});
		
		$('#secondary .widget li a').keyup(function (e) {
			if ( matchMedia( 'only screen and (min-width: 992px)' ).matches ) {
				$("#navbar .navigation-menu li").removeClass('focus');
				$(this).parents('li.menu-item-has-children').addClass('focus');
			}
		});	
		 

		$(".responsive-submenu-toggle").on('click', function(e){
			e.preventDefault();
			$(this).next('ul').toggleClass('focus-active');
			$(this).toggleClass('bi-caret-up-fill');
	    });
	    
		/*$(".responsive-submenu-toggle").keyup(function (e) {
		    e.preventDefault();
			var code = e.keyCode || e.which;
			alert(code);
			if(code == 13) { 
				$(this).next('ul').toggleClass('focus-active');
				$(this).toggleClass('bi-caret-up-fill');
			}
		*/

  		$(".the9-store-responsive-navbar").on('click', function(e){
			if( $('#aside-nav-wrapper').length ){
				$('#aside-nav-wrapper').toggleClass('active');
			}
			$(this).find('i').toggleClass('bi-x-lg');
			trapFocusInsiders( $('#aside-nav-wrapper') );
	    });
	    $(".the9-store-navbar-close").on('click', function(e){
			if( $('#aside-nav-wrapper').length ){
				$('#aside-nav-wrapper').removeClass('active');
			}
			$(".the9-store-responsive-navbar").find('i').removeClass('bi-x-lg');
	  		$(".the9-store-responsive-navbar").focus();

	    });	
	  	
	  	
	  	$(window).on('load resize', function() {
			if ( matchMedia( 'only screen and (max-width: 850px)' ).matches ) {
				
				var el = document.querySelector('#navbar .nav-wrap');
  				SimpleScrollbar.initEl(el);
			}
		});
		
		$('#masthead .header-icon li > a').keyup(function (e) {
			if ( matchMedia( 'only screen and (min-width: 992px)' ).matches ) {
				$("#masthead .header-icon li").removeClass('focus');
				$("#navbar .navigation-menu li").removeClass('focus');
				$(this).parents('li').addClass('focus');

			}
		});	
		/*=============================================
	    =            search overlay active            =
	    =============================================*/
	    
	    $(".search-overlay-trigger").on('click', function(e){
			e.preventDefault();
			$("#search-bar").addClass("active");
	    });
	    
	    $(".search-close-trigger").on('click', function(e){
	    	 e.preventDefault();
	        $("#search-bar").removeClass("active");
	    });
	    trapFocusInsiders( $("#search-bar") );

		focus_to('.search-overlay-trigger',$("#search-bar").find('input.search-field'));
		focus_to('.search-overlay-trigger',$("#search-bar").find('input.apsw-search-input'));
		
		$('#secondary .widget li a').keyup(function (e) {
			if ( matchMedia( 'only screen and (min-width: 992px)' ).matches ) {
				$("#secondary .widget li").removeClass('focus');
				$(this).parents('li').addClass('focus');

			}
		});	

		AOS.init();
	});
})(jQuery);