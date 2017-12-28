<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
	$this->load->view("pg_admin/html_header");
?>

<div class="wrapper">
  <?php
		if($this->session->userdata("level") == "adminpa"){
			$this->load->view('pg_admin/sidebar_pa');
		}else{
			$this->load->view('pg_admin/sidebar');
		}
	?>

  <div class="main-panel">
    <?php
    	$this->load->view("pg_admin/navbar");
    ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
              	<div class="row">
					<div class="col-sm-6">
						<h4 class="title">Assignment CBT <?php echo $event->nama_event;?></h4>
              		</div>
              	</div>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-12 daftar-cbt">
						<table class="table display table-bordered table-striped">
							<thead>
								<tr>
									<th style="width: 10px;">#</th>
									<th class="text-center">CBT</th>
									<th class="text-center">Kelas</th>
									<th class="text-center">Check</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$x = 1;
									foreach($datacbt as $cbt){
										//cek apakah sudah ada di table event_x_cbt
										$cek = $this->model_adm_event->cek_cbt_event($event->id_event, $cbt->id_tryout);

										if($cek == 0){
											$checked = "";
										}else{
											$checked = "checked";
										}
										?>
										<tr>
											<td><?php echo $x;?></td>
											<td>
												<?php echo $cbt->nama_profil;?>
											</td>
											<td class="text-center">
												<?php echo $cbt->alias_kelas;?>
											</td>
											<td class="text-center">
												<input type="checkbox" class="cek-cbt" id="cbt-<?php echo $cbt->id_tryout;?>" <?php echo $checked;?>/>
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
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->
    <?php
    	$this->load->view("pg_admin/footer");
    ?>
  </div>
</div>

<?php
	$this->load->view("pg_admin/modal_ajax");
?>
</body>



<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<!--<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script> -->

<!-- Bootstrap Switch Plugin -->
<script src="<?php echo base_url('assets/js/plugins/bootstrap-switch/bootstrap-switch.min.js');?>"></script>

<!-- Progress -->
<script src="<?= base_url('assets/js/nprogress.js')?>" ></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>



<script type="text/javascript">
$(function(){

$('table.display').DataTable();

$(".daftar-cbt").on('click', '.cek-cbt', function(){
	rawid 		= $(this).attr("id");
	idsplit 	= rawid.split("-");
	idcbt		= idsplit[1];
	if(document.getElementById(rawid).checked){
		operasi = "set";
	}else{
		operasi = "unset"
	}
	$.ajax({
		type: 'POST',
		url: '../assign_cbt',
		data:{
			'idprofil'	: idcbt,
			'idevent'	: <?php echo $event->id_event;?>,
			'operasi'	: operasi
		}
	});
})

$(document).ajaxSend(function(event, jqxhr, settings){
	if(settings.url === "../assign_cbt"){
		$('#text-load').html('Menyimpan CBT ke Event');
		$('#modal-loader').modal('show');
	}
});
$(document).ajaxSuccess(function(event, request, options){
	if(options.url === "../assign_cbt"){
		$('#modal-loader').modal('hide');
		datapost 	= options.data;
		datarawid	= datapost.split("&");
		datarawid1	= datarawid[0].split("=");
		idcek		= datarawid1[1];
		if(request.responseText === "sukses"){
			console.log(request.responseText);
		}else if(request.responseText === "gagal"){
			if(document.getElementById("cbt-" + idcek).checked) {
				$('#cbt-' + idcek).attr('checked', false);
			} else {
				$('#cbt-' + idcek).attr('checked', true);
			}
		}else{
			if(document.getElementById(idcek).checked) {
				$('#cbt-' + idcek).attr('checked', false);
			} else {
				$('#cbt-' + idcek).attr('checked', true);
			}
		}
	}
});
$(document).ajaxError(function(event, request, options){
	if(options.url === "../assign_cbt"){
		$('#modal-loader').modal('hide');
		$('#modal-error').modal('show');
		datapost 	= options.data;
		datarawid	= datapost.split("&");
		datarawid1	= datarawid[0].split("=");
		idcek		= datarawid1[1];
		if(document.getElementById("cbt-" + idcek).checked) {
			$('#cbt-' + idcek).attr('checked', false);
		} else {
			$('#cbt-' + idcek).attr('checked', true);
		}
	}
});

})
</script>

</html>
