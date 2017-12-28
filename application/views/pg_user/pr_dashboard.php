<?php
if($tahunajaran !== null){
	?>
		<div class="content">
			<div class="tabel-analisa waktu">
				<div class="title"><img src="<?php echo base_url('assets/dashboard/images/file.png'); ?>">Tugas</div>
			</div>
		</div>
		<div class="row">
		<div class="col-lg-12">
			<table class="table display table-responsive table-bordered table-striped">
				<thead>
					<tr>
						<th style="width: 10px;">#</th>
						<th class="text-center">Tugas</th>
						<th class="text-center">Status</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				//cari kelas dan tahun ajaran siswa
				$carikelasparalel = $this->model_pr->fetch_kelas_siswa($this->session->userdata("id_siswa"));
				if($carikelasparalel !== null){
					$x = 1;
					foreach($carikelasparalel as $kelassiswa){
						//cari pr berdasarkan kelas dan tahun ajaran
						$today = date("Y-m-d H:i:s");
						$caripr = $this->model_pr->fetch_pr_by_kelas_and_tahun_ajaran($kelassiswa->id_kelas_paralel, $kelassiswa->id_tahun_ajaran);
						foreach($caripr as $pr){

							$aksesstart = date("Y-m-d H:i:s", strtotime($pr->akses_start));

							$aksesend = date("Y-m-d H:i:s", strtotime($pr->akses_end));

							$bahasdate = date("Y-m-d H:i:s", strtotime($pr->bahas_start));

							if($aksesstart <= $today and $aksesend >= $today){
								$statusakses = "bisa";
							}else{
								$statusakses = "tidak";
							}

							if($bahasdate <= $today){
								$statusbahas = "bisa";
							}else{
								$statusbahas = "tidak";
							}
							?>
							<tr>
								<td><?php echo $x;?></td>
								<td>
									<strong><?php echo $pr->nama_pr;?></strong>
									<br>Tipe Tugas : 
									<?php
										if($pr->tipe == 1){
											echo "Pilihan Ganda";
										}elseif($pr->tipe == 2){
											echo "Jawaban Eksak";
										}elseif($pr->tipe == 3){
											echo "Jawaban Essai";
										}
									?> | Jumlah Soal : 
									<?php
										$jumlah = $this->model_pr->jumlah_soal_by_tipe($pr->id_pr);
										echo $jumlah;
									?>
								</td>
								<td class="text-center">
									<?php
										if($statusakses == "bisa"){
											echo '<span class="label label-success">Akses Tugas Dibuka</span>';
										}elseif($pr->akses == 1){
											echo '<span class="label label-danger">Akses Tugas Ditutup</span>';
										}
									?>
								</td>
								<td class="text-center">
									<?php
										$caristatuspr = $this->model_pr->fetch_status_pr($pr->id_pr, $this->session->userdata('id_siswa'));
										
										if($caristatuspr == null){
											if($statusakses == "tidak"){
												echo "-";
											}elseif($statusakses == "bisa"){
												if($pr->tipe == 1){
													?>
													<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai/".$pr->id_pr);?>">Kerjakan Tugas</a>
													<?php
												}elseif($pr->tipe == 2){
													?>
													<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai_eksak/".$pr->id_pr);?>">Kerjakan Tugas</a>
													<?php
												}elseif($pr->tipe == 3){
													?>
													<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai_essai/".$pr->id_pr);?>">Kerjakan Tugas</a>
													<?php
												}
											}
										}else{
											if($statusakses == "tidak" and $statusbahas == "tidak"){
												if($pr->tipe == 1){
													if($caristatuspr->status == 0){
														echo '<span class="label label-danger">Akses Tugas dan Pembahasan Ditutup</span>';
													}elseif($caristatuspr->status == 1){
														echo '<span class="label label-danger">Akses Pembahasan Ditutup</span>';
													}
												}elseif($pr->tipe == 2){
													if($caristatuspr->status == 0){
														echo '<span class="label label-danger">Akses Tugas dan Pembahasan Ditutup</span>';
													}elseif($caristatuspr->status == 1){
														echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
													}elseif($caristatuspr->status == 2){
														echo '<span class="label label-danger">Akses Pembahasan Ditutup</span>';
													}
												}elseif($pr->tipe == 3){
													if($caristatuspr->status == 0){
														echo '<span class="label label-danger">Akses Tugas dan Pembahasan Ditutup</span>';
													}elseif($caristatuspr->status == 1){
														echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
													}elseif($caristatuspr->status == 2){
														echo '<span class="label label-danger">Akses Pembahasan Ditutup</span>';
													}
												}
											}elseif($statusakses == "bisa" and $statusbahas == "tidak"){
												if($pr->tipe == 1){
													if($caristatuspr->status == 0){
														?>
														<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai/".$pr->id_pr);?>">Lanjutkan Tugas</a>
														<?php
													}elseif($caristatuspr->status == 1){
														echo '<span class="label label-danger">Akses Pembahasan Ditutup</span>';
													}
												}elseif($pr->tipe == 2){
													if($caristatuspr->status == 0){
														?>
														<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai_eksak/".$pr->id_pr);?>">Lanjutkan Tugas</a>
														<?php
													}elseif($caristatuspr->status == 1){
														echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
													}elseif($caristatuspr->status == 2){
														echo '<span class="label label-danger">Akses Pembahasan Ditutup</span>';
													}
												}elseif($pr->tipe == 3){
													if($caristatuspr->status == 0){
														?>
														<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai_essai/".$pr->id_pr);?>">Lanjutkan Tugas</a>
														<?php
													}elseif($caristatuspr->status == 1){
														echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
													}elseif($caristatuspr->status == 2){
														echo '<span class="label label-danger">Akses Pembahasan Ditutup</span>';
													}
												}
											}elseif($statusakses == "tidak" and $statusbahas == "bisa"){
												if($pr->tipe == 1){
													if($caristatuspr->status == 0){
														?>
														<a class="btn btn-success btn-kelas" href="<?php echo  base_url("pr/statistik/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
														<?php
													}elseif($caristatuspr->status == 1){
														?>
														<a class="btn btn-success btn-kelas" href="<?php echo  base_url("pr/statistik/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
														<?php
													}
												}elseif($pr->tipe == 2){
													if($caristatuspr->status == 0){
														?>
														<a class="btn btn-success btn-kelas" href="<?php echo  base_url("pr/statistik_eksak/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
														<?php
													}elseif($caristatuspr->status == 1){
														echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
													}elseif($caristatuspr->status == 2){
														?>
														<a class="btn btn-success btn-kelas" href="<?php echo  base_url("pr/statistik_eksak/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
														<?php
													}
												}elseif($pr->tipe == 3){
													if($caristatuspr->status == 0){
														?>
														<a class="btn btn-success btn-kelas" href="<?php echo  base_url("pr/statistik_essai/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
														<?php
													}elseif($caristatuspr->status == 1){
														echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
													}elseif($caristatuspr->status == 2){
														?>
														<a class="btn btn-success btn-kelas" href="<?php echo  base_url("pr/statistik_essai/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
														<?php
													}
												}
											}elseif($statusakses == "bisa" and $statusbahas == "bisa"){
												if($pr->tipe == 1){
													if($caristatuspr->status == 0){
														?>
														<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai/".$pr->id_pr);?>">Lanjutkan Tugas</a>
														<?php
													}elseif($caristatuspr->status == 1){
														?>
														<a class="btn btn-success btn-kelas" href="<?php echo  base_url("pr/statistik/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
														<?php
													}
												}elseif($pr->tipe == 2){
													if($caristatuspr->status == 0){
														?>
														<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai_eksak/".$pr->id_pr);?>">Lanjutkan Tugas</a>
														<?php
													}elseif($caristatuspr->status == 1){
														echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
													}elseif($caristatuspr->status == 2){
														?>
														<a class="btn btn-success btn-kelas" href="<?php echo  base_url("pr/statistik_eksak/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
														<?php
													}
												}elseif($pr->tipe == 3){
													if($caristatuspr->status == 0){
														?>
														<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai_essai/".$pr->id_pr);?>">Lanjutkan Tugas</a>
														<?php
													}elseif($caristatuspr->status == 1){
														echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
													}elseif($caristatuspr->status == 2){
														?>
														<a class="btn btn-success btn-kelas" href="<?php echo  base_url("pr/statistik_essai/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
														<?php
													}
												}
											}
										}
									?>
								</td>
							</tr>
							<?php
							$x++;
						}
					}
				}
				?>
				</tbody>
			</table>
		</div>
		</div>
	<?php
}
?>