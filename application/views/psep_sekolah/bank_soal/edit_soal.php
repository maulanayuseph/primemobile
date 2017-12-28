<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
//include "html_header.php"; 
$this->load->view("psep_sekolah/html_header");
?>
<div class="wrapper">
  <?php
  //include "sidebar.php"; 
  $this->load->view("psep_sekolah/sidebar");
  ?>

  <div class="main-panel">
    <?php
    //include "navbar.php"; 
    $this->load->view("psep_sekolah/navbar");
    ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
		
		  <div class="col-md-12">
		  	<div class="card">
		  		<div class="header">
	                <h4 class="title">Tambah Bank Soal</h4>
	            </div>
	            <div class="content">
	                <div class="row">
	                	<form method="post" action="<?php echo base_url("psep_sekolah/bank_soal/proses_edit_soal");?>">
		                	<div class="col-sm-4">
								<select class="form-control" name="kelas" required>
									<option value="">-- Pilih Kelas --</option>
									<?php
										foreach($datakelas as $kelas){
											if($kelas->id_kelas == $soal->id_kelas){
												$selected = "selected";
											}else{
												$selected = "";
											}
											?>
											<option value="<?php echo $kelas->id_kelas;?>" <?php echo $selected;?>><?php echo $kelas->alias_kelas;?></option>
											<?php
										}
									?>
								</select>
		                	</div>
		                	<div class="col-sm-4">
								<select class="form-control" name="mapel" required>
									<option value="">-- Pilih Mata Pelajaran --</option>
									<?php
										foreach($datamapel as $mapel){
											if($mapel->id_mapel == $soal->id_mapel){
												$selectmapel = "selected";
											}else{
												$selectmapel = "";
											}
											?>
											<option value="<?php echo $mapel->id_mapel;?>" <?php echo $selectmapel;?>><?php echo $mapel->nama_mapel;?></option>
											<?php
										}
									?>
								</select>
		                	</div>
		                	<div class="col-sm-4">
								<select class="form-control" name="kategori" required>
									<option value="">-- Pilih Kategori --</option>
									<?php
										foreach($datakategori as $kategori){
											if($kategori->id_atribut == $soal->id_atribut){
												$selectatribut = "selected";
											}else{
												$selectatribut = "";
											}
											?>
											<option value="<?php echo $kategori->id_atribut;?>" <?php echo $selectatribut;?>><?php echo $kategori->atribut;?></option>
											<?php
										}
									?>
								</select>
		                	</div>
							<div class="col-sm-12">
								<br>
							</div>
		                	<div class="col-sm-5" id="select-topik">
		                		<select data-placeholder="Pilih Topik Soal..." name="topik" class="chosen-select" style="width: 100%;">
		                          <option value="">-- Pilih Topik Soal --</option>
		                          <?php
		                          	foreach ($datatopik as $topik) {
		                          		if($topik->topik == $soal->topik){
		                          			$selecttopik = "selected";
		                          		}else{
		                          			$selecttopik = "";
		                          		}
		                          		?>
		                          		<option value="<?php echo $topik->topik;?>" <?php echo $selecttopik;?>><?php echo $topik->topik;?></option>
		                          		<?php
		                          	}
		                          ?>
		                        </select>
		                	</div>
		                	<div class="col-sm-2" id="col-btn-tambah-topik">
		                		<button type="button" class="btn btn-danger btn-tambah-topik"><i class="fa fa-plus" aria-hidden="true"></i></button>
		                	</div>
		                	<div class="col-sm-5 col-topik-baru" style="display: none;">
		                		<input type="text" name="topik-baru" class="form-control" placeholder="Masukkan Topik Baru..." id="input-topik-baru"/>
								<button type="button" class="btn btn-sm btn-danger cancel-topik" style="float: right;">Batal</button>
		                	</div>

		                	<div class="col-sm-12">
								<!-- Isi Soal -->
								<div class="form-group">
									<label>Soal<span class="text-danger">*</span></label>
									<div class="row">
										<div class="col-md-12">
											<textarea class="tinymce_textarea" name="soal">
												<?php echo html_entity_decode($soal->pertanyaan);?>
											</textarea>
										</div>
									</div>
								</div>
								<!-- end isi soal -->
		                	</div>
							
							<!-- pilihan jawaban benar -->
							<div class="col-md-6">
								<label>Pilihan Jawaban Benar<span class="text-danger">*</span></label>
								<select name="jawabbenar" class="form-control">
									<?php
										for($i = 1; $i <= 5; $i++){
											if($i == $soal->kunci){
												$selectkunci = "selected";
											}else{
												$selectkunci = "";
											}
											if($i == 1){
												$opt = "Jawaban A";
											}elseif($i == 2){
												$opt = "Jawaban B";
											}elseif($i == 3){
												$opt = "Jawaban C";
											}elseif($i == 4){
												$opt = "Jawaban D";
											}elseif($i == 5){
												$opt = "Jawaban E";
											}
											?>
											<option value="<?php echo $i;?>" <?php echo $selectkunci;?>><?php echo $opt;?></option>
											<?php
										}
									?>
								</select>
							</div>
							<!-- end pilihan jawaban benar -->

							<!-- bobot soal -->
							<div class="col-sm-6">
								<label>Bobot Soal<span class="text-danger">*</span></label>
								<input type="text" name="bobot" class="form-control" value="<?php echo $soal->bobot_soal;?>" required/>
							</div>
							<!-- enf bobot soal -->

		                	<!-- PILIHAN JAWABAN -->
		                	<div class="col-md-12">
								  <ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#1" aria-controls="home" role="tab" data-toggle="tab">Jawaban A</a></li>
									<li role="presentation"><a href="#2" aria-controls="profile" role="tab" data-toggle="tab">Jawaban B</a></li>
									<li role="presentation"><a href="#3" aria-controls="messages" role="tab" data-toggle="tab">Jawaban C</a></li>
									<li role="presentation"><a href="#4" aria-controls="settings" role="tab" data-toggle="tab">Jawaban D</a></li>
									<li role="presentation"><a href="#5" aria-controls="settings" role="tab" data-toggle="tab">Jawaban E</a></li>
								  </ul>

								  <!-- Tab panes -->
								  <div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="1">
										<textarea class="tinymce_textarea" name="jawab1">
											<?php echo html_entity_decode($soal->jawab_1);?>
										</textarea>
									</div>
									<div role="tabpanel" class="tab-pane" id="2">
										<textarea class="tinymce_textarea" name="jawab2">
											<?php echo html_entity_decode($soal->jawab_2);?>
										</textarea>
									</div>
									<div role="tabpanel" class="tab-pane" id="3">
										<textarea class="tinymce_textarea" name="jawab3">
											<?php echo html_entity_decode($soal->jawab_3);?>
										</textarea>
									</div>
									<div role="tabpanel" class="tab-pane" id="4">
										<textarea class="tinymce_textarea" name="jawab4">
											<?php echo html_entity_decode($soal->jawab_4);?>
										</textarea>
									</div>
									<div role="tabpanel" class="tab-pane" id="5">
										<textarea class="tinymce_textarea" name="jawab5">
											<?php echo html_entity_decode($soal->jawab_5);?>
										</textarea>
									</div>
								  </div>
							</div>
		                	<!-- END PILIHAN JAWABAN -->

		                	<!-- Pembahasan -->
		                	<div class="col-sm-12">
		                		<label>Pembahasan</label>
		                		<textarea class="tinymce_textarea" name="bahasteks">
		                			<?php echo html_entity_decode($soal->pembahasan_teks);?>
								</textarea>
		                	</div>
		                	<!-- end pembahasan -->

		                	<div class="col-sm-12">
		                		<input type="hidden" name="idsoal" value="<?php echo $soal->id_banksoal;?>">
		                		<br>
		                		<input type="submit" name="submit" class="btn btn-sm btn-danger" value="Edit Soal">
		                	</div>
	                	</form>
	                </div>
	            </div>
		  	</div>
		  </div>

		  

        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->
	
    <?php
    //include "footer.php";
    $this->load->view("psep_sekolah/footer");
    ?>
	
  </div>
