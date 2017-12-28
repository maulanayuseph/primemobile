<?php
$this->load->view("pg_user/header_dashboard");
?>
<div class="container-fluid akun-container">
	<div class="col-sm-3">
		
	</div>
	<div class="col-sm-6">
		<div class="card">
			<div class="col-sm-12 card text-center">
				<br>
				&nbsp;
				<h4>Masukkan nomor aktivasi untuk mendapatkan akses event. Periksa kotak masuk email dari Prime Mobile untuk mendapatkan nomor aktivasi. Jika belum mendapatkan nomor aktivasi, silahkan hubungi CS Prime Mobile</h4>
				<br>
				<form role="form" action="<?php echo base_url('user/do_aktivasi')?>" method="post">
				<input type="text" name="kode_aktivasi" class="form-control" placeholder="Masukkan Nomor Aktivasi">
				<input type="hidden" name="kelas" value="<?php echo $kelasaktif->id_kelas;?>">
				&nbsp;
				<br>
				<br>
				<input type="submit" class="btn btn-danger" value="Aktivasi" style="width: 100%;">
				<br>
				<br>&nbsp;
				</form>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		
	</div>
</div>
	
<?php
$this->load->view("pg_user/footer");
?>

<script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>

<script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

 </body>
</html>
