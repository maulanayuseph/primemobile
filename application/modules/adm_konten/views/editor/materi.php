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
				
				<!-- left col untuk input materi -->
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<div class="panel panel-default">
 						<div class="panel-body">
 							<div class="row x_title">
 								<input type="text" name="judul" class="form-control" placeholder="Judul Materi..." value="<?php echo isset($materi->judul) ? $materi->judul : '';?>"required>
 							</div>
 							<textarea class="form-control tinymce_textarea" name="materi"><?php echo isset($materi->isi_materi) ? html_entity_decode($materi->isi_materi) : '';?></textarea>
 							<?php
 								if($dataadmin == null){
 									?>
 									<small>Author : <i><?php echo $author->nama;?> (<?php echo $author->username;?>)</i></small>
 									<?php
 								}else{
 									?>
 									<small>Author : <i><?php echo $dataadmin->nama;?> (<?php echo $dataadmin->username;?>)</i></small>
 									<?php
 								}
 							?>
 							<?php
 								if(isset($materi)){
 									?>
 									<select class="form-control" required>
 										<option value="">-- Piih Status Materi --</option>
 										<?php
 											if($this->session->userdata('admlevel') == "editor" or $this->session->userdata('admlevel') == "author" or $this->session->userdata('admlevel') == "qc" or $this->session->userdata('admlevel') == "adminqc" ){
 												?>
												<option value="0">Menunggu Approval</option>
 												<?php
 											}
 										?>
 									</select>
 									<?php
 								}
 							?>
 						</div>
 					</div>
				</div>
				<!-- end left col input materi -->
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