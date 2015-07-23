<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$title = $this->pageTitle=Yii::app()->name . ' - Login';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <base href="">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/print.css" media="print" />
    <!--[if lt IE 8]
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/ie.css" media="screen, projection" />
    [endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/admin.css" />
    <title><?php echo $title; ?></title>
</head>
<body id="login-bg">
<!-- Start: login-holder -->
<div id="login-holder">
    <!-- start logo -->
    <div id="logo-login">
    </div>
    <!-- end logo -->
    <div class="clear"></div>
    <!--  start loginbox ................................................................................. -->
    <div id="loginbox">
        <!--  start login-inner -->
        <div id="login-inner">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                'enableClientValidation'=>true,
                'action'=>Yii::app()->createUrl('login'),
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <th><?php echo $form->labelEx($model,'username'); ?></th>
                    <td>
                        <?php echo $form->textField($model,'username'); ?>
                        <?php echo $form->error($model,'username'); ?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo $form->labelEx($model,'password'); ?></th>
                    <td>
                        <?php echo $form->passwordField($model,'password'); ?>
                        <?php echo $form->error($model,'password'); ?>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td><?php echo CHtml::submitButton('Login'); ?></td>
                </tr>
            </table>
            <?php $this->endWidget(); ?>
        </div>
        <!--  end login-inner -->
        <div class="clear"></div>
        <!--a href="" class="forgot-pwd">Forgot Password?</a -->
    </div>
    <!--  end loginbox -->
</div>
<!-- End: login-holder -->

<!-- include all js files -->
<script src="jquery.1.10.2.min.js" type="text/javascript" ></script>
<script src="functions.js" type="text/javascript"></script>
<script src="site-actions.js" type="text/javascript"></script>
<script src="bootstrap.js" type="text/javascript"></script>
<script src="html5shiv.js" type="text/javascript"></script>
<script src="pngfix.js" type="text/javascript"></script>
</body>
</html>