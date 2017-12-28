<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

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
				<div class="content">
				  <form method="post" action="<?php echo $form_action?>">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Pilih Paket</label><?php echo form_error('paket', '<div class="text-danger">', '</div>'); ?>
								<select data-placeholder="Pilih paket..." name="paket" class="form-control" style="width: 100%;" tabindex="1" required="required">
									  <option value="" disabled selected>Pilih paket...</option>
									  <?php 
									  foreach ($paket_reguler as $item) { 
									  ?>
										<option value="<?php echo $item->id_paket; ?>">Reguler <?php echo $item->durasi;?> bulan</option>
									  <?php } ?>
									  <?php 
									  foreach ($paket_premium as $item) { 
									  ?>
										<option value="<?php echo $item->id_paket; ?>">Premium <?php echo $item->durasi;?> bulan</option>
									  <?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Pilih Kelas</label><?php echo form_error('kelas', '<div class="text-danger">', '</div>'); ?>
								<select data-placeholder="Pilih kelas..." name="kelas" class="form-control" style="width: 100%;" tabindex="1" required="required">
									  <option value="" disabled selected>Pilih kelas...</option>
									  <?php 
									  foreach ($data_kelas as $item) { 
									  ?>
										<option value="<?php echo $item->id_kelas; ?>"><?php echo $item->alias_kelas;?></option>
									  <?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Keterangan</label><?php echo form_error('kelas', '<div class="text-danger">', '</div>'); ?>
								<select data-placeholder="Pilih kelas..." name="keterangan" class="form-control" style="width: 100%;" tabindex="1" required="required">
									  <option value="online">Online</option>
									  <option value="fisik">Fisik</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 col-lg-6 col-sm-6">
							<div class="form-group">
								<label>Jumlah Voucher</label>
								<input type="number" class="form-control" name="jumlah" value="1" />
							</div>
						</div>
					</div>
					
					<div class="row">
                    <div class="col-md-12">
                      <button type="submit" name="form_submit" value="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                      <button type="reset" class="btn btn-danger pull-right" onclick="return resetForm(this.form);"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                  </div>
				  </form>
				</div>
			</div>
			
          </div>
        </div>
      </div> 
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div> <!-- end .main-panel -->
</div>

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

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

 <!-- JS Function for this Modal -->
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
