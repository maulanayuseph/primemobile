<div class="row">
	<div class="col-sm-4">
		<table class="table">
			<tr>
				<td>Kelas</td>
				<td>:</td>
				<td><?php echo $bab->alias_kelas;?></td>
			</tr>
			<tr>
				<td>Mata Pelajaran</td>
				<td>:</td>
				<td><?php echo $bab->nama_psep_mapel;?></td>
			</tr>
			<tr>
				<td>Kurikulum</td>
				<td>:</td>
				<td><?php echo $bab->kurikulum;?></td>
			</tr>
			<tr>
				<td>Tahun Ajaran</td>
				<td>:</td>
				<td><?php echo $bab->tahun_ajaran;?></td>
			</tr>
			<tr>
				<td>Bab</td>
				<td>:</td>
				<td><?php echo $bab->nama_psep_bab;?></td>
			</tr>
		</table>
		<input type="hidden" id="idpsepbab" value="<?php echo $bab->id_psep_bab;?>" />
		<strong>Tambah Sub Bab :</strong>
		<br><input type="text" id="inputsub" class="form-control" placeholder="Masukkan Nama Sub Bab Baru" />
		<br><button class="btn btn-sm btn-primary" id="btn-tambah-sub" style="width: 100%;">Tambah Sub Bab</button>
	</div>
	<div class="col-sm-8" id="table-sub">
		<table class="table display table-bordered table-striped">
			<thead>
				<tr>
					<th style="width: 10px;">#</th>
					<th>Sub Bab</th>
					<th>Operasi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$x = 1;
					foreach($datasub as $sub){
						?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo $sub->nama_psep_sub_bab;?></td>
								<td class="text-center">
									<button class="btn btn-sm btn-warning edit-sub" id="edit-sub-<?php echo $sub->id_psep_sub_bab;?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
						
									<button class="btn btn-sm btn-danger hapus-bab" id="hapus-sub-<?php echo $sub->id_psep_sub_bab;?>"><i class="fa fa-remove" aria-hidden="true"></i></button>
								</td>
							</tr>
						<?php
						
						$x++;
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<script>
$(document).ready(function() {
    $('table.display').DataTable();
});
</script>

<script>
$(function(){
	$("#btn-tambah-sub").click(function(){
		inputsub 	= $("#inputsub").val();
		idpsepbab 	= $("#idpsepbab").val();
		if(inputsub === ""){
			alert("Masukkan Judul Sub Bab");
		}else{
			$.ajax({
				type: 'POST',
				url: 'silabus/ajax_tambah_sub',
				data:{
					'idpsepbab'		: idpsepbab,
					'namasub'		: inputsub
				}
			});
		}
	});
	$(".edit-sub").click(function(){
		rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idpsepsub	= idsplit[2];
		
		$("#konten-modal").load("silabus/edit_sub/" + idpsepsub);
	});
	$(document).ajaxSend(function(event, jqxhr, settings){
		alamat 		= settings.url;
		urledit		= alamat.substring(0, 16);
		if(settings.url === "silabus/ajax_tambah_sub"){
			$('#text-load').html('Menambah sub bab');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(urledit === "silabus/edit_sub"){
			$('#text-load').html('Memuat sub bab');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 		= options.url;
		urledit		= alamat.substring(0, 16);
		if(options.url === "silabus/ajax_tambah_sub"){
			$("#konten-modal").load("silabus/ajax_sub/" + request.responseText);
		}
		if(urledit === "silabus/edit_sub"){
			$('#modal-loader').modal('hide');
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 		= options.url;
		urledit		= alamat.substring(0, 16);
		if(options.url === "silabus/ajax_tambah_sub"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(urledit === "silabus/edit_sub"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
});
</script>