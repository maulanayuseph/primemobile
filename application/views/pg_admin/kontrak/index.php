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
	  
        <div class="row">
          <div class="col-sm-12" style="text-align: right;">
            <a href="<?php echo base_url("pg_admin/kontrak/buat");?>" class="btn btn-sm btn-danger">+ Buat Kontrak Baru</a>
            <br>&nbsp;
          </div>
          <div class="col-sm-12">
            <table class="table table-bordered table-striped display">
              <thead>
                <th style="width: 10px;">No.</th>
                <th class="text-center">No. Kontrak</th>
                <th class="text-center">Sekolah</th>
                <th class="text-center">Tgl. Kontrak</th>
                <th class="text-center">Operasi</th>
              </thead>
              <tbody>
                <?php
                  $x = 1;
                  foreach($datakontrak as $kontrak){
                    ?>
                    <tr>
                      <td><?php echo $x;?></td>
                      <td><?php echo $kontrak->kontrak_no;?></td>
                      <td class="text-center"><?php echo $kontrak->nama_sekolah;?>
                        <br><?php echo $kontrak->nama_kota;?> - <?php echo $kontrak->nama_provinsi;?>
                      </td>
                      <td class="text-center">
                        <?php echo $kontrak->date;?> s/d <?php echo $kontrak->end_date;?>
                      </td>
                      <td class="text-center">
                        <a href="<?php echo base_url('pg_admin/kontrak/view/' . $kontrak->id_kontrak);?>" class="btn btn-xs btn-primary" target='_BLANK'><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a href="<?php echo base_url("pg_admin/kontrak/edit/" . $kontrak->id_kontrak);?>" class="btn btn-xs btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="<?php echo base_url("pg_admin/kontrak/hapus/" . $kontrak->id_kontrak);?>" onclick="return confirm('Lanjutkan hapus kontrak?')" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                    <?php
                    $x++;
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
		
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php
      $this->load->view("pg_admin/footer");
    ?>

  </div>
</div>

<!-- END MODAL ERROR AJAX -->
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
  $('table.display').DataTable();
})
</script>
</html>
