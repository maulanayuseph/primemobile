<!DOCTYPE html>

<html lang="en">

	<head>

		<title>Latihan Soal Selesai | Prime Mobile - Cara belajar masa kini</title>

			

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

	</head>

	<body>

		<div class="header">

			<!-- Navbar  -->

			<?php include('header_latihan.php'); ?>

		</div>

		<!-- /Header -->



		<!-- Page Body -->

		<div class="page-body latihan">

			<div class="container">

				<div class="latihan-header">

				</div>

				<div class="deskripsi">

					<p>Skor Kamu:</p>

					<p class="score"><?php echo number_format($skor->jumlah_bobot_benar, 2, '.', '');?></p>
					
					<?php
						if($tuntas == 1){
					?>
					<p>Bagus! Skor kamu sudah di atas ketuntasan. Kamu dapat belajar materi untuk meningkatkan pemahaman kamu.</p>
					<?php
						}else{
					?>
					<p>Skor kamu masih dibawah ketuntasan. Kamu dapat belajar materi untuk meningkatkan pemahaman kamu.</p>
					<?php
						}
					?>
					<br>&nbsp;
					<br>&nbsp;
					<?php
						if($idevent !== null){
							?>
							<a href="<?php echo base_url("cbt_event/index/" . $idevent);?>" class="btn btn-latihan" style="float: none;">Kembali Ke Halaman Event</a>
							<?php
						}else{
							?>
							<a href="<?php echo base_url("tryout/cbt");?>" class="btn btn-latihan" style="float: none;">Kembali Ke Halaman CBT</a>
							<?php
						}
					?>
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


	</body>

</html>