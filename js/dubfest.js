/**
 * Created by zainulabdeen on 17/07/15.
 */

var defaultVideoEmbed = "https://www.youtube.com/embed/Ap2rVl_KP2Y";

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

	$(".sangramSingVideo").click(function(){
	$(".UnivrslPoupup").removeClass("hide");
	$(".videoSctn").removeClass("hide");
	$(".mainVideo").removeClass("hide");
	$(".subVideo").addClass("hide");
	$(".cntct").addClass("hide");
	});
	
	/* show light box on page load when parameter lightbox = true with content id */
	if(getUrlParameter('lightbox') == "true"){
		var content_id = getUrlParameter('content');
		var media_id = SelectedVideo.media_id;
		var media_url = SelectedVideo.media_url;
		var vote = SelectedVideo.vote;
		var title = SelectedVideo.media_title;
		var message = SelectedVideo.message;

		var embedUrl = "https://www.youtube.com/embed/"+media_id;

		$lightBoxObj = $(".UnivrslPoupup");

		//replace all data with placeholders in the lightbox
		$("#YourIFrameID").attr('src',embedUrl);
		$($lightBoxObj).find('.VideoTitle').html(title);
		if (undefined !== message){
			$($lightBoxObj).find('.VideoMessage').html('<p>' + message + '</p>');
		}

		//voting form
		$(".votNowFrm").find(".votenow").attr("data-content_id", content_id);
		$(".votNowFrm").find(".totalVoteCount").html('<span>' + vote + '</span>');
		$(".votNowFrm").find(".votingMessage").addClass("hide");

		//show the popup now
		$(".videoSctn").removeClass("hide");
		$(".subVideo").removeClass("hide");
		$(".mainVideo").addClass("hide");
		$(".cntct").addClass("hide");
		$(".UnivrslPoupup").removeClass("hide");
	}
	/* show light box on page load when parameter lightbox = true with content id */
	
	$(document).on('click','.ShareSctn', function(){
		shareTrigger();
    });

    //LightBox Open Action for Carousel & Gallery
    $(document).on('click', ".VideoPlayBtn", function(){
        var $obj = $(this).parent();
        openLightBox($obj);
    });

    //LightBox Close Action
    $(".univrslPoupClose").on('click', closeLightBox );

    //voting options
    var cookieExist = null;
    var userInfo = null;

    $(".votenow").on("click", function(e) {

        var videoId = $(this).attr('data-content_id');
        var params = null;
        if (cookieExist === false) {
            var userName = $("#username").val();
            var emailId = $("#email").val();

            if ($("#username").val() == '') {
                alert("Please Enter Username ");
                return false;
            }
            if ($("#email").val() == '') {
                alert("Please Enter Email Address. ");
                return false;
            }

            var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
            //if it's valid email
            if (!filter.test($("#email").val())) {
                alert("Please Enter Valid Email Address. ");
                return false;
            }
            params = {'name': userName, 'email': emailId, 'videoId': videoId, 'cookieSet': 0};
        } else {
            params = {'videoId': videoId, 'cookieSet': 1};
        }

        if (typeof params !== 'undefined' && Object.keys(params).length !== 0) {
            vote(params);
        }


    });

    cookieExist = checkCookieExist();
    if (cookieExist) {
        $(".userInfo").addClass("hide");
        $(".voteInfo").removeClass("hide");
    }


    //contact form
    $("#contact").on('click', function() {
        $(".UnivrslPoupup").removeClass("hide");
        $(".videoSctn").addClass("hide");
        $(".cntct").removeClass("hide");
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



/**
 * Show lightbox with video and voting options
 */
function openLightBox(obj){
    var content_id = obj.attr('data-content_id');
    var media_id = obj.attr('data-media_id');
    var media_url = obj.attr('data-media_url');
    var vote = obj.attr('data-vote');
    var title = obj.attr('data-title');
    var message = obj.find(".videoMessage").attr('data-media_message');

    var embedUrl = "https://www.youtube.com/embed/"+media_id;

    $lightBoxObj = $(".UnivrslPoupup");

    //replace all data with placeholders in the lightbox
    $("#YourIFrameID").attr('src',embedUrl);
    $($lightBoxObj).find('.VideoTitle').html(title);
    if (undefined !== message){
        $($lightBoxObj).find('.VideoMessage').html('<p>' + message + '</p>');
    }

    //voting form
    $(".votNowFrm").find(".votenow").attr("data-content_id", content_id);
    $(".votNowFrm").find(".totalVoteCount").html('<span>' + vote + '</span>');
    $(".votNowFrm").find(".votingMessage").addClass("hide");

    //show the popup now
    $(".videoSctn").removeClass("hide");
    $(".subVideo").removeClass("hide");
    $(".mainVideo").addClass("hide");
    $(".cntct").addClass("hide");
    $(".UnivrslPoupup").removeClass("hide");
}

function closeLightBox(){
    $('#YourIFrameID').attr('src', defaultVideoEmbed);
    $(".UnivrslPoupup").addClass("hide");
}

function shareTrigger(){
	alert("share button clicked");
}

var vote = function(data) {
    var url = {
        'votingAction': host + '/pages/voting'
    };
    $.ajax({
        url: url.votingAction,
        type: 'POST',
        data: data,
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(data) {
            if (data.error == 0) {
                var votecount = data.votecount;
                $(".userInfo").addClass("hide");
                $(".totalVoteCount").removeClass("hide");
                $(".totalVoteCount").html('<span>' + votecount + '</span>');
                $("#video-" + data.id).attr("data-vote", votecount);
                $(".voteInfo").removeClass("hide");
            } else {
                $(".votingMessage").removeClass("hide");
                $(".votingMessage").html(data.message);
            }
        },
        complete: function() {
        },
        error: function(xhr, textStatus, error) {
        }
    });


};

var checkCookieExist = function() {
    userInfo = $.cookie("USERINFO");
    if (typeof userInfo !== "undefined") {
        return true;
    }
    return false;

}

/* Getting URL Parameter */
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

