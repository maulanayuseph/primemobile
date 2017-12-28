<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("ajax_mapel/" + $("#kelas").val());
	});
});
</script>
<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
		<?php echo $this->session->flashdata('alert'); ?>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="header">
                <h4 class="title">Register Guru <?php echo $sekolah->nama_sekolah;?></h4>
              </div>
              <div class="content">
                <div class="row">
				
				<form action="<?php echo base_url("psep_sekolah/guru/proses_tambah");?>" method="post" enctype="multipart/form-data">
					<div class="col-md-12">
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="nama" class="form-control" required/>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" name="email" class="form-control" required/>
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" class="form-control" required/>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" required/>
						</div>
						<div class="form-group">
							<label>Ulangi Password</label>
							<input type="password" name="repassword" class="form-control" required/>
						</div>
						<div class="form-group">
							<label>Kartu Identitas (KTP / SIM / KTA)</label>
							<input type="file" name="identitas" required/>
						</div>
						<br>&nbsp;
						<br>&nbsp;
						<input type="submit" class="btn btn-primary" value="Registrasi Akun"/>
					</div>
				  </form>
				  
                </div>

              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Nestable Plugin    -->


<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>


</html>
