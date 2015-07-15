<?php
/* @var $this GalleryController */
/* @var $model Content */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'media_id'); ?>
		<?php echo $form->textField($model,'media_id',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'media_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'media_url'); ?>
		<?php echo $form->textField($model,'media_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'media_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textArea($model,'type',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'channel_name'); ?>
		<?php echo $form->textField($model,'channel_name',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'channel_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_ugc'); ?>
		<?php echo $form->textField($model,'is_ugc'); ?>
		<?php echo $form->error($model,'is_ugc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'thumb_image'); ?>
		<?php echo $form->textField($model,'thumb_image',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'thumb_image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alternate_image'); ?>
		<?php echo $form->textField($model,'alternate_image',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'alternate_image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created'); ?>
		<?php echo $form->error($model,'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_modified'); ?>
		<?php echo $form->textField($model,'date_modified'); ?>
		<?php echo $form->error($model,'date_modified'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->