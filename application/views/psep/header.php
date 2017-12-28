<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url("assets/psep/css/bootstrap.min.css");?>">
    <title><?php echo $title;?> | Prime Learning</title>
  </head>
  <body>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color: #700000;">
	<a class="navbar-brand" href="#">Prime Learning</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
  	</button>

  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
  		<ul class="navbar-nav mr-auto">
  			<li>
  				<a class="nav-link <?php echo $title = 'Beranda' ? 'active' : ''; ?>" href="<?php echo base_url('psep/index');?>">Beranda</a>
  			</li>
  		</ul>
  	</div>
</nav>