<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('pg_admin/html_header'); ?>

<div class="wrapper">
	<?php $this->load->view('pg_admin/sidebar'); ?>

  <div class="main-panel">
		<?php $this->load->view('pg_admin/navbar'); ?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title"><?= $judul ?></h4>
              </div>
              <div class="content">
                <form method="post" action="<?= $action ?>" enctype="multipart/form-data"> 
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
												<?php if ($this->session->flashdata('hasil') != ''){ ?>
												<label class="alert alert-success" style="width:100%"><i><?= $this->session->flashdata('hasil') ?></i></label>
												<?php } ?>
												<?php if ($this->session->flashdata('error') != ''){ ?>
												<label class="alert alert-danger" style="width:100%"><i><?= $this->session->flashdata('error') ?></i></label>
												<?php } ?>
											</div>
										</div>
									</div>
                  <div class="form-group">
                    <label>Mata Pelajaran<span class="text-danger">*</span></label>
                    <div class="row">
                      <div class="col-md-6">
                        <select data-placeholder="Pilih Mata Pelajaran..." name="nama_mapel" class="chosen-select" onchange="fetch_select_materi_pokok(this.value)" style="width: 100%;" tabindex="2" required="required">
                          <option value=""></option>
                          <?php 
                          foreach ($select_options_mapel as $item) { 
                            $option_name = $item->nama_mapel . " - " . $item->alias_kelas;
                          ?>
                          <option value="<?php echo $item->id_mapel ?>" > <?php echo $option_name ?> </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
									<div class="form-group">
										<label>Pilih File</label>
                    <div class="row">
                      <div class="col-md-6">
												<input type="file" name="userfile" >
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6" style="padding-left:0;padding-right:15px;"><button type="submit" class="btn btn-primary btn-block" >Submit</button></div>
										<div class="col-md-6">&nbsp</div>
									</div>
									<div class="clearfix"></div>

                </form>

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
<script type="text/javascript">
	function resetForm(form){
		// clearing Chosen selects
		$('.chosen-select').val('').trigger('chosen:updated');

	}
</script>

<!-- PLUGINS FUNCTION -->
<!-- Chosen - select box plugin  -->
<script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>" type="text/javascript"></script>
<script type="text/javascript">
	var config = {
		'.chosen-select'           : {},
		'.chosen-select-deselect'  : {allow_single_deselect:true},
		'.chosen-select-no-single' : {disable_search_threshold:10},
		'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
		'.chosen-select-width'     : {width:"95%"}
	}
	for (var selector in config) {
		$(selector).chosen(config[selector]);
	}
</script>

</html>
