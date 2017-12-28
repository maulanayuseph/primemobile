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
				foreach($antrimapel as $mapel){
					?>
					<tr>
						<td>
							<strong><?php echo $mapel->nama_mapel;?></strong>
						</td>
						<td>
						    <?php
    						//cari jumlah antrian approval per mapel
    						$carijumlahantrimapel = $this->model_kurikulum->fetch_jumlah_antri_by_mapel($mapel->id_mapel);
    						
    						?>
    							<strong><?php echo $carijumlahantrimapel;?></strong>
    						<?php
    						?>
						</td>
					</tr>
					<?php
					$mapokantri = $this->model_kurikulum->fetch_antri_mapok_by_mapel($mapel->id_mapel);
					foreach($mapokantri as $mapok){
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
			?>
		</tbody>
	</table>
</div>