<div class="jumbotron">
	<h1>Add Words</h1>
	<p class="lead">
		Add some of your written work to the website using the boxes below.
	</p>
	<div class="words_error"><?php echo $error; ?></div>
</div>

<script>
    tinymce.init(
	{
		selector:'textarea',
		menubar: false,
		statusbar: false,
		toolbar: "undo redo | bold italic underline | link image | alignleft aligncenter alignright alignjustify"
	});
</script>

<div class="panel panel-default">
  	<div class="panel-heading">
		<div class="row">
			<?php echo form_open_multipart('add_words/index', '', $hidden); ?>
			<div class="col-md-12">
				<p class="words_formheading">TITLE</p>
				<p><?php echo form_input('title', $title,'class="form-control" placeholder="The title..."'); ?></p>
				<?php if($admin): ?>
					<p class="words_formheading">AUTHOR</p>
					<?php echo form_dropdown('author', $users, '', 'class="form-control"'); ?>
				<?php endif; ?>
				<p class="words_formheading">ENTER YOUR WORDS BY HAND</p>
				<p><?php echo form_textarea('text', $text, 'class="form-control" placeholder="Your work..."'); ?></p>

				<p class="words_formheading">OR UPLOAD A SCANNED PIECE OF WORK</p>
				<p><?php echo form_upload('userfile', '', 'title="Click here to choose a scan of your work to upload..."') ?></p>

				<p><?php echo form_submit('save', 'Save', 'class="btn btn-success pull-left"'); ?></p>
			</div>

			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<script src="<?php echo base_url();?>js/bootstrap.file-input.js"></script>
<script>$(document).ready(function(){$('input[type=file]').bootstrapFileInput();});</script>