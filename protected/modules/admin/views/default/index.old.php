<?php if(Yii::app()->user->hasFlash('message')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('message'); ?>
    </div>
<?php endif; ?>
<h3>Video Listing</h3>
<?php
$this->widget('zii.widgets.grid.CGridView',
    array(
    'id' => 'banner-grid',
    'rowCssClassExpression' => '( $row%2 ? $this->rowCssClass[1] : $this->rowCssClass[0] )." content[]_{$data->id}"',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'name' => 'Thumbnail',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::image($data->thumb_image,"",array("style"=>"width:90;margin-left:48px;border: 1px solid #ccc;")),$data->media_url)',
        ),
        array(
            'name' => 'Media Id',
            'type' => 'text',
            'value' => '$data->media_id',
        ),
        
        array(
            'name' => 'Username',
            'type' => 'text',
            'value' => '$data->username'
        ),
        array(
            'name' => 'Email',
            'type' => 'text',
            'value' => '$data->email',
        ),
        array(
            'name' => 'Title',
            'type' => 'text',
            'value' => '$data->title',
        ),
        array(
            'name' => 'Media Url',
            'type' => 'raw',
            'value' => 'CHtml::link($data->media_url)',
        ),
        array(
            'name' => 'Author',
            'type' => 'text',
            'value' => '$data->author',
        ),
        array(
            'name' => 'Status',
            'type' => 'text',
            'value' => 'ucwords($data->status)',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{delete}{approve}{disable}',
            'buttons' => array(
                'approve' => array(
                    'label' => 'Approve',
                    'url'=>'Yii::app()->createUrl("admin/default/toggleVideoStatus",array("id"=>$data->primaryKey,"status"=>1))',
                   // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                    'visible' => '$data->status=="pending"',
                ),
                'disable' => array(
                    'label' => 'Disable',
                    'url'=>'Yii::app()->createUrl("admin/default/toggleVideoStatus",array("id"=>$data->primaryKey,"status"=>0))',
                   // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                    'visible' => '$data->status!="pending"',
                ),
            ),
        ),
    ),
));
