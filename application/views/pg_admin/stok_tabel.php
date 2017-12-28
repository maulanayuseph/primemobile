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
								<div class="row">
									<div class="col-md-12 col-xs-12">
										<h4 class="title">Stock Voucher Online</h4>
										<p class="category">Kartu Stock Voucher Online</p>
									</div>
								</div>
              </div>
              <div class="content">
								<div class="tab-content">
									<div id="tab0" class="tab-pane fade in active">
										<div id="ajaxpage0">

              <div class="table-responsive">

                  <table class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th style="width:5%;" class="text-center">No.</th>
                        <th style="width:45%;" class="text-center">Nama Paket</th>
                        <th style="width:20%;" class="text-center">Jumlah Stock</th>
                        <th style="width:30%;" class="text-center">Total Harga (Rp)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
											if ($table_data != NULL){
                        $no = 1; 
												$jtot = 0;
												$jhar = 0;
                        foreach ($table_data as $item) 
                        {
													$color = $item->jumlah < 20 ? 'style="color:red;"' : '';
                      ?>
                        <tr>
													<td <?php echo $color ?>><?php echo $no;?></td>
													<td <?php echo $color ?>>
														<?php if ($item->id_paket < 20) { ?> 
															Reguler <?php echo $item->durasi;?> bulan
														<?php } else { ?>
															<?php echo $item->kode_paket;?>
														<?php } ?> 
													</td>
													<td class="text-right" <?php echo $color ?>><b><?php echo number_format($item->jumlah); ?></b></td>
													<td class="text-right" <?php echo $color ?>><b><?php echo number_format($item->jumlah * $item->harga); ?></b></td>
                        </tr>
                      <?php
													$no++;
													$jtot = $jtot + $item->jumlah;
													$jhar = $jhar + ($item->jumlah * $item->harga);
                        }
											}
                      ?>
                        <tr>
													<td class="text-right" colspan="2"><b>Total</b></td>
													<td class="text-right"><b><?php echo number_format($jtot); ?></b></td>
													<td class="text-right"><b><?php echo number_format($jhar); ?></b></td>
                        </tr>
                    </tbody>
                  </table>
									
              </div>


										</div>
									</div>
								</div>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div> <!-- end .content -->

  </div> <!-- end .main-panel -->
</div>

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

<!-- Progress -->
<script src="<?= base_url('assets/js/nprogress.js')?>" ></script>

</html>
