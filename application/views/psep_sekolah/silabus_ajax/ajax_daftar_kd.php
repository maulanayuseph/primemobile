<table class="table display table-bordered table-striped">
	<thead>
		<tr>
			<th class="text-center" style="width: 10px;">Semester</th>
			<th class="text-center" style="width: 10px;">Kode KD</th>
			<th class="text-center">Kompetensi Dasar</th>
			<th class="text-center">Operasi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($daftarkd as $kd){
				?>
				<tr>
					<td class="text-center">Semester <?php echo $kd->semester;?></td>
					<td class="text-center"><?php echo $kd->ki;?>.<?php echo $kd->no_kd;?></td>
					<td><?php echo $kd->kompetensi_dasar;?></td>
					<td class="text-center">
						<button class="btn btn-sm btn-warning edit-kd" id="edit-kd-<?php echo $kd->id_kd;?>" data-toggle="modal" data-target="#modalsilabus" ><i class="fa fa-pencil" aria-hidden="true"></i></button>
						
						<button class="btn btn-sm btn-danger hapus-kd" id="hapus-kd-<?php echo $kd->id_kd;?>"><i class="fa fa-remove" aria-hidden="true"></i></button>
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

    $(".edit-kd").click(function(){
    	rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idkd		= idsplit[2];
		
		$("#konten-modal").load("silabus/edit_kd/" + idkd);
    })
    $(".hapus-kd").click(function(){
    	if(confirm('Apakah anda yakin untuk menghapus KD ?')){
			rawid 		= $(this).attr("id");
			idsplit 	= rawid.split("-");
			idkd		= idsplit[2];
			
			$.ajax({
				type: 'POST',
				url: 'silabus/hapus_kd',
				data:{
					'idkd'			: idkd
				}
			});
    	}
    });
    $(document).ajaxSend(function(event, jqxhr, settings){
		alamat 		= settings.url;
		urledit		= alamat.substring(0, 15);
		if(urledit === "silabus/edit_kd"){
			$('#text-load').html('Memuat kompetensi dasar');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "silabus/hapus_kd"){
			$('#text-load').html('Memuat kompetensi dasar');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 		= options.url;
		urledit		= alamat.substring(0, 15);
		if(urledit === "silabus/edit_kd"){
			$('#modal-loader').modal('hide');
		}
		if(options.url === "silabus/hapus_kd"){
			obj = JSON.parse(request.responseText);
			$("#daftar-kd").load("silabus/ajax_daftar_kd/" + obj['mapel'] + "/"  + obj['tahun']);
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 		= options.url;
		urledit		= alamat.substring(0, 15);
		if(urledit === "silabus/edit_kd"){
			$('#modal-loader').modal('hide');
			$('#modalsilabus').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(options.url === "silabus/hapus_kd"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
})
</script>