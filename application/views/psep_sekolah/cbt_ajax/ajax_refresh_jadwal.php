<?php
if($carijadwal !== null){
foreach($carijadwal as $jadwal){
	?>
	<tr>
		<td>
			<strong><?php echo $jadwal->kelas_paralel;?></strong> / <?php echo $jadwal->tahun_ajaran;?>
		</td>
		<td class="text-center">
			<?php echo $jadwal->startdate;?> 
		</td>
		<td class="text-center">
			<?php echo $jadwal->enddate;?>
		</td>
		<td class="text-center">
			<button class="btn btn-sm btn-danger hapus-jadwal" id="hapus-<?php echo $jadwal->id_cbt_sekolah;?>-<?php echo $idprofil;?>">
				<i class="glyphicon glyphicon-remove"></i>
			</button>
		</td>
	</tr>
	<?php
}
}
?>
<script type="text/javascript">
$(function(){
	$(".hapus-jadwal").click(function(){
		rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idjadwal	= idsplit[1];
		idprofil	= idsplit[2];

		if(confirm("Apakah anda yakin akan menghapus jadwal?")){
			$.ajax({
				type: 'POST',
				url: 'hapus_jadwal',
				data:{
					'idjadwal'	: idjadwal,
					'idtryout'	: idprofil
				}
			});
		}
	})
})
</script>