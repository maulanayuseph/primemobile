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
    
    <section class="page" style="margin-top: 60px;">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <?php echo $this->session->flashdata('alert'); ?>

            <form role="form" action="<?php echo base_url('user/do_aktivasi')?>" method="post" class="form-inline">
              <div class="form-group">
                <input type="text" name="kode_voucher" id="kode_voucher" class="form-control" placeholder="Masukkan Kode Voucher" required='required'>
              </div>
              <div class="form-group">
                <select data-placeholder="Pilih Kelas..." name="kelas" id="kelas" class="form-control" required='required'>
                  <option value="0" disabled selected>Pilih kelas...</option>
                  <?php 
                  foreach ($select_options as $item) { ?>
                    <option value="<?php echo $item->id_kelas ?>" > <?php echo $item->alias_kelas ?> </option>
                  <?php } ?>
                </select>
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <br>
            <?php echo form_error('kode_voucher', '<div class="text-danger">', '</div>'); ?>
            <?php echo form_error('kelas', '<div class="text-danger">', '</div>'); ?>

            <hr>
            <p>
              Belum punya kode voucher? Beli paket <a href="<?php echo base_url('user/beli')?>">disini</a>.
            </p>
            <p>
              Butuh bantuan aktivasi voucher? Hubungi kami di <a href="mailto:cs@primegeneration.co.id">cs@primegeneration.co.id</a>
            </p>
          </div>
        </div>           
      </div>
    </section>
    
    <?php include('footer.php');?>
    
    <!-- Javascript -->
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
  </body>
</html>
  </body>
</html>