</div>
<form method="post" enctype='multipart/form-data' id="frmupload">
	<input name="filegambar" type="file" id="filegambar" onchange="" style="display:none;">
</form>
<?php $this->load->view("psep_sekolah/modal_ajax");?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
<!-- Chosen - select box plugin  -->
<script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>" type="text/javascript"></script>
 <!-- TinyMCE - WYSIWYG plugin  -->
 <script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js');?>" type="text/javascript"></script>
<script type="text/javascript">
		var config = {
			'.chosen-select'           : {},
			'.chosen-select-deselect'  : {allow_single_deselect:true},
			'.chosen-select-no-single' : {disable_search_threshold:10},
			'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
			'.chosen-select-width'     : {width:"95%"}
		}
		for (var selector in config) {
			$(selector).chosen(config[selector]);
		}
</script>
<script type="text/javascript">
$(function(){
	
	$(".btn-tambah-topik").click(function(){
		$('.col-topik-baru').css('display', 'block');
		$('#select-topik').css('display', 'none');
		$('#col-btn-tambah-topik').css('display', 'none');
	})

	$(".cancel-topik").click(function(){
		$('#input-topik-baru').val('');
		$('.col-topik-baru').css('display', 'none');
		$('#select-topik').css('display', 'block');
		$('#col-btn-tambah-topik').css('display', 'block');
	})
	$(document).ajaxSend(function(event, jqxhr, settings){
		$("#modal-loader").modal("show");
	});
	$(document).ajaxSuccess(function(event, request, options){
		$('#modal-loader').modal('hide');
	});
	$(document).ajaxError(function(event, request, options){
		$('#modal-loader').modal('hide');
		$('#modal-error').appendTo("body").modal('show');
	});
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
        "code fullscreen youtube autoresize tiny_mce_wiris"
      ],
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table | fullscreen | tiny_mce_wiris_formulaEditor | tiny_mce_wiris_formulaEditorChemistry | tiny_mce_wiris_CAS" ,
    toolbar2: "| fontsizeselect | styleselect | link unlink anchor | eqneditor image youtube | forecolor backcolor | code | rtl",
    extended_valid_elements: "+iframe[src|width|height|name|align|class]",
    image_advtab: true,
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
    relative_urls: false,
    remove_script_host: false,
	
	file_picker_callback: function(callback, value, meta) {
      if (meta.filetype == 'image') {
        $('#filegambar').trigger('click');
        $('#filegambar').on('change', function() {
		  
          var path = "<?php echo base_url('assets/uploads/tugas_siswa/') ?>";
		  var fileInput = document.getElementById('filegambar');   
		  var filename = fileInput.files[0].name;
		  filename = filename.replace(/ /g, "_");
		  fullpath = path + filename;

		  var url = "<?php echo base_url('pg_admin/upload_gambar/tugas_siswa') ?>";

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
				    nf = path + '/' + data;
					$('#modal-loader').modal('hide');
					callback(nf);
				}
		  });

        });
      }
    },
  });
  </script>
</html>
