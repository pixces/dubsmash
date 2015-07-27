/**
 * Created by zainulabdeen on 17/07/15.
 */

$( document ).ready(function() {

    /* Carousel */

    $('.carousel').carousel({
        pause: true,
        interval: false,
        wrap: false
    }).on('slid.bs.carousel', function () {
        curSlide = $('.active');
        if(curSlide.is( ':first-child' )) {
            $('.left').hide();
            return;
        } else {
            $('.left').show();
        }
        if (curSlide.is( ':last-child' )) {
            $('.right').hide();
            return;
        } else {
            $('.right').show();
        }
    });

	$('#sangramSingVideo1').click(function(){
		
    $('#sangramSingVideo').attr('src', host + '/images/Mainthum1.png');
	$(".mainVideo").removeClass("hide");
	$(".subVideo").addClass("hide");
    });
	
	$('#sangramSingVideo2').click(function(){
    $('#sangramSingVideo').attr('src', host + '/images/Mainthum2.png');
	$(".mainVideo").removeClass("hide");
	$(".subVideo").addClass("hide");
    });
	
	$('#sangramSingVideo3').click(function(){
    $('#sangramSingVideo').attr('src', host + '/images/Mainthum3.png');
	$(".mainVideo").removeClass("hide");
	$(".subVideo").addClass("hide");
    });
	
	$('#sangramSingVideo4').click(function(){
    $('#sangramSingVideo').attr('src', host + '/images/Mainthum4.png');
	$(".mainVideo").removeClass("hide");
	$(".subVideo").addClass("hide");
    });
	
    $(".univrslPoupClose").click(function(){
	var url = $('#YourIFrameID').attr('src');
    $('#YourIFrameID').attr('src', '');	
	$('#YourIFrameID').attr('src', url);
	var url = $('#YourIFrameID_1').attr('src');
    $('#YourIFrameID_1').attr('src', '');	
	$('#YourIFrameID_1').attr('src', url);
	$(".UnivrslPoupup").addClass("hide");
	});
	
	$(".sangramSingVideo").click(function(){
	$(".UnivrslPoupup").removeClass("hide");
	$(".videoSctn").removeClass("hide");
	$(".mainVideo").removeClass("hide");
	$(".subVideo").addClass("hide");
	$(".cntct").addClass("hide");
	});



    $(".PlayIcn2").click(function(){
	    $(".UnivrslPoupup").removeClass("hide");
	    $(".subVideo").removeClass("hide");
	    $(".mainVideo").addClass("hide");
	    $(".cntct").addClass("hide");
	});
		
	$(".vdoethmb").click(function(){
	    $(".UnivrslPoupup").removeClass("hide");
	    $(".videoSctn").removeClass("hide");
	    $(".subVideo").removeClass("hide");
	    $(".mainVideo").addClass("hide");
	    $(".cntct").addClass("hide");
	});

    $(".PlayIcn1").click(function(){
        $(".UnivrslPoupup").removeClass("hide");
        $(".videoSctn").removeClass("hide");
        $(".subVideo").removeClass("hide");
        $(".mainVideo").addClass("hide");
        $(".cntct").addClass("hide");
    });
	
		$(".hmprcptBtn").click(function(){
		$(".participateprceCntr").addClass("hide");
		$(".participatelgnCntr").removeClass("hide");
		});
		
		$(".glryLoad").click(function(){
		$(".participateprceCntr").addClass("hide");
		$(".participatelgnCntr").removeClass("hide");
		});
		
		$(".participatelgncls").click(function(){
		$(".participateprceCntr").removeClass("hide");
		$(".participatelgnCntr").addClass("hide");
		});
		
		/* $(".sldetp").click(function(){
        $("html, body").animate({ scrollTop: "0px" });
    });*/
		
		
		});
function goBack() {
       window.history.back();
}





