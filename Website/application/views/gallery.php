<div class="jumbotron">
	<h1>Gallery</h1>
  <p class="lead">
    Take a look at some of the pictures, videos and sounds that we've captured during the workshops. 
    Use the button below to upload your own things to the gallery.
  </p>
  
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
      <a href="<?php echo base_url() . 'media/' . $images[$i]->name; ?>" class="thumbnail">
        <img src="<?php echo base_url() . 'media/' . $images[$i]->name ?>" />
      </a>
    </div>

  <?php endfor; ?>
</div>
<?php endif; ?>

<script src="<?php echo base_url();?>js/bootstrap.file-input.js"></script>
<script>$(document).ready(function(){$('input[type=file]').bootstrapFileInput();});</script>

<!--
	<?php if(count($images) > 0): ?>

	<div class="row marketing">
    	<div class="col-lg-12">
    		<h4>Pictures</h4>
       </div>
  	</div>

  	<?php for($i = 0; $i < count($images); $i++): ?>
  		<?php if($i % 4 == 0): ?>
  		<div class="row marketing">
  		<?php endif; ?> 
	
    	<div class="col-lg-3">
    		<a href="">
    			<img src="<?php echo base_url() . '/media/' . $images[$i]->name; ?>" width="192" />
			<a/>
       </div>

 		<?php if($i % 4 == 3): ?>
  		</div>
  		<?php endif; ?> 
	<?php endfor; ?>

	<?php endif; ?>
</div>
-->
