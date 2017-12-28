<div class="row">
	<div class="col-sm-6">
		<select class="form-control" id="kelas-tambah-kd">
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
		<select class="form-control" id="mapel-tambah-kd">
			<option value='0'>-- Pilih Mata Pelajaran --</option>
		</select>
	</div>
	<div class="col-sm-12">
		&nbsp;
	</div>
	<div class="col-sm-6">
		<select class="form-control" id="tahun-ajaran-tambah-kd">
			<option value='0'>-- Pilih Tahun Ajaran --</option>
			<?php
				foreach($tahunajaran as $tahun){
					?>
					<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
					<?php
				}
			?>
		</select>
	</div>
	<div class="col-sm-6">
		<select class="form-control" id="semester-tambah-kd">
			<option value='0'>-- Pilih Semester --</option>
			<?php
				if($jenjang == "SD"){
					?>
					<option value="1">Semester 1</option>
					<option value="2">Semester 2</option>
					<?php
				}else{
					?>
					<option value="1">Semester 1</option>
					<option value="2">Semester 2</option>
					<option value="3">Semester 3</option>
					<option value="4">Semester 4</option>
					<option value="5">Semester 5</option>
					<option value="6">Semester 6</option>
					<?php
				}
			?>
		</select>
	</div>
	<div class="col-sm-12" style="color: grey;">
		&nbsp;
		<br>* Kompetensi Inti (KI)
		<br>3 : Untuk Kompetensi Inti Pengetahuan
		<br>4 : Untuk kompetensi inti Ketrampilan
		<br>&nbsp;
	</div>
	<div class="col-sm-2">
		<select class="form-control" id="ki">
			<option value="0">KI</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
	</div>
	<div class="col-sm-2">
		<select class="form-control" id="kd">
			<option value="0">KD</option>
			<?php
				for($i = 1; $i <= 10; $i++){
					?>
					<option value="<?php echo $i;?>"><?php echo $i;?></option>
					<?php
				}
			?>
		</select>
	</div>
	<div class="col-sm-8">
		<textarea class="form-control" id="deskripsi-kd" placeholder="Masukkan deskripsi KD"></textarea>
	</div>
	<div class="col-sm-12">
		&nbsp;
	</div>
	<div class="col-sm-12" style="text-align: right;">
		<button class="btn btn-sm btn-primary" id="simpan-kd">Simpan Kompetensi Dasar</button>
	</div>
</div>

<script>
$(function(){
	$("#kelas-tambah-kd").change(function(){
		$("#mapel-tambah-kd").load("silabus/ajax_dropdown_mapel_by_kelas/" + $(this).val());
	});
	$("#simpan-kd").click(function(){
		mapel 		= $("#mapel-tambah-kd").val();
		tahunajaran	= $("#tahun-ajaran-tambah-kd").val();
		semester	= $("#semester-tambah-kd").val();
		ki 			= $("#ki").val();
		kd 			= $("#kd").val();
		deskripsi 	= $("#deskripsi-kd").val();
		if(mapel === 0 || tahunajaran === 0 || semester === 0 || ki === 0 || kd === 0 || deskripsi === ""){
			alert("Lengkapi form sebelum menyimpan KD");
		}else{
			$.ajax({
				type: 'POST',
				url: 'silabus/ajax_proses_kd',
				data:{
					'mapel'			: mapel,
					'tahunajaran'	: tahunajaran,
					'semester'		: semester,
					'ki'			: ki,
					'kd'			: kd,
					'deskripsi'		: deskripsi
				}
			});
		}
	});

	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url == "silabus/ajax_proses_kd"){
			$('#text-load').html('Menyimpan kompetensi dasar');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url == "silabus/ajax_proses_kd"){
			$('#modalsilabus').modal('hide');
			obj = JSON.parse(request.responseText);
			$("#daftar-kd").load("silabus/ajax_daftar_kd/" + obj['mapel'] + "/"  + obj['tahun']);
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "silabus/ajax_proses_kd"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
})
</script>