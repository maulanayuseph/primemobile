<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <a href="<?php echo site_url('pg_admin/materi/manajemen/tambah') ?>" class="btn btn-success btn-fill pull-right"><i class="fa fa-plus"></i>Tambah Konten</a>
                <h4 class="title">Semua Materi</h4>
                <p class="category">Daftar Sub-materi per Materi Pokok</p>
              </div>
              <div class="content">
                <div class="table-responsive">
                  <table id="my_datatable" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Materi Pokok</th>
                        <th>Materi Pembelajaran</th>
                        <th class="text-center">Konten</th>
                        <th class="text-center">Daftar Soal</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no = 1; 
                        foreach ($table_data as $item) 
                        {
                      ?>
                        <tr>
                          <td><?php echo $no;?></td>
                          <td><?php echo $item->alias_kelas?></td>
                          <td><?php echo $item->nama_mapel?></td>
                          <td><?php echo $item->nama_materi_pokok?></td>
                          <td>
                            <?php echo $item->nama_sub_materi?>
                            <br>
                            <div class="pull-right">
                              <input type="checkbox" name="status_materi_<?php echo $item->id_sub_materi;?>" class="checkbox-switch" data-size="mini" data-on-text="Free" data-off-text="Premium" data-on-color="success" data-off-color="warning" <?php echo $item->status_materi ? '' : "checked"?> >
                              <!-- <a href="<?php echo site_url() . "pg_admin/materi/preview_konten/$item->id_sub_materi";?>" target="_blank">
                                <em><?php echo base_url() . 'pg... '; ?></em>
                              </a> -->
                            </div>
                          </td>
                          <td class="text-center">
                            <?php 
                              if ($item->kategori==1) { echo "<span class='glyphicon glyphicon-file'></span> Teks"; } 
                              elseif ($item->kategori==2) { echo "<span class='glyphicon glyphicon-play-circle'></span> Video"; } 
                              elseif ($item->kategori==3) { echo "<span class='glyphicon glyphicon-star'></span> Soal "; } 
                            ?>
                          </td>
                          <td class="text-center">
                            <?php if ($item->kategori==3) {  
                              echo "<a href='".base_url()."pg_admin/latihansoal/detail/".$item->id_sub_materi ."' class='btn btn-sm btn-fill btn-info'>
                                  Lihat <span class='glyphicon glyphicon-arrow-right'></span>
                                </a>";
                              } else { echo "<i class='text-danger glyphicon glyphicon-remove'></i>"; } ?>
                          </td>
                          <td class="text-center">
                            <div class="button-group">
                              <a href="<?php echo $form_action . 'manajemen/ubah?id=' . $item->id_sub_materi ?>" class="btn btn-warning btn-xs" title="Ubah"><i class="glyphicon glyphicon-pencil"></i></a>
                              <button type="button" class="btn btn-danger btn-xs" title="Hapus" data-number="<?php echo $no?>" value="<?php echo $item->id_sub_materi?>" data-toggle="modal" data-target="#deleteRow_modal"><i class="glyphicon glyphicon-remove"></i></button>
                            </div>
                          </td>
                        </tr>
                      <?php
                        $no++;
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div>
</div>

<?php include "alert_modal.php"; ?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<!--<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script> -->

<!-- Bootstrap Switch Plugin -->
<script src="<?php echo base_url('assets/js/plugins/bootstrap-switch/bootstrap-switch.min.js');?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(".checkbox-switch").bootstrapSwitch();
  
    $(".checkbox-switch").on('switchChange.bootstrapSwitch', function(e, state){
      var target = e.length ? e : e.target;
      var targetName = target.name;
      var val = state; // true || false
      console.log('targetName: ' + targetName + ', val: ' + val);
      ajaxStatusMateri(targetName, val)
    });
  });
</script>

<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
 
<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>


<!-- JS Function for this Modal -->
<script type="text/javascript">
  $('#deleteRow_modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var rownumber = button.data('number') // Extract info from data-* attributes
    var id = button.attr('value')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.number').text("#" + rownumber + "?")
    modal.find('input[name=hidden_row_id]').val(id)
  })
</script>


<script type="text/javascript">
  function ajaxStatusMateri(targetName, val)
  {
      $.post("<?=base_url('pg_admin/materi/ajax_status_materi');?>",
      {
        target_name: targetName, state: val
      },
      function(data, status){
          console.log("\nStatus: " + status + "\nData: " + data);
      });
  }
</script>

</html>
