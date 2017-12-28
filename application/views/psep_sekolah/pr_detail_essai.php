<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	$("#sumber").change(function(){
		$("#manage").load("../ajax_manage/" + $("#sumber").val());
	});
});
</script>
<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Pekerjaan Rumah <?php echo $sekolah->nama_sekolah;?></h4>
              </div>
              <div class="content">
                <div class="row">
					<div class="col-md-6">
						<table class="table table-striped">
							<tr>
								<td>Nama Siswa</td>
								<td>:</td>
								<td><?php echo $infosiswa->nama_siswa;?></td>
							</tr>
						</table>
						<a href="<?php echo base_url("psep_sekolah/pr/koreksi/" . $infopr->id_pr . "/" . $infosiswa->id_siswa );?>" class="btn btn-primary btn-sm" style="width: 100%;">Koreksi</a>
					</div>
					<div class="col-md-6" id="box-nilai">
						<canvas id="donatbenarsalah" style="width: 100%; height: 400px;">
						</canvas>
						<p>&nbsp;
						<table class="table table-striped">
							<tr>
								<td>Jumlah Soal</td>
								<td>:</td>
								<td><?php echo count($data_soal);?></td>
							</tr>
							<tr>
								<td>Jumlah Benar</td>
								<td>:</td>
								<td><?php echo $jumlahbenarsiswa;?></td>
							</tr>
							<tr>
								<td>Nilai</td>
								<td>:</td>
								<td>
								<?php
									if($jumlahbenarsiswa > 0){
										$nilai = ($jumlahbenarsiswa / $jumlahsoal) * 100;
									}else{
										$nilai = 0;
									}
									echo $nilai;
								?>
								</td>
							</tr>
						</table>
					</div>
						<div class="col-md-12">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th class="text-center" style="width: 10px;">No. Soal</th>
										<th class="text-center">Soal</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no = 1;
										foreach($data_soal as $soal){
											?>
											<tr>
												<td><?php echo $no;?></td>
												<td>
												<div class="col-sm-12">
													<div class="panel panel-default">
													  <div class="panel-body">
														<div class="row">
															<div class="col-sm-12">
																<?php echo $soal->soal;?>
															</div>
														</div>
													  </div>
													</div>
												</div>
												
												<div class="col-sm-6">
													<div class="panel panel-default">
													  <div class="panel-body">
														<div class="row">
															<div class="col-sm-12">
																<br><strong>Kunci Jawaban :</strong>
																<br>
																<?php echo $soal->jawaban;?>
															</div>
														</div>
													  </div>
													</div>
												</div>
												
												<div class="col-sm-6">
													<div class="panel panel-default">
													  <div class="panel-body">
														<div class="row">
															<div class="col-sm-12">
																<br><strong>Jawaban Siswa :</strong>
																<br>
																<?php
																//CARI JAWABAN Siswa
																$jawabsiswa = $this->model_pr->fetch_jawaban_essai_siswa_by_soal($soal->id_soal_essai, $idsiswa);
																if(isset($jawabsiswa)){
																	echo $jawabsiswa->jawaban;
																}
																?>
																<hr>
															</div>
														</div>
														<div class="row">
															<div class="col-sm-6 text-center">
																<?php
																if($jawabsiswa->status == 1){
																	?>
																	<button class="btn btn-sm btn-success btn-benar" id="jawaban-benar-<?php echo $jawabsiswa->id_analisis_pr_essai;?>" disabled="disabled"><i class="fa fa-check" aria-hidden="true"></i></button>
																	<?php
																}else{
																	?>
																	<button class="btn btn-sm btn-success btn-benar" id="jawaban-benar-<?php echo $jawabsiswa->id_analisis_pr_essai;?>"><i class="fa fa-check" aria-hidden="true"></i></button>
																	<?php
																}
																?>
															</div>
															<div class="col-sm-6 text-center">
																<?php
																if($jawabsiswa->status == 1){
																	?>
																	<button class="btn btn-sm btn-danger btn-salah" id="jawaban-salah-<?php echo $jawabsiswa->id_analisis_pr_essai;?>"><i class="fa fa-remove" aria-hidden="true"></i></button>
																	<?php
																}else{
																	?>
																	<button class="btn btn-sm btn-danger btn-salah" id="jawaban-salah-<?php echo $jawabsiswa->id_analisis_pr_essai;?>" disabled="disabled"><i class="fa fa-remove" aria-hidden="true"></i></button>
																	<?php
																}
																?>
																
															</div>
														</div>
													  </div>
													</div>
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
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div>
</div>
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-loader" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk loading ajax -->
<div class="modal fade" id="modal-loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="<?php echo base_url("assets/img/rolling.gif");?>"/>
		<p id="text-load"> Memproses</p>
      </div>
    </div>
  </div>
</div>

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-error" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk error ajax -->
<div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
		<p>Terjadi kesalahan, periksa koneksi atau ulangi lagi
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!-- PLUGINS FUNCTION -->
<!-- Nestable plugin  -->
<script type="text/javascript" src="<?php echo base_url('assets/js/Chart.js');?>"></script>

<script>
$(function(){
	$(".btn-benar").click(function(e){
		rawid = e.target.id;
		idsplit = rawid.split("-");
		idanalisis = idsplit[2];
		$.ajax({
			type: 'POST',
			url: '../../ajax_koreksi_jawaban_essai',
			data:{
				'idanalisis' 	: idanalisis,
				'status'		: 1
			}
		});
	});
	$(".btn-salah").click(function(e){
		rawid = e.target.id;
		idsplit = rawid.split("-");
		idanalisis = idsplit[2];
		$.ajax({
			type: 'POST',
			url: '../../ajax_koreksi_jawaban_essai',
			data:{
				'idanalisis' 	: idanalisis,
				'status'		: 0
			}
		});
	});
	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "../../ajax_koreksi_jawaban_essai"){
			$('#text-load').html('Mengkoreksi jawaban siswa');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "../../ajax_koreksi_jawaban_essai"){
			$('#modal-loader').modal('hide');
			respon = request.responseText;
			console.log(respon);
			splitrespon = respon.split("-");
			idanalisis = splitrespon[0];
			status = splitrespon[1];
			if(status === "1"){
				$("#jawaban-benar-" + idanalisis).prop("disabled", true);
				$("#jawaban-salah-" + idanalisis).prop("disabled", false);
			}else if(status === "0"){
				$("#jawaban-benar-" + idanalisis).prop("disabled", false);
				$("#jawaban-salah-" + idanalisis).prop("disabled", true);
			}
			$('#box-nilai').load('../../ajax_reload_grafik_essai/' + <?php echo $idpr;?> + '/' + <?php echo $idsiswa;?>);
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "../../ajax_koreksi_jawaban_essai"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	});
})
</script>

<script>
var ctx = document.getElementById("donatbenarsalah");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
        "Jawaban Benar",
        "Jawaban Salah"
    ],
    datasets: [
        {
            data: [<?php echo $jumlahbenarsiswa;?>, <?php echo $jumlahsoal - $jumlahbenarsiswa;?>],
            backgroundColor: [
                "#36A2EB",
                "#B5B5B5"
            ],
            hoverBackgroundColor: [
                "#36A2EB",
                "#B5B5B5"
            ]
        }]
    }
});
</script>
</html>
