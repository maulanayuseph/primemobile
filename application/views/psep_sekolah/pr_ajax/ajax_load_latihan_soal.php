<?php
$x=1;
foreach($datasoal as $soal){
	?>
	<tr>
		<td style="vertical-align: top;">
			<?php echo $x;?>
		</td>
		<td>
			<div class="panel panel-default">
				<div class="panel-body">
					<?php echo $soal->isi_soal;?>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-12">
						<strong>Pilihan Jawaban : </strong>
					</div>
					<div class="col-md-6">
						A. <?php echo $soal->jawab_1;?>
					</div>
					<div class="col-md-6">
						B. <?php echo $soal->jawab_2;?>
					</div>
					<div class="col-md-12">
						&nbsp;
					</div>
					<div class="col-md-6">
						C. <?php echo $soal->jawab_3;?>
					</div>
					<div class="col-md-6">
						D. <?php echo $soal->jawab_4;?>
					</div>
					<div class="col-md-6">
						E. <?php echo $soal->jawab_5;?>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-12">
						<strong>Pembahasan : </strong>
					</div>
					<div class="col-md-12">
						<?php echo $soal->pembahasan;?>
					</div>
				</div>
			</div>
		</td>
		<td class="text-center">
			<?php
			if($soal->kunci_jawaban == 1){
				?>
				<strong>A</strong>
				<?php
			}elseif($soal->kunci_jawaban == 2){
				?>
				<strong>B</strong>
				<?php
			}elseif($soal->kunci_jawaban == 3){
				?>
				<strong>C</strong>
				<?php
			}elseif($soal->kunci_jawaban == 4){
				?>
				<strong>D</strong>
				<?php
			}elseif($soal->kunci_jawaban == 5){
				?>
				<strong>E</strong>
				<?php
			}
			?>
		</td>
		<td class="text-center">
			<button class="btn btn-sm btn-primary btn-insert" id="<?php echo $idpr;?>-<?php echo $soal->id_soal;?>">Insert</button>
		</td>
	</tr>
	<?php
	$x++;
}
?>
<script>
$(document).ready(function(){
	$(".btn-insert").click(function(){
		//alert(e.target.id);
		rawid 	= $(this).attr('id');
		idsplit	= rawid.split("-");
		idpr	= idsplit[0];
		idsoal	= idsplit[1];
		sumber	= 1;
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