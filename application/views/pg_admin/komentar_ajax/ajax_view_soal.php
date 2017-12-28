<strong>Soal :</strong>
<br><?php
echo html_entity_decode($soal->isi_soal);

?>
<p>&nbsp;
<br><strong>Pembahasan :</strong>
<br><?php
echo html_entity_decode($soal->pembahasan);
?>
<p>&nbsp;
<br><strong>Kunci Jawabab : </strong>
<?php
if($soal->kunci_jawaban == "1"){
	echo "<strong>A</strong>";
}elseif($soal->kunci_jawaban == "2"){
	echo "<strong>B</strong>";
}elseif($soal->kunci_jawaban == "3"){
	echo "<strong>C</strong>";
}elseif($soal->kunci_jawaban == "4"){
	echo "<strong>D</strong>";
}elseif($soal->kunci_jawaban == "5"){
	echo "<strong>E</strong>";
}
?>
<table class="table table-bprdered">
	<tr>
		<td style="width: 10px"><strong>A</strong></td>
		<td><?php echo $soal->jawab_1;?></td>
	</tr>
	<tr>
		<td style="width: 10px"><strong>B</strong></td>
		<td><?php echo $soal->jawab_2;?></td>
	</tr>
	<tr>
		<td style="width: 10px"><strong>C</strong></td>
		<td><?php echo $soal->jawab_3;?></td>
	</tr>
	<tr>
		<td style="width: 10px"><strong>D</strong></td>
		<td><?php echo $soal->jawab_4;?></td>
	</tr>
	<tr>
		<td style="width: 10px"><strong>E</strong></td>
		<td><?php echo $soal->jawab_5;?></td>
	</tr>
</table>