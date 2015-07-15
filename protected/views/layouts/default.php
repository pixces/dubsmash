<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

    <!-- Mobile Logo Starts Here -->
    <div class="CH-MobileDisplay">
        <div class="CH-MobileLogo"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mobile-logo.png" class="img-responsive" /></div>
        <div class="CH-MobileText">
            <span class="CH-Head">You can be the next Comedy Super Star</span>
            <span class="CH-SubHead">Submit your entry video below</span>
        </div>

    </div>
    <!-- Mobile Logo Ends Here -->

    <!-- Content Starts !-->
    <?php echo $content; ?>
    <!-- Content Ends !-->

    <!-- TimeLine Starts Here -->
    <div class="CH-TimeLine">
        <div class="CH-TimeLineBG"></div>
        <div class="CH-CompetitionTimeline">
            <div class="CH-TimelineContent">
                <span class="CH-Head">Your Comedy <br/>Calendar</span>
                <span class="CH-Description">This fight for the funniest is split into three phases.</span>
            </div>
            <div class="CH-TimelineRules">
                <div class="CH-TimelineRulesImage"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/competition-timeline.png" class="img-responsive" /></div>
                <div class="CH-Phase1">
                    <span class="CH-Title">Audition Phase</span>
                    <span class="CH-Description">We’re accepting and reviewing all submissions before the <strong>26th of July</strong></b></span>
                </div>
                <div class="CH-Phase2">
                    <span class="CH-Title">Challenge Phase</span>
                    <span class="CH-Description">Once our mentor judges pick the top contestants from the submissions, challenges are set every week for them, and videos will be uploaded every week by them.</span>
                </div>
                <div class="CH-Phase3">
                    <span class="CH-Title">Finale</span>
                    <span class="CH-Description">After the challenges are complete, the top 5 contestants will get a chance to be on stage with the mentors & 1 will emerge as the winner. Stay tuned for more info on how the finale is shaping up.</span>
                </div>
            </div>
        </div>
    </div>
    <!-- TimeLine Ends Here -->

<?php $this->endContent(); ?>