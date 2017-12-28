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
              <div class="header">
                <h4 class="title">Profil Try Out</h4>
              </div>
              <div class="content">
					<div class="col-md-8 col-lg-8">
						<a href="tryout/tambah_paket_sbmptn" class="btn btn-primary">Tambah Paket SBMPTN</a>
						<a href="tryout/manajemen/tambahprofil" class="btn btn-primary">Tambah Profil Try Out</a>
						<a href="tryout/duplikasi" class="btn btn-primary">Duplikasi Profil</a>
					</div>
					<div class="col-md-4 col-lg-4" style="text-align: right; font-style: italic;">
						Halaman ini digunakan untuk mengatur soal yang akan
						dimasukkan/dihilangkan dari Kategori Profil Tes.
						Untuk menambah, mengubah, dan menghapus Data Soal ada di menu Bank Soal.
					</div>
					<table class="table display table-striped table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama Profil Tes</th>
								<th>Kategori</th>
								<th>Tanggal Mulai</th>
								<th>Tanggal Selesai</th>
								<th>Jenjang Kelas</th>
								<th>Tipe CBT</th>
								<th>Operasi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1; 
								foreach ($table_data as $item) 
								{
							  ?>
								<tr>
									<td><?php echo $no++;?></td>
									<td><a href="#kategori-<?php echo $item->id_tryout;?>" data-toggle="collapse" aria-expanded="false" aria-controls="kategori-<?php echo $item->id_tryout;?>"><?php echo $item->nama_profil;?></a>
									<p>
									<?php
										if($item->tipe == 1 && $item->status == 0){
											echo "<a href='tryout/aktifcbt/$item->id_tryout'>Aktifkan PopUp dan Pendaftaran</a>";
										}elseif($item->tipe == 1 && $item->status == 1){
											echo "<a href='tryout/nonaktifcbt/$item->id_tryout'>Nonaktifkan PopUp dan Pendaftaran</a>";
										}
									?>
									</td>
									<td>
										<a href="tryout/manajemen/tambahkategori/<?php echo $item->id_tryout;?>" class="btn btn-primary"><i class="fa fa-cogs" aria-hidden="true"></i></a>
									</td>
									<td>
										<?php echo $item->start_date;?>
									</td>
									<td>
										<?php echo $item->end_date;?>
									</td>
									<td><?php echo $item->alias_kelas;?></td>
									<td>
									<?php 
									if($item->tipe == "0"){
										echo "Reguler";
									}elseif($item->tipe == "1"){
										echo "CBT Contest";
									}elseif($item->tipe == "2"){
										echo "PSEP Sekolah";
									}
									?>
									</td>
									<td class="text-center">
										<div class="button-group">
										  <a href="<?php echo base_url("pg_admin/tryout/editprofil/".$item->id_tryout);?>" class="btn btn-warning btn-xs" title="Ubah">
										  <i class="glyphicon glyphicon-pencil"></i>
										  </a>
										  
										  
										  <a href="<?php echo base_url('pg_admin/tryout/hapus_profil/'.$item->id_tryout);?>" class="btn btn-danger btn-xs" title="hapus" onclick="return confirm('Dengan menghapus profil <?php echo $item->nama_profil;?> semua data kategori, penilaian dan statistik siswa akan ikut terhapus dan tidak dapat diulang kembali. Lanjutkan?')"><i class="glyphicon glyphicon-remove"></i></a>
										</div>
									 </td>
								</tr>
								<tr>
									<td colspan="8">
										<div class="collapse" id="kategori-<?php echo $item->id_tryout;?>">
											<table class="table table-striped table-bordered">
												<thead>
													<tr>
														<th class="text-center">Kategori</th>
														<th class="text-center">Jumlah Soal</th>
														<th class="text-center">Durasi</th>
														<th class="text-center">Ketuntasan</th>
														<th class="text-center">Aktivasi</th>
														<th class="text-center">Operasi</th>
													</tr>
												</thead>
												<tbody>
													<?php
														//CARI KATEGORI TRYOUT YANG ADA
														$carikategori = $this->model_tryout->get_kategori_by_profil($item->id_tryout);
														if($carikategori !== null){
															foreach($carikategori as $kategori){
																?>
																<tr>
																	<td>
																		<?php echo $kategori->nama_kategori;?>
																	</td>
																	<td class="text-center">
																		<?php
																			//CARI JUMLAH SOAL
																			$jumlah = $this->model_tryout->fetch_jumlah_soal_by_kategori($kategori->id_kategori);

																			echo $jumlah;
																		?> Soal
																	</td>
																	<td class="text-center">
																		<?php echo $kategori->durasi;?> Menit
																	</td>
																	<td class="text-center">
																		<?php echo $kategori->ketuntasan;?>%
																	</td>
																	<td class="text-center">
																		<?php
																			if($kategori->status == 0){
																				?>
																				<a href="<?php echo base_url("pg_admin/tryout/manajemen/aktivasi/" . $kategori->id_kategori);?>" class="btn btn-sm btn-danger">non-aktif</a>
																				<?php
																			}else{
																				?>
																				<a href="<?php echo base_url("pg_admin/tryout/manajemen/nonaktif/" . $kategori->id_kategori);?>" class="btn btn-sm btn-success">aktif</a>
																				<?php
																			}
																		?>
																	</td>
																	<td class="text-center">
																		<a href="<?php echo base_url("pg_admin/tryout/manajemen/managesoal/".$kategori->id_kategori);?>" class="btn btn-danger btn-sm">edit soal</a>
																		<a href="<?php echo base_url("pg_admin/tryout/manajemen/hapuskategori/".$kategori->id_kategori);?>" class="btn btn-danger btn-sm" onclick="return confirm('Dengan menghapus profil <?php echo $kategori->nama_kategori;?> semua data kategori, penilaian dan statistik siswa akan ikut terhapus dan tidak dapat diulang kembali. Lanjutkan?')">hapus kategori</a>
																		<a href="<?php echo base_url("pg_admin/tryout/manajemen/editkategori/".$kategori->id_kategori);?>" class="btn btn-danger btn-sm">edit kategori</a>
																	</td>
																</tr>
																<?php
															}
														}
													?>
												</tbody>
											</table>
										</div>
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
			
          </div>
        </div>
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div> <!-- end .main-panel -->
</div>

<?php include "alert_modal.php"; ?>

<?php
$no = 1; 
foreach ($table_data as $item) 
{
	if($item->banner !== ""){
		?>
		<div class="modal fade" id="modalbanner<?php echo $item->id_tryout;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php echo $item->nama_profil;?></h4>
			  </div>
			  <div class="modal-body">
				<img src="<?php echo base_url('assets/uploads/banner/'.$item->banner);?>" class="img img-responsive"/>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		<?php
	}
?>
<?php
}
?>

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

<script type="text/javascript">
$(document).ready(function(){
$('table.display').DataTable();
})
</script>


</html>
