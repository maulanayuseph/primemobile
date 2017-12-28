<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
  <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->
  <title>Prime Mobile Activation Code</title>
</head>
<body style="margin:0; padding:0;background-image: url('<?= base_url('assets/img/bg-email.jpg') ?>');background-size:contain; background-position:center; background-repeat:no-repeat;font-size:18px;line-heigth:24px;" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<!-- 100% background wrapper (grey background) -->
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">

<?php	foreach($table_data as $data){ ?>
  <tr>
    <td align="center" valign="top" cellpadding="10" >

		<table border="0" width="100%" cellpadding="5" cellspacing="0" style="margin-top:90px;padding:30px 80px;">
			<tr>
				<td colspan="2" align="center">
					<h2 style="color:#dc1826;">Prime Mobile Activation Code</h2>
				</td>
			</tr>
			<tr>
				<td style="width:40%;vertical-align:top;">
						<div style="border:dotted 1px #dc1826;padding:20px;text-align:center;margin:0px 10px 20px 50px;height:135px;">
							<img src="<?= base_url() ?>barcode.php?codetype=code25&sizefactor=1&orientation=horizontal&size=60&text=<?= $data->kode_voucher ?>" style="width:200px;"/><br>
							<h4 style="margin-bottom:0px;"><?= $data->kode_voucher ?></h4>
						</div>
				</td>
				<td style="vertical-align:top;">
						<div style="border:dotted 1px #dc1826;padding:20px;margin:0px 50px 20px 10px;height:135px;">
							Berikut tercantum dibawah ini Kode Aktivasi Anda,<br><br>
							<div><i>Tipe Voucher</i></div>
							<div style="margin-bottom:10px;"><?= $data->tipe == "0" ? $data->durasi.' Bulan Pemakaian' : $data->durasi.' Bulan Pemakaian (Premium)' ?></div>

							<div><i>Kode Aktivasi</i></div>
							<div><b><?=substr($data->no_aktivasi,0,4).''.substr($data->no_aktivasi,4,4).''.substr($data->no_aktivasi,8,4).''.substr($data->no_aktivasi,12,4)?></b></div>
						</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
						<div style="border:dotted 1px #dc1826;padding:20px;margin:0px 50px 20px 50px;">
								<h4 style="margin-top:0px;margin-bottom:10px;"><u>Keterangan:</u></h4>
								<ol style="margin-left:-20px;">
								<li>Pemakaian untuk <?php echo $data->durasi ?> bulan sejak dilakukan aktivasi</li>
								<li>Jika anda masih memiliki masa berlaku pemakaian maka proses aktivasi akan menambah masa berlaku pemakaian anda</li>
								</ol>
						</div>
				</td>
			</tr>
		</table>

    </td>
  </tr>
<? } ?>

</table><!--/100% background wrapper-->

</body>
</html>
