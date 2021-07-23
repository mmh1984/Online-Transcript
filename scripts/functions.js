// JavaScript Document

$(document).ready(function(e) {
	
	$(window).scroll(function () {
    if($(document).scrollTop() > 600){
		  $(".sidebar").css("width","35%");
		 $(".sidebar").css("background-size","cover");
		$(".content").css("width","65%");	
      $("nav").css('background','#000033');
	  $("nav").css('position','fixed');
	$("#toplink").slideDown();

    }
    else{
     
	    $(".sidebar").css("width","30%");
		$(".content").css("width","70%");	
		 $("nav").css('background','');
	  $("nav").css('min-height','30px');
	 $("#toplink").slideUp();
	
    }
  });
	
	
    $("#explore").click(function() {
     

	
		
		$(".sidebar").css({'background-image':'url(./images/promo/about.jpg)'});
	 $(".sidebar").css("background-size","cover");
		scroll_to_anchor("section1");
		
    });
	
	 $("#mission").click(function() {
     

	
		
		$(".sidebar").css({'background-image':'url(./images/promo/mission.jpg)'});
		
		 $(".sidebar").css("background-size","cover");
		scroll_to_anchor("section2");
	
    });
	
	 $("#courses").click(function() {
     

	
		
		$(".sidebar").css({'background-image':'url(./images/promo/courses.jpg)'});
		
		
		scroll_to_anchor("section3");
	
    });
	
	
	
	 $("#testimonial").click(function() {
     

	
		
		$(".sidebar").css({'background-image':'url(./images/promo/testimonial.png)'});
		
		
		scroll_to_anchor("section4");
		
	
    });
	
	
	$(".contactus").click(function(){
		
		$("#contacts").toggle(500);
		
	});
	
	
	$("#contacts").click(function(){
		
		$(this).toggle(500);
		
	});
	
	
	
	function scroll_to_anchor(anchor_id){
    var tag = $("#"+anchor_id+"");
    $('html,body').animate({scrollTop: tag.offset().top},"slow");

}

$("a[href='#top']").click(function() {
  $("html, body").animate({ scrollTop: 0 }, "slow");
   $(".sidebar").css({'background-image':'url(./images/promo/promo1.png)'});
  return false;
});	
});

