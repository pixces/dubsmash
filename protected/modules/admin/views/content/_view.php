<?php
/* @var $this ContentController */
/* @var $data Content */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('channel_id')); ?>:</b>
	<?php echo CHtml::encode($data->channel_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('media_id')); ?>:</b>
	<?php echo CHtml::encode($data->media_id); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('media_url')); ?>:</b>
	<?php echo CHtml::encode($data->media_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author')); ?>:</b>
	<?php echo CHtml::encode($data->author); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('channel_name')); ?>:</b>
	<?php echo CHtml::encode($data->channel_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_ugc')); ?>:</b>
	<?php echo CHtml::encode($data->is_ugc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thumb_image')); ?>:</b>
	<?php echo CHtml::encode($data->thumb_image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alternate_image')); ?>:</b>
	<?php echo CHtml::encode($data->alternate_image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('google_id')); ?>:</b>
	<?php echo CHtml::encode($data->google_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('google_displayname')); ?>:</b>
	<?php echo CHtml::encode($data->google_displayname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('google_profile_url')); ?>:</b>
	<?php echo CHtml::encode($data->google_profile_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('google_profilepicture')); ?>:</b>
	<?php echo CHtml::encode($data->google_profilepicture); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
	<?php echo CHtml::encode($data->date_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_modified')); ?>:</b>
	<?php echo CHtml::encode($data->date_modified); ?>
	<br />

</div>