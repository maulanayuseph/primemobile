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
          <div class="col-md-8">
            <div class="card">
              <div class="header">
                <a href="<?php echo site_url('pg_admin/user/tambah') ?>" class="btn btn-success btn-fill pull-right"><i class="fa fa-plus"></i>Tambah User</a>
                <h4 class="title">Semua User Prime Mobile</h4>
              </div>
              <div class="content">
                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>level</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
						$no = 1;
						foreach($data_table as $data){
						?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $data->username;?></td>
								<td><?php echo $data->level;?></td>
								<td>
									<a href="<?php echo base_url('pg_admin/user/edit/'.$data->id_adm);?>">Edit</a> | 
									<a href="<?php echo base_url('pg_admin/user/edit_password/'.$data->id_adm);?>">Ubah Password</a>
									| 
									<a href="<?php echo base_url('pg_admin/user/hapus/'.$data->id_adm);?>" onclick="return confirm('Apakah anda yakin untuk menghapus user <?php echo $data->username;?> ?');">Hapus</a>
                  <?php
                    if($data->level == "adminqc"){
                      ?>
                       | <a href="<?php echo base_url("pg_admin/user/assignment_qc/" . $data->id_adm);?>">Assignment</a>
                      <?php
                    }
                  ?>
								</td>
							</tr>
						<?php
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



</html>
