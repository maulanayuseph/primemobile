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
            <a href="<?php echo base_url('pg_admin/keuangan/buat_tagihan');?>" class='btn btn-sm btn-primary'>Buat Tagihan</a>
            <br>&nbsp;
          </div>
          <div class="col-sm-12">
            <table class="table table-responsive table-bordered table-striped display">
              <thead>
                <tr>
                  <th style="width: 10px;">No.</th>
                  <th class="text-center">No. Tagihan</th>
                  <th class="text-center">Tanggal</th>
                  <th class="text-center">Sekolah</th>
                  <th class="text-center">Jumlah Voucher</th>
                  <th class="text-center">Total Tagihan</th>
                  <th class="text-center">Tipe Tagihan</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Operasi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $x = 1;
                  foreach($datatagihan as $tagihan){
                    $detailtagihan = $this->model_keuangan->fetch_detail_by_id_pembelian($tagihan->id_pembelian);
                    $jumlah   = 0;
                    $total    = 0;
                    foreach($detailtagihan as $detail){
                      $jumlah += $detail->jumlah;
                      $subtotal = $detail->jumlah * $detail->harga_satuan;
                      $total += $subtotal;
                    }
                    ?>
                    <tr>
                      <td><?php echo $x;?></td>
                      <td>
                        <?php echo $tagihan->no_tagihan;?>
                      </td>
                      <td>
                        <?php echo $tagihan->timestamp;?>
                      </td>
                      <td>
                        <?php echo $tagihan->nama_sekolah;?>
                      </td>
                      <td class="text-center">
                        <?php echo $jumlah;?>
                      </td>
                      <td>
                        <?php echo $total;?>
                      </td>
                      <td class="text-center">
                        <?php
                          if($tagihan->id_event > 0){
                            echo "Event";
                          }else{
                            echo "Reguler";
                          }
                        ?>
                      </td>
                      <td class="text-center">
                        <?php
                          if($tagihan->status == 0){
                            ?>
                            <span class="label label-warning">Belum Lunas</span>
                            <?php
                          }elseif($tagihan->status == 2){
                            ?>
                            <span class="label label-success">Lunas</span>
                            <?php
                          }
                        ?>
                      </td>
                      <td class="text-center">
                        <a href="<?php echo base_url("pg_admin/keuangan/cetak_tagihan/" . $tagihan->id_pembelian);?>" class="btn btn-xs btn-danger" target="_BLANK"><i class="fa fa-print" aria-hidden="true"></i></a>
                        <a href="<?php echo base_url("pg_admin/keuangan/transaction_status/" . $tagihan->id_pembelian);?>" class="btn btn-xs btn-danger"><i class="fa fa-clock-o" aria-hidden="true"></i></a>
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
