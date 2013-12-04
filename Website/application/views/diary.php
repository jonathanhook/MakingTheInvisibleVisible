<div class="jumbotron">
	<h1>Diary</h1>
		<p class="lead">Videos that you've captured in the diary room. The other participants can't see the videos on this page.</p>
	</div>

	<?php if(count($videos) > 0): ?>
		<?php foreach ($videos as $v): ?>
		
		<div class="row">
			<div class="col-md-12"><h4>Week <?php echo $v->week;?></h4></div> 	
		</div>

		<div class="row">
			<div class="col-md-12">
				<video id="<?php echo $v->id ?>;" controls preload="auto" class="diary_video">
					<source src="<?php echo base_url() . 'media/' . $v->name; ?>" />
				</video>
			</div>
		</div>

		<? endforeach; ?>
	<?php else: ?>
		<div>
			<p>There aren't any diary entries for you to view yet sorry.</p> 
		</div>
	<?php endif; ?>
