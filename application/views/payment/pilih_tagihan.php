<!DOCTYPE html>
<html>
<head>
	<title>Prime Mobile | Pilih Siklus Tagihan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/payment/css/bootstrap.min.css");?>">
	<link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/payment/js/bootstrap.min.js');?>"></script>
	<style type="text/css">
		body{
			background-color: #b20000;
			font-family: 'ABeeZee', sans-serif;
		}
		.btnpilihbilling{
			position: relative;
			bottom: 0px;
		}
		.judulpilihbilling{
			color: white;
		}
		.carousel-control.left{
			background-image: none;
		}
		.carousel-control.right{
			background-image: none;
		}
		.carousel-control{
			color: red;
		}
	</style>
</head>
<body>
<div class="container-fluid" style="margin-top: 10px;">
	<div class="row">
		<div class="col-sm-4">
		</div>
		<div class="col-sm-4">
			<h3 class="text-center judulpilihbilling">Pilih Metode Billing</h3>
			<br>&nbsp;
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<?php
						$y = 1;
						$x = 0;
						foreach($datapaket as $paket){
							if($x == 0){
								$active = " active";
							}else{
								$active = "";
							}
							?>
							<div class="item<?php echo $active;?>">
								<div class="panel panel-default">
									<div class="panel-heading text-center">
										<h3 class="panel-title"><?php echo $paket->durasi;?> Bulan</h3>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12 text-center">
												<img src="<?php echo base_url('assets/img/payment/karakter'.$y.'.png');?>" style="height: 300px;"/>
												<h3>Rp. <?php echo number_format($paket->harga);?>,-</h3>
												Penagihan setiap <?php echo $paket->durasi;?> bulan sekali

												<input type="hidden" id="durasi-<?php echo $paket->id_paket;?>" value="<?php echo $paket->durasi;?>">
												<input type="hidden" id="harga-<?php echo $paket->id_paket;?>" value="<?php echo $paket->harga;?>">
												<br>&nbsp;

											</div>
											<div class="col-sm-12">
												<button class="btn btn-danger btnpilihbilling" id="paket-<?php echo $paket->id_paket;?>" style="width: 100%">Pilih Billing</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
							$x++;
							$y++;
						}
					?>
				</div>
				<!-- end Wrapper for slides -->

				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		<div class="col-sm-4">
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$(".btnpilihbilling").click(function(){
		rawid 		= $(this).attr('id');
		idsplit 	= rawid.split('-');
		idpaket 	= idsplit[1];
		durasi 		= $("#durasi-" + idpaket).val();
		harga 		= $("#harga-" + idpaket).val();
		if(confirm("Anda memilih billing " + durasi + " bulan seharga Rp. "+ harga +",-. Lanjutkan ?")){
			window.location.replace("<?php echo base_url('payment/select_payment/');?>" + idpaket);
		}
	})
})
</script>
</body>
</html>