<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include "html_header.php"; ?>
<style>
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con {
		width: 100%;
		display: none;
		position: absolute;
		height: 100px;
		z-index: 9999;
		background: url('<?php echo base_url('assets/img/ajax-loading.gif') ?>') center no-repeat white;
		transition: .5s;
	}
</style>
<script>
$(document).ready(function(){
    $(document).ajaxStart(function(){
        $(".se-pre-con").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $(".se-pre-con").css("display", "none");
    });
});
</script>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("../banksoal/ajax_mapel/" + $("#kelas").val());
	});
	$("#mapel").change(function(){
		$("#bab").load("ajax_materi_pokok/" + $("#mapel").val());
	});
	$("#proses").click(function(){
		$("#container-rekap").load("proses_rekap_soal_by_bab/" + $("#bab").val());
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
				<div class="row">
				<div class="col-md-3">
					<select id="kelas" class="form-control">
						<option value="0">-- Pilih Kelas --</option>
						<?php
							foreach($datakelas as $kelas){
								?>
								<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
								<?php
							}
						?>
					</select>
				</div>
				<div class="col-md-3">
					<select id="mapel" class="form-control">
						<option value="0">-- Pilih Mata Pelajaran --</option>
					</select>
				</div>
				<div class="col-md-3">
					<select id="bab" class="form-control">
						<option value="0">-- Pilih Bab --</option>
					</select>
				</div>
				<div class="col-md-3">
					<button class="btn btn-primary" id="proses">Proses Rekap Soal</button>
				</div>
				<div class="col-md-12 text-center" style="min-height: 100px;" id="container-rekap">
					<div class="se-pre-con">
					</div>
				</div>
				</div>
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
