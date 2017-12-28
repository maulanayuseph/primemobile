<!DOCTYPE html>
<html lang="en">
    <head>    
        <title>Prime Generation Integrative Online Learning</title>
        
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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/simple-sidebar.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
        
    </head>
    <body>
        <header>
			<!-- nav bar -->
				 <?php include('header_dynamic.php'); ?>
				<div class="mapel-header">
				        <h2 class="mapel-title"><?php echo $header->nama_mapel." ".$header->alias_kelas ?></h2>
				</div>
		</header>
			<!-- apa kata -->
		
        <div class="mapel-subs">
            <div class="subs-left">
                <h3 class="center-title">Menentukan Latar Tempat dan Waktu</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/UzSv0pYw7as"></iframe>
                </div>
            </div>
            <div class="subs-right mapel-rightbar">
                <div class="subs-konten">
                    <h4>Menentukan latar tempat dan waktu</h4>
                    <ul>
                        <li>Menentukan latar tempat</li>
                        <li>Menentukan latar waktu</li>
                        <li>Menentukan alur cerita</li>
                    </ul>
                    <button class="btn btn-default">Berikutnya : Mencatat Hal Penting</button>
                </div>
            </div>
        </div>
		
        <?php include('footer.php'); ?>
        
        <!-- Javascript -->
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>
		<!-- Menu Toggle Script -->
		<script>
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
		</script>
    </body>
</html>
    </body>
</html>