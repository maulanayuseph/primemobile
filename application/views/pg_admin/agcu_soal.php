<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('pg_admin/html_header'); ?>
<script>
	$(function(){
		$("#kelas").change(function(){
			$("#mapel").load("../../pilihmapel/" + $("#kelas").val());
		});
		$("#mapel").change(function(){
			$("#kategori").load("../../../banksoal/ajax_kategori/" + $("#mapel").val());
		});
		$("#kategori").change(function(){
			$("#soal").load("../../ajax_soal_by_kategoribaru/" + $("#kategori").val());
		});
	});
</script>
<script>
$(function(){
	$( '#checkall' ).click( function () {
		$( '#soal input[type="checkbox"]' ).prop('checked', this.checked)
	  })
});
</script>
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
    	<input type="hidden" id="id-diagnostic" value="<?php echo $kategori->id_diagnostic;?>" />
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        	<div class="col-sm-6" style="max-height: 600px; overflow-y: scroll;">
        		<table class="table" style="background-color: #EDEDED">
					<tr>
						<td class="text-center">Kelas</td>
						<td class="text-center">Mata Pelajaran</td>
						<td class="text-center">Kategori Bank Soal</td>
					</tr>
					<tr>
						<td>
							<select name="kelas" id="kelas" class="form-control">
								<option>--- Pilih Kelas ---</option>
								<?php
									foreach($kelas as $datakelas){
								?>
									<option value="<?php echo $datakelas->id_kelas; ?>"><?php echo $datakelas->alias_kelas;?></option>
								<?php
									}
								?>
							</select>
						</td>
						<td>
							<select name="mapel" id="mapel" class="form-control">	
							</select>
						</td>
						<td>
							<select id="kategori" class="form-control">
							</select>
						</td>
					</tr>
				</table>
				
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Kelas / Mapel</th>
							<th>Soal</th>
							<th>Topik</th>
							<th>
							</th>
						</tr>
					</thead>
					<tbody id="soal">
						<tr>
							<td colspan="4" style="text-align: center;">Pilih Kelas dan Mata Pelajaran Untuk Menampilkan Soal Yang Tersedia</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-sm-6" style="max-height: 600px; overflow-y: scroll;">
				<table class="table table-bordered table-striped table-responsive">
					<thead>
						<tr>
							<th style="width: 10px;">#</th>
							<th>Kategori Soal</th>
							<th>Soal</th>
							<th>Topik</th>
							<th>Operasi</th>
						</tr>
					</thead>
					<tbody id="isi-soal-diagnostic">
						
					</tbody>
				</table>
			</div>
        </div>
      </div>
    </div>
		<?php $this->load->view('pg_admin/footer'); ?>
  </div>
</div>

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-loader" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk loading ajax -->
<div class="modal fade" id="modal-loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="<?php echo base_url("assets/img/rolling.gif");?>"/>
		<p id="text-load"> Memproses</p>
      </div>
    </div>
  </div>
</div>

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-error" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk error ajax -->
<div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
		<p>Terjadi kesalahan, periksa koneksi atau ulangi lagi
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
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
$(document).ready(function() {
	iddiagnostic	= $("#id-diagnostic").val();
	$("#isi-soal-diagnostic").load("../../refresh_soal/" + iddiagnostic);
});
$(function(){
	$(document).ajaxSend(function(event, jqxhr, settings){
		alamat 		= settings.url;
		urlrefresh	= alamat.substring(0, 18);

		console.log(urlrefresh);

		if(urlrefresh === "../../refresh_soal"){
			$('#text-load').html('memuat soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 		= options.url;
		urlrefresh	= alamat.substring(0, 18);
		if(urlrefresh === "../../refresh_soal"){
			$('#modal-loader').modal('hide');
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 		= options.url;
		urlrefresh	= alamat.substring(0, 18);
		if(urlrefresh === "../../refresh_soal"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
});
</script>

</html>
