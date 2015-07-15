<div class="CH-YouTubeList">
	<div class="scroll-pane">
        <?php if ($videoList) { ?>
            <?php foreach($videoList as $media) { ?>
		<div class="CH-YouTubeListItems" data-YouTubeVideoID="<?=$media['videoId']; ?>" data-YouTubeVideoThumbURL="<?=$media['thumb_image']; ?>" data-YouTubeVideoBigURL="<?=$media['alternate_image']; ?>" data-YouTubeVideoTitle="<?=$media['title']; ?>" data-YouTubeVideoDescription="<?=$media['description']; ?>" data-YouTubeVideoChannelId="<?=$media['channelId']; ?>" data-YouTubeVideoChannelTitle="<?=$media['channelTitle']; ?>">
			<div class="CH-YouTubeThumbImage"><img src="<?=$media['thumb_image']; ?>" /></div>
			<div class="CH-YouTubeThumbTitle"><?=$media['title']; ?></div>
		</div>
        <?php } } ?>
	</div>
</div>
<?php
if ($user_info){
    foreach($user_info as $field => $val){ ?>
        <input type="hidden" id="<?=$field; ?>" name="<?=$field; ?>" value="<?=$val; ?>">
<?php } } ?>
