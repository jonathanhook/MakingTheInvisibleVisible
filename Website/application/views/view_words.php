<div class="jumbotron">
	<h1><?php echo $words->title; ?></h1>
	<p class="lead">By <?php echo $words->first_name . ' ' . $words->last_name; ?></p>
</div>

<div class="panel panel-default">
  	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div><?php echo $words->text; ?></div>
			</div>
		</div>
	</div>
</div>