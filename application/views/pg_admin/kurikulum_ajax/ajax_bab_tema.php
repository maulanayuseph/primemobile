<div class="row">
	<div class="col-sm-4 text-center">
		BAB
	</div>
	<div class="col-sm-4 text-center">
		TEMA
	</div>
	<div class="col-sm-4 text-center">
		EDIT TEMA BAB
	</div>
</div>
<div class="panel-group" id="accordionbabtema" role="tablist" aria-multiselectable="true">
	<?php
		$x = 1;
		foreach($datamapok as $mapok){
		?>
		<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingOne">
		    	<div class="row">
		    		<div class="col-sm-4">
		    			<h4 class="panel-title">
					        <a role="button" data-toggle="collapse" data-parent="#accordionbabtema" href="#collapse<?php echo $mapok->id_materi_pokok;?>" aria-expanded="true" aria-controls="collapse<?php echo $mapok->id_materi_pokok;?>">
					          <?php echo $mapok->nama_materi_pokok;?>
					        </a>
					      </h4>
		    		</div>
		    		<div class="col-sm-4 text-center">
		    			<?php
		    				if($mapok->id_tema !== "0"){
		    					$tema = $this->model_kurikulum->fetch_tema_by_id($mapok->id_tema);
		    					echo $tema->tema;
		    				}else{
		    					echo "<strong>-</strong>";
		    				}
		    			?>
		    		</div>
		    		<div class="col-sm-4 text-center">
		    			<button class="btn btn-sm btn-warning edit-bab-tema" id="bab-tema-<?php echo $mapok->id_materi_pokok;?>" data-toggle="modal" data-target="#modal-kurikulum"><i class="fa fa-pencil" aria-hidden="true"></i></button>
		    		</div>
		    	</div>
		      
		    </div>
		    <div id="collapse<?php echo $mapok->id_materi_pokok;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $mapok->id_materi_pokok;?>">
		      <div class="panel-body">
		        <?php
		        	//cari sub bab yang ada di mapok tersebut yang sudah di set ke K-13 revisi
		        	$carisubk13rev = $this->model_kurikulum->fetch_sub_k13rev_by_mapok($mapok->id_materi_pokok);
		        ?>
		        <table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">Sub Bab</th>
							<th class="text-center">Sub Tema</th>
							<th class="text-center">Operasi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$y = 1;
							foreach($carisubk13rev as $sub){
								?>
								<tr>
									<td><?php echo $y;?></td>
									<td>
										<?php
											if($sub->k_13_revisi == 1){
												echo $sub->nama_sub_materi;
											}else{
												?>
												<span style="color:grey;"><?php echo $sub->nama_sub_materi;?></span>
												<?php
											}
										?>
									</td>
									<td class="text-center">
										<?php
										if($sub->id_sub_tema !== "0"){
											$subtema = $this->model_kurikulum->fetch_sub_tema_by_id($sub->id_sub_tema);
											echo "<strong>".$subtema->sub_tema."</strong>";
										}else{
											echo "-";
										}
										?>
									</td>
									<td class="text-center">
										<?php
										if($sub->k_13_revisi == 1){
											?>
											<button class="btn btn-sm btn-warning edit-sub-bab-tema" data-toggle="modal" data-target="#modal-kurikulum" id="edit-sub-bab-tema-<?php echo $sub->id_sub_materi;?>-<?php echo $mapok->id_materi_pokok;?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
											<?php
										}
										?>
									</td>
								</tr>
								<?php
								$y++;
							};
						?>
					</tbody>
		        </table>
		      </div>
		    </div>
		</div>
		<?php
		$x++;
		}
	?>
</div>

<script type="text/javascript">
$(function(){
	$(".edit-bab-tema").click(function(){
		rawid   	= $(this).attr("id");
	    idsplit 	= rawid.split("-");
	    idmapok  	= idsplit[2];
	   	$("#konten-modal-ajax").load("kurikulum/edit_tema_bab/" + idmapok + "/" + $("#kelas-tema-bab").val());
	})
	$(".edit-sub-bab-tema").click(function(){
		rawid   	= $(this).attr("id");
	    idsplit 	= rawid.split("-");
	    idsub  		= idsplit[4];
	    idmapok 	= idsplit[5];
	    $("#konten-modal-ajax").load("kurikulum/edit_sub_bab_tema/" + idsub + "/" + idmapok);
	})

})
</script>