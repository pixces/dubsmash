<?php
/* @var $this PagesController */
/* @var $model ParticipateForm */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm',
        array(
        'id' => 'content-participate-form',
        'enableAjaxValidation' => false,
        'method'=>'Post',
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username'); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>



    <div class="row">
        <?php echo $form->labelEx($model, 'media_url'); ?>
        <?php echo $form->fileField($model, 'media_url'); ?>
        <?php echo $form->error($model, 'media_url'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'media_title'); ?>
        <?php echo $form->textField($model, 'media_title'); ?>
        <?php echo $form->error($model, 'media_title'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'mobile'); ?>
        <?php echo $form->textField($model, 'mobile'); ?>
        <?php echo $form->error($model, 'mobile'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'media_category'); ?>
        <?php
        echo CHtml::dropDownList('ParticipateForm[media_category]', array(),
            $model->getAllCategories(), array('empty' => 'Select Category'));
        ?>
        <?php echo $form->error($model, 'media_category'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'message'); ?>
        <?php echo $form->textField($model, 'message'); ?>
        <?php echo $form->error($model, 'message'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->


<style type="text/css">
    .errorMessage{
        color:red;
    }

</style>