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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/pg_user/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/pg_user/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/pg_user/css/custom.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/pg_user/css/edit.css">
        
    </head>
    <body>
    <?php foreach ($detail_paket as $paket) {
    	$id_paket=$paket->id_paket;
    	$harga=number_format($paket->harga,null, null, ".");
    	$tipe=$paket->tipe;
    	$durasi=$paket->durasi;
    } ?>
        <header>
			<!-- nav bar -->
			 <?php include('header_user.php'); ?>
		</header>
		<section class="page">
		<div class="container">
			<div class="col-sm-3 col-xs-6">
				<div style="height:50px;">
					<img src="<?php echo base_url()?>assets/pg_user/images/logo/bank-bri.png" width="120">
				</div>

				<h4>Bank BRI</h4>
				<p>0049590400322</p>
				<p>a.n <strong>Happy Trenggono</strong></p>
			
			</div>
			<div class="col-sm-3 col-xs-6">
				<div style="height:50px;">
					<img src="<?php echo base_url()?>assets/pg_user/images/logo/bank-mandiri.png" width="120">
				</div>

				<h4>Bank Mandiri</h4>
				<p>983742398745</p>
				<p>a.n <strong>Happy Trenggono</strong></p>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div style="height:50px;">
					<img src="<?php echo base_url()?>assets/pg_user/images/logo/bank-bca.png" width="120">
				</div>
				
				<h4>Bank BCA</h4>
				<p>30482342002</p>
				<p>a.n <strong>Happy Trenggono</strong></p>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div style="height:50px;">
					<img src="<?php echo base_url()?>assets/pg_user/images/logo/bank-bni.png" width="120">
				</div>
				<h4>Bank BNI</h4>
				<p>9938377465323</p>
				<p>a.n <strong>Happy Trenggono</strong></p>
				
			</div>
		</div>
		<br><br>
			<!-- apa kata -->
			<div class="container">
				<h3 class="page-title">Beli Paket <?php echo $tipe." ".$durasi ?>  Bulan</h3>
				<form name="" id="" role="form" method="post" action="<?php echo base_url() ?>beli/simpan" enctype="multipart/form-data">
				    <div class="row">
				    <input type="hidden" name="id_paket" value="<?php echo $id_paket ?>">
				        <div class="col-sm-2 form-group">
				            <label class="control-label" for="paket">Harga</label>
				        </div>
                        <div class="col-sm-5 form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Rp</div>
                                <input type="text" class="form-control" id="" placeholder="<?php echo $harga ?>" disabled>
                                <!-- <div class="input-group-addon">.00</div> -->
                            </div>
                        </div>
				    </div>
				    <div class="row">
				        <div class="col-sm-2 form-group">
				            <label class="control-label" for="paket">Pilih Bank</label>
				        </div>
                        <div class="col-sm-5 form-group">
                            <select name="id_bank" id="" class="form-control">
                                <option>- Pilih Bank -</option>
                                <?php 
                                foreach ($bank as $list_bank) {
                                 	echo "<option value='".$list_bank->id_bank."' data-code='".$list_bank->code."'>".$list_bank->name."</option>";
                                 } ?>
                            </select>
                        </div>
				    </div>
				    <div class="row">
				        <div class="col-sm-2 form-group">
				            <label class="control-label" for="paket">No. Rekening</label>
				        </div>
                        <div class="col-sm-5 form-group">
                           <input type="text" name="no_rek" id='no_rek' class="form-control">
                        </div>
				    </div>
				    <input type="submit" name="" id="" class="btn btn-default" value="Beli Paket">
				</form>
			</div>				
		</section>
		
        <?php include('footer.php'); ?>
        
        <!-- Javascript -->
        <script type="text/javascript" src="<?php echo base_url() ?>assets/pg_user/js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/pg_user/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/pg_user/js/megamenu.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/pg_user/js/npm.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/pg_user/js/retina.min.js"></script>
    </body>
</html>
    </body>
</html>