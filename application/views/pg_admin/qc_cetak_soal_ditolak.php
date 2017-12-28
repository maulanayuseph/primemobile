<html>
<head>
	<title>Soal Ditolak</title>
</head>

<body>
<div style="text-align: center; font-weight: bold;">
	Daftar Soal 
	<?php
		if($status == 2){
			echo "Pembahasan Tidak Lengkap";
		}elseif($status == 3){
			echo "Belum Ada Pembobotan";
		}elseif($status == 4){
			echo "Membingungkan";
		}elseif($status == 5){
			echo "Dobel";
		}elseif($status == 6){
			echo "Tidak Layak";
		}elseif($status == 8){
			echo "Belum di QC Tentor";
		}elseif($status == 7){
			echo "Perlu Dipindah";
		}
	?>
	<br><?php echo $detailkelas->alias_kelas;?>
	<br><?php echo $infomapel->nama_mapel;?>
</div>

<table>
	<?php
		$x = 1;
		foreach($datasoal as $soal){
			?>
			<tr>
				<td width="0.5cm" valign="top"><strong><p><?php echo $x;?>. </p></strong></td>
				<td colspan="2" width="15cm">
				<strong>BAB : </strong><?php echo $soal->nama_materi_pokok;?>
				<br><strong>SUB-BAB : </strong><?php echo $soal->nama_sub_materi;?>
				<br><?php echo html_entity_decode($soal->isi_soal);?></td>
			</tr>
			<tr>
			    <td></td>
			    <td style="width: 0.5cm;" valign="top"><strong>Bobot</strong></td>
				<td valign="top"><?php 
				if($soal->bobot == 1){
				    echo "Mudah";
				}elseif($soal->bobot == 2){
				    echo "Sedang";
				}elseif($soal->bobot == 3){
				    echo "Sulit";
				}
				?></td>
			</tr>
			<tr>
				<td></td>
				<td style="width: 0.5cm;" valign="top"><strong>A.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_1);?></td>
			</tr>
			<tr>
				<td></td>
				<td width="0.5cm" valign="top"><strong>B.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_2);?></td>
			</tr>
			<tr>
				<td></td>
				<td width="0.5cm" valign="top"><strong>C.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_3);?></td>
			</tr>
			<tr>
				<td></td>
				<td width="0.5cm" valign="top"><strong>D.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_4);?></td>
			</tr>
			<tr>
				<td></td>
				<td width="0.5cm" valign="top"><strong>E.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_5);?></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
				<strong>Kunci Jawaban :
				<?php 
				if($soal->kunci_jawaban == 1){
					echo "A";
				}elseif($soal->kunci_jawaban == 2){
					echo "B";
				}elseif($soal->kunci_jawaban == 3){
					echo "C";
				}elseif($soal->kunci_jawaban == 4){
					echo "D";
				}elseif($soal->kunci_jawaban == 5){
					echo "E";
				}
				?>
				</strong>
				</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
				<p><strong>Pembahasan Teks : </strong><?php echo html_entity_decode($soal->pembahasan);?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
				<p><strong>Pembahasan Video :</strong><?php echo $soal->pembahasan_video;?>
				<hr>
				</td>
			</tr>
			<?php
			$x++;
		}
	?>
</table>
</body>
</html>