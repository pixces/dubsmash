<div class="container header-body">
    <header>
        <div class="row lilita tagLn">
            <div class="col-md-12 text-center">Be funny. Be mad. Be cool.</br>Show us your many sides,<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gif.gif" />
            </div>
        </div>
        <div class="row PrtcptNwMoble text-center lilita">
            <div class="topVdesHdr clr1">Submissions open</div>
            <div class="glryLoad UpldBtn  pointer"><p>Participate Now</p></div>
        </div>
        <div class="row">
            <div class="col-xs-3 prtcptSctnCntr lilita">
                <div class="prtcptSctn">

                    <div class="participateprceCntr">
                        <div class="prtcptSctnCont">
                           <span class="fntSctn1"><img class="iPhnImage" src="<?php echo Yii::app()->request->baseUrl; ?>/images/prtcptMbl.png" />Be a part of the #BNatural Dubfest and <span class="fntSctn2">win an iPhone 6!</span><br></br><p style="font-size: 15px;
    font-weight: 400 !important; margin-top:15px; 
    color: rgb(78, 56, 98);">100 BNatural Gift Hampers to be won too!</p></span>
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
                <div class="text-center clr1 bntrl">#BNatural #Dubfest</div>
            </div>
			<div class="col-xs-5 videoThb">
			<div class="sangramSingVideo"><img class="img-responsive" id="sangramSingVideo" src="<?php echo Yii::app()->request->baseUrl; ?>/images/masterShehnsah.png"/></div>
			<!--<div class="row VdoeThumSngram">
			<div class="col-sm-3  MinvdoThmb sangramSingVideo" id="sangramSingVideo1"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/smallRadhe.png" class="img-responsive" /></div>
			<div class="col-sm-3 MinvdoThmb sangramSingVideo" id="sangramSingVideo2"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/smallRajni.png" class="img-responsive" /></div>
			<div class="col-sm-3 MinvdoThmb sangramSingVideo" id="sangramSingVideo3"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/smallShehnsah.png" class="img-responsive" /></div>
			<div class="col-sm-3 MinvdoThmb sangramSingVideo" id="sangramSingVideo4"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/smallRadhe.png" class="img-responsive" /></div>
	
			</div>-->
			
			<div class="row VdoeThumSngram">
					<div class="frame">
					  <div class="MinvdoThmb sangramSingVideo" id="sangramSingVideo1"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/smallShehnsah.png" class="img-responsive thumbnail_img " /></div>
					</div>
					<div class="frame">
					 <div class="MinvdoThmb sangramSingVideo" id="sangramSingVideo2"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/smallRajni.png" class="img-responsive thumbnail_img " /></div>
					</div>
					<div class="frame">
					<div class="MinvdoThmb sangramSingVideo" id="sangramSingVideo3"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/smallRadhe.png" class="img-responsive thumbnail_img " /></div>
					</div>
					<div class="frame">
					<div class="MinvdoThmb sangramSingVideo" id="sangramSingVideo4"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/smallShehnsah.png" class="img-responsive thumbnail_img " /></div>
					</div>
					
			</div>
			
			
			
			</div>
			
			
            <div class="col-xs-4 Mndit">
                <!--<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mnditImg.png" />-->
            </div>
    </header>
</div>
<!--<div class="row wtchTVCMobile">
    <div class="topVdesHdr clr1 lilita"><img class="iPhnImage" src="<?php echo Yii::app()->request->baseUrl; ?>/images/wtchTvcIcn.png"/>Watch Now</div>
</div>-->
