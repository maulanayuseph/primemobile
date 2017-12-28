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
						<h4 class="title">Tambah Materi Mata Pelajaran</h4>
              		</div>
              	</div>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-12">
						
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

$("#filter-mapel-kurikulum").change(function(){
	idkelas 		= $("#filter-mapel-kelas").val();
	idkurikulum 	= $(this).val();
	if(idkelas !== "" && idkurikulum !== ""){
		$("#filter-mapel-mapel").load("manajemen_bab/filter_mapel/" + idkelas + "/" + idkurikulum);
	}else{
		$("#filter-mapel-mapell").html("<option value=''>-- Filter Mapel --</option>");
	}
})

$("#filter-mapel-kelas").change(function(){
	idkurikulum = $("#filter-mapel-kurikulum").val();
	idkelas 	= $(this).val();
	if(idkurikulum !== "" && idkelas !== ""){
		$("#filter-mapel-mapel").load("manajemen_bab/filter_mapel/" + idkelas + "/" + idkurikulum);
	}else{
		$("#filter-mapel-mapel").html("<option value=''>-- Filter Mapel --</option>");
	}
})

$("#filter-mapel-mapel").change(function(){
	idmapel = $(this).val();
	if(idmapel !== ""){
		$("#filter-mapel-bab").load("manajemen_konten/ajax_bab/" + idmapel);
	}
})

$("#filter-mapel-bab").change(function(){
	idbab = $(this).val();
	if(idbab !== ""){
		$("#filter-mapel-sub").load("manajemen_konten/ajax_sub_bab/" + idbab);
	}
})

$("#filter-konten-mapel").click(function(){
	idsubbab = $("#filter-mapel-sub").val();
	if(idsubbab !== ""){
		$("#daftar-konten-mapel").load("manajemen_konten/filter_konten/" + idsubbab);
	}else{
		alert("Lengkapi filter sebelum menampilkan konten");
	}
})

$(document).ajaxSend(function(event, jqxhr, settings){
	alamat 			= settings.url;
	
});
$(document).ajaxSuccess(function(event, request, options){
	alamat 			= options.url;
	
});
$(document).ajaxError(function(event, request, options){
	alamat 			= options.url;
	
});

})
</script>

</html>
