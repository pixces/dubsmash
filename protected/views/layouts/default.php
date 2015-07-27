<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>


<!-- imagesLoaded jQuery plugin by @desandro : https://github.com/desandro/imagesloaded -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.imagesloaded.min.js"></script>

<?php if ($this->pagename != 'register') { ?>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/cbpBGSlideshow.min.js"></script>
    <script>
        $(function () {
            cbpBGSlideshow.init();
        });
    </script>
<?php } ?>

<!-- script src="<?php echo Yii::app()->request->baseUrl; ?>/js/carousel.js"></script -->
<style>
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
        width: 70%;
        margin: auto;
    }
    .left {
        display: none;
    }
</style>

<!-- Start: action views -->
<?php echo $content; ?>
<!-- End: action views -->

<!-- Start Content Video Slider -->
<div class="topVdesdsgn"></div>

<!---TopvideoSliderStart--->
<div class="container-fluid topVdes">
    <div class="container">
        <!---TopvideoSliderHeaderStart--->
        <div class="row topVdesHdr lilita">
            <div class="col-md-3 pull-left"><span class="clr2">Top</span> <span class="clr3">Videos</span></div>
        </div>
        <!---TopvideoSliderHeaderEnd--->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php for($x=0; $x < $this->dCarouselPageCount; $x++) { ?>
                    <li data-target="#myCarousel" data-slide-to="<?php echo $x; ?>" class="<?php echo (($x == 0) ? 'active' : ''); ?>"></li>
                <?php } ?>
                <!--
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li> -->
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

            <?php for($x=0; $x < $this->dCarouselPageCount; $x++) { ?>

            <!---TopvideoSliderrowStart--->
                <div class="item <?php echo (($x == 0) ? 'active' : ''); ?>" style="width:100%;background:#fff;">
                    <?php for($t=0; $t < 4 ; $t++) { ?>
                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <?php if ($this->aCarasouleData[$x+$t]->vote >= 0 ) { ?>
                        <div class="certifyIcn"></div>
                        <?php } ?>
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive" src="<?=$this->aCarasouleData[$x+$t]->alternate_image; ?>" data-media_url="<?=$this->aCarasouleData[$x+$t]->media_url; ?>" data-media_id="<?=$this->aCarasouleData[$x+$t]->media_id; ?>" /></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy"><?=$this->aCarasouleData[$x+$t]->media_category; ?></div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left"><?=$this->aCarasouleData[$x+$t]->vote; ?></div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->
                    <?php } ?>
                </div>
                <!---TopvideoSliderrowEnd--->
            <?php } ?>
            </div>

            <!-- LeftandrightcontrolsStart-->
            <a class="left carousel-control" style="width:25px !important; left:-12px !important" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon crslnxt"><i class="fa fa-angle-left clr2"></i></span>
            </a>
            <a class="right carousel-control cbp-binext" style="width:20px !important; right:-12px !important" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon crslprv"><i class="fa fa-angle-right clr2"></i></span>
            </a>
            <!-- LeftandrightcontrolsEnd-->
        </div>

        <a href="<?= Yii::app()->createAbsoluteUrl('/gallery/'); ?>"><div class="glryBtn lilita">View Gallery</div></a>
        <div class="row lilita mblbtmTxt clr2">
            <div class="col-md-5 pull-left">#Bnatural #Dubfest</div>
            <div class="col-md-2 pull-right btmShrIcn Shricn"></div>
        </div>
    </div>
</div>
<!---TopvideoSliderEnd--->

<?php $this->endContent(); ?>
