jQuery(window).scroll(function() {							   
	jQuery('.welcomebx').each(function(){
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
			if (imagePos < topOfWindow+400) {
				jQuery(this).addClass("fadeInDown");
			}
		});
	
	jQuery('#pagearea .container').each(function(){
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
			if (imagePos < topOfWindow+400) {
				jQuery(this).addClass("fadeInLeft");
			}
		});
	
	jQuery('#classeswrap').each(function(){
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
			if (imagePos < topOfWindow+400) {
				jQuery(this).addClass("fadeInDown");
			}
		});
	
	jQuery('#section2 .container').each(function(){
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
			if (imagePos < topOfWindow+400) {
				jQuery(this).addClass("fadeInRight");
			}
		});	
	
	jQuery('#section3 .one_half').each(function(){
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
			if (imagePos < topOfWindow+400) {
				jQuery(this).addClass("fadeInLeft");
			}
		});
	
	jQuery('#section4 .container').each(function(){
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
			if (imagePos < topOfWindow+400) {
				jQuery(this).addClass("fadeInDown");
			}
		});
	
	jQuery('#section5 .container').each(function(){
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
			if (imagePos < topOfWindow+400) {
				jQuery(this).addClass("fadeInRight");
			}
		});
	
	jQuery('#section6 .container').each(function(){
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
			if (imagePos < topOfWindow+400) {
				jQuery(this).addClass("fadeInLeft");
			}
		});
	
	jQuery('#section7 .container').each(function(){
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
			if (imagePos < topOfWindow+400) {
				jQuery(this).addClass("fadeInRight");
			}
		});
	
	jQuery('#section8 .container').each(function(){
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
			if (imagePos < topOfWindow+400) {
				jQuery(this).addClass("fadeInRight");
			}
		});
		 
	jQuery('#section9 .container').each(function(){
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
			if (imagePos < topOfWindow+400) {
				jQuery(this).addClass("fadeInLeft");
			}
		});	
	
	 
	 jQuery('#section10 .container').each(function(){
		var imagePos = jQuery(this).offset().top;
		var topOfWindow = jQuery(window).scrollTop();
			if (imagePos < topOfWindow+400) {
				jQuery(this).addClass("fadeInRight");
			}
		});	
		
	});