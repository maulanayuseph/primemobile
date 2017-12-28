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
                
                <h4 class="title">Tambah User Prime Mobile</h4>
              </div>
              <div class="content">
                <form action="<?php echo base_url("pg_admin/user/proses_tambah");?>" method="post">
					<div class="form-group">
						<label>Username<span class="text-danger">*</span></label>
						<input type="text" name="username" class="form-control" placeholder="Masukkan Username..." required />
					</div>
					<div class="form-group">
						<label>Password<span class="text-danger">*</span></label>
						<input type="Password" name="password" class="form-control" placeholder="Masukkan Password..." required />
					</div>
					<div class="form-group">
						<label>Ulangi Password<span class="text-danger">*</span></label>
						<input type="Password" name="repassword" class="form-control" placeholder="Ulangi Password..." required />
					</div>
					<div class="form-group">
						<label>Level<span class="text-danger">*</span></label>
						<select id="level" class="form-control" name="level" required>
							<option value="">-- Pilih Level --</option>
							<option value="superadmin">Super Administrator</option>
							<option value="admin">Administrator</option>
							<option value="maineditor">Main Editor</option>
							<option value="editor">Editor</option>
						</select>
					</div>
					<input type="submit" class="btn btn-primary" value="Simpan Akun" />
				</form>
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
