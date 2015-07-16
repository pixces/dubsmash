<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css">
    <!--link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-glyphicons.css" -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/component.css"/>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.1.11.3.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/dubfest.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.custom.js"></script>
    <title>B Naturals Dubfest | powered by Sangram Singh</title>
</head>
<body>
<div class="topShrIcn Shricn"></div>
<div class="container bgAnmtn">
    <div class="main">
        <ul id="cbp-bislideshow" class="cbp-bislideshow">
            <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/1.jpg" alt="image01"/></li>
            <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/2.jpg" alt="image02"/></li>
            <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/3.jpg" alt="image03"/></li>
        </ul>
    </div>
    <div style="width:100%; display:none; height:1000px; background:red;"></div>
</div>
<div id="bodyWrapper">
<div class="container header">
    <header>
        <div class="row hdrSctn">
            <div class="col-md-1 lilita pull-right itc"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/itcLogo.png"/></div>
            <div class="col-md-1 lilita pull-right itcNtrlLogo"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/smdvcitcLogo.png"/></div>
            <div class="col-md-4 lilita pull-right">
                <div class="row">
                    <div class="navbar">
                        <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="collapse navbar-collapse navHeaderCollapse">
                            <ul class="nav navbar-nav navbar-right menu">
                                <a href="<?=Yii::app()->createAbsoluteUrl('/'); ?>" class="navbar-link"><div class="col-md-4 navMenu text-center">Home</div></a>
                                <a href="<?=Yii::app()->createAbsoluteUrl('/gallery/'); ?>" class="navbar-link"><div class="col-md-4 navMenu text-center">Gallery</div></a>
                                <a href="<?=Yii::app()->createAbsoluteUrl('/watch-tvc/'); ?>" class="navbar-link"><div class="col-md-4 navMenu2 text-center">Watch TVC</div></a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-md-push-4 logo"><img class="text-center" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png"/></div>
        </div>
    </header>
</div>
<!-- Content : Start //-->
    <?php echo $content; ?>
<!-- Content : End //-->
<div class="row footer">
    <div class="container">
        <div class="col-md-5">
            <div class="cpyrght">Copyright 2015 at ITC B Natural. All Rights Reserved</div>
        </div>
        <div class="col-md-7 pull-right ScndrMenu">
            <ul class="">
                <li><a href="<?=Yii::app()->createAbsoluteUrl('/'); ?>">Contact Us</a></li>
                <li><a href="<?=Yii::app()->createAbsoluteUrl('/site/page?view=privacy-policy'); ?>">Privacy</a></li>
                <li><a href="<?=Yii::app()->createAbsoluteUrl('/site/page?view=terms-conditions'); ?>">terms & conditions</a></li>
                <li><a href="<?=Yii::app()->createAbsoluteUrl('/site/page?view=rules'); ?>">Contest terms & conditions</a></li>
                <li><a href="<?=Yii::app()->createAbsoluteUrl('/'); ?>">ITC Portal</a></li>
            </ul>
        </div>
    </div>
</div>
</div>

<!---universalPoupupStart--->
<div class="UnivrslPoupup hide">
    <div class="">
        <!--VideoPoupupContentStart--->
        <div class="videoSctn hide">
            <div class="univrslPoupClose"><i class="fa fa-times"></i></div>
            <div class="row">
                <div class="col-md-9">
                    <h3 class="lilita clr2">Contact Us</h3>
                </div>
                <div class="col-md-12">
                    <p>Morbi viverra mattis leo vitae faucibus. Sed vel quam pellentesque felis hendrerit mollis. Fusce elementum laoreet efficitur. Pellentesque habitant morbi tristique senectus et netus et malesuada fames #Bnatural #Dubfest.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <img src="images/tst.jpg" style=" padding-bottom: 20px;width: 520px;" />
                </div>
                <div class="col-md-4 clr1">
                    <div class="votNowFrm pull-left">
                        <div class="col-xs-12 form-group">
                            <label>Your Name*</label>
                            <input class="form-control" type="text"/>
                        </div>
                        <div class="col-xs-12 form-group">
                            <label>Your Email*</label>
                            <input class="form-control" type="text"/>
                        </div>
                        <div class="col-xs-12 form-group">
                            <div class="glryBtn glryLoad lilita clr4"><i class="fa fa-heart"></i>Vote Now</div>
                        </div>
                    </div>
                    <div class="ShareSctn pull-left lilita" style="font-size:21px;">Share it On<img src="images/fbicn.png" /></div>
                </div>
            </div>
        </div>
        <!--VideoPoupupContentEnd--->

        <!--ContctFormPoupupContentStart--->
        <div class="cntct hide">
            <div class="univrslPoupClose"><i class="fa fa-times"></i></div>
            <form method="post" id="customForm">
                <h3 class="lilita clr2">Contact Us</h3>
                <label for="name">Name:*</label>
                <input id="name" name="name" type="text">
                <label for="name">Contact No:*</label>
                <input id="mobile" name="mobile" type="text">
                <label for="email">E-mail:*</label>
                <input id="email" name="email" type="text">
                <label for="message">Type your message here...</label>
                <textarea id="message" name="message" cols="8" rows="5"></textarea>
                <input id="send" name="send" type="submit" class="lilita" value="Submit">
            </form>
        </div>
        <!--ContctFormPoupupContentEnd--->
    </div>
</div>
<!---universalPoupupStart--->

<!-- load all custom JS -->
</body>
</html>
