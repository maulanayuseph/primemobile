<div class="table-responsive">
  <table id="" class="table table-striped table-hover display">
	<thead>
	  <tr>
		<th style="width: 20px;" class="text-center">No. </th>
		<th class="text-center">Kelas</th>
		<th class="text-center">Tahun Ajaran</th>
		<th class="text-center">Akses Kelas</th>
		<th class="text-center">Akses Pengerjaan</th>
		<th class="text-center">Akses Pembahasan</th>
		<th class="text-center">Set Jadwal</th>
	  </tr>
	</thead>
	<tbody>
	  <?php
		$x = 1;
		foreach($kelasparalel as $kelas){
			$cekstatus = $this->model_psep->fetch_config_pr_by_kelas_and_tahun($idpr, $kelas->id_kelas_paralel, $tahunajaran->id_tahun_ajaran);
			if(isset($cekstatus)){
				if($cekstatus->lihat == 1){
					$statuslihat = "checked";
				}else{
					$statuslihat = "";
				}
				if($cekstatus->akses == 1){
					$statusakses = "checked";
				}else{
					$statusakses = "";
				}
				if($cekstatus->bahas == 1){
					$statusbahas = "checked";
				}else{
					$statusbahas = "";
				}
			}else{
				$statuslihat = "";
				$statusakses = "";
				$statusbahas = "";
			}
			
			?>
			<tr>
				<td><?php echo $x;?></td>
				<td>
					<?php echo $kelas->kelas_paralel;?>
				</td>
				<td>
					<?php echo $tahunajaran->tahun_ajaran;?>
				</td>
				<td class="text-center">
					<input type="checkbox" id="lihat-<?php echo $idpr;?>-<?php echo $kelas->id_kelas_paralel . "-" . $tahunajaran->id_tahun_ajaran;?>" class="set" <?php echo $statuslihat;?>/>

					
				</td>
				<td class="text-center">
					<!--
					<input type="checkbox" id="akses-<?php echo $idpr;?>-<?php echo $kelas->id_kelas_paralel . "-" . $tahunajaran->id_tahun_ajaran;?>" class="set" <?php echo $statusakses;?>/>
					-->
					<?php
					if($cekstatus !== null){
						if($statuslihat == "checked"){
							if($cekstatus->akses_start == "0000-00-00 00:00:00"){
								echo "Not Set";
							}else{
								echo $cekstatus->akses_start;
								echo "<br>-";
								echo "<br>" . $cekstatus->akses_end;
							}
						}else{
							echo "Not Set";
						}
					}else{
						echo "Not Set";
					}
					?>
				</td>
				<td class="text-center">
					<!--
					<input type="checkbox" id="bahas-<?php echo $idpr;?>-<?php echo $kelas->id_kelas_paralel . "-" . $tahunajaran->id_tahun_ajaran;?>"  class="set" <?php echo $statusbahas;?>/>
					-->
					<?php
					if($cekstatus !== null){
						if($statuslihat == "checked"){
							if($cekstatus->bahas_start == "0000-00-00 00:00:00"){
								echo "Not Set";
							}else{
								echo $cekstatus->bahas_start;
							}
						}else{
							echo "Not Set";
						}
					}else{
						echo "Not Set";
					}
					?>
				</td>
				<td class="text-center">
					<?php
						if($statuslihat == "checked"){
							?>
							<button class="btn btn-sm btn-danger set-jadwal" data-toggle="modal" data-target="#modaledit" id="jadwal-<?php echo $cekstatus->id_config_pr;?>">Set Jadwal</button>
							<?php
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
</div>

<script>
$(function(){
	$(".set-jadwal").click(function(){
		rawid		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idconfig 	= idsplit[1];

		$("#konten-edit").load("../ajax_set_jadwal/" + idconfig);
	})
	$(".set").click(function(){
		rawid 	= $(this).attr('id');
		idsplit 		= rawid.split("-");
		action 			= idsplit[0];
		idpr 			= idsplit[1];
		kelasparalel	= idsplit[2];
		tahunajaran		= idsplit[3];
		
		console.log("action : " + action + " idpr : " + idpr + " Kelas : " + kelasparalel + " Tahun ajaran : " + tahunajaran);
		
		if(document.getElementById(rawid).checked) {
			//console.log("set");
			operasi = "set";
		} else {
			//console.log("unset");
			operasi = "unset"
		}
		
		$.ajax({
			type: 'POST',
			url: '../set_assignment',
			data:{
				'action' 		: action,
				'idpr'			: idpr,
				'kelasparalel'	: kelasparalel,
				'tahunajaran'	: tahunajaran,
				'operasi'		: operasi,
				'rawid'			: rawid
			}
		});
	});
	
	$(document).ajaxSend(function(event, jqxhr, settings){
		//console.log(settings.url);
		alamat 		= settings.url;
		urleditjadwal	= alamat.substring(0, 18);

		if(settings.url === "../set_assignment"){
			//console.log(request.responseText);
			$('#text-load').html('memproses penugasan');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "../set_assignment"){
			$('#text-load').html('memuat editor jadwal');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(urleditjadwal === "../ajax_set_jadwal"){
			$('#text-load').html('Memuat editor jadwal');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 			= options.url;
		urleditjadwal	= alamat.substring(0, 18);
		if(options.url === "../set_assignment"){
			//console.log(request.responseText);
			if(request.responseText === "sukses"){
				console.log(request.responseText);
			}else if(request.responseText === "gagal"){
				datapost 	= options.data;
				datarawid	= datapost.split("&");
				datarawid1	= datarawid[5].split("=");
				idcek		= datarawid1[1];
				if(document.getElementById(idcek).checked) {
					//console.log("set");
					//operasi = "set";
					$('#' + idcek).attr('checked', false);

				} else {
					//console.log("unset");
					//operasi = "unset"
					$('#' + idcek).attr('checked', true);
				}
			}
			//$('#modal-loader').modal('hide');
		}
		if(urleditjadwal === "../ajax_set_jadwal"){
			$('#modal-loader').modal('hide');
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 			= options.url;
		urleditjadwal	= alamat.substring(0, 18);
		//console.log("gagal " + options.url);
		//console.log("gagal " + options.data);
		if(options.url === "../set_assignment"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
			datapost 	= options.data;
			datarawid	= datapost.split("&");
			datarawid1	= datarawid[5].split("=");
			idcek		= datarawid1[1];
			//console.log(idcek);
			if(document.getElementById(idcek).checked) {
				//console.log("set");
				//operasi = "set";
				$('#' + idcek).attr('checked', false);
			} else {
				//console.log("unset");
				//operasi = "unset"
				$('#' + idcek).attr('checked', true);
			}
		}
		if(urleditjadwal === "../ajax_set_jadwal"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
			$('#modaledit').modal('hide');
		}
	})
});
</script>