<?php $this->load->view("landing_page/cbt2017/header");?>
<style type="text/css">
	.besar tr td{
		font-weight: bold;
		color: #d10000;
	}
</style>
<div class="container">
	<div class="row konten-wrapper">
		<div class="col-sm-6">
			<a href="<?php echo base_url();?>">
			<img src="<?php echo base_url("assets/cbt2017/image/logoWhite.png");?>">
			</a>
		</div>
		<div class="col-sm-6">
			
		</div>
		<div class="col-sm-12 divider">
			&nbsp;
		</div>
		<div class="col-sm-12 title-tengah text-center">
			<h1>Pengumuman Perolehan 10 Peringkat Tertinggi Nasional</h1>
			<h3>Try Out Online US/M - UNBK Tingkat Nasional 2018</h3>
		</div>
	</div>
</div>

<!-- PERINGKAT NASIONAL SD -->
<div class="container">
	<div class="row konten-wrapper">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h3 class="panel-title">Peringkat Nasional Kelas 6 SD</h3>
				</div>
				<div class="panel-body" style="overflow-x: scroll;">
					<table class="table display table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Sekolah</th>
								<th class="text-center">Kota - Provinsi</th>
								<th class="text-center">Matematika</th>
								<th class="text-center">Bahasa Indonesia</th>
								<th class="text-center">IPA</th>
								<th class="text-center">Jumlah Nilai</th>
								<th class="text-center">Skor</th>
							</tr>
						</thead>
						<tbody class="besar">
							<?php
								$x = 1;
								foreach($nasionalsd as $sd){
									if($x <= 2){
									?>
									<tr>
										<td><?php echo $x;?></td>
										<td><?php echo $sd->nama;?></td>
										<td class="text-center"><?php echo $sd->sekolah;?></td>
										<td class="text-center"><?php echo $sd->kota;?> - <?php echo $sd->provinsi;?></td>
										<td class="text-center"><?php echo $sd->matematika;?></td>
										<td class="text-center"><?php echo $sd->bahasa_indonesia;?></td>
										<td class="text-center"><?php echo $sd->ipa;?></td>
										<td class="text-center"><?php echo $sd->jumlah;?></td>
										<td class="text-center"><?php echo $sd->skor;?></td>
									</tr>
									<?php
										if($x == 2){
											?>
											<tr>
												<td colspan="9" class="text-center"><a data-toggle="collapse" href="#panelsd" aria-expanded="false" aria-controls="panelsd">Lihat Peringkat Selanjutnya</a></td>
											</tr>
											<?php
										}
									?>
									<?php
									$x++;
									}
								}
							?>
						</tbody>
					</table>
					<div id="panelsd" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      					<div class="panel-body">
      						<table class="table display table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th class="text-center">Nama</th>
										<th class="text-center">Sekolah</th>
										<th class="text-center">Kota - Provinsi</th>
										<th class="text-center">Matematika</th>
										<th class="text-center">Bahasa Indonesia</th>
										<th class="text-center">IPA</th>
										<th class="text-center">Jumlah Nilai</th>
										<th class="text-center">Skor</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$x = 1;
										foreach($nasionalsd as $sd){
											if($x <= 10 and $x >= 3){
											?>
											<tr>
												<td><?php echo $x;?></td>
												<td><?php echo $sd->nama;?></td>
												<td class="text-center"><?php echo $sd->sekolah;?></td>
												<td class="text-center"><?php echo $sd->kota;?> - <?php echo $sd->provinsi;?></td>
												<td class="text-center"><?php echo $sd->matematika;?></td>
												<td class="text-center"><?php echo $sd->bahasa_indonesia;?></td>
												<td class="text-center"><?php echo $sd->ipa;?></td>
												<td class="text-center"><?php echo $sd->jumlah;?></td>
												<td class="text-center"><?php echo $sd->skor;?></td>
											</tr>
											<?php
											}
											$x++;
										}
									?>
								</tbody>
							</table>
      					</div>
      				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PERINGKAT NASIONAL SD -->

