<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
  $this->load->view("pg_admin/html_header.php");
?>

<?php
  if($formaction == base_url("pg_admin/kontrak/proses_edit")){
    $disable = "disabled";
  }else{
    $disable = "";
  }
?>

<div class="wrapper">
  <?php
    $this->load->view("pg_admin/sidebar_keu");
  ?>

  <div class="main-panel">
    <?php
      $this->load->view("pg_admin/navbar");
    ?>
    
    <div class="content">      
      <div class="container-fluid">
	  
        <div class="row">
          <form method="post" action="<?php echo $formaction;?>">
            <!-- SEKOLAH -->
            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>Sekolah</strong>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="col-sm-4">
                <select class="form-control" id="select-provinsi" <?php echo $disable;?>>
                  <option value="">-- Pilih Provinsi --</option>
                  <?php
                    foreach($dataprovinsi as $provinsi){
                      if(isset($kontrak)){
                        if($provinsi->id_provinsi == $kontrak->id_provinsi){
                          $selected = "selected";
                        }
                      }else{
                        $selected = "";
                      }
                      ?>
                      <option value="<?php echo $provinsi->id_provinsi;?>" <?php echo $selected;?>><?php echo $provinsi->nama_provinsi;?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
              <div class="col-sm-4">
                <select class="form-control" id="select-kota" <?php echo $disable;?>>
                  <option value="">-- Pilih Kota --</option>
                  <?php
                    if(isset($kontrak)){
                      ?>
                      <option value="<?php echo $kontrak->id_kota;?>" selected><?php echo $kontrak->nama_kota;?></option>
                      <?PHP
                    }
                  ?>
                </select>
              </div>
              <div class="col-sm-4">
                <select class="form-control" id="select-sekolah" name="idsekolah" required <?php echo $disable;?>>
                  <option value="">-- Pilih Sekolah --</option>
                  <?php
                    if(isset($kontrak)){
                      ?>
                      <option value="<?php echo $kontrak->id_sekolah;?>" selected><?php echo $kontrak->nama_sekolah;?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>
            <!-- end sekolah -->

            <div class="col-sm-12">
              &nbsp;
            </div>

            <!-- tanggal kontrak -->
            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>Tanggal Kontrak</strong>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="col-sm-12">
                <?php
                  if(isset($kontrak)){
                    $date = $kontrak->date;
                  }else{
                    $date = "";
                  }
                ?>
                <input type="text" id="kontrakstartdate" name="kontrakdate" class="form-control" value="<?php echo $date;?>" required/>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="col-sm-12">
                <strong>Sampai Dengan </strong>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="col-sm-12">
                <?php
                  if(isset($kontrak)){
                    $enddate = $kontrak->end_date;
                  }else{
                    $enddate = "";
                  }
                ?>
                <input type="text" id="kontrakenddate" name="kontrakenddate" class="form-control" value="<?php echo $enddate;?>" required/>
              </div>
            </div>
            <!--end tanggal kontrak -->

            <div class="col-sm-12">
              &nbsp;
            </div>

            <!-- PIC -->
            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>PIC Sekolah </strong>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="col-sm-12">
                <select class="form-control" id="select-pic-sekolah" name="picsekolah" required>
                  <option value="">--- Pilih PIC Sekolah ---</option>
                  <?php
                    if(isset($kontrak)){
                      foreach($datapicsekolah as $pic){
                        if($pic->id_login_sekolah == $kontrak->id_pic_sekolah){
                          $selected = "selected";
                        }else{
                          $selected = "";
                        }
                        ?>
                        <option value="<?php echo $pic->id_login_sekolah;?>" <?php echo $selected;?>><?php echo $pic->nama;?></option>
                        <?php
                      }
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-sm-2">
              <div class="col-sm-12">
                <strong>PIC Prime Mobile </strong>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="col-sm-12">
                <select class="form-control" name="picpm" required>
                  <option value=''>-- Pilih PIC PM --</option>
                  <?php
                    foreach($datapa as $pa){
                      if(isset($kontrak)){
                        if($kontrak->pic_pm == $pa->id_adm){
                          $selected = "selected";
                        }else{
                          $selected = "";
                        }
                      }else{
                        $selected = "";
                      }
                      ?>
                      <option value="<?php echo $pa->id_adm;?>" <?php echo $selected;?>><?php echo $pa->nama;?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-sm-12">
              &nbsp;
            </div>

            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>PIC Dealer </strong>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="col-sm-12">
                <select class="form-control" name="picdealer" required>
                  <option value=''>-- Pilih PIC Dealer --</option>
                  <?php
                    foreach($datadealer as $dealer){
                      if(isset($kontrak)){
                        if($kontrak->id_dealer == $dealer->id_dealer){
                          $selected = "selected";
                        }else{
                          $selected = "";
                        }
                      }else{
                        $selected = "";
                      }
                      ?>
                      <option value="<?php echo $dealer->id_dealer;?>" <?php echo $selected;?>><?php echo $dealer->nama_dealer;?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-sm-2">
              <div class="col-sm-12">
                <strong>PIC Referral </strong>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="col-sm-12">
                <select class="form-control" name="picreferral">
                  <option value="">-- Pilih Referral --</option>
                  <?php
                    foreach($datareferral as $referral){
                      if(isset($kontrak)){
                        if($kontrak->id_referral == $referral->id_referral){
                          $selected = "selected";
                        }else{
                          $selected = "";
                        }
                      }else{
                        $selected = "";
                      }
                      ?>
                      <option value="<?php echo $referral->id_referral;?>" <?php echo $selected;?>><?php echo $referral->nama_referral;?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>
            <!-- end PIC -->
            
            <div class="col-sm-12">
              &nbsp;
            </div>
            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>Cashback Sekolah (%)</strong>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="col-sm-12">
                <?php
                  if(isset($kontrak)){
                    $cbsekolah = $kontrak->cb_sekolah;
                  }else{
                    $cbsekolah = 0;
                  }
                ?>
                <input type="number" name="cbsekolah" class="form-control" value="<?php echo $cbsekolah;?>" required>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>Cashback Dealer (%)</strong>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="col-sm-12">
                <?php
                  if(isset($kontrak)){
                    $cbdealer = $kontrak->cb_dealer;
                  }else{
                    $cbdealer = 0;
                  }
                ?>
                <input type="number" name="cbdealer" class="form-control" value="<?php echo $cbdealer;?>" required>
              </div>
            </div>
            <div class="col-sm-12">
              &nbsp;
            </div>
            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>Cashback Referral (%)</strong>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="col-sm-12">
                <?php
                  if(isset($kontrak)){
                    $cbreferral = $kontrak->cb_referral;
                  }else{
                    $cbreferral = 0;
                  }
                ?>
                <input type="number" name="cbreferral" class="form-control" value="<?php echo $cbreferral;?>" required>
              </div>
            </div>

            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>Tipe Pembayaran</strong>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="col-sm-12">
                <select class="form-control tipe-harga" name="tipeharga" id="tipe-harga" required>
                  <option value=''>-- Pilih Tipe Harga --</option>
                  <option value='1' <?php
                  if(isset($kontrak)){
                    if($kontrak->tipe_harga == 1){
                      echo "selected";
                    }
                  }
                  ?>>1 Bulan</option>
                  <option value='3' <?php
                  if(isset($kontrak)){
                    if($kontrak->tipe_harga == 3){
                      echo "selected";
                    }
                  }
                  ?>>3 Bulan</option>
                  <option value='6' <?php
                  if(isset($kontrak)){
                    if($kontrak->tipe_harga == 6){
                      echo "selected";
                    }
                  }
                  ?>>6 Bulan</option>
                  <option value='12' <?php
                  if(isset($kontrak)){
                    if($kontrak->tipe_harga == 12){
                      echo "selected";
                    }
                  }
                  ?>>12 Bulan</option>
                </select>
              </div>
            </div>
            
            <div class="col-sm-12">
              &nbsp;
            </div>
            
            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>Periode Penagihan</strong>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="col-sm-12">
                <select class="form-control tipe-harga" name="periodetagihan" id="tipe-harga" required>
                  <option value=''>-- Pilih Periode Tagihan --</option>
                  <option value='1' <?php
                  if(isset($kontrak)){
                    if($kontrak->periode_tagihan == 1){
                      echo "selected";
                    }
                  }
                  ?>>1 Bulan</option>
                  <option value='3' <?php
                  if(isset($kontrak)){
                    if($kontrak->periode_tagihan == 3){
                      echo "selected";
                    }
                  }
                  ?>>3 Bulan</option>
                  <option value='6' <?php
                  if(isset($kontrak)){
                    if($kontrak->periode_tagihan == 6){
                      echo "selected";
                    }
                  }
                  ?>>6 Bulan</option>
                  <option value='12' <?php
                  if(isset($kontrak)){
                    if($kontrak->periode_tagihan == 12){
                      echo "selected";
                    }
                  }
                  ?>>12 Bulan</option>
                </select>
              </div>
            </div>

            <!--
            <div class="col-sm-12">
              &nbsp;
            </div>
            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>Tahun Ajaran</strong>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="col-sm-12">
                <select class="form-control" id="select-tahun-ajaran">
                  <option>--- Pilih Tahun Ajaran --</option>
                </select>
              </div>
            </div>
            -->
            <div class="col-sm-12">
              &nbsp;
            </div>

            <div class="col-sm-12">
              <table class="table table-bordered table-striped">
                <thead>
                  <th class="text-center">Kelas / Tahun Ajaran</th>
                  <th class="text-center">Jumlah Siswa</th>
                  <th class="text-center">Harga</th>
                  <th class="text-center">Periode Penagihan</th>
                </thead>
                <tbody id="list-detail-kontrak">
                  <?php
                    if(isset($kontrak)){
                      foreach($datakelas as $kelas){

                        $datakelasparalel = $this->model_kontrak->fetch_kelas_paralel_by_kelas_and_sekolah($kontrak->id_sekolah, $kelas->id_kelas);

                        $jumlahsiswa[$kelas->id_kelas] = 0;
                        foreach($datatahunajaran as $tahun){
                          foreach($datakelasparalel as $kelaspar){
                          //hitung siswa by kelas paralel and tahun ajaran
                            $jumsis = $this->model_kontrak->jumlah_siswa_psep($kelaspar->id_kelas_paralel, $tahun->id_tahun_ajaran);

                            $jumlahsiswa[$kelas->id_kelas] += $jumsis;
                          }
                        }
                      }
                      foreach($datakelas as $kelas){
                        ?>
                        <tr>
                          <td>
                            <strong><?php echo $kelas->alias_kelas;?></strong>
                            <input type="hidden" name="kelas-tahun" class="input-kelas-tahun" value="<?php echo $kelas->id_kelas;?>-0">
                          </td>
                          <td class="text-center">
                            <?php
                              echo $jumlahsiswa[$kelas->id_kelas];
                            ?>
                          </td>
                          <td>
                            <?php
                              if(isset($kontrak)){
                                foreach($detailkontrak as $detail){
                                  if($detail->id_kelas == $kelas->id_kelas){
                                    $hargakelas[$kelas->id_kelas] = $detail->harga;
                                    $periode1[$kelas->id_kelas] = $detail->periode_1;
                                    $periode3[$kelas->id_kelas] = $detail->periode_3;
                                    $periode6[$kelas->id_kelas] = $detail->periode_6;
                                    $periode12[$kelas->id_kelas] = $detail->periode_12;
                                  }
                                }
                              }

                              if(!isset($hargakelas[$kelas->id_kelas])){
                                $hargakelas[$kelas->id_kelas] = "";
                                $periode1[$kelas->id_kelas] = "";
                                $periode3[$kelas->id_kelas] = "";
                                $periode6[$kelas->id_kelas] = "";
                                $periode12[$kelas->id_kelas] = "";
                              }
                            ?>
                            <input type="number" name="harga-<?php echo $kelas->id_kelas;?>" class="form-control input-harga-kelas" id="harga-<?php echo $kelas->id_kelas;?>-0" value="<?php echo $hargakelas[$kelas->id_kelas];?>">
                            

                            <input type="hidden" name="periode-1-<?php echo $kelas->id_kelas;?>" id="periode-1-<?php echo $kelas->id_kelas;?>" value="<?php echo $periode1[$kelas->id_kelas];?>">
                            <input type="hidden" name="periode-3-<?php echo $kelas->id_kelas;?>" id="periode-3-<?php echo $kelas->id_kelas;?>" value="<?php echo $periode3[$kelas->id_kelas];?>">
                            <input type="hidden" name="periode-6-<?php echo $kelas->id_kelas;?>" id="periode-6-<?php echo $kelas->id_kelas;?>" value="<?php echo $periode6[$kelas->id_kelas];?>">
                            <input type="hidden" name="periode-12-<?php echo $kelas->id_kelas;?>" id="periode-12-<?php echo $kelas->id_kelas;?>" value="<?php echo $periode12[$kelas->id_kelas];?>">
                          </td>
                          <td id="detail-tagihan-<?php echo $kelas->id_kelas;?>-0" style="width: 300px;">
                            <?php
                              if($hargakelas[$kelas->id_kelas] !== ""){
                                ?>
                                <div class='col-sm-6'>1 bulan</div><div class='col-sm-6' style='text-align: right;'><?php echo $periode1[$kelas->id_kelas];?></div>
                                <div class='col-sm-6'>3 bulan</div><div class='col-sm-6' style='text-align: right;'><?php echo $periode3[$kelas->id_kelas];?></div>
                                <div class='col-sm-6'>6 bulan</div><div class='col-sm-6' style='text-align: right;'><?php echo $periode6[$kelas->id_kelas];?></div>
                                <div class='col-sm-6'>12 bulan</div><div class='col-sm-6' style='text-align: right;'><?php echo $periode12[$kelas->id_kelas];?></div>
                                <?php
                              }
                            ?>
                          </td>
                        </tr>
                        <?php
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>

            <div class="col-sm-12" style="text-align: right;">
              <?php
                if(isset($kontrak)){
                  $submit = "Ubah Kontrak";
                  ?>
                  <input type="hidden" name="idkontrak" value="<?php echo $kontrak->id_kontrak;?>">
                  <?php
                }else{
                  $submit = "Buat Kontrak";
                }
              ?>
              <input type="submit" name="submit" class="btn btn-xs btn-danger" value="<?php echo $submit;?>" />
            </div>

          </form>
        </div>
		
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php
      $this->load->view("pg_admin/footer");
    ?>

  </div>
</div>
<?php $this->load->view("pg_admin/modal_ajax");?>
<!-- END MODAL ERROR AJAX -->
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!-- PLUGINS FUNCTION -->
<!-- Nestable plugin  -->
 <!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/kontrakform.js');?>"></script>
</html>
