var myIndex = 0;
$(document).ready(function() {
	var ww = document.body.clientWidth;
	$(".navi li a").each(function() {
		if ($(this).next().length > 0) {
			//$(this).addClass("parent");
		};
	})
	
	$(".toggleMenu").click(function(e) {
		e.preventDefault();
		$(this).toggleClass("active");
		//$(".navi").toggle(5000);
		$(".navi").slideToggle(500);
	});
	adjustMenu();
})


$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function() {
	var ww = document.body.clientWidth;
	if (ww < 1023) {
		$(".toggleMenu").css("display", "inline-block");
		if (!$(".toggleMenu").hasClass("active")) {
			$(".navi").hide();
		} else {
			$(".navi").show();
		}
		$(".navi li").unbind('mouseenter mouseleave');
		$(".navi li a.parent").unbind('click').bind('click', function(e) {
			// must be attached to anchor element to prevent bubbling
			e.preventDefault();
			$(this).parent("li").toggleClass("hover");
		});
	} 
	else if (ww >= 1023) {
		$(".toggleMenu").css("display", "none");
		$(".navi").show();
		$(".navi li").removeClass("hover");
		$(".navi li a").unbind('click');
		$(".navi li").unbind('mouseenter mouseleave');
		$(".navi li").bind('mouseenter', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	$(this).addClass('hover');
		});
		$(".navi li").bind('mouseleave', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	$(this).removeClass('hover');
		});
	}
}

/* Quantity jquery */
/*
jQuery(document).ready(function(){
								
    // This button will increment the value
    $('.qtyplus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
});*/

jQuery(document).ready(function(){
	var header_height =  $('header').height();
	var footer_height =  $('footer').height();
	var window_height =  $(window).height();
	var document_height =  $(document).height();
	var bodysec = document_height - (header_height + footer_height);
	//console.log(header_height,footer_height,window_height,document_height);
   // $('.bodysec').css('min-height',bodysec+'px');
   var carausal = document.getElementsByClassName('banner');
   if(carausal.length > 0){
  	 carousel();
   }
   $('.parent').click(function(){
		console.log($(this).text());
		$(this).parent().children('.sub').toggle();
	});
   setTimeout(hideMsg, 10000);
   var minute = $('#timer').attr('data-minute');
   var sec = $('#timer').attr('data-seconds');
   var timer = document.getElementById('timer');
   if(timer){
   	setTimer(minute,sec); // 5 minutes
	$('#resend_otp').click(function(){resendOTP();});
   }
});
$( function() {
    $( "#date_from" ).datepicker({
		changeMonth: true,
      	changeYear: true,
		yearRange: "-20:+0",
		dateFormat: 'dd-mm-yy'
	});
	$( "#date_to" ).datepicker({
		changeMonth: true,
      	changeYear: true,
		yearRange: "-20:+0",
		dateFormat: 'dd-mm-yy'
	});
	$( "#datepicker" ).datepicker({
		changeMonth: true,
      	changeYear: true,
		yearRange: "-120:+0",
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker" ).datepicker({
		changeMonth: true,
      	changeYear: true,
		yearRange: "-120:+0",
		dateFormat: 'dd-mm-yy'
	});
	$( ".datepicker_slash" ).datepicker({
		changeMonth: true,
      	changeYear: true,
		yearRange: "-120:+0",
		dateFormat: 'dd/mm/yy'
	});
	$('.show_more').click(function(){
		$(this).hide();
		$('.show_less').show();
		$('.hide_res').css('display','block');
	 });
	$('.show_less').click(function(){
		$(this).hide();
		$('.show_more').show();
		$('.hide_res').css('display','none');
	 });
  });
function hideMsg(){
	$('.success').remove();
	
}
var timeoutHandle,timeoutHandle2;
function setTimer(minutes,sec,reset_tick){
	var mins = minutes;
	var seconds = (sec == undefined) ? 60 : sec;
	
    function tick() {
        var counter = document.getElementById("timer");
        var current_minutes = mins-1
        seconds--;
       $('#timer').text(current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds));
        if( seconds > 0 ) {
            timeoutHandle=setTimeout(tick, 1000);
        } else {
            if(mins > 1){
               // countdown(mins-1);   never reach �00? issue solved:Contributed by Victor Streithorst
              timeoutHandle2 =  setTimeout(function () { setTimer(mins - 1); }, 1000);
            }
        }
    }
	if(reset_tick != undefined){
		clearTimeout(timeoutHandle);	
		clearTimeout(timeoutHandle2);
		tick();
	}else{
   	 	tick();
	}
}
function resendOTP(){
	$.get(BASEPATH+'ajax/resend_otp','',function(res){
		var res_obj = $.parseJSON(res);
		if(res_obj.success){
			var r_min = res_obj.mint;
			var r_sec = res_obj.sec;
			$('#timer').attr('data-minute',r_min);
			$('#timer').attr('data-seconds',r_sec);
			setTimer(r_min,r_sec,true);
			$('.err').remove();
		}
	});	
}
function change_site_lang(lang){
	$.get(BASEPATH+'LanguageSwitcher/switchLang/'+lang,'',function(res){
		location.reload();
	});	
}
function carousel() {
	var i;
	var x = $('.banner img');
	for (i = 0; i < x.length; i++) {
	   x[i].style.display = "none";  
	}
	myIndex++;
	if (myIndex > x.length) {myIndex = 1}    
	x.eq(myIndex-1).css('display',"block");  
	setTimeout(carousel, 2000); // Change image every 2 seconds
}
function increseFont(){
	$('body').css('font-size','17px');
	$('.navi a').css('font-size','14px');
	$.get(BASEPATH + 'ajax/increase_font');
}
function defaultFont(){
	$('body').css('font-size','15px');
	$('.navi a').css('font-size','12px');
	$.get(BASEPATH + 'ajax/default_font');
}
function decreseFont(){
	$('body').css('font-size','12px');
	$('.navi a').css('font-size','11px');
	$.get(BASEPATH + 'ajax/decrese_font');
}
function linkTOPage(page_url){
	if(page_url != undefined && page_url != '#'){
		// 
		location.href = page_url;
	}
	console.log(page_url);
}
function selectTheam(theam){
	$.get(BASEPATH + 'ajax/change_theam/'+theam,function(){
		window.location.reload(true);
	});
}

 $(document).on("click","#tree ul.nav li.parent > a.tree-parent", function(){          
        $(this).find('i:first').toggleClass("fa-caret-right");  
		$(this).find('i:first').toggleClass("fa-caret-down");    
    }); 
 $(window).scroll(function(){
	if ($(this).scrollTop() > 100) {
		$('#myBtn').fadeIn();
	} else {
		$('#myBtn').fadeOut();
	}
});

function topFunction() {
	$("html, body").animate({ scrollTop: 0 }, 600);
    return false;
}
function reload_captcha(){
 	$.get(BASEPATH+'ajax/regenerate_captcha',function(data){
		var res = $.parseJSON(data);
		var image = BASEPATH+res.image;
		$('#capId').attr('src',image);
	});
 }
 function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);