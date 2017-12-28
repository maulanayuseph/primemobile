<?php
$this->load->view("pg_user/header_dashboard");
?>
<div class="container-fluid akun-container">
	<div class="col-sm-3">
		
	</div>
	<div class="col-sm-6">
		<div class="card">
			<div class="col-sm-12 card text-center">
				<h4>Kamu belum memiliki aktivasi untuk mengikuti event, beli aktivasi sekarang juga dengan biaya Rp. <?php echo number_format($event->harga,2,",",".");?></h4>
				<br>
				<a href="<?php echo base_url("cbt_event/proses_beli/" . $event->id_event);?>" class="btn btn-danger" style="width: 100%;">Beli Aktivasi Event</a>
				<br>&nbsp;
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
