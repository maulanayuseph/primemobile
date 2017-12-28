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
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah Bonus"?></h4>
                <!-- <p class="category">24 Hours performance</p> -->
              </div>
              <div class="content">
                <form method="post" action="<?php echo $form_action?>" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Kategori Bonus<span class="text-danger">*</span></label>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="input-group">
                          <select data-placeholder="Pilih Kategori..." id="kategori_bonus" name="kategori_bonus" class="chosen-select" style="width: 100%;" tabindex="1" required="required">
                            <option value=""></option>
                            <?php 
                            foreach ($select_options as $item) { 
                            ?>
                              <option <?php echo set_select('kategori_bonus', $item->id_kategori, (empty($data->kategori_id) ? FALSE : ($data->kategori_id == $item->id_kategori ? TRUE : FALSE)) );?> value="<?php echo $item->id_kategori ?>" > <?php echo ucfirst($item->kategori_bonus)?> </option>
                            <?php } ?>
                          </select>
                          <div class="input-group-btn">
                            <span class="btn btn-default" title="Tambah Kategori Bonus" data-toggle="modal" data-target="#modalTambahKategori">
                              <i class="glyphicon glyphicon-plus"></i>
                            </span>
                          </div>
                        </div>
                        <?php echo form_error('kategori_bonus', '<div class="text-danger">', '</div>'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Judul Konten Bonus<span class="text-danger">*</span></label>
                        <input type="text" name="judul_konten" class="form-control" placeholder="Judul Konten" value="<?php echo set_value('judul_konten', isset($data) ? $data->judul_konten : '');?>" required="required">
                        <?php echo form_error('judul_konten', '<div class="text-danger">', '</div>'); ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Nilai Poin<span class="text-danger">*</span></label>
                        <input type="number" name="poin" class="form-control" placeholder="Nilai Poin" value="<?php echo set_value('poin', isset($data) ? $data->poin : '');?>" required="required">
                        <?php echo form_error('poin', '<div class="text-danger">', '</div>'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>URL File <span class="text-danger">*</span></label>
                        <div class="input-group">
                          <input class="form-control" type="text" id="url_konten" name="url_konten" value="<?php echo set_value('url_konten', isset($data) ? $data->url : '');?>" >
                          <span class="input-group-btn">
                            <span class="btn btn-success" onclick="openKCFinder(url_konten);">Cari File</span>
                          </span>
                        </div>
                        <?php echo form_error('url_konten', '<div class="text-danger">', '</div>'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>Gambar<span class="text-danger"></span></label>
					<input type="file" name="gambar"/>
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
    <?php include "modal_tambah_kategori_bonus.php"; ?>
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

 <!-- Awesomplate Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/awesomplete.js');?>" async></script>

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

  <!-- Manually open kcfinder -->
  <script type="text/javascript">
    function openKCFinder(field) {
      console.log("OPENKCFINDER" + field);
      window.KCFinder = {
        callBack: function(url) {
            field.value = url; //DEFAULT (Full URL)
            // field.value = url.substr(url.lastIndexOf("/")+1); //(Get filename only)
            window.KCFinder = null;
        }
      };
      window.open("<?php echo base_url()?>assets/js/plugins/kcfinder/browse.php?type=files&dir=files", 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
      );
    }
  </script>

  <script type="text/javascript">
  function fetch_select_kategori(val)
  {
    $.ajax({
      type: 'POST',
      url: "<?=base_url('pg_admin/bonus/ajax_select_kategori')?>",
      data: { id:val },
      success: function(response){
        document.getElementById('kategori_bonus').innerHTML=response;              
        $("#kategori_bonus").trigger("chosen:updated");
      }
    });
  }

  $(document).ready(function() {
    var form = $('#formTambahKategori');  
    form.submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: form.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: { 
          tambah_kategori: $('#tambah_kategori').val()  
        },
        success: function(response){
          if(response != 0) {
            fetch_select_kategori();
            $("#tambah_kategori").val('');
            $("#alertDangerTambahKategori").slideUp();
            $("#alertSuccessTambahKategori").slideDown().delay(5000).slideUp();
          } 
          else {
            $("#alertSuccessTambahKategori").slideUp();
            $("#alertDangerTambahKategori").slideDown().delay(5000).slideUp();
          }
        }
      })

    });
  });
</script>
</html>
