$(document).ready(function(){	
	$("#CH-VideoCarousel").owlCarousel({
		//autoPlay: 3000, //Set AutoPlay to 3 seconds
		items:4,
		itemsDesktop:[1199,4],
		itemsDesktopSmall:[979,3],
		itemsMobile:[600,1],
		navigation:true
	});
	$("#CH-MobileMenu").click(function(){
		$(this).next().slideToggle();
	});
	
	// function to show our popups
    function showPopup(whichpopup){
        var docHeight = $(document).height(); 
        var scrollTop = $(window).scrollTop();		
		/*alert($(window).height()+'----'+$('.overlay-content').outerHeight()+'---'+$(document).height());*/		
		/*var top = ($(window).height() - $('.overlay-content').outerHeight()) / 2;*/
        $('.overlay-wrapper').show().css({'height' : docHeight}); 
        $('.popup'+whichpopup).show(); 
    }
	
	// function to close our popups
    function closePopup(){
		$(".overlay-content .overlay-title").empty();
		$(".overlay-content .modalVideo").empty();
		
		$('.CH-YouTubeList .scroll-pane').scrollTop(0);
		$(".CH-YouTubeListItems").removeClass("active");
		$(".YouTubeVideoID").val("");
		$(".YouTubeVideoThumbURL").val("");
		$(".YouTubeVideoBigURL").val("");
		$(".YouTubeVideoTitle").val("");
		$(".YouTubeVideoDescription").val("");
		$(".YouTubeVideoChannelId").val("");
		$(".YouTubeVideoChannelTitle").val("");
		
		document.forms[0].reset();
		
        $('.overlay-wrapper, .overlay-content').hide(); //hide the overlay
		
		$('.overlay-content.popup1').attr('style','top:0px;display:none');
    }
	
    $('.show-popup').on('click',function(event){
		//var VideoUrl = "http://localhost/projects/ComedyHuntServer/videos/";
        var VideoUrl = "https://comedyhunt.position2.com/videos/";
		
        event.preventDefault();
        var selectedPopup = $(this).data('showpopup');		
        showPopup(selectedPopup); 
		
		if(selectedPopup == 1){
			var VideoURL = $(this).attr('data-videoURL');
			var VideoTitle = $(this).attr('data-videoTitle');
			
			//var iframeTemplate = '<iframe width="853" height="480" src="https://www.youtube.com/embed/'+VideoURL+'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1&amp;modestbranding=1;enablejsapi=1" frameborder="0" allowfullscreen id="th-553fed94be2f27b50100729a-video"></iframe>';
			var iframeTemplate = '<iframe width="853" height="480" src="https://www.youtube.com/embed/'+VideoURL+'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1&amp;modestbranding=1;enablejsapi=1" frameborder="0" allowfullscreen></iframe>';
			
			$(".overlay-content .overlay-title").html(VideoTitle);
			$(".overlay-content .modalVideo").html(iframeTemplate);
		}else if(selectedPopup == 2){
			$.get( VideoUrl, function( data ) {
				$('#CH-YouTubeListContainer').html(data);
			});
		}		
    });
	
	$('.mainVideo').on('click',function(){
		$('.overlay-content.popup1').attr('style','top:30px !important;display:block');
	});
	
	// hide popup when user clicks on close button or if user clicks anywhere outside the container
    $('.close-btn, .overlay-wrapper').on('click',function(){		
        closePopup();
    });
     
    // hide the popup when user presses the esc key
    $(document).keyup(function(e) {
        if (e.keyCode == 27) { // if user presses esc key			
            closePopup();
        }
    });
	
	/*$('.CH-Video .CH-VideoThumbPlay a').on('click',function(event){
		var CHVideoURL = $(this).attr('data-CHVideoURL');
		var CHVideoTitle = $(this).attr('data-CHVideoTitle');
		
		var iframeTemplate1 = '<iframe width="853" height="480" src="https://www.youtube.com/embed/'+CHVideoURL+'?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1&amp;modestbranding=1;enablejsapi=1" frameborder="0" allowfullscreen id="th-553fed94be2f27b50100729a-video"></iframe>';
		
		$(".CH-VideoOverlay .CH-VideoTitle").html(CHVideoTitle);
		$(".CH-VideoOverlay .CH-VideoDescription").html(iframeTemplate1);
		$(".CH-VideoOverlay").show();
	});
	
	$('.CH-VideoClose').on('click',function(){
		$(".CH-VideoOverlay .CH-VideoTitle").empty();
		$(".CH-VideoOverlay .CH-VideoDescription").empty();
        $(".CH-VideoOverlay").hide();
    });*/
	
	$(window).resize(function(){
		var windowWidth = $(window).width();
		if(windowWidth > 767){
			$(".CH-MainMenu ul").show();
		}else{
			$(".CH-MainMenu ul").hide();
		}
	});
	
	$('.CH-GalleryList .scroll-pane').jScrollPane({
		autoReinitialise:true
	});
	
	$('.CH-FaqList .scroll-pane').jScrollPane({
		autoReinitialise:true
	});
	
	$('.CH-RulesList .scroll-pane').jScrollPane({
		autoReinitialise:true
	});
	
	$(".ContestEntriesThumb").ytplaylist({
		holderId: 'ytContestEntries',
		html5: true,
		playerWidth: '520',
		autoPlay: true,
		sliding: false,
		listsliding: true,
		slidingshow: true,
		social: true,
		autoHide: false,
		playfirst: 0,
		playOnLoad: false,
		modestbranding: true,
		showInfo: false
	});
	
	$(".videoThumb4").ytplaylist({
		holderId: 'ytvideo4',
		html5: true,
		playerWidth: '520',
		autoPlay: true,
		sliding: false,
		listsliding: true,
		slidingshow: true,
		social: true,
		autoHide: false,
		playfirst: 0,
		playOnLoad: false,
		modestbranding: true,
		showInfo: false
	});
	
	$(".videoThumb3").ytplaylist({
		holderId: 'ytvideo3',
		html5: true,
		playerWidth: '520',
		autoPlay: true,
		sliding: false,
		listsliding: true,
		slidingshow: true,
		social: true,
		autoHide: false,
		playfirst: 0,
		playOnLoad: false,
		modestbranding: true,
		showInfo: false
	});
	
	$(".videoThumb2").ytplaylist({
		holderId: 'ytvideo2',
		html5: true,
		playerWidth: '520',
		autoPlay: true,
		sliding: false,
		listsliding: true,
		slidingshow: true,
		social: true,
		autoHide: false,
		playfirst: 0,
		playOnLoad: false,
		modestbranding: true,
		showInfo: false
	});
	
	$(".videoThumb1").ytplaylist({
		holderId: 'ytvideo1',
		html5: true,
		playerWidth: '520',
		autoPlay: true,
		sliding: false,
		listsliding: true,
		slidingshow: true,
		social: true,
		autoHide: false,
		playfirst: 0,
		playOnLoad: false,
		modestbranding: true,
		showInfo: false
	});
	
	$(".videoThumbgallery1").ytplaylist({
		holderId: 'ytvideogallery1',
		html5: true,
		playerWidth: '520',
		autoPlay: true,
		sliding: false,
		listsliding: true,
		slidingshow: true,
		social: true,
		autoHide: false,
		playfirst: 0,
		playOnLoad: false,
		modestbranding: true,
		showInfo: false
	});
	
	$(".videoThumbgallery2").ytplaylist({
		holderId: 'ytvideogallery2',
		html5: true,
		playerWidth: '520',
		autoPlay: true,
		sliding: false,
		listsliding: true,
		slidingshow: true,
		social: true,
		autoHide: false,
		playfirst: 0,
		playOnLoad: false,
		modestbranding: true,
		showInfo: false
	});
	
	$(".videoThumbgallery3").ytplaylist({
		holderId: 'ytvideogallery3',
		html5: true,
		playerWidth: '520',
		autoPlay: true,
		sliding: false,
		listsliding: true,
		slidingshow: true,
		social: true,
		autoHide: false,
		playfirst: 0,
		playOnLoad: false,
		modestbranding: true,
		showInfo: false
	});
	
	$(".CH-Tooltip").on({
        mouseover: function() { $(".CH-TooltipMessage").show(); },
        mouseout:  function() { $(".CH-TooltipMessage").hide(); }
    });
	
	$(document).on("click",".CH-YouTubeListItems",function(){
		$(".CH-YouTubeListItems").removeClass("active");
		$(this).addClass("active");
		
		var YouTubeVideoID, YouTubeVideoThumbURL, YouTubeVideoBigURL, YouTubeVideoTitle, YouTubeVideoDescription, YouTubeVideoChannelId, YouTubeVideoChannelTitle;
		YouTubeVideoID = $(this).attr("data-YouTubeVideoID");
		YouTubeVideoThumbURL = $(this).attr("data-YouTubeVideoThumbURL");
		YouTubeVideoBigURL = $(this).attr("data-YouTubeVideoBigURL");
		YouTubeVideoTitle = $(this).attr("data-YouTubeVideoTitle");
		YouTubeVideoDescription = $(this).attr("data-YouTubeVideoDescription");
		YouTubeVideoChannelId = $(this).attr("data-YouTubeVideoChannelId");
		YouTubeVideoChannelTitle = $(this).attr("data-YouTubeVideoChannelTitle");
		
		$(".YouTubeVideoID").val(YouTubeVideoID);
		$(".YouTubeVideoThumbURL").val(YouTubeVideoThumbURL);
		$(".YouTubeVideoBigURL").val(YouTubeVideoBigURL);
		$(".YouTubeVideoTitle").val(YouTubeVideoTitle);
		$(".YouTubeVideoDescription").val(YouTubeVideoDescription);
		$(".YouTubeVideoChannelId").val(YouTubeVideoChannelId);
		$(".YouTubeVideoChannelTitle").val(YouTubeVideoChannelTitle);
	});
	
	$("#YouTubeForm").validate({
		rules: {
			name: {
				required: true
			}
		},
		messages: {
			name: {
				required: "Please enter your name"
			}
		}
	});
	
	$('.authenticate').on('click',function(){
		if($('.termscheckbox').prop("checked") == false){
			$('.errorterms').show();
			return false;
		}else{
			window.open(this.href, '_blank' ,'toolbar=no, scrollbars=yes, resizable=yes, top=0, left=0, width=400, height=400'); 
			return false;
		}
	});
	
	$('.termscheckbox').on('click',function(){
		if($('.termscheckbox').prop("checked") == true){
			$('.errorterms').hide();
		}else if($('.termscheckbox').prop("checked") == false){
			$('.errorterms').show();
		}
	});
	
	$("#YouTubeForm").submit(function(e){
		e.preventDefault();
		
		if($.trim($('#name').val()) == ''){
			return false;
		}
		
		if($('.CH-YouTubeListItems').hasClass('active')){
			var postData = $(this).serializeArray();
			var formURL = $(this).attr("action");
			
			console.log(JSON.stringify(postData));
			
			$.ajax(
			{
				url : formURL,
				type: "GET",
				contentType: "application/json; charset=utf-8",
				//dataType: "jsonp",
				data : {
					params: JSON.stringify(postData)
				},
				crossDomain: true,
				success:function(data, jqXHR)
				{
                    Obj = JSON.parse(data);

                    if(Obj.status == 'success') {
						closePopup();
                        location.reload(true);
					} else {
                        $('.YouTubeFormError').html(Obj.message);
                    }
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					$('.YouTubeFormError').html('Error selecting video, Please submit again.');
				}
			});
		}else{
			$('.YouTubeFormError').show();
		}
		
		
	});
	
});
