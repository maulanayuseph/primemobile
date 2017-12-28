<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<strong>Kelas :</strong>
		<br>
		<select class="form-control" id="edit-kelas">
			<?php
				foreach($datakelas as $kelas){
					?>
					<option value="<?php echo $kelas->id_kelas;?>" <?php echo $kelas->id_kelas == $mapel->kelas_id ? "selected" : "" ;?>><?php echo $kelas->alias_kelas;?></option>
					<?php
				}
			?>
		</select>
		<br>&nbsp;
		<br>
		<strong>Kurikulum :</strong>
		<br>
		<select class="form-control" id="edit-kurikulum">
			<?php
				foreach($datakurikulum as $kurikulum){
					?>
					<option value="<?php echo $kurikulum->id_kurikulum;?>" <?php echo $kurikulum->id_kurikulum == $mapel->id_kurikulum ? "selected" : "" ;?>><?php echo $kurikulum->nama_kurikulum;?></option>
					<?php
				}
			?>
		</select>
		<br>&nbsp;
		<br>
		<strong>Nama Mata Pelajaran :</strong>
		<br>
		<input type="text" id="edit-nama-mapel" class="form-control" value="<?php echo $mapel->nama_mapel;?>"/>
		<br>&nbsp;
		<br>
		<button class="btn btn-sm btn-danger" id="simpan-mapel" style="width: 100%;">Edit Mata Pelajaran</button>
	</div>
	<div class="col-sm-4">
	</div>
</div>

<script type="text/javascript">
$(function(){
	$("#simpan-mapel").click(function(){
		idkelas 		= $("#edit-kelas").val();
		idkurikulum 	= $("#edit-kurikulum").val();
		mapel 			= $("#edit-nama-mapel").val();

		if(idkelas !== "" && idkurikulum !== "" && mapel !== ""){
			$.ajax({
				type: 'POST',
				url: 'manajemen_mapel/proses_edit',
				data:{
					'idmapel'		: <?php echo $mapel->id_mapel;?>,
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