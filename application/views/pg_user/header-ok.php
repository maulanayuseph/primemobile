        <div class="navbar navbar-fixed-top navhome" role="navigation">
          <div class="container-fluid" style="padding:0">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-bso">
                <span class="icon-bar first"></span>
                <span class="icon-bar second"></span>
                <span class="icon-bar third"></span>
              </button>
              <a class="logo" href="<?php echo base_url(''); ?>"><img src="<?php echo base_url('assets/dashboard/images/logoWhite.png')?>" alt="Prime Generation Integrative Online Learning"></a>
            </div>
            
            <div class="collapse navbar-collapse navstyle" id="nav-bso">
              <ul class="nav navbar-nav">
                
				<?php 
				if (isset($_SESSION['akses'])){
					if (count($_SESSION['akses']) > 0){
						if (isset($_SESSION['akses']['reguler'])){
							$paketaktif = $_SESSION['akses']['reguler'][0]; 
						} else if (isset($_SESSION['akses']['premium'])){
							$paketaktif = $_SESSION['akses']['premium'][0]; 
						}
					} else {
						$paketaktif = 0;
					}
				} else {
					$paketaktif = 0;
				}
				?>
				
				<?php if ($paketaktif >= 4 && $paketaktif <= 6 || $paketaktif == 0){ ?>				
                <li class="dropdown menu-large">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">SD 
                  <span class="caret"></span></a>
                  <ul class="dropdown-menu megamenu row">
                    <?php if ($paketaktif == 4 || $paketaktif == 0){ ?>
                    <li class="col-sm-4">
                      <ul>
                        <li class="dropdown-header">Kelas 4</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==4){
                            ?>
                            <li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; } else { echo 'javascript:void(0);'; } ?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
                          }
                        }?>
                      </ul>
                    </li>
                    <?php } ?>
                    <?php if ($paketaktif == 5 || $paketaktif == 0){ ?>
                    <li class="col-sm-4">
                      <ul>
                        <li class="dropdown-header">Kelas 5</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==5){
                            ?>
                            <li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; } else { echo 'javascript:void(0);'; } ?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
                          }
                        }?>
                      </ul>
                    </li>
                    <?php } ?>
                    <?php if ($paketaktif == 6 || $paketaktif == 0){ ?>
                    <li class="col-sm-4">
                      <ul>
                        <li class="dropdown-header">Kelas 6</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==6){
                            ?>
                            <li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; } else { echo 'javascript:void(0);'; } ?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
                          }
                        }?>
                      </ul>
                    </li>
					<?php } ?>
                  </ul>
                </li>
                <?php } ?>

				<?php if ($paketaktif >= 7 && $paketaktif <= 9 || $paketaktif == 0){ ?>
                <li class="dropdown menu-large">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">SMP
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu megamenu row">
                    <?php if ($paketaktif == 7 || $paketaktif == 0){ ?>
                    <li class="col-sm-4">
                      <ul>
                        <li class="dropdown-header">Kelas 7</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==7){
                            ?>
                            <li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; } else { echo 'javascript:void(0);'; } ?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
                          }
                        }?>
						          </ul>
                    </li>
                    <?php } ?>
                    <?php if ($paketaktif == 8 || $paketaktif == 0){ ?>
                    <li class="col-sm-4">
                      <ul>
                        <li class="dropdown-header">Kelas 8</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==8){
                            ?>
                            <li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; } else { echo 'javascript:void(0);'; } ?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
                          }
                        }?>
						          </ul>
                    </li>
                    <?php } ?>
                    <?php if ($paketaktif == 9 || $paketaktif == 0){ ?>
					<li class="col-sm-4">
						<ul>
                        <li class="dropdown-header">Kelas 9</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==9){
                            ?>
                            <li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; } else { echo 'javascript:void(0);'; } ?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
                          }
                        }?>
						</ul>
                    </li>
                    <?php } ?>
                  </ul>
                </li>
                <?php } ?>
                   
				<?php if ($paketaktif >= 19 && $paketaktif <= 24 || $paketaktif == 0){ ?>
                <li class="dropdown menu-large">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">SMA
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu megamenu row">
					  
					<?php if ($paketaktif >= 23 && $paketaktif <= 24 || $paketaktif == 0){ ?>  
                    <li class="col-sm-4">
                      <ul>
						<?php if ($paketaktif == 23 || $paketaktif == 0){ ?>
                        <li class="dropdown-header">Kelas 10 IPA</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==10){
														if( strpos( $mapel->nama_mapel, 'IPA' ) == true ) {
                            ?>
                            <li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; } else { echo 'javascript:void(0);'; } ?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
														}
                          }
                        }?>
                        <?php } ?>
						<?php if ($paketaktif == 24 || $paketaktif == 0){ ?>
                        <li class="dropdown-header">Kelas 10 IPS</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==10){
														if( strpos( $mapel->nama_mapel, 'IPS' ) == true ) {
                            ?>
                            <li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; } else { echo 'javascript:void(0);'; } ?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
														}
                          }
                        }?>
                        <?php } ?>
						</ul>
                    </li>
					<?php } ?>
					<?php if ($paketaktif >= 21 && $paketaktif <= 22 || $paketaktif == 0){ ?>  
					<li class="col-sm-4">
                      <ul>
						<?php if ($paketaktif == 21 || $paketaktif == 0){ ?>
                        <li class="dropdown-header">Kelas 11 IPA</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==11){
														if( strpos( $mapel->nama_mapel, 'IPA' ) == true ) {
                            ?>
                            <li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; } else { echo 'javascript:void(0);'; } ?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
														}
                          }
                        }?>
                        <?php } ?>
						<?php if ($paketaktif == 22 || $paketaktif == 0){ ?>
                        <li class="dropdown-header">Kelas 11 IPS</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==11){
														if( strpos( $mapel->nama_mapel, 'IPS' ) == true ) {
                            ?>
                            <li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; } else { echo 'javascript:void(0);'; } ?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
														}
                          }
                        }?>
                        <?php } ?>
						</ul>
                    </li>
					<?php } ?>
					<?php if ($paketaktif >= 19 && $paketaktif <= 20 || $paketaktif == 0){ ?>  
					<li class="col-sm-4">
                      <ul>
						<?php if ($paketaktif == 19 || $paketaktif == 0){ ?>
                        <li class="dropdown-header">Kelas 12 IPA</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==12){
														if( strpos( $mapel->nama_mapel, 'IPA' ) == true ) {
                            ?>
                            <li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; } else { echo 'javascript:void(0);'; } ?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
														}
                          }
                        }?>
                        <?php } ?>
						<?php if ($paketaktif == 20 || $paketaktif == 0){ ?>
                        <li class="dropdown-header">Kelas 12 IPS</li>
                        <?php foreach ($navbar_links as $mapel) {
                          if($mapel->tingkatan_kelas==12){
														if( strpos( $mapel->nama_mapel, 'IPS' ) == true ) {
                            ?>
                            <li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; } else { echo 'javascript:void(0);'; } ?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
                            <?php
														}
                          }
                        }?>
                        <?php } ?>
						</ul>
                    </li>
					<?php } ?>

                  </ul>
                </li>
                <?php } ?>
                
                <?php if ($paketaktif >= 37 && $paketaktif <= 38 || $paketaktif == 0){ ?>
				<li class="dropdown menu-large">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">SBMPTN
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu megamenu row">
						<?php if ($paketaktif == 37 || $paketaktif == 0){ ?>
						<li class="col-sm-6">
								<ul>
									<li class="dropdown-header">SOSHUM</li>
								<?php foreach ($navbar_links as $mapel) {
									if($mapel->tingkatan_kelas==13 && $mapel->kelas_id==37){
										?>
										<li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; } else { echo 'javascript:void(0);'; } ?>"><?php echo $mapel->nama_mapel ?></a></li>
										<?php
									}
								}?>
								</ul>
						</li>
                        <?php } ?>
						<?php if ($paketaktif == 38 || $paketaktif == 0){ ?>
						<li class="col-sm-6">
								<ul>
									<li class="dropdown-header">SAINTEK</li>
												<?php foreach ($navbar_links as $mapel) {
													if($mapel->tingkatan_kelas==13 && $mapel->kelas_id==38){
														?>
														<li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url() . "materi/tabel_konten/$mapel->id_mapel"; } else { echo 'javascript:void(0);'; } ?>"><?php echo $mapel->nama_mapel ?></a></li>
														<?php
													}
												}?>
								</ul>
						</li>
                        <?php } ?>
					</ul>
				</li>
                <?php } ?>

                <?php if(empty($_SESSION['id_siswa'])) { ?>
				<li><a href="<?php echo base_url() . "beli-paket";?>">BELI PAKET</a></li>
				<li><a href="<?php echo base_url() . "kontak";?>">KONTAK KAMI</a></li>
                <?php } ?>
				
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
                    <ul class="dropdown-menu dropdown-paket">
					  <li><a href="<?php echo base_url('user/dashboard');?>">Dashboard</a></li>
                      <li><a href="<?php echo base_url('user');?>">Profilku</a></li>
                      <li><a href="<?php echo base_url('user/ubah_profil');?>">Ubah Profil</a></li>
                      <li><a href="<?php echo base_url('user/logout');?>">Logout</a></li>
                    </ul>
                  </li>
                <?php 
                } 
                else { ?>
                  <li><a href="<?php if(!empty($_SESSION['id_siswa'])) { echo base_url('pencarian'); } else { echo 'javascript:void(0);'; } ?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
                  <li><a href="<?php echo base_url('login')?>">LOGIN/DAFTAR</a></li>
                <?php 
                } ?>
              </ul>
             </div>
          </div>
        </div>
