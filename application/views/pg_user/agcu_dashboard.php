<?php
$tanggalsekarang = $tanggalsekarang = date('Y-m-d');

if($infosiswa->kurikulum == ""){
	
}else{
	$cariagcuaktif = $this->model_agcu->fetch_agcu_aktif($kelasaktif->id_kelas, $infosiswa->kurikulum, $tanggalsekarang);

	if($cariagcuaktif !== null){
		?>
		<div class="agcu-welcome">
	        <div class="content" id="mulai-agcu">
	          <h4>Selamat Datang, <?php echo $infosiswa->nama_siswa; ?></h4>
	          <p>Ketahui tipe kepribadian, kondisi psikologis, potensi akademik dan minat belajar anda dengan mengikuti Academic General Check Up (AGCU) Test. Dengan mengikuti AGCU test, anda akan mendapatkan saran metode belajar yang sesuai dengan tipe kepribadian yang anda miliki. </p>
	          <?php
				if($status_siswa == "tidak_aktif"){
			  ?>
				<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#aktivasiagcu">
				  Mulai AGCU
				</button>
			  <?php
				}else{
			  ?>
				<a href="../agcutest/home/<?php echo $cariagcuaktif->id_profil_diagnostic;?>" class="btn btn-primary">Mulai AGCU</a>
			  <?php
				}
			  ?>
	        </div>
			<img class="image" src="<?php echo base_url('assets/dashboard/images/why2.jpg'); ?>" style="float: right;">
	     </div>
		<?php
	}
}
?>