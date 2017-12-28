<?php include('header_dashboard.php'); ?>

    <div class="container-fluid akun-container">
			<div class="col-lg-12">
			
        <?php echo $this->session->flashdata('alert'); ?>
        
        <div class="row">
          <div class="col-xs-12 well">
            <h3 class="text-center">Daftar Riwayat Transaksi Pembelian Voucher</h3>
            <br>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th class="center">No. Invoice</th>
                    <th class="center">Tanggal Cetak</th>
                    <th class="center">Total</th>
                    <th class="center">Status</th>
                    <th class="center">Detail</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($data_pembelian as $item) 
                  { ?>
                  <tr>
                    <td class="center">#<?php echo $item->no_tagihan;?></td>
                    <td class="center"><?php echo date('d M Y', strtotime($item->timestamp));?></td>
                    <td><span class="pull-left">Rp</span> <span class="pull-right"><?php echo number_format($item->total_harga);?>-</span></td>
                    <td class="text-center">
                    <?php
                      if($item->status == 0) { ?>  
                        <label class="label label-warning">Belum Lunas</label>
                      <?php }
                      elseif($item->status == 1) { ?> 
                        <label class="label label-default">Menunggu Konfirmasi</label>
                      <?php }
                      elseif($item->status == 2){ ?> 
                        <label class="label label-success">Lunas</label>
                      <?php }
                      elseif($item->status == 3){ ?> 
                        <label class="label label-danger">Dibatalkan</label>
                      <?php }
                    ?>
                    </td>
                    <td class="center">
					<?php
                      if($item->status == 0) { ?>  
                          <a href="<?php echo base_url('user/bayar/'.$item->id_pembelian);?>">
							<span class="btn btn-sm btn-info">Konfirmasi Pembayaran <i class="glyphicon glyphicon-arrow-right"></i>
						  </a>
                      <?php }
                      elseif($item->status == 1) { ?> 
                         <a href="<?php echo base_url('user/bayar/'.$item->id_pembelian);?>">
							<span class="btn btn-sm btn-info">Lihat Invoice <i class="glyphicon glyphicon-arrow-right"></i>
						  </a>
                      <?php }
                      elseif($item->status == 2){ ?> 
                         <a href="<?php echo base_url('user/bayar/'.$item->id_pembelian);?>">
							<span class="btn btn-sm btn-info">Lihat Invoice <i class="glyphicon glyphicon-arrow-right"></i>
						  </a>
                      <?php }
                      elseif($item->status == 3){ ?> 
                         <a href="<?php echo base_url('user/bayar/'.$item->id_pembelian);?>">
							<span class="btn btn-sm btn-info">Lihat Invoice <i class="glyphicon glyphicon-arrow-right"></i>
						  </a>
                      <?php }
                    ?>
                      
                    </td>
                  </tr>
                  <?php 
                  } ?>
                </tbody>
              </table>
            </div>
           </div>
           <!--SAGAB-->
                    <div class="col-xs-12">
                        <h3 style="text-align: center">Daftar Riwayat Pembayaran CBT</h3>
                        <table class="table table-bordered table-hover">
                            <tr style="background-color: red; color: white; text-align: center">
                                <td>No.</td>
                                <td>Jenis Tes CBT</td>
                                <td>Tanggal Daftar</td>
                                <td>Biaya Pendaftaran</td>
                                <td>Status Pembayaran</td>
                                <td>Detail</td>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($riwayat_cbt as $info) {
                                $id_bayar_cbt = $info->id_bayar_cbt;
                                $id_profil_tes = $info->id_profil;
                                $tanggal_pendaftaran = $info->tgl_daftar;
                                $status_pembayaran = $info->status;
                                $cek_info_jenis_tryout = $this->model_pembayaran->jenis_tes_cbt($id_profil_tes);
                                $pecah_tryout = explode("_", $cek_info_jenis_tryout);
                                $jenis_tes = $pecah_tryout[0];
                                $biaya_tes = $pecah_tryout[1];
                                ?>
                                <tr>
                                    <td style="text-align: center">
                                        <?php echo $no ++; ?>                            
                                    </td>
                                    <td>
                                        <?php echo $jenis_tes ?>                            
                                    </td>
                                    <td><?php echo date('d M Y', strtotime($tanggal_pendaftaran)); ?></td>
                                    <td style="text-align: right">
                                        <?php echo "Rp. " . $this->model_pembayaran->titik_pemisah_uang($biaya_tes) ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php if ($status_pembayaran == 0) { ?>  
                                            <label class="label label-warning">Belum Lunas</label>
                                        <?php } elseif ($status_pembayaran == 1) {
                                            ?> 
                                            <label class="label label-default">Menunggu Konfirmasi</label>
                                        <?php } elseif ($status_pembayaran == 2) {
                                            ?> 
                                            <label class="label label-success">Lunas</label>
                                        <?php } elseif ($status_pembayaran == 3) {
                                            ?> 
                                            <label class="label label-danger">Dibatalkan</label>
                                        <?php }
                                        ?>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="<?php echo base_url('Cbt/daftar/' . $id_bayar_cbt); ?>">
                                            <span class="btn btn-sm btn-info">Lihat Invoice <i class="glyphicon glyphicon-arrow-right"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
<!--END SAGAB-->
        </div>           
      </div>
    </div>
    
    <?php include('footer.php'); ?>
    
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
		<script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
		<?php include('modal_profil.php'); ?>
  </body>
</html>
