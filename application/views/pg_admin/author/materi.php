<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<script>
$(function(){
	
	$("#kelassub").change(function(){
		$("#mapelsub").load("../author/ajax_mapel/" + $("#kelassub").val());
	});
	
	$("#mapelsub").change(function(){
		//$("#drop-bab").load("../author/ajax_materi_pokok_drop/" + $("#kelassub").val() + "/" + $("#mapelsub").val());
		$("#kurikulum").load("../author/ajax_kurikulum/");
	});
	
	$("#kurikulum").change(function(){
		$("#drop-bab").load("../author/ajax_materi_pokok_drop/" + $("#kelassub").val() + "/" + $("#mapelsub").val() + "/" + $("#kurikulum").val());
	});
	
	$("#drop-bab").change(function(){
		$("#list-sub").load("../author/ajax_list_sub/" + $("#drop-bab").val() + "/" + $("#kurikulum").val());
	});
	
});
</script>
<div class="wrapper">
  <?php include "sidebar_penulis.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Manajemen Soal</h4>
                <p class="category"></p>
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
						<select class="form-control" id="kurikulum">
							<option value="0">-- Pilih Kurikulum --</option>
							<option value="K-13">K-13</option>
							<option value="KTSP">KTSP</option>
						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control" id="drop-bab">
							<option value="0">-- Pilih Bab --</option>
						</select>
					</div>
				</div>
				<div class="row">
				<br>&nbsp;
				</div>
				<div class="row">
					<div class="col-sm-12" id="list-sub">
						
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
