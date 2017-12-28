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
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Buat Latihan Soal"?></h4>
                <!-- <p class="category">24 Hours performance</p> -->
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
                      <div class="col-md-6">
                        <select data-placeholder="Pilih Materi Pokok..." id="materi_pokok" name="materi_pokok" class="chosen-select" onchange="fetch_select_sub_materi(this.value)" style="width: 100%;" tabindex="3" required="required">
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

                  <div class="form-group">
                    <label>Sub Materi<span class="text-danger">*</span></label>
                    <?php 
                    echo form_error('submateri', '<div class="text-danger">', '</div>'); ?>
                    <div class="row">
                      <div class="col-md-6">
                        <select data-placeholder="Pilih Materi..." id="sub_materi" name="sub_materi" class="chosen-select" style="width: 100%;" tabindex="3" required="required">
                          <option value=""></option>
                            <?php
                            foreach($submateri as $s){
                            ?>
                            <option <?php echo set_select('sub_materi', $s->id_sub_materi, "");?> value="<?php echo $s->id_sub_materi ?>"><?php echo $s->nama_sub_materi?></option>
                            <?php
                            }
                            ?>
                        </select>
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
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <footer class="footer">
      <div class="container-fluid">
        
        <p class="copyright pull-right">
          &copy; 2016 <a href="http://www.primegeneration.com">Prime Generation</a>
        </p>
      </div>
    </footer>

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
        url: "<?=base_url('pg_admin/latihansoal/ajax_select_materi_pokok')?>",
        data: { id:val },
        success: function(response){
          document.getElementById('materi_pokok').innerHTML=response;
          
          $("#materi_pokok").trigger("chosen:updated");
          $("#sub_materi").val('').trigger("chosen:updated");
        }
      });
    }
  </script>

  <script type="text/javascript">
    function fetch_select_sub_materi(val)
    {
      $.ajax({
        type: 'POST',
        url: "<?=base_url('pg_admin/latihansoal/ajax_select_sub_materi')?>",
        data: { id:val },
        success: function(response){
          document.getElementById('sub_materi').innerHTML=response;
          
          $("#sub_materi").trigger("chosen:updated");
        }
      });
    }
  </script>

</html>
