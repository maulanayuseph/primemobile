<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#tabnasional" aria-controls="tabnasional" role="tab" data-toggle="tab">Nasional</a></li>
	<li role="presentation"><a href="#tabprovinsi" aria-controls="tabprovinsi" role="tab" data-toggle="tab">Provinsi</a></li>
	<li role="presentation"><a href="#tabregional" aria-controls="tabregional" role="tab" data-toggle="tab">Regional</a></li>
	<li role="presentation"><a href="#tabsekolah" aria-controls="tabsekolah" role="tab" data-toggle="tab">Sekolah</a></li>
</ul>
<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="tabnasional">
		<div class="col-sm-12" style="text-align: right;">
			<br>
			<a href="<?php echo base_url("pg_admin/event/download_excel_nasional/" . $idprofil);?>" target="_BLANK">Download Excel</a>
			<br>
			<br>
		</div>
		<div class="col-sm-12" style="overflow-x: scroll;">
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
						?>
							<tr>
								<td><?php echo $no; ?></td>
								<td id="<?php echo $peringkat->id_siswa;?>">
									<?php
									if($datasiswa->foto !== ""){
									?>
									<img src="<?php echo base_url('assets/uploads/foto_siswa/'.$datasiswa->foto); ?>" style="width: 75px;"></img>
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
									echo $datasiswa->nama_siswa;
								?>
								</td>
								
								<td class="text-center">
									<?php echo $datasiswa->nama_sekolah; ?><br> <?php echo $datasiswa->nama_kota; ?> - <?php echo $datasiswa->nama_provinsi; ?>
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
				?>
			</tbody>
		</table>
		</div>
	</div>
	<div role="tabpanel" class="tab-pane" id="tabprovinsi">
		<div class="col-sm-6">
			<select class="form-control" id="select-prov">
				<option value="">-- Pilih Provinsi --</option>
				<?php
					foreach($dataprovinsi as $provinsi){
						?>
						<option value="<?php echo $provinsi->id_provinsi;?>"><?php echo $provinsi->nama_provinsi;?></option>
						<?php
					}
				?>
			</select>
		</div>
		<div class="col-sm-6">
			<button class="btn btn-sm btn-danger filter-rank-prov" style="width: 100%;">Filter Peringkat</button>
		</div>
		<div class="col-sm-12 konten-rank-provinsi" style="overflow-x: scroll;">
			
		</div>
	</div>
	<div role="tabpanel" class="tab-pane" id="tabregional">
		<div class="col-sm-6">
			<select class="form-control" id="select-wilayah">
				<option value="">-- Pilih Wilayah --</option>
				<?php
					foreach($datawilayah as $wilayah){
						?>
						<option value="<?php echo $wilayah->id_wilayah;?>"><?php echo $wilayah->nama_wilayah;?></option>
						<?php
					}
				?>
			</select>
		</div>
		<div class="col-sm-6">
			<button class="btn btn-sm btn-danger filter-rank-wilayah" style="width: 100%;">Filter Peringkat</button>
		</div>
		<div class="col-sm-12 konten-rank-wilayah" style="overflow-x: scroll;">
			
		</div>
	</div>
	<div role="tabpanel" class="tab-pane" id="tabsekolah">
		<div class="col-sm-3">
			<select class="form-control" id="select-prov-sekolah">
				<option value="">-- Pilih Provinsi --</option>
				<?php
					foreach($dataprovinsi as $provinsi){
						?>
						<option value="<?php echo $provinsi->id_provinsi;?>"><?php echo $provinsi->nama_provinsi;?></option>
						<?php
					}
				?>
			</select>
		</div>
		<div class="col-sm-3">
			<select class="form-control" id="select-kota-sekolah">
				<option value="">-- Pilih Kota --</option>
			</select>
		</div>
		<div class="col-sm-3">
			<select class="form-control" id="select-sekolah-sekolah">
				<option value="">-- Pilih Sekolah --</option>
			</select>
		</div>
		<div class="col-sm-3">
			<button class="btn btn-sm btn-danger filter-rank-sekolah" style="width: 100%;">Filter Peringkat</button>
		</div>
		<div class="col-sm-12 konten-rank-sekolah" style="overflow-x: scroll;">
			
		</div>
	</div>
</div>
<input type="hidden" id="idprofil" value="<?php echo $idprofil;?>">
<input type="hidden" id="idkelas" value="<?php echo $profil->id_kelas;?>">
<script type="text/javascript">
$(function(){
	$('table.display').DataTable();
});
</script>