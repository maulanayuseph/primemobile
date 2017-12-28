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
						<h4 class="title">Manajemen Tema</h4>
              		</div>
              		<div class="col-sm-6" style="text-align: right;">
						<button alt="Tambah mapel" id="tambah-tema" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#mainmodal">Tambah Tema</button>
              		</div>
              	</div>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-4">
						<select id="filter-kelas" class="form-control">
							<option value="">-- Filter Kelas --</option>
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
						<select id="filter-kurikulum" class="form-control">
							<option value="">-- Filter Kurikulum --</option>
							<?php
								foreach($datakurikulum as $kurikulum){
									?>
									<option value="<?php echo $kurikulum->id_kurikulum;?>"><?php echo $kurikulum->nama_kurikulum;?></option>
									<?php
								}
							?>
						</select>
					</div>
					<div class="col-sm-4">
						<button class="btn btn-danger" id="filter-btn">
							Filter Tema
						</button>
					</div>
					<div class="col-sm-12">
						<br>&nbsp;
					</div>
					<div class="col-sm-12" id="konten-tema">
						
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

$("#tambah-tema").click(function(){
	$("#mainmodaltitle").html("Tambah tema Baru");
	$("#mainmodalcontent").load("manajemen_tema/tambah");
})

$("#filter-btn").click(function(){
	idkelas 	= $("#filter-kelas").val();
	idkurikulum = $("#filter-kurikulum").val();
	if(idkelas === "" || idkurikulum === ""){
		alert("lengkapi filter sebelum menampilkan mapel");
	}else{
		$("#konten-tema").load("manajemen_tema/filter_tema/" + idkelas + "/" + idkurikulum);
	}
})

$(document).ajaxSend(function(event, jqxhr, settings){
	alamat 			= settings.url;
	alamatfilter 	= alamat.substring(0, 26);
	alamatedit		= alamat.substring(0, 19);
	alamattambahsub	= alamat.substring(0, 30);
	alamateditsub 	= alamat.substring(0, 28);
	if(settings.url === "manajemen_tema/tambah"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_tema/proses_tambah"){
		$("#modal-loader").modal("show");
	}
	if(alamatfilter === "manajemen_tema/filter_tema"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_tema/proses_hapus"){
		$("#modal-loader").modal("show");
	}
	if(alamatedit === "manajemen_tema/edit"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_tema/proses_edit"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_tema/proses_tambah_sub_tema"){
		$("#modal-loader").modal("show");
	}
	if(alamattambahsub === "manajemen_tema/tambah_sub_tema"){
		$("#modal-loader").modal("show");
	}
	if(alamateditsub === "manajemen_tema/edit_sub_tema"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_tema/proses_edit_sub_tema"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_tema/proses_hapus_sub_tema"){
		$("#modal-loader").modal("show");
	}
});
$(document).ajaxSuccess(function(event, request, options){
	alamat 			= options.url;
	alamatfilter 	= alamat.substring(0, 26);
	alamatedit		= alamat.substring(0, 19);
	alamattambahsub	= alamat.substring(0, 30);
	alamateditsub 	= alamat.substring(0, 28);
	if(options.url === "manajemen_tema/tambah"){
		$("#modal-loader").modal("hide");
	}
	if(options.url === "manajemen_tema/proses_tambah"){
		obj = JSON.parse(request.responseText);
		$("#mainmodal").modal("hide");
		$("#konten-tema").load("manajemen_tema/filter_tema/" + obj['idkelas'] + "/" + obj['idkurikulum']);
	} 
	if(alamatfilter === "manajemen_tema/filter_tema"){
		$("#modal-loader").modal("hide");
	}
	if(options.url === "manajemen_tema/proses_hapus"){
		$("#mainmodal").modal("hide");
		obj = JSON.parse(request.responseText);
		$("#konten-tema").load("manajemen_tema/filter_tema/" + obj['idkelas'] + "/" + obj['idkurikulum']);
	}
	if(alamatedit === "manajemen_tema/edit"){
		$("#modal-loader").modal("hide");
	}
	if(options.url === "manajemen_tema/proses_edit"){
		obj = JSON.parse(request.responseText);
		$("#mainmodal").modal("hide");
		$("#konten-tema").load("manajemen_tema/filter_tema/" + obj['idkelas'] + "/" + obj['idkurikulum']);
	}
	if(options.url === "manajemen_tema/proses_tambah_sub_tema"){
		$("#mainmodal").modal("hide");
		obj = JSON.parse(request.responseText);
		$("#konten-tema").load("manajemen_tema/filter_tema/" + obj['idkelas'] + "/" + obj['idkurikulum']);
	}
	if(alamattambahsub === "manajemen_tema/tambah_sub_tema"){
		$("#modal-loader").modal("hide");
	}
	if(alamateditsub === "manajemen_tema/edit_sub_tema"){
		$("#modal-loader").modal("hide");
	}
	if(options.url === "manajemen_tema/proses_edit_sub_tema"){
		$("#mainmodal").modal("hide");
		obj = JSON.parse(request.responseText);
		$("#konten-tema").load("manajemen_tema/filter_tema/" + obj['idkelas'] + "/" + obj['idkurikulum']);
	}
	if(options.url === "manajemen_tema/proses_hapus_sub_tema"){
		obj = JSON.parse(request.responseText);
		$("#konten-tema").load("manajemen_tema/filter_tema/" + obj['idkelas'] + "/" + obj['idkurikulum']);
	}
});
$(document).ajaxError(function(event, request, options){
	alamat 			= options.url;
	alamatfilter 	= alamat.substring(0, 26);
	alamatedit		= alamat.substring(0, 19);
	alamattambahsub	= alamat.substring(0, 30);
	alamateditsub 	= alamat.substring(0, 28);
	if(options.url === "manajemen_tema/tambah"){
		$("#modal-loader").modal("hide");
		$("#mainmodal").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "manajemen_tema/proses_tambah"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(alamatfilter === "manajemen_tema/filter_tema"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "manajemen_tema/proses_hapus"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(alamatedit === "manajemen_tema/edit"){
		$("#modal-loader").modal("hide");
		$("#mainmodal").modal("hide");
		$("#modal-error").modal("show")
	}
	if(options.url === "manajemen_tema/proses_edit"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "manajemen_tema/proses_tambah_sub_tema"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(alamattambahsub === "manajemen_tema/tambah_sub_tema"){
		$("#modal-loader").modal("hide");
		$("#mainmodal").modal("hide");
		$("#modal-error").modal("show");
	}
	if(alamateditsub === "manajemen_tema/edit_sub_tema"){
		$("#modal-loader").modal("hide");
		$("#mainmodal").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "manajemen_tema/proses_edit_sub_tema"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "manajemen_tema/proses_hapus_sub_tema"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
});

})
</script>

</html>
