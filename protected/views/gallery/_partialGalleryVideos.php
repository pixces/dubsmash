<?php if (!empty($galleries)) { ?>
    <?php echo CHtml::hiddenField('galleryCnt', '1', array('id' => 'galleryCnt')); ?>
    <?php foreach ($galleries as $gallery) {
        $dispImage = (isset($gallery['alternate_image']) && $gallery['alternate_image'] != 'null' && $gallery['alternate_image'] != '') ? $gallery['alternate_image'] : 'https://i1.ytimg.com/vi/xi3UlWG3RK0/hqdefault.jpg';
    ?>
        <div class="col-md-3 glryVdoSctn" id="media-<?php echo $gallery['id'];?>" data-media-id="<?php echo $gallery['id'];?>" data-media-vote-count='<?php echo $gallery['vote'];?>'>
            <?php if ($gallery['vote'] > 10) { ?><div class="certifyIcn"></div><?php } ?>
            <div class="nxtsliders">
                <div class="PlayIcn2"></div>

                <div class="vdoethmb"><img class="img-responsive" data-media-url="<?php echo $gallery['media_url'];?>" src="<?php echo $dispImage; ?>" /></div>
                <div class="row vdoethmbDtls">
                    <div class="col-md-5 glryvdeoTy"><?php echo ucfirst($gallery['media_category']); ?></div>
                    <div class="col-md-4 pull-right">
                        <div class="glryvdeoFcbk pull-left"></div>
                        <div class="glryvdeolike pull-left"></div>
                        <div class="vdeovwCunt pull-left"><?php echo $gallery['vote']; ?></div>
                    </div>
                </div>
                <div class="row vdoethmbTxt">
                    <div class="col-md-12"><?php echo strlen($gallery['media_title']) > 60 ? substr($gallery['media_title'], 0, 60)." [..]" : $gallery['media_title']; ?></div>
                </div>
            </div>
        </div>
    <?php } ?>
   
<?php } ?>


