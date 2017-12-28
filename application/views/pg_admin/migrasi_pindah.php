<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("banksoal/ajax_mapel/" + $("#kelas").val());
	});
	$("#mapel").change(function(){
		$("#list-bab").load("kurikulum/ajax_materi_pokok/" + $("#kelas").val() + "/" + $("#mapel").val());
	});
	
	$("#kelassub").change(function(){
		$("#mapelsub").load("../banksoal/ajax_mapel/" + $("#kelassub").val());
	});
	
	$("#mapelsub").change(function(){
		$("#drop-bab").load("../kurikulum/ajax_materi_pokok_drop/" + $("#kelassub").val() + "/" + $("#mapelsub").val());
	});
	
	$("#drop-bab").change(function(){
		$("#list-sub-bab").load("ajax_sub_bab/" + $("#drop-bab").val());
	});
	
	$("#list-sub-bab").change(function(){
		$("#isi-soal").load("ajax_list_soal_pindah/" + $("#list-sub-bab").val());
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
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Manajemen Migrasi Soal</h4>
                <p class="category">Pindah Soal</p>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-3">
						<select class="form-control" id="kelassub">
							<option>-- Pilih Kelas --</option>
							<?php
								foreach($datakelas as $kelas){
									?>
									<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
									<?php
								}
							?>
						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control" id="mapelsub">
							<option>-- Pilih Mata Pelajaran --</option>
						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control" id="drop-bab">
							<option>-- Pilih Bab --</option>
						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control" id="list-sub-bab">
							<option>-- Pilih Sub-Bab --</option>
						</select>
					</div>
					
					<div class="col-sm-12" id="isi-soal">
						
					</div>
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

</html>
