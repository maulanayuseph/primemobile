
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
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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
											if($mapel->tingkatan_kelas==6 && $mapel->kelas_id == 6){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
											}
										}?>
										<li class="dropdown-header">US/M SD</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==6 && $mapel->kelas_id == 39){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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
											if($mapel->tingkatan_kelas==9 && $mapel->kelas_id == 9){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
											}
										}?>
										<li class="dropdown-header">UN SMP</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==9 && $mapel->kelas_id == 41){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
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
											if($mapel->tingkatan_kelas==12 && $mapel->kelas_id == 19){
												if( strpos( $mapel->nama_mapel, 'IPA' ) == true ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
												}
											}
										}?>
										<li class="dropdown-header">UN SMA IPA</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==12 && $mapel->kelas_id == 42){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
											}
										}?>
									<?php } ?>
									<?php if ($paketaktif == 20 || $paketaktif == 0){ ?>
										<li class="dropdown-header">Kelas 12 IPS</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==12 && $mapel->kelas_id == 20){
												if( strpos( $mapel->nama_mapel, 'IPS' ) == true ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
												}
											}
										}?>
										<li class="dropdown-header">UN SMA IPS</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==12 && $mapel->kelas_id == 43){
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?> Kelas <?php echo $mapel->tingkatan_kelas ?></a></li>
												<?php
											}
										}?>
									<?php } ?>
									</ul>
								</li>
								<?php } ?>
									
							</ul>
						</li>
						<?php } ?>

						<?php if ($paketaktif >= 37 && $paketaktif <= 38 || $paketaktif == 0 || $paketaktif == 19 || $paketaktif == 20){ ?>
						<li class="dropdown menu-large">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">SBMPTN
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu megamenu row">
								<?php if ($paketaktif == 37 || $paketaktif == 0 || $paketaktif == 20){ ?>
								<li class="col-sm-12">
									<ul>
										<li class="dropdown-header">SOSHUM</li>
									</ul>
								</li>
								<li class="col-sm-6">
									<ul>
										<li class="dropdown-header">PREDIKSI 1</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==13 && $mapel->kelas_id==37){
												if( strpos( $mapel->nama_mapel, 'PREDIKSI 1' ) !== false ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?></a></li>
												<?php
												}
											}
										}?>
										<li class="dropdown-header">PREDIKSI 2</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==13 && $mapel->kelas_id==37){
												if( strpos( $mapel->nama_mapel, 'PREDIKSI 2' ) !== false ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?></a></li>
												<?php
												}
											}
										}?>
										<li>&nbsp;</li>
										<li class="dropdown-header">PEMBAHASAN</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==13 && $mapel->kelas_id==37){
												if( strpos( $mapel->nama_mapel, 'PEMBAHASAN' ) !== false ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?></a></li>
												<?php
												}
											}
										}?>
									</ul>
								</li>
								<li class="col-sm-6">
									<ul>
										<li class="dropdown-header">PREDIKSI 3</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==13 && $mapel->kelas_id==37){
												if( strpos( $mapel->nama_mapel, 'PREDIKSI 3' ) !== false ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?></a></li>
												<?php
												}
											}
										}?>
										<li class="dropdown-header">PREDIKSI 4</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==13 && $mapel->kelas_id==37){
												if( strpos( $mapel->nama_mapel, 'PREDIKSI 4' ) !== false ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?></a></li>
												<?php
												}
											}
										}?>
									</ul>
								</li>
								<?php } ?>
								<?php if ($paketaktif == 38 || $paketaktif == 0 || $paketaktif == 19){ ?>
								<li class="col-sm-12">
									<ul>
										<li class="dropdown-header">SAINTEK</li>
									</ul>
								</li>
								<li class="col-sm-6">
									<ul>
										<li class="dropdown-header">PREDIKSI 1</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==13 && $mapel->kelas_id==38){
												if( strpos( $mapel->nama_mapel, 'PREDIKSI 1' ) !== false ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?></a></li>
												<?php
												}
											}
										}?>
										<li class="dropdown-header">PREDIKSI 2</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==13 && $mapel->kelas_id==38){
												if( strpos( $mapel->nama_mapel, 'PREDIKSI 2' ) !== false ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?></a></li>
												<?php
												}
											}
										}?>
										<li>&nbsp;</li>
										<li class="dropdown-header">PEMBAHASAN</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==13 && $mapel->kelas_id==38){
												if( strpos( $mapel->nama_mapel, 'PEMBAHASAN' ) !== false ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?></a></li>
												<?php
												}
											}
										}?>
									</ul>
								</li>
								<li class="col-sm-6">
									<ul>
										<li class="dropdown-header">PREDIKSI 3</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==13 && $mapel->kelas_id==38){
												if( strpos( $mapel->nama_mapel, 'PREDIKSI 3' ) !== false ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?></a></li>
												<?php
												}
											}
										}?>
										<li class="dropdown-header">PREDIKSI 4</li>
										<?php foreach ($navbar_links as $mapel) {
											if($mapel->tingkatan_kelas==13 && $mapel->kelas_id==38){
												if( strpos( $mapel->nama_mapel, 'PREDIKSI 4' ) !== false ) {
												?>
												<li><a href="<?php echo base_url() . "materi/tabel_konten/$mapel->id_mapel";?>"><?php echo $mapel->nama_mapel ?></a></li>
												<?php
												}
											}
										}?>
									</ul>
								</li>
								<?php } ?>
							</ul>
						</li>
						<?php } ?>
						<?php
						    if ($paketaktif == 38 || $paketaktif == 0 || $paketaktif == 19 || $paketaktif == 37 || $paketaktif == 20){
						?>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Event
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
							     <li><a href="<?php echo base_url('sbmptn');?>">CBT SBMPTN</a></li>  
							</ul>
						</li>
						<?php
						    }
						?>