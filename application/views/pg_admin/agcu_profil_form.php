<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('pg_admin/html_header'); ?>

<div class="wrapper">
	<?php
		if($this->session->userdata("level") == "adminpa"){
			$this->load->view('pg_admin/sidebar_pa');
		}else{
			$this->load->view('pg_admin/sidebar');
		}
	?>

  <div class="main-panel">
		<?php $this->load->view('pg_admin/navbar'); ?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        	<div class="col-sm-6">
        		<form method="post" action="<?php echo base_url("pg_admin/diagnostictest/proses_tambah_profil");?>">
					<table class="table table-responsive table-hover">
						<tr>
							<td>Nama Tes AGCU</td>
							<td>:</td>
							<td><input type="text" name="nama" class="form-control" required/></td>
						</tr>
						<tr>
							<td>Kelas</td>
							<td>:</td>
							<td>
								<select class="form-control" name="kelas">
									<option>-- Pilih Kelas --</option>
									<?php
										foreach($kelas as $kel){
											?>
											<option value="<?php echo $kel->id_kelas;?>"><?php echo $kel->alias_kelas;?></option>
											<?php
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Kurikulum</td>
							<td>:</td>
							<td>
								<select class="form-control" name="kurikulum">
									<option>-- Pilih Kelas --</option>
									<option value="K-13">K-13</option>
									<option value="KTSP">KTSP</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Periode AGCU (mulai)</td>
							<td>:</td>
							<td><input type="text" name="start_date" id="datepicker" class="form-control" required/></td>
						</tr>
						<tr>
							<td>Periode AGCU (selesai)</td>
							<td>:</td>
							<td><input type="text" name="end_date" id="datepicker2" class="form-control" required/></td>
						</tr>
						<tr>
							<td colspan="3" style="text-align: right;"><input type="submit" class="btn btn-danger btn-sm" value="Simpan Profil AGCU"/></td>
						</tr>
					</table>
				</form>
        	</div>
        </div>
      </div>
    </div>
		<?php $this->load->view('pg_admin/footer'); ?>
  </div>
</div>

</body>

<!--   Core JS Files   -->

<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url('assets/js/demo.js');?>"></script>

<!-- CUSTOM JS FUNCTION -->
<!-- Reset Form -->

<!--  Datatables Plugin -->

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
<!-- PLUGINS FUNCTION -->
<!-- Chosen - select box plugin  -->
<script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>" type="text/javascript"></script>

<script>
$(function(){
	$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#datepicker2").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>

</html>
