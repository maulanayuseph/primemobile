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
				<div class="col-lg-12">
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>Nama Siswa</th>
								<th>CBT</th>
								<th>Biaya</th>
								<th>Bukti</th>
								<th>status</th>
								<th>Operasi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($data_bayar as $bayar){
									?>
										<tr>
											<td><?php echo $bayar->nama_siswa;?></td>
											<td><?php echo $bayar->nama_profil; ?></td>
											<td><?php echo $bayar->biaya;?></td>
											<td>
												<?php
													if($bayar->status_bayar == 0){
														echo "-";
													}elseif($bayar->status_bayar == 1 OR $bayar->status_bayar == 2 OR $bayar->status_bayar == 3){
														echo "
															<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modalbukti$bayar->id_bayar_cbt'>
															  <span class='glyphicon glyphicon-picture'></span>
															</button>
														";
													}else{
														echo "-";
													}
												?>
											</td>
											<td>
											<?php
												if($bayar->status_bayar == '0'){
													echo "<label class='label label-warning'>Belum Lunas</label>";
												}elseif($bayar->status_bayar == '1'){
													echo "<label class='label label-primary'>Menunggu </label>";
												}elseif($bayar->status_bayar == '2'){
													echo "<label class='label label-success'>Lunas</label>";
												}elseif($bayar->status_bayar == '3'){
													echo "<label class='label label-danger'>Ditolak</label>";
												}
											?>
											</td>
											<td>
												<?php
													if($bayar->status_bayar == 0){
														echo "-";
													}elseif($bayar->status_bayar == 1){
														echo "
															<a href='konfirmasi_cbt/$bayar->id_bayar_cbt/$bayar->id_siswa' class='btn btn-success'><span class='glyphicon glyphicon-ok'></span></a> <a href='tolak_cbt/$bayar->id_bayar_cbt/$bayar->id_siswa' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span></a>
														";
													}elseif($bayar->status_bayar == 3){
														echo "
															<a href='konfirmasi_cbt/$bayar->id_bayar_cbt/$bayar->id_siswa' class='btn btn-success'><span class='glyphicon glyphicon-ok'></span></a> <a href='tolak_cbt/$bayar->id_bayar_cbt/$bayar->id_siswa' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span></a>
														";
													}else{
														echo "-";
													}
												?>
											</td>
										</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
        </div>
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div> <!-- end .main-panel -->
</div>

<?php include "alert_modal.php"; ?>

<?php
foreach($data_bayar as $bayar){
?>
<div class="modal fade" id="modalbukti<?php echo $bayar->id_bayar_cbt;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <img src="<?php echo base_url('assets/uploads/bukti_cbt/'.$bayar->bukti);?>" class="img img-responsive"/>
      </div>
    </div>
  </div>
</div>
<?php
}
?>
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

</html>
