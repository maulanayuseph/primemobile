<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<strong>Kelas :</strong>
		<br>
		<select class="form-control" id="tambah-kelas">
			<option value="">-- Pilih Kelas --</option>
			<?php
				foreach($datakelas as $kelas){
					?>
					<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
					<?php
				}
			?>
		</select>
		<br>&nbsp;
		<br>
		<strong>Kurikulum :</strong>
		<br>
		<select class="form-control" id="tambah-kurikulum">
			<option value="">-- Pilih Kurikulum --</option>
			<?php
				foreach($datakurikulum as $kurikulum){
					?>
					<option value="<?php echo $kurikulum->id_kurikulum;?>"><?php echo $kurikulum->nama_kurikulum;?></option>
					<?php
				}
			?>
		</select>
		<br>&nbsp;
		<br>
		<strong>Nama Mata Pelajaran :</strong>
		<br>
		<input type="text" id="tambah-nama-mapel" class="form-control" />
		<br>&nbsp;
		<br>
		<button class="btn btn-sm btn-danger" id="simpan-mapel" style="width: 100%;">Tambah Mata Pelajaran</button>
	</div>
	<div class="col-sm-4">
	</div>
</div>

<script type="text/javascript">
$(function(){
	$("#simpan-mapel").click(function(){
		idkelas 		= $("#tambah-kelas").val();
		idkurikulum 	= $("#tambah-kurikulum").val();
		mapel 			= $("#tambah-nama-mapel").val();

		if(idkelas !== "" && idkurikulum !== "" && mapel !== ""){
			$.ajax({
				type: 'POST',
				url: 'manajemen_mapel/proses_tambah',
				data:{
					'idkelas'		: idkelas,
					'idkurikulum'	: idkurikulum,
					'mapel'			: mapel
				}
			});
		}else{
			alert("Lengkapi form sebelum menambahkan mata pelajaran!");
		}
	})
})
</script>