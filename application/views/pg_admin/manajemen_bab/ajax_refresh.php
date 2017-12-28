<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php
foreach($databab as $bab){
?>
<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="headingOne">
    <div class="row">
      <div class="col-sm-6">
        <h4 class="panel-title">
          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $bab->id_materi_pokok;?>" aria-expanded="true" aria-controls="collapseOne">
            <?php echo $bab->nama_materi_pokok;?>
          </a>
        </h4>
      </div>
      <div class="col-sm-6" style="text-align: right;">
        <button class="btn btn-sm btn-primary tambah-sub-bab" id="tambah-sub-<?php echo $bab->id_materi_pokok;?>" data-toggle="modal" data-target="#mainmodal">
          <i class="fa fa-plus" aria-hidden="true"></i>
        </button>

        <button class="btn btn-sm btn-warning edit-bab" id="edit-bab-<?php echo $bab->id_materi_pokok;?>" data-toggle="modal" data-target="#mainmodal"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        <button class="btn btn-sm btn-danger hapus-bab" id="hapus-bab-<?php echo $bab->id_materi_pokok;?>"><i class="fa fa-remove" aria-hidden="true"></i></button>
      </div>
    </div>
  </div>
  <div id="collapse<?php echo $bab->id_materi_pokok;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
    <div class="panel-body">
      <table class="table table-responsive table-bordered table-striped">
        <thead>
            <tr>
              <th style="width: 10px;" class="text-center">No.</th>
              <th class="text-center">Sub Bab</th>
              <th class="text-center">Operasi</th>
            </tr>
        </thead>
        <tbody>
            <?php
              //cari sub bab
              $datasub = $this->model_manajemen_bab->fetch_sub_bab_by_bab($bab->id_materi_pokok);
              if($datasub !== null){
                $x = 1;
                foreach($datasub as $sub){
                  ?>
                  <tr>
                    <td><?php echo $x;?></td>
                    <td>
                      <?php echo $sub->nama_sub_bab;?>
                    </td>
                    <td class="text-center">
                      <button class="btn btn-sm btn-warning edit-sub" id="edit-sub-<?php echo $sub->id_sub_bab;?>" data-toggle="modal" data-target="#mainmodal"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                      <button class="btn btn-sm btn-danger hapus-sub" id="hapus-sub-<?php echo $sub->id_sub_bab;?>"><i class="fa fa-remove" aria-hidden="true"></i></button>
                    </td>
                  </tr>
                  <?php
                  $x++;
                }
              }
            ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php
}
?>
</div>

<script type="text/javascript">
$(function(){
  $(".edit-bab").click(function(){
    rawid   = $(this).attr("id");
    idsplit = rawid.split("-");
    idbab   = idsplit[2];

    $("#mainmodaltitle").html("Edit Bab");
    $("#mainmodalcontent").load("manajemen_bab/edit/" + idbab);
  })
  $(".hapus-bab").click(function(){
    rawid   = $(this).attr("id");
    idsplit = rawid.split("-");
    idbab   = idsplit[2];

    if(confirm("Apakah anda yakin untuk menghapus bab? Bab yang terhapus tidak bisa dikembalikan lagi")){
      $.ajax({
        type: 'POST',
        url: 'manajemen_bab/proses_hapus',
        data:{
          'idbab'   : idbab
        }
      });
    }
  })

  $(".tambah-sub-bab").click(function(){
    rawid   = $(this).attr("id");
    idsplit = rawid.split("-");
    idbab   = idsplit[2];
    $("#mainmodaltitle").html("Tambah Sub Bab");
    $("#mainmodalcontent").load("manajemen_bab/tambah_sub_bab/" + idbab);
  })

  $(".edit-sub").click(function(){
    rawid   = $(this).attr("id");
    idsplit = rawid.split("-");
    idsub   = idsplit[2];

    $("#mainmodaltitle").html("Edit Sub Bab");
    $("#mainmodalcontent").load("manajemen_bab/edit_sub_bab/" + idsub);
  })

  $(".hapus-sub").click(function(){
    rawid   = $(this).attr("id");
    idsplit = rawid.split("-");
    idsub   = idsplit[2];
    if(confirm("Apakah anda yakin untuk menghapus sub bab? Sub bab yang terhapus tidak bisa dikembalikan lagi")){
      $.ajax({
        type: 'POST',
        url: 'manajemen_bab/proses_hapus_sub_bab',
        data:{
          'idsub'   : idsub
        }
      });
    }
  })
})
</script>

  
