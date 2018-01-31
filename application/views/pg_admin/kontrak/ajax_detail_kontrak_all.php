<?php
foreach($datakelas as $kelas){

	$datakelasparalel = $this->model_kontrak->fetch_kelas_paralel_by_kelas_and_sekolah($sekolah->id_sekolah, $kelas->id_kelas);

	$jumlahsiswa[$kelas->id_kelas] = 0;
	foreach($datatahunajaran as $tahun){
		foreach($datakelasparalel as $kelaspar){
		//hitung siswa by kelas paralel and tahun ajaran
			$jumsis = $this->model_kontrak->jumlah_siswa_psep($kelaspar->id_kelas_paralel, $tahun->id_tahun_ajaran);

			$jumlahsiswa[$kelas->id_kelas] += $jumsis;
		}
	}
	
}
?>
<?php
foreach($datakelas as $kelas){
	?>
	<tr>
		<td>
			<strong><?php echo $kelas->alias_kelas;?></strong>
			<input type="hidden" name="kelas-tahun" class="input-kelas-tahun" value="<?php echo $kelas->id_kelas;?>-0">
		</td>
		<td class="text-center">
			<?php
				echo $jumlahsiswa[$kelas->id_kelas];
			?>
		</td>
		<td>
			<input type="number" name="harga-<?php echo $kelas->id_kelas;?>" class="form-control input-harga-kelas" id="harga-<?php echo $kelas->id_kelas;?>-0">


			<input type="hidden" name="periode-1-<?php echo $kelas->id_kelas;?>" id="periode-1-<?php echo $kelas->id_kelas;?>">
			<input type="hidden" name="periode-3-<?php echo $kelas->id_kelas;?>" id="periode-3-<?php echo $kelas->id_kelas;?>">
			<input type="hidden" name="periode-6-<?php echo $kelas->id_kelas;?>" id="periode-6-<?php echo $kelas->id_kelas;?>">
			<input type="hidden" name="periode-12-<?php echo $kelas->id_kelas;?>" id="periode-12-<?php echo $kelas->id_kelas;?>">
		</td>
		<td id="detail-tagihan-<?php echo $kelas->id_kelas;?>-0" style="width: 300px;">
			
		</td>
	</tr>
	<?php
}
?>
