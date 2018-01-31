$(function(){
  $("#kontrakstartdate").datepicker({ dateFormat: 'yy-mm-dd' });
  $("#kontrakenddate").datepicker({ dateFormat: 'yy-mm-dd' });
  $("#select-provinsi").change(function(){
    idprovinsi  = $(this).val();
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
        },
        error: function(){
          $("#modal-loader").modal('hide');
          $('#modal-loader').on('hidden.bs.modal', function (e) {
            $("#modal-error").modal('show');
          })
        }
      })
    }
  })

  $("#select-kota").change(function(){
    idkota  = $(this).val();
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
        },
        error: function(){
          $("#modal-loader").modal('hide');
          $('#modal-loader').on('hidden.bs.modal', function (e) {
            $("#modal-error").modal('show');
          })
        }
      })
    }
  })

  $("#select-sekolah").change(function(){
    idsekolah = $(this).val();
    if(idsekolah !== ""){
      $.ajax({
        type: 'POST',
        url: 'ajax_akun_sekolah',
        data:{
          'idsekolah'   : idsekolah
        },
        beforeSend: function(){
          $("#modal-loader").modal('show');
        },
        success: function(response){
          $("#modal-loader").modal('hide');
          $("#select-pic-sekolah").html(response);
        },
        error: function(){
          $("#modal-loader").modal('hide');
          $('#modal-loader').on('hidden.bs.modal', function (e) {
            $("#modal-error").modal('show');
          })
        }
      })

      $.ajax({
        type: 'POST',
        url: 'ajax_kelas_by_jenjang',
        data:{
          'idsekolah'   : idsekolah
        },
        success: function(response){
          $("#select-kelas").html(response);
        },
        error: function(){
          $("#modal-error").modal('show');
        }
      })

      $.ajax({
        type: 'POST',
        url: 'ajax_tahun_ajaran_by_sekolah',
        data:{
          'idsekolah'   : idsekolah
        },
        success: function(response){
          $("#select-tahun-ajaran").html(response);
        },
        error: function(){
          $("#modal-error").modal('show');
        }
      })

      $.ajax({
        type: 'POST',
        url: 'ajax_detail_kelas_all',
        data:{
          'idsekolah'   : idsekolah
        },
        success: function(response){
          $("#list-detail-kontrak").html(response);
        },
        error: function(){
          $("#modal-error").modal('show');
        }
      })

      
    }
  })

  $("#select-tahun-ajaran").change(function(){
    idsekolah     = $("#select-sekolah").val();
    idtahunajaran = $(this).val();
    $.ajax({
      type: 'POST',
      url: 'ajax_detail_kelas',
      data:{
        'idsekolah'     : idsekolah,
        'idtahunajaran' : idtahunajaran
      },
      success: function(response){
        $("#list-detail-kontrak").html(response);
      },
      error: function(){
        $("#modal-error").modal('show');
      }
    })
  })

  

  $("#list-detail-kontrak").on('keyup', '.input-harga-kelas', function(){
    rawid             = $(this).attr("id");
    idsplit           = rawid.split("-");
    idkelas           = idsplit[1];
    idtahunajaran     = idsplit[2];
    harga             = parseInt($(this).val());
    pembagi           = parseInt($("#tipe-harga").val());

    hitung_harga_periode(harga, pembagi, idkelas, idtahunajaran);
    console.log(harga + "-" + pembagi + "-" + idkelas + "-"+ idtahunajaran);
    
  })

  function hitung_harga_periode(harga, pembagi, idkelas, idtahunajaran){
    if(isNaN(pembagi)){
      pembagi = 0;
    }
    
    if(pembagi !== 0){
      hasilbagi = harga / pembagi;
      periode = [];
      hitungperiode = [];
      for(i = 1; i < 5; i++){
        if(i == 1){
          periode[i] = 1;
        }else if(i == 2){
          periode[i] = 3;
        }else if(i == 3){
          periode[i] = 6;
        }else if(i == 4){
          periode[i] = 12;
        }
        
        if(periode[i] == pembagi || periode[i] > pembagi){
          hitungperiode[i] = hasilbagi * periode[i];
        }else{
          hitungperiode[i] = hasilbagi * periode[i];
          if(hitungperiode[i] < 11){
            hitungperiode[i] = Math.round(hitungperiode[i]);
          }else if(hitungperiode[i] < 100){
            hitungperiode[i] = Math.round(hitungperiode[i]/1)*1;
          }else if(hitungperiode[i] < 1000){
            hitungperiode[i] = Math.round(hitungperiode[i]/10)*10;
          }else if(hitungperiode[i] < 10000){
            hitungperiode[i] = Math.round(hitungperiode[i]/100)*100;
          }else if(hitungperiode[i] < 100000){
            hitungperiode[i] = Math.round(hitungperiode[i]/1000)*1000;
          }else if(hitungperiode[i] < 1000000){
            hitungperiode[i] = Math.round(hitungperiode[i]/10000)*10000;
          }
          hitungperiode[i] = hitungperiode[i] + 2500;
        }
        console.log(hitungperiode[i]);
      }
      if(isNaN(hitungperiode[1])){
        $("#detail-tagihan-" + idkelas + "-" + idtahunajaran).html("");

        $("#periode-1-" + idkelas).val("");
        $("#periode-3-" + idkelas).val("");
        $("#periode-6-" + idkelas).val("");
        $("#periode-12-" + idkelas).val("");
      }else{
        $("#detail-tagihan-" + idkelas + "-" + idtahunajaran).html("<div class='col-sm-6'>1 bulan</div><div class='col-sm-6' style='text-align: right;'>" + hitungperiode[1] + "</div><div class='col-sm-6'>3 bulan</div><div class='col-sm-6' style='text-align: right;'>" + hitungperiode[2] + "</div><div class='col-sm-6'>6 bulan</div><div class='col-sm-6' style='text-align: right;'>" + hitungperiode[3] + "</div><div class='col-sm-6'>12 bulan</div><div class='col-sm-6' style='text-align: right;'>" + hitungperiode[4] + "</div>");

        $("#periode-1-" + idkelas).val(hitungperiode[1]);
        $("#periode-3-" + idkelas).val(hitungperiode[2]);
        $("#periode-6-" + idkelas).val(hitungperiode[3]);
        $("#periode-12-" + idkelas).val(hitungperiode[4]);
      }
    }
  }

  $("#tipe-harga").change(function(){
    pembagi  = parseInt($(this).val());
    $(".input-harga-kelas").each(function(){
      rawid             = $(this).attr("id");
      idsplit           = rawid.split("-");
      idkelas           = idsplit[1];
      idtahunajaran     = idsplit[2];
      harga             = parseInt($(this).val());

      hitung_harga_periode(harga, pembagi, idkelas, idtahunajaran);
      console.log(harga + "-" + pembagi + "-" + idkelas + "-"+ idtahunajaran);
    })
  })

})