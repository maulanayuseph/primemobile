<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php include "html_header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Manajemen Atribut</h4>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-4">
						<strong>Tambahkan Atribut Baru</strong>
						<br>
						<br>
						Nama Atribut
						<br><input type="text" class="form-control" id="atribut" />
						<br>
						<br>
						Induk Atribut
						<br>
						<select class="form-control" id="parent">
							<option value="0">None</option>
							<?php
								foreach($parentatribut as $parent){
									?>
									<option value="<?php echo $parent->id_atribut;?>"><?php echo$parent->atribut;?></option>
									<?php
								}
							?>
						</select>
						<i>Atribut memiliki hierarki. Contoh : anda dapat menambahkan atribut Ujian Nasional 2015 dan Ujian Nasional 2016 yang berinduk di Ujian Nasional. Pilih none jika anda memilih atribut ini sebagai induk</i>
						
						<br>
						<br>
						<button class="btn btn-sm btn-primary" style="width: 100%;" id="tambahatribut">Tambah Atribut</button>
					</div>
					<div class="col-sm-8" id="list-atribut">
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
												//fetch jumlah soal per atribut 
												$count = $this->model_atribut->hitung_soal_by_atribut($parent->id_atribut);
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
														<?php echo $count;?>
														</a>
													</td>
												</tr>
												<?php
												$fetchchild = $this->model_atribut->fetch_child($parent->id_atribut);
												
												foreach($fetchchild as $child){
													$countchild = $this->model_atribut->hitung_soal_by_atribut($parent->id_atribut);
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
															<?php echo $countchild?>
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
					</div>
				</div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->
    <?php include "footer.php"; ?>

  </div>
</div>

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-loader" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk loading ajax -->
<div class="modal fade" id="modal-loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="<?php echo base_url("assets/img/rolling.gif");?>"/>
		<p> Harap Tunggu, Sedang Proses :)
      </div>
    </div>
  </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<!--<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script> -->

<!-- Bootstrap Switch Plugin -->
<script src="<?php echo base_url('assets/js/plugins/bootstrap-switch/bootstrap-switch.min.js');?>"></script>

<!-- Progress -->
<script src="<?= base_url('assets/js/nprogress.js')?>" ></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<script>
$(document).ready(function(){
	$("#checkall").click(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});
	$("#tambahatribut").click(function(){
		//$("#mapel").load("banksoal/ajax_mapel/" + $("#kelas").val());
		atribut 	= $("#atribut").val();
		parent 		= $("#parent").val();
		$.ajax({
			type: 'POST',
			url: 'atribut/simpan_atribut',
			data:{
				'atribut' 	: atribut,
				'parent'	: parent
			}
		});
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
</html>
