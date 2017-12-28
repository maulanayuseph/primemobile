<div class="row">	
	<div class="col-md-12">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center" style="width: 10px;">No.</th>
					<th class="text-center" colspan="2">Soal</th>
					<th class="text-center" >Operasi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$x = 1;
					foreach($datasoal as $soal){
						?>
						<tr class="wrapper-soal-<?php echo $soal->id_intro_soal;?>">
							<td class="text-center"><?php echo $x;?></td>
							<td colspan="2" id="td-intro-<?php echo $soal->id_intro_soal;?>">
								<p><strong>Pendahuluan:</strong></p>
								<?php echo $soal->intro_soal;?>
							</td>
							<td class="text-center">
								<button type="button" class="btn btn-sm btn-warning edit-intro" data-toggle="modal" data-target="#modaledit" id="edit-intro-<?php echo $soal->id_intro_soal;?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
										
								<button id="hapus-intro-<?php echo $soal->id_intro_soal;?>" class="btn btn-sm btn-danger hapus-intro"><i class="fa fa-remove" aria-hidden="true"></i></button>
								
								<button type="button" class="btn btn-sm btn-success tambah-tanya" data-toggle="modal" data-target="#modaledit" id="tambah-tanya-<?php echo $soal->id_intro_soal;?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
							</td>
						</tr>
						<tr class="wrapper-soal-<?php echo $soal->id_intro_soal;?>">
							<td></td>
							<td class='text-center'>
								<strong>Pertanyaan</strong>
							</td>
							<td class='text-center'>
								<strong>Jawaban</strong>
							</td>
							<td class='text-center'>
								<strong>Operasi</strong>
							</td>
						</tr>
						<?php
						$caripertanyaan = $this->model_psep->fetch_soal_by_intro($soal->id_intro_soal);
						?>
						<?php
						foreach($caripertanyaan as $soal){
							?>
						<tr class="wrapper-soal-<?php echo $soal->id_intro_soal;?> wrapper-pertanyaan-<?php echo $soal->id_soal_eksak;?>">
							<td></td>
							<td id="pertanyaan-<?php echo $soal->id_soal_eksak;?>"><?php echo $soal->pertanyaan;?></td>
							<td class="text-center" id="jawaban-<?php echo $soal->id_soal_eksak;?>">
								<?php echo $soal->jawaban;?>
							</td>
							<td class="text-center">
							
								<button class="btn btn-sm btn-warning edit-tanya" data-toggle="modal" data-target="#modaledit" id="edit-intro-<?php echo $soal->id_soal_eksak;?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
								
								<button class="btn btn-sm btn-danger hapus-soal" id="soal-eksak-<?php echo $soal->id_soal_eksak;?>"><i class="fa fa-remove" aria-hidden="true"></i></button>
								
							</td>
						</tr>
						<?php
						}
						?>
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
	$(".edit-intro").click(function(){
		rawid 	= $(this).attr('id');
		idsplit = rawid.split("-");
		idintro = idsplit[2];
		//alert(rawid);
		$("#konten-edit").load("../ajax_edit_intro/" + idintro);
	});
	
	$(".hapus-intro").click(function(){
		rawid 	= $(this).attr('id');
		idsplit = rawid.split("-");
		idintro = idsplit[2];
		//alert(rawid);
		if(confirm("Apakah anda yakin untuk menghapus soal? ")){
			$.ajax({
				type: 'POST',
				url: '../ajax_hapus_soal_eksak',
				data:{
					'idintrosoal' 	: idintro
				}
			});
		}
	});
	
	$(".hapus-soal").click(function(){
		rawid 	= $(this).attr('id');
		idsplit = rawid.split("-");
		idsoal = idsplit[2];
		//alert(rawid);
		if(confirm("Apakah anda yakin untuk menghapus soal? ")){
			$.ajax({
				type: 'POST',
				url: '../ajax_hapus_pertanyaan_eksak',
				data:{
					'idsoal' 	: idsoal
				}
			});
		}
	});
	
	$(".tambah-tanya").click(function(){
		rawid 	= $(this).attr('id');
		idsplit = rawid.split("-");
		idsoal = idsplit[2];
		$("#konten-edit").load("../ajax_tambah_pertanyaan_eksak/" + idsoal + "/" + <?php echo $idpr;?>);
	});
	
	$(".edit-tanya").click(function(){
		rawid 	= $(this).attr('id');
		idsplit = rawid.split("-");
		idintro = idsplit[2];
		$("#konten-edit").load("../ajax_edit_pertanyaan_eksak/" + idintro + "/" + <?php echo $idpr;?>);
	});
	
	$(document).ajaxSend(function(event, jqxhr, settings){
		console.log(settings.url);
		alamat 		= settings.url;
		urledit		= alamat.substring(0, 18);
		urltambah	= alamat.substring(0, 31);
		//console.log(urlpasti);
		if(urledit === "../ajax_edit_intro"){
			$('#text-load').html('memuat soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "../ajax_hapus_soal_eksak"){
			$('#text-load').html('menghapus soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "../ajax_hapus_pertanyaan_eksak"){
			$('#text-load').html('menghapus soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(urltambah === "../ajax_tambah_pertanyaan_eksak/"){
			$('#text-load').html('memuat editor soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		console.log(options.url);
		alamat 		= options.url;
		urledit		= alamat.substring(0, 18);
		urltambah	= alamat.substring(0, 31);
		//console.log(urlpasti);
		if(urledit === "../ajax_edit_intro"){
			$('#modal-loader').modal('hide');
		}
		if(options.url === "../ajax_hapus_soal_eksak"){
			$('#modal-loader').modal('hide');
			idmentah = options.data;
			idsplit = idmentah.split("=");
			idsoal = idsplit[1];
			console.log(idsoal);
			$(".wrapper-soal-" + idsoal).remove();
		}
		if(options.url === "../ajax_hapus_pertanyaan_eksak"){
			$('#modal-loader').modal('hide');
			idmentah = options.data;
			idsplit = idmentah.split("=");
			idsoal = idsplit[1];
			console.log(idsoal);
			$(".wrapper-pertanyaan-" + idsoal).remove();
		}
		if(urltambah === "../ajax_tambah_pertanyaan_eksak/"){
			$('#modal-loader').modal('hide');
		}
	});
	$(document).ajaxError(function(event, request, options){
		console.log(options.url);
		alamat 		= options.url;
		urledit		= alamat.substring(0, 18);
		urltambah	= alamat.substring(0, 31);
		//console.log(urlpasti);
		if(urledit === "../ajax_edit_intro"){
			console.log(urlpasti);
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
			$('#modaledit').modal('hide');
		}
		if(options.url === "../ajax_hapus_soal_eksak"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(options.url === "../ajax_hapus_pertanyaan_eksak"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(urltambah === "../ajax_tambah_pertanyaan_eksak/"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
			$('#modaledit').modal('hide');
		}
	})
});
</script>