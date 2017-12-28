<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Orang Tua - Prime Mobile Cara Belajar Masa Kini</title>
    
    <link rel="icon" href="<?php echo base_url('assets/dashboard/images/icon-red.png');?>">
    <link href="<?php echo base_url('assets/dashboard/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/dashboard/css/style.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/pg_user/css/style.css');?>" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="<?php echo base_url('assets/js/jquery-1.12.4.min.js');?>"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/shaka-player.js');?>"></script>
  </head>

  <body>
    <div class="navbar navbar-static-top" role="navigation">
      <div class="container-fluid" style="padding:0">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar first"></span>
            <span class="icon-bar second"></span>
            <span class="icon-bar third"></span>
          </button>
          <a class="logo" href="<?php echo base_url('parents/dashboard');?>"><img src="<?php echo base_url('assets/dashboard/images/logo-red.png');?>"></a>
        </div>

        <div class="navbar-collapse collapse navstyle">
		  <ul class="nav navbar-nav">
				<li><a href="<?php echo base_url('parents/dashboard');?>"><span class="fa fa-dashboard"></span>&nbsp;&nbsp;Home</a></li>
				<li><a href="<?php echo base_url('parents/aktivitas_siswa');?>"><span class="fa fa-pie-chart"></span>&nbsp;&nbsp;Aktivitas Siswa</a></li>
				<li><a href="<?php echo base_url('parents/tryout');?>"><span class="fa fa-line-chart"></span>&nbsp;&nbsp;Analisis CBT</a></li>
				<li><a href="<?php echo base_url('parents/skor');?>"><span class="fa fa-graduation-cap"></span>&nbsp;&nbsp;Peringkat CBT</a></li>
				<li class="dropdown akun-name">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-book"></span>&nbsp;&nbsp;Report <span class="caret"></span></a>
				  <ul id="drop-akun" class="dropdown-menu">
					<li><a href="<?php echo base_url('parents/report_agcu');?>"><span class="fa fa-stethoscope"></span>&nbsp;&nbsp;AGCU Report</a></li>
				  </ul>
				</li>
		  </ul>
						
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown akun-name">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user icon"></span> <?php echo $infoortu->nama_ortu;?> <span class="caret"></span></a>
              <ul id="drop-akun" class="dropdown-menu">
				<li><a href="<?php echo base_url('parents/profil');?>"><span class="fa fa-user"></span>&nbsp;&nbsp;Profil</a></li>
				<li><a href="<?php echo base_url('parents/logout');?>"><span class="fa fa-sign-out"></span>&nbsp;&nbsp;Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <header class="akun-header">
      <div class="wrapper">
        <div class="profile-name">
          <h5>Selamat datang, <?php echo $infoortu->nama_ortu;?></h5>
          <h6>Nama Siswa : <?php echo $infoortu->nama_siswa;?></h6>
        </div>
        <div class="akun-edit">
          
        </div>
      </div>
    </header>
