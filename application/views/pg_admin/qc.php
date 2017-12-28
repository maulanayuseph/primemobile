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
		$("#viewmodalsoal").load("quality/ajax_modal_soal/" + $("#bab").val());
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
		//$("#list-eval").load("quality/ajax_list_eval/");
	});
	$("#filter-eval").change(function(){
		$("#list-eval").load("quality/ajax_filter_eval/" + $("#filter-eval").val());
	});
	$("#kelas-overview").change(function(){
		$("#ajax_overview").load("quality/ajax_overview_by_kelas/" + $("#kelas-overview").val());
	});
	
	$("#eval-kelas").change(function(){
		$("#eval-mapel").load("banksoal/ajax_mapel/" + $("#eval-kelas").val());
	});
	$("#eval-mapel").change(function(){
		$("#eval-status").load("quality/ajax_status");
	});
	$("#eval-status").change(function(){
		$("#list-eval").load("quality/ajax_soal_by_status_and_mapel/" + $("#eval-mapel").val() + "/" + $("#eval-status").val());
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
				<br>&nbsp;
				<div class="col-sm-12">
				    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="width: 100%;">
                        Detail
                    </a>
                    <div class="collapse" id="collapseExample">
                        <div class="well">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kelas</th>
                                        <th>Menunggu Approval</th>
                                        <th>Disetujui</th>
                                        <th>Ditolak</th>
                                        <th>Operasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
								  foreach ($datakelas as $item) { 
								      $waiting= $this->model_kurikulum->hitung_soal_by_status_and_kelas(0, $item->id_kelas);
            						  $approved4 = $this->model_kurikulum->hitung_soal_by_status_and_kelas(10, $item->id_kelas);
            						  $approved42 = $this->model_kurikulum->hitung_soal_by_status_and_kelas(1, $item->id_kelas);
            						  $tolak = $this->model_kurikulum->hitung_soal_ditolak_by_kelas($item->id_kelas);
            						  
            						  $totalsoal = $waiting + $approved4 + $approved42 + $tolak;
								  ?>
								  <tr>
                                        <td>
                                            <?php echo $item->alias_kelas;?>
                                        </td>
                                        <td>
                                            <?php
            									
            									echo $waiting;
            								?>
                                        </td>
                                        <td>
                                            <?php
            									$totalapprov4 = $approved4 + $approved42;
            									echo $totalapprov4;
            								?>
                                        </td>
                                        <td>
                                            <?php
            									
            									echo $tolak;
            								?>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/quality/detailkelas/" . $item->id_kelas);?>">Detail Kelas</a>
                                        </td>
                                    </tr>
								  <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
						<form action="<?php echo base_url("pg_admin/quality/export_approval");?>" method="post" target="_BLANK">
							<div class="col-md-6">
								<select class="form-control" id="kelas-overview" name="idkelas" required>
									<option value="">-- Pilih Kelas --</option>
									  <?php 
									  foreach ($datakelas as $item) { 
									  ?>
									  <option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
									  <?php } ?>
								</select>
							</div>
							<div class="col-md-6">
								<input type="submit" class="btn btn-primary" value="Export Excel" />
							</div>
						</form>
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
						<?php if($this->session->userdata("level") == "adminqc"){
						?>
						<div class="col-sm-6">
							<table class="table table-striped">
								<tr>
									<td>Filter By</td>
									<td>:</td>
									<td>
										<select class="form-control" id="filter-eval">
										    <option>-- Pilih Status Soal --</option>
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
						<?php
						}
						?>

					</div>
					<div class="row">
						<div class="col-sm-3">
							Advanced Filter :
						</div>
						<div class="col-sm-3">
							<select class="form-control" id="eval-kelas">
								<option value="">Pilih Kelas...</option>
									  <?php 
									  foreach ($datakelas as $item) { 
									  ?>
									  <option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
									  <?php 
									  }
									  ?>
							</select>
						</div>
						<div class="col-sm-3">
							<select class="form-control" id="eval-mapel">
								<option>-- Pilih Mapel --</option>
							</select>
						</div>
						<div class="col-sm-3">
							<select class="form-control" id="eval-status">
								<option>-- Pilih Status --</option>
							</select>
						</div>
					</div>
					<div class="row">
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
<div id="viewmodalsoal">

</div>
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
<?php //include "alert_modal.php"; ?>
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
