<!DOCTYPE html>

<html lang="en">

  <head>    

    <title>Prime Generation Integrative Online Learning</title>

    

    <!-- Meta Tags -->

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <meta name="description" content="">

    <meta name="keywords" content="">

    <meta name="author" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    

    <!-- Icon -->

    <link rel="shortcut icon" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>">

    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>">

    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>">

    

    <!-- Stylesheets -->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom-3.css');?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">

    

  </head>

  <body>

    <div class="header">

      <!-- Navbar  -->

      <?php include('header_dynamic.php');?>

    </div>

    

    <section class="page bayar">

      <!-- apa kata -->

      <div class="container-fluid">     

        <h4 class="pay-title">Rincian Transaksi Pembayaran</h4>

        <?php

        if($buy->status != 3) //3 = pembelian batal

        { ?> 

          <a href="<?php echo base_url('user/cetak_invoice/'.$this->uri->segment(3));?>" target="_blank" class="btn btn-default btn-cetak">

            CETAK <span class="glyphicon glyphicon-print" aria-hidden="true"></span>

          </a>

        <?php 

        } ?>

        <div class="table-responsive tabel-tagihan">

          <table class="table">

            <thead>

              <tr>

                <td class="buy-item">Nomor Tagihan</td>

                <td>: #<?php echo $buy->no_tagihan?></td>

              </tr>

            </thead>

            <tbody>

              <tr>

                <td class="buy-item">Tanggal/Waktu</td>

                <td>: <?php echo date('d/m/Y, H:i:s', strtotime($buy->timestamp));?></td>

              </tr>

              <tr>

                <td class="buy-item">Pemesan</td>

                <td>: <?php echo $buy->nama_siswa;?> <?php echo $buy->email ? "($buy->email)" : '';?></td>

              </tr>

              <tr>

                <td class="buy-item">Status</td>

                <td>: 

                  <?php

                    if($buy->status == 0) { ?>  

                      <label class="label label-warning">Belum Lunas</label>

                    <?php }

                    elseif($buy->status == 1) { ?> 

                      <label class="label label-default">Menunggu Konfirmasi</label>

                    <?php }

                    elseif($buy->status == 2){ ?> 

                      <label class="label label-success">Lunas</label>

                    <?php }

                    elseif($buy->status == 3){ ?> 

                      <label class="label label-danger">Dibatalkan</label>

                    <?php }

                  ?>

                </td>

              </tr>

              <tr>

                <td class="buy-item">Metode Bayar</td>

                <td>: <?php echo ($buy->metode_pembayaran == 1) ? 'Transfer' : 'Indomaret';?></td>

              </tr>

              <tr>

                <td class="buy-item">Batas Waktu Pembayaran</td>

                <td>: <label class="buy-deadline"><?php echo date('d/m/Y, H:i:s', strtotime($buy->expired_on));?></label></td>

              </tr>

            </tbody>

          </table>

        </div>


        <div class="table-responsive tabel-rincian">

           <table class="table table-striped">

             <thead>

               <tr>

                 <th>ID Produk</th>

                 <th>Deskripsi Produk</th>

                 <th>Harga Satuan</th>

                 <th>Jumlah</th>

                 <th>Total</th>

               </tr>

             </thead>

             <tbody>

              <?php 

              foreach ($detail_pembelian as $item) 

              { ?>

              <tr>

                <td><?php echo $item->kode_paket;?></td>

                <td>Paket <?php echo ($item->tipe == 0) ? 'Reguler' : 'Premium'?> <?php echo $item->durasi;?> Bulan</td>

                <td><span class="pull-left">Rp</span> <span class="pull-right"><?php echo number_format($item->harga_satuan);?>-</span></td>

                <td class="text-right"><?php echo $item->jumlah;?></td>

                <td><span class="pull-left">Rp</span> <span class="pull-right"><?php echo number_format($item->jumlah * $item->harga_satuan);?>-</span></td>

              </tr>

              <?php

              }?>



              <tr>

                <td colspan="4" class="text-right"><strong>Grand Total</strong></td>

                <td><span class="pull-left">Rp</span> <span class="pull-right"><?php echo number_format($buy->total_harga);?>-</span></td>

              </tr>

             </tbody>

          </table>

        </div>

        



        <?php echo $this->session->flashdata('alert'); ?>



        <?php if($buy->status == 0) //belum lunas

        { ?> 

          <form class="upload-bayar" method="post" action="<?php echo base_url('user/do_bayar/'.$this->uri->segment(3));?>" enctype="multipart/form-data">

            <div class="row">

              <div class="col-sm-8 form-group">

                <label class="control-label upload-title" for="paket">Upload Foto Bukti Pembayaran :</label>

              </div>

              <div class="col-sm-8 form-group">

                <input type="file" name="file_bukti" class="form-control">
                <!-- <div class="input-group">
                  <input type="text" class="form-control">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="file">Ambil</button>
                  </span>
                </div> -->

              </div>

            </div>

            <!-- <a href="<?php echo base_url('user/aktivasi');?>" class="btn btn-primary">Konfirmasi</a> -->

            <button type="submit" class="btn btn-primary btn-confirm">Konfirmasi Pembelian<span class="glyphicon glyphicon-shopping-cart"></span></button>

          </form>

        <?php 

        } ?>

        <hr>

        <div class="row pay-bank">

          <h3 class="page-bank">Daftar Nomor Rekening untuk Transfer Pembayaran Paket</h3>

          <div class="col-sm-3 col-md-3">

            <img src="<?php echo base_url('assets/pg_user/images/icon/bank/bca.png');?>" width="171" height="84" alt="Bank Pembayaran PG" class="img-responsive">

            <p>

              A.n. Prime Generation

            </p>

            <p>

              No. Rekening : 918-213-999-1

            </p>

          </div>

          <div class="col-sm-3 col-md-3">

            <img src="<?php echo base_url('assets/pg_user/images/icon/bank/bri.png');?>" width="173" height="82" alt="Bank Pembayaran PG" class="img-responsive">

            <p>

              A.n. Prime Generation

            </p>

            <p>

              No. Rekening : 0389-01-0002-20309

            </p>

          </div>

          <div class="col-sm-3 col-md-3">

            <img src="<?php echo base_url('assets/pg_user/images/icon/bank/bni.png');?>" width="171" height="82" alt="Bank Pembayaran PG" class="img-responsive">

            <p>

              A.n. Prime Generation

            </p>

            <p>

              No. Rekening : 14-0897-6000-00

            </p>

          </div>

          <div class="col-sm-3 col-md-3">

            <img src="<?php echo base_url('assets/pg_user/images/icon/bank/mandiri.png');?>" width="171" height="84" alt="Bank Pembayaran PG" class="img-responsive">

            <p>

              A.n. Prime Generation

            </p>

            <p>

              No. Rekening : 1020-00-3078-265

            </p>

          </div>

        </div>
      </div>        

    </section>

     

    <?php include('footer.php');?>

    

    <!-- Javascript -->

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>

  </body>

</html>

