<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('pg_admin/html_header'); ?>

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
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title"><?= $judul ?></h4>
                <?php echo $this->session->flashdata('alert'); ?>
              </div>
              <div class="content">
              	<div class="row">
					
				</div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
		<?php $this->load->view('pg_admin/footer'); ?>
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


<!-- PLUGINS FUNCTION -->
<!-- Chosen - select box plugin  -->
<script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>" type="text/javascript"></script>

<script>
$(function(){
	$("#provinsi").change(function(){
		$("#kota").load("../sekolah/ajax_kota/" + $(this).val());
	});
	$("#kota").change(function(){
		$("#sekolah").load("../sekolah/ajax_sekolah/" + $(this).val());
	});

	$("#dealer").change(function(){
		$("#idpembeliandealer").load("../sekolah/ajax_pembelian_dealer/" + $(this).val());
	});

	$("#sekolah").change(function(){
		$("#kelas").load("../sekolah/ajax_kelas/" + $(this).val());
		$("#tahun").load("../sekolah/ajax_tahun/" + $(this).val());
	});
});
</script>

</html>
