<div class="row">
	<div class="col-sm-6">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td colspan="2" class="text-center"><strong>Sumber</strong></td>
				</tr>
				<tr>
					<td>
						Kelas
					</td>
					<td>
						<?php echo $mapok->alias_kelas;?>
					</td>
				</tr>
				<tr>
					<td>
						Kurikulum
					</td>
					<td>
						<?php echo $kurikulumold;?>
					</td>
				</tr>
				<tr>
					<td>
						Mata Pelajaran
					</td>
					<td>
						<?php echo $mapok->nama_mapel;?>
					</td>
				</tr>
				<tr>
					<td>
						Materi Pokok
					</td>
					<td>
						<?php
						if($kurikulumold == "K-13" or $kurikulumold == "K-13 REVISI"){
							echo $mapok->judul_bab_k13;
						}elseif($kurikulumold == "KTSP"){
							echo $mapok->judul_bab_ktsp;
						}
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="text-center"><strong>Transfer ke</strong></td>
				</tr>
				<tr>
					<td>
						Kelas
					</td>
					<td>
						<?php echo $kelas->alias_kelas;?>
					</td>
				</tr>
				<tr>
					<td>
						Kurikulum
					</td>
					<td>
						<?php echo $kurikulum->nama_kurikulum;?>
					</td>
				</tr>
				<tr>
					<td>
						Mata Pelajaran
					</td>
					<td>
						<?php echo $mapel->nama_mapel;?>
					</td>
				</tr>
				<tr>
					<td>
						Bab
					</td>
					<td>
						<?php echo $bab;?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-sm-6">
		<ul>
			<li>Bab yang di transfer akan otomatis mengubah rencana belajar siswa yang tersimpan</li>
		</ul>
		<button class="btn btn-sm btn-success btn-proses-transfer-bab" style="width: 100%;">
			Proses transfer
		</button>
	</div>
</div>