<!-- identifier untuk notifikasi -->
<?php
  if($this->session->flashdata('success')){
    $kategorinotif  = "success";
    $pesannotif     = $this->session->flashdata('success');
  }elseif($this->session->flashdata('error')){
    $kategorinotif  = "error";
    $pesannotif     = $this->session->flashdata('error');
  }else{
    $kategorinotif  = "nope";
    $pesannotif     = "";
  }
?>
<input type="hidden" id="kategori-notif" value="<?php echo $kategorinotif;?>">
<input type="hidden" id="pesan-notif" value="<?php echo $pesannotif;?>">
<!-- /end identifier notifikasi -->
<input type="hidden" id="key" value="<?php echo $this->security->get_csrf_hash(); ?>">
<?php
  if($title !== "Content Management System Login"){
        ?>
            <!-- footer content -->
            <footer>
              <div class="pull-right">
                Prime Mobile &copy; 2018 <a href="https://colorlib.com">Colorlib</a>
              </div>
              <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
            </div>
        </div>
        <?php
    }
?>
<div class="modal bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mainmodal" id="mainmodal" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="mainmodaltitle">&nbsp;</h4>
    </div>
    <div class="modal-body" id="mainmodalcontent" style="max-height: 80vh; overflow-y: scroll;">
    </div>
    </div>
  </div>
</div>

<!-- MODAL LOADING AJAX -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-loader" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk loading ajax -->
<div class="modal fade" id="modal-loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document" style="background-color: none; box-shadow: none;">
    <div class="modal-content" style="box-shadow: none; border-radius: 0px; border: none; background-color: rgba(0,0,0,0);">
      <div class="modal-body text-center">
        <img src="<?php echo adm_asset;?>images/plogo.gif" />
        <br>
        <br>
        <p id="text-load" style="font-weight: bold; color: white;"> Memproses</p>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL LOADING AJAX -->

<!-- MODAL ERROR AJAX -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-error" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk error ajax -->
<div class="modal" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
    <p>Terjadi kesalahan, periksa koneksi atau ulangi lagi
      </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
  $this->load->view($footerassets);
?>
  </body>
</html>
