<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="page-title">
      <div class="title_left">
        <h3>Editor Materi</h3>
      </div>
    </div>
		
		<form method="post" enctype='multipart/form-data' action="<?php echo $formaction;?>">
			<div class="row">
				
				<!-- left col untuk input soal -->
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<div class="panel panel-default">
 						<div class="panel-body">
 							<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
	 							<div class="row x_title">
	 								<input type="text" name="judul" class="form-control" placeholder="Judul Latihan Soal..." required>
	 							</div>
	 							<strong>Soal : </strong>
	 							<textarea class="form-control tinymce_textarea" name="soal"></textarea>
	 							<hr>
	 						</div>
	 						<div class='col-xs-12 col-sm-8 col-md-8 col-lg-8'>
	 							<strong>Indikator :</strong>
	 							<select class="form-control" id="select-indikator">
	 								
	 							</select>
	 						</div>
	 						<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
	 						</div>
	 						<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
	 							<hr>
	 							<strong>Pilihan Jawaban : </strong>
	 							<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#jawab1" aria-controls="jawab1" role="tab" data-toggle="tab">Jawaban A</a></li>
									<li role="presentation"><a href="#jawab2" aria-controls="jawab2" role="tab" data-toggle="tab">Jawaban B</a></li>
									<li role="presentation"><a href="#jawab3" aria-controls="jawab3" role="tab" data-toggle="tab">Jawaban C</a></li>
									<li role="presentation"><a href="#jawab4" aria-controls="jawab4" role="tab" data-toggle="tab">Jawaban D</a></li>
									<li role="presentation"><a href="#jawab5" aria-controls="jawab5" role="tab" data-toggle="tab">Jawaban E</a></li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="jawab1">
										<textarea class="form-control tinymce_textarea" name="jawab1"></textarea>
									</div>
									<div role="tabpanel" class="tab-pane" id="jawab2">
										<textarea class="form-control tinymce_textarea" name="jawab2"></textarea>
									</div>
									<div role="tabpanel" class="tab-pane" id="jawab3">
										<textarea class="form-control tinymce_textarea" name="jawab3"></textarea>
									</div>
									<div role="tabpanel" class="tab-pane" id="jawab4">
										<textarea class="form-control tinymce_textarea" name="jawab4"></textarea>
									</div>
									<div role="tabpanel" class="tab-pane" id="jawab5">
										<textarea class="form-control tinymce_textarea" name="jawab5"></textarea>
									</div>
								</div>
								<hr>
							</div>
							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
								<strong>Kunci Jawaban :</strong>
								<select class="form-control" name="kunci">
									<option value="1">Jawaban A</option>
									<option value="2">Jawaban B</option>
									<option value="3">Jawaban C</option>
									<option value="4">Jawaban D</option>
									<option value="5">Jawaban E</option>
								</select>
							</div>
							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
								<strong>Bobot Soal :</strong>
								<select class="form-control" name="bobot">
									<option value="1">Mudah</option>
									<option value="2">Sedang</option>
									<option value="3">Sulit</option>
								</select>
							</div>
							<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
								<hr>
								<strong>Pembahasan : </strong>
								<textarea class="form-control tinymce_textarea" name="pembahasan"></textarea>
								<hr>
							</div>
							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
								<strong>Video Pembahasan : </strong>
								<button class="btn btn-primary">Pilih Video</button>
								<div id="video-preview">
									No Video Preview Available
								</div>
								<input type="text" id="selected-group">
							</div>
							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6' id="grouping">
								<strong>Group Soal : </strong>
								<div class="col-xs-12" style="height: 400px; overflow: scroll;">
									<?php
										foreach($parentgroup as $group){
											?>
											<div><input type="checkbox" name="group" class="check-group" id="gcheck-<?php echo $group->id_group;?>">
											<?php
											//cek apakah punya child
											$jumlahchild = $this->adm_konten_model->hitung_child_group($group->id_group);
											if($jumlahchild > 0){
												?>
												<a href="javascript:void(0)" class="expand-group" id="group-<?php echo $group->id_group;?>"><span id="gnama-<?php echo $group->id_group;?>"><?php echo $group->group;?></span></a>
												<div id="expanded-<?php echo $group->id_group;?>" style="padding-left: 10px; display: none;"></div>
												<?php
											}else{
												?>
												<span id="gnama-<?php echo $group->id_group;?>"><?php echo $group->group;?></span>
												<?php
											}
											?>
											</div>
											<?php
										}
									?>
								</div>
							</div>
 						</div>
 					</div>
				</div>
				<!-- end left col input soal -->
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<div class="panel panel-default">
 						<div class="panel-body">
 							<table class="table">
 								<tr>
 									<td><strong>Kelas</strong></td>
									<td>:</td>
									<td><?php echo $datakur->alias_kelas;?> - <?php echo $datakur->nama_kurikulum;?></td>
 								</tr>
 								<tr>
 									<td><strong>Mata Pelajaran</strong></td>
									<td>:</td>
									<td><?php echo $datakur->nama_mapel;?></td>
 								</tr>
 								<tr>
 									<td><strong>Bab</strong></td>
									<td>:</td>
									<td><?php echo $datakur->nama_bab;?></td>
 								</tr>
 								<tr>
 									<td><strong>Sub Bab</strong></td>
									<td>:</td>
									<td><?php echo $datakur->nama_sub_bab;?></td>
 								</tr>
 								<tr>
 									<td><strong>Author</strong></td>
 									<td>:</td>
 									<td><i><?php echo $dataadmin->nama;?> (<?php echo $dataadmin->username;?>)</i></td>
 								</tr>
 								<tr>
 									<td colspan="3"><input type="submit" name="simpan" class="btn btn-primary" value="Simpan" style="width: 100%;">
									<input type="hidden" name="key" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<input type="hidden" name="idkursub" value="<?php echo $datakur->id_kurikulum_x_sub_bab; ?>">
									<input type="hidden" name="idjudul" value="<?php echo isset($materi->id_judul) ? $materi->id_judul : '';?>">
 									</td>
 								</tr>
 							</table>
 						</div>
 					</div>
 				</div>

			</div>
		</form>

  </div>
</div>
<!-- /page content -->

<form method="post" enctype='multipart/form-data' id="frmupload">
	<input type="hidden" name="key" value="<?php echo $this->security->get_csrf_hash(); ?>">
	<input name="filegambar" type="file" id="filegambar" onchange="" style="display:none;">
</form>