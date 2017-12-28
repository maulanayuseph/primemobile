<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prime Mobile - Cara Belajar Masa Kini</title>

    <link rel="icon" href="<?php echo base_url('assets/dashboard/images/icon-red.png');?>">
    <link href="<?php echo base_url('assets/dashboard/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/dashboard/css/style.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/pg_user/css/style.css');?>" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
          <a class="logo" href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/dashboard/images/logo-red.png');?>"></a>
        </div>

        <div class="navbar-collapse collapse navstyle">
				
					<ul class="nav navbar-nav">
						
						<li class="dropdown menu-large">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">SD 
							<span class="caret"></span></a>
							<ul class="dropdown-menu megamenu row">
								<li class="col-sm-4">
									<ul>
										<li class="dropdown-header">Kelas 4</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==4){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
											}
										}?>
									</ul>
								</li>
								<li class="col-sm-4">
									<ul>
										<li class="dropdown-header">Kelas 5</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==5){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
											}
										}?>
									</ul>
								</li>
								<li class="col-sm-4">
									<ul>
										<li class="dropdown-header">Kelas 6</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==6){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
											}
										}?>
									</ul>
								</li>
							</ul>
						</li>

						<li class="dropdown menu-large">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">SMP
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu megamenu row">
								<li class="col-sm-4">
									<ul>
										<li class="dropdown-header">Kelas 7</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==7){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
											}
										}?>
									</ul>
								</li>
								<li class="col-sm-4">
									<ul>
										<li class="dropdown-header">Kelas 8</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==8){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
											}
										}?>
									</ul>
								</li>
								<li class="col-sm-4">
									<ul>
										<li class="dropdown-header">Kelas 9</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==9){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
											}
										}?>
									</ul>
								</li>
							</ul>
						</li>

						<li class="dropdown menu-large">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">SMA
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu megamenu row">
								<li class="col-sm-4">
									<ul>
										<li class="dropdown-header">Kelas 10 IPA</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==10){
												if( strpos( $mapel->nama_mapel, 'IPA' ) == true ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
												}
											}
										}?>
										<li class="dropdown-header">Kelas 10 IPS</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==10){
												if( strpos( $mapel->nama_mapel, 'IPS' ) == true ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
												}
											}
										}?>
									</ul>
								</li>
								<li class="col-sm-4">
									<ul>
										<li class="dropdown-header">Kelas 11 IPA</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==11){
												if( strpos( $mapel->nama_mapel, 'IPA' ) == true ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
												}
											}
										}?>
										<li class="dropdown-header">Kelas 11 IPS</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==11){
												if( strpos( $mapel->nama_mapel, 'IPS' ) == true ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
												}
											}
										}?>
									</ul>
								</li>
								<li class="col-sm-4">
									<ul>
										<li class="dropdown-header">Kelas 12 IPA</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==12){
												if( strpos( $mapel->nama_mapel, 'IPA' ) == true ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
												}
											}
										}?>
										<li class="dropdown-header">Kelas 12 IPS</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==12){
												if( strpos( $mapel->nama_mapel, 'IPS' ) == true ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
												}
											}
										}?>
									</ul>
								</li>
							</ul>
						</li>
						<li class="dropdown menu-large">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">SBMPTN
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu megamenu row">
								<li class="col-sm-6">
									<ul>
										<li class="dropdown-header">SOSHUM</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==13 && $mapel->kelas_id==37){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?></a></li>
												<?php
											}
										}?>
									</ul>
								</li>
								<li class="col-sm-6">
									<ul>
										<li class="dropdown-header">SAINTEK</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==13 && $mapel->kelas_id==38){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?></a></li>
												<?php
											}
										}?>
									</ul>
								</li>
							</ul>
						</li>
						
					</ul>
							
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown akun-name">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $infosiswa->foto == "" ? '<span class="glyphicon glyphicon-user icon"></span>' : '<div class="img-circle"><img class="img-responsive" src="'.base_url('assets/uploads/foto_siswa/'.$infosiswa->foto).'"></div>' ?> <span class="lbl-nama"><?php echo $infosiswa->nama_siswa; ?> <span class="caret"></span></span></a>
              <ul id="drop-akun" class="dropdown-menu">
								<li><a href="<?php echo base_url('user/dashboard');?>">Dashboard</a></li>
								<li><a href="<?php echo base_url('agcutest');?>">AGCU Test</a></li>
								<li><a href="<?php echo base_url('parents');?>">Orang Tua</a></li>
                <li class="menu-title">Paket<span class="glyphicon glyphicon-chevron-down"></span></li>
                <li><a href="<?php echo base_url('user/beli');?>">Beli Paket</a></li>
                <li><a href="<?php echo base_url('user/buylist');?>">Riwayat</a></li>
                <li><a href="<?php echo base_url('user/aktivasi');?>">Aktivasi</a></li>
                <li class="menu-title">Profil<span class="glyphicon glyphicon-chevron-down"></span></li>
                <li><a href="<?php echo base_url('user');?>">Profilku</a></li>
								<li><a href="<?php echo base_url('user/ubah_profil');?>">Ubah Profil</a></li>
								<li><a href="<?php echo base_url('user/logout');?>">Logout</a></li>
              </ul>
            </li>
            <li><a href="<?php echo base_url('pencarian');?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
          </ul>
        </div>
      </div>
    </div>

    <header class="akun-header">
      <div class="wrapper">
        <img src="<?php 
				if($infosiswa->foto == ""){
				echo base_url('assets/dashboard/images/profile.jpg');
				}else{
				echo base_url('assets/uploads/foto_siswa/'.$infosiswa->foto);
				}
				?>">
        <div class="profile-name">
          <h5><?php echo $infosiswa->nama_siswa; ?></h5>
          <h6><?php echo $infosiswa->nama_sekolah; ?></h6>
        </div>
        <div class="akun-edit">
          <a id="edit-profile-menu2" href="<?php echo base_url('user/ubah_profil');?>" class="btn btn-default btn-edit"><span class="glyphicon glyphicon-cog"></span>Edit Profil</a>
          <div class="score">
            <button class="btn number orange">1</button>
            <button id="poinSiswa" class="btn number blue" title="Poin Kamu">
              <?php echo $infosiswa->poin; ?>
            </button>
          </div>
        </div>
      </div>
    </header>