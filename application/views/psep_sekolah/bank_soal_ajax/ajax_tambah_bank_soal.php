<div class="row">
	<form action="<?php echo base_url("psep_sekolah/bank_soal/proses_tambah");?>" method="post">
		<div class="col-sm-4">
			<select class="form-control" id="tambah-bank-kelas" required>
				<option value="">-- Pilih Kelas --</option>
				<?php
					foreach($datakelas as $kelas){
						?>
						<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
						<?php
					}
				?>
			</select>
		</div>
		<div class="col-sm-4">
			<select class="form-control" id="tambah-bank-mapel" required>
				<option value="">-- Pilih Mata Pelajaran --</option>
			</select>
		</div>
		<div class="col-sm-4">
			<select class="form-control" id="tambah-bank-tahun" required>
				<option value="">-- Pilih Tahun Ajaran --</option>
				<?php
					foreach($tahunajaran as $tahun){
						?>
						<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
						<?php
					}
				?>
			</select>
		</div>
		<div class="col-sm-4">
			<select class="form-control" id="tambah-bank-bab" required>
				<option value="">-- Pilih Bab --</option>
			</select>
		</div>
		<div class="col-sm-4">
			<select class="form-control" id="tambah-bank-sub" name="idsub" required>
				<option value="">-- Pilih Sub Bab --</option>
			</select>
		</div>

		<div class="col-sm-12">
			&nbsp;
		</div>
		
		<div class="col-sm-12">
			<strong>Soal :</strong>
			<textarea class="tinymce_textarea" name="soal"></textarea>
		</div>

		<div class="col-sm-12">
			&nbsp;
		</div>
	
		<div class="col-sm-4">
			<strong>Kunci Jawaban</strong>
			<select class="form-control" name="kunci" required>
				<option value="">-- Pilih Kunci Jawaban --</option>
				<option value="1">A</option>
				<option value="2">B</option>
				<option value="3">C</option>
				<option value="4">D</option>
				<option value="5">E</option>
			</select>
		</div>

		<div class="col-sm-12">
			&nbsp;
		</div>
		
		<div class="col-sm-12">
			<div>
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#jawab1" aria-controls="jawab2" role="tab" data-toggle="tab">Jawaban A</a></li>
				    <li role="presentation"><a href="#jawab2" aria-controls="#jawab2" role="tab" data-toggle="tab">Jawaban B</a></li>
				    <li role="presentation"><a href="#jawab3" aria-controls="jawab3" role="tab" data-toggle="tab">Jawaban C</a></li>
				    <li role="presentation"><a href="#jawab4" aria-controls="jawab4" role="tab" data-toggle="tab">Jawaban D</a></li>
				    <li role="presentation"><a href="#jawab5" aria-controls="jawab5" role="tab" data-toggle="tab">Jawaban E</a></li>
				</ul>
			</div>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="jawab1">
					<textarea class="tinymce_textarea" name="jawab1"></textarea>
				</div>
				<div role="tabpanel" class="tab-pane" id="jawab2">
					<textarea class="tinymce_textarea" name="jawab2"></textarea>
				</div>
				<div role="tabpanel" class="tab-pane" id="jawab3">
					<textarea class="tinymce_textarea" name="jawab3"></textarea>
				</div>
				<div role="tabpanel" class="tab-pane" id="jawab4">
					<textarea class="tinymce_textarea" name="jawab4"></textarea>
				</div>
				<div role="tabpanel" class="tab-pane" id="jawab5">
					<textarea class="tinymce_textarea" name="jawab5"></textarea>
				</div>
			</div>
		</div>

		<div class="col-sm-12">
			&nbsp;
		</div>
		
		<div class="col-sm-12">
			<strong>Pembahasan :</strong>
			<textarea class="tinymce_textarea" name="pembahasan"></textarea>
		</div>

		<div class="col-sm-12">
			&nbsp;
		</div>

		<div class="col-sm-12" style="text-align: right;">
			<input type="submit" class="btn btn-sm btn-primary" value="Simpan Soal" />
		</div>

		<div class="col-sm-12">
			&nbsp;
		</div>

	</form>
</div>
<script>
$(function(){
	$("#tambah-bank-kelas").change(function(){
		$("#tambah-bank-mapel").load("bank_soal/ajax_mapel/" + $(this).val());
	});
	$("#tambah-bank-mapel").change(function(){
		$("#tambah-bank-bab").load("bank_soal/ajax_bab/" + $(this).val() + "/" + $("#tambah-bank-tahun").val());
	})
	$("#tambah-bank-tahun").change(function(){
		$("#tambah-bank-bab").load("bank_soal/ajax_bab/" + $("#tambah-bank-mapel").val() + "/" + $(this).val());
	})
	$("#tambah-bank-bab").change(function(){
		$("#tambah-bank-sub").load("bank_soal/ajax_sub/" + $(this).val());
	})
})
</script>
<script type="text/javascript">
  tinymce.init({
    selector: '.tinymce_textarea',
    skin: 'lightgray',
    menubar: false,
    plugins: [
        "eqneditor advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor",
        "code fullscreen youtube autoresize"
      ],
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table | fullscreen" ,
    toolbar2: "| fontsizeselect | styleselect | link unlink anchor | eqneditor image media youtube | forecolor backcolor | code | latex",
    extended_valid_elements: "+iframe[src|width|height|name|align|class]",
    image_advtab: true,
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
    relative_urls: false,
    remove_script_host: false,
	
	file_picker_callback: function(callback, value, meta) {
      if (meta.filetype == 'image') {
        $('#filegambar').trigger('click');
        $('#filegambar').on('change', function() {
		  
          var path = "<?php echo base_url('assets/uploads/materi') ?>/";
		  var fileInput = document.getElementById('filegambar');   
		  var filename = fileInput.files[0].name;
		  filename = filename.replace(/ /g, "_");
		  fullpath = path + filename;

		  var url = "<?php echo base_url('pg_admin/upload_gambar') ?>";

		  $.ajax({
				type: "POST",
				url: url,
				data: new FormData($('#frmupload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$('#text-load').html('Proses Upload Gambar');
					$('#modal-loader').appendTo("body").modal('show');
				},
				success: function(data){
					$('#modal-loader').modal('hide');
					callback(fullpath);
				}
		  });

        });
      }
    },
  });
</script>