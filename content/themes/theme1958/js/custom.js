// Rewritten version
// By @mathias, @cheeaun and @jdalton

(function(doc) {
	var addEvent = 'addEventListener',
	type = 'gesturestart',
	qsa = 'querySelectorAll',
	scales = [1, 1],
	meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

	function fix() {
		meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
		doc.removeEventListener(type, fix, true);
	}

	if ((meta = meta[meta.length - 1]) && addEvent in doc) {
		fix();
		scales = [.25, 1.6];
		doc[addEvent](type, fix, true);
	}
}(document));


jQuery(document).ready(function(){
	// Tabs
	jQuery(".tabs").each(function(){
		jQuery(this).find(".tab").hide();
		jQuery(this).find(".tab-menu li:first a").addClass("active").show();
		jQuery(this).find(".tab:first").show();
	});

	jQuery(".tabs").each(function(){
		jQuery(this).find(".tab-menu a").click(function() {
			jQuery(this).parent().parent().find("a").removeClass("active");
			jQuery(this).addClass("active");
			jQuery(this).parent().parent().parent().parent().find(".tab").hide();
			var activeTab = jQuery(this).attr("href");
			jQuery(activeTab).fadeIn();
			return false;
		});
	});


	// Toggle
	jQuery(".toggle").each(function(){
		jQuery(this).find(".box").hide();
	});

	jQuery(".toggle").each(function(){
		jQuery(this).find(".trigger").click(function() {
			jQuery(this).toggleClass("active").next().stop(true, true).slideToggle("normal");
			return false;
		});
	});


	// Social Icons
	jQuery(".social-networks.icons li a").tooltip({
		effect: 'slide',
		position: 'bottom center',
		opacity: .5 
	});


	// Back to Top
	// fade in #back-top
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('#back-top').fadeIn();
			} else {
				jQuery('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		jQuery('#back-top').click(function () {
			jQuery('body,html').stop(false, false).animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

	jQuery("li:last-child, div > p:last-child, .testimonials .testi_item:last, #content .post-holder:last, #sidebar .widget:last").addClass("last-child");
	jQuery(".recent-posts.team li:nth-child(2n)").addClass("nomargin");
	
	// Init for audiojs
	audiojs.events.ready(function() {
		var as = audiojs.createAll();
	});

});

jQuery(function(){
	// prettyphoto init
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed:'normal',
		slideshow:5000,
		autoplay_slideshow: false,
		overlay_gallery: true
	});
	
	// Initialize the gallery
	jQuery("#gallery .touch-item, .gallery_item .touch-item").touchTouch();
	
	// Init for si.files
	SI.Files.stylizeAll();
	
	//Menu
	jQuery('.sf-menu').mobileMenu();
});

(function($){
	$.fn.equalHeights=function(minHeight,maxHeight){
		tallest=(minHeight)?minHeight:0;
		this.each(function(){
			if($(this).height()>tallest){tallest=$(this).height()}
		});
		if((maxHeight)&&tallest>maxHeight) tallest=maxHeight;
		return this.each(function(){$(this).height(tallest)})
	}
})(jQuery)

$(window).load(function(){
	if($(document).width()>767){
		if($(".maxheight, .content-area .top-box").length){$(".maxheight, .content-area .top-box").equalHeights()}
	}
})
$(window).resize(function(){
	$(".maxheight, .content-area .top-box").css({height:'auto'});
	if($(document).width()>767){
		if($(".maxheight, .content-area .top-box").length){$(".maxheight, .content-area .top-box").equalHeights()}
	}
})