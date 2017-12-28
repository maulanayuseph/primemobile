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
						<h4 class="title">Manajemen Bab</h4>
              		</div>
              		<div class="col-sm-6" style="text-align: right;">
						<button alt="Tambah mapel" id="tambah-bab" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#mainmodal">Tambah Bab</button>
              		</div>
              	</div>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-3">
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
					<div class="col-sm-3">
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
					<div class="col-sm-3">
						<select class="form-control" id="filter-mapel">
							<option value="">-- Fiter Mapel --</option>
						</select>
					</div>
					<div class="col-sm-3">
						<button class="btn btn-danger" id="filter-btn">
							Filter Bab
						</button>
					</div>
					<div class="col-sm-12">
						<br>&nbsp;
					</div>
					<div class="col-sm-12" id="konten-bab">
						
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

$("#filter-kurikulum").change(function(){
	idkelas 		= $("#filter-kelas").val();
	idkurikulum 	= $(this).val();
	if(idkelas !== "" && idkurikulum !== ""){
		$("#filter-mapel").load("manajemen_bab/filter_mapel/" + idkelas + "/" + idkurikulum);
	}else{
		$("#filter-mapel").html("<option value=''>-- Filter Mapel --</option>");
	}
})

$("#filter-kelas").change(function(){
	idkurikulum = $("#filter-kurikulum").val();
	idkelas 	= $(this).val();
	if(idkurikulum !== "" && idkelas !== ""){
		$("#filter-mapel").load("manajemen_bab/filter_mapel/" + idkelas + "/" + idkurikulum);
	}else{
		$("#filter-mapel").html("<option value=''>-- Filter Mapel --</option>");
	}
})

$("#tambah-bab").click(function(){
	$("#mainmodaltitle").html("Tambah Bab Baru");
	$("#mainmodalcontent").load("manajemen_bab/tambah");
})

$("#filter-btn").click(function(){
	idmapel 	= $("#filter-mapel").val();

	if(idmapel === ""){
		alert("lengkapi filter sebelum menampilkan mapel");
	}else{
		$("#konten-bab").load("manajemen_bab/filter_bab/" + idmapel);
	}
})

$(document).ajaxSend(function(event, jqxhr, settings){
	alamat 			= settings.url;
	alamatfilter 	= alamat.substring(0, 24);
	alamatedit		= alamat.substring(0, 18);
	alamattambahsub	= alamat.substring(0, 28);
	alamateditsub 	= alamat.substring(0, 26);
	if(alamatfilter === "manajemen_bab/filter_bab"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_bab/tambah"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_bab/proses_tambah"){
		$("#modal-loader").modal("show");
	}
	if(alamatedit === "manajemen_bab/edit"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_bab/proses_edit"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_bab/proses_hapus"){
		$("#modal-loader").modal("show");
	}
	if(alamattambahsub == "manajemen_bab/tambah_sub_bab"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_bab/proses_tambah_sub_bab"){
		$("#modal-loader").modal("show");
	}
	if(alamateditsub === "manajemen_bab/edit_sub_bab"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_bab/proses_edit_sub_bab"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "manajemen_bab/proses_hapus_sub_bab"){
		$("#modal-loader").modal("show");
	}
});
$(document).ajaxSuccess(function(event, request, options){
	alamat 			= options.url;
	alamatfilter 	= alamat.substring(0, 24);
	alamatedit		= alamat.substring(0, 18);
	alamattambahsub	= alamat.substring(0, 28);
	alamateditsub 	= alamat.substring(0, 26);
	if(alamatfilter === "manajemen_bab/filter_bab"){
		$("#modal-loader").modal("hide");
	}
	if(options.url === "manajemen_bab/tambah"){
		$("#modal-loader").modal("hide");
	}
	if(options.url === "manajemen_bab/proses_tambah"){
		$("#mainmodal").modal("hide");
		obj = JSON.parse(request.responseText);
		$("#konten-bab").load("manajemen_bab/filter_bab/" + obj['idmapel']);
	}
	if(alamatedit === "manajemen_bab/edit"){
		$("#modal-loader").modal("hide");
	}
	if(options.url === "manajemen_bab/proses_edit"){
		$("#mainmodal").modal("hide");
		obj = JSON.parse(request.responseText);
		$("#konten-bab").load("manajemen_bab/filter_bab/" + obj['idmapel']);
	}
	if(options.url === "manajemen_bab/proses_hapus"){
		obj = JSON.parse(request.responseText);
		$("#konten-bab").load("manajemen_bab/filter_bab/" + obj['idmapel']);
	}
	if(alamattambahsub == "manajemen_bab/tambah_sub_bab"){
		$("#modal-loader").modal("hide");
	}
	if(options.url === "manajemen_bab/proses_tambah_sub_bab"){
		$("#mainmodal").modal("hide");
		obj = JSON.parse(request.responseText);
		$("#konten-bab").load("manajemen_bab/filter_bab/" + obj['idmapel']);
	}
	if(alamateditsub === "manajemen_bab/edit_sub_bab"){
		$("#modal-loader").modal("hide");
	}
	if(options.url === "manajemen_bab/proses_edit_sub_bab"){
		$("#mainmodal").modal("hide");
		obj = JSON.parse(request.responseText);
		$("#konten-bab").load("manajemen_bab/filter_bab/" + obj['idmapel']);
	}
	if(options.url === "manajemen_bab/proses_hapus_sub_bab"){
		obj = JSON.parse(request.responseText);
		$("#konten-bab").load("manajemen_bab/filter_bab/" + obj['idmapel']);
	}
});
$(document).ajaxError(function(event, request, options){
	alamat 			= options.url;
	alamatfilter 	= alamat.substring(0, 24);
	alamatedit		= alamat.substring(0, 18);
	alamattambahsub	= alamat.substring(0, 28);
	alamateditsub 	= alamat.substring(0, 26);
	if(alamatfilter === "manajemen_bab/filter_bab"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "manajemen_bab/tambah"){
		$("#modal-loader").modal("hide");
		$("#mainmodal").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "manajemen_bab/proses_tambah"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(alamatedit === "manajemen_bab/edit"){
		$("#modal-loader").modal("hide");
		$("#mainmodal").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "manajemen_bab/proses_edit"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "manajemen_bab/proses_hapus"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(alamattambahsub === "manajemen_bab/tambah_sub_bab"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "manajemen_bab/proses_tambah_sub_bab"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(alamateditsub === "manajemen_bab/edit_sub_bab"){
		$("#modal-loader").modal("hide");
		$("#mainmodal").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "manajemen_bab/proses_edit_sub_bab"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "manajemen_bab/proses_hapus_sub_bab"){
		$("#modal-loader").modal("hide");
		$("#modal-error").modal("show");
	}
});

})
</script>

</html>
