<?php
//cari jumlah tiap kelas paralel
$jumlahsiswa = 0;
foreach($datakelasparalel as $kelaspar){
	$jumlahperkelas = $this->model_kontrak->jumlah_siswa_kelas_paralel($kelaspar->id_kelas_paralel, $tahunajaran->id_tahun_ajaran);
	$jumlahsiswa +=$jumlahperkelas;
}
?>
<tr>
	<td>
		<strong><?php echo $kelas->alias_kelas;?> (<?php echo $tahunajaran->tahun_ajaran;?>)</strong>
		<input type="hidden" name="kelas-tahun" class="input-kelas-tahun" value="<?php echo $kelas->id_kelas;?>-<?php echo $tahunajaran->id_tahun_ajaran;?>">
	</td>
	<td class="text-center">
		<?php
			echo $jumlahsiswa;
		?>
	</td>
	<td>
		<input type="number" name="harga-<?php echo $kelas->id_kelas;?>-<?php echo $tahunajaran->id_tahun_ajaran;?>" class="form-control input-harga-kelas" id="harga-<?php echo $kelas->id_kelas;?>-<?php echo $tahunajaran->id_tahun_ajaran;?>">
	</td>
	<td id="detail-tagihan-<?php echo $kelas->id_kelas;?>-<?php echo $tahunajaran->id_tahun_ajaran;?>">
		
	</td>
</tr>