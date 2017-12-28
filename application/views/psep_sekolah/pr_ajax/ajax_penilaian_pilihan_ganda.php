<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center">No.</th>
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
									<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
									<?php
								}else{
									if($caristatus->status == 0){
										?>
										<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
										<?php
									}elseif($caristatus->status == 1){
										?>
										<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
										<?php
									}elseif($caristatus->status == 2){
										?>
										<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
										<?php
									}
								}
							?>
							</td>
							<td class="text-center">
								<?php
									if($caristatus == null){
										echo 0;
									}else{
										if($caristatus->status == 0){
											?>
											0
											<?php
										}elseif($caristatus->status == 1){
											$jumlahsoal	 	= $this->model_pr->jumlah_soal($infopr->id_pr);
											$jumlahbenar 	= $this->model_pr->jumlah_benar_by_siswa_and_pr($infopr->id_pr, $siswa->id_siswa);
											if($jumlahsoal == 0){
												echo "0";
											}else{
												$nilai = ($jumlahbenar / $jumlahsoal) * 100;
												echo $nilai;
											}
										}elseif($caristatus->status == 2){
											?>
											0
											<?php
										}
									}
									
								?>
							</td>
							<td class="text-center">
								<?php
									if($caristatus == null){
										echo "-";
									}else{
										if($caristatus->status == 0){
											?>
											-
											<?php
										}elseif($caristatus->status == 1){
											?>
											<a href="<?php echo base_url("psep_sekolah/pr/detail/" . $infopr->id_pr . "/" . $siswa->id_siswa);?>" class="btn btn-sm btn-success"><i class="fa fa-th-list" aria-hidden="true"></i></a>

											<button class="btn btn-sm btn-danger reset-nilai" id="<?php echo $infopr->id_pr;?>-<?php echo $siswa->id_siswa;?>"><i class="fa fa-refresh" aria-hidden="true"></i></button>
											<?php
										}elseif($caristatus->status == 2){
											?>
											-
											<?php
										}
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