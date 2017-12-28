<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("../ajax_mapel/" + $("#kelas").val());
	});
	$("#mapel").change(function(){
		$("#mapok").load("../ajax_mapok/" + $("#mapel").val() + "/" + encodeURIComponent($("#kurikulum").val()));
	});
	$("#kurikulum").change(function(){
		$("#mapok").load("../ajax_mapok/" + $("#mapel").val() + "/" + encodeURIComponent($("#kurikulum").val()));

		$("#latihansoal").html("<option value=''>-- Pilih Latihan Soal --</option>");
	})
	$("#mapok").change(function(){
		$("#latihansoal").load("../ajax_latihan_soal/" + $("#mapok").val() + "/" + encodeURIComponent($("#kurikulum").val()));
	});
	$("#latihansoal").change(function(){
		$("#daftarsoal").load("../ajax_soal_by_latihan/" + $("#latihansoal").val() + "/" + <?php echo $idpr;?>);

		$("#bobotsoal").html('<option value="">-- Pilih Bobot Soal --</option><option value="semua">Semua Bobot</option><option value="1">Mudah</option><option value="2">Sedang</option><option value="3">Sulit</option>');
	});
	
	$("#bobotsoal").change(function(){
		idlatihan 	= $("#latihansoal").val();
		bobot 		= $(this).val();
		if(idlatihan !== "" && bobot !== ""){
			$("#daftarsoal").load("../ajax_soal_by_latihan_and_bobot/" + $("#latihansoal").val() + "/" + <?php echo $idpr;?> + "/" + $(this).val());
		}
	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		console.log(settings.url);
		alamat 		= settings.url;
		//urlpasti	= alamat.substring(0, 18);
		urllihatsoal	= alamat.substring(0, 23);
		//console.log(urlpasti);
		if(urllihatsoal === "../ajax_soal_by_latihan"){
			$('#text-load').html('memuat soal');
			$('#modal-loader').appendTo("body").modal('show');
			
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		console.log(options.url);
		alamat 		= options.url;
		urllihatsoal	= alamat.substring(0, 23);
		//console.log(urlpasti);
		if(urllihatsoal === "../ajax_soal_by_latihan"){
			$('#modal-loader').modal('hide');
			$('#modal-soal').appendTo("body").modal('show');
		}
	});
	$(document).ajaxError(function(event, request, options){
		console.log(options.url);
		alamat 		= options.url;
		urllihatsoal	= alamat.substring(0, 23);
		//console.log(urlpasti);
		if(urllihatsoal === "../ajax_soal_by_latihan"){
			console.log(urlpasti);
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
			$('#modal-soal').appendTo("body").modal('show');
		}
	})
});
</script>
<select class="form-control" id="kurikulum">
	<option value="K-13">K-13</option>
	<option value="K-13 REVISI">K-13 REVISI</option>
	<option value="KTSP">KTSP</option>
</select>
<p>&nbsp;
<select class="form-control" id="kelas">
	<option value=''>-- Pilih Kelas --</option>
	<?php
		foreach($datakelas as $kelas){
			?>
				<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
			<?php
		}
	?>
</select>
<p>&nbsp;
<select id="mapel" class="form-control">
	<option value=''>-- Pilih Mata Pelajaran --</option>
</select>
<p>&nbsp;
<select id="mapok" class="form-control">
	<option value=''>-- Pilih Materi Pokok --</option>
</select>
<p>&nbsp;
<select id="latihansoal" class="form-control">
	<option value=''>-- Pilih Latihan Soal --</option>
</select>
<p>&nbsp;
<select id="bobotsoal" class="form-control">
	<option value="">-- Pilih Bobot Soal --</option>
	<option value="semua">Semua Bobot</option>
	<option value="1">Mudah</option>
	<option value="2">Sedang</option>
	<option value="3">Sulit</option>
</select>

