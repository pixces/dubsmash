<div class="row" id="user-<?=$data->id; ?>">
    <div class="media-head image-thumb">
        <a target="_blank" href="<?=$data->media_url;?>" class="img-modal thumbnail-img" data-channelId="<?=$data->channel_id;?>" data-channelName="<?=$data->channel_name;?>" data-title="" >
            <img src="<?=$data->thumb_image;?>">
        </a>
    </div>
    <div class="media-body">
        <blockquote class="list-body">
            <h4><span class="title"><a href="<?=$data->media_url;?>" target="_blank"><?=$data->title;?></a></span></h4>
            <p><?php echo substr($data->description, 0, 150)." [...]"; ?></p>
            <p class="posted-by">uploaded by: <em><a href="<?=$data->google_profile_url; ?>" target="_blank"><?=$data->username; ?></a> (#<?=$data->google_id; ?>)</em> | <em></en><i class="icon-calendar"></i> <?=date('F d, Y', strtotime($data->date_modified)); ?></em></p>
        </blockquote>
    </div>
    <div class="media-action">
        <span class="status-btn" id="btn-set-<?=$data->id; ?>">
            <span id="<?=$data->id; ?>" class="pill pill-<?=$data->status; ?>"  data-value="<?=$data->status; ?>" data-id="<?=$data->id; ?>"><?=ucfirst($data->status); ?></span>
        </span>
        <span id="btn-bar-<?=$data->id; ?>" class="action-btn button-bar">
            <?php if ($data->status=="pending") { ?>
                <a id="<?=$data->id; ?>" class="admin-action btn"  data-value="1" data-id="<?=$data->id; ?>" data-action="approve" href="#">Approve</a>
                <a id="<?=$data->id; ?>" class="admin-action btn red"  data-value="0" data-id="<?=$data->id; ?>" data-action="reject" href="#">Reject</a>
            <?php } ?>
        </span>
    </div>
</div>