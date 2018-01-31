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
		
		<!-- Menu Contract -->
		<!-- ############################ -->
		<!-- ############################ -->
    <li class="<?php echo ($active=='dashboard' ? 'active' : '')?>">
      <a href="<?php echo base_url('pg_admin/kontrak'); ?>">
          <i class="pe-7s-display1"></i>
          <p>Kontrak</p>
      </a>
    </li>
		<li>
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="pe-7s-credit"></i>
        <p>Tagihan<b class="caret"></b></p>
      </a>
      <ul class="dropdown-menu sub-nav">
        <li>
          <a href="<?php echo site_url('pg_admin/keuangan/tagihan') ?>">
              <i class="pe-7s-chat"></i>
              <p>Daftar Tagihan</p>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('pg_admin/keuangan/buat_tagihan') ?>">
              <i class="pe-7s-chat"></i>
              <p>Buat Tagihan</p>
          </a>
        </li>
      </ul>
    </li>
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
