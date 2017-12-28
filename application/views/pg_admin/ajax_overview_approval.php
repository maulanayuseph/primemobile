<div class="table-responsive">
	<table id="" class="table table-striped table-hover display">
		<thead>
			<tr>
				<th>Materi</th>
				<th style="width: 50px;">Jumlah Antrian Approval</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach($antrikelas as $kelas){
					?>
					<tr>
						<td>
							<strong><?php echo $kelas->alias_kelas;?></strong>
						</td>
						<td>
						</td>
					</tr>
					<?php
					foreach($antrimapel as $mapel){
						if($mapel->id_kelas == $kelas->id_kelas){
							?>
							<tr>
								<td>
									<strong><?php echo $mapel->nama_mapel;?></strong>
								</td>
								<td>
								</td>
							</tr>
							<?php
							foreach($antrimapok as $mapok){
								if($mapok->mapel_id == $mapel->id_mapel){
									?>
									<tr>
										<td>
											<?php echo $mapok->nama_materi_pokok;?>
										</td>
										<td>
										<?php
											$carijumlahantri = $this->model_kurikulum->fetch_jumlah_antri_by_mapok($mapok->id_materi_pokok);
											
											echo $carijumlahantri;
										?> Soal
										</td>
									</tr>
									<?php
								}
							}
						}
					}
				}
			?>
		</tbody>
	</table>
</div>