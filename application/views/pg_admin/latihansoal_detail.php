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
                <a href="<?php echo $form_action . 'manajemen/tambah_soal?id=' . $submateri->id_sub_materi ?>" class="btn btn-fill btn-success pull-right">
                  <span class="glyphicon glyphicon-plus"></span> Tambah Soal
                </a>
                <h4 class="title"><?php echo $submateri->nama_sub_materi?></h4>
                <p class="category">Daftar Soal per Sub-materi</p>
              </div>
              <div class="content">
                <div class="table-responsive">
                  <table id="my_datatable" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Soal</th>
                        <th>Pembahasan Teks</th>
                        <th>Pembahasan Video</th>
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
                          <td>
                            <?php //echo strip_tags($item->isi_soal)?>
                            <?php echo html_entity_decode($item->isi_soal) ?>
                            </div>
                          </td>
                          <td class="text-center"><?php echo !empty($item->pembahasan)?"<span class='text-success glyphicon glyphicon-ok'></span>" : "<span class='text-danger glyphicon glyphicon-remove'></span>" ;?></td>
                          <td class="text-center"><?php echo !empty($item->pembahasan_video)?"<span class='text-success glyphicon glyphicon-ok'></span>" : "<span class='text-danger glyphicon glyphicon-remove'></span>" ;?></td>
                          <td class="text-center">
                            <div class="button-group">
                              <a href="<?php echo $form_action . 'manajemen/ubah_soal?id=' . $item->id_soal ?>" class="btn btn-warning btn-xs" title="Ubah"><i class="glyphicon glyphicon-pencil"></i></a>
                              
							  <?php
							  if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin" or $this->session->userdata('level') == "maineditor"){
							  ?>
							  <button type="button" class="btn btn-danger btn-xs" title="Hapus" data-number="<?php echo $no?>" value="<?php echo $item->id_soal?>" data-toggle="modal" data-target="#deleteRow_modal"><i class="glyphicon glyphicon-remove"></i></button>
							  <?php
							  }
							  ?>
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

    <footer class="footer">
      <div class="container-fluid">
        
        <p class="copyright pull-right">
          &copy; 2016 <a href="http://www.primegeneration.com">Prime Generation</a>
        </p>
      </div>
    </footer>

  </div>
</div>

<?php include "alert_modal.php"; ?>
</body>

  <!--   Core JS Files   -->
 <script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
 <script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

 <!--  Checkbox, Radio & Switch Plugins -->
 <script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

 <!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
 
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

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
