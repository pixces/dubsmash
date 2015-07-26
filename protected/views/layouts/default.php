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
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

            <!---TopvideoSliderrowStart--->
                <div class="item active" style="width:100%;background:#fff;">
                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="PlayIcn2"></div>
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->

                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="certifyIcn"></div>
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->

                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="certifyIcn"></div>
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->

                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->
                </div>
                <!---TopvideoSliderrowEnd--->

                <!---TopvideoSliderrowStart--->
                <div class="item" style="width:100%;background:#fff;  ">
                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="certifyIcn"></div>
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive"
                                                       src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->
                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive"
                                                       src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->
                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive"
                                                       src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->
                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive"
                                                       src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->
                </div>
                <!---TopvideoSliderrowEnd--->

                <!---TopvideoSliderrowStart--->
                <div class="item" style="width:100%;background:#fff;  ">
                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive"
                                                       src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->
                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive"
                                                       src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->
                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive"
                                                       src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->
                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive"
                                                       src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->
                </div>
                <!---TopvideoSliderrowEnd--->

                <!---TopvideoSliderrowStart--->
                <div class="item" style="width:100%; background:#fff; ">
                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive"
                                                       src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->
                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive"
                                                       src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->
                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive"
                                                       src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->
                    <!---TopvideosingleSliderstart--->
                    <div class="col-md-3 glryVdoSctn">
                        <div class="nxtsliders">
                            <div class="PlayIcn1"></div>
                            <div class="vdoethmb"><img class="img-responsive"
                                                       src="<?php echo Yii::app()->request->baseUrl; ?>/images/thumb-1.png"/></div>
                            <div class="row vdoethmbDtls">
                                <div class="col-md-5 glryvdeoTy">Humour</div>
                                <div class="col-md-4 pull-right">
                                    <div class="vdeoFcbk pull-left"></div>
                                    <div class="vdeolike pull-left"></div>
                                    <div class="vdeovwCunt pull-left">60</div>
                                </div>
                            </div>
                            <div class="row vdoethmbTxt">
                                <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                            </div>
                        </div>
                    </div>
                    <!---TopvideosingleSliderEnd--->
                </div>
                <!---TopvideoSliderrowEnd--->
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
