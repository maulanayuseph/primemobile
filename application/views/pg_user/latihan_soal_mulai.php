<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Latihan Soal Mulai | Prime Mobile - Cara belajar masa kini</title>
			
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
		<script type="text/x-mathjax-config">
		  MathJax.Hub.Config({
		    tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
		  });
		</script>
		<script type="text/javascript" async
		  src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML">
		</script>
	</head>
	<?php 
				if (isset($_SESSION['akses'])){
					if (count($_SESSION['akses']) > 0){
						if (isset($_SESSION['akses']['reguler'])){
							$paketaktif = $_SESSION['akses']['reguler'][0]; 
						} else if (isset($_SESSION['akses']['premium'])){
							$paketaktif = $_SESSION['akses']['premium'][0]; 
						}
					} else {
						$paketaktif = 0;
					}
				} else {
					$paketaktif = 0;
				}
				?>
	<body>
		<div class="header">
			<!-- Navbar  -->
			<?php include('header_latihan.php'); ?>
		</div>
		<!-- /Header -->

		<!-- Page Body -->
		<div class="page-body latihan">
			<div class="container">
      	        <?php include('modal_akses_materi.php'); ?>
                <div class="row">
                   <div class="content">
                    
<!--
                    <span class="deskripsi">
                        <p><?php //echo $data->deskripsi_sub_materi ? $data->deskripsi_sub_materi : '<br>' ?></p>
                    </span>
-->
                    <img src="<?php echo base_url('assets/pg_user/images/soal1.png')?>" width="263" height="230" alt="Test Icon Prime Mobile" class="img-responsive mulai-latihan-img">
                    <div class="wrapper">
	                    <span class="latihan-header">
	                        <h2><b class="emp"><?php echo $data->nama_sub_materi ? $data->nama_sub_materi : '' ?></b></h2>
	                    </span>
	                    <table class="table">
						            <tr>
						              <td>Kelas </td>
						              <td>:</td>
						              <td><?php echo $infolatihan->alias_kelas; ?></td>
						            </tr>
						            <tr>
						              <td>Mata Pelajaran</td>
						              <td>:</td>
						              <td><?php echo $infolatihan->nama_mapel; ?></td>
						            </tr>
						            <tr>
						              <td>Materi Pokok</td>
						              <td>:</td>
						              <td><?php echo $infolatihan->nama_materi_pokok; ?></td>
						            </tr>
						            <tr>
						              <td>Jumlah Soal</td>
						              <td>:</td>
						              <td><?php echo $jumlahsoal; ?> Soal</td>
						            </tr>
						          </table>
						    		
                    <?php
                    if(($data->status_materi == 0) OR ($allow_akses == TRUE))
                        { ?>
                                <a href="<?php echo base_url().'latihan/soal/'.$data->id_sub_materi;?>" class="btn btn-latihan">Mulai Latihan!</a>
                            <?php
                            }elseif(($infolatihan->id_kelas == 38 && $paketaktif == 19) || ($infolatihan->id_kelas == 37 && $paketaktif == 20) || ($infolatihan->id_kelas == 39 && $paketaktif == 6) ){
								?>
								<a href="<?php echo base_url().'latihan/soal/'.$data->id_sub_materi;?>" class="btn btn-latihan">Mulai Latihan!</a>
								<?php
							}
                            else 
                            { ?>
                                <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-latihan">Mulai Latihan!</a>
                            <?php
                            } ?>
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
	    <script>
		$("img").each(function() {  
		   imgsrc = $(this).attr('src');
		   alamatlatex = imgsrc.substring(0, 37);
		   alamatlatex2 = imgsrc.substring(0, 36);
		   if(alamatlatex === "https://latex.codecogs.com/gif.latex?" || alamatlatex2 === "http://latex.codecogs.com/gif.latex?"){
		   		latex = imgsrc.substring(37);
		   		//alert(latex);
		   		$(this).replaceWith("$" + latex + "$")
		   }
		   //console.log(imgsrc);
		});  
		</script>
	</body>
</html>