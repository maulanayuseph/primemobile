<div class="col-sm-6" style="font-style: italic;">
	Berikut adalah mata pelajaran yang diujikan, jika KKM sekolah statusnya adalah "not set" maka KKM yang digunakan adalah KKM yang telah ditetapkan oleh Prime Mobile
	<br>&nbsp;
</div>
<div class="col-sm-12">
	<table class="table table-responsive table-bordered table-striped">
		<thead>
			<tr>
				<th class="text-center">Mata Pelajaran</th>
				<th class="text-center">Jumlah Soal</th>
				<th class="text-center">Durasi</th>
				<th class="text-center">KKM</th>
				<th class="text-center">KKM Sekolah</th>
				<th class="text-center">Operasi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($datakategori as $kategori){
				$jumlah = $this->model_tryout->fetch_jumlah_soal_by_kategori($kategori->id_kategori);
				?>
					<tr>
						<td><?php echo $kategori->nama_kategori;?></td>
						<td class="text-center"><?php echo $jumlah;?> Soal</td>
						<td class="text-center"><?php echo $kategori->durasi;?> Menit</td>
						<td class="text-center"><?php echo $kategori->ketuntasan;?></td>
						<td class="text-center">
							<?php
							//cari apakah KKM sekolah sudah di set
							$kkm = $this->model_psep_cbt->cek_kkm($kategori->id_kategori, $this->session->userdata("idsekolah"));
							if($kkm !== null){
								echo $kkm->ketuntasan;
							}else{
								echo "not set";
							}
							?>
						</td>
						<td class="text-center">
							<button class="btn btn-sm btn-danger set-kkm" id="kkm-<?php echo $kategori->id_profil;?>-<?php echo $kategori->id_kategori;?>">Set KKM</button>
						</td>
					</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
$(function(){
	$(".set-kkm").click(function(){
		rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idprofil 	= idsplit[1];
		idkategori 	= idsplit[2];

		$("#mainmodalcontent").load("set_kkm/" + idprofil + "/" + idkategori);
	})
})
</script>