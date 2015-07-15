<?php
/* @var $this ContentController */
/* @var $model Content */

$this->breadcrumbs=array(
	'Contents'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Content', 'url'=>array('index')),
	array('label'=>'Create Content', 'url'=>array('create')),
	array('label'=>'Update Content', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Content', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Content', 'url'=>array('admin')),
);
?>

<h1>View Content #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'email',
		'title',
		'description',
		'channel_id',
		'media_id',
		'media_url',
		'type',
		'author',
		'channel_name',
		'is_ugc',
		'thumb_image',
		'alternate_image',
		'status',
		'google_id',
		'google_displayname',
		'google_profile_url',
		'google_profilepicture',
		'date_created',
		'date_modified',
	),
)); ?>
