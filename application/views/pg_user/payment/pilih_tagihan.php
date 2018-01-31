<?php
$this->load->view("pg_user/header_dashboard");
?>
<div class="container-fluid akun-container">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<h3 class="text-center judulpilihbilling">Pilih Metode Billing</h3>
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<?php
					$y = 1;
					$x = 0;
					foreach($datapaket as $paket){
						if($x == 0){
							$active = " active";
						}else{
							$active = "";
						}
						?>
						<div class="item<?php echo $active;?>">
							<div class="panel panel-default">
								<div class="panel-heading text-center">
									<h3 class="panel-title"><?php echo $paket->durasi;?> Bulan</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-sm-12 text-center">
											<img src="<?php echo base_url('assets/img/payment/karakter'.$y.'.png');?>" style="height: 300px; width: auto;"/>
											<h3>Rp. <?php echo number_format($paket->harga);?>,-</h3>
											Penagihan setiap <?php echo $paket->durasi;?> bulan sekali

											<input type="hidden" id="durasi-<?php echo $paket->id_paket;?>" value="<?php echo $paket->durasi;?>">
											<input type="hidden" id="harga-<?php echo $paket->id_paket;?>" value="<?php echo $paket->harga;?>">
											<br>&nbsp;

										</div>
										<div class="col-sm-12">
											<button class="btn btn-danger btnpilihbilling" id="paket-<?php echo $paket->id_paket;?>" style="width: 100%">Pilih Billing</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
						$x++;
						$y++;
					}
				?>
			</div>
			<!-- end Wrapper for slides -->

			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	<div class="col-sm-4">
	</div>
</div>
	
<?php
$this->load->view("pg_user/footer");
?>

<script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>

<script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
<script type="text/javascript">
$(function(){
	$(".btnpilihbilling").click(function(){
		rawid 		= $(this).attr('id');
		idsplit 	= rawid.split('-');
		idpaket 	= idsplit[1];
		durasi 		= $("#durasi-" + idpaket).val();
		harga 		= $("#harga-" + idpaket).val();
		if(confirm("Anda memilih billing " + durasi + " bulan seharga Rp. "+ harga +",-. Lanjutkan ?")){
			window.location.replace("<?php echo base_url('payment/select_payment/');?>" + idpaket);
		}
	})
})
</script>
 </body>
</html>
