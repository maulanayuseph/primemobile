<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
  <?php
		if($this->session->userdata('level') == "author"){
			$this->load->view('pg_admin/author/sidebar_penulis');
		}else{
			include "sidebar.php";
		}
	?>

  <div class="main-panel">
    <?php include "navbar.php";?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah Item Soal"?></h4>
                
              </div>
              <div class="content">
                <form method="post" action="<?php echo $form_action?>">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Pertanyaan<span class="text-danger">*</span></label>
                        <?php echo form_error('isi_soal', '<div class="text-danger">', '</div>'); ?>
                        <textarea name="isi_soal" id="tinymce_soal" class="form-control tinymce_textarea" style="height:200px;"><?php echo set_value('isi_soal', isset($data) ? html_entity_decode($data->isi_soal) : '');?></textarea>
                      </div>
                    </div>
                  </div>
          
                  <div class="row">
                    <div class="col-md-6">
                      <label>Kunci Jawaban<span class="text-danger">*</span></label>
                      <select data-placeholder="Kunci Jawaban" name="kunci_jawaban" class="chosen-select" style="width: 100%;" tabindex="3" required="required">
                        <option value=""></option>
                        <option <?php echo set_select('kunci_jawaban', '1', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '1' ? TRUE : FALSE)) );?> value="1">Jawaban 1</option>
                        <option <?php echo set_select('kunci_jawaban', '2', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '2' ? TRUE : FALSE)) );?> value="2">Jawaban 2</option>
                        <option <?php echo set_select('kunci_jawaban', '3', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '3' ? TRUE : FALSE)) );?> value="3">Jawaban 3</option>
                        <option <?php echo set_select('kunci_jawaban', '4', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '4' ? TRUE : FALSE)) );?> value="4">Jawaban 4</option>
                        <option <?php echo set_select('kunci_jawaban', '5', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '5' ? TRUE : FALSE)) );?> value="5">Jawaban 5</option>
                      </select>
                      <label>Bobot Soal<span class="text-danger">*</span></label>
                      <select data-placeholder="Bobot Soal" name="bobot" class="chosen-select" style="width: 100%;" tabindex="3" required="required">
                        <option value=""></option>
                        <option <?php echo set_select('bobot', '1', (!isset($data->bobot) ? FALSE : ($data->bobot == '1' ? TRUE : FALSE)) );?> value="1">Mudah</option>
                        <option <?php echo set_select('bobot', '2', (!isset($data->bobot) ? TRUE : ($data->bobot == '2' ? TRUE : FALSE)) );?> value="2">Sedang</option>
                        <option <?php echo set_select('bobot', '3', (!isset($data->bobot) ? FALSE : ($data->bobot == '3' ? TRUE : FALSE)) );?> value="3">Sulit</option>
                      </select>
                    </div>
                    
                    <div class="col-md-6">
						<div class="col-sm-12">
						<label>Atribut : </label>
						</div>
						<div class="col-sm-12" style="height: 400px; overflow-x: scroll;">
							<table class="table table-striped">
								<?php
									$jumlahatribut = $this->model_atribut->fetch_jumlah_atribut();
									
									if($jumlahatribut > 0){
										$fetchatribut = $this->model_atribut->fetch_parent();
									
										foreach($fetchatribut as $parent){
											if(isset($data)){
												$cekatribut = $this->model_atribut->cek_atribut_soal($data->id_soal, $parent->id_atribut);
												if($cekatribut > 0){
													$checked = "checked";
												}else{
													$checked = "";
												}
											}else{
											    $checked = "";
											}
											?>
											<tr id="tr-<?php echo $parent->id_atribut;?>" style="width: 10px;">
												<td class="text-center">
													<input type="checkbox" name="checkatr[<?php echo $parent->id_atribut;?>]" value="<?php echo $parent->id_atribut;?>" <?php echo $checked;?>>
												</td>
												<td>
													<?php echo $parent->atribut;?>
												</td>
											</tr>
											<?php
											$fetchchild = $this->model_atribut->fetch_child($parent->id_atribut);
											
											foreach($fetchchild as $child){
												if(isset($data)){
													$cekatribut = $this->model_atribut->cek_atribut_soal($data->id_soal, $child->id_atribut);
													if($cekatribut > 0){
														$checked = "checked";
													}else{
														$checked = "";
													}
												}else{
    											    $checked = "";
    											}
												?>
												<tr id="tr-<?php echo $child->id_atribut;?>">
												<td class="text-center">
													<input type="checkbox" name="checkatr[<?php echo $child->id_atribut;?>]" value="<?php echo $child->id_atribut;?>" <?php echo $checked;?>>
												</td>
												<td>
													- <?php echo $child->atribut;?>
												</td>
											</tr>
												<?php
											}
										}
									}
								?>
							</table>
						</div>
					</div>
  			      </div>

                  <div class="row">
                    <div class="col-md-12">
                      <label>Pilihan Jawaban<span class="text-danger">*</span></label>

                      <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab_jawab_1">Jawaban 1</a></li>
                        <li><a data-toggle="tab" href="#tab_jawab_2">Jawaban 2</a></li>
                        <li><a data-toggle="tab" href="#tab_jawab_3">Jawaban 3</a></li>
                        <li><a data-toggle="tab" href="#tab_jawab_4">Jawaban 4</a></li>
                        <li><a data-toggle="tab" href="#tab_jawab_5">Jawaban 5</a></li>
                      </ul>
                    </div>
                  </div>
				  
                  <div class="row">
                    <div class="col-md-12">
                      <div class="tab-content">
                        <div id="tab_jawab_1" class="tab-pane fade in active">
                          <div class="form-group">
                            <?php echo form_error('jawab_1', '<div class="text-danger">', '</div>'); ?>
                            <textarea name="jawab_1" id="tinymce_jawab_1" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_1', isset($data) ? html_entity_decode($data->jawab_1) : '');?></textarea>
                          </div>
                        </div>
                        <div id="tab_jawab_2" class="tab-pane fade ">
                          <div class="form-group">
                            <?php echo form_error('jawab_2', '<div class="text-danger">', '</div>'); ?>
                            <textarea name="jawab_2" id="tinymce_jawab_2" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_2', isset($data) ? html_entity_decode($data->jawab_2) : '');?></textarea>
                            <!-- <input type="text" name="jawab_2" class="form-control" placeholder="Jawaban 2" value="<?php echo set_value('jawab_2', isset($data) ? $data->jawab_2 : '');?>" required="required"> -->
                          </div>
                        </div>
                        <div id="tab_jawab_3" class="tab-pane fade ">
                          <div class="form-group">
                            <?php echo form_error('jawab_3', '<div class="text-danger">', '</div>'); ?>
                            <textarea name="jawab_3" id="tinymce_jawab_3" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_3', isset($data) ? html_entity_decode($data->jawab_3) : '');?></textarea>
                          </div>
                        </div>
                        <div id="tab_jawab_4" class="tab-pane fade ">
                          <div class="form-group">
                            <?php echo form_error('jawab_4', '<div class="text-danger">', '</div>'); ?>
                            <textarea name="jawab_4" id="tinymce_jawab_4" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_4', isset($data) ? html_entity_decode($data->jawab_4) : '');?></textarea>
                          </div>
                        </div>
                        <div id="tab_jawab_5" class="tab-pane fade ">
                          <div class="form-group">
                            <?php echo form_error('jawab_5', '<div class="text-danger">', '</div>'); ?>
                            <textarea name="jawab_5" id="tinymce_jawab_5" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_5', isset($data) ? html_entity_decode($data->jawab_5) : '');?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

				          <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Pembahasan</label>
                        <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#tab_pembahasan_teks">Teks</a></li>
                          <li><a data-toggle="tab" href="#tab_pembahasan_video">Video</a></li>
                        </ul>

                        <div class="tab-content">
                          <div id="tab_pembahasan_teks" class="tab-pane fade in active">
                            <div class="form-group">
                              <textarea name="pembahasan" id="pembahasan_teks" class="form-control tinymce_textarea" rows="10"><?php echo set_value('pembahasan', isset($data) ? html_entity_decode($data->pembahasan) : '');?></textarea>
                            </div>
                          </div>
                          <div id="tab_pembahasan_video" class="tab-pane fade ">
                            <div class="form-group">
                              <input type="url" name="pembahasan_video" id="pembahasan_video" class="form-control" placeholder="URL Video" value="<?php echo set_value('pembahasan_video', isset($data->pembahasan_video) ? $data->pembahasan_video : '');?>"></input>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
					<div class="col-sm-6">
						  <label>Set Status<span class="text-danger">*</span></label>
						  <select data-placeholder="Status Soal" name="status" class="chosen-select" style="width: 100%;" tabindex="3" required="required">
							<?php
								if($this->session->userdata('level') == "adminqc"){
									?>
									<option value="10">Approved</option>
									<?php
								}
							?>
							<option value="0">Waiting Approval</option>
							<option value="2">Pembahasan tidak lengkap</option>
							<option value="3">Belum ada pembobotan</option>
							<option value="4">Soal membingungkan</option>
							<option value="5">Soal double (perlu dihapus)</option>
							<option value="6">Soal tidak layak (perlu dihapus)</option>
							<option value="7">Pindah soal</option>
							<option value="8">Soal belum di QC Tentor</option>
							<option value="9">Video Salah</option>
						  </select>
					</div>
                  </div>
                  
				  <!-- hidden input for id sub materi -->
                  <input type="hidden" name="sub_materi_id" class="form-control" value="<?php echo set_value('sub_materi_id', isset($data->sub_materi_id) ? $data->sub_materi_id : '');?>">
				  
                  

                  <!-- TAMPILKAN KOMENTAR YANG ADA PADA SOAL YANG BERSANGKUTAN -->
                  <div class="row">
                    <div class="col-sm-12">
                      <input type="checkbox" name="flag-komentar" /> Flag semua komentar ketika simpan (pastikan anda sudah melakukan edit semua kesalahan yang terlapor di komentar)
                    </div>
                  </div>
                  <div class="row" style="height: 400px; overflow-y: scroll;">
                      <div class="col-sm-12">
                        <?php
                        if(isset($data)){
                          $datakomentar = $this->model_komentar_soal->fetch_komentar_by_soal($data->id_soal);
                        }
                        ?>
                        <table class="table table-responsive table-striped table-bordered">
                          <thead>
                            <tr>
                              <th style="width: 10px;">#</th>
                              <th class="text-center">Komentar</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $x = 1;
                              if($datakomentar !== null){
                                foreach($datakomentar as $komentar){
                                  if($komentar->tipe_komentar == "salah"){
                                    $tipe = "<span style='color: red'>Melaporkan kesalahan soal</span>";
                                  }elseif($komentar->tipe_komentar == "suka"){
                                    $tipe = "<span style='color: green'>Soal favorit</span>";
                                  }elseif($komentar->tipe_komentar == "jelas"){
                                    $tipe = "<span style='color: yellow'>Membutuhkan penjelasan soal</span>";
                                  }
                                  ?>
                                  <tr>
                                    <td class="text-center"><?php echo $x;?></td>
                                    <td>
                                      <i><strong><?php echo $komentar->nama_siswa;?> (<?php echo $komentar->nama_sekolah;?>)</strong> - <?php echo $komentar->waktu_komen;?></i> <br><?php echo $tipe;?>
                                      <br><?php echo $komentar->alias_kelas;?> <?php echo $komentar->nama_mapel;?> : <?php echo $komentar->nama_materi_pokok;?> - <?php echo $komentar->nama_sub_materi;?>
                                      <p>&nbsp;
                                      <p><?php echo $komentar->komentar;?>
                                    </td>
                                  </tr>
                                  <?php
                                  $x++;
                                }
                              }
                            ?>
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <!-- END TAMPILKAN KOMENTAR -->
                  <div class="row">
                    <div class="col-md-12">
          
                      <?php
                        if($this->session->userdata('level') == "adminqc"){
                          ?>
                          <button type="submit" name="form_submit" value="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save & Publish</button>
                          <?php           
                        }else{
                          ?>
                          <button type="submit" name="form_submit" value="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                          <?php
                        }
                      ?>
                      <button type="reset" class="btn btn-danger pull-right" onclick="return resetForm(this.form);"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                  </div>

                </form>

                <div class="footer">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        
  
        
      </div>
    </div>

	<form method="post" enctype='multipart/form-data' id="frmupload">
		<input name="filegambar" type="file" id="filegambar" onchange="" style="display:none;">
	</form>
    <?php include "footer.php"; ?>
  </div>
