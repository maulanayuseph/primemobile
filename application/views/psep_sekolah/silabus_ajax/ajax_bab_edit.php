<div class="row">
	<div class="col-sm-6">
		<select id="kelas-input-bab" class="form-control"> 
			<option value="<?php echo $bab->id_kelas;?>"><?php echo $bab->alias_kelas;?></option>
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
			<option value='<?php echo $bab->id_psep_mapel;?>'><?php echo $bab->nama_psep_mapel;?></option>
		</select>
	</div>
	<div class="col-sm-12">
		&nbsp;
	</div>
	<div class="col-sm-6">
		<select class="form-control" id="kurikulum-input-bab">
			<option value="<?php echo $bab->kurikulum;?>"><?php echo $bab->kurikulum;?></option>
			<option value="KTSP">KTSP</option>
			<option value="K-13">K-13</option>
		</select>
	</div>
	<div class="col-sm-6">
		<select class="form-control" id="tahun-input-bab">
			<option value="<?php echo $bab->id_tahun_ajaran;?>"><?php echo $bab->tahun_ajaran;?></option>
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
			<option value="1" <?php echo $bab->semester == 1 ? 'selected' : '';?>>Semester 1</option>
			<option value="2" <?php echo $bab->semester == 2 ? 'selected' : '';?>>Semester 2</option>
			<option value="3" <?php echo $bab->semester == 3 ? 'selected' : '';?>>Semester 3</option>
			<option value="4" <?php echo $bab->semester == 4 ? 'selected' : '';?>>Semester 4</option>
			<option value="5" <?php echo $bab->semester == 5 ? 'selected' : '';?>>Semester 5</option>
			<option value="6" <?php echo $bab->semester == 6 ? 'selected' : '';?>>Semester 6</option>
		</select>
	</div>
	<div class="col-sm-12">
		&nbsp;
	</div>
	<div class="col-sm-12">
		<input type="text" id="nama-bab" class="form-control" placeholder="Masukkan Nama Bab" value="<?php echo $bab->nama_psep_bab;?>"/>
	</div>
	<div class="col-sm-12">
		&nbsp;
	</div>
	<div class="col-sm-6">
		<input type="hidden" id="idpsepbab" value="<?php echo $bab->id_psep_bab;?>" />
	</div>
	<div class="col-sm-12">
		&nbsp;
	</div>
	<div class="col-sm-6">
		<button class="btn btn-sm btn-primary" id="simpan-bab" style="width: 100%;">Edit Bab</button>
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
		idpsepbab 		= $("#idpsepbab").val();
		semester 		= $("#semester-input-bab").val();
		if(idkelas === 0 || idpsepmapel === 0 || kurikulum === 0 || tahunajaran === 0 || bab === ""){
			alert("Lengkapi form sebelum menyimpan bab");
		}else{
			$.ajax({
				type: 'POST',
				url: 'silabus/ajax_proses_edit_bab',
				data:{
					'idpsepbab'		: idpsepbab,
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
		if(settings.url == "silabus/ajax_proses_edit_bab"){
			$('#text-load').html('Menyimpan bab');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url == "silabus/ajax_proses_edit_bab"){
			$('#modalsilabus').modal('hide');
			obj = JSON.parse(request.responseText);
			$("#daftar-bab").load("silabus/ajax_bab/" + obj['mapel'] + "/" + obj['kurikulum'] + "/" + obj['tahun']);
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "silabus/ajax_proses_edit_bab"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
});
</script>