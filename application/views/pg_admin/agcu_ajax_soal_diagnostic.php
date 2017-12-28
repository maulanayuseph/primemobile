<?php
	$x = 1;
	foreach($datasoal as $soal){
		?>
		<tr>
			<td><?php echo $x;?></td>
			<td><?php echo $soal->kategori_bank_soal;?></td>
			<td><?php echo $soal->pertanyaan;?></td>
			<td><?php echo $soal->topik;?></td>
			<td class="text-center">
				<button class="btn btn-sm btn-danger hapus_soal" id="soal-<?php echo $soal->id_soal;?>"><i class="fa fa-remove" aria-hidden="true"></i></button>
			</td>
		</tr>
		<?php
		$x++;
	}
?>

<script>
$(function(){
	$(".hapus_soal").click(function(){
		if(confirm("Apakah anda yakin untuk menghapus soal?")){
			rawid 			= $(this).attr("id");
			idsplit 		= rawid.split("-");
			idsoal 			= idsplit[1];
			$.ajax({
				type: 'POST',
				url: '../../hapus_soal',
				data:{
					'idsoal' 		: idsoal,
					'iddiagnostic' 	: $("#id-diagnostic").val()
				}
			});
		}
	});
	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "../../hapus_soal"){
			$('#text-load').html('menghapus soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		iddiagnostic	= $("#id-diagnostic").val();

		if(options.url === "../../hapus_soal"){
			$("#isi-soal-diagnostic").load("../../refresh_soal/" + iddiagnostic);
		}


	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "../../hapus_soal"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
})
</script>