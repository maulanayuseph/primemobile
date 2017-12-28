<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center" style="width: 10px;">No.</th>
					<th class="text-center">Nama Siswa</th>
					<th class="text-center">Status</th>
					<th class="text-center">Nilai</th>
					<th class="text-center">Operasi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$x = 1;
					foreach($datasiswa as $siswa){
						?>
						<tr>
							<td><?php echo $x;?></td>
							<td><?php echo $siswa->nama_siswa;?></td>
							<td class="text-center">
							<?php
								$caristatus = $this->model_pr->fetch_status_pr($infopr->id_pr, $siswa->id_siswa);
								if($caristatus == null){
									?>
									<span class="label label-danger">Belum Mengerjakan</span>
									<?php
								}elseif($caristatus->status == 0){
									?>
									<span class="label label-danger">Belum Mengerjakan</span>
									<?php
								}elseif($caristatus->status == 2){
									?>
									<span class="label label-success">Selesai</span>
									<?php
								}elseif($caristatus->status == 1){
									?>
									<span class="label label-warning">Menunggu Koreksi</span>
									<?php
								}
							?>
							</td>
							<td class="text-center">
								<?php
									if($caristatus == null){
										echo 0;
									}elseif($caristatus->status == '0' or $caristatus->status == '1'){
										echo 0;
									}else{
										$jumlahsoal = $this->model_pr->fetch_jumlah_soal_essai_by_pr($infopr->id_pr);
										$jumlahbenar = $this->model_pr->fetch_benar_essai_by_siswa($infopr->id_pr, $siswa->id_siswa);
										if($jumlahsoal == 0){
											$nilai = 0;
										}else{
											$nilai = ($jumlahbenar / $jumlahsoal) * 100;
										}
										echo $nilai;
									}
									
								?>
							</td>
							<td class="text-center">
								<?php
									if($caristatus == null){
										echo "-";
									}elseif($caristatus->status == '0'){
										echo "-";
									}else{
										?>
										<a href="<?php echo base_url("psep_sekolah/pr/detail_essai/" . $infopr->id_pr . "/" . $siswa->id_siswa);?>" class="btn btn-sm btn-success"><i class="fa fa-th-list" aria-hidden="true"></i></a>
										<?php
									}
								?>
							</td>
						</tr>
						<?php
						$x++;
					}
				?>
			</tbody>
		</table>
	</div>
</div>