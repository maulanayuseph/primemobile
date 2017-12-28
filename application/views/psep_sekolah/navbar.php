<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<nav class="navbar navbar-default navbar-fixed">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo isset($navbar_title) ? $navbar_title : 'Manajemen' ?></a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
		<?php
			if($this->session->userdata('level') == "sekolah"){
				?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php echo $sekolah->nama_sekolah;?>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
					<li><a href="<?php echo base_url("psep_sekolah/profil_sekolah");?>">Profil Sekolah</a></li>
					</ul>
				</li>
				<?php
			}else{
				$guru = $this->model_psep->fetch_guru_by_id_login($this->session->userdata('idpsepsekolah'));
				if($guru->foto_crop !== ""){
					?>
					<li>
						<img style="height: 36px; border-radius: 100%; margin-top: 10px;" src="<?php echo $guru->foto_crop;?>" alt="...">
					</li>
					<li>
						<a href="<?php echo base_url('psep_sekolah/dashboard');?>"><?php echo $guru->nama;?></a>
					</li>
					<?php
				}else{
					?>
					<li>
						<img style="height: 36px; border-radius: 100%; margin-top: 10px;" src="http://localhost/primemobile/assets/uploads/logo-sekolah/260553c3ec43dbb37e671ce1dc3a64ccd29b.jpg" alt="...">
					</li>
					<li>
						<a><?php echo $guru->nama;?></a>
					</li>
					<?php
				}
			}
		?>
        <li>
          <a href="<?php echo site_url('psep_sekolah/login/logout')?>">
            <i class="fa fa-power-off" aria-hidden="true"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>