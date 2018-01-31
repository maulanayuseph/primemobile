<!DOCTYPE html>
<html><head>
	<title></title>
	<style type="text/css">
		body{
			font-family: sans-serif;
			font-size: 11pt;
		}

		.detail tr td{
			border: 1px solid black;
			word-wrap: break-word;
		}

		.detail{
			margin-top: 0.2cm;
		}
	</style>
</head><body style="width: 20cm;">
	<table style="width 18cm;">
		<tr>
			<td style="width: 9cm;">
				<img src="<?php echo base_url("assets/dashboard/images/logo-red.png");?>" />
				
			</td>
			<td style="width: 9cm; text-align: right;">
				<h3><strong>TAGIHAN</strong></h3>
				
			</td>
		</tr>
		<tr>
			<td>
				No. Tagihan : <?php echo $tagihan->no_tagihan;?>
			</td>
			<td style="text-align: right;">
				Jatuh Tempo : <?php echo $tagihan->expired_on;?>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="height: 0.5cm;">
				
			</td>
		</tr>
		<tr>
			<td>
				<h3><strong>Ditagihkan Kepada : </strong></h3>
			</td>
			<td style="text-align: right;">
				<h3><strong>Metode Pembayaran : </strong></h3>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $tagihan->nama;?>
				<br><?php echo $tagihan->nama_sekolah;?>
				<br><?php echo $tagihan->nama_kota;?>, <?php echo $tagihan->nama_provinsi;?>
			</td>
			<td style="text-align: right;">
				Transfer Bank
			</td>
		</tr>
		<tr>
			<td>
				<h3><strong>Detail Tagihan : </strong></h3>
			</td>
			<td>
				
			</td>
		</tr>
	</table>
	<!-- DETAIL TAGIHAN -->
	<table style="width 18cm;" class="detail" cellspacing="0">
		<tr>
			<td style="text-align: center; font-weight: bold;">
				Deskripsi
			</td>
			<td style="text-align: center; font-weight: bold;">
				Kelas / Tahun Ajaran
			</td>
			<td style="text-align: center; font-weight: bold;">
				Jumlah Aktivasi
			</td>
			<td style="text-align: center; font-weight: bold;">
				Sub-Total
			</td>
		</tr>
		<?php
			//ceri detail pembelian
			$detailpembelian = $this->model_keuangan->fetch_detal_and_kelas_by_id_pembelian($tagihan->id_pembelian);

			$x = 0;
			$total = 0;
			foreach($detailpembelian as $detail){
				if($tagihan->id_event !== '0'){
					//cari event
					$event = $this->model_keuangan->fetch_event_by_id($tagihan->id_event);

					$deskripsi = "Aktivasi Try Out Online/Event " . $event->nama_event;
				}else{
					$deskripsi = "Aktivasi Reguler " . $detail->durasi . " bulan";
				}
				?>
				<tr>
					<td style="width: 300px;">
						<?php 
						if($x == 0){
							echo $deskripsi;
						}
						;?>
					</td>
					<td style="text-align: center;">
						<?php echo $detail->kelas_paralel;?> (<?php echo $detail->tahun_ajaran;?>)
					</td>
					<td style="text-align: center;">
						<?php echo $detail->jumlah;?>
					</td>
					<td style="text-align: right;">
						Rp. <?php
						$subtotal = $detail->jumlah * $detail->harga_satuan;
						echo number_format($subtotal,0,",",".");
						$total += $subtotal;
						?>,-
					</td>
				</tr>
				<?php
				$x++;
			}
		?>
		<tr>
			<td style="border: none;"></td>
			<td style="border: none;"></td>
			<td><strong>TOTAL</strong></td>
			<td style="text-align: right;"><strong>Rp. <?php echo number_format($total,0,",",".");?>,-</strong></td>
		</tr>
	</table>
	<br>
	------------------------------------------------------------------------------------------------------------------------------------------------
	<h3><strong>Prosedur Pembayaran/Transfer : </strong></h3>
	Pembayaran Transfer dapat dilakukan melalui ATM yang terdaftar dalam jaringan ATM Bersama
	<br>* Biaya transfer antar bank berlaku
	<br>&nbsp;
	<ol>
		<li>Kunjungi ATM terdekat yang memiliki logo ATMBersama</li>
		<li>Pilih fitur transfer</li>
		<li>Pilih menu transfer antar Bank</li>
		<li>Masukan kode <span style="color: red;">987</span> dilanjutkan dengan nomor rekening tujuan <span style="color: red;"><?php echo $tagihan->vaid;?></span></li>
		<li>Masukan <?php echo $total;?> pada jumlah transfer</li>
		<li>Konfirmasi data transfer</li>
		<li>Klik next/oke</li>
		<li>Transaksi selesai</li>
	</ol>
	<br>Pembayaran akan langsung terkonfirmasi setelah proses transaksi selesai.
	<br>
	<br>
	<table>
		<tr>
			<td style="width: 18cm; text-align: center;">primemobile.co.id</td>
		</tr>
	</table>
</body></html>