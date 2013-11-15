<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Making the Invisible Visible</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">
      <div class="header">
        <?php if($logged_in): ?>
        <ul class="nav nav-pills pull-right">
          <li <?php if($selected == 'gallery') echo 'class="active"'; ?>><a href="./gallery">Gallery</a></li>
          <li <?php if($selected == 'diary') echo 'class="active"'; ?>><a href="./diary">Diary</a></li>
          <li><a href="./auth/logout">Logout</a></li>
        </ul>
        <?php endif; ?>
        <h3 class="text-muted">Making the Invisible Visible</h3>
      </div>
