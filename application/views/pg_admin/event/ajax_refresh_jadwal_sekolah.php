<?php
$y = 1;
foreach($datajadwal as $jadwal){
	?>
	<tr>
		<td><?php echo $y;?></td>
		<td><?php echo $jadwal->nama_sekolah;?></td>
		<td><?php echo $jadwal->mulai_date;?></td>
		<td><?php echo $jadwal->selesai_date;?></td>
		<td>
			<button class="btn btn-sm btn-danger hapus-jadwal" id="hapus-<?php echo $jadwal->id_jadwal_event_cbt;?>">Hapus Jadwal</button>
		</td>
	</tr>
	<?php
	$y++;
}
?>