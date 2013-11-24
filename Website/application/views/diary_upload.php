<!DOCTYPE html>
<html lang="en">
<head>
	<title>Diary Upload Form</title>
</head>
<body>
	<?php echo form_open_multipart('diary_upload/index');?>
	<?php echo form_dropdown('user_name', $options);?>
	<?php echo form_input('week', '');?>
	<?php echo form_upload('userfile', '');?>
	<?php echo form_submit('submit', 'Upload'); ?>
	<?php echo form_close(); ?>
</body>
</html>