<!-- PERINGKAT NASIONAL SMP -->
<div class="container">
	<div class="row konten-wrapper">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h3 class="panel-title">Peringkat Nasional Kelas 9 SMP</h3>
				</div>
				<div class="panel-body" style="overflow-x: scroll;">
					<table class="table display table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Sekolah</th>
								<th class="text-center">Kota - Provinsi</th>
								<th class="text-center">Matematika</th>
								<th class="text-center">Bahasa Indonesia</th>
								<th class="text-center">Bahasa Inggris</th>
								<th class="text-center">IPA Terpadu</th>
								<th class="text-center">Jumlah Nilai</th>
								<th class="text-center">Skor</th>
							</tr>
						</thead>
						<tbody class="besar">
							<?php
								$x = 1;
								foreach($nasionalsmp as $smp){
									if($x <= 2){
									?>
									<tr>
										<td><?php echo $x;?></td>
										<td><?php echo $smp->nama;?></td>
										<td class="text-center"><?php echo $smp->sekolah;?></td>
										<td class="text-center"><?php echo $smp->kota;?> - <?php echo $smp->provinsi;?></td>
										<td class="text-center"><?php echo $smp->matematika;?></td>
										<td class="text-center"><?php echo $smp->bahasa_indonesia;?></td>
										<td class="text-center"><?php echo $smp->bahasa_inggris;?></td>
										<td class="text-center"><?php echo $smp->ipa_terpadu;?></td>
										<td class="text-center"><?php echo $smp->jumlah;?></td>
										<td class="text-center"><?php echo $smp->skor;?></td>
									</tr>
									<?php
										if($x == 2){
											?>
											<tr>
												<td colspan="10" class="text-center"><a data-toggle="collapse" href="#panelsmp" aria-expanded="false" aria-controls="panelsmp">Lihat Peringkat Selanjutnya</a></td>
											</tr>
											<?php
										}
									$x++;
									}
								}
							?>
						</tbody>
					</table>
					<div id="panelsmp" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      					<div class="panel-body">
      						<table class="table display table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th class="text-center">Nama</th>
										<th class="text-center">Sekolah</th>
										<th class="text-center">Kota - Provinsi</th>
										<th class="text-center">Matematika</th>
										<th class="text-center">Bahasa Indonesia</th>
										<th class="text-center">Bahasa Inggris</th>
										<th class="text-center">IPA Terpadu</th>
										<th class="text-center">Jumlah Nilai</th>
										<th class="text-center">Skor</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$x = 1;
										foreach($nasionalsmp as $smp){
											if($x <= 10 and $x >= 3){
											?>
											<tr>
												<td><?php echo $x;?></td>
												<td><?php echo $smp->nama;?></td>
												<td class="text-center"><?php echo $smp->sekolah;?></td>
												<td class="text-center"><?php echo $smp->kota;?> - <?php echo $smp->provinsi;?></td>
												<td class="text-center"><?php echo $smp->matematika;?></td>
												<td class="text-center"><?php echo $smp->bahasa_indonesia;?></td>
												<td class="text-center"><?php echo $smp->bahasa_inggris;?></td>
												<td class="text-center"><?php echo $smp->ipa_terpadu;?></td>
												<td class="text-center"><?php echo $smp->jumlah;?></td>
												<td class="text-center"><?php echo $smp->skor;?></td>
											</tr>
											<?php
											}
											$x++;
										}
									?>
								</tbody>
							</table>
      					</div>
      				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PERINGKAT NASIONAL SMP-->

