<?php
$this->load->view("pg_user/header_dashboard");
?>
<div class="container-fluid akun-container">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Notifikasi Tagihan</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<br>Pembayaran Transfer dapat dilakukan melalui ATM yang terdaftar dalam jaringan ATM Bersama
						<br>* Biaya transfer antar bank berlaku
						<br>&nbsp;
						<ol>
							<li>Kunjungi ATM terdekat yang memiliki logo ATMBersama</li>
							<li>Pilih fitur transfer</li>
							<li>Pilih menu transfer antar Bank</li>
							<li>Masukan kode <span style="color: red;">987</span> dilanjutkan dengan nomor rekening tujuan <span style="color: red;"><?php echo $tagihan->vaid;?></span></li>
							<li>Masukan <?php echo $tagihan->total_harga;?> pada jumlah transfer</li>
							<li>Konfirmasi data transfer</li>
							<li>Klik next/oke</li>
							<li>Transaksi selesai</li>
						</ol>
						<br>Pembayaran akan langsung terkonfirmasi setelah proses transaksi selesai.
						<br>&nbsp;
					</div>
					<div class="col-sm-12 text-center">
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-2">
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
