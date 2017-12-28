<div class="col-sm-4">
</div>
<div class="col-sm-4">
	<strong>Kelas :</strong>
	<select class="form-control" id="tambah-kelas">
		<option value="">
			-- Pilih Kelas --
		</option>
		<?php
			foreach($datakelas as $kelas){
				?>
				<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
				<?php
			}
		?>
	</select>
	<br>&nbsp;
	<strong>Tahun Ajaran :</strong>
	<select class="form-control" id="tambah-tahun">
		<option value="">
			-- Pilih Tahun Ajaran --
		</option>
		<?php
			foreach($tahunajaran as $tahun){
				?>
				<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
				<?php
			}
		?>
	</select>
	<br>&nbsp;
	<strong>Semester :</strong>
	<select class="form-control" id="tambah-semester">
		<option value="">
			-- Pilih Semester --
		</option>
		<option value="1">Semester 1</option>
		<option value="2">Semester 2</option>
		<option value="3">Semester 3</option>
		<option value="4">Semester 4</option>
		<option value="5">Semester 5</option>
		<option value="6">Semester 6</option>
	</select>
	<br>&nbsp;
	<button class="btn btn-sm btn-danger" id="simpan-profil" style="width: 100%;">Simpan Profil Raport</button>
</div>
<div class="col-sm-4">
</div>

<script type="text/javascript">
$(function(){
	$("#simpan-profil").click(function(){
		kelas 		= $("#tambah-kelas").val();
		tahun 		= $("#tambah-tahun").val();
		semester 	= $("#tambah-semester").val();
		if(kelas !== "" && tahun !== "" && semester !== ""){
			$.ajax({
				type: 'POST',
				url: 'raport/proses_tambah_profil',
				data:{
					kelas 		: kelas,
					tahun 		: tahun,
					semester 	: semester
				}
			})
		}else{
			alert("Lengkapi form sebelum menyimpan profil");
		}
	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url == "raport/proses_tambah_profil"){
			$('#text-load').html('Menyimpan bab');
			$('#modal-loader').appendTo("body").modal('show');
			console.log(settings.url);
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "raport/proses_tambah_profil"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
})
</script>