<!-- PERINGKAT NASIONAL SMA IPA -->
<div class="container">
	<div class="row konten-wrapper">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h3 class="panel-title">Peringkat Nasional Kelas 12 SMA IPA</h3>
				</div>
				<div class="panel-body" style="overflow-x: scroll;">
					<table class="table display table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Sekolah</th>
								<th class="text-center">Kota - Provinsi</th>
								<th class="text-center">Matematika</th>
								<th class="text-center">Bahasa Indonesia</th>
								<th class="text-center">Bahasa Inggris</th>
								<th class="text-center">Fisika</th>
								<th class="text-center">Biologi</th>
								<th class="text-center">Kimia</th>
								<th class="text-center">Jumlah Nilai</th>
								<th class="text-center">Skor</th>
							</tr>
						</thead>
						<tbody class="besar">
							<?php
								$x = 1;
								foreach($nasionalsmaipa as $smp){
									if($x <= 2){
									?>
									<tr>
										<td><?php echo $x;?></td>
										<td><?php echo $smp->nama;?></td>
										<td class="text-center"><?php echo $smp->sekolah;?></td>
										<td class="text-center"><?php echo $smp->kota;?> - <?php echo $smp->provinsi;?></td>
										<td class="text-center"><?php echo $smp->matematika;?></td>
										<td class="text-center"><?php echo $smp->bahasa_indonesia;?></td>
										<td class="text-center"><?php echo $smp->bahasa_inggris;?></td>
										<td class="text-center"><?php echo $smp->fisika;?></td>
										<td class="text-center"><?php echo $smp->biologi;?></td>
										<td class="text-center"><?php echo $smp->kimia;?></td>
										<td class="text-center"><?php echo $smp->jumlah;?></td>
										<td class="text-center"><?php echo $smp->skor;?></td>
									</tr>
									<?php
										if($x == 2){
											?>
											<tr>
												<td colspan="12" class="text-center"><a data-toggle="collapse" href="#panelsmaipa" aria-expanded="false" aria-controls="panelsmaipa">Lihat Peringkat Selanjutnya</a></td>
											</tr>
											<?php
										}
									$x++;
									}
								}
							?>
						</tbody>
					</table>
					<div id="panelsmaipa" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      					<div class="panel-body">
      						<table class="table display table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th class="text-center">Nama</th>
										<th class="text-center">Sekolah</th>
										<th class="text-center">Kota - Provinsi</th>
										<th class="text-center">Matematika</th>
										<th class="text-center">Bahasa Indonesia</th>
										<th class="text-center">Bahasa Inggris</th>
										<th class="text-center">Fisika</th>
										<th class="text-center">Biologi</th>
										<th class="text-center">Kimia</th>
										<th class="text-center">Jumlah Nilai</th>
										<th class="text-center">Skor</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$x = 1;
										foreach($nasionalsmaipa as $smp){
											if($x <= 10 and $x >= 3){
											?>
											<tr>
												<td><?php echo $x;?></td>
												<td><?php echo $smp->nama;?></td>
												<td class="text-center"><?php echo $smp->sekolah;?></td>
												<td class="text-center"><?php echo $smp->kota;?> - <?php echo $smp->provinsi;?></td>
												<td class="text-center"><?php echo $smp->matematika;?></td>
												<td class="text-center"><?php echo $smp->bahasa_indonesia;?></td>
												<td class="text-center"><?php echo $smp->bahasa_inggris;?></td>
												<td class="text-center"><?php echo $smp->fisika;?></td>
												<td class="text-center"><?php echo $smp->biologi;?></td>
												<td class="text-center"><?php echo $smp->kimia;?></td>
												<td class="text-center"><?php echo $smp->jumlah;?></td>
												<td class="text-center"><?php echo $smp->skor;?></td>
											</tr>
											<?php
											}
											$x++;
										}
									?>
								</tbody>
							</table>
      					</div>
      				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PERINGKAT NASIONAL SMA IPA-->

