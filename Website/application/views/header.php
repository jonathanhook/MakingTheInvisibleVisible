<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Making the Invisible Visible</title>

    <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/jumbotron-narrow.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/miv.css">

    <script src="<?php echo base_url();?>js/jquery-2.0.3.min.js"></script>
    <script src="<?php echo base_url();?>js/tinymce/tinymce.min.js"></script>
  </head>

  <body>
    <div class="container">
      <div class="header">
        <?php if($logged_in): ?>
        <ul class="nav nav-pills pull-right">
          <li <?php if($selected == 'gallery') echo 'class="active"'; ?>><a href="<?php echo base_url();?>gallery">Gallery</a></li>
          <li <?php if($selected == 'words') echo 'class="active"'; ?>><a href="<?php echo base_url();?>words">Words</a></li>
          <li <?php if($selected == 'diary') echo 'class="active"'; ?>><a href="<?php echo base_url();?>diary">Diary</a></li>
          <li><a href="./auth/logout">Logout</a></li>
        </ul>
        <?php endif; ?>
        <h3 class="text-muted">Making the Invisible Visible</h3>
      </div>
