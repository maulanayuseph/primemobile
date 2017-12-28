<div class="row">
	<div class="col-sm-4 kiri-char-sekolah">
		<img src="<?php echo base_url("assets/cbt2017/image/jump2.png");?>" class="img img-responsive"/>
	</div>
	<div class="col-sm-8">
		<h1>Selamat, <?php echo $this->session->userdata("nama");?></h1>
		<h3>Tinggal selangkah lagi, daftarkan sekolahmu untuk menyelesaikan pendaftaran
		</h3>
		<br>&nbsp;
		<br>
		<div class="col-sm-6">
			<select class="form-control" id="regprovinsi">
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
			<select class="form-control" id="regkota">
				<option value="">-- Pilih Kota --</option>
			</select>
		</div>
		<div class="col-sm-12">
			&nbsp;
		</div>
		<div class="col-sm-6">
			<select class="form-control" id='regjenjang'>
				<option value="">-- Pilih Jenjang --</option>
				<option value="SD">SD</option>
				<option value="SMP">SMP</option>
				<option value="SMA">SMA</option>
			</select>
		</div>
		<div class="col-sm-6">
			<select class="form-control" id='regsekolah'>
				<option value="">-- Pilih Sekolah --</option>
			</select>
		</div>
		<div class="col-sm-12">
			&nbsp;
		</div>
		<div class="col-sm-12" style="text-align: right;">
			<a role="button" id="tidakketemusekolah">Tidak menemukan sekolahmu? Klik Di Sini</a>
		</div>
		<div class="col-sm-12">
			&nbsp;
		</div>
		<div class="col-sm-6 sekolah-baru" style="display: none;">
			<input type="text" class="form-control" id="regsekolahbaru" placeholder="Masukkan Nama Sekolah" />
		</div>
		<div class="col-sm-6 cancel-sekolah-baru" style="display: none;">
			<button class="btn btn-sm btn-danger" id="cancelsekolahbaru" style="width: 100%;">Batal</button>
		</div>
		<div class="col-sm-12">
			&nbsp;
		</div>
		<div class="col-sm-12">
			<button class="btn btn-sm btn-danger" id="submitsekolah" style="width: 100%;">Selesai</button>
		</div>
		<div class="col-sm-12">
			&nbsp;
		</div>
	</div>
</div>