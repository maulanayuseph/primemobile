<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prime Mobile - MEMBUAT KAMU JUARA!</title>
    <meta name="Description" content="Prime Mobile adalah sebuah layanan bimbingan belajar online atau e-learning berbasis teknologi yang dibuat oleh Prime Genration" />
    <meta name="Keywords" content="belajar online, e-learning, bimbel, bimbingan, belajar, bimbingan belajar, ujian online, uts, uas, semester, sbmptn, snmptn, sd, smp, sma, video tutorial, pembahasan soal, analisis butir soal" />
	
    <link rel="icon" href="<?php echo base_url('assets/dashboard/images/icon-red.png');?>">
		
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
	
    <link href="<?php echo base_url('assets/dashboard/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/dashboard/css/style.css');?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/style.css');?>">

	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/maximage/lib/css/jquery.maximage.css');?>" type="text/css" media="screen" title="CSS" charset="utf-8" />

    
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
	<style>
		.video{
			background: none;
			padding: 0px;
		}
		.materi-content .caption p,
		.home-slider .caption p{
			color: white;
		}
		.reason-wrapper > p{
			color: black;
		}
		p{
			color: black;
		}
	</style>

  </head>
  <body>
<div class="row">
	<div class="col-sm-12 text-center">
		<h3>User Aktif</h3>
	</div>
	<div class="col-sm-12 tabel-login">
		<table class="table display table-bordered table-striped">
			<thead>
				<tr>
				<th style="width: 10px;">#</th>
				<th>Nama Siswa</th>
				<th>Username</th>
				<th>Email</th>
				<th>Last Activity</th>
				<th>IP</th>
				<th>Browser</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$x = 1;
					foreach($datalogin as $login){
						?>
						<tr>
						<td><?php echo $x;?></td>
						<td><?php echo $login->nama_siswa;?></td>
						<td><?php echo $login->username;?></td>
						<td><?php echo $login->email;?></td>
						<td><?php echo $login->last_time;?></td>
						<td><?php echo $login->ip;?></td>
						<td><?php echo $login->browser;?></td>
						</tr>
						<?php
						$x++;
					}
				?>
			</tbody>
		</table>
	</div>
</div>
  
 <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>" defer></script>
  <!--<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/formValidation.js');?>" defer></script>-->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/bootstrap.js');?>" defer></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery.steps.min.js');?>" defer></script>
    <script type="text/javascript" src="<?php echo base_url('assets/dashboard/js/init.js');?>" defer></script>
    <script type="text/javascript" src="<?php echo base_url('assets/dashboard/maximage/lib/js/jquery.maximage.min.js');?>" defer></script>
    <script type="text/javascript" src="<?php echo base_url('assets/dashboard/maximage/lib/js/jquery.cycle.all.js');?>" defer></script>
	
	<!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
 <script>
$(document).ready(function(){
	$('table.display').DataTable();
})
</script>
  </body>
  </html>