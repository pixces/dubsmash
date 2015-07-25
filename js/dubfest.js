/**
 * Created by zainulabdeen on 17/07/15.
 */

$(document).ready(function () {

   $('.carousel').carousel({
    pause: true,
    interval: false
});
	$('#sangramSingVideo1').click(function(){
    $('#sangramSingVideo').attr('src', '/images/thmb1a.png');
    });
	
	$('#sangramSingVideo2').click(function(){
    $('#sangramSingVideo').attr('src', '/images/thmb2a.png');
    });
	
	$('#sangramSingVideo3').click(function(){
    $('#sangramSingVideo').attr('src', '/images/thmb3a.png');
    });
	
	$('#sangramSingVideo4').click(function(){
    $('#sangramSingVideo').attr('src', '/images/thmb4a.png');
    });
	
    $(".univrslPoupClose").click(function(){
	$(".UnivrslPoupup").addClass("hide");
	});
	
	$(".sangramSingVideo").click(function(){
	$(".UnivrslPoupup").removeClass("hide");
	$(".videoSctn").removeClass("hide");
	$(".cntct").addClass("hide");
	});
	
	$(".PlayIcn1").click(function(){
	$(".UnivrslPoupup").removeClass("hide");
	$(".videoSctn").removeClass("hide");
	$(".cntct").addClass("hide");
	});
	
	$(".PlayIcn2").click(function(){
	$(".UnivrslPoupup").removeClass("hide");
	$(".videoSctn").removeClass("hide");
	$(".cntct").addClass("hide");
	});
		
	$(".vdoethmb").click(function(){
	$(".UnivrslPoupup").removeClass("hide");
	$(".videoSctn").removeClass("hide");
	$(".cntct").addClass("hide");
	});
	
		$(".hmprcptBtn").click(function(){
		$(".participateprceCntr").addClass("hide");
		$(".participatelgnCntr").removeClass("hide");
		});
		
		$(".participatelgncls").click(function(){
		$(".participateprceCntr").removeClass("hide");
		$(".participatelgnCntr").addClass("hide");
		});

    $(".sldetp").click(function(){
        $("html, body").animate({ scrollTop: "0px" });
    });


});

