<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<strong>Kelas :</strong>
		<br>
		<select id="input-bab-kelas" class="form-control">
			<?php
				foreach($datakelas as $kelas){
					?>
					<option value="<?php echo $kelas->id_kelas;?>" <?php echo $bab->id_kelas == $kelas->id_kelas ? "selected" : "";?>><?php echo $kelas->alias_kelas;?></option>
					<?php
				}
			?>
		</select>
		<br>&nbsp;
		<br><strong>Kurikulum :</strong>
		<br>
		<select class="form-control" id="input-bab-kurikulum">
			<?php
				foreach($datakurikulum as $kurikulum){
					?>
					<option value="<?php echo $kurikulum->id_kurikulum;?>"<?php echo $bab->id_kurikulum == $kurikulum->id_kurikulum ? "selected" : "";?>><?php echo $kurikulum->nama_kurikulum;?></option>
					<?php
				}
			?>
		</select>
		<br>&nbsp;
		<br><strong>Mata Pelajaran :</strong>
		<br>
		<select class="form-control" id="input-bab-mapel">
			<?php
				foreach($datamapel as $mapel){
					?>
					<option value="<?php echo $mapel->id_mapel;?>" <?php echo $mapel->id_mapel == $bab->id_mapel ? "selected" : "" ;?>>
						<?php echo $mapel->nama_mapel;?>
					</option>
					<?php
				}
			?>
		</select>
		<br>&nbsp;
		<br><strong>Judul Bab :</strong>
		<br>
		<input type="text" id="input-bab-nama" class="form-control" value="<?php echo $bab->nama_materi_pokok;?>">
		<br>&nbsp;
		<br>
		<button class="btn btn-sm btn-danger" style="width: 100%;" id="btn-simpan">Edit Bab</button>
	</div>
	<div class="col-sm-4">
	</div>
</div>

<script type="text/javascript">
$(function(){
	$("#input-bab-kurikulum").change(function(){
		idkelas 		= $("#input-bab-kelas").val();
		idkurikulum 	= $(this).val();
		if(idkelas !== "" && idkurikulum !== ""){
			$("#input-bab-mapel").load("manajemen_bab/filter_mapel/" + idkelas + "/" + idkurikulum);
		}else{
			$("#input-bab-mapel").html("<option value=''>-- Filter Mapel --</option>");
		}
	})

	$("#input-bab-kelas").change(function(){
		idkurikulum = $("#input-bab-kurikulum").val();
		idkelas 	= $(this).val();
		if(idkurikulum !== "" && idkelas !== ""){
			$("#input-bab-mapel").load("manajemen_bab/filter_mapel/" + idkelas + "/" + idkurikulum);
		}else{
			$("#input-bab-mapel").html("<option value=''>-- Filter Mapel --</option>");
		}
	})

	$("#btn-simpan").click(function(){
		idmapel 	= $("#input-bab-mapel").val();
		bab 		= $("#input-bab-nama").val();
		if(idmapel !== "" && bab !== ""){
			$.ajax({
				type: 'POST',
				url: 'manajemen_bab/proses_edit',
				data:{
					'idbab'		: <?php echo $bab->id_materi_pokok;?>,
					'idmapel'	: idmapel,
					'bab'		: bab
				}
			});
		}else{
			alert("Lengkapi form sebelum menambahkan bab!");
		}
	})
})
</script>