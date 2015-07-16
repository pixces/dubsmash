<html>
<head>
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/bootstrap.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<script src="js/jquery.min.1.11.3.js"></script>
	<script src="Js/bootstrap.min.js"></script>
	<script src="Js/carousel.js"></script>
	<script type="text/javascript" src="js/validation.js"></script>
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>
		<script>
	$( document ).ready(function() {
	// Iterate over each select element
$('select').each(function () {
    // Cache the number of options
    var $this = $(this),
        numberOfOptions = $(this).children('option').length;

    // Hides the select element
    $this.addClass('s-hidden');

    // Wrap the select element in a div
    $this.wrap('<div class="select"></div>');

    // Insert a styled div to sit over the top of the hidden select element
    $this.after('<div class="styledSelect"></div>');

    // Cache the styled div
    var $styledSelect = $this.next('div.styledSelect');

    // Show the first select option in the styled div
    $styledSelect.text($this.children('option').eq(0).text());

    // Insert an unordered list after the styled div and also cache the list
    var $list = $('<ul />', {
        'class': 'options'
    }).insertAfter($styledSelect);

    // Insert a list item into the unordered list for each select option
    for (var i = 0; i < numberOfOptions; i++) {
        $('<li />', {
            text: $this.children('option').eq(i).text(),
            rel: $this.children('option').eq(i).val()
        }).appendTo($list);
    }

    // Cache the list items
    var $listItems = $list.children('li');

    // Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)
    $styledSelect.click(function (e) {
        e.stopPropagation();
        $('div.styledSelect.active').each(function () {
            $(this).removeClass('active').next('ul.options').hide();
        });
        $(this).toggleClass('active').next('ul.options').toggle();
    });

    // Hides the unordered list when a list item is clicked and updates the styled div to show the selected list item
    // Updates the select element to have the value of the equivalent option
    $listItems.click(function (e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass('active');
        $this.val($(this).attr('rel'));
        $list.hide();
        /* alert($this.val()); Uncomment this for demonstration! */
    });

    // Hides the unordered list when clicking outside of it
    $(document).click(function () {
        $styledSelect.removeClass('active');
        $list.hide();
    });
});
$(":file").filestyle({buttonName: "btn-primary"});
	});
	</script>
<title></title>
</head>
<body>
<div class="topShrIcn Shricn"></div>
<div id="bodyWrapper">
<div class="container">
<header>


</div>
<div class="col-md-1 lilita pull-right itcNtrlLogo">
<img src="images/smdvcitcLogo.png" />
</div>

</div>

<div class="row lilita tagLn">
<div class="col-md-12 text-center">Be funny, Be mad, Be cool.</br>
Show your many sides,<img src="images/gif.gif" />
</div>
</div>

