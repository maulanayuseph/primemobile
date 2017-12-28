<div class="col-sm-12" style="text-align: right;">
	<br>
	<a href="<?php echo base_url("pg_admin/event/download_excel_sekolah/" . $idprofil . "/" . $idsekolah);?>" target="_BLANK">Download Excel</a>
	<br>
	<br>
</div>
<table class="table display table-striped table-bordered">
	<thead>
		<tr>
			<th style="width: 10px;">#</th>
			<th>Foto</th>
			<th>Nama Siswa</th>
			<th>Sekolah</th>
			<?php
				foreach($datakategori as $kategori){
					echo "
						<th>".$kategori->nama_kategori."</th>
					";
				}
			?>
			<th style="text-align: center;">Jumlah Nilai</th>
			<th style="text-align: center;">Skor</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no = 1;
			foreach($dataperingkat as $peringkat){
				
				$datasiswa = $this->model_dashboard->data_peringkat_psep($peringkat->id_siswa, $idprofil);
				
				
				if(isset($peringkat->waktu_kerja)){
					$waktu = round($peringkat->waktu_kerja / 60, 2);
				}else{
					$waktu = "-";
				}
				$fetchsiswa = $this->model_adm_event->fetch_siswa_by_id($peringkat->id_siswa);

				if($fetchsiswa->sekolah_id == $idsekolah){
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td>
							<?php
							if($fetchsiswa->foto !== ""){
							?>
							<img src="<?php echo base_url('assets/uploads/foto_siswa/'.$fetchsiswa->foto); ?>" style="width: 75px;"></img>
							<?php
							}else{
							?>
							<img src="<?php echo base_url('assets/dashboard/images/profile.jpg'); ?>" style="width: 75px;"></img>
							<?php
							}
							?>
						</td>
						<td>
						<?php 
							echo $fetchsiswa->nama_siswa;
						?>
						</td>
						
						<td class="text-center">
							<?php echo $fetchsiswa->nama_sekolah; ?><br> <?php echo $fetchsiswa->nama_kota; ?> - <?php echo $fetchsiswa->nama_provinsi; ?>
						</td>
						
						<?php
							$datanilai = $this->model_dashboard->rekap_nilai($idprofil, $peringkat->id_siswa);
						
							foreach($datanilai as $nilai){
							?>
								<td><?php echo number_format($nilai->jumlah_bobot_benar, 0, '.', '');?></td>
							<?php
							}
						?>
						
						<td class="text-center">
						<?php
							echo number_format($peringkat->jumlah_bobot_benar, 0, '.', '');
						?>
						</td>
						<td class="text-center"><?php echo number_format(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 0, '.', ''); ?>%</td>
					</tr>
					<?php
					$no++;
				}
			}
		?>
	</tbody>
</table>
<script type="text/javascript">
$(function(){
	$('table.display').DataTable();
});
</script>