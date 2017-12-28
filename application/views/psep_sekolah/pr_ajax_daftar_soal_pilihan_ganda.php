<div class="row">
<div class="col-md-12" style="height: 600px; overflow-y: scroll;">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th style="width: 10px;">No.</th>
				<th>Soal</th>
				<th>Kunci Jawaban</th>
				<th>Operasi</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$x = 1;
				foreach($datasoal as $soal){
					?>
					<tr id="soal-<?php echo $soal->id_soal_pr;?>">
						<td><?php echo $x;?></td>
						<td>
							<div class="panel panel-default">
								<div class="panel-body">
									<?php echo $soal->pertanyaan;?>
								
									<div class="col-md-12">
										Pilihan Jawaban : 
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
						</td>
						<td>
							<?php echo $soal->kunci;?>
						</td>
						<td class="text-center">
							<button id="<?php echo $x;?>-<?php echo $soal->id_soal_pr;?>" class="btn btn-sm btn-danger hapus-soal-pr"><i class="fa fa-times" aria-hidden="true"></i></button>
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
$(document).ready(function(){
	$(".hapus-soal-pr").click(function(){
		//alert(e.target.id);
		rawid 	= $(this).attr('id');
		splitid	= rawid.split("-");
		idsoal	= splitid[1];
		nosoal	= splitid[0];
		//alert(idsoal);
		if(confirm("Apakah anda yakin untuk menghapus soal No. " + nosoal)){
			$.ajax({
				type	: 'POST',
				url		: '../hapus_soal_pilihan_ganda',
				data	: {
					'idsoal'	: idsoal
				}
			})
		}
	})
	
	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "../hapus_soal_pilihan_ganda"){
			$('#text-load').html('Menghapus Soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "../hapus_soal_pilihan_ganda"){
			$('#modal-loader').modal('hide');
			//console.log(request.responseText);
			$("#" + request.responseText).remove();
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "../hapus_soal_pilihan_ganda"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
})
</script>