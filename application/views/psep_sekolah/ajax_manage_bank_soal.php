<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("../ajax_mapel/" + $("#kelas").val());
	});
	$("#mapel").change(function(){
		$("#kategori").load("../ajax_kategori/" + $("#mapel").val());
	});
	$("#kategori").change(function(){
		$("#daftarsoal").load("../ajax_bank_soal/" + $("#kategori").val() + "/" + <?php echo $idpr;?>);
	});
});
</script>

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
<select id="kategori" class="form-control">
	<option value=''>-- Pilih Kategori Bank Soal --</option>
</select>

