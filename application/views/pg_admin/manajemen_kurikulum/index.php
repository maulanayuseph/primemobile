<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
	$this->load->view("pg_admin/html_header");
?>

<div class="wrapper">
  <?php
  	$this->load->view("pg_admin/sidebar");
  ?>

  <div class="main-panel">
    <?php
    	$this->load->view("pg_admin/navbar");
    ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
              	<div class="row">
					<div class="col-sm-6">
						<h4 class="title">Manajemen Kurikulum</h4>
              		</div>
              		<div class="col-sm-6" style="text-align: right;">
						<button alt="Tambah Kurikulum" id="tambah-kurikulum" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#mainmodal">Tambah Kurikulum</button>
              		</div>
              	</div>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-12" id="konten-kurikulum">
						<table class="table table-responsive table-bordered table-hover display">
							<thead>
								<tr>
									<th style="width: 10px;" class="text-center">#</th>
									<th class="text-center">Kurikulum</th>
									<th class="text-center">Operasi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$x = 1;
									foreach($datakurikulum as $kurikulum){
										?>
										<tr>
											<td class="text-center">
												<?php echo $x;?>
											</td>
											<td class="text-center">
												<?php echo $kurikulum->nama_kurikulum;?>
											</td>
											<td class="text-center">
												<button class="btn btn-sm btn-warning edit-kurikulum" id="edit-<?php echo $kurikulum->id_kurikulum;?>" data-toggle="modal" data-target="#mainmodal">Edit Kurikulum</button>

												<button class="btn btn-danger btn-sm hapus-kurikulum" id="hapus-<?php echo $kurikulum->id_kurikulum;?>">Hapus Kurikulum</button>
											</td>
										</tr>
										<?php
										$x++;
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
    <?php
    	$this->load->view("pg_admin/footer");
    ?>
  </div>
</div>

<?php
	$this->load->view("pg_admin/modal_ajax");
?>
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

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>



<script type="text/javascript">
$(function(){

$("#tambah-kurikulum").click(function(){
	$("#mainmodaltitle").html("Tambah Kurikulum Baru");
	$("#mainmodalcontent").load("manajemen_kurikulum/tambah");
})

$('#konten-kurikulum').on( 'click', '.hapus-kurikulum', function () {
	rawid 		= $(this).attr("id");
	idsplit		= rawid.split("-");
	idkurikulum = idsplit[1];

	if(confirm("Apakah anda yakin untuk menghapus kurikulum?")){
		$.ajax({
			type: 'POST',
			url: 'manajemen_kurikulum/proses_hapus',
			data:{
				'idkurikulum'	: idkurikulum
			}
		});
	}
})

$('#konten-kurikulum').on( 'click', '.edit-kurikulum', function () {
	rawid 		= $(this).attr("id");
	idsplit		= rawid.split("-");
	idkurikulum = idsplit[1];
	$("#mainmodalcontent").load("manajemen_kurikulum/edit/" + idkurikulum);		
})

$(document).ajaxSend(function(event, jqxhr, settings){
	alamat 			= settings.url;
	urledit			= alamat.substring(0, 24);
	if(settings.url === "manajemen_kurikulum/tambah"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_kurikulum/proses_tambah"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_kurikulum/refresh_kurikulum"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_kurikulum/proses_hapus"){
		$("#modal-loader").modal("show");	
	}
	if(urledit === "manajemen_kurikulum/edit"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_kurikulum/proses_edit"){
		$("#modal-loader").modal("show");	
	}	
});
$(document).ajaxSuccess(function(event, request, options){
	alamat 			= options.url;
	urledit			= alamat.substring(0, 24);
	if(options.url === "manajemen_kurikulum/tambah"){
		$("#modal-loader").modal("hide");
	}
	if(options.url === "manajemen_kurikulum/proses_tambah"){
		$("#mainmodal").modal("hide");
		$("#konten-kurikulum").load("manajemen_kurikulum/refresh_kurikulum");
	}
	if(options.url === "manajemen_kurikulum/refresh_kurikulum"){
		$("#modal-loader").modal("hide");
	}
	if(options.url === "manajemen_kurikulum/proses_hapus"){
		$("#konten-kurikulum").load("manajemen_kurikulum/refresh_kurikulum");	
	}
	if(urledit === "manajemen_kurikulum/edit"){
		$("#modal-loader").modal("hide");	
	}
	if(options.url === "manajemen_kurikulum/proses_edit"){
		$("#mainmodal").modal("hide");
		$("#konten-kurikulum").load("manajemen_kurikulum/refresh_kurikulum");	
	}
});
$(document).ajaxError(function(event, request, options){
	alamat 			= options.url;
	urledit			= alamat.substring(0, 24);
	if(options.url === "manajemen_kurikulum/kurikulum"){
		$("#modal-loader").modal("hide");
		$("#mainmodal").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "manajemen_kurikulum/proses_tambah"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(option.url === "manajemen_kurikulum/refresh_kurikulum"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "manajemen_kurikulum/proses_hapus"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");	
	}
	if(urledit === "manajemen_kurikulum/edit"){
		$("#modal-loader").modal("hide");
		$("#mainmodal").modal("hide");
		$("#modal-error").modal("show");	
	}
	if(options.url === "manajemen_kurikulum/proses_edit"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");	
	}
});

})
</script>

</html>
