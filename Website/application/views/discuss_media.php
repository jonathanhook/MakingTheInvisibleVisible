<div class="jumbotron">
	<h1>Discuss</h1>
	<p class="lead">You can use the box at the bottom to write your thoughts about this 
        <?php if($media->type == 2): ?>
            picture.
        <?php elseif($media->type == 1): ?>
            video.
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

<div class="comments_region">
    <div>
        <ul class="list-group">
            <?php foreach ($comments as $c): ?>
                <li class="list-group-item">
                    <?php echo $c->text; ?>
                    <span class="badge">
                        <?php echo $c->first_name; ?>
                    </span>
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
