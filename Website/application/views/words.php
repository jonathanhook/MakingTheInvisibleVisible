<div class="jumbotron">
	<h1>Words</h1>
	<p class="lead">
		Some of your and others' written work.
		You can click the button below to add some of your own work.
	</p>

	<a href="<?php echo base_url() . 'add_words'; ?>" class="btn btn-success">Add your words</a>
</div>

<div class="panel panel-default">
  	<div class="panel-heading">
		<div class="row">
			<?php if(count($user_words) > 0): ?>
				<div class="col-md-12">
					<p class="words_formheading">YOUR WORDS</p>
					<ul class="list-group">
						<?php foreach($user_words as $uw): ?>
							<li class="list-group-item">
								<div class="words_title"><a href="<?php echo base_url() . 'view_words?id=' . $uw->id; ?>"><?php echo $uw->title; ?></a></div>
								<div class="words_name">By <?php echo $uw->first_name . ' ' . $uw->last_name; ?></div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<?php if(count($other_user_words) > 0): ?>
				<div class="col-md-12">
					<p class="words_formheading">OTHERS' WORDS</p>
					<ul class="list-group">
						<?php foreach($other_user_words as $ow): ?>
							<li class="list-group-item">
								<div class="words_title"><a href="<?php echo base_url() . 'view_words?id=' . $ow->id; ?>"><?php echo $ow->title; ?></a></div>
								<div class="words_name">By <?php echo $ow->first_name . ' ' . $ow->last_name; ?></div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>