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
                <h4 class="title">Detail Evaluasi Soal <?php echo $detailkelas->alias_kelas;?></h4>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th></th>
									<th>Pembahasan Tidak Lengkap</th>
									<th>Belum Ada Pembobotan</th>
									<th>Soal Membingungkan</th>
									<th>Soal Dobel</th>
									<th>Soal Tidak Layak</th>
									<th>Soal Belum di QC Tentor</th>
									<th>Soal Perlu Dipindah</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($mapelkelas as $mapel){
										?>
										<tr>
											<td><?php echo $mapel->nama_mapel;?></td>
											<td class="text-center">
												<?php
												$jumlah = $this->model_kurikulum->hitung_soal_by_status_and_mapel($mapel->id_mapel, 2);
												
												echo $jumlah
												?>
												<br>
												<a target="_BLANK" class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/quality/printsoalditolak/" . $idkelas . "/" .  $mapel->id_mapel . "/" . 2);?>"><i class="fa fa-print" aria-hidden="true"></i></a>
											</td>
											<td class="text-center">
												<?php
												$jumlah = $this->model_kurikulum->hitung_soal_by_status_and_mapel($mapel->id_mapel, 3);
												
												echo $jumlah
												?>
												<br>
												<a target="_BLANK" class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/quality/printsoalditolak/" . $idkelas . "/" . $mapel->id_mapel . "/" . 3);?>"><i class="fa fa-print" aria-hidden="true"></i></a>
											</td>
											<td class="text-center">
												<?php
												$jumlah = $this->model_kurikulum->hitung_soal_by_status_and_mapel($mapel->id_mapel, 4);
												
												echo $jumlah
												?>
												<br>
												<a target="_BLANK" class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/quality/printsoalditolak/" . $idkelas . "/" . $mapel->id_mapel . "/" . 4);?>"><i class="fa fa-print" aria-hidden="true"></i></a>
											</td>
											<td class="text-center">
												<?php
												$jumlah = $this->model_kurikulum->hitung_soal_by_status_and_mapel($mapel->id_mapel, 5);
												
												echo $jumlah
												?>
												<br>
												<a target="_BLANK" class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/quality/printsoalditolak/" . $idkelas . "/" . $mapel->id_mapel . "/" . 5);?>"><i class="fa fa-print" aria-hidden="true"></i></a>
											</td>
											<td class="text-center">
												<?php
												$jumlah = $this->model_kurikulum->hitung_soal_by_status_and_mapel($mapel->id_mapel, 6);
												
												echo $jumlah
												?>
												<br>
												<a target="_BLANK" class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/quality/printsoalditolak/" . $idkelas . "/" . $mapel->id_mapel . "/" . 6);?>"><i class="fa fa-print" aria-hidden="true"></i></a>
											</td>
											<td class="text-center">
												<?php
												$jumlah = $this->model_kurikulum->hitung_soal_by_status_and_mapel($mapel->id_mapel, 8);
												
												echo $jumlah
												?>
												<br>
												<a target="_BLANK" class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/quality/printsoalditolak/" . $idkelas . "/" . $mapel->id_mapel . "/" . 8);?>"><i class="fa fa-print" aria-hidden="true"></i></a>
											</td>
											<td class="text-center">
												<?php
												$jumlah = $this->model_kurikulum->hitung_soal_by_status_and_mapel($mapel->id_mapel, 7);
												
												echo $jumlah
												?>
												<br>
												<a target="_BLANK" class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/quality/printsoalditolak/" . $idkelas . "/" . $mapel->id_mapel . "/" . 7);?>"><i class="fa fa-print" aria-hidden="true"></i></a>
											</td>
										</tr>
										<?php
									}
								?>
							</tbody>
						</table>
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
