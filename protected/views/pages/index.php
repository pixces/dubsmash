<div class="container header-body">
    <header>
        <div class="row lilita tagLn">
            <div class="col-md-12 text-center">Be funny, Be mad, Be cool.</br>Show your many sides,<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gif.gif" />
            </div>
        </div>
        <div class="row PrtcptNwMoble text-center lilita">
            <div class="topVdesHdr clr1">Submissions open</div>
            <div class="glryLoad UpldBtn  pointer">Participate Now</div>
        </div>
        <div class="row">
            <div class="col-xs-3 prtcptSctnCntr lilita">
                <div class="prtcptSctn">

                    <div class="participateprceCntr">
                        <div class="prtcptSctnCont">
                            <span class="fntSctn1"><img class="iPhnImage" src="images/prtcptMbl.png"/>Come be a part of the country's biggest dubfest and get a chance to <span class="fntSctn2">win an iPhone 6!</span></span>
                        </div>
                        <div class="hmprcptBtn prcptBtn">Participate Now</div>
                    </div>

                    <div class="participatelgnCntr hide">
                        <div class="bntrl">Sign In <i class="fa fa-times pull-right pointer participatelgncls"></i>
                        </div>
                        <div class="sgnsclmdeaicncntr">
                            <div>
                                <?php echo CHtml::link('',array('/auth/SocialAuthentication', 'socialNetwork' => 'google'),array('class'=>'sgnsclmdea sgnsclmdeagpls pointer')); ?>
                            </div>
                            <div class="">
                               <?php echo CHtml::link('',array('/auth/SocialAuthentication', 'socialNetwork' => 'facebook'),array('class'=>'sgnsclmdea sgnsclmdeafb pointer')); ?>
                            </div>
                        </div>
                        <div class="sgnscldvdr">OR</div>
                        <div class="glryBtn"><?php echo CHtml::link('As Guest',array('/auth/SocialAuthentication', 'socialNetwork' => 'guest')); ?></div>
                    </div>


                </div>
                <div class="text-center clr1 bntrl">#Bnatural #Dubfest</div>
            </div>
            <div class="col-xs-5 videoThb">
                <div><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/vdoImg2.png"/></div>
                <div class="row VdoeThumSngram">
                    <div class="col-sm-3 MinvdoThmb">
                        <div class="PlayIcn3"></div>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/thmb1a.png"/></div>
                    <div class="col-sm-3 MinvdoThmb">
                        <div class="PlayIcn3"></div>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/thmb2a.png"/></div>
                    <div class="col-sm-3 MinvdoThmb">
                        <div class="PlayIcn3"></div>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/thmb3a.png"/></div>
                    <div class="col-sm-3 MinvdoThmb">
                        <div class="PlayIcn3"></div>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/thmb4a.png"/></div>

                </div>
            </div>
            <div class="col-xs-4 Mndit">
                <!--<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mnditImg.png" />-->
            </div>
    </header>
</div>
<div class="row wtchTVCMobile">
    <div class="topVdesHdr clr1 lilita"><img class="iPhnImage" src="<?php echo Yii::app()->request->baseUrl; ?>/images/wtchTvcIcn.png"/>Watch Now</div>
</div>