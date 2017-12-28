<?php
foreach($databahas as $bahas){
	?>
	<tr>
		<td><strong><?php echo $bahas->kelas_paralel;?></strong> / <?php echo $bahas->tahun_ajaran;?></td>
		<td class="text-center"><?php echo $bahas->bahasdate;?></td>
		<td class="text-center">
			<button class="btn btn-sm btn-danger hapus-bahas" id="hapus-bahas-<?php echo $bahas->id_cbt_sekolah_bahas;?>-<?php echo $bahas->id_profil;?>">
					<i class="glyphicon glyphicon-remove"></i>
				</button>
		</td>
	</tr>
	<?php
}
?>

<script type="text/javascript">
$(function(){
	$(".hapus-bahas").click(function(){
		rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idbahas		= idsplit[2];
		idprofil	= idsplit[3];

		if(confirm("Apakah anda yakin akan menghapus akses pembahasan?")){
			$.ajax({
				type: 'POST',
				url: 'hapus_bahas',
				data:{
					'idbahas'	: idbahas,
					'idtryout'	: idprofil
				}
			});
		}
	})
})
</script>