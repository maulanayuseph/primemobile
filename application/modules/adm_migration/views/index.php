<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="page-title">
      <div class="title_left">
        <h3>Manajemen Migrasi Konten</h3>
      </div>
    </div>

    <div class="clearfix"></div>
    
    <div class="row">

      <div class="col-sm-6">
        <div class="x_panel">

          <div class="col-sm-12">
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
              <!-- SELECT KELAS -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kelas-old">Kelas
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control" id="kelas-old">
                    <option value="">-- Pilih Kelas --</option>
                    <?php
                      foreach($datakelas as $kelas){
                        ?>
                        <option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
                        <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <!-- END SELECT KELAS -->

              <!-- SELECT KURIKULUM -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kelas-old">Kurikulum
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control" id="kurikulum-old">
                    <option value="">-- Pilih Kurikulum --</option>
                    <option value="K-13">K-13</option>
                    <option value="K-13 REVISI">K-13 REVISI</option>
                    <option value="KTSP">KTSP</option>
                  </select>
                </div>
              </div>
              <!-- END SELECT KURIKULUM -->

              <!-- SELECT MAPEL -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mapel-old">Mata Pelajaran
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control" id="mapel-old">
                    <option value="">-- Pilih Mapel --</option>
                  </select>
                </div>
              </div>
              <!-- END SELECT MAPEL -->

              <!-- SELECT MATERI POKOK -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kelas-old">Materi Pokok
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control" id="mapok-old">
                    <option value="">-- Pilih Materi Pokok --</option>
                  </select>
                </div>
              </div>
              <!-- END SELECT MATERI POKOK -->
            </form>
          </div>

          <div class="clearfix">
          </div>

          <div class="col-sm-12" id="sub-materi-old">
            
          </div>


        </div>
      </div>

      <div class="col-sm-6">
        <div class="x_panel">
          <div class="col-sm-12">
            <form id="demo-form3" data-parsley-validate class="form-horizontal form-label-left">

              <!-- SELECT KELAS BARU -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kelas-new">Kelas
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control" id="kelas-new">
                    <option value="">-- Pilih Kelas --</option>
                    <?php
                      foreach($datakelas as $kelas){
                        ?>
                        <option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
                        <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <!-- END SELECT KELAS BARU -->

              <!-- kurikulum -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kurikulum-new">Kurikulum
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control" id="kurikulum-new">
                    <option value="">-- Pilih Kurikulum --</option>
                    <?php
                      foreach($datakurikulum as $kurikulum){
                          ?>
                          <option value="<?php echo $kurikulum->id_kurikulum;?>"><?php echo $kurikulum->nama_kurikulum;?></option>
                          <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <!-- end kurikulum -->

              <!-- mapel -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mapel-new">Mata Pelajaran
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control" id="mapel-new">
                    <option value="">-- Pilih Mapel --</option>
                    <?php
                      foreach($datamapel as $mapel){
                        ?>
                        <option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>
                        <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <!-- end mapel -->

              <!-- bab -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bab-new">Bab
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control" id="bab-new">
                    <option value="">-- Pilih Bab --</option>
                    
                  </select>
                </div>
              </div>
              <!-- end bab -->

              <!-- sub bab -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub-new">Sub Bab
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <select class="form-control" id="sub-new">
                    <option value="">-- Pilih Sub Bab --</option>
                    
                  </select>
                </div>
              </div>
              <!-- end sub bab -->
              
            </form>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>
<!-- /page content -->

