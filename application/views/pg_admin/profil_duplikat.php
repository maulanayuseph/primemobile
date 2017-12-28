<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
			<div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Duplikasi Profil Try Out</h4>
              </div>
              <div class="content">
					<div class="row">
						<div class="col-sm-12">
							<form action="<?php echo base_url("pg_admin/tryout/proses_duplikasi");?>" method="post" />
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th style="width: 10px;"></th>
											<th>Nama Profil</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach($dataprofil as $profil){
												?>
												<tr>
													<td>
														<input type="checkbox" name="profil[]" value="<?php echo $profil->id_tryout;?>" />
													</td>
													<td>
														<?php echo $profil->nama_profil;?> (<?php echo $profil->alias_kelas;?>)
													</td>
												</tr>
												<?php
											}
										?>
										<tr>
											<td>
												
											</td>
											<td>
												<input class="form-control" name="namaprofilbaru" placeholder="Input nama profil baru" />
											</td>
										</tr>
									</tbody>
								</table>
								<input type="submit" class="btn btn-sm btn-danger" style="width: 100%;" value="Mulai Duplikasi" />
							</form>
						</div>
					</div>
              </div>
            </div>
          </div>
			
          </div>
        </div>
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div> <!-- end .main-panel -->
</div>

<?php include "alert_modal.php"; ?>

</body>
  <!--   Core JS Files   -->
 <script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
 <script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

 <!--  Checkbox, Radio & Switch Plugins -->
 <script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

 <!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
 
<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<script type="text/javascript">
$(document).ready(function(){
$('table.display').DataTable();
})
</script>


</html>
