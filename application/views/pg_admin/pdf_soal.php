<head>
<title><?php echo $title;?></title>
<style>
	body{
		font-size: 10pt;
	}
	img{
		max-width: 10cm;
	}
</style>
</head>
<body>
<center><strong><?php echo $infosub->alias_kelas;?> - <?php echo $infosub->nama_mapel;?>
<br><?php echo $infosub->nama_materi_pokok;?><?php echo $infosub->nama_sub_materi;?></strong></center>
<table>
	<?php
		$x = 1;
		foreach($datasoal as $soal){
			?>
			<tr>
				<td width="0.5cm" valign="top"><strong><p><?php echo $x;?>. </p></strong></td>
				<td colspan="2" width="15cm"><?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',$soal->isi_soal)));?></td>
			</tr>
			<tr>
				<td></td>
				<td style="width: 0.5cm;" valign="top"><strong>A.</strong></td>
				<td valign="top"><?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',$soal->jawab_1)));?></td>
			</tr>
			<tr>
				<td></td>
				<td width="0.5cm" valign="top"><strong>B.</strong></td>
				<td valign="top"><?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',$soal->jawab_2)));?></td>
			</tr>
			<tr>
				<td></td>
				<td width="0.5cm" valign="top"><strong>C.</strong></td>
				<td valign="top"><?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',$soal->jawab_3)));?></td>
			</tr>
			<tr>
				<td></td>
				<td width="0.5cm" valign="top"><strong>D.</strong></td>
				<td valign="top"><?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',$soal->jawab_4)));?></td>
			</tr>
			<tr>
				<td></td>
				<td width="0.5cm" valign="top"><strong>E.</strong></td>
				<td valign="top"><?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',$soal->jawab_5)));?></td>
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
				<p><strong>Pembahasan Teks : </strong><?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',$soal->pembahasan)));?>
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