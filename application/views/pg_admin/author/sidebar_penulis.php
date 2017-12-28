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
          Prime Mobile
      </a>
    </div>

    <ul class="nav">
		
        <li class="<?php echo ($active=='dashboard' ? 'active' : '')?>">
          <a href="<?php echo base_url('pg_admin/author/semua_materi'); ?>">
              <i class="pe-7s-display1"></i>
              <p>Semua Materi</p>
          </a>
        </li>
		
    </ul>
  </div>
</div>
