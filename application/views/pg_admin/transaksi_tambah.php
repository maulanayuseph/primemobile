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

								<form action="<?= base_url('pg_admin/transaksi/proses_beli') ?>" method="post">
									<div class="form-horizontal">
										
										<div class="form-group">
											<div class="col-md-2 col-xs-12" style="margin-top:10px;">Nama</div>
											<div class="col-md-4 col-xs-12">
												<input type='text' name="nama" id="nama" value="<?php echo $nama ?>" placeholder="Masukkan Nama" class="form-control" required/>
											</div>
											<div class="col-md-2 col-xs-12" style="margin-top:10px;">Email</div>
											<div class="col-md-4 col-xs-12">
												<input type='text' name="email" id="email" value="<?php echo $email ?>" placeholder="Masukkan Email" class="form-control" required/>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group">
											<div class="col-md-2 col-xs-12" style="margin-top:10px;">Nomor Handphone</div>
											<div class="col-md-4 col-xs-12">
												<input type='text' name="hp" id="hp" value="<?php echo $hp ?>" placeholder="Masukkan Nomor Handphone" class="form-control" required/>
											</div>
											<div class="col-md-2 col-xs-12" style="margin-top:10px;">Methode Pembayaran</div>
											<div class="col-md-4 col-xs-12">
												<select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
													<option value="">Pilih Methode Pembayaran</option>
													<option value="1" <?= $metode_pembayaran == 1 ? 'selected' : '' ?>>Transfer</option>
													<option value="2" <?= $metode_pembayaran == 2 ? 'selected' : '' ?>>Indomaret</option>
													<option value="3" <?= $metode_pembayaran == 3 ? 'selected' : '' ?>>Indihome</option>
													<option value="4" <?= $metode_pembayaran == 4 ? 'selected' : '' ?>>Sekolah</option>
													<option value="5" <?= $metode_pembayaran == 5 ? 'selected' : '' ?>>Demo/Promo</option>
												</select>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group">
											<div class="col-md-2 col-xs-12" style="margin-top:10px;">Tipe Customer</div>
											<div class="col-md-4 col-xs-12">
												<select name="tipe" id="tipe" class="form-control" required>
													<option value="" <?= $tipe == '' ? 'selected' : '' ?>>Pilih Tipe</option>
													<option value="0" <?= $tipe == '0' ? 'selected' : '' ?>>Umum</option>
													<option value="1" <?= $tipe == '1' ? 'selected' : '' ?>>Distributor</option>
													<option value="2" <?= $tipe == '2' ? 'selected' : '' ?>>Agen Grade A Plus</option>
													<option value="6" <?= $tipe == '6' ? 'selected' : '' ?>>Agen Grade A Plus (1 Bulan)</option>
													<option value="3" <?= $tipe == '3' ? 'selected' : '' ?>>Agen Grade A</option>
													<option value="4" <?= $tipe == '4' ? 'selected' : '' ?>>Agen Grade B</option>
													<option value="5" <?= $tipe == '5' ? 'selected' : '' ?>>Agen Grade C</option>
												</select>
											</div>
											<div id="discdiv" style="display:none;">
												<div class="col-md-2 col-xs-12" style="margin-top:10px;">Discount</div>
												<div class="col-md-4 col-xs-12">
													<input type='text' name="disc" id="disc" value="<?php echo $disc ?>" placeholder="Masukkan Discount" class="form-control" required/>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
										
										<hr>
										<h4>PILIHAN PAKET</h4>
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
													{ 
														if ($item->id_paket < 20){
													?>
													<tr>
														<td><?php echo $item->kode_paket;?></td>
														<td>Reguler <?php echo $item->durasi;?> bulan</td>
														<td style="text-align:right;">Rp <?php echo number_format($item->harga);?>-</td>
														<td style="text-align:right;">
															<input type='hidden' name="harga_<?php echo $item->id_paket;?>" id="harga_<?php echo $item->id_paket;?>" value="<?php echo $item->harga;?>"/>
															<select class="form-control" name="paket_<?php echo $item->id_paket;?>" id="paket_<?php echo $item->id_paket;?>">
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
														}
													} 
													?>
													<?php
													$jml_paket = 100;
													foreach ($data_reguler as $item) 
													{ 
														if ($item->id_paket == 22){
													?>
													<tr>
														<td><?php echo $item->kode_paket;?></td>
														<td>SBMPTN <?php echo $item->durasi;?> bulan</td>
														<td style="text-align:right;">Rp <?php echo number_format($item->harga);?>-</td>
														<td style="text-align:right;">
															<input type='hidden' name="harga_<?php echo $item->id_paket;?>" id="harga_<?php echo $item->id_paket;?>" value="<?php echo $item->harga;?>"/>
															<select class="form-control" name="paket_<?php echo $item->id_paket;?>" id="paket_<?php echo $item->id_paket;?>">
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
														}
													} 
													?>
													<?php
													$jml_paket = 100;
													foreach ($data_reguler as $item) 
													{ 
														if ($item->id_paket == 23){
													?>
													<tr>
														<td><?php echo $item->kode_paket;?></td>
														<td>DEALER <?php echo $item->durasi;?> bulan</td>
														<td style="text-align:right;">Rp <?php echo number_format($item->harga);?>-</td>
														<td style="text-align:right;">
															<input type='hidden' name="harga_<?php echo $item->id_paket;?>" id="harga_<?php echo $item->id_paket;?>" value="<?php echo $item->harga;?>"/>
															<select class="form-control" name="paket_<?php echo $item->id_paket;?>" id="paket_<?php echo $item->id_paket;?>">
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
														}
													} 
													?>
												</tbody>

												<thead>
													<tr>
														<th colspan="2" style="text-align:right;"><h4>Total</h4></th>
														<th style="text-align:right;">
															<h4 id="jumhar">0</h4>
														</th>
														<th style="text-align:right;">
															<h4 id="jumtot">0</h4>
														</th>
													</tr>
												</thead>
												
											</table>
										</div>
										
									</div>
									<div class="clearfix"></div>
									<hr>
									<div class="row">
										<div class="col-md-3 col-xs-12"><button type="submit" name="submit" value="submit" class="btn btn-success btn-block btn-fill"><i class="glyphicon glyphicon-ok"></i> Simpan Transaksi</button></div>
										<div class="col-md-6 col-xs-12"></div>
										<div class="col-md-3 col-xs-12"><a class="btn btn-default btn-block btn-fill" href="<?php echo base_url('pg_admin/transaksi') ?>"><i class="glyphicon glyphicon-share-alt"></i> Back To Table</a></div>
									</div>
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

