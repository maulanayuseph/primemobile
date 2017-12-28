<?php include('header_dashboard.php'); ?>
<div class="container-fluid akun-container">
	<div class="col-lg-12">
	
		<div class="panel panel-default">
		  <div class="panel-heading heading-list-cbt text-center">
			<h3 class="panel-title">Rincian Transaksi Pembayaran CBT</h3>
		  </div>
		  <div class="panel-body body-cbt-list">
		  <div class="col-lg-6 col-md-6">
				<table class="table">
					<tr>
						<td>Nomor Pendaftaran</td>
						<td>:</td>
						<td>#PM<?php echo $infopendaftaran->id_profil.$infopendaftaran->id_siswa;?></td>
					</tr>
					<tr>
						<td>Tanggal Pendaftaran</td>
						<td>:</td>
						<td>
						<?php
						echo $infopendaftaran->tgl_daftar;
						?>
						</td>
					</tr>
					<tr>
						<td>Nama Peserta</td>
						<td>:</td>
						<td><?php echo $infopendaftaran->nama_siswa;?></td></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td>
						<?php
							if($infopendaftaran->status_bayar == '0'){
								echo "<label class='label label-warning'>Belum Lunas</label>";
							}elseif($infopendaftaran->status_bayar == '1'){
								echo "<label class='label label-primary'>Menunggu </label>";
							}elseif($infopendaftaran->status_bayar == '2'){
								echo "<label class='label label-success'>Lunas</label>";
							}elseif($infopendaftaran->status_bayar == '3'){
								echo "<label class='label label-danger'>Ditolak</label>";
							}
						?>
						</td>
					</tr>
					<tr>
						<td>Metode Pembayaran</td>
						<td>:</td>
						<td>Transfer Bank</td>
					</tr>
				</table>
		  </div>
		  <div class="col-lg-12">
		  <table class="table table-striped table-bordered">
				<thead style="background-color: #E30026; color: white;">
					<tr>
						<th class="text-center">Event CBT</th>
						<th class="text-center">Biaya Pendaftaran</th>
						<th class="text-center">Jumlah</th>
						<th class="text-center">Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $infopendaftaran->nama_profil; ?></td>
						<td>Rp. <?php echo $infopendaftaran->biaya; ?>,-</td>
						<td>1</td>
						<td>Rp. <?php echo $infopendaftaran->biaya; ?>,-</td>
					</tr>
					<tr>
						<td colspan="3" style="text-align: right; font-weight: bold;">Grand Total</td>
						<td>Rp. <?php echo $infopendaftaran->biaya; ?>,-</td>
					</tr>
				</tbody>
			</table>
			
			<?php
				if($infopendaftaran->status_bayar == '0'){
					?>
					<form action='../proses_bukti/' method='post' enctype='multipart/form-data'>
						<div class='col-lg-12'>
							Upload Bukti Pembayaran
						</div>
						<div class='col-lg-6 col-md-6 col-sm-6'>
							<input type='file' name='bukti' required/>
							<input type='hidden' name='iddaftar' value='<?php echo $infopendaftaran->id_bayar_cbt;?>' />
						</div>
						<div class='col-lg-6 col-md-6 col-sm-6'>
							<input type='submit' class='btn btn-danger' value='Konfirmasi Pembayaran' />
						</div>
					</form>
					<?php
				}elseif($infopendaftaran->status_bayar == '1'){
					?>
					
					<?php
				}elseif($infopendaftaran->status_bayar == '2'){
					?>
					
					<?php
				}elseif($infopendaftaran->status_bayar == '3'){
					?>
					<form action='../proses_bukti/' method='post' enctype='multipart/form-data'>
						<div class='col-lg-12'>
							Upload Bukti Pembayaran
						</div>
						<div class='col-lg-6 col-md-6 col-sm-6'>
							<input type='file' name='bukti' required/>
							<input type='hidden' name='iddaftar' value='<?php echo $infopendaftaran->id_bayar_cbt;?>' />
						</div>
						<div class='col-lg-6 col-md-6 col-sm-6'>
							<input type='submit' class='btn btn-danger' value='Konfirmasi Pembayaran' />
						</div>
					</form>
					<?php
				}
			?>
			<hr>
			<p>&nbsp;
			
			  <h4 class="page-bank" style="margin-bottom: 20px;">Daftar Nomor Rekening untuk Transfer Pembayaran Paket</h4>

			  <div class="col-sm-3 col-md-3 text-center">

				<img src="<?php echo base_url('assets/pg_user/images/icon/bank/bca.png');?>" width="171" height="84" alt="Bank Pembayaran PG" class="img-responsive" style="margin-bottom: 20px;">

				<p style="text-align: center;">

				  A.n. Prime Generation

				</p>

				<p style="text-align: center;">

				  No. Rekening : 918-213-999-1

				</p>

			  </div>

			  <div class="col-sm-3 col-md-3 text-center">

				<img src="<?php echo base_url('assets/pg_user/images/icon/bank/bri.png');?>" width="173" height="82" alt="Bank Pembayaran PG" class="img-responsive" style="margin-bottom: 20px;">

				<p style="text-align: center;">

				  A.n. Prime Generation

				</p>

				<p style="text-align: center;">

				  No. Rekening : 0389-01-0002-20309

				</p>

			  </div>

			  <div class="col-sm-3 col-md-3 text-center">

				<img src="<?php echo base_url('assets/pg_user/images/icon/bank/bni.png');?>" width="171" height="82" alt="Bank Pembayaran PG" class="img-responsive" style="margin-bottom: 20px;">

				<p style="text-align: center;">

				  A.n. Prime Generation

				</p style="text-align: center;">

				<p>

				  No. Rekening : 14-0897-6000-00

				</p>

			  </div>

			  <div class="col-sm-3 col-md-3 text-center">

				<img src="<?php echo base_url('assets/pg_user/images/icon/bank/mandiri.png');?>" width="171" height="84" alt="Bank Pembayaran PG" class="img-responsive" style="margin-bottom: 20px;">

				<p style="text-align: center;">

				  A.n. Prime Generation

				</p>

				<p style="text-align: center;">

				  No. Rekening : 1020-00-3078-265

				</p>

			  </div>
			
			</div>
		  </div>
		</div>
		
    </div>
</div>

<?php include('modal_unlock_bonus.php');?>
  <?php include('modal_video_motivasi.php');?>
<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
  
 
  
  <?php include('modal_aktivasi_agcu.php'); ?>
  <?php include('modal_profil.php'); ?>

  </body>
</html>