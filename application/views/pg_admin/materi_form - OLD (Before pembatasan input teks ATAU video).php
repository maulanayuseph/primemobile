<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php";?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah Materi"?></h4>
                <p class="category">24 Hours performance</p>
              </div>
              <div class="content">
                <form method="post" action="<?php echo $form_action?>">
                  <div class="form-group">
                    <label>Mata Pelajaran<span class="text-danger">*</span></label>
                    <?php echo form_error('nama_mapel', '<div class="text-danger">', '</div>'); ?>
                    <div class="row">
                      <div class="col-md-6">
                        <select data-placeholder="Pilih Mata Pelajaran..." name="nama_mapel" class="chosen-select" onchange="fetch_select_materi_pokok(this.value)" style="width: 100%;" tabindex="2" required="required">
                          <option value=""></option>
                          <?php 
                          foreach ($select_options_mapel as $item) { 
                            $option_name = $item->nama_mapel . " - " . $item->alias_kelas;
                          ?>
                          <option <?php echo set_select('nama_mapel', $item->id_mapel, (!isset($data->id_mapel) ? FALSE : ($data->id_mapel == $item->id_mapel ? TRUE : FALSE)) );?> value="<?php echo $item->id_mapel ?>" > <?php echo $option_name ?> </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Materi Pokok<span class="text-danger">*</span></label>
                    <?php echo form_error('materi_pokok', '<div class="text-danger">', '</div>'); ?>
                    <div class="row">
                      <div class="col-xs-6 col-md-6">
                        <select data-placeholder="Pilih Materi Pokok..." id="materi_pokok" name="materi_pokok" class="chosen-select" style="width: 100%;" tabindex="3" required="required">
                          <option value=""></option>
                          <?php 
                          foreach ($select_options_materi_pokok as $item) { ?>
                            <option <?php echo set_select('materi_pokok', $item->id_materi_pokok, (!isset($data->id_materi_pokok) ? FALSE : ($data->id_materi_pokok == $item->id_materi_pokok ? TRUE : FALSE)) );?> value="<?php echo $item->id_materi_pokok ?>" > <?php echo $item->nama_materi_pokok ?> </option>
                          <?php } ?>
                        </select>
                      </div>
                      <div id="ajax-loading" class="col-xs-1 col-md-1" style="display:none;"> 
                        <img src="<?php echo base_url('assets/img/ajax-loading.gif')?>" alt="Loading..."></img>
                      </div>
                    </div>
                  </div> 

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Judul Materi Pembelajaran<span class="text-danger">*</span></label>
                        <?php echo form_error('judul_materi', '<div class="text-danger">', '</div>'); ?>
                        <input type="text" name="judul_materi" class="form-control" placeholder="Judul Materi Pembelajaran" value="<?php echo set_value('judul_materi', isset($data) ? $data->nama_sub_materi : '');?>" required="required">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Kategori<span class="text-danger">*</span></label>
                    <?php echo form_error('kategori_materi', '<div class="text-danger">', '</div>'); ?>
                    <?php $id_kategori = isset($data->kategori) ? ($data->kategori-1) : 0; //$id_kategori diperlukan untuk javascript dibawah ?>
                    <div class="row">
                      <div class="col-md-6">
                        <ul class="nav nav-pills" id="kategoriKontenTab">
                          <li class="dropdown"> 
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <span id="choice">Activity</span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#kategori_teks" value="1" data-toggle="tab">Teks</a></li>
                                <li><a href="#kategori_video" value="2" data-toggle="tab">Video</a></li>
                            </ul>
                          </li>
                        </ul>
                        <input type="hidden" name="kategori_materi" id="kategori_materi" style="display:transparent;"/>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Konten<span class="text-danger">*</span></label>
                        <?php echo form_error('konten_materi', '<div class="text-danger">', '</div>'); ?>
                        <?php echo form_error('konten_video', '<div class="text-danger">', '</div>'); ?>
                        <div class="tab-content">
                          <div class="tab-pane fade in active" id="kategori_teks">
                            <textarea name="konten_materi" id="tinymce_textarea" class="form-control" style="height:400px;"><?php echo set_value('konten_materi', isset($data->kategori) ? ($data->kategori==1 ? html_entity_decode($data->isi_materi) : '') : '');?></textarea>
                          </div>
                          <div class="tab-pane fade" id="kategori_video">
                            <input type="url" name="konten_video" id="video_input_box" class="form-control" placeholder="Video URL" value="<?php echo set_value('konten_video', isset($data->kategori) ? ($data->kategori==2 ? html_entity_decode($data->isi_materi) : '') : '');?>" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Gambar Thumbnail</label>
                        <div class="input-group">
                          <input class="form-control" type="text" id="gambar_materi" name="gambar_materi" value="<?php echo set_value('gambar_materi', isset($data) ? $data->gambar_materi : '');?>" >
                          <span class="input-group-btn">
                            <span class="btn btn-success" onclick="openKCFinder(gambar_materi);">Cari Gambar</span>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Tanggal Post <span class="text-danger">*</span></label>
                        <?php echo form_error('tanggal_post', '<div class="text-danger">', '</div>'); ?>
                        <input class="form-control" type="date" id="tanggal_post" name="tanggal_post" value="<?php echo set_value('tanggal_post', (!isset($data) ? date('Y-m-d') : (($data->tanggal!=0) ? $data->tanggal : date('Y-m-d'))) );?>" required="required">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Waktu Post <span class="text-danger">*</span></label>
                        <?php echo form_error('waktu_post', '<div class="text-danger">', '</div>'); ?> 
                        <input class="form-control" type="time" id="waktu_post" name="waktu_post" value="<?php echo set_value('waktu_post', (!isset($data) ? date('H:i') : (($data->waktu!=0) ? $data->waktu : date('H:i'))) );?>" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <button type="submit" name="form_submit" value="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                      <button type="reset" class="btn btn-danger pull-right" onclick="return resetForm(this.form);"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                  </div>
                </form>

                <div class="footer">
                  <hr>
                  <div class="stats">
                    <i class="fa fa-history"></i> Updated 3 minutes ago
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

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

<!-- CUSTOM JS FUNCTION -->
<!-- Reset Form -->
<script type="text/javascript">
  function resetForm(form){
    // clearing Chosen selects
    $('.chosen-select').val('').trigger('chosen:updated');

  }
</script>

<script type="text/javascript">
  // needed to change dropdown text on Kategori select box AND-
  // to pass the id into #kategori_materi input 
  $(document).ready(function(){ 
    $("#kategoriKontenTab .dropdown .dropdown-menu li a").click(function(){
      $('#kategori_materi').val($(this).attr('value'));
      $('.dropdown a span#choice').text($(this).text());
      // console.log($(this).text());
    });

    //set default selected kategori konten (Teks)
    // $("#kategoriKontenTab .dropdown .dropdown-menu li a")<?php echo "[".$id_kategori."]"; ?>.click();
    $("#kategoriKontenTab .dropdown .dropdown-menu li a")<?php echo "[".$id_kategori."]"; ?>.click();
  });
</script>

<script type="text/javascript">
  $().ready(function(){
    $('#video_upload_form').submit(function(){
        var video_url_params = '&lightbox[width]=610&lightbox[height]=360';
        var video_url = $('#video_input_box').val() + video_url_params;
        $('#video_preview').attr('href', video_url);
        return false;
    });
});
</script>

<script type="text/javascript">
  //Show/Hide loading image (.gif) on AJAX process
  $(document).ready(function(){
    $(document).ajaxStart(function(){
        $("#ajax-loading").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#ajax-loading").css("display", "none");
    });
  });
</script>

<script type="text/javascript">
  function fetch_select_materi_pokok(val)
  {
    $.ajax({
      type: 'POST',
      url: "<?=base_url('pg_admin/materi/ajax_select_materi_pokok')?>",
      data: { id:val },
      success: function(response){
        document.getElementById('materi_pokok').innerHTML=response;
        
        $("#materi_pokok").trigger("chosen:updated");
      }
    });
  }
</script>

<script type="text/javascript">
  // Used to get the video preview. But get discontinued
  // function fetch_preview_konten_video(url)
  // {
  //   console.log(url)
  //   $.ajax({
  //     type: 'POST',
  //     url: "<?=base_url('pg_admin/materi/ajax_konten_video')?>",
  //     data: { data:url },
  //     success: function(response){
  //       document.getElementById('video_preview').innerHTML=response;
  //     }
  //   });
  // }
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
    selector: '#tinymce_textarea',
    skin: 'lightgray',
    menubar: false,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor",
        "code fullscreen youtube autoresize"
      ],
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table | fullscreen" ,
    toolbar2: "| fontsizeselect | styleselect | link unlink anchor | image media youtube | forecolor backcolor | code",
    extended_valid_elements: "+iframe[src|width|height|name|align|class]",
    image_advtab: true,
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
    relative_urls: false,
    remove_script_host: false,

    //integrating tinymce 4 and kcfinder
    file_browser_callback: function(field, url, type, win) {
      console.log("<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type);
      tinyMCE.activeEditor.windowManager.open({
          file:  "<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
          title: 'KCFinder',
          width: 700,
          height: 500,
          inline: true,
          close_previous: false
      }, {
          window: win,
          input: field
      });
      return false;
    }
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
