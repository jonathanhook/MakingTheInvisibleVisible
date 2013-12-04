<div class="jumbotron">
	<h1>Gallery</h1>
  <p class="lead">
    Take a look at some of the pictures, videos and sounds that we've captured during the workshops. 
    Use the button below to upload your own things to the gallery.
  </p>
  
  <?php if($uploadErrors != '') echo '<div style="color: red;">' . $uploadErrors . '</div>'; ?> 

  <div>
    <?php echo form_open_multipart('gallery/index');?>
    <div class="row">
      <?php echo form_upload('userfile', '', 'title="Choose a file"') ?>
    </div>
    <div class="row">
      <?php echo form_submit('submit', 'Upload', 'class="btn btn-success"'); ?>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>

<?php if(count($images) > 0): ?>

  <div class="row">
   <div class="col-md-12"><h4>Pictures</h4></div> 	
  </div>
  
  <div class="row">
    <?php for($i = 0; $i < count($images); $i++): ?>

      <div class="col-md-3">
        <a href="<?php echo base_url() . 'discuss_media?id=' . $images[$i]->id; ?>" class="thumbnail">
          <?php if($images[$i]->num_comments > 0): ?>
            <span class="badge btn-primary" style="z-index=100; position:absolute; margin: 5px; background-color: #428bca;">
              <?php echo $images[$i]->num_comments; ?>
            </span>
          <?php endif; ?>
          <img src="<?php echo base_url() . 'media/' . $images[$i]->thumbnail; ?>" />
        </a>
      </div>

    <?php endfor; ?>
  </div>
<?php endif; ?>

<?php if(count($images) > 0): ?>

  <div class="row">
   <div class="col-md-12"><h4>Videos</h4></div>   
  </div>

  <div class="row">
    <?php for($i = 0; $i < count($videos); $i++): ?>

      <div class="col-md-4">
        <a href="<?php echo base_url() . 'discuss_media?id=' . $videos[$i]->id; ?>" class="thumbnail">
          <?php if($videos[$i]->num_comments > 0): ?>
            <span class="badge btn-primary" style="z-index=100; position:absolute; margin: 5px; background-color: #428bca;">
              <?php echo $videos[$i]->num_comments; ?>
            </span>
          <?php endif; ?>
          <video id="<?php echo $videos[$i]->id ?>;" preload="auto" width="100%">
            <source src="<?php echo base_url() . 'media/' . $videos[$i]->name; ?>" />
          </video>
        </a>
      </div>

    <?php endfor; ?>
  </div>

<?php endif; ?>

<script src="<?php echo base_url();?>js/bootstrap.file-input.js"></script>
<script>$(document).ready(function(){$('input[type=file]').bootstrapFileInput();});</script>