<div class="row thankYouCntr Sbmtfrm row thankYouCntr Sbmtfrm">
<div class="col-sm-7">
<?php
    $form = $this->beginWidget('CActiveForm',
        array(
        'id' => 'customForm',
        'enableAjaxValidation' => false,
        'method' => 'Post',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

		<div class="row clr1">
			<div class="col-xs-12 form-group">

                            <?php echo $form->labelEx($model,'username'); ?>
                            <?php echo $form->textField($model,'username'); ?>
                            <?php echo $form->error($model, 'username'); ?>

			</div>
			<div class="col-xs-6 form-group">
                            <?php echo $form->labelEx($model, 'email'); ?>
                            <?php echo $form->textField($model, 'email'); ?>
                            <?php echo $form->error($model, 'email'); ?>
			</div>
			<div class="col-xs-6 form-group">
                            <?php echo $form->labelEx($model, 'mobile'); ?>
                            <?php echo $form->textField($model, 'mobile'); ?>
                            <?php echo $form->error($model, 'mobile'); ?>
			</div>
			<div class="col-xs-6 form-group">
                            <?php echo $form->labelEx($model, 'media_url'); ?>
                            <?php echo $form->fileField($model, 'media_url',array('class'=>'filestyle','data-buttonName'=>"btn-primary")); ?>
                            <?php echo $form->error($model, 'media_url'); ?>

			</div>
			<div class="col-xs-6 form-group">
                            <?php echo $form->labelEx($model, 'media_category'); ?>
                            <?php
                            echo CHtml::dropDownList('ParticipateForm[media_category]', array('All'=>'All'),
                            $model->getAllCategories(), array('class'=>'GlrySlct','id'=>'selectbox1'));
                            ?>
                            <?php echo $form->error($model, 'media_category'); ?>
			</div>
			<div class="col-xs-12 form-group">
                            <?php echo $form->labelEx($model, 'media_title'); ?>
                            <?php echo $form->textField($model, 'media_title'); ?>
                            <?php echo $form->error($model, 'media_title'); ?>
			</div>
			<div class="col-xs-12 form-group">
                            <?php echo $form->labelEx($model, 'message'); ?>
                            <?php echo $form->textArea($model, 'message',array('id'=>'message','rows'=>"5",'cols'=>"8")); ?>
                            <?php echo $form->error($model, 'message'); ?>

			</div>
			<div class="col-xs-8 frmTerms">By choosing to participate in the B Natural Dubfest, you acknowledge that you have read & agreed to the
			<a href="dubfestTerms.html">terms and conditions.</a>
			</div>
			<div class="col-xs-3 form-group pull-right text-center UpldBtnCntr">
                                 <?php echo CHtml::submitButton('Upload',array('class'=>'lilita glryLoad UpldBtn','id'=>'send')); ?>
			</div>
		</div>
	 <?php $this->endWidget(); ?>


</div>
<div class="col-sm-5 pull-right prtcptSctnfrstCntr">
<div class="prtcptSctnCntr">
<div class="frmistrctnBg">
<h3 class="lilita clr2 topVdesHdr ">Instructions</h3>
<ul>
<li>Go to the Dubsmash app on your phone</li>
<li>Record your video & save it to your gallery</li>
<li>Fill in your details on this page and upload your video along with your message</li>
<li>Message should include the hashtags</br>
#Bnatural and #Dubfest</li>
<li>Share with friends using the hashtags</br>
#Bnatural and #Dubfest</li>
<li>Get your friends to vote! </li>
<li>The entry with the highest number
of votes wins!</li>

</div>
</div>


</div>
</div>
</header>
</div>




<div class="topVdesdsgn"></div>
<!---TopvideoSliderStart--->
<div class="container-fluid topVdes">
<div class="container">
<!---TopvideoSliderHeaderStart--->
<div class="row topVdesHdr lilita">
<div class="col-md-3 pull-left"><span class="clr2">Top</span> <span class="clr3">Videos</span></div>
<div class="col-md-3 text-right pull-right topVdescnt">showing 4/12</div>
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
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
		<!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
		<!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
		<!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
      </div>
	<!---TopvideoSliderrowEnd--->

	<!---TopvideoSliderrowStart--->
      <div class="item"  style="width:100%;background:#fff;  ">
		<!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
		<!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
		<!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
		<!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
      </div>
    <!---TopvideoSliderrowEnd--->

	<!---TopvideoSliderrowStart--->
      <div class="item"  style="width:100%;background:#fff;  ">
       <!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
		<!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
<!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
		<!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
	</div>
	<!---TopvideoSliderrowEnd--->

	<!---TopvideoSliderrowStart--->
      <div class="item"  style="width:100%; background:#fff; ">
		<!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
		<!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
		<!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
		<!---TopvideosingleSliderstart--->
		<div class="col-md-3 glryVdoSctn">
		<div class="nxtsliders">
		<div class="PlayIcn1"></div>
		<div class="vdoethmb"><img class="img-responsive" src="images/thumb-1.png" /></div>
		<div class="row vdoethmbDtls">
		<div class="col-md-5 glryvdeoTy">Humour</div>
		<div class="col-md-4 pull-right">
		<div class="vdeoFcbk pull-left"></div>
		<div class="vdeolike pull-left"></div>
		<div class="vdeovwCunt pull-left">60</div>
		</div></div>
		<div class="row vdoethmbTxt"><div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
		</div>
		</div>
		<!---TopvideosingleSliderEnd--->
	</div>
  <!---TopvideoSliderrowEnd--->

    </div>

    <!-- LeftandrightcontrolsStart-->
    <a class="left carousel-control" style="" href="#myCarousel" role="button" data-slide="prev">
     <span class="glyphicon crslnxt"><i class="fa fa-angle-left clr2"></i></span>
    </a>
    <a class="right carousel-control cbp-binext" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon crslprv" ><i class="fa fa-angle-right clr2"></i></span>
    </a>
  <!-- LeftandrightcontrolsEnd-->
  </div>
  <a href="dubfestGallery.html"><div class="glryBtn lilita">View Gallery</div></a>

  <div class="row lilita mblbtmTxt clr2">
  <div class="col-md-5 pull-left">#Bnatural #Dubfest</div>
  <div class="col-md-2 pull-right btmShrIcn Shricn"></div>
  </div>

</div>
</div>
<!---TopvideoSliderEnd--->



<div class="row footer">
<div class="container">
<div class="col-md-5"><div class="cpyrght">Copyright 2015 at ITC B Natural. All Rights Reserved</div></div>

<div class="col-md-7 pull-right ScndrMenu">
<ul class="">
<li id="contact"><a href="">Contact Us</a></li>
<li><a href="#">Privacy</a></li>
<li><a href="dubfestTerms.html">terms & conditions</a></li>
<li><a href="#">Contest terms & conditions</a></li>
<li><a href="#">ITC Portal</a></li>
</ul>
</div>
</div>
</div>
</div>
</body>
</html>