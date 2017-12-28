<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th style="width: 10px;">No.</th>
					<th>Soal</th>
					<th>Operasi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$x = 1;
					foreach($datasoal as $soal){
						?>
						<tr id="tr-soal-<?php echo $soal->id_soal_essai;?>">
						<td><?php echo $x;?></td>
						<td id="td-soal-<?php echo $soal->id_soal_essai;?>">
							<p><strong>Pertanyaan :</strong> <i class="fa fa-pencil edit-soal" aria-hidden="true" id="edit-soal-<?php echo $soal->id_soal_essai;?>" data-toggle="modal" data-target="#modaledit" role="button"></i></p> 
							
							<div id="isi-soal-<?php echo $soal->id_soal_essai;?>">
							<?php echo $soal->soal;?>
							</div>
							
							<p><strong>Jawaban :</strong> <i class="fa fa-pencil edit-jawaban" aria-hidden="true" aria-hidden="true" id="edit-jawaban-<?php echo $soal->id_soal_essai;?>" data-toggle="modal" data-target="#modaledit" role="button"></i></p>
							
							<div id="isi-jawaban-<?php echo $soal->id_soal_essai;?>">
							<?php echo $soal->jawaban;?>
							</div>
						</td>
						<td class="text-center">
							<!--
							<button class="btn btn-sm btn-warning edit-soal" id="edit-soal-<?php echo $soal->id_soal_essai;?>" data-toggle="modal" data-target="#modaledit" ><i class="fa fa-pencil" aria-hidden="true"></i></button>
							-->
							<button class="btn btn-sm btn-danger hapus-soal" id="hapus-soal-<?php echo $soal->id_soal_essai;?>"><i class="fa fa-remove" aria-hidden="true"></i></button>
							
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
$(function(){
	$(".edit-soal").click(function(){
		rawid 	= $(this).attr('id');
		idsplit = rawid.split("-");
		idsoal 	= idsplit[2];
		//alert(rawid);
		$("#konten-edit").html("");
		$("#konten-edit").load("../ajax_edit_soal_essai/" + idsoal);
	});
	$(".edit-jawaban").click(function(){
		rawid 	= $(this).attr('id');
		idsplit = rawid.split("-");
		idsoal 	= idsplit[2];
		//alert(rawid);
		$("#konten-edit").html("");
		$("#konten-edit").load("../ajax_edit_jawaban_essai/" + idsoal);
	});
	$(".hapus-soal").click(function(){
		if(confirm("Apakah anda yakin akan menghapus soal ?")){
			rawid 	= $(this).attr('id');
			idsplit = rawid.split("-");
			idsoal 	= idsplit[2];
			
			$.ajax({
				type: 'POST',
				url: '../ajax_proses_hapus_soal_essai',
				data:{
					'idsoal' 		: idsoal
				}
			});
		}
	});
	$(document).ajaxSend(function(event, jqxhr, settings){
		//console.log(settings.url);
		alamat 		= settings.url;
		urledit		= alamat.substring(0, 23);
		//console.log(urlpasti);
		if(urledit === "../ajax_edit_soal_essai"){
			$('#text-load').html('memuat soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === '../ajax_proses_hapus_soal_essai'){
			$('#text-load').html('menghapus soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		console.log(options.url);
		alamat 		= options.url;
		urledit		= alamat.substring(0, 23);
		//console.log(urlpasti);
		if(urledit === "../ajax_edit_soal_essai"){
			$('#modal-loader').modal('hide');
		}
		if(options.url === '../ajax_proses_hapus_soal_essai'){
			$('#modal-loader').modal('hide');
			idsoal = request.responseText;
			$("#tr-soal-" + idsoal).remove();
		}
	});
	$(document).ajaxError(function(event, request, options){
		console.log(options.url);
		alamat 		= options.url;
		urledit		= alamat.substring(0, 23);
		//console.log(urlpasti);
		if(urledit === "../ajax_edit_soal_essai"){
			console.log(urlpasti);
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
			$('#modaledit').modal('hide');
		}
		if(options.url === '../ajax_proses_hapus_soal_essai'){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
			$('#modaledit').modal('hide');
		}
	})
});
</script>