<!-- PERINGKAT NASIONAL SMA IPs -->
<div class="container">
	<div class="row konten-wrapper">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h3 class="panel-title">Peringkat Nasional Kelas 12 SMA IPS</h3>
				</div>
				<div class="panel-body" style="overflow-x: scroll;">
					<table class="table display table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Sekolah</th>
								<th class="text-center">Kota - Provinsi</th>
								<th class="text-center">Matematika</th>
								<th class="text-center">Bahasa Indonesia</th>
								<th class="text-center">Bahasa Inggris</th>
								<th class="text-center">Ekonomi</th>
								<th class="text-center">Geografi</th>
								<th class="text-center">Sosiologi</th>
								<th class="text-center">Jumlah Nilai</th>
								<th class="text-center">Skor</th>
							</tr>
						</thead>
						<tbody class="besar">
							<?php
								$x = 1;
								foreach($nasionalsmaips as $smp){
									if($x <= 2){
									?>
									<tr>
										<td><?php echo $x;?></td>
										<td><?php echo $smp->nama;?></td>
										<td class="text-center"><?php echo $smp->sekolah;?></td>
										<td class="text-center"><?php echo $smp->kota;?> - <?php echo $smp->provinsi;?></td>
										<td class="text-center"><?php echo $smp->matematika;?></td>
										<td class="text-center"><?php echo $smp->bahasa_indonesia;?></td>
										<td class="text-center"><?php echo $smp->bahasa_inggris;?></td>
										<td class="text-center"><?php echo $smp->ekonomi;?></td>
										<td class="text-center"><?php echo $smp->geografi;?></td>
										<td class="text-center"><?php echo $smp->sosiologi;?></td>
										<td class="text-center"><?php echo $smp->jumlah;?></td>
										<td class="text-center"><?php echo $smp->skor;?></td>
									</tr>
									<?php
										if($x == 2){
											?>
											<tr>
												<td colspan="12" class="text-center"><a data-toggle="collapse" href="#panelsmaips" aria-expanded="false" aria-controls="panelsmaips">Lihat Peringkat Selanjutnya</a></td>
											</tr>
											<?php
										}
									$x++;
									}
								}
							?>
						</tbody>
					</table>
					<div id="panelsmaips" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      					<div class="panel-body">
      						<table class="table display table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th class="text-center">Nama</th>
										<th class="text-center">Sekolah</th>
										<th class="text-center">Kota - Provinsi</th>
										<th class="text-center">Matematika</th>
										<th class="text-center">Bahasa Indonesia</th>
										<th class="text-center">Bahasa Inggris</th>
										<th class="text-center">Ekonomi</th>
										<th class="text-center">Geografi</th>
										<th class="text-center">Sosiologi</th>
										<th class="text-center">Jumlah Nilai</th>
										<th class="text-center">Skor</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$x = 1;
										foreach($nasionalsmaips as $smp){
											if($x <= 10 and $x >= 3){
											?>
											<tr>
												<td><?php echo $x;?></td>
												<td><?php echo $smp->nama;?></td>
												<td class="text-center"><?php echo $smp->sekolah;?></td>
												<td class="text-center"><?php echo $smp->kota;?> - <?php echo $smp->provinsi;?></td>
												<td class="text-center"><?php echo $smp->matematika;?></td>
												<td class="text-center"><?php echo $smp->bahasa_indonesia;?></td>
												<td class="text-center"><?php echo $smp->bahasa_inggris;?></td>
												<td class="text-center"><?php echo $smp->ekonomi;?></td>
												<td class="text-center"><?php echo $smp->geografi;?></td>
												<td class="text-center"><?php echo $smp->sosiologi;?></td>
												<td class="text-center"><?php echo $smp->jumlah;?></td>
												<td class="text-center"><?php echo $smp->skor;?></td>
											</tr>
											<?php
											}
											$x++;
										}
									?>
								</tbody>
							</table>
      					</div>
      				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PERINGKAT NASIONAL SMA IPs-->
<div class="container">
	<div class="row konten-wrapper">
		<div class="col-md-12 col-alur text-center">
			<p style="font-size: 20px;">Hadiah diberikan kepada peraih peringkat 1 dan 2 tiap jenjangnya
			<p style="font-size: 20px;">Peringkat 1 mendapatkan hadiah <strong>1 unit sepeda motor *</strong>
			<p style="font-size: 20px;">Peringkat 2 mendapatkan hadiah <strong>1 unit laptop *</strong>
			<p style="font-size: 20px;">Penerima hadiah akan dihubungi oleh pihak Prime Mobile untuk penyerahan hadiah.
			<p style="font-size: 20px;">Bagi yang belum berhasil mendapatkan peringkat, anda masih bisa melihat detail penilaian Try Out dengan <a href="<?php echo base_url("login");?>">login</a> ke akun yang anda miliki
			<p>* Pajak hadiah ditanggung pemenang
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript">
$(function(){


$(document).ajaxSend(function(event, jqxhr, settings){
	
});
$(document).ajaxSuccess(function(event, request, options){
	
});
$(document).ajaxError(function(event, request, options){
	
});

})
</script>
<?php $this->load->view("landing_page/cbt2017/footer");?>