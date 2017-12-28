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
					<div class="col-sm-12">
						<strong>
						PENERBITAN VOUCHER : 
						<?php
							//var_dump($penerbitan['data']);
							if($tipe == 0){
								foreach($penerbitan['data'] as $terbit){
									if($terbit['id_penjualan'] == $idpenerbitan){
										echo $terbit['nama_customer'] . " - " . $terbit['no_tagihan'];
									}
								}
							}elseif($tipe == 1){
								foreach($penerbitan['data'] as $data){
									if($terbit['id_psep_kuota_log'] == $idpenerbitan){
										//cari sekolah
										$sekolah 	= $this->model_aktivasi_psep->fetch_sekolah_by_id($data['sekolah_id']);
										$paket 		= $this->model_aktivasi_psep->fetch_paket_by_id($data['paket_id']);

										echo $sekolah->nama_sekolah . " Aktivasi PSEP " .  $paket->durasi . " Bulan";
									}
								}
							}
						?>
						</strong>
						<p>
							<table class="table">
								<tr>
									<td style="width: 200px;">Jumlah Voucher</td>
									<td style="width: 10px;">:</td>
									<td><?php echo $jumlahvoucher;?></td>
								</tr>
								<tr>
									<td>Terpakai</td>
									<td>:</td>
									<td><?php echo $terpakai;?></td>
								</tr>
								<tr>
									<td>Tersedia</td>
									<td>:</td>
									<td><?php echo $tidakterpakai;?></td>
								</tr>
							</table>
					</div>
					<div class="col-sm-12">
						&nbsp;
					</div>
					<div class="col-sm-12">
						<table class="display table table-bordered table-striped">
							<thead>
								<tr>
									<th style="width: 10px;">#</th>
									<th>Kode Voucher</th>
									<th>Siswa</th>
									<th>Sekolah</th>
									<th>Kelas</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$x = 1;
									foreach($datavoucher['data'] as $data){
										$cekpaketaktif = $this->model_voucher->cek_paket_aktif_by_voucher($data['kode_voucher']);
										if($cekpaketaktif > 0){
											$siswa = $this->model_voucher->fetch_siswa_by_aktivasi($data['kode_voucher']);
											$namasiswa 		= $siswa->nama_siswa;
											$namasekolah 	= $siswa->nama_sekolah;
											$kelas 			= $siswa->alias_kelas;
										}else{
											$namasiswa 		= "-";
											$namasekolah 	= "-";
											$kelas 			= "-";
										}
										?>
										<tr>
											<td><?php echo $x;?></td>
											<td><?php echo $data['kode_voucher'];?></td>
											<td>
												<?php echo $namasiswa;?>
											</td>
											<td class="text-center">
												<?php echo $namasekolah;?>
											</td>
											<td class="text-center">
												<?php echo $kelas;?>
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
        
      </div>
    </div>
		<?php $this->load->view('pg_admin/footer'); ?>
  </div>
</div>

<?php 
$this->load->view("pg_admin/modal_ajax");
?>

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
<!-- PLUGINS FUNCTION -->
<!-- Chosen - select box plugin  -->
<script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $('table.display').DataTable();
});
</script>

</html>
