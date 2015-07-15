<!-- Submissions Starts Here -->
<div class="CH-Submissions">
    <div class="CH-SubmissionsContent">
        <div class="CH-SubmissionsText">
            <div class="CH-SubmissionsVideoBlk">
                <div class="CH-SubmissionsVideo transition">
                    <div class="CH-SubmissionsVideoImage"><img src="images/video-image1.png"/></div>
                    <div class="CH-SubmissionsVideoPlay">
                        <a href="javascript:void(0)" data-showpopup="3" class="show-popup mainVideo"><span><img
                                    src="images/video-play-icon.png"/></span></a>
                    </div>
                </div>
            </div>
            <div class="CH-SubmissionsTextContainer">
                <?php if ($auth && $submission) { ?>
				<div class="CH-Head acenter">Thank you for <br/>your submission</div>
                <?php } else { ?>
				<div>
					<div class="CH-SubHead">Your Route to Stardom</div>
					<div class="CH-Text no-margin">
						<ul>
							<li>Set up your own YouTube channel</li>
							<li>Shoot your Entry Video, which should be under 3 minutes</li>
							<li>Upload your Entry Video on to your YouTube channel, with the title in this format: "Comedy Hunt – entry video title"</li>
							<li>Read the terms and conditions on this page</li>
							<li>Click on the check box, press the Submit button, follow the steps after that & and keep checking this channel and our social handles for updates!</li>
							<li>Contestants can participate in the hunt as individuals or as a team</li>
							<li>Entry videos can be in any language. However, subtitles must be added to videos that are in languages other than English or Hindi. Last Date for entries is 26th July 2015</li>
						</ul>
					</div>
				</div>
                <?php } ?>
            </div>
        </div>
        <div class="CH-SubmissionsContentBG"></div>
        <div class="CH-SubmissionsForm">
            <div class="CH-SubmissionsFormContainer">
                <div class="CH-SubmissionsTextContainer">
					<?php if ($auth && $submission) { ?>
					<div class="CH-Head acenter">Thank you for <br/>your submission</div>
					<?php } else { ?>
					<div>
						<div class="CH-SubHead">Your Route to Stardom</div>
						<div class="CH-Text no-margin">
							<ul>
								<li>Set up your own YouTube channel</li>
							<li>Shoot your Entry Video, which should be under 3 minutes</li>
							<li>Upload your Entry Video on to your YouTube channel, with the title in this format: "Comedy Hunt – entry video title"</li>
							<li>Read the terms and conditions on this page</li>
							<li>Click on the check box, press the Submit button, follow the steps after that & and keep checking this channel and our social handles for updates!</li>
							<li>Contestants can participate in the hunt as individuals or as a team</li>
							<li>Entry videos can be in any language. However, subtitles must be added to videos that are in languages other than English or Hindi. Last Date for entries is 26th July 2015</li>
							</ul>
						</div>
					</div>
					<?php } ?>
                </div>
				<div class="CH-SubmitButton">
					<div>
                        <?php if (!$auth){ ?>
						<a href="<?=Yii::app()->baseUrl."/pages/authenticate?media=youtube"; ?>" class="authenticate">Submit your video NOW</a>
                        <?php } else if ($auth && !$submission) { ?>
						<a class="show-popup" data-showpopup="2" href="<?=Yii::app()->baseUrl."/pages/videos?media=youtube"; ?>">Select your video</a>
                        <?php } else { ?>
						<div class="no-margin "><a href="<?=Yii::app()->createUrl('/'); ?>">Submit another video</a></div>
                        <?php } ?>
					</div>
                    <?php if (!$auth){ ?>
					<div class="CH-FormGroupSubmit">
						<div><input type="checkbox" class="termscheckbox" />I agree to the <a href="<?=Yii::app()->createAbsoluteUrl('/site/page/?view=rules'); ?>" target="_blank">terms and conditions</a></div>
						<div class="errorterms">You must agree to the terms and conditions before register.</div>
					</div>
                    <?php } ?>
					<div class="CH-Disclaimer"><span>Disclaimer:</span> This data is collected by OML, and stored at OML's 3rd party servers for contest administration purpose only, and will not be used for any other purpose</div>
					
				</div>
        </div>
    </div>
</div>
<!-- Submissions Ends Here -->

<!-- Contest Entries Starts Here -->
<div class="CH-ContestEntries CH-HomeFaq">
	<div class="CH-ContestEntriesContent">
		<div class="CH-ContestEntriesContentIcon"><img src="images/gallery-image-blue.png"/></div>
		<div class="CH-ContestEntriesContentHead">Contest Entries</div>
		<!-- dynamic playlist start -->
		<?php if ($aVideoList[0]) {
            $objVideo = $aVideoList[0];
		?>
		<div class="CH-FaqList">
			<!-- Needed for the youtube player example 3 -->
			<div class="youtubeplayer">
				<div class="yt_holder yt_holder_right">
					<div id="ytContestEntries" class="ytvideo"></div>
					<!--Up and Down arrow -->
					<div class="you_up"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/up_arrow.png" alt="+ Slide" title="HIDE" /></div>
					<div class="you_down"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/down_arrow.png" alt="- Slide" title="SHOW" /></div>
					<!-- END  -->
					<div class="youplayer ytplayerright">
						<ul class="videoyou videoytright scroll-pane">
							<?php
							if ( $objVideo->get_videos() !=null ) {
								foreach ($objVideo->get_videos() as $yKey => $yValue) {
									echo '<li><p>' . $yValue['title'] . '</p><a class="ContestEntriesThumb" href="http://www.youtube.com/watch?v=' . $yValue['videoid'] . '">' . $yValue['description'] . '</a></li>';
								}
							}else{
								echo '<li>Sorry, no video\'s found</li>';
							}
							?>
						</ul>
					</div>
				</div>
			</div>
			<!-- END youtube player -->
		</div>
		<?php } ?>
		<!-- dynamic playlist ends -->
		
		<div class="CH-HomeEmbedList">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/lIsIOsXkID4?list=PLX19kCCkfm1pR0fml9KXZzur6FVU5BiFO" frameborder="0" allowfullscreen></iframe>
		</div>
	</div>
