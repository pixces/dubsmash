<!-- FAQs Starts Here -->
<div class="CH-Faq">
    <div class="CH-FaqBG"></div>
    <div class="CH-FaqContent">
        <div class="CH-FaqIcon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gallery-image.png" /></div>
        <div class="CH-FaqHead">FAQ Videos</div>

        <!-- dynamic playlist start -->
        <?php $t = 1; foreach($aVideoList as $objVideo) {
        ?>
        <div class="CH-FaqList">
            <!-- Needed for the youtube player example 3 -->
            <div class="youtubeplayer">
                <div class="yt_holder yt_holder_right">
                    <div id="ytvideo<?php echo $t; ?>" class="ytvideo"></div>
                    <!--Up and Down arrow -->
                    <div class="you_up"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/up_arrow.png" alt="+ Slide" title="HIDE" /></div>
                    <div class="you_down"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/down_arrow.png" alt="- Slide" title="SHOW" /></div>
                    <!-- END  -->
                    <div class="youplayer ytplayerright">
                        <ul class="videoyou videoytright scroll-pane">
                            <?php
                            if ( $objVideo->get_videos() !=null ) {
                                foreach ($objVideo->get_videos() as $yKey => $yValue) {
                                    echo '<li><p>' . $yValue['title'] . '</p><a class="videoThumb'. $t .'" href="http://www.youtube.com/watch?v=' . $yValue['videoid'] . '">' . $yValue['description'] . '</a></li>';
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

		<div class="CH-HomeEmbedList">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/lIsIOsXkID4?list=PLX19kCCkfm1pR0fml9KXZzur6FVU5BiFO" frameborder="0" allowfullscreen></iframe>
		</div>
    </div>
</div>
<!-- FAQs Ends Here -->
	