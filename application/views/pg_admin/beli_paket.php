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
                <h4 class="title">Tambah Pembelian Paket</h4>
                <p class="category">Tambah daftar pembelian Paket</p>
              </div>
              <div class="content">

								<form action="<?= base_url('pg_admin/pembayaran/proses_beli') ?>" method="post">
									<div class="form-horizontal">
										
										<div class="form-group">
											<div class="col-md-4">Masukkan Nama</div>
											<div class="col-md-8">
												<input type='text' name="nama" id="nama" value="<?php echo $nama ?>" placeholder="Masukkan Nama" class="form-control" required/>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group">
											<div class="col-md-4">Masukkan Nomor Handphone</div>
											<div class="col-md-8">
												<input type='text' name="hp" id="hp" value="<?php echo $hp ?>" placeholder="Masukkan Nomor Handphone" class="form-control" required/>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group">
											<div class="col-md-4">Masukkan Email</div>
											<div class="col-md-8">
												<input type='text' name="email" id="email" value="<?php echo $email ?>" placeholder="Masukkan Email" class="form-control" required/>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group">
											<div class="col-md-4">Methode Pembayaran</div>
											<div class="col-md-8">
												<select name="metode_pembayaran" class="form-control" required>
													<option value="">Pilih Methode Pembayaran</option>
													<option value="1" <?= $metode_pembayaran == 1 ? 'selected' : '' ?>>Transfer</option>
													<option value="2" <?= $metode_pembayaran == 2 ? 'selected' : '' ?>>Indomaret</option>
													<option value="3" <?= $metode_pembayaran == 3 ? 'selected' : '' ?>>Indihome</option>
													<option value="4" <?= $metode_pembayaran == 4 ? 'selected' : '' ?>>Sekolah</option>
												</select>
											</div>
										</div>
										
										<hr>
										<h4>PILIHAN PAKET REGULER</h4>
										<?php if ($this->session->flashdata('msgpaket') != ''){ ?>
										<div class="col-md-12"><div class="label label-danger"><?php echo $this->session->flashdata('msgpaket'); ?></div></div>
										<?php } ?>
										<div class="table-responsive bayar-table">
											<table class="table table-striped">
												<thead>
													<tr>
														<th>Kode</th>
														<th>Pilihan Voucher</th>
														<th>Harga Satuan</th>
														<th>Jumlah</th>
													</tr>
												</thead>

												<tbody>
													<?php
													$jml_paket = 100;
													foreach ($data_reguler as $item) 
													{ ?>

													<tr>
														<td><?php echo $item->kode_paket;?></td>
														<td>Reguler <?php echo $item->durasi;?> bulan</td>
														<td>Rp <?php echo number_format($item->harga);?>-</td>
														<td>
															<select class="form-control" name="paket_<?php echo $item->id_paket;?>" style="width:70%;">
																<option value="">0</option>
																<?php for($jml=1; $jml<=$jml_paket; $jml++)
																{ ?>
																	<option value="<?php echo $jml;?>"><?php echo $jml;?></option>
																<?php 
																} ?>
															</select>
														</td>
													</tr>
													<?php
													} ?>
												</tbody>
											</table>
										</div>
										
									</div>
									<div class="clearfix"></div>
									<button type="submit" name="deleteRow_submit" value="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Simpan dan Terima Pembayaran</button>
									<a class="btn btn-default" href="<?php echo base_url('pg_admin/pembayaran') ?>"><i class="glyphicon glyphicon-share-alt"></i> Batal</a>
								</form>


              </div>
            </div>
          </div>
        </div>
      </div> 
    </div> <!-- end .content -->

  </div> <!-- end .main-panel -->
</div>

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
 
</html>
