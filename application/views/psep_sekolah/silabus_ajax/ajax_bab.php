<div class="row">
	<div class="col-sm-6">
		<select id="kelas-input-bab" class="form-control"> 
			<option value="0">--- Pilih Kelas ---</option>
			<?php
				foreach($datakelas as $kelas){
					?>
					<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
					<?php
				}
			?>
		</select>
	</div>
	<div class="col-sm-6">
		<select class="form-control" id="mapel-input-bab">
			<option value='0'>-- Pilih Mata Pelajaran --</option>
		</select>
	</div>
	<div class="col-sm-12">
		&nbsp;
	</div>
	<div class="col-sm-6">
		<select class="form-control" id="kurikulum-input-bab">
			<option value="0">-- Pilih Kurikulum --</option>
			<option value="KTSP">KTSP</option>
			<option value="K-13">K-13</option>
		</select>
	</div>
	<div class="col-sm-6">
		<select class="form-control" id="tahun-input-bab">
			<option value="0">-- Pilih Tahun Ajaran --</option>
			<?php
				foreach($tahunajaran as $tahun){
					?>
					<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
					<?php
				}
			?>
		</select>
	</div>
	<div class="col-sm-12">
		&nbsp;
	</div>
	<div class="col-sm-6">
		<select class="form-control" id="semester-input-bab">
			<option value="0">-- Pilih Semester --</option>
			<option value="1">Semester 1</option>
			<option value="2">Semester 2</option>
			<option value="3">Semester 3</option>
			<option value="4">Semester 4</option>
			<option value="5">Semester 5</option>
			<option value="6">Semester 6</option>
		</select>
	</div>
	<div class="col-sm-12">
		&nbsp;
	</div>
	<div class="col-sm-12">
		<strong>Judul Bab/Tema :</strong>
		<br><input type="text" id="nama-bab" class="form-control" placeholder="Masukkan Judul Bab/Tema" />
	</div>
	<div class="col-sm-12">
		&nbsp;
	</div>
	<div class="col-sm-6">
	</div>
	<div class="col-sm-6">
		<button class="btn btn-sm btn-primary" id="simpan-bab" style="width: 100%;">Tambah Bab</button>
	</div>
</div>

<script>
$(function(){
	$("#kelas-input-bab").change(function(){
		$("#mapel-input-bab").load("silabus/ajax_dropdown_mapel_by_kelas/" + $("#kelas-input-bab").val());
	});
	
	$("#simpan-bab").click(function(){
		idkelas 		= $("#kelas-input-bab").val();
		idpsepmapel 	= $("#mapel-input-bab").val();
		kurikulum 		= $("#kurikulum-input-bab").val();
		tahunajaran 	= $("#tahun-input-bab").val();
		bab 			= $("#nama-bab").val();
		semester 		= $("#semester-input-bab").val();
		if(idkelas === 0 || idpsepmapel === 0 || kurikulum === 0 || tahunajaran === 0 || bab === "" || semester === 0){
			alert("Lengkapi form sebelum menyimpan bab");
		}else{
			$.ajax({
				type: 'POST',
				url: 'silabus/ajax_proses_tambah_bab',
				data:{
					'idkelas'		: idkelas,
					'idpsepmapel'	: idpsepmapel,
					'kurikulum'		: kurikulum,
					'tahunajaran'	: tahunajaran,
					'bab'			: bab,
					'semester'		: semester
				}
			});
		}
	});
	
	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url == "silabus/ajax_proses_tambah_bab"){
			$('#text-load').html('Menyimpan bab');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url == "silabus/ajax_proses_tambah_bab"){
			$('#modalsilabus').modal('hide');
			obj = JSON.parse(request.responseText);
			$("#daftar-bab").load("silabus/ajax_bab/" + obj['mapel'] + "/" + obj['kurikulum'] + "/" + obj['tahun']);
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "silabus/ajax_proses_tambah_bab"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
});
</script>