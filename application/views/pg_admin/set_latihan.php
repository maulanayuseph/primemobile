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
		$("#list-latihan").load("set_latihan/ajax_latihan/" + $("#mapel").val());
	});
	
	$(document).ajaxStart(function() {
	  $('#modal-loader').modal('show');
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
                <h4 class="title">Set Latihan Soal dan Uji Kompetensi</h4>
			  </div>
				<div class="content">
					<div class="row">
						<div class="col-sm-6">
							<select class="form-control" id="kelas">
								<option value="0">-- Pilih Kelas --</option>
								<?php 
								  foreach ($datakelas as $item) { 
								  ?>
								  <option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
								  <?php } ?>
							</select>
						</div>
						<div class="col-sm-6">
							<select class="form-control" id="mapel">
								<option value="0">-- Pilih Mata Pelajaran --</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		  </div> 
        </div>
		
		<div class="row">
          <div class="col-md-12">
            <div class="card">
				<div class="content">
					<div class="row">
						<div class="col-sm-12" id="list-latihan">
							
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
		<p> Loading ..... (,")
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
