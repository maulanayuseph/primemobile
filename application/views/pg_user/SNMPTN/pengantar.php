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
              <h3 align="center">Kata Pengantar SNMPTN 2016</h3>
            
            <p>
              Berdasarkan Undang-Undang Nomor 12 Tahun 2012 tentang Pendidikan Tinggi, Peraturan Pemerintah Nomor 4 Tahun 2014 tentang Penyelenggaraan Pendidikan Tinggi dan Pengelolaan Perguruan Tinggi, Peraturan Menteri Riset, Teknologi, dan Pendidikan Tinggi  Nomor 2 Tahun 2015 tentang Penerimaan Mahasiswa Baru Program Sarjana pada Perguruan Tinggi Negeri sebagaimana telah diubah dengan Peraturan Menteri Riset, Teknologi, dan Pendidikan Tinggi  Nomor 45 Tahun 2015, pola penerimaan mahasiswa baru program sarjana pada perguruan tinggi negeri dilakukan melalui: Seleksi Nasional Masuk Perguruan Tinggi Negeri (SNMPTN), Seleksi Bersama Masuk Perguruan Tinggi Negeri (SBMPTN), dan Seleksi Mandiri. SNMPTN merupakan seleksi yang dilakukan oleh masing-masing PTN di bawah koordinasi Panitia Nasional dengan seleksi berdasarkan hasil penelusuran prestasi akademik calon mahasiswa. 
            </p>
            <p>
              SNMPTN diikuti seluruh Perguruan Tinggi Negeri (PTN) yang sudah ditetapkan oleh Majelis Rektor Perguruan Tinggi Negeri Indonesia (MRPTNI), diselenggarakan dalam suatu sistem yang terpadu dan serentak. Biaya pelaksanaan SNMPTN ditanggung oleh Pemerintah, sehingga peserta tidak dipungut biaya seleksi. Peserta SNMPTN dari keluarga kurang mampu secara ekonomi dan dinyatakan  diterima di PTN berpeluang mendapatkan bantuan biaya pendidikan selama masa studi melalui program Bidikmisi.
            </p>
            <p>
              Informasi SNMPTN 2016 meliputi: ketentuan dan persyaratan umum, tatacara pengisian Pangkalan Data Sekolah dan Siswa (PDSS), tata cara pendaftaran, jadwal pelaksanaan, serta jumlah pilihan PTN dan Program Studi. Informasi ini diterbitkan untuk dipelajari secara seksama oleh sekolah dan calon peserta. Secara rinci, informasi tentang tata cara Pengisian PDSS dimuat dalam Panduan Pengisian PDSS yang dapat diakses di laman resmi <a href="../pdss.snmptn.ac.id/index.html">http://pdss.snmptn.ac.id</a>, sedangkan tata cara pendaftaran dan pelaksanaan SNMPTN 2016 dimuat dalam panduan peserta yang dapat diakses di laman resmi<a href="index.html"> http://www.snmptn.ac.id</a>. 
            </p>
            <p>
              Semoga informasi ini bermanfaat bagi sekolah dan calon  peserta untuk mengikuti SNMPTN 2016.
            </p>

            <table style='width:100%;margin-top:50px'>
              <tr>
                <td style='width:250px;text-align:center'>
                  Mengetahui,
                  <br>
                  Majelis Rektor
                  <br>
                  Perguruan Tinggi Negeri Indonesia
                  <br>
                  Ketua,
                  <br>
                  <br>
                  <br>
                  Prof. Dr. Ir. Herry Suhardiyanto, M.Sc.
                  <br>
                  Rektor Institut Pertanian Bogor
                  <br>
                </td>
                <td>&nbsp;</td>
                <td style='width:250px;text-align:center; center top no-repeat'>
                  Jakarta, 15 Januari 2016
                  <br>
                  Panitia Nasional SNMPTN 2016
                  <br>
                  Ketua Umum,
                  <br>
                  <br>
                  <br>
                  <br>
                  Prof. Dr. Rochmat Wahab, M.Pd., M.A.
                  <br>
                  Rektor Universitas Negeri Yogyakarta
                  <br>
                </td>
              </tr>
            </table>
              
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