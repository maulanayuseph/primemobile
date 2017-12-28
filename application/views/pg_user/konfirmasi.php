<!DOCTYPE html>
<html lang="en">
    <head>    
        <title>Prime Mobile - Cara belajar masa kini</title>
        
        <!-- Meta Tags -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Icon -->
        <link rel="shortcut icon" href="<?php echo base_url('assets/pg_user/images/icon/favicon.ico');?>" >
        <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icon/favicon.ico');?>" >
        <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>" >
		
		<!-- Stylesheets -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/custom.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/pg_user/css/edit.css">
        
    </head>
    <body>
        <header>
			<!-- nav bar -->
			 <?php include('header_user.php'); ?>
		</header>
		<section class="page">
			<!-- apa kata -->
			<div class="container">
				<h3 class="page-title text-center">Batas Pembayaran : <?php echo $detail_pembayaran[0]['expired_on'] ?></h3>
				<h3 class="page-title text-center">Sisa waktu pembayaran anda : <?php echo $sisa_waktu ?></h3>
				<p>Paket <?php echo $detail_pembayaran[0]['tipe']." ".$detail_pembayaran[0]['durasi'] ?> bulan</p>
				<p>Total Bayar : Rp. <?php echo number_format($detail_pembayaran[0]['harga'], null, null, ".") ?></p>
				<form name="" id="" role="form" method="post" action="<?php echo base_url() ?>beli/simpan_konfirmasi" enctype="multipart/form-data">
				<input type="hidden" name="id_pembayaran" value="<?php echo $detail_pembayaran[0]['id_pembayaran'] ?>">
				    <div class="row">
				        <div class="col-sm-3 form-group">
				            <label class="control-label" for="paket">Upload Bukti Pembayaran</label>
				        </div>
                        <div class="col-sm-5 form-group">
                            <input type="file" id="exampleInputFile" name="file_bukti" class="form-control">
                        </div>
				    </div>
				    <input type="submit" name="konfirmasi" value="Konfirmasi" class="btn btn-default">
				</form>
			</div>				
		</section>
		
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Konfirmasi Pembayaran</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            Pembayaran anda sebesar Rp 124.000,0 untuk <strong>Paket Regular 1 Bulan</strong> telah masuk ke sistem.
                            <br>
                            Harap menunggu konfirmasi dari Admin Prime Generation.
                        </p>
                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
       
        <?php include('footer.php'); ?>
        
        <!-- Javascript -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/pg_user/js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/pg_user/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/pg_user/js/megamenu.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/pg_user/js/npm.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/pg_user/js/retina.min.js"></script>
    </body>
</html>
    </body>
</html>