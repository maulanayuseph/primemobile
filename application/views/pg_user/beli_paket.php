<!DOCTYPE html>

<html lang="en">

  <head>    
    <title>Prime Mobile - Cara Belajar Masa Kini</title>

    <!-- Meta Tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Icon -->
    <link rel="icon" href="<?php echo base_url('assets/dashboard/images/icon-red.png');?>">
    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-red.png');?>" >
    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-red.png');?>" >

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom-3.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/simple-sidebar.css');?>">
    <link href="<?php echo base_url('assets/dashboard/css/style.css');?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/style.css');?>">
    <!-- Needed for Video Player -->
<!-- ANALYTICS -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-93257814-1', 'auto');
	  ga('send', 'pageview');
	
	</script>
<!-- end ANALYTICS -->
  </head>

  <body>

    <header>

    <!-- nav bar -->
	<?php include('header.php'); ?>

	<div class="container-fluid akun-container">
		<?php if ($this->session->flashdata('msgemail')){ ?>
		<div class="col-lg-12 well">
			<label class="label label-primary"><?php echo $this->session->flashdata('msgemail'); ?></label>
		</div>
		<?php } ?>

		<div class="col-lg-12 well">
		<form action="<?php echo base_url().'beli_paket/proses_beli' ;?>" method="post">
        <div class="pay-list">
          <h3>PAKET REGULER</h3>
          <div class="table-responsive bayar-table">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Pilihan Voucher</th>
                  <th>Harga Satuan</th>
                </tr>
              </thead>

              <tbody>
                <?php
                $jml_paket = 10;
                foreach ($data_reguler as $item) 
                { 
			if ($item->id_paket < 21){
                ?>

                <tr>
                  <td><?php echo $item->kode_paket;?></td>
                  <td>Reguler <?php echo $item->durasi;?> bulan</td>
                  <td>Rp <?php echo number_format($item->harga);?>-</td>
                </tr>
                <?php
                	}
                } 
                ?>
              </tbody>
            </table>
          </div>
        
          <hr>

		  <?php /*
          <h3 class="text-blue">Paket Premium</h3>
          <div class="table-responsive bayar-table blue">
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
                foreach ($data_premium as $item) 
                { ?>
                <tr>
                  <td><?php echo $item->kode_paket;?></td>
                  <td>Premium <?php echo $item->durasi;?> bulan</td>
                  <td>Rp <?php echo number_format($item->harga);?>-</td>
                  <td>
                    <select class="option-style" name="paket_<?php echo $item->id_paket;?>">
                     <option value="">0</option>
                      <?php for($jml=1; $jml<=$jml_paket; $jml++)
                      { ?>
                        <option value="<?php echo $jml;?>"><?php echo $jml;?></option>
                      <?php 
                      } ?>
                    </select> buah
                  </td>
                </tr>
                <?php
                } ?>
              </tbody>
            </table>
          </div>
          */ ?>
        </div>

        <div class="pay-method">
          <div class="row">
            <div class="col-sm-12 center">
              <h3>Cara Pembelian Voucher</h3>
              <div class="col-sm-12" style="text-align: left;">
				<ol>
					<li>Lakukan pembayaran ke rekening <b>Bank Mandiri : 0700007446284 a.n PT. prima Generasi bimbingan belajar</b>
					<br>&nbsp;
					</li>
					<li>Setelah anda melakukan pembayaran, kirim email ke : konfirmasi@primemobile.co.id dengan menyebutkan informasi sebagai berikut disertai dengan bukti transfer<br /><br />
						<ul>
							<li>Nama lengkap</li>
							<li>Nomor Handphone</li>
							<li>Email</li>
							<li>Jumlah transfer (Lampirkan bukti transfer)</li>
							<li>Keterangan voucher yang dibeli<br>&nbsp;</li>
							
							<li>Contoh email konfirmasi: 
								<br>David Hermawan
								<br>08123456789 
								<br>david@gmail.com 
								<br>Rp. 650.000,-
								<br>Voucher 1 bulan (2 item), Voucher 3 bulan (1 item)
							</li>
						</ul>
						<br>&nbsp;
					</li>
					<li>
						Sales admin kami akan mengirimkan kode aktivasi ke email anda setelah melakukan verifikasi
					</li>
				</ol>
			  </div>
              


              <? /*
              <div class="pay-indo">
                <label for="metodePembayaran2">
                <img src="<?php echo base_url('assets/pg_user/images/custom/indomaret.jpg');?>" width="305" height="218" alt="Indomaret Logo" class="img-responsive bayar-image">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <h4>INDOMARET</h4>
                      <p>Bayar di indomart dengan
                      menunjukkan slip pemesanan
                      atau kode referensi, kode
                      voucher dikirim setelah
                      proses pembayaran</p>
                    </div>
                  </div>
                </label>
                <div class="radio">
                  <input type="radio" name="metode_pembayaran" id="metodePembayaran2" value="2" aria-label="Indomaret">
                </div>
              </div>
              */ ?>
              
            </div>
          </div>

          <div class="row">
		    <!--
            <div class="col-sm-12">
              <br><br>
              <button type="submit" name="pembayaran_submit" value="submit" class="btn btn-success btn-bayar">Beli Paket <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
            </div>
			-->
          </div>

        </div>

      </form>
    
		</div>
	</div>

    <?php include('footer.php');?>

    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
	<script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
  </body>
</html>

