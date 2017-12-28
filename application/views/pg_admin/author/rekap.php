<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view("pg_admin/html_header");; ?>

<div class="wrapper">
  <?php 
  $this->load->view("pg_admin/sidebar");
  ?>

  <div class="main-panel">
    <?php $this->load->view("pg_admin/navbar"); ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Rekapitulasi Upload Penulis</h4>
                <p class="category"></p>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-4">
						<input type="text" id="tgl-mulai" placeholder="tanggal mulai" class="form-control datepicker" />
					</div>
					<div class="col-sm-4">
						<input type="text" id="tgl-selesai" placeholder="tanggal akhir" class="form-control datepicker" />
					</div>
					<div class="col-sm-4">
						<button class="btn btn-primary" style="width: 100%;" id="filter">Filter Rekap</button>
					</div>
				</div>
				<div class="row">
					&nbsp;
					<div class="col-sm-12" id="list-penulis">
						
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

<!-- MODAL LOADER -->
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
<!-- END MODAL LOADER -->

<!-- MODAL ERROR AJAX -->
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
<!-- END MODAL ERROR AJAX -->
</body>

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

<!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

<script>
$(function(){
$(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });

$("#filter").click(function(){
	$("#list-penulis").load("rekap_penulis/ajax_rekap_penulis/" + $("#tgl-mulai").val() + "/" + $("#tgl-selesai").val());
});

$(document).ajaxSend(function(event, jqxhr, settings){
	alamat 		= settings.url;
	urlrekap	= alamat.substring(0, 32);
	if(urlrekap === "rekap_penulis/ajax_rekap_penulis"){
		$('#text-load').html('memuat rekap penulias');
		$('#modal-loader').appendTo("body").modal('show');
	}
});
$(document).ajaxSuccess(function(event, request, options){
	alamat 		= options.url;
	urlrekap	= alamat.substring(0, 32);
	if(urlrekap === "rekap_penulis/ajax_rekap_penulis"){
		$('#modal-loader').modal('hide');
	}
});
$(document).ajaxError(function(event, request, options){
	alamat 		= options.url;
	urlrekap	= alamat.substring(0, 32);
	if(urlrekap === "rekap_penulis/ajax_rekap_penulis"){
		$('#modal-loader').modal('hide');
		$('#modal-error').appendTo("body").modal('show');
	}
});
});
</script>


</html>
