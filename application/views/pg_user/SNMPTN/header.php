        <div class="navbar navbar-fixed-top navhome" role="navigation">
          <div class="container-fluid" style="padding:0">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle colapsed" data-toggle="collapse" data-target="#nav-bso">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="logo" href="<?php echo base_url(''); ?>"><img src="<?php echo base_url('assets/dashboard/images/logo.png')?>" alt="Prime Mobile Integrative Online Learning"></a>
            </div>
            
            <div class="collapse navbar-collapse navstyle" id="nav-bso">
              <ul class="nav navbar-nav">
                <li class="dropdown menu-large">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">SD 
                  <span class="caret"></span></a>
                  <ul class="dropdown-menu megamenu row">
                    <li class="col-sm-3">
                      <ul>
                      
                        <li class="dropdown-header">Kelas 4</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==4){
                            ?>
                            <li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
                          }
                        }?>
                        <li class="dropdown-header">Kelas 5</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==5){
                            ?>
                            <li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
                          }
                        }?>
                        <li class="dropdown-header">Kelas 6</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==6){
                            ?>
                            <li><a href="<?php echo site_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas 6</a></li>
                            <?php
                          }
                        }?>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li class="dropdown menu-large">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">SMP
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu megamenu row"><li class="col-sm-3">
                      <ul>
                        <li class="dropdown-header">Kelas 7</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==7){
                            ?>
                            <li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
                          }
                        }?>
						</ul>
                    </li>
                    <li class="col-sm-3">
                      <ul>
                        <li class="dropdown-header">Kelas 8</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==8){
                            ?>
                            <li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
                          }
                        }?>
						</ul>
                    </li>
					<li class="col-sm-3">
                      <ul>
                        <li class="dropdown-header">Kelas 9</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==9){
                            ?>
                            <li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
                          }
                        }?>
						</ul>
                    </li>
                  </ul>
                </li>
                <li class="dropdown menu-large">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">SMA
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu megamenu row">
                    <li class="col-sm-3">
                      <ul>
                        <li class="dropdown-header">Kelas 10</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==10){
                            ?>
                            <li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
                          }
                        }?>
						</ul>
                    </li>
					<li class="col-sm-3">
                      <ul>
                        <li class="dropdown-header">Kelas 11</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==11){
                            ?>
                            <li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
                          }
                        }?>
						</ul>
                    </li>
					<li class="col-sm-3">
                      <ul>
                        <li class="dropdown-header">Kelas 12</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==12){
                            ?>
                            <li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
                          }
                        }?>
						</ul>
                    </li>
                  </ul>
                </li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <?php 
                if(!empty($_SESSION['id_siswa'])) { ?>
                  <li class="user-name"><a href="<?php echo base_url('user')?>">Selamat datang, <span class="label label-success"><?php echo isset($_SESSION['nama_siswa']) ? strtok($_SESSION['nama_siswa'], ' ') : 'No name' ?></label></a></li>
                  <li><a href="<?php echo base_url('pencarian');?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">PAKET <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-paket">
                      <li>
                        <a href="<?php echo base_url('user/beli');?>">Beli Paket</a>
                        <a href="<?php echo base_url('user/buylist');?>">Riwayat</a>
                        <a href="<?php echo base_url('user/aktivasi');?>">Aktivasi</a>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown user-profile">
                    <a class="dropdown-toggle img-user" data-toggle="dropdown" href="#">
                      <div class="img-circle">
                        <?php 
                          $foto = (isset($_SESSION['foto']) && !empty($_SESSION['foto'])) ? $_SESSION['foto'] : 'default.jpg';
                        ?>
                          <img src="<?php echo base_url('assets/uploads/foto_siswa/'.$foto);?>" width="376" height="500" alt="Prime Generation User Profile" class="img-responsive">
                      </div>
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
					  <li><a href="<?php echo base_url('user/dashboard');?>">Dashboard</a></li>
                      <li><a href="<?php echo base_url('user');?>">Profilku</a></li>
                      <li><a href="<?php echo base_url('user/ubah_profil');?>">Ubah Profil</a></li>
                      <li><a href="<?php echo base_url('user/logout');?>">Logout</a></li>
                    </ul>
                  </li>
                <?php 
                } 
                else { ?>
                  <li><a href="<?php echo base_url('pencarian')?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
                  <li><a href="<?php echo base_url('login')?>">LOGIN/DAFTAR</a></li>
                <?php 
                } ?>
              </ul>
             </div>
          </div>
        </div>