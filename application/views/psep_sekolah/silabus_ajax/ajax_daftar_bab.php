<table class="table display table-striped table-bordered">
	<thead>
		<tr>
			<th style="width: 10px;">#</th>
			<th class="text-center">Bab</th>
			<th class="text-center">Mata Pelajaran</th>
			<th class="text-center">Kurikulum</th>
			<th class="text-center">Tahun Ajaran</th>
			<th class="text-center">Operasi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($databab as $bab){
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td>
						<?php
							echo $bab->nama_psep_bab;
						?>
						<br><i>Ditambahkan Oleh : <?php echo $bab->username;?></i>
					</td>
					<td class="text-center"><?php echo $bab->nama_psep_mapel;?></td>
					<td class="text-center"><?php echo $bab->kurikulum;?></td>
					<td class="text-center"><?php echo $bab->tahun_ajaran;?></td>
					<td class="text-center">
						<button class="btn btn-sm btn-warning edit-bab" id="edit-bab-<?php echo $bab->id_psep_bab;?>" data-toggle="modal" data-target="#modalsilabus"><i class="fa fa-pencil" aria-hidden="true"></i></button>
						
						<button class="btn btn-sm btn-danger hapus-bab" id="hapus-bab-<?php echo $bab->id_psep_bab;?>"><i class="fa fa-remove" aria-hidden="true"></i></button>
						
						<a class="btn btn-sm btn-primary masuk-sub" data-toggle="modal" data-target="#modalsilabus" id="lihat-sub-<?php echo $bab->id_psep_bab;?>">Lihat Sub Bab <i class="fa fa-caret-square-o-right" aria-hidden="true"></i></a>
					</td>
				</tr>
				<?php
				$x++;
			}
		?>
	</tbody>
</table>

<script>
$(document).ready(function() {
    $('table.display').DataTable();
});

$(function(){
	$(".edit-bab").click(function(){
		rawid		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idpsepbab	= idsplit[2];
		$("#konten-modal").load("silabus/ajax_edit_bab/" + idpsepbab);
	})
	$(".hapus-bab").click(function(){
		if(confirm("Apakah anda yakin untuk menghapus bab ?")){
			rawid		= $(this).attr("id");
			idsplit 	= rawid.split("-");
			idpsepbab	= idsplit[2];
			
			$.ajax({
				type: 'POST',
				url: 'silabus/ajax_hapus_bab',
				data:{
					'idpsepbab'		: idpsepbab
				}
			});
		}
	})
	$(".masuk-sub").click(function(){
		rawid		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idpsepbab	= idsplit[2];
		$("#konten-modal").load("silabus/ajax_sub/" + idpsepbab);
	})
	$(document).ajaxSend(function(event, jqxhr, settings){
		alamat 		= settings.url;
		urledit		= alamat.substring(0, 21);
		urlsub		= alamat.substring(0, 16);
		if(urledit === "silabus/ajax_edit_bab"){
			$('#text-load').html('Memuat bab');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "silabus/ajax_hapus_bab"){
			$('#text-load').html('Menghapus bab');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(urlsub === "silabus/ajax_sub"){
			$('#text-load').html('Memuat Sub Bab');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 		= options.url;
		urledit		= alamat.substring(0, 21);
		urlsub		= alamat.substring(0, 16);
		if(urledit == "silabus/ajax_edit_bab"){
			$('#modal-loader').modal('hide');
		}
		if(options.url === "silabus/ajax_hapus_bab"){
			obj = JSON.parse(request.responseText);
			$("#daftar-bab").load("silabus/ajax_bab/" + obj['mapel'] + "/" + obj['kurikulum'] + "/" + obj['tahun']);
		}
		if(urlsub === "silabus/ajax_sub"){
			$('#modal-loader').modal('hide');
			$('#modalsilabus').appendTo("body").modal('show');
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 		= options.url;
		urledit		= alamat.substring(0, 21);
		urlsub		= alamat.substring(0, 16);
		if(urledit === "silabus/ajax_edit_bab"){
			$('#modal-loader').modal('hide');
			$('#modalsilabus').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(options.url === "silabus/ajax_hapus_bab"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(urlsub === "silabus/ajax_sub"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
})
</script>