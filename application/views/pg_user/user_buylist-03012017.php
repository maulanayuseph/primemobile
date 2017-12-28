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
      <?php include('header.php');?>
    </div>
    
    <section class="page">
      <div class="container">
        <?php echo $this->session->flashdata('alert'); ?>
        
        <div class="row">
           <div class="col-xs-12">
            <h3 class="text-center">Daftar Riwayat Transaksi Pembelian Paket</h3>
            <br>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>No. Invoice</th>
                    <th>Tanggal Cetak</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Detail</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($data_pembelian as $item) 
                  { ?>
                  <tr>
                    <td>#<?php echo $item->no_tagihan;?></td>
                    <td><?php echo date('d M Y', strtotime($item->timestamp));?></td>
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
                    <td>
                      <a href="<?php echo base_url('user/bayar/'.$item->id_pembelian);?>">
                        <span class="btn btn-sm btn-info">Lihat Invoice <i class="glyphicon glyphicon-arrow-right"></i>
                      </a>
                    </td>
                  </tr>
                  <?php 
                  } ?>
                </tbody>
              </table>
            </div>
           </div>
        </div>           
      </div>
    </section>
    
    <?php include('footer.php'); ?>
    
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
  </body>
</html>
  </body>
</html>