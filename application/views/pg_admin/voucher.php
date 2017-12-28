<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<script>
$(function(){
	$("#pilihpaket").change(function(){
		$("#pilihdurasi").load("voucher/durasi/" + $("#pilihpaket").val());
	});
	$("#pilihkelas").change(function(){
		$("#list-voucher").load("voucher/daftar/" + $("#pilihdurasi").val() + "/" + $("#pilihkelas").val());
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
                <a href="<?php echo site_url('pg_admin/voucher/manajemen/tambah') ?>" class="btn btn-success btn-fill pull-right"><i class="fa fa-plus"></i>Tambah Voucher</a>
                <h4 class="title">Semua Voucher Terdaftar</h4>
                <p class="category">Daftar voucher</p>
              </div>
              
              <table class="table table-striped table-hover">
              	<form action="voucher/export" method="post" target="_blank">
		<tr>
			<td>
				<select class="form-control" id="pilihpaket">
					<option value="">Pilih Paket Voucher...</option>
					<option value="0">Reguler</option>
					<option value="1">Premium</option>
				</select>
			</td>
			<td>
				<select class="form-control" id="pilihdurasi" name="durasi">
					<option value="">Pilih Durasi Voucher...</option>
					<option value="all">Semua Durasi</option>
				</select>
			</td>
			<td>
				<select class="form-control" id="pilihkelas" name="kelas">
					<option value="all">Semua Kelas</option>
					<?php
					foreach($kelas as $kel){
					?>
					<option value="<?php echo $kel->id_kelas; ?>"><?php echo $kel->alias_kelas; ?></option>
					<?php
					}
					?>
				</select>
			</td>
			<td>
				<input type="submit" class="btn btn-danger" value="Export" />
			</td>
		</tr>
		</form>
	  </table>
              
              <div class="content">
                <div class="table-responsive">
                  <table id="my_datatable" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Kode Voucher</th>
                        <th>Durasi</th>
                        <th>Paket</th>
                        <th>Kelas</th>
                        <!-- <th>Kelas</th> -->
                        <th>Keterangan</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody id="list-voucher">
                      <?php
                        $no = 1; 
                        foreach ($table_data as $item) 
                        {
                      ?>
                        <tr>
                          <td><?php echo $no;?></td>
                          <td><?php echo $item->kode_voucher;?></td>
                          <td><?php echo ($item->tipe == 0) ? 'Reguler' : 'Premium';?></td>
                          <td><?php echo $item->durasi;?> bulan</td>
                          <td><?php echo $item->alias_kelas;?></td>
                          <!-- <td><?php echo ($item->tipe == 0) ? $item->alias_kelas : 'Semua Kelas';?></td> -->
                          <td><?php echo $item->ket;?></td>
                          <td><?php
              								if(strpos($item->status, '0')!==FALSE){
              									echo "Available";
              								}else{
              									echo "Activated";
              								}
              						  ?>
                          </td>
                              <?php
                              $no++;
                            }
                           ?>
                           
                           </td>
                        </tr>
                      <?php
                      ?>
                    </tbody>
                  </table>
                </div>
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
