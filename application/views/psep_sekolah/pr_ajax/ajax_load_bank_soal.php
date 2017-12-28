<?php
$x = 1;
	foreach($datasoal as $data){
	?>
		<tr>
			<td><?php echo $x;?></td>
			<td>
				<div class="panel panel-default">
					<div class="panel-body">
						<?php echo $data->pertanyaan;?>
						<div class="col-md-12">
							Pilihan Jawaban : 
						</div>
						<div class="col-md-6">
							A. <?php echo $data->jawab_1;?>
						</div>
						<div class="col-md-6">
							B. <?php echo $data->jawab_2;?>
						</div>
						<div class="col-md-12">
							&nbsp;
						</div>
						<div class="col-md-6">
							C. <?php echo $data->jawab_3;?>
						</div>
						<div class="col-md-6">
							D. <?php echo $data->jawab_4;?>
						</div>
						<div class="col-md-6">
							E. <?php echo $data->jawab_5;?>
						</div>
					</div>
				</div>
			</td>
			<td>
				<?php
					echo $data->kunci;
				?>
			</td>
			<td class="text-center">
				<button class="btn btn-sm btn-primary btn-insert" id="<?php echo $idpr;?>-<?php echo $data->id_banksoal;?>">Insert</button>
			</td>
		</tr>
	<?php
		$x++;
	}
	?>
	<tr>
		<td colspan="4" style="text-align: right;"><input type="submit" value="Tambah" class="btn btn-primary"/></td>
	</td>
	<?php
?>
<script>
$(document).ready(function(){
	$(".btn-insert").click(function(){
		//alert(e.target.id);
		rawid 	= $(this).attr('id');
		idsplit	= rawid.split("-");
		idpr	= idsplit[0];
		idsoal	= idsplit[1];
		sumber	= 2;
		$.ajax({
			type	: 'POST',
			url		: '../proses_tambah_soal_pilihan_ganda',
			data	: {
				'idpr'		: idpr,
				'idsoal'	: idsoal,
				'sumber'	: sumber
			}
		})
	})
	
	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "../proses_tambah_soal_pilihan_ganda"){
			$('#text-load').html('Menambahkan Soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "../proses_tambah_soal_pilihan_ganda"){
			//$('#modal-loader').modal('hide');
			//$('#modal-soal').appendTo("body").modal('show');
			$("#soal").load("../ajax_daftar_soal/" + <?php echo $idpr;?>);
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "../ajax_soal_by_latihan"){
			console.log(urlpasti);
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
			//$('#modal-soal').appendTo("body").modal('show');
		}
	})
})
</script>