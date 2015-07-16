<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$title           = $this->pageTitle = Yii::app()->name.' - Login';
?>



<?php echo CHtml::link('Facebook',
    array('/login/socialLogin', 'socialNetwork' => 'facebook')); ?>
&nbsp;|&nbsp;
<?php echo CHtml::link('Google',
    array('/login/socialLogin', 'socialNetwork' => 'google')); ?>
&nbsp;|&nbsp;
<?php echo CHtml::link('Guest',
    array('/login/socialLogin', 'socialNetwork' => 'guest')); ?>