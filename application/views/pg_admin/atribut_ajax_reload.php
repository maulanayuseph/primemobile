<form method="post" action="<?php echo base_url("pg_admin/atribut/bulk");?>">
							<div class="col-sm-4">
								<select name="bulk" class="form-control">
									<option value="none">Bulk Action</option>
									<option value="delete">Hapus</option>
								</select>
							</div>
							<div class="col-sm-4">
								<input type="submit" value="Apply" class="btn btn-primary"/>
							</div>
							<div class="col-sm-4" style="text-align: right;">
								<?php echo $jumlahatribut;?> Atribut
							</div>
							<div class="col-sm-12" style="height: 300px; overflow-x: scroll;">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th class="text-center" style="width: 10px;"><input type="checkbox" id="checkall"></th>
											<th class="text-center" colspan="2">Atribut</th>
											<th class="text-center" style="width: 20px;">Count</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach($parentatribut as $parent){
												?>
												<tr id="tr-<?php echo $parent->id_atribut;?>">
													<td class="text-center">
														<input type="checkbox" name="checkatr[<?php echo $parent->id_atribut;?>]" value="<?php echo $parent->id_atribut;?>">
													</td>
													<td>
														<strong><?php echo $parent->atribut;?></strong>
													</td>
													<td class="text-center">
														<a class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/atribut/edit/" . $parent->id_atribut);?>">
															<i class="fa fa-pencil" aria-hidden="true"></i>
														</a>
														<button type="button" class="btn btn-sm btn-danger hapus-atr" id="<?php echo $parent->id_atribut;?>">
															<i class="fa fa-remove" aria-hidden="true"></i>
														</button>
													</td>
													<td class="text-center">
														<a href="<?php echo base_url("pg_admin/atribut/list_soal/" . $parent->id_atribut);?>">
														<?php echo $parent->count;?>
														</a>
													</td>
												</tr>
												<?php
												$fetchchild = $this->model_atribut->fetch_child($parent->id_atribut);
												
												foreach($fetchchild as $child){
													?>
													<tr id="tr-<?php echo $child->id_atribut;?>">
														<td class="text-center">
															<input type="checkbox" name="checkatr[<?php echo $child->id_atribut;?>]]" value="<?php echo $child->id_atribut;?>">
														</td>
														<td>
															- <?php echo $child->atribut;?>
														</td>
														<td class="text-center">
															<a class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/atribut/edit/" . $child->id_atribut);?>">
																<i class="fa fa-pencil" aria-hidden="true"></i>
															</a>
															<button type="button" class="btn btn-sm btn-danger hapus-atr" id="<?php echo $child->id_atribut;?>">
																<i class="fa fa-remove" aria-hidden="true"></i>
															</button>
														</td>
														<td class="text-center">
															<a href="<?php echo base_url("pg_admin/atribut/list_soal/" . $child->id_atribut);?>">
															<?php echo $child->count;?>
															</a>
														</td>
													</tr>
													<?php
												}
											}
										?>
									</tbody>
								</table>
							</div>
							<div class="col-sm-12">
								<i><strong>Note : </strong></i>
								<br><i>Menghapus kategori tidak akan menghapus soal, soal yang hanya terdiri dari satu atribut akan menjadi soal tak beratribut</i>
							</div>
						</form>

<script>
$(document).ready(function(){
	$("#checkall").click(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});
	
	$(".hapus-atr").click(function(e){
		//$("#mapel").load("banksoal/ajax_mapel/" + $("#kelas").val());
		konfirmasi = confirm("Apakah anda yakin untuk menghapus atribut? Atribut yang terhapus tidak dapat dikembalikan lagi");
		console.log(konfirmasi);
		if(konfirmasi == true){
			idatribut 	= e.target.id;
			$.ajax({
				type: 'POST',
				url: 'atribut/hapus_atribut',
				data:{
					'idatribut' : idatribut
				}
			});
		}
	});
	
	$(document).ajaxSend(function(event, jqxhr, settings){
		console.log(settings.url);
		if(settings.url == 'atribut/simpan_atribut'){
			$('#modal-loader').modal('show');
		}
	});
	
	$(document).ajaxSuccess(function(event, request, options){
		$('#modal-loader').modal('hide');
		console.log(options.url);
		if(options.url == "atribut/simpan_atribut"){
			$("#list-atribut").load("atribut/reload_atribut");
			$("#parent").load("atribut/reload_parent");
			$("#atribut").val("");
			//console.log(options.res);
		}if(options.url == "atribut/hapus_atribut"){
			console.log(options.data);
			dataatribut = options.data;
			splitdata = dataatribut.split("=");
			$("#tr-" + splitdata[1]).remove();
		}
	})
});
</script>