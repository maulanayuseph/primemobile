<!-- =========================== Pembahasan Soal (TEKS) Modal =========================== -->
<div id="pembahasanModal" class='modal fade modal-center' role="dialog" tab-index='-1' aria-hidden='true' aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">        
        <div class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div>
        <h4 class="modal-title" id="pembahasan_label"><i class="glyphicon glyphicon-info-sign text-success"></i> Pembahasan (Teks)</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div id="konten_pembahasan_teks">
            Konten pembahasan disini ...
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-default" data-dismiss="modal">Tutup</a>
      </div>
    </div>
  </div>
</div>


<!-- =========================== Pembahasan Soal (VIDEO) Modal =========================== -->
<div id="pembahasanVideoModal" class='modal fade modal-center' role="dialog" tab-index='-1' aria-hidden='true' aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">        
        <div class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div>
        <h4 class="modal-title" id="pembahasan_label"><i class="glyphicon glyphicon-info-sign text-warning"></i> Pembahasan (Video)</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          
          <div id="konten_pembahasan_video">
             <!--
            <input style="display: none;" id="connectStr" size = "56" type="text" placeholder="" value="http://localhost:1935/vod/mp4:test123.mp4/manifest.mpd"/>
            <button style="display: none;" id="connectObj" type="button" style="width:80px" onclick="JavaScript:connect()">Start</button>
            <label style="display: none;" id="statusStr" size = "100" type="text" placeholder="" value="">Disconnected</label>
            
            <div class="embed-responsive embed-responsive-16by9">
              <div id="player"></div>
              <video id="videoObj" x-webkit-airplay="allow" controls alt="Example File" width="630" height="354" autoplay></video>
            </div>
			       -->
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <!-- <a id="changeSource">Pindah Source</a> -->
        <!-- <a id="pauseVideo">Pause</a> -->
        <!-- <a id="playVideo">Play</a> -->
        <a class="btn btn-default" data-dismiss="modal">Tutup</a>
      </div>
    </div>
  </div>
</div>


<!-- MODAL UNTUK KOMENTAR -->
<div class="modal fade" id="modal-komentar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <strong>Komentar Soal</strong>
      </div>
      <div class="modal-body" id="konten-modal-komentar">
    
      </div>
      <div class="modal-footer">
      <!--
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      -->
      </div>
    </div>
  </div>
</div>
<!-- END MODAL KOMENTAR -->

<!-- MODAL UNTUK LOADING AJAX -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-loader" style="display: none;">
  Launch demo modal
</button>
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

<!-- Modal untuk error ajax -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-error" style="display: none;">
  Launch demo modal
</button>
<div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
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
<!-- end modal error ajax --> 