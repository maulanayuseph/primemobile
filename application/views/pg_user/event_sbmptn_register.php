<!DOCTYPE html>

<html lang="en">

  <head>    
    <title>Daftar Simulasi SBMPTN 2017 PrimeMobile Republika - Raih Prestasi dengan cara terbaik</title>

    <!-- Meta Tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Simulasi SBMPTN 2017 Prime Mobile">
    <meta name="keywords" content="sbmptn, ujian masuk perguruan tinggi, snmptn, tryout, ujian nasional, ujian">
    <meta name="author" content="Prime Mobile">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Icon -->
    <link rel="icon" href="<?php echo base_url('assets/dashboard/images/icon-red.png');?>">
    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-red.png');?>" >
    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-red.png');?>" >

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom-3.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/simple-sidebar.css');?>">
    <link href="<?php echo base_url('assets/dashboard/css/style.css');?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/style.css');?>">
    <!-- Needed for Video Player -->

		<style>
		.black p{color:#101010;}
		.akun-container {padding: 70px 10% 10px;}
		.navbar {padding: 10px 10% 5px;}
		.center{text-align:center;}
		.f14 {font-size:14px;}
		.f16 {font-size:16px;}
		.f18 {font-size:18px;}
		.f20 {font-size:20px;}
		.f24 {font-size:24px;}
		.b-dot-10 {border: dashed 1px #dc1826;padding: 10px;}
		.b-dot-10-1 {border: dotted 1px #dc1826;padding: 10px;}
		.b-dot-20 {border: dashed 1px #dc1826;padding: 20px;}
		.mt10 {margin-top:10px;}
		.mt20 {margin-top:20px;}
		.mb10 {margin-bottom:10px;}
		.mb20 {margin-bottom:20px;}
		.mb40 {margin-bottom:40px;}
		.fbold {font-weight: bold;}
		@media (min-width: 320px) and (max-width: 767px) {
			.navbar {padding: 10px 5% 5px;}
			.akun-container {padding: 50px 5% 10px;}
			h2 {font-size:24px;}
			h3 {font-size:20px;}
			.f14m {font-size:14px;}
			.f16m {font-size:16px;}
			.f18m {font-size:18px;}
			.f20m {font-size:20px;}
			.mt10m {margin-top:10px;}
			.mt20m {margin-top:20px;}
			.mb10m {margin-bottom:10px;}
			.mb20m {margin-bottom:20px;}
			.mb40m {margin-bottom:40px;}
		}
		</style>
		
    		<!-- ANALYTICS -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		
			ga('create', 'UA-93257814-1', 'auto');
			ga('send', 'pageview');
		
		</script>
		<!-- end ANALYTICS -->
		
  </head>

  <body>

  <!-- nav bar -->
	<div class="navbar navbar-fixed-top navhome" role="navigation">
		<div class="container-fluid" style="padding:0">
			<div class="navbar-header">
				<!--
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-bso">
					<span class="icon-bar first"></span>
					<span class="icon-bar second"></span>
					<span class="icon-bar third"></span>
				</button>
				-->
				<a class="logo" href="<?php echo base_url('event/sbmptn'); ?>"><img src="<?php echo base_url('assets/dashboard/images/logoWhite.png')?>" alt="Prime Generation Integrative Online Learning" style="margin-bottom:10px;"></a>
			</div>
		</div>
	</div>			

	<div class="container-fluid akun-container">

		<div class="col-lg-12 well" style="background:#fff;">
			<div class="f16 f14m black">
			
				<div class="col-md-12 col-xs-12 mb20">
					<div class="b-dot-10">
					
						<div class="col-md-12 col-xs-12">
							<h3>Form Pendaftaran Simulasi SBMPTN 2017</h3> 
							<hr>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-6 col-xs-12">
							<form name="regform" id="regform" method="post" action="<?= base_url('event/proses_register') ?>">
								 <? 
								 if ($this->session->flashdata('pesan') != ''){ 
										echo $this->session->flashdata('pesan');
								 }
								 if ($this->session->flashdata('error') != ''){ 
										echo $this->session->flashdata('error');
								 }
								 ?>

								 
								 <div class="form-group">
										 <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
								 </div>
								 <div class="form-group">
										 <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
										 <div id="cekemail"><input type="hidden" id="cemail" name="cemail" value="0"></div>
								 </div>
								 <div class="form-group">
										 <input type="text" class="form-control" id="phone" name="phone" placeholder="Nomor Telephone" required>
								 </div>
								 <div class="form-group">
										 <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
										 <div id="cekusername"><input type="hidden" id="cuser" name="cuser" value="0"></div>
								 </div>
								 <div class="form-group">
										 <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
								 </div>
								 <div class="form-group">
										 <select name="kelas" id="kelas" class="form-control" required>
												 <option value="">Pilih Tingkat</option>
												 <option value="19">SMA/MA IPA kelas 12</option>
												 <option value="20">SMA/MA IPS kelas 12</option>
										 </select>
								 </div>
								 <div class="form-group">
										<div class="input-group">
											<input type="hidden" id="hasil" name="hasil" value="<?= $hasil ?>">
											<div class="input-group-addon"><b><?= $kode1 ?> + <?= $kode2 ?> =</b></div>
											<input type="text" class="form-control" id="captcha" name="captcha" placeholder="Hasil Penjumlahan" required>
										</div>
								 </div>
								 <button type="submit" class="btn btn-success btn-block" id="btnsubmit" disabled>DAFTAR</button>
							</form>
						</div>
						<div class="col-md-6 col-xs-12 mt20m mb20m">
							<div class="b-dot-10-1">
								<h3 class="f20 f16m center">TATA CARA PEMBAYARAN</h3>
								<ol>
									<li class="mb10">Lakukan pembayaran pendaftaran simulasi SBMPTN 2017 sebesar Rp. 100.000,- ke rekening<br> <b>Bank Mandiri : 0700007446284<br> a.n PT. Prima Generasi Bimbingan Belajar</b></li>
									<li class="mb10">Setelah melakukan pembayaran, kirim sms konfirmasi pembayaran ke 081910033806 dengan format : SBMPTN # Nama Bank # Nama Pengirim # Email</li>
								</ol>
							</div>
						</div>
						<div class="clearfix"></div>
						
					</div>
				</div>
				<div class="clearfix"></div>

			</div>
		</div>
	</div>

  <?php include('footer.php');?>

	<!-- Javascript -->
	<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
	<script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>

	<!-- Progress -->
	<script src="<?= base_url('assets/js/nprogress.js')?>" ></script>

	<script>
		$(document).ready(function() {	
				$('#captcha').keyup(function() {
					if ($('#captcha').val().length > 0){
						if ($('#captcha').val() === $('#hasil').val() && $('#cuser').val() === '0' && $('#cemail').val() === '0'){
							$("#btnsubmit").prop('disabled', false);
						} else {
							$("#btnsubmit").prop('disabled', true);
						}
					}
				});

				$('#username').keyup(function() {
					if ($(this).val().length > 3){
						var urlLink = "<?php echo base_url().'event/cekusername/'; ?>" + $('#username').val();
						$.ajax({
							url:urlLink,
							beforeSend: function() {
								NProgress.start();
							},
							success:function(data) { 
								NProgress.done();
								$("#cekusername").html(data);
							}
						});
						return false;
					}
				});													
				
				$('#email').keyup(function() {
					if ($(this).val().length > 3){
						var formData = {
								'email' : $("#email").val()
						};

						var urlLink = "<?php echo base_url().'event/cekemail'; ?>";
						$.ajax({
							type:'POST',
							url:urlLink,
							data:formData,
							beforeSend: function() {
								NProgress.start();
							},
							success:function(data) { 
								NProgress.done();
								$("#cekemail").html(data);
							}
						});
						return false;
					}
				});													
				
		});
		$('form#regform input').on('keypress', function(e) {
				return e.which !== 13;
		});
	</script>				

  </body>
</html>

