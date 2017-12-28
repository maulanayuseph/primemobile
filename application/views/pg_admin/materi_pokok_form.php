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
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah Materi Pokok"?></h4>
                <!-- <p class="category">24 Hours performance</p> -->
              </div>
              <div class="content">
                <form method="post" action="<?php echo $form_action?>">
                  <div class="form-group">
                    <label>Mata Pelajaran<span class="text-danger">*</span></label>
                    <?php echo form_error('mata_pelajaran', '<div class="text-danger">', '</div>'); ?>
                    <div class="row">
                      <div class="col-md-6">
                        <select data-placeholder="Pilih Mata Pelajaran..." name="mata_pelajaran" class="chosen-select" style="width: 100%;" tabindex="1" required="required">
                          <option value=""></option>
                          <?php 
                          foreach ($select_options as $item) { 
                            $option_name = $item->nama_mapel . " - " . $item->alias_kelas;
                          ?>
                            <option <?php echo set_select('mata_pelajaran', $item->id_mapel, (empty($data->id_mapel) ? FALSE : ($data->id_mapel == $item->id_mapel ? TRUE : FALSE)) );?> value="<?php echo $item->id_mapel ?>" > <?php echo $option_name ?> </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nama Materi Pokok<span class="text-danger">*</span></label>
                        <?php echo form_error('materi_pokok', '<div class="text-danger">', '</div>'); ?>
                        <input type="text" name="materi_pokok" class="form-control" placeholder="Nama Materi Pokok" value="<?php echo set_value('materi_pokok', isset($data) ? $data->nama_materi_pokok : '');?>" required="required">
                      </div>
                    </div>
                  </div>
                  <!-- Input judul bab K13 dan KTSP -->
				  <!-- ################################ -->
				  <!-- ################################ -->
				  <div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Judul Bab K13<span class="text-danger">*</span></label>
							<?php echo form_error('judul_bab_k13', '<div class="text-danger">', '</div>'); ?>
							<input type="text" name="judul_bab_k13" class="form-control" placeholder="Nama Materi Pokok" value="<?php echo set_value('judul_bab_k13', isset($data) ? $data->judul_bab_k13 : '');?>" required="required">
						</div>
					</div>
				  </div>
				  
				  <div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Judul Bab KTSP<span class="text-danger">*</span></label>
							<?php echo form_error('judul_bab_ktsp', '<div class="text-danger">', '</div>'); ?>
							<input type="text" name="judul_bab_ktsp" class="form-control" placeholder="Nama Materi Pokok" value="<?php echo set_value('judul_bab_ktsp', isset($data) ? $data->judul_bab_ktsp : '');?>" required="required">
						</div>
					</div>
				  </div>
				  <!-- END Input judul bab K13 dan KTSP -->
				  <!-- ################################ -->
				  <!-- ################################ -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Deskripsi Materi Pokok</label>
                        <textarea name="deskripsi_materi_pokok" class="form-control" placeholder="Deskripsi Materi Pembelajaran" rows="4"><?php echo set_value('deskripsi_materi_pokok', isset($data->deskripsi_materi_pokok) ? $data->deskripsi_materi_pokok : '');?></textarea>
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
    // clearing selects
    $('.chosen-select').val('').trigger('chosen:updated');
  }
</script>

 <script type="text/javascript">
   $(document).ready(function(){

     demo.initChartist();

     $.notify({
       icon: 'pe-7s-gift',
       message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."

      },{
        type: 'info',
        timer: 4000
      });

   });
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
