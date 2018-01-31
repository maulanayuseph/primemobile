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
<div class="container-fluid" style="margin-top: 60px;">
	<div class="row">
		<div class="col-sm-2">
		</div>
		<div class="col-sm-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title text-center">Notifikasi Tagihan</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							Masa aktif penggunaan Prime Mobile anda telah berakhir, silahkan melakukan pembayaran untuk memperpanjang masa aktif selama <?php echo $tagihan->durasi;?> bulan.
							<br>Pembayaran Transfer dapat dilakukan melalui ATM yang terdaftar dalam jaringan ATM Bersama
							<br>* Biaya transfer antar bank berlaku
							<br>&nbsp;
							<ol>
								<li>Kunjungi ATM terdekat yang memiliki logo ATMBersama</li>
								<li>Pilih fitur transfer</li>
								<li>Pilih menu transfer antar Bank</li>
								<li>Masukan kode <span style="color: red;">987</span> dilanjutkan dengan nomor rekening tujuan <span style="color: red;">500xxx<?php echo $siswa->id_siswa;?></span></li>
								<li>Masukan <?php echo $tagihan->harga;?> pada jumlah transfer</li>
								<li>Konfirmasi data transfer</li>
								<li>Klik next/oke</li>
								<li>Transaksi selesai</li>
							</ol>
							<br>Pembayaran akan langsung terkonfirmasi setelah proses transaksi selesai.
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-2">
		</div>
	</div>
</div>
</body>
</html>