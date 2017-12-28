<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("banksoal/ajax_mapel/" + $("#kelas").val());
	});
});
</script>
<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php";?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
              </div>
              <div class="content">
				<form action="<?php echo base_url("pg_admin/materi/proses_tambah_poin");?>" method="post">
					<div class="col-md-6">
						<select id="kelas" class="form-control">
							<option value="">Pilih Kelas...</option>
							<?php 
							foreach ($select_options_kelas as $item) { 
							?>
								<option value="<?php echo $item->id_kelas;?>"> <?php echo $item->alias_kelas; ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="col-md-6">
						<select id="mapel" class="form-control">
							<option value="">Pilih Mata Pelajaran...</option>
						</select>
					</div>
				</form>
				
                <div class="footer">
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <?php include "footer.php"; ?>

  </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url('assets/js/demo.js');?>"></script>

</html>
