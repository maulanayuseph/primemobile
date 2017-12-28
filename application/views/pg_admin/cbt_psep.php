<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>


<script>
$(function(){
	$("#provinsi").change(function(){
		$("#kota").load("ajax_kota/" + $("#provinsi").val());
	});
	$("#kota").change(function(){
		$("#sekolah").load("ajax_sekolah/" + $("#kota").val());
	});
	$("#sekolah").change(function(){
		$("#tahunajaran").load("ajax_tahun_ajaran/" + $("#sekolah").val());
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
                <h4 class="title">CBT PSEP</h4>
              </div>
              <div class="content">
				<form action="<?php echo base_url("pg_admin/tryout/proses_aktif_psep");?>" method="post">
					<div class="col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="profil">Profil CBT</label>
							<select name="profil" class="form-control" id="profil" required>
								<option value="">-- Pilih Profil CBT PSEP --</option>
								<?php
									foreach($table_data as $data){
								?>
								<option value="<?php echo $data->id_tryout;?>"><?php echo $data->nama_profil;?></option>
								<?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="provinsi">Provinsi Sekolah</label>
							<select class="form-control" id="provinsi" required>
								<option value="">-- Pilih Provinsi Sekolah --</option>
								<?php
									foreach($dataprovinsi as $provinsi){
								?>
								<option value="<?php echo $provinsi->id_provinsi;?>"><?php echo $provinsi->nama_provinsi;?></option>
								<?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="kota">Kota/Kabupaten Sekolah</label>
							<select class="form-control" id="kota" required>
								<option value="">-- Pilih Kota/Kabupaten Sekolah --</option>
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="sekolah">Sekolah</label>
							<select name="sekolah" class="form-control" id="sekolah" required>
								<option value="">-- Pilih Sekolah --</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="sekolah">Tahun Ajaran</label>
							<select name="tahunajaran" class="form-control" id="tahunajaran" required>
								<option value="">-- Pilih Tahun Ajaran --</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="semester">Semester</label>
							<select name="semester" class="form-control" id="semester" required>
								<option value="">-- Pilih Semester --</option>
								<option value="1">Semester 1</option>
								<option value="2">Semester 2</option>
							</select>
						</div>
					</div>
					<div class="col-sm-12">
						<input type="submit" value="Aktivasi CBT" class="btn btn-primary"/>
					</div>
				</form>
				<div class="col-sm-12">
					<br>&nbsp;
				</div>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>Profil CBT</th>
							<th>Sekolah</th>
							<th>Tahun Ajaran</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$x = 1;
							foreach($datacbt as $cbt){
						?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $cbt->nama_profil;?></td>
								<td><?php echo $cbt->nama_sekolah;?></td>
								<td><?php echo $cbt->tahun_ajaran;?></td>
								<td>
									<a href="<?php echo base_url("pg_admin/tryout/hapus_aktivasi_psep/".$cbt->id_cbt);?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus aktivasi <?php echo $cbt->nama_profil;?> untuk <?php echo $cbt->nama_sekolah;?> ?');"><i class="fa fa-times" aria-hidden="true"></i></a>
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
});
</script>

</html>
