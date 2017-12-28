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

					<!-- <h2>Latihan Soal <b class="emp">Pembacaan Teks</b></h2> -->

					<ul class="list">
					<?php
					if(isset($_SESSION['data_latihan']['list_jawaban'])) {
						foreach ($_SESSION['data_latihan']['list_jawaban'] as $item) {
							if($item == 1) { 
				      		//<li><span class="glyphicon glyphicon-ok-circle"></span></li>
							}
							else {
				      		//<li><span class="glyphicon glyphicon-remove-circle"></span></li>
							}
						} 
					} ?>
				    </ul>

				</div>

				<div class="deskripsi">

				        <img src="<?php echo base_url('assets/pg_user/images/soal1.png')?>" width="263" height="230" alt="Test Icon Prime Mobile" class="img-responsive mulai-latihan-img"> 
				        <div class="wrapper">
							<?php
							if($skor < 70){
								?>
								<h3>Ayo berusaha lagi!</h3>
								<?php
							}else{
								?>
								<h3>Berhasil!</h3>
								<?php
							}
							?>
				          <table class="table">
				            <tr>
				              <td>Jumlah Soal</td>
				              <td>:</td>
				              <td><?php echo $jumlah_soal; ?></td>
				            </tr>
							<tr>
				              <td>Benar</td>
				              <td>:</td>
				              <td><?php echo $jumlah_benar; ?></td>
				            </tr>
							<tr>
				              <td>Poin Latihan Soal</td>
				              <td>:</td>
				              <td><?php echo $skor; ?></td>
				            </tr>
				          </table>
				          <div class="buttons">

								<a href="<?php echo base_url().'latihan/index/'.$_SESSION['data_latihan']['id_materi']?>" class="btn btn-latihan btn-selesai">Ulangi Latihan!</a>

								<a href="<?php echo base_url().'materi/tabel_konten_detail/'.$_SESSION['data_latihan']['id_pokok']?>" class="btn btn-latihan btn-selesai">Kembali Belajar!</a>

							</div>
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

	</body>

</html>