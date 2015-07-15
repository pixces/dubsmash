<?php if (!empty($galleries)) { ?>
    <?php echo CHtml::hiddenField('loadCounter', '1',
        array('id' => 'loadCounter')); ?>
    <?php foreach ($galleries as $gallery) { ?>
        <div class="CH-GalleryListItems">
            <div class="CH-GalleryImage"><a href="javascript:void(0)" data-showpopup="1" class="show-popup" data-videoTitle="<?php echo $gallery['title']; ?>" data-videoURL="<?php echo $gallery['media_id']; ?>"><img src="<?php echo $gallery['thumb_image'] ?>" /></a></div>
            <div class="CH-GalleryVideoTitle"><?php echo $gallery['title']; ?></div>
            <div class="CH-GalleryName"><?php echo $gallery['username']; ?></div>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="CH-GalleryListItems">
        <span>Empty Gallery.</span>
    </div>
<?php } ?>




