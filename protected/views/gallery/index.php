<!-- Gallery Starts Here
<div class="CH-Gallery">
    <div class="CH-GalleryBG"></div>
    <div class="CH-GalleryContent">

        <div class="CH-GalleryHead">All videos</div>
        <div class="CH-GalleryList">
            <div class="scroll-pane" id="gallerieVideoContent">
               <?php echo $videoContent;?>
            </div>
        </div>
    </div>
</div>
Gallery Ends Here -->


<!-- Gallery Starts Here -->
<div class="CH-Gallery">
    <div class="CH-GalleryBG"></div>
    <div class="CH-GalleryContent">
        <div class="CH-GalleryIcon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gallery-image.png" /></div>
        <div class="CH-GalleryHead">All videos</div>
        <div class="CH-GalleryList">
		
            <!--div class="scroll-pane">
                <!-- videContent partial include start -->
                <?php //echo $videoContent;?>
                <!-- videContent partial include ends -->
            <!--</div>-->
			
			<!-- dynamic playlist start -->
			<?php $t = 1; foreach($aVideoList as $objVideo) {
			?>
			<div class="CH-FaqList">
				<!-- Needed for the youtube player example 3 -->
				<div class="youtubeplayer">
					<div class="yt_holder yt_holder_right">
						<div id="ytvideogallery<?php echo $t; ?>" class="ytvideo"></div>
						<!--Up and Down arrow -->
						<div class="you_up"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/up_arrow.png" alt="+ Slide" title="HIDE" /></div>
						<div class="you_down"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/down_arrow.png" alt="- Slide" title="SHOW" /></div>
						<!-- END  -->
						<div class="youplayer ytplayerright">
							<ul class="videoyou videoytright scroll-pane">
								<?php
								if ( $objVideo->get_videos() !=null ) {
									foreach ($objVideo->get_videos() as $yKey => $yValue) {
										echo '<li><p>' . $yValue['title'] . '</p><a class="videoThumbgallery'. $t .'" href="http://www.youtube.com/watch?v=' . $yValue['videoid'] . '">' . $yValue['description'] . '</a></li>';
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
			<?php $t++; } ?>
			<!-- dynamic playlist ends -->
        </div>
    </div>
</div>
<!-- Gallery Ends Here -->