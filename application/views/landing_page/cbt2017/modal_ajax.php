<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mainmodal" id="mainmodal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="<?php echo base_url("assets/img/rolling.gif");?>"/>
        <p id="text-load"> Memproses</p>
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
<div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center" id="pesan-error">
        
      </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL ERROR AJAX -->