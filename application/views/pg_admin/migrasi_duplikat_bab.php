<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include "html_header.php"; ?>
<script>
$(function(){
	
	$("#kelassub").change(function(){
		$("#mapelsub").load("../banksoal/ajax_mapel/" + $("#kelassub").val());
	});
	
	$("#mapelsub").change(function(){
		$("#drop-bab").load("../kurikulum/ajax_materi_pokok_drop/" + $("#kelassub").val() + "/" + $("#mapelsub").val());
	});
	
	$("#drop-bab").change(function(){
		$("#list-sub-bab").load("ajax_sub_bab/" + $("#drop-bab").val());
	});
	
	$("#kelastujuan").change(function(){
		$("#mapeltujuan").load("../banksoal/ajax_mapel/" + $("#kelastujuan").val());
	});
	
	$("#btn-proses").click(function(){
		idbab 		= $("#drop-bab").val();
		idmapel		= $("#mapeltujuan").val();
		kurikulum	= $("#kurikulum").val();
		//alert(idbab + " dan " + idmapel);
		if(idbab == 0 || idmapel == 0 || kurikulum == 0){
			alert("Form belum dilengkapi");
		}else{
			$.ajax({
				type: 'POST',
				url: '../migrasi/proses_duplikat_bab',
				data:{
					'idbab' 	: idbab,
					'idmapel'	: idmapel,
					'kurikulum'	: kurikulum
				}
			});
		}
	});
	$(document).ajaxSend(function(event, jqxhr, settings){
		$('#modal-loader').modal('show');
	});
	
	$(document).ajaxSuccess(function(event, request, options){
		$('#modal-loader').modal('hide');
	})
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
                <h4 class="title">Manajemen Migrasi Bab</h4>
                <p class="category">Duplikat Bab</p>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-4">
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
					<div class="col-sm-4">
						<select class="form-control" id="mapelsub">
							<option>-- Pilih Mata Pelajaran --</option>
						</select>
					</div>
					<div class="col-sm-4">
						<select class="form-control" id="drop-bab">
							<option value="0">-- Pilih Bab --</option>
						</select>
					</div>
				</div>
				<div class="row">
					<br>&nbsp;
				</div>
				<div class="row">
					<div class="col-sm-4 hidden-xs">
					</div>
					<div class="col-sm-4 text-center">
						<strong>Duplikat Ke :</strong>
					</div>
					<div class="col-sm-4 hidden-xs">
					</div>
				</div>
				<div class="row">
					<br>&nbsp;
				</div>
				<div class="row">
					<div class="col-sm-4">
						<select class="form-control" id="kelastujuan">
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
					<div class="col-sm-4">
						<select class="form-control" id="mapeltujuan">
							<option value="0">-- Pilih Mata Pelajaran --</option>
						</select>
					</div>
					<div class="col-sm-4">
						<select class="form-control" id="kurikulum">
							<option value="0">-- Pilih Kurikulum --</option>
							<option value="KTSP, K-13">BOTH</option>
							<option value="K-13">K-13</option>
							<option value="KTSP">KTSP</option>
						</select>
					</div>
				</div>
				<div class="row">
					<br>&nbsp;
				</div>
				
				<div class="row">
					<div class="col-sm-4 hidden-xs">
					</div>
					<div class="col-sm-4 text-center">
						<button class="btn btn-sm btn-primary" id="btn-proses">Mulai Proses Duplikasi</button>
					</div>
					<div class="col-sm-4 hidden-xs">
					</div>
				</div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-loader" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk loading ajax -->
<div class="modal fade" id="modal-loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="<?php echo base_url("assets/img/rolling.gif");?>"/>
		<p> Harap Tunggu, Sedang Proses :)
      </div>
    </div>
  </div>
</div>
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