<!-- Progress -->
<script src="<?= base_url('assets/js/nprogress.js')?>" ></script>

<script>
	$(document).ready(function() {	
			$('#tipe').change(function() {
				var c = $('#tipe').val();
				if (c === '0' || c === ''){
					$('#discdiv').hide();
				} else {
					$('#discdiv').show();
					if (c === '1'){
						$('#disc').val('40');
					} else if (c === '2'){
						$('#disc').val('35');
					} else if (c === '3'){
						$('#disc').val('30');
					} else if (c === '4'){
						$('#disc').val('25');
					} else if (c === '5'){
						$('#disc').val('20');
					} else if (c === '6'){
						$('#disc').val('62.8');
					}
				}
			});
			
			<?php	foreach ($data_reguler as $item){ ?>
			$('#paket_<?php echo $item->id_paket;?>').change(function() {
				var formData = {
					<?php	foreach ($data_reguler as $i){ ?>
						'harga<?php echo $i->id_paket;?>' : $('#harga_<?php echo $i->id_paket;?>').val(),
						'jumlah<?php echo $i->id_paket;?>' : $('#paket_<?php echo $i->id_paket;?>').val(),
					<?php	} ?>
						'disc' : $("#disc").val(),
						'metode' : $("#metode_pembayaran").val()
				};

				var urlLink = "<?php echo base_url().'pg_admin/transaksi/changeharga'; ?>";

				$.ajax({
					type:'POST',
					url:urlLink,
					data:formData,
					beforeSend: function() {
						NProgress.start();
					},
					success:function(data) { 
						NProgress.done();
						$("#jumhar").html(data);
					}
				});

			});
			<?php	} ?>
			
			<?php	foreach ($data_reguler as $item){ ?>
			$('#paket_<?php echo $item->id_paket;?>').change(function() {
				var formData = {
					<?php	foreach ($data_reguler as $i){ ?>
						'jumlah<?php echo $i->id_paket;?>' : $('#paket_<?php echo $i->id_paket;?>').val(),
					<?php	} ?>
				};

				var urlLink = "<?php echo base_url().'pg_admin/transaksi/changeunit'; ?>";

				$.ajax({
					type:'POST',
					url:urlLink,
					data:formData,
					beforeSend: function() {
						NProgress.start();
					},
					success:function(data) { 
						NProgress.done();
						$("#jumtot").html(data);
					}
				});

			});
			<?php	} ?>
	});
</script>				
 
</html>
