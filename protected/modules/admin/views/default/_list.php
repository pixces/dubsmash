<?php
    //set default image
    $displayImage = isset($data->media_image) ? $data->media_image : Yii::app()->baseUrl."/images/video.png";
    //set the media URL
?>
<div class="row" id="user-<?=$data->id; ?>">
    <div class="media-head image-thumb">
        <a target="_blank" href="<?=$data->media_alternate_url;?>" class="img-modal thumbnail-img" data-channelId="" data-channelName="<?=$data->channel_name;?>" data-title="" >
            <img src="<?=$displayImage;?>">
        </a>
    </div>
    <div class="media-body">
        <blockquote class="list-body">
            <h4 class="title"><a href="<?=$data->media_url;?>" target="_blank"><?=$data->media_title;?></a></h4>
            <p><?php echo strlen($data->message) <= 125 ? $data->message : substr($data->message, 0, 125)." [...]"; ?></p>
            <p>
                <span class="meta"><?=strtoupper($data->media_category);?></span>
                <span class="meta">Type: Video</span>
                <span class="meta">Likes: <?=$data->vote; ?></span>
            </p>
        </blockquote>
    </div>
    <div class="media-action">
        <span>
            <span class="posted-by"><?=$data->username; ?> (#<?=$data->email; ?>)</span>
            <span class="posted-on"><?=date('D, d F, Y', strtotime($data->date_modified)); ?></span>
        </span>

        <span class="btn-bar">
        <?php if ($data->status != 'pending'){ ?>
            <div id="<?=$data->id; ?>" class="pill pill-<?=$data->status; ?>"  data-value="<?=$data->status; ?>" data-id="<?=$data->id; ?>"><?=ucfirst($data->status); ?></div>
        <?php } else { ?>
            <?php if ($data->status=="pending") { ?>
                <div id="btn-bar-<?=$data->id; ?>" class="action-btn button-bar">
                    <a id="<?=$data->id; ?>" class="admin-action btn"  data-value="1" data-id="<?=$data->id; ?>" data-action="approve" href="#">Approve</a>
                    <a id="<?=$data->id; ?>" class="admin-action btn red"  data-value="0" data-id="<?=$data->id; ?>" data-action="reject" href="#">Reject</a>
                </div>
            <?php } ?>
        <?php } ?>
        </span>
    </div>
</div>