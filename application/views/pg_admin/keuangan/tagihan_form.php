<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
  $this->load->view("pg_admin/html_header.php");
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
        <form method="post" action="<?php echo base_url("pg_admin/keuangan/proses_tagihan");?>">
          <div class="row">
            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>Sekolah</strong>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="col-sm-4">
                <select class="form-control" id="select-provinsi">
                  <option value="">-- Pilih Provinsi --</option>
                  <?php
                    foreach($dataprovinsi as $provinsi){
                      ?>
                      <option value="<?php echo $provinsi->id_provinsi;?>"><?php echo $provinsi->nama_provinsi;?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
              <div class="col-sm-4">
                <select class="form-control" id="select-kota">
                  <option value="">-- Pilih Kota --</option>
                </select>
              </div>
              <div class="col-sm-4">
                <select class="form-control" id="select-sekolah" name="idsekolah" required>
                  <option value="">-- Pilih Sekolah --</option>
                </select>
              </div>
            </div>

            <div class="col-sm-12">
              &nbsp;
            </div>

            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>Person In Charge (Sekolah)</strong>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="col-sm-4">
                <input type="text" name="nama" class="form-control"  placeholder="Nama..." required/>
              </div>
              <div class="col-sm-4">
                <input type="text" name="email" class="form-control" placeholder="Email..." required/>
              </div>
              <div class="col-sm-4">
                <input type="text" name="hp" class="form-control" placeholder="No. HP..." required/>
              </div>
            </div>

            <div class="col-sm-12">
              &nbsp;
            </div>

            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>Paket Aktivasi</strong>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="col-sm-3">
                <input type="radio" name="paket" value="15" class="radio-paket"> 1 Bulan
                <br>
                <input type="radio" name="paket" value="16" class="radio-paket"> 3 Bulan
              </div>
              <div class="col-sm-3">
                <input type="radio" name="paket" value="17" class="radio-paket"> 6 Bulan
                <br>
                <input type="radio" name="paket" value="18" class="radio-paket"> 12 Bulan
              </div>
              <div class="col-sm-3">
                <input type="radio" name="paket" value="26" class="radio-paket"> Event
              </div>
            </div>
            
            <div class="col-sm-12">
              &nbsp;
            </div>

            <div class="col-sm-3" id="text-pilih-event" style="display: none;">
              <div class="col-sm-12">
                <strong>Pilih Event</strong>
              </div>
            </div>
            <div class="col-sm-9" id="col-pilih-event" style="display: none;">
              
            </div>

            <div class="col-sm-12">
              &nbsp;
            </div>

            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>Harga Paket</strong>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="col-sm-6">
                <input type="text" name="hargapaket" id="hargapaket" class="form-control">
              </div>
            </div>

            <div class="col-sm-12">
              &nbsp;
            </div>

            <div class="col-sm-3">
              <div class="col-sm-12">
                <strong>Kelas / Tahun Ajaran</strong>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="col-sm-4">
                <select name="kelas-paralel" class="form-control" id="select-kelas-paralel">
                  <option>-- Pilih Kelas --</option>
                </select>
              </div>
              <div class="col-sm-4">
                <select name="tahun-ajaran" class="form-control" id="select-tahun-ajaran">
                  <option>-- Pilih Tahun Ajaran --</option>
                </select>
              </div>
              <div class="col-sm-4">
                <button type="button" class="btn btn-primary" id="tambah-kelas">Tambah Kelas</button>
              </div>
            </div>

            <div class="col-sm-12">
              &nbsp;
            </div>

            <div class="col-sm-12">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">Kelas / Tahun Ajaran</th>
                    <th class="text-center" style="width: 20px;">Jumlah Siswa</th>
                    <th class="text-center">Sub-Total</th>
                    <th class="text-center" style="width: 20px;">Operasi</th>
                  </tr>
                </thead>
                <tbody id="detail-tagihan">
                  
                </tbody>
              </table>
            </div>

            <div class="col-sm-3">
              <div class="col-sm-12" style="text-align: right;">
                <h4><strong>TOTAL</strong></h4>
                <input type="hidden" id="input-total" name="totalharga" value="0">
              </div>
            </div>
            <div class="col-sm-9">
              <div class="col-sm-6" div="col-total">
                <h4 id="text-total"></h4>
              </div>
              <div class="col-sm-12" style="text-align: right;">
                <input type="submit" class="btn btn-primary" name="submit" value="Buat Tagihan">
              </div>
            </div>
          </div>
		    </form>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php
      $this->load->view("pg_admin/footer");
    ?>

  </div>
</div>

<?php $this->load->view("pg_admin/modal_ajax");?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

<script type="text/javascript">
$(function(){
  $("#select-provinsi").change(function(){
    idprovinsi  = $(this).val();
    $("#detail-tagihan").html("");
    if(idprovinsi !== ""){
      $.ajax({
        type: 'POST',
        url: 'ajax_kota',
        data:{
          'idprovinsi'   : idprovinsi
        },
        beforeSend: function(){
          $("#modal-loader").modal('show');
        },
        success: function(response){
          $("#modal-loader").modal('hide');
          $("#select-kota").html(response);
        }
      })
    }
  })

  $("#select-kota").change(function(){
    idkota  = $(this).val();
    $("#detail-tagihan").html("");
    if(idkota !== ""){
      $.ajax({
        type: 'POST',
        url: 'ajax_sekolah',
        data:{
          'idkota'   : idkota
        },
        beforeSend: function(){
          $("#modal-loader").modal('show');
        },
        success: function(response){
          $("#modal-loader").modal('hide');
          $("#select-sekolah").html(response);
        }
      })
    }
  })

  $(".radio-paket").click(function(){
    idpaket = $(this).val();
    $("#detail-tagihan").html("");
    if(idpaket == 26){
      $("#hargapaket").val("");
      $.ajax({
        type: 'POST',
        url: 'ajax_event',
        beforeSend: function(){
          $("#modal-loader").modal('show');
        },
        success: function(response){
          $("#modal-loader").modal('hide');
          $("#text-pilih-event").css('display', 'block');
          $("#col-pilih-event").css('display', 'block');
          $("#col-pilih-event").html(response);
        }
      })
    }else{
      $.ajax({
        type: 'POST',
        url: 'ajax_harga_paket',
        data:{
          'idpaket'   : idpaket
        },
        beforeSend: function(){
          $("#modal-loader").modal('show');
        },
        success: function(response){
          $("#modal-loader").modal('hide');
          $("#hargapaket").val(response);
        }
      })
      $("#text-pilih-event").css('display', 'none');
      $("#col-pilih-event").html('');
      $("#col-pilih-event").css('display', 'none');
    }
  })

  $("#col-pilih-event").on('change', '#select-event', function(){
    idevent   = $(this).val();
    $("#detail-tagihan").html("");
    if(idevent !== ""){
      $.ajax({
        type: 'POST',
        url: 'ajax_harga_event',
        data:{
          'idevent'   : idevent
        },
        beforeSend: function(){
          $("#modal-loader").modal('show');
        },
        success: function(response){
          $("#modal-loader").modal('hide');
          $("#hargapaket").val(response);
        }
      })
    }else{
      $("#hargapaket").val("");
    }
  })

  $("#select-sekolah").change(function(){
    idsekolah   = $(this).val();
    $("#detail-tagihan").html("");
    if(idsekolah !== ""){
      $.ajax({
        type: 'POST',
        url: 'ajax_kelas_paralel',
        data:{
          'idsekolah'   : idsekolah
        },
        beforeSend: function(){
          $("#modal-loader").modal('show');
        },
        success: function(response){
          $("#modal-loader").modal('hide');
          $("#select-kelas-paralel").html(response);
        }
      })

      $.ajax({
        type: 'POST',
        url: 'ajax_tahun_ajaran',
        data:{
          'idsekolah'   : idsekolah
        },
        beforeSend: function(){
        },
        success: function(response){
          $("#select-tahun-ajaran").html(response);
        }
      })
    }
  })

  $("#tambah-kelas").click(function(){
    idkelasparalel    = $("#select-kelas-paralel").val();
    idtahunajaran     = $("#select-tahun-ajaran").val();
    idpaket           = $("input[name='paket']:checked").val();
    hargasatuan       = $("#hargapaket").val();
    if(idkelasparalel !== "" && idtahunajaran !== "" && idpaket !== undefined){
      //cari dulu apakah kelas tan tahun ajaran sudah ada di detail tagihan
      cekkelastahun       = 'lanjut';
      selectedkelastahun  = idkelasparalel + "-" + idtahunajaran
      $(".input-kelas-tahun").each(function(){
        valkelastahun = $(this).val();
        if(cekkelastahun === "lanjut"){
          if(valkelastahun === selectedkelastahun){
            cekkelastahun = "tidak";
          }
        }
      })

      if(idpaket === '26'){
        tipe    = "event";
        idevent = $("#select-event").val();
      }else{
        tipe    = "reguler";
        idevent = 0;
      }
      if(idevent !== undefined && cekkelastahun === "lanjut"){
        $.ajax({
          type: 'POST',
          url: 'ajax_tambah_kelas',
          data:{
            'tipe'              : tipe,
            'idkelasparalel'    : idkelasparalel,
            'idtahunajaran'     : idtahunajaran,
            'idpaket'           : idpaket,
            'idevent'           : idevent,
            'hargasatuan'       : hargasatuan
          },
          beforeSend: function(){
            $("#modal-loader").modal('show');
          },
          success: function(response){
            $("#modal-loader").modal('hide');
            $("#detail-tagihan").append(response);
            //jumlah total harga
            total = 0;
            $(".input-subtotal").each(function(){
              total += parseInt($(this).val());
            })
            $("#text-total").html(total);
            $("#input-total").val(total);
          }
        })
      }
    }
  })

  $("#detail-tagihan").on('click', '.hapus-detail', function(){
    id = $(this).attr('id');
    $("#tr-detail-" + id).remove();
    //jumlah total harga
    total = 0;
    $(".input-subtotal").each(function(){
      total += parseInt($(this).val());
    })
    $("#text-total").html(total);
    $("#input-total").val(total);
  })
})
</script>

</html>
