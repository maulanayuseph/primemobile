<?php
foreach($datajadwal as $jadwal){
	?>
	<tr>
		<td class="text-center">
			<?php echo $jadwal->kelas_paralel;?>
			<br>
			<?php
			echo $jadwal->tahun_ajaran;
			?>
		</td>
		<td class="text-center">
			<?php echo $jadwal->startdate;?>
			<br>
			<?php
			echo $jadwal->enddate;
			?>
		</td>
		<td valign="middle" class="text-center">
			<button class="btn btn-sm btn-danger hapus-jadwal" id="hapus-<?php echo $idpaket;?>-<?php echo $jadwal->id_sbmptn_config;?>">
				Hapus Jadwal
			</button>
		</td>
	</tr>
	<?php
}
?>