<!DOCTYPE html>
<html lang="en">
<head>
	<title>Upload Form</title>
</head>
<body>
	<?php echo form_open_multipart('upload/index');?>
	<?php echo form_upload('userfile', '') ?>
	<?php echo form_submit('submit', 'Upload'); ?>
	<?php echo form_close(); ?>
</body>
</html>