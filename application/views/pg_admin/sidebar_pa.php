<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--

Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
Tip 2: you can also add an image using data-image tag

-->
<?php
  //read uri segment to determine CSS active link
  $active = $this->uri->segment(2);
  $tambah = $this->uri->segment(4);
?>

<div class="sidebar" data-color="red" data-image="">
  <div class="sidebar-wrapper">
    <div class="logo">
      <a href="http://www.primemobile.co.id" class="simple-text">
          Prime Generation
      </a>
    </div>

    <ul class="nav">
		
        <li class="<?php echo ($active=='dashboard' ? 'active' : '')?>">
          <a href="<?php echo base_url('pg_admin/dashboard'); ?>">
              <i class="pe-7s-display1"></i>
              <p>Dashboard</p>
          </a>
        </li>
		
		<!-- end menu kelas -->
		<!--############################-->
	
   	<!-- Menu Try Out -->
			<!-- Menu Try Out -->
		<li class="sidebar-header"><span>CBT</span></li>
		
		<li class="<?php echo ($active=='banksoal' ? 'active' : '')?>">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="pe-7s-note2"></i>
              <p>Bank Soal <b class="caret"></b></p>
          </a>
		<ul class="dropdown-menu sub-nav">
			<li class="<?php echo ($active=='banksoal/kategori' ? 'active' : '')?>">
			  <a href="<?php echo site_url('pg_admin/banksoal/kategori') ?>">
				  <i class="pe-7s-note2"></i>
				  <p>Kategori Bank Soal</p>
			  </a>
			</li>
			<li class="<?php echo ($active=='banksoal' ? 'active' : '')?>">
			  <a href="<?php echo site_url('pg_admin/banksoal') ?>">
				  <i class="pe-7s-note2"></i>
				  <p>Manage Bank Soal</p>
			  </a>
			</li>
		</ul>
		</li>
		<li class="<?php echo ($active=='tryout' ? 'active' : '')?>">
          <a href="<?php echo site_url('pg_admin/tryout') ?>">
              <i class="pe-7s-note2"></i>
              <p>Try Out</p>
          </a>
        </li>
		<li class="<?php echo ($active=='cbtpsep' ? 'active' : '')?>">
          <a href="<?php echo site_url('pg_admin/tryout/aktivasi_psep') ?>">
              <i class="pe-7s-note2"></i>
              <p>Aktivasi CBT PSEP</p>
          </a>
        </li>
		<?php
			if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
		?>
		<li class="<?php echo ($active=='Pembayaran cbt contest' ? 'active' : '')?>">
          <a href="<?php echo site_url('pg_admin/tryout/pembayarancbt') ?>">
              <i class="pe-7s-note2"></i>
              <p>Pembayaran CBT</p>
          </a>
        </li>
		<?php
			}
		?>
		
		<?php
			if($this->session->userdata('level') == "superadmin"){
		?>
		<li class="<?php echo ($active=='analisis' ? 'active' : '')?>">
          <a href="<?php echo site_url('pg_admin/analisis') ?>">
              <i class="pe-7s-note2"></i>
              <p>Pencapaian Siswa</p>
          </a>
        </li>
		<?php
			}
		?>
        <!-- END MENU TRY OUT -->
        
         <!-- menu agcu test -->
        <li class="sidebar-header"><span>AGCU Test</span></li>
		<li class="<?php echo ($active=='diagnostictest' ? 'active' : '')?>">
          <a href="<?php echo site_url('pg_admin/diagnostictest/profil_diagnostic') ?>">
              <i class="pe-7s-note2"></i>
              <p>Diagnostic Test</p>
          </a>
        </li>
        <!-- MENU UNTUK MANJAEMEN WILAYAH -->
        <li class="sidebar-header"><span>Manajemen Wilayah</span></li>
        <li>
          <a href="<?php echo site_url('pg_admin/wilayah') ?>">
              <i class="pe-7s-note2"></i>
              <p>Wilayah</p>
          </a>
        </li>

        <!-- MENU UNTUK KEPERLUAN EVENT -->
        <li class="sidebar-header"><span>Manajemen Event</span></li>
		    <li class="<?php echo ($active=='diagnostictest' ? 'active' : '')?>">
          <a href="<?php echo site_url('pg_admin/event') ?>">
              <i class="pe-7s-note2"></i>
              <p>Event</p>
          </a>
        </li>
		
		<!-- MENU UNTUK KEPERLUAN EVENT -->
        <li class="sidebar-header"><span>Manage User</span></li>
		<li>
          <a href="<?php echo site_url('pg_admin/manajemen_user') ?>">
              <i class="pe-7s-note2"></i>
              <p>User</p>
          </a>
        </li>

		<!-- tambahan menu untuk PSES dan manajemen login PSES -->
		<!-- ############################ -->
		<!-- ############################ -->

		<li class="sidebar-header"><span>Manajemen PSEP</span></li>
		<li>
	      <a href="<?php echo site_url('pg_admin/akun_cabang') ?>">
	          <i class="pe-7s-chat"></i>
	          <p>Akun Cabang</p>
	      </a>
	    </li>
		<li class="<?php echo ($active=='Manajemen Akun PSEP' ? 'active' : '')?>">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			  <i class="pe-7s-credit"></i>
			  <p>Akun Sekolah <b class="caret"></b></p>
		  </a>
		  <ul class="dropdown-menu sub-nav">
			<li>
			  <a href="<?php echo site_url('pg_admin/akun_psep/sekolah')?>">Semua Akun</a>
			</li>
			<li>
			  <a href="<?php echo site_url('pg_admin/akun_psep/tambah_sekolah')?>">Tambah Baru</a>
			</li>
      <li>
        <a href="<?php echo site_url('pg_admin/akun_psep/kelas_paralel')?>">Kelas dan Tahun Ajaran</a>
      </li>
		  </ul>
		</li>
    <li class="<?php echo ($active=='Manajemen Akun PSEP' ? 'active' : '')?>">
      <a href="<?php echo site_url('pg_admin/sekolah/import_siswa') ?>">
          <i class="pe-7s-chat"></i>
          <p>Import Siswa PSEP</p>
      </a>
    </li>
    <li>
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="pe-7s-credit"></i>
        <p>Aktivasi PSEP <b class="caret"></b></p>
      </a>
      <ul class="dropdown-menu sub-nav">
        <li>
          <a href="<?php echo site_url('pg_admin/psep/daftar_pengajuan') ?>">
              <i class="pe-7s-chat"></i>
              <p>Pengajuan</p>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('pg_admin/sekolah/daftar_siswa') ?>">
              <i class="pe-7s-chat"></i>
              <p>Aktivasi Siswa</p>
          </a>
        </li>
      </ul>
    </li>
	 <li class="<?php echo ($active=='Manajemen Akun PSEP' ? 'active' : '')?>">
      <a href="<?php echo site_url('pg_admin/akun_psep/guru') ?>">
          <i class="pe-7s-chat"></i>
          <p>Manajemen Guru</p>
      </a>
    </li>

		<!-- end -->
		<!-- ############################ -->
		<!-- ############################ -->
		
		<!-- tambahan menu untuk manajemen user -->
		<!-- ############################ -->
		<!-- ############################ -->
		
		<!-- end -->
		<!-- ############################ -->
		<!-- ############################ -->
		
		<!-- menu untuk akun QC -->
		<!-- ############################ -->
		<!-- ############################ -->
		
		<!-- end menu untuk akun QC -->
		<!-- ############################ -->
		<!-- ############################ -->
		
    </ul>
  </div>
</div>
