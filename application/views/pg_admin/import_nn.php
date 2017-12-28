<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php";?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
              </div>
              <div class="content">
				<form method="post" action="<?php echo base_url() ?>pg_admin/nilainasional/prosesimportcsv" enctype="multipart/form-data">
					<div class="form-horizontal">
						<?php 
						if ($error != ''){
								echo '<div class="alert alert-danger">'.$error.'</div>';
						} 
						if ($this->session->flashdata('sukses') != ''){
								echo '<div class="alert alert-success">'.$this->session->flashdata('sukses').'</div>';
						} 
						?>
						<div class="clearfix"></div>
						<div class="form-group">
							<label for="kode" class="col-sm-2 control-label left">Pilih File</label>
							<div class="col-sm-4"><input type="file" name="userfile" ></div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3"><button type="submit" class="btn btn-primary btn-block" >Submit</button></div>
							<div class="col-sm-3"><a href="<?= base_url('aktivasi') ?>" class="btn btn-warning btn-block" >Cancel</a></div>
						</div>
					</div>
					</form>

				
                <div class="footer">
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <?php include "footer.php"; ?>

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
<div id="list_modal">
<?php
$no=1;
foreach($data_soal as $data){
?>
<div class="modal fade" id="myModal<?php echo $data->id_banksoal;?>" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
	<div class="modal-content" id="modalsoal">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  </div>
	  <div class="modal-body">
		<p><?php echo $data->pertanyaan; ?></p>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  </div>
	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
$no++;
}
?>
</div>
</html>
