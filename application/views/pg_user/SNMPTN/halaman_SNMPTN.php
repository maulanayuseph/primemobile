<!DOCTYPE html>
<html lang="en">
  <head>    
    <title>Prime Mobile Integrative Online Learning</title>
    
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom-3.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/simple-sidebar.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
    
  </head>
  <body>
  <?php 
   if($status_siswa == "tidak_aktif"){
          redirect('user/dashboard');
         } 
  ?>
 <?php foreach($kelasaktif as $kelass):

              if($kelass->tingkatan_kelas == '10' || $kelass->tingkatan_kelas == '11' || $kelass->tingkatan_kelas == '12'): 
                ?>

    <header class="header">
      <!-- nav bar -->
         <?php include('header.php'); ?>
        <div class="mapel-header" style="margin-top:60px;">
            <h2 class="mapel-title">SNMPTN 2016</h2>
        </div>
    </header>

    <!-- Table of Content -->
    <div id="content-sidebar" class="tableofcontent-wrapper">
        <div class="tableofcontent">
            <div class="table-sidebar">
                <div id="sidebar" class="left-side">
                  <?php include('menu_snmptn.php'); ?>
                </div>
            </div>
      
      <div class="table-desc">
            <div class="desc-content">
              <div class="content-target"></div>
              <h3 style="text-align: center">SELEKSI NASIONAL MASUK PERGURUAN TINGGI NEGERI (SNMPTN) TAHUN 2016</h3>
                  <p style="text-align: center">PANITIA PELAKSANA 
                  SELEKSI NASIONAL MASUK PERGURUAN TINGGI NEGERI
                  TAHUN 2016</p>
                  <p>Pengumuman SNMPTN 2016 dapat mulai diakses pada hari Senin, 9 Mei 2016 pukul 13.00 WIB melalui laman resmi SNMPTN di http://pengumuman.snmptn.ac.id dan 11 laman mirror berikut:</p>
                      <p>
                      <a href="">http://snmptn.unand.ac.id </a><br>
                      <a href="">http://snmptn.unsri.ac.id</a><br>
                      <a href="">http://snmptn.ui.ac.id</a><br>
                      <a href="">http://snmptn.ipb.ac.id</a><br>
                      <a href="">http://snmptn.itb.ac.id</a><br>
                      <a href="">http://snmptn.undip.ac.id</a><br>
                      <a href="">http://snmptn.ugm.ac.id</a><br>
                      <a href="">http://snmptn.its.ac.id</a><br>
                      <a href="">http://snmptn.unair.ac.id</a><br>
                      <a href="">http://snmptn.untan.ac.id</a><br>
                      <a href="">http://snmptn.unhas.ac.id</a><br>
                      </p>
            </div>
      </div> 
   </div>
      <ul class="quote-wrapper">
        <li></li>
        <li><h5>QUOTES</h5>
            <p>"Bermimpilah tentang apa yang ingin kamu impikan, pergilah ke tempat-tempat kamu 
            ingin pergi, jadilah seperti yang kamu inginkan, karena kamu hanya memiliki satu kehidupan 
            dan satu kesempatan untuk melakukan hal-hal yang ingin kamu lakukan." </p>  
            <h6>“Happy Trenggono”</h6>
        </li>
        <li></li>
      </ul>
      </div>       
    
    <?php include('footer.php');?>
      <? else: redirect('user/dashboard');
      endif; endforeach;?>
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
    
    <!-- Menu Toggle Script -->
    <script type="text/javascript">
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    </script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-scrolltofixed.js');?>"></script>
    <script type="text/javascript">
        $('#fixednav').scrollToFixed();
        $('#sidebar').scrollToFixed({
            marginTop: $('.header').outerHeight() - 250,
            limit: function() {
                var limit = $('.footer').offset().top - $('#sidebar').outerHeight(true) - 10;
                return limit;
            },
            zIndex: 999,
            removeOffsets: true
        });
    </script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/animatescroll.js');?>"></script>
    
  </body>
</html>