<?php foreach($kelasaktif as $kelass):

              if($kelass->tingkatan_kelas == '10' or $kelass->tingkatan_kelas == '11' or $kelass->tingkatan_kelas == '12' ): ?>
<!-- untuk sbmptn -->
    <div class="col-lg-12">
     <div class="col-lg-12"><p>&nbsp;</div>

    </div>
    <div class="profile-option">
        <div class="input-group search">
          <span class="input-group-addon"><span class="glyphicon glyphicon-file search"></span></span>
          <span class="form-control" id="cari">SNMPTN</span>
        </div>
        <ul class="options nav navbar-nav">
          <li class="dropdown kelas-option">
          </li>
          <li class="dropdown mapel-option"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PILIH SNMPTN<span class="glyphicon glyphicon-chevron-down"></span></a>
            <ul class="dropdown-menu" id="dropprofil">
                   <li><a href="<?= base_url('snmptn2016/snmptn2016'); ?>">Halaman SNMPTN</a></li>
                   <li><a href="<?= base_url('snmptn2016/snmptn2016/pengantar'); ?>">Kata Pengantar</a></li>
                   <li><a href="<?= base_url('snmptn2016/snmptn2016/informasisnmptn'); ?>">Informasi SNMPTN 2016</a></li>
                   <li><a href="<?= base_url('snmptn2016/snmptn2016/daftarptn'); ?>">Daftar PTN</a></li>
            </ul>
          </li>
        </ul>
   </div>

<!-- Untuk Snmptn -->
   <div class="col-lg-12">
       <div class="col-lg-12"><p>&nbsp;</div>
       <div class="col-lg-12"><p>&nbsp;</div>
       <div class="col-lg-12"><p>&nbsp;</div>
       <div class="col-lg-12"><p>&nbsp;</div>
       <div class="col-lg-12"><p>&nbsp;</div>
       <div class="col-lg-12"><p>&nbsp;</div>
    
    </div>
    <div class="profile-option">
        <div class="input-group search">
          <span class="input-group-addon"><span class="glyphicon glyphicon-file search"></span></span>
          <span class="form-control" id="cari">SBMPTN</span>
        </div>
        <ul class="options nav navbar-nav">
          <li class="dropdown kelas-option">
          </li>
          <li class="dropdown mapel-option"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PILIH SBMPTN<span class="glyphicon glyphicon-chevron-down"></span></a>
            <ul class="dropdown-menu" id="dropprofil">
                   <li><a href="<?= base_url('sbmptn2016/sbmptn2016'); ?>">Halaman SBMPTN</a></li>
                   <li><a href="#">Informasi Umum</a></li>
                   <li><a href="#">Daftar PTN & Panlok</a></li>
                   <li><a href="#">Daftar PTN UK</a></li>
                   <li><a href="#">Daftar Panlok PBT</a></li>
                   <li><a href="#">Daftar Panlok CBT</a></li>
                   <li><a href="#">Alur Pendaftaran</a></li>
                   <li><a href="#">Persyaratan SMA/MA/SMK</a></li>
                   <li><a href="#">Tata Cara Pembayaran</a></li>
                   <li><a href="#">Ujian Keterampilan</a></li>
                   <li><a href="#">Jadwal Penting </a></li>
                   <li><a href="#">Tata Tertib Ujian Tertulis </a></li>
            </ul>
          </li>
        </ul>
   </div>
    <div class="profile-option">
      <div class="col-lg-12"><p>&nbsp;</div>
      <div class="col-lg-12"><p>&nbsp;</div>
      <div class="col-lg-12"><p>&nbsp;</div>
      <div class="col-lg-12"><p>&nbsp;</div>
      <div class="col-lg-12"><p>&nbsp;</div>
     
    </div>

   <?php endif;
endforeach;?>