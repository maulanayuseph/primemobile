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
		$("#bab").load("kurikulum/ajax_materi_pokok_drop/" + $("#mapel").val() + "/" + $("#mapel").val());
	});
	$("#bab").change(function(){
		$("#list-soal").load("quality/ajax_soal_by_bab/" + $("#bab").val());
	});
	
	$("#sortir").change(function(){
		if($("#bab").val() == ""){
			console.log($("#bab").val());
			//alert("hehhe");
		}else{
			$("#list-soal").load("quality/sort_soal/" + $("#sortir").val() + "/" + $("#bab").val());
		}
	});
	
	$(document).ajaxStart(function() {
	  $('#modal-loader').modal('show');
	});
	$("#btn-overview").click(function(){
		//$("#ajax_overview").load("quality/ajax_overview/" + $("#bab").val());
	});
	$("#btn-eval").click(function(){
		$("#list-eval").load("quality/ajax_list_eval/");
	});
	$("#filter-eval").change(function(){
		$("#list-eval").load("quality/ajax_filter_eval/" + $("#filter-eval").val());
	});
	$("#kelas-overview").change(function(){
		$("#ajax_overview").load("quality/ajax_overview_by_kelas/" + $("#kelas-overview").val());
	});
	$(document).ajaxStop(function() {
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
                <h4 class="title">Quality Control Manajemen</h4>
				
				<div class="col-sm-6">
					<table class="table table-bordered table-striped table-hover">
						<tr>
							<td>Soal Menunggu Approval</td>
							<td>:</td>
							<td><?php echo $jumlahsoal;?></td>
						</tr>
						<tr>
							<td>Pembahasan tidak lengkap</td>
							<td>:</td>
							<td>
								<?php
									$bahastidaklengkap = $this->model_kurikulum->hitung_soal_by_status(2);
									
									echo $bahastidaklengkap;
								?>
							</td>
						</tr>
						<tr>
							<td>Belum ada Pembobotan</td>
							<td>:</td>
							<td>
								<?php
									$belumbobot = $this->model_kurikulum->hitung_soal_by_status(3);
									
									echo $belumbobot;
								?>
							</td>
						</tr>
						<tr>
							<td>Soal Membingungkan</td>
							<td>:</td>
							<td>
								<?php
									$soalbingung = $this->model_kurikulum->hitung_soal_by_status(4);
									
									echo $soalbingung;
								?>
							</td>
						</tr>
					</table>
				</div>
				
				<div class="col-sm-6">
					<table class="table table-bordered table-striped table-hover">
						<tr>
							<td>Soal Dobel</td>
							<td>:</td>
							<td>
								<?php
									$soaldobel = $this->model_kurikulum->hitung_soal_by_status(5);
									
									echo $soaldobel;
								?>
							</td>
						</tr>
						<tr>
							<td>Soal Tidak Layak</td>
							<td>:</td>
							<td>
								<?php
									$tidaklayak = $this->model_kurikulum->hitung_soal_by_status(6);
									
									echo $tidaklayak;
								?>
							</td>
						</tr>
						<tr>
							<td>Soal Belum di QC Tentor</td>
							<td>:</td>
							<td>
								<?php
									$belumqc = $this->model_kurikulum->hitung_soal_by_status(8);
									
									echo $belumqc;
								?>
							</td>
						</tr>
						<tr>
							<td>Soal Perlu Dipindah</td>
							<td>:</td>
							<td>
								<?php
									$pindah = $this->model_kurikulum->hitung_soal_by_status(7);
									
									echo $pindah;
								?>
							</td>
						</tr>
						<tr>
							<td>Soal Disetujui</td>
							<td>:</td>
							<td>
								<?php
									$approved = $this->model_kurikulum->hitung_soal_by_status(10);
									
									echo $approved;
								?>
							</td>
						</tr>
					</table>
				</div>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-lg-12">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" id="btn-overview"><a href="#overview" aria-controls="overview" role="tab" data-toggle="tab">Overview</a>
							</li>
							<li role="presentation"><a href="#antri" aria-controls="antri" role="tab" data-toggle="tab">Waiting Approval</a></li>
							<li role="presentation" id="btn-eval"><a href="#evaluasi" aria-controls="evaluasi" role="tab" data-toggle="tab">Need Evaluation</a></li>
						<ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" id="ajax_loader">
						
					</div>
				</div>
				<div class="tab-content">
				  <div role="tabpanel" class="tab-pane fade" id="overview">
					<div class="row">
						<select class="form-control" id="kelas-overview">
							<option value="">-- Pilih Kelas --</option>
							  <?php 
							  foreach ($datakelas as $item) { 
							  ?>
							  <option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
							  <?php } ?>
						</select>
					</div>
					<div class="row" id="ajax_overview">
						
					</div>
				  </div>
				  <div role="tabpanel" class="tab-pane fade" id="antri">
					<div class="row">
						<div  class="table-responsive">
							<table class="table table-stripped">
								<tr>
									<td>
										<select id="kelas" class="form-control">
											<option value="">Pilih Kelas...</option>
											  <?php 
											  foreach ($datakelas as $item) { 
											  ?>
											  <option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
											  <?php } ?>
										</select>
									</td>
									<td>
										<select id="mapel" class="form-control" name="idmapel" required>
											<option value="">Pilih Mata Pelajaran...</option>
										</select>
									</td>
									<td>
										<select id="bab" class="form-control" name="idmapok" required>
											<option value="">Pilih Bab...</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<select id="sortir" class="form-control">
											<option value="0">Pilih Penyortiran Soal...</option>
											  <option value="0">Waiting Approval</option>
											  <option value="10">Approved</option>
										</select>
									</td>
									<td>
									</td>
									<td>
									</td>
								</tr>
							</table>
						</div>
						<div class="col-lg-12">
							<div class="table-responsive">
							  <table id="" class="table table-striped table-hover display">
								<thead>
								  <tr>
									<th>#</th>
									<th>Soal</th>
									<th>Pembahasan Teks</th>
									<th>Pembahasan Video</th>
									<th class="text-center">Aksi</th>
								  </tr>
								</thead>
								<tbody id="list-soal">
								  
								</tbody>
							  </table>
							</div>
						</div>
					</div>
				  </div>
				  
				  <!-- TAB UNTUK MEMUNCULKAN SOAL YANG PERLU DI EVALUASI ULANG -->
				  <div role="tabpanel" class="tab-pane fade" id="evaluasi">
					<div class="row">
						<div class="col-sm-6">
							<table class="table table-striped">
								<tr>
									<td>Filter By</td>
									<td>:</td>
									<td>
										<select class="form-control" id="filter-eval">
											<option value="all">Semua</option>
											<option value="2">Pembahasan Tidak Lengkap</option>
											<option value="3">Belum Ada Pembobotan</option>
											<option value="4">Soal Membingungkan</option>
											<option value="5">Soal Dobel</option>
											<option value="6">Soal Tidak Layak</option>
											<option value="8">Soal Belum di QC Tentor</option>
											<option value="7">Soal Perlu Dipindah</option>
										</select>
									</td>
								</tr>
							</table>
						</div>
						<div class="col-lg-12" id="list-eval">
							
						</div>
					</div>
				  </div>
				   <!-- END TAB UNTUK MEMUNCULKAN SOAL YANG PERLU DI EVALUASI ULANG -->
				   
				   
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
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-loader" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk loading ajax -->
<div class="modal fade" id="modal-loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="<?php echo base_url("assets/img/rolling.gif");?>"/>
		<p> Loading Data
      </div>
    </div>
  </div>
</div>

<!-- modal untuk menampilkan soal -->
<!-- Modal -->
<div class="modal fade" id="modalsoal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" id="isi-soal" style="height: 400px; overflow-y: scroll;">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal untuk menampilkan soal -->
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
 
<script>
$(document).ready(function() {
    //$('table.display').DataTable();
	
	$(".lihat-soal").click(function(e){
		var soal = e.target.id;
		var idsoal = soal.split("-");
		$("#isi-soal").load("quality/ajax_lihat_soal/" + idsoal[1]);
	})
	
	//$("#ajax_overview").load("quality/ajax_overview/" + $("#bab").val());
	
	//$("#list-eval").load("quality/ajax_list_eval/");
	
	$(document).ready(function() {
		//$('table.display').DataTable();
	} );
});
 </script>
 
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>
<script type="text/javascript">
  $('#deleteRow_modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var rownumber = button.data('number') // Extract info from data-* attributes
    var id = button.attr('value')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.number').text("#" + rownumber + "?")
    modal.find('input[name=hidden_row_id]').val(id)
  })
</script>
</html>
