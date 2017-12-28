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
	<?php
		foreach($datamapel as $mapel){
			?>
			<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>
			<?php
		}
	?>
</select>
<p>&nbsp;
<select id="kategori" class="form-control">
	<option value=''>-- Pilih Kategori Bank Soal --</option>
	<?php
		foreach($datakategori as $kategori){
			?>
			<option value="<?php echo $kategori->id_atribut;?>"><?php echo $kategori->atribut;?></option>
			<?php
		}
	?>
</select>
<p>&nbsp;
<button class="btn btn-sm btn-danger" style="width: 100%;" id="filter-bank-soal-sekolah">Filter Soal</button>

<script type="text/javascript">
$(function(){
	$("#filter-bank-soal-sekolah").click(function(){
		idmapel 	= $("#mapel").val();
		idatribut 	= $("#kategori").val();
		$.ajax({
			type: 'POST',
			url: '../filter_bank_soal_sekolah',
			data:{
				'idmapel'		: idmapel,
				'idatribut'		: idatribut,
				'idpr'			: <?php echo $idpr;?>
			}
		});
	})

	
})
</script>

