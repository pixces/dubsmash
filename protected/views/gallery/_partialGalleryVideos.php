<?php if (!empty($galleries)) { ?>
    <?php echo CHtml::hiddenField('loadCounter', '1',
        array('id' => 'loadCounter'));
    ?>
    <?php foreach ($galleries as $gallery) { ?>
        <div class="col-md-3 glryVdoSctn">
            <?php if ($gallery['vote'] > 10){ ?><div class="certifyIcn"></div><?php } ?>
            <div class="nxtsliders">
                <div class="PlayIcn2"></div>

                <div class="vdoethmb"><img class="img-responsive" src="/uploads<?php echo $gallery['share_url']; ?>"/></div>
                <div class="row vdoethmbDtls">
                    <div class="col-md-5 glryvdeoTy"><?php echo $gallery['media_category']; ?></div>
                    <div class="col-md-4 pull-right">
                        <div class="glryvdeoFcbk pull-left"></div>
                        <div class="glryvdeolike pull-left"></div>
                        <div class="vdeovwCunt pull-left"><?php echo $gallery['vote'];?></div>
                    </div>
                </div>
                <div class="row vdoethmbTxt">
                    <div class="col-md-12"><?php echo $gallery['media_title']; ?></div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="CH-GalleryListItems">
        <span>Empty Gallery.</span>
    </div>
<?php } ?>


