<?php include('header_dashboard.php'); ?>
<?php
$idsiswa = $this->session->userdata('id_siswa');
$id_tryout= $data_profil->id_tryout;
$cek_status_pembayaran = $this->model_dashboard->cek_status_pembayaran($idsiswa, $id_tryout);                    
?>
<script>
window.onload = function () {
	$(function(){
	$("#list-profil").html("<img src='<?php echo base_url('assets/pg_user/images/spinner.gif');?>' style='float: none; margin: 0 auto; width: 100px;' />"); 
	$("#list-profil").load("../ajax_list_cbt/" + <?php echo $data_profil->id_tryout;?> + "/<?php echo $cek_status_pembayaran;?>");
});
};
</script>
    <div class="container-fluid akun-container">
	<div class="col-lg-12">
	
		<div class="panel panel-default">
		  <div class="panel-heading heading-list-cbt text-center">
			<h3 class="panel-title"><?php echo $data_profil->nama_profil; ?></h3>
		  </div>
		  <div class="panel-body body-cbt-list">
			 
							<img src="<?php echo base_url('assets/uploads/banner/'.$data_profil->banner);?>" class="img img-responsive"/>
							<div class="row contest-desc">
								<div class="col-lg-3 col-md-3 col-sm-3" style="padding-top: 7px; padding-bottom: 7px;">
								Biaya : Rp. <?php echo $data_profil->biaya; ?>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4" style="padding-top: 7px; padding-bottom: 7px;">
								Tanggal Pelaksanaan : 
								<?php
								$originalDate = $data_profil->tgl_acara;
								$newDate = date("d M Y", strtotime($originalDate));
								echo $newDate;
								?>
								</div>
								<div class="col-lg-5 col-md-5 col-sm-5">
									<a class="btn btn-primary" style="float: right; margin-left: 20px;" href="<?php echo base_url('user/statistiknilai?profil=') . $data_profil->id_tryout;?>">
										Lihat Statistik Nilai
									</a>
									<?php
                            if($cek_status_pembayaran == 0){
                                echo "<font style='color: blue'>"."Anda Belum Transfer Biaya Tes CBT"."</font>";
                            }else if($cek_status_pembayaran == 1){
                                echo "<font style='color: blue'>"."Pembayaran Anda Sedang Diverifikasi Admin"."</font>";
                            }else if($cek_status_pembayaran == 2){
                                echo "<font style='color: blue'>"."Status Pembayaran Tes CBT : LUNAS"."</font>";
                            }else if($cek_status_pembayaran == 3){
                                echo "<font style='color: blue'>"."Status : BATAL"."</font>";
                            }else if($cek_status_pembayaran == 4){ ?>
                            <a href="../../cbt/proses_daftar/<?php echo $data_profil->id_tryout; ?>" class="btn btn-primary" style="float: right;">
                                Daftar Sekarang
                            </a>
                            <?php } ?>
								</div>
								<div class="col-lg-12" style="margin-top: 20px;">
									<?php echo $data_profil->keterangan; ?>
								</div>
							</div>
		  </div>
		</div>
		
		<div class="panel panel-default">
		  <div class="panel-heading heading-list-cbt text-center">
			<h3 class="panel-title">DAFTAR UJIAN CBT CONTEST</h3>
		  </div>
		  <div class="panel-body body-cbt-list">
		  </div>
		</div>
		<div id="list-profil">
		</div>
    </div>
</div>
<!-- MODAL JIKA BELUM BAYAR CBT-->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        Maaf <?php echo $data_profil->nama_profil; ?> hanya bisa diakses bagi user yang sudah membayar biaya CBT, silahkan melakukan pendaftaran atau melunasi tagihan CBT.
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
<?php include('modal_unlock_bonus.php');?>
  <?php include('modal_video_motivasi.php');?>
<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
  
 
  
  <?php include('modal_aktivasi_agcu.php'); ?>
  <?php include('modal_profil.php'); ?>

  </body>
</html>