<script>
    var submitUrl = '<?php echo Yii::app()->createUrl("/pages/register"); ?>';
</script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/validation.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-filestyle.min.js"></script>

<script>
    $(document).ready(function () {

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

    function send() {

        alert("test");
    }
</script>
<div class="container header-body">
    <header>
        <div class="row lilita tagLn">
            <div class="col-md-12 text-center">Be funny, Be mad, Be cool.</br>
                Show your many sides,<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gif.gif"/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 thankYouCntr hide formResponse">
                <div class="row">
                    <div class="col-sm-4"><img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/images/thankCrtn.png"/></div>
                    <div class="col-sm-7 thankTxt lilita">Thank you for your submission!Your entry will be live after
                        moderation.</br></br>
                        <a href="<?=Yii::app()->createAbsoluteUrl('/gallery/'); ?>">Click here</a> to check out how others have fared!
                    </div>
                </div>
            </div>
        </div>
        <div class="row thankYouCntr Sbmtfrm row thankYouCntr Sbmtfrm">
            <div class="col-sm-7">
                <?php
                $form = $this->beginWidget('CActiveForm',
                    array(
                        'id' => 'customForm',
                        'action' => 'javascript:void(0);',
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    ));
                ?>
				
                <div class="row clr1">
                    <div class="col-xs-12 form-group">
                        <?php echo $form->labelEx($model, 'username'); ?>
                        <?php echo $form->textField($model, 'username', array('value' => isset($socialNetworkInfo['name']) ? $socialNetworkInfo['name'] : '', 'id' => 'userName')); ?>
                        <span id='nameInfo'></span>
                    </div>
                    <div class="col-xs-6 form-group">
                        <?php echo $form->labelEx($model, 'email'); ?>
                        <?php echo $form->textField($model, 'email', array('value' => isset($socialNetworkInfo['email']) ? $socialNetworkInfo['email'] : '', 'id' => 'useremail')); ?>
                        <span id='emailInfo'></span>
                    </div>
                    <div class="col-xs-6 form-group">
                        <?php echo $form->labelEx($model, 'mobile'); ?>
                        <?php echo $form->textField($model, 'mobile', array('id' => 'usermobile')); ?>
                        <span id='mobileInfo'></span>
                    </div>
                    <div class="col-xs-6 form-group">
                        <?php echo $form->labelEx($model, 'media_url'); ?>
                        <?php echo $form->fileField($model, 'media_url', array('class' => 'filestyle', 'data-buttonName' => "btn-primary", 'id' => 'uploadmedia')); ?>
                        <span id='uploadmediaInfo'></span>

                    </div>
                    <div class="col-xs-6 form-group">
                        <?php echo $form->labelEx($model, 'media_category'); ?>
                        <?php
                        echo CHtml::dropDownList('ParticipateForm[media_category]', array('Select One' => ''),
                            $model->getAllCategories(), array('empty' => '(Select a Category)', 'class' => 'GlrySlct', 'id' => 'mediacategory'));
                        ?>
                        <span id='categoryInfo'></span>
                    </div>
                    <div class="col-xs-12 form-group">
                        <?php echo $form->labelEx($model, 'media_title'); ?>
                        <?php echo $form->textField($model, 'media_title', array('id' => 'mediatittle')); ?>
                        <span id='tittleInfo'></span>

                    </div>
                    <div class="col-xs-12 form-group">
                        <?php echo $form->labelEx($model, 'message'); ?>
                        <?php echo $form->textArea($model, 'message', array('id' => 'messagebox', 'rows' => "5", 'cols' => "8")); ?>
                        <span id='messageInfo'></span>
                    </div>
                    <div class="col-xs-8 frmTerms">By choosing to participate in the B Natural Dubfest, you acknowledge
                        that you have read & agreed to the
                        <a href="dubfestTerms.html">terms and conditions.</a>
                    </div>
                    <div class="col-xs-3 form-group pull-right text-center UpldBtnCntr">
                        <?php echo CHtml::submitButton('Upload', array('class' => 'lilita glryLoad UpldBtn', 'id' => 'send')); ?>
                        <span class='hide' id='ajax-loader-icon'>
                                <h5> Please wait uploading...</h5>
                            </span>
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
                            <li>Message should include the hashtags</br> #Bnatural and #Dubfest </li>
                            <li>Share with friends using the hashtags</br> #Bnatural and #Dubfest </li>
                            <li>Get your friends to vote!</li>
                            <li>The entry with the highest number of votes wins! </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
