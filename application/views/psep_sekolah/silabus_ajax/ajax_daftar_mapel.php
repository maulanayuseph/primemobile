<table class="table display table-striped table-bordered">
	<thead>
		<tr>
			<th style="width: 10px;">#</th>
			<th class="text-center">Mata Pelajaran</th>
			<th class="text-center">Kelas</th>
			<th class="text-center">Pembuat</th>
			<th class="text-center">Operasi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($datamapel as $mapel){
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td><?php echo $mapel->nama_psep_mapel;?></td>
					<td class="text-center"><?php echo $mapel->alias_kelas;?></td>
					<td class="text-center"><?php echo $mapel->username;?></td>
					<td class="text-center">
						<button class="btn btn-sm btn-warning edit-mapel" id="edit-mapel-<?php echo $mapel->id_psep_mapel;?>" data-toggle="modal" data-target="#modalsilabus"><i class="fa fa-pencil" aria-hidden="true"></i></button>
						
						<button class="btn btn-sm btn-danger hapus-mapel" id="edit-mapel-<?php echo $mapel->id_kelas;?>-<?php echo $mapel->id_psep_mapel;?>"><i class="fa fa-remove" aria-hidden="true"></i></button>
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
} );
</script>

<script>
$(function(){
	$(".edit-mapel").click(function(){
		rawid 	= $(this).attr('id');
		splitid = rawid.split("-");
		idmapel = splitid[2];
		$("#konten-modal").load("silabus/ajax_edit_mapel/" + idmapel);
	});
	$(".hapus-mapel").click(function(){
		if(confirm("Apakah anda yakin akan menghapus mata pelajaran ?")){
			rawid 	= $(this).attr('id');
			splitid = rawid.split("-");
			idkelas = splitid[2];
			idmapel = splitid[3];
			$("#konten-modal").load("silabus/ajax_hapus_mapel/" + idkelas + "/" + idmapel);
		}
	});
	$(document).ajaxSend(function(event, jqxhr, settings){
		alamat 		= settings.url;
		urledit		= alamat.substring(0, 23);
		urlhapus	= alamat.substring(0, 24);
		if(urledit === "silabus/ajax_edit_mapel"){
			$('#text-load').html('Memuat Mata Pelajaran');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(urlhapus === "silabus/ajax_hapus_mapel"){
			$('#text-load').html('Menghapus Mata Pelajaran');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 		= options.url;
		urledit		= alamat.substring(0, 23);
		urlhapus	= alamat.substring(0, 24);
		if(urledit === "silabus/ajax_edit_mapel"){
			$('#modal-loader').modal('hide');
		}
		if(urlhapus === "silabus/ajax_hapus_mapel"){
			$('#modal-loader').modal('hide');
			$("#daftar-mapel").load("silabus/ajax_mapel_by_kelas/" + request.responseText);
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 		= options.url;
		urledit		= alamat.substring(0, 23);
		urlhapus	= alamat.substring(0, 24);
		if(urledit === "silabus/ajax_edit_mapel"){
			$('#modal-loader').modal('hide');
			$('#modalsilabus').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(urlhapus === "silabus/ajax_hapus_mapel"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
})
</script>