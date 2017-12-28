<?php
$no = 1;
foreach($datasoal as $soal){
	?>
	<tr>
		<td><?php echo $soal->alias_kelas." - ".$soal->nama_mapel;?></td>
		<td><?php echo $soal->pertanyaan;?></td>
		<td><?php echo $soal->topik;?></td>
		<td>
			<button class="btn btn-sm btn-danger insert_soal" id="banksoal-<?php echo $soal->id_banksoal;?>">Insert <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		</td>
	</tr>
	<?php
	$no++;
}
?>

<script>
$(function(){
	$(".insert_soal").click(function(){
		rawid 			= $(this).attr("id");
		idsplit			= rawid.split("-");
		idbanksoal 		= idsplit[1];
		iddiagnostic	= $("#id-diagnostic").val();

		$.ajax({
			type: 'POST',
			url: '../../tambah_soal',
			data:{
				'idbanksoal' 	: idbanksoal,
				'iddiagnostic'	: iddiagnostic
			}
		});

	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "../../tambah_soal"){
			$('#text-load').html('Menambahkan soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		iddiagnostic	= $("#id-diagnostic").val();

		if(options.url === "../../tambah_soal"){
			$("#isi-soal-diagnostic").load("../../refresh_soal/" + iddiagnostic);
		}


	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "../../tambah_soal"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
})
</script>