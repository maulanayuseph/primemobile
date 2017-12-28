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
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Ubah Poin"?></h4>
                <!-- <p class="category">24 Hours performance</p> -->
              </div>
              <div class="content">
                <form method="post" action="<?php echo $form_action?>">
                  
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Kategori: <span class="text-danger"></span></label>
                        <input type="text" name="kategori_poin" id="kategori_poin" class="form-control" value="<?php echo $data->kategori?>" disabled>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Nilai Poin<span class="text-danger">*</span></label>
                        <input type="number" name="nilai_poin" id="nilai_poin" class="form-control" placeholder="Nilai Poin" value="<?php echo set_value('nilai_poin', isset($data) ? $data->nilai : '');?>" required="required">
                        <?php echo form_error('nilai_poin', '<div class="text-danger">', '</div>'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Deskripsi Poin</label>
                        <textarea name="deskripsi_poin" id="deskripsi_poin" class="form-control" rows="4" placeholder="Deskripsi Poin"><?php echo set_value('deskripsi_poin', isset($data) ? $data->deskripsi : '');?></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <button type="submit" name="form_submit" value="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                      <button type="reset" class="btn btn-danger pull-right" onclick="javascript:history.back();"><i class="fa fa-times"></i> Cancel</button>
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
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>
    
  </div>
</div> <!-- end .wrapper -->

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

<!-- CUSTOM JS FUNCTION -->

</html>
