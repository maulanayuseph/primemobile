<div class="row">
	<div class="col-sm-4">
		<strong>Kelas : </strong>
		<br>
		<select id="edit-kelas-mapel" class="form-control">
			<option value="<?php echo $datamapel->id_kelas;?>"><?php echo $datamapel->alias_kelas;?></option>
			<?php
				foreach($datakelas as $kelas){
					?>
					<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
					<?php
				}
			?>
		</select>
	</div>
	<div class="col-sm-4"> 
		<strong>Nama Mata Pelajaran : </strong>
		<br>
		<input type="text" id="edit-input-mapel" class="form-control" value="<?php echo $datamapel->nama_psep_mapel;?>"/>
	</div>
	<div class="col-sm-4">
		&nbsp;
		<br><button id="edit-mapel" class="btn btn-primary" style="width: 100%;">Edit Mata Pelajaran</button>
		
		<input type="hidden" id="idpsepmapel" value="<?php echo $datamapel->id_psep_mapel;?>" />
	</div>
</div>

<script>
$(function(){
	$("#edit-mapel").click(function(){
		if($("#edit-kelas-mapel").val() === '0' || $("#edit-input-mapel").val() === ""){
			alert("Form Mata Pelajaran Tidak Lengkap");
		}else{
			idkelas			= $("#edit-kelas-mapel").val();
			mapel			= $("#edit-input-mapel").val();
			idpsepmapel		= $("#idpsepmapel").val();
			$.ajax({
				type: 'POST',
				url: 'silabus/ajax_proses_edit_mapel',
				data:{
					'idpsepmapel'	: idpsepmapel,
					'idkelas'		: idkelas,
					'mapel'			: mapel
				}
			});
		}
	});
	
	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "silabus/ajax_proses_edit_mapel"){
			$('#text-load').html('Menyimpan Mata Pelajaran');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "silabus/ajax_proses_edit_mapel"){
			$("#daftar-mapel").load("silabus/ajax_mapel_by_kelas/" + request.responseText);
			$('#modalsilabus').modal('hide');
			$('#modal-loader').modal('hide');
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "silabus/ajax_proses_edit_mapel"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
})
</script>