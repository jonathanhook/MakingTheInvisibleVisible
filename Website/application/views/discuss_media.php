<div class="jumbotron">
	<h1>Discuss</h1>
	<p class="lead">You can use the box at the bottom to write your thoughts about this 
        <?php if($media->type == 2): ?>
            picture.
        <?php elseif($media->type == 1): ?>
            video.
        <?php elseif($media->type == 3): ?>
            sound.
        <?php endif; ?>
    </p>
</div>

<?php if($media->type == 2): ?>
	<img src="<?php echo base_url() . 'media/' . $media->name; ?>" class="discuss_media">
<?php endif; ?>

<?php if($media->type == 1): ?>
    <video id="<?php echo $media->id ?>;" preload="auto" class="discuss_media" controls>
        <source src="<?php echo base_url() . 'media/' . $media->name; ?>" />
    </video>
<?php endif; ?>

<?php if($media->type == 3): ?>
    <audio id="<?php echo $media->id; ?>" controls class="discuss_media discuss_audio">
        <source src="<?php echo base_url() . 'media/' . $media->name; ?>" type="audio/mpeg" />
        Your browser does not support the audio element.
    </audio>
<?php endif; ?>

<div class="comments_region">
    <div>
        <ul class="list-group">
            <?php foreach ($comments as $c): ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-10">
                            <?php echo $c->text; ?>
                        </div>
                        <div class="col-md-2">
                            <span class="badge comments_name_badge pull-right">
                                <?php echo $c->first_name; ?>
                            </span>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

  	<div>
    	<?php echo form_open_multipart('discuss_media/index', '', $hidden);?>
    	<div class="row">
    		<div class="col-md-12">
                <div class="input-group">
                    <?php echo form_input('comment', '', 'class="form-control" placeholder="Write a comment..."'); ?>
                    <span class="input-group-btn">
                        <?php echo form_submit('submit', 'Comment', 'class="btn btn-default"'); ?>
                    </span>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
