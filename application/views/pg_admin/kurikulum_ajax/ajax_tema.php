<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php
foreach($datatema as $tema){
?>
<div class="panel panel-default">
  <div class="panel-heading" role="tab" id="headingOne">
    <div class="row">
      <div class="col-sm-6">
        <h4 class="panel-title">
          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $tema->id_tema;?>" aria-expanded="true" aria-controls="collapseOne">
            <?php echo $tema->tema;?>
          </a>
        </h4>
      </div>
      <div class="col-sm-6" style="text-align: right;">
        <button class="btn btn-sm btn-primary tambah-sub-tema" id="tambah-sub-<?php echo $tema->id_tema;?>" data-toggle="modal" data-target="#modal-kurikulum">
          <i class="fa fa-plus" aria-hidden="true"></i>
        </button>

        <button class="btn btn-sm btn-warning edit-tema" id="edit-tema-<?php echo $tema->id_tema;?>" data-toggle="modal" data-target="#modal-kurikulum"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        <button class="btn btn-sm btn-danger hapus-tema" id="hapus-tema-<?php echo $tema->id_tema;?>"><i class="fa fa-remove" aria-hidden="true"></i></button>
      </div>
    </div>
  </div>
  <div id="collapse<?php echo $tema->id_tema;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
    <div class="panel-body">
      <table class="table table-responsive table-bordered table-striped">
        <thead>
            <tr>
              <th style="width: 10px;" class="text-center">No.</th>
              <th class="text-center">Sub Tema</th>
              <th class="text-center">Operasi</th>
            </tr>
        </thead>
        <tbody>
            <?php
              //cari sub tema
              $datasub = $this->model_kurikulum->fetch_sub_tema_by_tema($tema->id_tema);
              if($datasub !== null){
                $x = 1;
                foreach($datasub as $sub){
                  ?>
                  <tr>
                    <td><?php echo $x;?></td>
                    <td>
                      <?php echo $sub->sub_tema;?>
                    </td>
                    <td class="text-center">
                      <button class="btn btn-sm btn-warning edit-sub-tema" id="edit-syb-<?php echo $sub->id_sub_tema;?>" data-toggle="modal" data-target="#modal-kurikulum"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                      <button class="btn btn-sm btn-danger hapus-sub-tema" id="hapus-sub-<?php echo $sub->id_sub_tema;?>"><i class="fa fa-remove" aria-hidden="true"></i></button>
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
  $(".edit-tema").click(function(){
    rawid   = $(this).attr("id");
    idsplit = rawid.split("-");
    idtema  = idsplit[2];
    $("#konten-modal-ajax").load("kurikulum/ajax_edit_tema/" + idtema);
  })
  $(".hapus-tema").click(function(){
    if(confirm("Apakah anda yakin untuk menghapus tema ?")){
      rawid   = $(this).attr("id");
      idsplit = rawid.split("-");
      idtema  = idsplit[2];
      $.ajax({
        type: 'POST',
        url: 'kurikulum/proses_hapus_tema',
        data:{
          'idtema'  : idtema
        }
      });
    }
  })
  $(".tambah-sub-tema").click(function(){
    rawid   = $(this).attr("id");
    idsplit = rawid.split("-");
    idtema  = idsplit[2];
    $("#konten-modal-ajax").load("kurikulum/tambah_sub_tema/" + idtema);
  })

  $(".edit-sub-tema").click(function(){
    rawid   = $(this).attr("id");
    idsplit = rawid.split("-");
    idsub  = idsplit[2];
    $("#konten-modal-ajax").load("kurikulum/edit_sub_tema/" + idsub);
  })

  $(".hapus-sub-tema").click(function(){
    rawid   = $(this).attr("id");
    idsplit = rawid.split("-");
    idsub  = idsplit[2];
    if(confirm("Apakah anda yakin untuk menghapus sub tema ?")){
      $.ajax({
        type: 'POST',
        url: 'kurikulum/proses_hapus_sub_tema',
        data:{
          'idsub'  : idsub
        }
      });
    }
  })
})
</script>

  
