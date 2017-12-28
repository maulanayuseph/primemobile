<div class="row">
	<div class="col-sm-4">
		<strong>Kelas : </strong>
		<br>
		<select id="input-kelas-mapel" class="form-control">
			<option value="0">-- Pilih Kelas --</option>
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
		<input type="text" id="input-mapel" class="form-control" />
	</div>
	<div class="col-sm-4">
		&nbsp;
		<br><button id="simpan-mapel" class="btn btn-primary" style="width: 100%;">Simpan Mata Pelajaran</button>
	</div>
</div>

<script>
$(function(){
	$("#simpan-mapel").click(function(){
		if($("#input-kelas-mapel").val() === '0' || $("#input-mapel").val() === ""){
			alert("Form Mata Pelajaran Tidak Lengkap");
		}else{
			idkelas		= $("#input-kelas-mapel").val();
			mapel		= $("#input-mapel").val();
			$.ajax({
				type: 'POST',
				url: 'silabus/ajax_proses_tambah_mapel',
				data:{
					'idkelas'	: idkelas,
					'mapel'		: mapel
				}
			});
		}
	});
	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "silabus/ajax_proses_tambah_mapel"){
			$('#text-load').html('Menyimpan Mata Pelajaran');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "silabus/ajax_proses_tambah_mapel"){
			$("#daftar-mapel").load("silabus/ajax_mapel_by_kelas/" + request.responseText);
			$('#modalsilabus').modal('hide');
			$('#modal-loader').modal('hide');
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "silabus/ajax_proses_tambah_mapel"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
})
</script>