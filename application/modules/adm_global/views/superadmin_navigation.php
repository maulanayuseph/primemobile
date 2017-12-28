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
        <h3>General</h3>

        <ul class="nav side-menu">
          <!-- MENU MASTER -->
          <li><a><i class="fa fa-archive" aria-hidden="true"></i> Master <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('adm_master/kelas');?>">Kelas</a></li>
              <li><a href="<?php echo base_url('adm_master/kurikulum');?>">Kode Kurikulum</a></li>
              <li><a href="<?php echo base_url('adm_master/kur_kelas');?>">Kurikulum Kelas</a></li>
            </ul>
          </li>
          <!-- MENU MIGRASI DB -->

          <!-- MENU MIGRASI DB -->
          <li><a><i class="fa fa-arrows-h" aria-hidden="true"></i> Migration <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url('adm_migration/content');?>">Content Migration</a></li>
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