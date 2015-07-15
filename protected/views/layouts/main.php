<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Comedy Hunt</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

	<!-- Style Starts Here -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/vendor/owl.carousel.css" type='text/css' />
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/vendor/owl.theme.css" type='text/css' />
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/vendor/owl.transitions.css" type='text/css' />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/vendor/jquery.jscrollpane.css" type='text/css' />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" type='text/css' />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/media-queries.css" type='text/css' />
	<!-- Style Ends Here -->
</head>
<body>
	<div class="CH-Wrapper">

		<!-- Navigation Starts Here -->
		<div class="CH-NavWrapper">
			<div class="CH-Navigation">
				<!-- Main Menu Starts Here -->
				<div class="CH-MainMenu">
					<a id="CH-MobileMenu" href="javascript:void(0)"></a>
					<ul>
                        <li><a href="<?=Yii::app()->createAbsoluteUrl('/'); ?>" class="<?=($this->pagename == 'index') ? 'active ':''; ?> transition">Home</a></li>
                        <!--<li><a href="<?=Yii::app()->createAbsoluteUrl('/gallery/'); ?>" class="<?=($this->pagename == 'gallery') ? 'active ':''; ?>transition">Gallery</a></li>
                        <li><a href="<?=Yii::app()->createAbsoluteUrl('/site/faq/'); ?>" class="<?=($this->pagename == 'faq') ? 'active ':''; ?>transition">Faq's</a></li> -->
                        <li class="no-border"><a href="<?=Yii::app()->createAbsoluteUrl('/site/page/?view=rules'); ?>" class="<?=($this->pagename == 'page') ? 'active ':''; ?>transition">Rules</a></li>
					</ul>
				</div>
				<!-- Main Menu Ends Here -->

				<!-- Social Icons Starts Here -->
				<div class="CH-SocialIcons">
					<ul>
						<!--li class="googleplus"><a href="javascript:void(0)" class="transition"></a></li-->
						<li class="facebook"><a href="https://www.facebook.com/ComedyHunt?fref=ts" target="_blank" class="transition"></a></li>
						<li class="twitter"><a href="https://twitter.com/comedyhunt" target="_blank" class="transition"></a></li>
					</ul>
				</div>
				<!-- Social Icons Ends Here -->
			</div>
		</div>
		<!-- Navigation Ends Here -->

        <!-- Content Starts -->
        <?php echo $content; ?>
        <!-- Content Ends -->

		<!-- Client Logo Starts Here -->
		<div class="CH-ClientLogo">
			<div class="CH-ClientLogoBG"></div>
			<div class="CH-ClientLogoBlk">
            	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/footer-logo.png" class="img-responsive" />
				<!--ul>
					<li><a href="javascript:void(0)"><img src="images/quikr-logo.png" /></a></li>
					<li><a href="javascript:void(0)"><img src="images/micromax-logo.png" /></a></li>
					<li><a href="javascript:void(0)"><img src="images/royal-challenge-logo.png" /></a></li>
					<li><a href="javascript:void(0)"><img src="images/garnier-men-logo.png" /></a></li>
					<li><a href="javascript:void(0)"><img src="images/5star-logo.png" /></a></li>
					<li><a href="javascript:void(0)"><img src="images/sprite-logo.png" /></a></li>
					<li><a href="javascript:void(0)"><img src="images/yoddly-logo.png" /></a></li>
				</ul-->
			</div>
			<div class="CH-SocialIcons">
				<ul>
					<li class="sharetext">Follow Us</li>
					<!--li class="googleplus"><a href="javascript:void(0)" class="transition"></a></li-->
					<li class="facebook"><a href="https://www.facebook.com/ComedyHunt?fref=ts" target="_blank" class="transition"></a></li>
					<li class="twitter"><a href="https://twitter.com/comedyhunt" target="_blank" class="transition"></a></li>
				</ul>
			</div>
			<div class="CH-Links">
				<ul>
					<li><a href="https://youtube.com" target="_blank">Youtube</a></li>
					<li><a href="<?=Yii::app()->createAbsoluteUrl('/site/page/?view=rules'); ?>" target="_blank">Terms &amp; Conditions</a></li>
				</ul>
				<div class="CH-CopyRight">&copy; copyright 2015. All rights reserved</div>
			</div>
		</div>
		<!-- Client Logo Ends Here -->
	</div>

	<!-- Overlay Starts Here -->
    <div class="overlay-wrapper"></div>

    <div class="overlay-content popup1">
    	<div class="close-btn"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/close-icon-black.png" /></div>
		<div class="overlay-title"></div>
		<div class="overlay-description">
			<div class="modalVideo"></div>
		</div>
	</div>
	
	<div class="overlay-content popup2">
    	<div class="close-btn"><img src="images/close-icon-black.png" /></div>
		<div class="CH-YouTubeTitle">Your Videos</div>
		<form id="YouTubeForm" novalidate name="YouTubeForm" action="<?=Yii::app()->createUrl('/pages/Save/'); ?>">
			<div id="CH-YouTubeListContainer">
				<div class="CH-YouTubeList">
					<div class="scroll-pane">
						
					</div>
				</div>
			</div>
			<div class="CH-YouTubeListFormGroup">
				<label for="name">Your Name</label>
				<input type="text" name="name" id="name" placeholder="Enter your name" />
			</div>
			<input type="hidden" class="YouTubeVideoID" id="YTVideoID" name="YTVideoID" value="" />
			<input type="hidden" class="YouTubeVideoThumbURL" id="YTVideoThumbURL" name="YTVideoThumbURL" value=""  />
			<input type="hidden" class="YouTubeVideoBigURL" id="YTVideoBigURL" name="YTVideoBigURL" value=""  />
			<input type="hidden" class="YouTubeVideoTitle" id="YTVideoTitle" name="YTVideoTitle" value=""  />
			<input type="hidden" class="YouTubeVideoDescription" id="YTVideoDescription" name="YTVideoDescription" value=""  />
			<input type="hidden" class="YouTubeVideoChannelId" id="YTVideoChannelId" name="YTVideoChannelId" value=""  />
			<input type="hidden" class="YouTubeVideoChannelTitle" id="YTVideoChannelTitle" name="YTVideoChannelTitle" value=""  />
			<input type="submit" value="submit" class="CH-YouTubeVideoSubmit" />
			<div class="CH-YouTubeNote">* Please make sure your video is authorized to the public.</div>
		</form>
	</div>
	
	<div class="overlay-content popup3">
    	<div class="close-btn"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/close-icon-black.png" /></div>
		<div class="overlayTitle">All you need to know about the Comedy Hunt</div>
		<div class="overlay-description">
			<div class="modalVideo1">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/videoseries?list=PLX19kCCkfm1q2-4Of5DynRQC-W4AZ-sCy" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
    <!-- Overlay Ends Here -->

	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/owl.carousel.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery.jscrollpane.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery.validate.min.js"></script>

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery.youtubeplaylist.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-3365665-9', 'auto');
	  ga('send', 'pageview');

	</script>
</body>
</html>
