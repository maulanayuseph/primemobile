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

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom-3.css');?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
    
    
  </head>
  <body>
    <div class="header">
      <!-- Navbar  -->
      <?php include('header.php');?>
    </div>
    <section class="page" margin-top: 60px;>
      <div class="container">
        <div class="row row-login">
          <?php if(empty($_SESSION['akses']))
          { ?>
          <div class="row">
            <div class="akses-notif col-sm-12">
              <h4 class="alert alert-info">
                Kamu belum memiliki paket bimbel. Agar dapat mengakses konten premium, segera pilih paketmu 
                <a href="<?php echo base_url('user/beli')?>" class="label label-info label-lg">DI SINI</a>
              </h4>
            </div>
          </div>
          <?php 
          } ?>
          <div class="profil-detail">
            <div class="picture">
              <?php 
                $foto = $data_user->foto ? $data_user->foto : 'default.jpg';
              ?>
              <img src="<?php echo base_url('assets/uploads/foto_siswa/'.$foto);?>" width="376" height="500" alt="Foto Profil Siswa Prime Mobile" class="img-responsive">
            </div>
            <div class="name-container">
              <p class="name"><?php echo $data_user->nama_siswa ? $data_user->nama_siswa : 'No name'?></p>
            </div>
          </div>
          

          <table class="table profil-data">
            <tbody>
              <tr>
                <td class="data-index"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <strong>Email</strong></td>
                <td class="data-value"><?php echo $data_user->email ? $data_user->email : '-'?></td>
              </tr>
              <tr>
                <td class="data-index"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <strong>Username</strong></td>
                <td class="data-value"><?php echo $data_user->username ? $data_user->username : '-';?></td>
              </tr>
              <tr>
                <td class="data-index"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <strong>No. Telepon Siswa</strong></td>
                <td class="data-value"><?php echo $data_user->telepon ? $data_user->telepon : '-';?></td>
              </tr>
              <tr>
                <td class="data-index"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <strong>No. Telepon Orang Tua</strong></td>
                <td class="data-value"><?php echo $data_user->telepon_ortu ? $data_user->telepon_ortu : '-';?></td>
              </tr>
              <tr>
                <td class="data-index"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> <strong>Sekolah</strong></td>
                <td class="data-value"><?php echo $data_user->nama_sekolah ? $data_user->nama_sekolah : '-';?> (Kelas <?php echo $data_user->tingkatan_kelas ? $data_user->tingkatan_kelas : '-';?>)</td>
              </tr>
            </tbody>
          </table>
          <div class="col-xs-12 ubah-btn">
            <a href="<?php echo base_url('user/ubah_profil')?>" class="btn btn-warning">Ubah Profil</a>
          </div>
        </div>
      </div>        
    </section>
    
    <?php include('footer.php');?>
    
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
  </body>
</html>
  </body>
</html>