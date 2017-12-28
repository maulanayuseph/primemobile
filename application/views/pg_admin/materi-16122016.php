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
                  <table id="my_materi_datatable" class="table table-striped table-hover">
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
                        <th>ID</th>
                        <th>Status</th>
                        
                      </tr>
                    </thead>
                    <tbody>
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

  function setStatusMateri() {
    $(".checkbox-switch").on('switchChange.bootstrapSwitch', function(e, state){
      var target = e.length ? e : e.target;
      var targetName = target.name;
      var val = state; // true || false
      console.log('targetName: ' + targetName + ', val: ' + val);

      ajaxStatusMateri(targetName, val)
    });
  }
</script>

<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

<script type="text/javascript" language="javascript" >
  $(document).ready(function() {
    var dataTable = $('#my_materi_datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax":{
        url :"<?php echo base_url('pg_admin/materi/ajax_datatables')?>", // json datasource
        type: "post",  // method  , by default get
        error: function(){  // error handling
            $(".my_materi_datatable_error").html("");
            $("#my_materi_datatable").append('<tbody class="my_materi_datatable_grid_error"><tr><th colspan="3">Tidak ada data</th></tr></tbody>');
            $("#my_materi_datatable_processing").css("display","none");
        }
      },
      "columns": [
        { "data": "no" },
        { "data": "alias_kelas" },
        { "data": "nama_mapel" },
        { "data": "nama_materi_pokok" },
        { "data": "nama_sub_materi" },
        { "data": "kategori" },
        { "data": "daftar_soal" },
        { "data": "aksi" },
        { "data": "id_sub_materi" },
        { "data": "status_materi" }
      ],
      "columnDefs": [
        {
            "targets": 4,
            "data": "nama_sub_materi",
            "render": function ( data, type, row ) {
              return data +'<br> <div class="pull-right">'
                +'<input type="checkbox" name="status_materi_'+row['id_sub_materi']+'" class="checkbox-switch" data-size="mini" data-on-text="Free" data-off-text="Premium" data-on-color="success" data-off-color="warning" '
                + (row['status_materi']==0 ? "checked" : "") + '> </div>'
            }
        },
        {
            "targets": 5,
            "data": "kategori",
            "render": function ( data, type, row ) {
              var konten = "<span class='text-center' style='display:block;'>"; 
              if (data == 1) {
                konten += "<span class='glyphicon glyphicon-file'></span> Teks";
              }
              else if (data == 2) {
                konten += "<span class='glyphicon glyphicon-play-circle'></span> Video";
              }
              else if (data == 3) {
                konten += "<span class='glyphicon glyphicon-star'></span> Soal";
              }
              konten += "</span>";
              return konten;
            }
        },
        {
            "targets": 6,
            "data": "kategori",
            "render": function ( data, type, row ) {
              var konten; 
              if (row['kategori'] == 3) {
                konten = "<span class='text-center' style='display:block;'>"
                            +"<a href='"+ data +"pg_admin/latihansoal/detail/" + row['id_sub_materi'] + "' class='btn btn-sm btn-fill btn-info'>"
                            +"Lihat <span class='glyphicon glyphicon-arrow-right'></span>"
                            +"</a></span>";
              }
              else { 
                konten = "<span class='text-center' style='display:block;'><i class='text-danger glyphicon glyphicon-remove'></i></span>"; 
              }

              return konten;
            }
        },
        {
            "targets": 7,
            "data": "aksi",
            "render": function ( data, type, row ) {
              var konten; 
              konten = "<span class='text-center' style='display:block;'>"
                +'<div class="button-group">'
                +'<a href="' + data + 'manajemen/ubah?id=' + row['id_sub_materi'] + '" class="btn btn-warning btn-xs" title="Ubah"><i class="glyphicon glyphicon-pencil"></i></a>'
                +'<button type="button" class="btn btn-danger btn-xs" title="Hapus" data-number=' + row['no'] + ' value="'+ row['id_sub_materi'] +'" data-toggle="modal" data-target="#deleteRow_modal"><i class="glyphicon glyphicon-remove"></i></button>'
                +'</div></span>'

              return konten;
            }
        },
        { "visible": false,  "targets": [ 8, 9 ] }
        ],
    });
    
    //Initialize Bootstrap Switch after Datatables completed drawing
    $("#my_materi_datatable").on('draw.dt', function(e){
      $(".checkbox-switch").bootstrapSwitch();
      setStatusMateri();
    });
    
  } );
</script>

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

</html>
