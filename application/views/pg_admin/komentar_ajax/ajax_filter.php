<table class="display table table-responsive table-bordered table-striped" id="datatable">
	<thead>
		<tr>
			<th style="width: 10px;">#</th>
			<th class="text-center">Komentar</th>
			<th class="text-center">Aksi</th>
			<th>Diperiksa Oleh</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($datakomentar as $komentar){
				if($komentar->tipe_komentar == "salah"){
					$tipe = "<span style='color: red'>Melaporkan kesalahan soal</span>";
				}elseif($komentar->tipe_komentar == "suka"){
					$tipe = "<span style='color: green'>Soal favorit</span>";
				}elseif($komentar->tipe_komentar == "jelas"){
					$tipe = "<span style='color: yellow'>Membutuhkan penjelasan soal</span>";
				}
				?>
				<tr>
					<td class="text-center"><?php echo $x;?></td>
					<td>
						<i><strong><?php echo $komentar->nama_siswa;?> (<?php echo $komentar->nama_sekolah;?>)</strong> - <?php echo $komentar->waktu_komen;?></i> <br><?php echo $tipe;?>
						<br><?php echo $komentar->alias_kelas;?> <?php echo $komentar->nama_mapel;?> : <?php echo $komentar->nama_materi_pokok;?> - <?php echo $komentar->nama_sub_materi;?>
						<p>&nbsp;
						<p><?php echo $komentar->komentar;?>
					</td>
					<td class="text-center">
						<button class='btn btn-sm btn-danger lihat-soal' id="lihat-<?php echo $komentar->id_komentar_soal;?>" data-toggle="modal" data-target="#modal-komentar"><i class="fa fa-eye" aria-hidden="true"></i></button> 

						<a href="<?php echo base_url('pg_admin/latihansoal/manajemen/ubah_soal?id=' . $komentar->id_soal);?>" target="_BLANK" class="btn btn-sm btn-danger"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						
						<?php
							if($komentar->tipe_komentar == 'salah'){
								if($komentar->status_komentar == 0){
									?>
									<button class='btn btn-sm btn-danger check-komentar' id="tanda-<?php echo $komentar->id_komentar_soal;?>"><i class="fa fa-flag" aria-hidden="true"></i></button> 
									<?php
								}else{
									?>
									<button class='btn btn-sm btn-success uncheck-komentar' id="tanda-<?php echo $komentar->id_komentar_soal;?>" disabled><i class="fa fa-flag" aria-hidden="true"></i></button> 
									<?php
								}
							}
						?>
					</td>
					<td class="text-center" id="td-checked-by-<?php echo $komentar->id_komentar_soal;?>">
						<?php
							//echo $komentar->checked_by;
							if($komentar->tipe_komentar == 'salah'){
								if($komentar->checked_by !== '0'){
									$admin = $this->model_komentar_soal->fetch_admin_by_id($komentar->checked_by);
									echo $admin->username;
								}else{
									echo "-";
								}
							}	
						?>
					</td>
				</tr>
				<?php
				$x++;
			}
		?>
	</tbody>
</table>

<script>
$(document).ready(function(){
	$('table.display').DataTable();

	$('#datatable').on( 'click', '.lihat-soal', function () {
		rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idkomentar 	= idsplit[1];

		$("#konten-modal-komentar").load("komentar/view_soal/" + idkomentar);
	})
	$('#datatable').on( 'click', '.check-komentar', function () {
		rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idkomentar 	= idsplit[1];
		$.ajax({
			type: 'POST',
			url: 'komentar/check_komentar',
			data:{
				'idkomentar'	: idkomentar
			}
		})
	});
	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "komentar/check_komentar"){
			$('#modal-loader').modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "komentar/check_komentar"){
			$('#modal-loader').modal('hide');
			//alert(request.responseText);
			obj = JSON.parse(request.responseText);
			$("#tanda-" + obj['idkomentar']).removeClass('btn-danger');
			$("#tanda-" + obj['idkomentar']).addClass('btn-success');
			$("#tanda-" + obj['idkomentar']).prop("disabled",true);
			$("#td-checked-by-" + obj['idkomentar']).html(obj['username']);
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "komentar/check_komentar"){
			$('#modal-loader').modal('hide');
			$("#modal").modal('show');
		}
	});
});
</script>