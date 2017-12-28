<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
	$this->load->view("pg_admin/html_header");
?>

<div class="wrapper">
  <?php
		if($this->session->userdata("level") == "adminpa"){
			$this->load->view('pg_admin/sidebar_pa');
		}else{
			$this->load->view('pg_admin/sidebar');
		}
	?>

  <div class="main-panel">
    <?php
    	$this->load->view("pg_admin/navbar");
    ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
              	<div class="row">
					<div class="col-sm-6">
						<h4 class="title">Manajemen User</h4>
              		</div>
              	</div>
              </div>
              <div class="content">
				<div class="row">
					<form action="<?php echo base_url("pg_admin/manajemen_user/search");?>" method="GET">
						<div class="col-sm-4">
							<select class="form-control" name="where" required>
								<option value="">
									-- Cari Siswa Berdasarkan --
								</option>
								<option value="username">Username</option>
								<option value="kode_voucher">Kode Voucher</option>
								<option value="no_aktivasi">Nomor Aktivasi</option>
								<option value="nama_siswa">Nama</option>
							</select>
						</div>
						<div class="col-sm-4">
							<input type="text" name="keyword" class="form-control" placeholder="Masukkan Keyword" required>
						</div>
						<div class="col-sm-4">
							<input type="submit" class="btn btn-sm btn-danger" value="cari siswa">
						</div>
					</form>
				</div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->
    <?php
    	$this->load->view("pg_admin/footer");
    ?>
  </div>
</div>

<?php
	$this->load->view("pg_admin/modal_ajax");
?>
</body>



<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<!--<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script> -->

<!-- Bootstrap Switch Plugin -->
<script src="<?php echo base_url('assets/js/plugins/bootstrap-switch/bootstrap-switch.min.js');?>"></script>

<!-- Progress -->
<script src="<?= base_url('assets/js/nprogress.js')?>" ></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>



<script type="text/javascript">
$(function(){

$('table.display').DataTable();

$(document).ajaxSend(function(event, jqxhr, settings){
	
});
$(document).ajaxSuccess(function(event, request, options){
	
});
$(document).ajaxError(function(event, request, options){
	
});

})
</script>

</html>
