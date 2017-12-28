<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login | Prime Generation Integrative Online Learning</title>
			
			<!-- Meta Tags -->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Icon -->
		<link rel="shortcut icon" href="<?php echo base_url('assets/pg_user/images/icon/favicon.ico');?>" >
		<link rel="icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icon/favicon.ico');?>" >
		<link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>" >
		
		<!-- Stylesheets -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/main.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/custom.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/custom-2.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/edit.css">
	</head>
	<body>
		<div class="header">
			<!-- Navbar  -->
			<?php include('header_dynamic.php'); ?>
		<!-- /Header -->
		</div>
		<!-- Page Body -->
		<div class="page-body login">
			<div class="container">
				<div class="row row-centered">
					<div class="col-xs-12 col-sm-5 col-md-4 col-centered">
						<?php echo $this->session->flashdata('alert'); ?>
						<h2 class="page-title">Login</h2>
						<div class="alert alert-info login-fb" role="alert">
							<a href="#"><span class="fb-media"></span> Masuk dengan Facebook</a>
						</div>
						<div class="log-separator">
							<div class="left"></div>
							<div class="middle">atau</div>
							<div class="right"></div>
						</div>
						<form action="<?php echo base_url() ?>login/do_login" method="post" class="log-form">
							<div class="form-group">
								<input type="text" class="form-control form-custom" placeholder="Username/E-mail" required name="username">
							</div>
							<div class="form-group">
								<input type="password" class="form-control form-custom" placeholder="Password" required name="password">
							</div>
							<input type="submit" name="login" value="Login" class="btn btn-full-width">
						</form>
						<!-- Ibnu -->
						<div class="login-action">
						   <div class="login-forgot">
							   <a href="#">Lupa Password?</a>
						   </div> 
						   <div class="login-new">
							   <a href="<?php echo base_url('signup') ?>">Daftar akun baru</a>
						   </div>
						</div>
						<!-- /Ibnu -->
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
		<?php include('footer.php');?>
		<!-- /Footer -->

		<!-- Javascript -->
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-scrolltofixed.js');?>"></script>
	    <script type="text/javascript">
            $('#fixednav').scrollToFixed();
        </script>
	</body>
</html>