</div>
<!-- Contest Entries Ends Here -->

<!-- Videos Carousel Starts Here -->
<div class="CH-VideoCarousel">
    <div class="CH-VideoCarouselBG"></div>
    <div class="CH-VideoCarouselContent">
        <div class="CH-VideoCarouselIcon"><img src="images/inspired-videos-icon.png"/></div>
        <div class="CH-VideoCarouselHead">Need a little inspiration?</div>
        <p>Our judges all earned their comedy credentials, one video at a time. Watch the masters at work.</p>

        <div class="CH-VideoCarouselBlk no-padding">
            <!--div id="CH-VideoCarousel">
                <?php if ($gallery){
                    foreach($gallery as $video){ ?>

                <div class="CH-VideoCarouselItem">
                    <div class="CH-Video">
                        <div class="CH-VideoThumb"><img src="<?=$video->thumb_image; ?>"/></div>
                        <div class="CH-VideoThumbPlay">
                            <a href="javascript:void(0)" data-showpopup="1" class="show-popup" data-videoTitle="<?=$video->title; ?>" data-videoURL="<?=$video->media_id; ?>"><img src="images/video-thumb-play.png"/></a>
                        </div>
                    </div>
                    <div class="CH-Description"><?=$video->title; ?></div>
                </div>
                <?php } } ?>
            </div-->

			<!-- dynamic playlist start -->
            <?php if ($aVideoList[1]) {
                $objVideo = $aVideoList[1];
			?>
			<div class="CH-FaqList">
				<!-- Needed for the youtube player example 3 -->
				<div class="youtubeplayer">
					<div class="yt_holder yt_holder_right">
						<div id="ytvideo4"></div>
						<!--Up and Down arrow -->
						<div class="you_up"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/up_arrow.png" alt="+ Slide" title="HIDE" /></div>
						<div class="you_down"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/down_arrow.png" alt="- Slide" title="SHOW" /></div>
						<!-- END  -->
						<div class="youplayer ytplayerright">
							<ul class="videoyou videoytright scroll-pane">
								<?php
								if ( $objVideo->get_videos() !=null ) {
									foreach ($objVideo->get_videos() as $yKey => $yValue) {
										echo '<li><p>' . $yValue['title'] . '</p><a class="videoThumb4" href="http://www.youtube.com/watch?v=' . $yValue['videoid'] . '">' . $yValue['description'] . '</a></li>';
									}
								}else{
									echo '<li>Sorry, no video\'s found</li>';
								}
								?>
							</ul>
						</div>
					</div>
				</div>
				<!-- END youtube player -->
			</div>
			<?php } ?>
			<!-- dynamic playlist ends -->
			
			<div class="CH-HomeEmbedList">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/lIsIOsXkID4?list=PLX19kCCkfm1pR0fml9KXZzur6FVU5BiFO" frameborder="0" allowfullscreen></iframe>
			</div>
			
        </div>
        <div class="CH-WorkshopDate">
            <p>Want some Comedy coaching? The Comedy Hunt judges will be sharing their smarts with the new generation.
                Learn some laugh-logic on these dates.</p>

            <div class="CH-WorkshopCity">
               <div>
					<span>11th July</span>
					<span class="CH-City">Mumbai</span>
					<span class="CH-Register"><a href="https://docs.google.com/forms/d/1xPQyjneHxgteOdHhutO5zo38Hrq8SvdkshjKQF9s4Pw/viewform" target="_blank">Register</a></span>
				</div>
				<div>
					<span>12th July</span>
					<span class="CH-City">Delhi</span>
					<span class="CH-Register"><a href="https://docs.google.com/forms/d/1xPQyjneHxgteOdHhutO5zo38Hrq8SvdkshjKQF9s4Pw/viewform" target="_blank">Register</a></span>
				</div>
				<div>
					<span>13th July</span>
					<span class="CH-City">Hyderabad</span>
					<span class="CH-Register"><a href="https://docs.google.com/forms/d/1xPQyjneHxgteOdHhutO5zo38Hrq8SvdkshjKQF9s4Pw/viewform" target="_blank">Register</a></span>
				</div>
				<div>
					<span>14th July</span>
					<span class="CH-City">Bangalore</span>
					<span class="CH-Register"><a href="https://docs.google.com/forms/d/1xPQyjneHxgteOdHhutO5zo38Hrq8SvdkshjKQF9s4Pw/viewform" target="_blank">Register</a></span>
				</div>
            </div>
        </div>

        <!-- Video Overlay Starts Here
        <div class="CH-VideoOverlay">
            <div class="CH-VideoClose"><img src="images/close-icon-black.png" /></div>
            <div class="CH-VideoTitle"></div>
            <div class="CH-VideoDescription"></div>
        </div>
        <!-- Video Overlay Ends Here -->
    </div>
</div>
<!-- Videos Carousel Ends Here -->
