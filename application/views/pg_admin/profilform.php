<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	$("#tipe").change(function(){
		$("#paketsbmptn").load("../ajax_paket_sbmptn/" + $("#tipe").val());
	});
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
                <h4 class="title">Tambah Profil</h4>
              </div>
              <div class="content">
			  <form method="post" action="<?php echo $form_action?>" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-12">
						<div class="col-md-4 col-lg-4" style="padding-left: 6px;">
							Nama CBT
							<input type="text" class="form-control" name="nama" />
						</div>
						<div class="col-md-4 col-lg-4">
							Penyelenggara
							<input type="text" class="form-control" name="penyelenggara" />
						</div>
						<div class="col-md-4 col-lg-4">
							Biaya Test
							<input type="text" class="form-control" name="biaya" />
						</div>
						<div class="col-md-4 col-lg-4">
							Tanggal Mulai
							<input type="text" class="form-control" name="tanggal" id="datepicker"/>
						</div>
						<div class="col-md-4 col-lg-4">
							Tanggal Berakhir
							<input type="text" class="form-control" name="tanggal_akhir" id="datepicker2"/>
						</div>
						<div class="col-md-4 col-lg-4">
							Jenjang Kelas
							<select data-placeholder="Pilih Kelas..." name="kelas" class="form-control" style="width: 100%;" tabindex="2" required="required">
							  <option value=""></option>
							  <?php 
							  foreach ($select_options as $item) { ?>
								<option <?php echo set_select('kelas', $item->id_kelas, (!isset($data->id_kelas) ? FALSE : ($data->kelas == $item->id_kelas ? TRUE : FALSE)) );?>
									value="<?php echo $item->id_kelas ?>" > <?php echo $item->alias_kelas ?>
								</option>
							  <?php } ?>
							</select>
						</div>
						</div>
						
						
						<div class="col-md-6 col-lg-6">
							<div class="col-lg-12">
							Tipe Profil
							<select name="tipe" id="tipe" class="form-control">
								<option value="0">CBT Terbuka</option>
								<!-- <option value="1">CBT Contest</option> -->
								<option value="2">CBT PSEP</option>
								<option value="4">CBT Prime</option>
								<option value="5">CBT Event</option>
								<option value="3">SBMPTN</option>
							</select>
							<div id="paketsbmptn">
								
							</div>
							<br>&nbsp;
							<br><strong>Keterangan :</strong>
							<br>
							<table class="table">
								<thead>
									<tr>
										<th class="text-center">Tipe Profil</th>
										<th class="text-center">Hak Akses</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><strong>CBT Terbuka</strong></td>
										<td>Semua aktivasi</td>
									</tr>
									<tr>
										<td><strong>CBT PSEP</strong></td>
										<td>Aktivasi PSEP dan Aktivasi Reguler yang berafiliasi dengan PSEP (Assignment sekolah di menu aktivasi CBT PSEP)</td>
									</tr>
									<tr>
										<td><strong>CBT Prime</strong></td>
										<td>Aktivasi reguler, dan Aktivasi Event/Trial</td>
									</tr>
									<tr>
										<td><strong>CBT Event</strong></td>
										<td>Aktivasi Event/Trial</td>
									</tr>
								</tbody>
							</table>
							</div>
							
							<div class="col-lg-12">
							Banner Test
							<input type="file" name="banner" />
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							Keterangan
							<textarea name="keterangan" class="form-control"></textarea>
						</div>
						<div class="col-md-4 col-lg-4" style="display: none;">
							
						</div>
						<div class="col-md-4" style="display: none;">
						  <div class="form-group">
							<label>Tanggal Post <span class="text-danger">*</span></label>
							<?php echo form_error('tanggal_post', '<div class="text-danger">', '</div>'); ?>
							<input class="form-control" type="date" id="tanggal_post" name="tanggal_post" value="<?php echo set_value('tanggal_post', (!isset($data) ? date('Y-m-d') : (($data->tanggal!=0) ? $data->tanggal : date('Y-m-d'))) );?>" required="required">
						  </div>
						</div>
						<div class="col-md-4" style="display: none;">
						  <div class="form-group">
							<label>Waktu Post <span class="text-danger">*</span></label>
							<?php echo form_error('waktu_post', '<div class="text-danger">', '</div>'); ?> 
							<input class="form-control" type="time" id="waktu_post" name="waktu_post" value="<?php echo set_value('waktu_post', (!isset($data) ? date('H:i') : (($data->waktu!=0) ? $data->waktu : date('H:i'))) );?>" required="required">
						  </div>
						</div>
					</div>
					<input type="submit" value="Simpan Profil" name="form_submit" class="btn btn-primary"/>
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


<script>
$(function(){
$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
$("#datepicker2").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>

</html>
