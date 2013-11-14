<!DOCTYPE html>
<html lang="en">
<head>
	<title>Gallery</title>
</head>
<body>
	<?php if(count($images) > 0): ?>
		<h2>Images</h2>
		<?php foreach ($images as $i): ?>
		<img src="<?php echo base_url() . '/media/' . $i->name; ?>" height="100" />
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if(count($videos) > 0): ?>
	<h2>Videos</h2>
	<?php foreach ($videos as $v): ?>
	<?php echo $v->name; ?><br />
	<?php endforeach; ?>
	<?php endif; ?>

	<?php if(count($audio) > 0): ?>
	<h2>Audio</h2>
	<?php foreach ($audio as $a): ?>
	<?php echo $a->name; ?><br />
	<?php endforeach; ?>
	<?php endif; ?>
</body>
</html>