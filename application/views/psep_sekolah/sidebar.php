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
      <a href="<?= base_url() ?>psep_sekolah/dashboard" class="simple-text">
           <?php
			 if($sekolah->logo !== ""){
				 ?>
				 <img style="height: 75px; width: auto;" src="<?php echo base_url("assets/uploads/logo-sekolah/" . $sekolah->logo);?>" alt="..."/>
				 <?php
			 }else{
				 ?>
				 <img style="height: 75px; width: auto;" src="<?php echo base_url("assets/dashboard/images/logoWhite.png");?>" alt="..."/>
				 <?php
			 }
			 ?>
      </a>
    </div>

    <ul class="nav">
        <li class="<?php echo ($active=='dashboard' ? 'active' : '')?>">
          <a href="<?php echo base_url('psep_sekolah/dashboard'); ?>">
              <i class="fa fa-home" aria-hidden="true"></i>
              <p>Dashboard</p>
          </a>
        </li>
		
		<!-- menu kesiswaan -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		<?php if($this->session->userdata('level') == "sekolah"){
		?>
		<li class="sidebar-header"><span>Kesiswaan</span></li>
		<li>
			<a href="<?php echo base_url("psep_sekolah/tahun_ajaran");?>">
				<i class="fa fa-calendar" aria-hidden="true"></i>
				Tahun Ajaran
			</a>
		</li>
		<li>
			<a href="<?php echo base_url("psep_sekolah/kelas_paralel");?>">
				<i class="fa fa-users" aria-hidden="true"></i>
				Kelas paralel
			</a>
		</li>
		<li>
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-user" aria-hidden="true"></i>
              <p>Siswa <b class="caret"></b></p>
			</a>
			<ul class="dropdown-menu sub-nav">
				<li>
					<a href="<?php echo site_url('psep_sekolah/siswa')?>">Siswa Terdaftar</a>
				</li>
				<li>
					<a href="<?php echo site_url('psep_sekolah/siswa/rancangan_studi')?>">Rancangan Studi Siswa</a>
				</li>
			</ul>
		</li>
		<?php
		}
		?>
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- END MENU KESISWAAN-->
		
		<!-- menu silabus -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		<li class="sidebar-header"><span>Silabus Sekolah</span></li>
		<li class="<?php echo ($active=='silabus' ? 'active' : '')?>">
          <a href="<?php echo base_url('psep_sekolah/silabus'); ?>">
              <i class="fa fa-sitemap" aria-hidden="true"></i>
              <p>Silabus</p>
          </a>
        </li>
        <li class="<?php echo ($active=='bank soal' ? 'active' : '')?>">
          <a href="<?php echo base_url('psep_sekolah/bank_soal'); ?>">
              <i class="fa fa-newspaper-o" aria-hidden="true"></i>
              <p>Bank Soal</p>
          </a>
        </li>
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- END MENU silabus-->

		<!-- menu materi -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		<?php
		if($this->session->userdata('level') == "guru"){
		?>
		<li class="sidebar-header"><span>Materi</span></li>
		<li>
			<a href="<?php echo base_url("psep_sekolah/materi");?>">
				<i class="fa fa-book" aria-hidden="true"></i>
				Materi
			</a>
		</li>
		<?php
		}
		?>
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- END MENU materi-->

		<li class="sidebar-header"><span>Manajemen Bank Soal</span>
		<li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-list-ol"></i>
              <p>Bank Soal<b class="caret"></b></p>
          </a>
          <ul class="dropdown-menu sub-nav">
            <li>
              <a href="<?php echo base_url('psep_sekolah/bank_soal/kategori'); ?>">Kategori Bank Soal</a>
            </li>
            <li>
              <a href="<?php echo base_url('psep_sekolah/bank_soal'); ?>">Bank Soal</a>
            </li>
          </ul>
        </li>
		<!-- menu PR -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		<?php
		if($this->session->userdata('level') == "guru"){
		?>
		<li class="sidebar-header"><span>Pekerjaan Rumah Siswa</span></li>
		<li>
			<a href="<?php echo base_url("psep_sekolah/pr");?>">
				<i class="fa fa-tasks" aria-hidden="true"></i>
				Tugas Siswa
			</a>
		</li>
		<?php
		}
		?>
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- END MENU PR-->

		<!-- MENU REPORT AGCU -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
        <li class="sidebar-header"><span>Academic General Check Up</span></li>
		<li>
			<a href="<?php echo base_url("psep_sekolah/agcu/report_siswa");?>">
				<i class="fa fa-quote-right" aria-hidden="true"></i>
				AGCU
			</a>
		</li>
		<!-- END MENU REPORT AGCU -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		
		
		<!-- MENU REPORT CBT -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		<li class="sidebar-header"><span>Computer Based Test</span></li>
		<li>
			<a href="<?php echo base_url("psep_sekolah/cbt/config");?>">
				<i class="fa fa-cog" aria-hidden="true"></i>
				CBT
			</a>
		</li>
		<li>
			<a href="<?php echo base_url("psep_sekolah/uss/sbmptn");?>">
				<i class="fa fa-university" aria-hidden="true"></i>
				USS
			</a>
		</li>
        <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-list-ol"></i>
              <p>Report CBT <b class="caret"></b></p>
          </a>
          <ul class="dropdown-menu sub-nav">
            <li>
              <a href="<?php echo base_url('psep_sekolah/cbt'); ?>">CBT Internal</a>
            </li>
            <li>
              <a href="<?php echo base_url('psep_sekolah/cbt/reguler'); ?>">CBT Reguler</a>
            </li>
          </ul>
        </li>
		<!-- END MENU REPORT CBT -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		

		<!-- MENU RAPORT -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		<li class="sidebar-header"><span>Raport Siswa</span></li>
		<li>
			<a href="<?php echo base_url("psep_sekolah/raport");?>">
				<i class="fa fa-book" aria-hidden="true"></i>
				Raport Siswa
			</a>
		</li>
		<!-- END MENU RAPORT -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->

		<!-- MENU MANAJEMEN GURU -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		<?php if($this->session->userdata('level') == "sekolah"){
		?>
        <li class="sidebar-header"><span>Manajemen Guru</span></li>
		<li class="<?php echo ($active=='guru' ? 'active' : '')?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-briefcase" aria-hidden="true"></i>
              <p>Guru <b class="caret"></b></p>
          </a>
          <ul class="dropdown-menu sub-nav">
            <li>
              <a href="<?php echo site_url('psep_sekolah/guru')?>">Semua Guru</a>
            </li>
            <li>
              <a href="<?php echo site_url('psep_sekolah/guru/tambah')?>">Tambah Guru</a>
            </li>
          </ul>
        </li>
		<?php
		}
		?>
		
		<li>
		    <a href="<?php echo site_url('psep_sekolah/login/logout')?>">
                <i class="fa fa-list-ol"></i>
                <p>Log Out</p>
            </a>
		</li>
		<!-- END MENU REPORT AGCU -->
		<!-- ################################# -->
		<!-- ################################# -->
		<!-- ################################# -->
		
		
    </ul>
  </div>
</div>