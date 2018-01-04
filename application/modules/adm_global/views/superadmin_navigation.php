<div class="col-md-3 left_col menu_fixed">
  <div class="left_col scroll-view">
    <div class="navbar nav_title text-center" style="border: 0;">
      <a href="<?php echo base_url("adm_main/redirect_dashboard");?>" class="site_title"><span>Prime Mobile</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="images/img.jpg" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo $dataadmin->nama;?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>Manajemen Prime Mobile</h3>

        <ul class="nav side-menu">

          <!-- MENU MASTER -->
          <li><a><i class="fa fa-archive" aria-hidden="true"></i> Master <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('adm_master/kelas');?>">Kelas</a></li>
              <li><a href="<?php echo base_url('adm_master/kurikulum');?>">Kode Kurikulum</a></li>
              <li><a href="<?php echo base_url('adm_master/mapel');?>">Mata Pelajaran</a></li>
              <li><a href="<?php echo base_url('adm_master/group');?>">Group</a></li>
              <li><a href="<?php echo base_url('adm_master/indikator');?>">Indikator</a></li>
            </ul>
          </li>
          <!-- MENU MASTER -->

          <!-- MENU MANAJEMEN KONTEN -->
          <li><a><i class="fa fa-folder" aria-hidden="true"></i> Manajemen Konten <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('adm_konten/kur_kelas');?>">Kurikulum Kelas</a></li>
              <li><a href="<?php echo base_url('adm_konten/kur_mapel');?>">Manajemen Mapel</a></li>
              <li><a href="<?php echo base_url('adm_konten/kur_tema');?>">Manajemen Tematik</a></li>
              <li><a href="<?php echo base_url('adm_pengujian/uji_eksternal');?>">Pengujian Eksternal</a></li>
            </ul>
          </li>
          <!-- END MENU MANAJEMEN KONTEN -->
          
          <!-- MANAJEMEN BANK SOAL DAN CBT -->
          <li><a><i class="fa fa-briefcase" aria-hidden="true"></i> Bank Soal & CBT <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('adm_bank/kategori');?>">Kategori Bank Soal</a></li>
              <li><a href="<?php echo base_url('adm_bank/index');?>">Bank Soal</a></li>
              <li><a href="<?php echo base_url('adm_cbt/index');?>">CBT</a></li>
              <li><a href="<?php echo base_url('adm_uss/index');?>">USS SBMPTN</a></li>
            </ul>
          </li>
          <!-- end manajemen bank soal dan cbt -->
          
          <!-- MANAJEMEN QUALITY CONTROL -->
          <li><a><i class="fa fa-eye" aria-hidden="true"></i> Quality Control <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('adm_qc/mapel');?>">Konten Mapel</a></li>
              <li><a href="<?php echo base_url('adm_qc/tematik');?>">Konten Tematik</a></li>
              <li><a href="<?php echo base_url('adm_cbt/bank_soal');?>">Bank Soal</a></li>
            </ul>
          </li>
          <!-- end manajemen quality control -->
          
          <!-- manajemen event -->
          <li><a href="<?php echo base_url('adm_event/index');?>"><i class="fa fa-flag-checkered"></i> Event</a></li>
          <!-- end manajemen event -->

          <!-- manajemen pembelian paket -->
          <li><a><i class="fa fa-money" aria-hidden="true"></i> Paket <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('adm_paket/pembelian');?>">Pembelian</a></li>
            </ul>
          </li>
          <!-- end manajemen pembelian paket --> 

          <!-- manajemen Self Assesment -->
          <li><a><i class="fa fa-bar-chart" aria-hidden="true"></i> Pengembangan Diri <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('adm_agcu/diagnostic');?>">AGCU</a></li>
            </ul>
          </li>
          <!-- end manajemen Self Assesment -->

          <!-- MANAJEMEN VIDEO -->
          <li><a><i class="fa fa-play" aria-hidden="true"></i> Video <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('adm_video/group');?>">Group</a></li>
              <li><a href="<?php echo base_url('adm_video/crew');?>">Crew</a></li>
              <li><a href="<?php echo base_url('adm_video/index');?>">Video</a></li>
            </ul>
          </li>
          <!-- end manajemen video -->
          
          <!-- MANAJEMEN PSEP -->
          <li><a><i class="fa fa-university" aria-hidden="true"></i> PSEP <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('adm_psep/sekolah');?>">Sekolah</a></li>
              <li><a href="<?php echo base_url('adm_psep/akun');?>">Akun Sekolah</a></li>
              <li><a href="<?php echo base_url('adm_psep/import');?>">Siswa</a></li>
              <li><a href="<?php echo base_url('adm_psep/commited');?>">PSEP Commited</a></li>
            </ul>
          </li>
          <!-- end manajemen PSEP -->

          <!-- manajemen admin -->
          <li><a><i class="fa fa-user" aria-hidden="true"></i> Akun <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('adm_akun/akun');?>">Daftar Akun</a></li>
              <li><a href="<?php echo base_url('adm_akun/tambah');?>">Tambah Baru</a></li>
            </ul>
          </li>
          <!-- end MANAJEMEN ADMIN -->

          <!-- MENU MIGRASI DB -->
          <li><a><i class="fa fa-arrows-h" aria-hidden="true"></i> Migration <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('adm_migration/content');?>">Content Migration</a></li>
              <li><a href="<?php echo base_url('adm_migration/mass_migration');?>">Mass Migration</a></li>
            </ul>
          </li>
          <!-- MENU MIGRASI DB -->

          <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page</a></li>
        </ul>
      </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('adm_main/logout');?>">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>
<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="images/img.jpg" alt=""><?php echo $dataadmin->nama;?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="<?php echo base_url('adm_main/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->