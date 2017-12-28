<!DOCTYPE html>

<html lang="en">

	<head>

		<title>Pekerjaan Rumah | Prime Mobile - Cara belajar masa kini</title>

			

			<!-- Meta Tags -->

	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	    <meta name="description" content="">

	    <meta name="keywords" content="">

	    <meta name="author" content="">

	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    

	    <!-- Icon -->

	    <link rel="shortcut icon" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>">

	    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>">

	    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>">



			<!-- Stylesheets -->

	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom-2.css');?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/jPaginator.css');?>">

			

			<!-- Needed for Video Player -->

			<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/shaka-player.js');?>"></script>

	</head>

	<body onload="JavaScript:connect(); myFunction();">

		<style>
			.no-js #loader { display: none;  }
			.js #loader { display: block; position: absolute; left: 100px; top: 0; }
			.se-pre-con {
				position: fixed;
				left: 0px;
				top: 0px;
				width: 100%;
				height: 100%;
				z-index: 9999;
				background: url('<?php echo base_url('assets/img/preloading.gif') ?>') center no-repeat #fff;
			}
		</style>

		<div class="se-pre-con"></div>

		<div class="header">

			<!-- Navbar  -->

			<?php include('header_latihan.php'); ?>

		</div>

		<!-- /Header -->



    <?php include "modal_pembahasan.php"; ?>

		

		<!-- Page Body -->

		<div class="page-body latihan-soal">

			<div class="soal-header">

				<h2>Tugas</h2>
				<h1><?php echo $infopr->nama_pr; ?></h1>
				<div class="keterangan-wrapper">
				</div>
			</div>

			


				<div class="wrapper-soal">

					<div class="container">

						<div class="col-sm-4 hidden-xs">
						</div>
						<div class="col-sm-4">
							<div class="panel panel-default">
								<div class="panel-body">
									<table class="table table-striped">
										<tr>
											<td>Jumlah Soal</td>
											<td>:</td>
											<td><?php echo $jumlahsoal;?></td>
										</tr>
										<tr>
											<td>Jumlah Benar</td>
											<td>:</td>
											<td><?php echo $jumlahbenar;?></td>
										</tr>
										<tr>
											<td>Nilai</td>
											<td>:</td>
											<td><h4><?php echo $nilai;?></h4></td>
										</tr>
									</table>
									<a class="btn btn-sm btn-primary" style="width: 100%;" href="<?php echo base_url('user/dashboard');?>">Kembali ke Dashboard</a>
								</div>
							</div>
						</div>
						<div class="col-sm-4 hidden-xs">
						</div>

					</div>

				</div>

		</div>

		<!-- /Page Body -->


		<!-- Footer -->

		<?php include('footer_latihan.php'); ?>

		<!-- /Footer -->

		

	  <!-- Javascript -->

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>

	



<script>
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
</script>

	</body>

</html>
