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
        	<div class="col-sm-12" style="text-align: right;">
				<a class="btn btn-sm btn-danger" href="<?php echo base_url("pg_admin/diagnostictest/tambah_profil");?>">Tambah Profil</a>
				<br>&nbsp;
        	</div>
        	<div class="col-sm-12">
        		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        		<?php
        			foreach($dataprofil as $profil){
        				?>
        				<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<div class="row">
									<div class="col-sm-3">
										<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $profil->id_profil_diagnostic;?>" aria-expanded="true" aria-controls="collapse<?php echo $profil->id_profil_diagnostic;?>">
											<?php echo $profil->nama_profil_diagnostic;?>
										</a>
									</div>
									<div class="col-sm-3">
										<?php echo $profil->alias_kelas;?> (<?php echo $profil->kurikulum;?>)
									</div>
									<div class="col-sm-3">
										<?php echo $profil->start_date;?> - <?php echo $profil->end_date;?>
									</div>
									<div class="col-sm-3" style="text-align: right;">
										<a class="btn btn-sm btn-danger tambah-kategori" href="<?php echo base_url("pg_admin/diagnostictest/tambah/".$profil->id_profil_diagnostic);?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
							<div id="collapse<?php echo $profil->id_profil_diagnostic;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<!-- isi kategori-->
									<table class="table table-striped">
										<thead>
											<tr>
												<th class="text-center">Nama Test</th>
												<th class="text-center">Jumlah Soal</th>
												<th class="text-center">Durasi</th>
												<th class="text-center">Ketuntasan</th>
												<th class="text-center">Operasi</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$carikategori = $this->model_agcu->get_diagnostic_by_profil($profil->id_profil_diagnostic);
												foreach($carikategori as $kategori){
													$jumlahsoal = $this->model_agcu->fetch_jumlah_soal_by_kategori($kategori->id_diagnostic);
													?>
													<tr>
														<td><?php echo $kategori->nama_kategori;?></td>
														<td class="text-center"><?php echo $jumlahsoal;?> Soal</td>
														<td class="text-center">
															<?php echo $kategori->durasi;?> Menit
														</td>
														<td class="text-center">
															<?php echo $kategori->ketuntasan;?>%
														</td>
														<td class="text-center">
															<a class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/diagnostictest/edit/".$kategori->id_diagnostic);?>"><i class="fa fa-cog" aria-hidden="true"></i></a>

															<a class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/diagnostictest/edit_soal/".$profil->id_profil_diagnostic . "/" . $kategori->id_diagnostic);?>"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a>

															<a href="diagnostictest/hapus/<?php echo $kategori->id_diagnostic;?>" class="btn btn-danger btn-xs" title="Ubah" onclick="return confirm('apakah anda yakin untuk menghapus diagnostic test <?php echo $datadiag->nama_kategori;?>?')"><i class="glyphicon glyphicon-remove"></i></a>
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
        				<?php
        			}
        		?>
        			
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

<!--  Datatables Plugin -->

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
<!-- PLUGINS FUNCTION -->
<!-- Chosen - select box plugin  -->
<script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>" type="text/javascript"></script>

<script>
$(function(){
	
});
</script>

</html>
