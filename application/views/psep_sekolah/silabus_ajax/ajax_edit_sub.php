<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<input type="hidden" id="idpsepsub" value="<?php echo $sub->id_psep_sub_bab;?>" />
		<br><strong>Judul Sub : </strong>
		<br><input type="text" class="form-control" id="namasub" value="<?php echo $sub->nama_psep_sub_bab;?>"/>
		<br>
		<div class="col-sm-6">
			<button id="batal-<?php echo $sub->id_psep_bab;?>" class="btn btn-sm btn-warning btn-batal" style="width: 100%;">Kembali</button>
		</div>
		<div class="col-sm-6">
			<button id="editbab" class="btn btn-sm btn-primary" style="width: 100%;">Edit Bab</button>
		</div>
	</div>
	<div class="col-sm-4">
	</div>
</div>

<script>
$(function(){
	$(".btn-batal").click(function(){
		rawid 	= $(this).attr("id");
		splitid	= rawid.split("-");
		idbab 	= splitid[1];
		$("#konten-modal").load("silabus/ajax_sub/" + idbab);
	});
	$("#editbab").click(function(){
		idpsepsub 	= $("#idpsepsub").val();;
		namasub 	= $("#namasub").val();
		$.ajax({
			type: 'POST',
			url: 'silabus/ajax_proses_edit_sub',
			data:{
				'idpsepsub'	: idpsepsub,
				'namasub'	: namasub
			}
		})
	});
	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "silabus/ajax_proses_edit_sub"){
			$('#text-load').html('Menyimpan sub');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "silabus/ajax_proses_edit_sub"){
			rawid 	= $(".btn-batal").attr("id");
			splitid	= rawid.split("-");
			idbab 	= splitid[1];
			$('#modal-loader').modal('hide');
			$("#konten-modal").load("silabus/ajax_sub/" + idbab);
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "silabus/ajax_proses_edit_sub"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	});
})
</script>