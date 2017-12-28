<?php
include('header_dashboard.php');
?>

<script>
$(function(){
	$("#panlok").change(function(){
		$("#ptn1").load("../ajax_ptn_by_panlok/" + $("#panlok").val());
	});
	$("#ptn1").change(function(){
		$("#prodi1").load("../ajax_prodi_by_ptn/" + $("#ptn1").val());
	});
	$("#ptn2").change(function(){
		$("#prodi2").load("../ajax_prodi_by_ptn/" + $("#ptn2").val());
	});
	$("#ptn3").change(function(){
		$("#prodi3").load("../ajax_prodi_by_ptn/" + $("#ptn3").val());
	});
});
</script>

<div class="container-fluid akun-container">
<div class="col-lg-12">	
<form action="<?php echo base_url("sbmptn/proses_prodi");?>" method="post">
	<?php echo $this->session->flashdata('alert'); ?>
	<input type="hidden" name="paket" value="<?php echo $idpaket;?>" />
	<table class="table table-bordered table-striped">
		<tr>
			<td style="width: 30%;">Panitia Lokasi Anda Mengikuti Ujian</td>
			<td style="width: 70%;">
				<div class="col-sm-6">
					<select class="form-control" id="panlok" name="panlok" required>
						<option value="">-- Pilih Panlok --</option>
						<?php
							foreach($datapanlok as $panlok){
								?>
								<option value="<?php echo $panlok->id_panlok;?>"><?php echo $panlok->kode_panlok;?> - <?php echo $panlok->nama_panlok;?></option>
								<?php
							}
						?>
					</select>
				</div>
				<div class="col-sm-12">
					Pilih salah satu panlok
				</div>
			</td>
		</tr>
		<tr>
			<td style="width: 30%;">Pilihan 1</td>
			<td style="width: 70%;">
				<div class="col-sm-6">
					<select class="form-control" id="ptn1" name="ptn1" required>
						<option value="">-- Pilih PTN --</option>
					</select>
					<select class="form-control" id="prodi1" name="prodi1" required>
						<option value="">-- Pilih Program Studi --</option>
					</select>
				</div>
				<div class="col-sm-12">
					Lihat persyaratan program studi <a href="#" data-toggle="modal" data-target="#modalsyaratprodi">di sini</a>
				</div>
			</td>
		</tr>
		<tr>
			<td style="width: 30%;">Pilihan 2</td>
			<td style="width: 70%;">
				<div class="col-sm-6">
					<select class="form-control" id="ptn2" name="ptn2">
						<option value="0">-- Pilih PTN --</option>
						<?php
							foreach($dataptn as $ptn){
								?>
								<option value="<?php echo $ptn->id_ptn;?>"><?php echo $ptn->nama_ptn;?></option>
								<?php
							}
						?>
					</select>
					<select class="form-control" id="prodi2" name="prodi2">
						<option value="0">-- Pilih Program Studi --</option>
					</select>
				</div>
				<div class="col-sm-12">
				</div>
			</td>
		</tr>
		<tr>
			<td style="width: 30%;">Pilihan 3</td>
			<td style="width: 70%;">
				<div class="col-sm-6">
					<select class="form-control" id="ptn3"  name="ptn3">
						<option value="0">-- Pilih PTN --</option>
						<?php
							foreach($dataptn as $ptn){
								?>
								<option value="<?php echo $ptn->id_ptn;?>"><?php echo $ptn->nama_ptn;?></option>
								<?php
							}
						?>
					</select>
					<select class="form-control" id="prodi3" name="prodi3">
						<option value="0">-- Pilih Program Studi --</option>
						
					</select>
				</div>
				<div class="col-sm-12">
				</div>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td style="text-align: right;">
				<input type="submit" onclick="return confirm('Apakah anda yakin dengan Program Studi yang anda pilih? Program Studi yang sudah terpilih tidak bisa diubah kembali')" class="btn btn-primary" value="Simpan Prodi"/>
			</td>
		</tr>
	</table>
</form>
</div>
</div>

<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
  
 
<!-- Modal -->
<div class="modal fade" id="modalsyaratprodi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Persyaratan Prodi</h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="col-sm-12">
				<ol>
					<li>Program Studi yang ada di PTN dibagi menjadi dua kelompok, yaitu kelompok Saintek&nbsp; dan kelompok Soshum.</li>
					<li>Peserta dapat memilih program studi sebanyak-banyaknya 3 (tiga) program studi dengan ketentuan sebagai berikut:
					<ol style="list-style-type:lower-alpha;">
						<li>Jika program studi yang dipilih semuanya dari kelompok Saintek, maka peserta mengikuti kelompok ujian Saintek.</li>
						<li>Jika program studi yang dipilih semuanya dari kelompok Soshum, maka peserta mengikuti kelompok ujian Soshum.</li>
						<li>Jika program studi yang dipilih terdiri dari kelompok Saintek dan Soshum, maka peserta mengikuti kelompok ujian Campuran.</li>
					</ol>
					</li>
					<li>Urutan dalam pemilihan program studi menyatakan prioritas pilihan.</li>
					<li>Peserta ujian yang hanya memilih 1 (satu) program studi dapat memilih program studi di PTN manapun.</li>
					<li>Peserta ujian yang memilih 2 (dua) atau 3 (tiga) program studi, salah satu program studi pilihannya harus di PTN yang berada dalam satu wilayah pendaftaran dengan tempat peserta mengikuti ujian. Pilihan Program Studi yang lain dapat di PTN yang berada di luar wilayah pendaftaran tempat peserta mengikuti ujian.</li>
					<li>Daftar wilayah pendaftaran, program studi, daya tampung per PTN tahun 2017, dan jumlah peminat program studi per PTN tahun 2017 dapat dilihat di laman <a href="http://www.sbmptn.ac.id">http://www.sbmptn.ac.id</a> mulai tanggal 4 April 2017.</li>
				</ol>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>
    

  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
  

  </body>
</html>
