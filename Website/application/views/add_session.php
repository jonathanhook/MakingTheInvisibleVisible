<!DOCTYPE html>
<html lang="en">
<head>
	<title>Upload Form</title>

	<script src="<?php echo base_url();?>js/jquery-2.0.3.min.js"></script>
	<script src="<?php echo base_url();?>js/jquery-ui.js"></script>
	<script>
  		$(function() 
  		{
    		$( "#datepicker" ).datepicker();
  		});
  	</script>
</head>
<body>
	<div>
		<?php echo form_open_multipart('add_session/index');?>
		<p>
			Title:
			<?php echo form_input('title', '', 'placeholder="The title of the session..."'); ?>
		</p>
		<p>
			Date:
			<?php echo form_input('date', '', 'id="datepicker" placeholder="The title of the session..."'); ?>
		</p>
		<p>
			<?php echo form_submit('submit', 'Submit'); ?>
		</p>
		<?php echo form_close(); ?>
	</div>
</body>
</html>