</div>

</body>

  <!--   Core JS Files   -->
  <script src="<?php echo base_url('assets/js/jquery-1.10.2.js');?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>

 <!--  Checkbox, Radio & Switch Plugins -->
 <script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

  <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
 <script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

 <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
 <script src="<?php echo base_url('assets/js/demo.js');?>"></script>

<!-- Progress -->
<script src="<?= base_url('assets/js/nprogress.js')?>" ></script>

<!-- CUSTOM JS FUNCTION -->
<!-- Reset Form -->
<script type="text/javascript">
  function resetForm(form){
    // clearing selects
    $('.chosen-select').val('').trigger('chosen:updated');
  }
</script>

<!-- PLUGINS FUNCTION -->
 <!-- Chosen - select box plugin  -->
 <script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>" type="text/javascript"></script>
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

 <!-- TinyMCE - WYSIWYG plugin  -->
 <script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js');?>" type="text/javascript"></script>
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
    toolbar2: "| fontsizeselect | styleselect | eqneditor  link unlink anchor | image media youtube | forecolor backcolor | code",
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
					NProgress.start();
				},
				success: function(data){
					NProgress.done(); 
					callback(fullpath);
				}
		  });

        });
      }
    },

	/*
		//Filemanager
		external_filemanager_path: "<?php echo base_url();?>assets/js/plugins/filemanager/",
		filemanager_title: "Data Filemanager" ,
		external_plugins: { "filemanager" : "<?php echo base_url();?>assets/js/plugins/filemanager/plugin.min.js" },
	 
    //integrating tinymce 4 and kcfinder
    file_browser_callback: function(field, url, type, win) {
      console.log("<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type);
      tinyMCE.activeEditor.windowManager.open({
          file:  "<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
          title: 'KCFinder',
          width: 700,
          height: 300,
          inline: true,
          close_previous: false
      }, {
          window: win,
          input: field
      });
      return false;
    }
	*/
  });
  </script>

  <!-- Manually open kcfinder -->
  <script type="text/javascript">
    function openKCFinder(field) {
      console.log("OPENKCFINDER" + field);
      window.KCFinder = {
        callBack: function(url) {
            // field.value = url; DEFAULT (Full URL)
            field.value = url.substr(url.lastIndexOf("/")+1); //(Get filename only)
            window.KCFinder = null;
        }
      };
      window.open("<?php echo base_url()?>assets/js/plugins/kcfinder/browse.php?type=images&dir=images", 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
      );
    }
  </script>
</html>
