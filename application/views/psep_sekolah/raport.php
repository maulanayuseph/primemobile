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
	  	<div class="row">
	  		<div class="col-sm-12">
	  			<button class="btn btn-sm btn-danger" style="width: 100%;" data-toggle="modal" data-target="#modalprofil" id="tambah-profil-raport">Tambah Profil Raport</button>
	  		</div>
	  		<div class="col-sm-12">
	  			&nbsp;
	  		</div>
	  	</div>
        <div class="row" id="list-profil">
        	<table class="table display table-bordered table-striped">
        		<thead>
        			<th style="width: 10px;" class="text-center">#</th>
        			<th class="text-center">Kelas</th>
        			<th class="text-center">Tahun Ajaran</th>
        			<th class="text-center">Semester</th>
        			<th class="text-center">Operasi</th>
        		</thead>
        		<tbody>
        			<?php
        				$x = 1;
        				foreach($dataprofil as $profil){
        					?>
        					<tr>
							<td><?php echo $x;?></td>
							<td><a href="<?php echo base_url("psep_sekolah/raport/detail/" . $profil->id_profil_raport);?>"><?php echo $profil->alias_kelas;?></a></td>
							<td class="text-center"><?php echo $profil->tahun_ajaran;?></td>
							<td class="text-center">Semester <?php echo $profil->semester;?></td>
							<td class="text-center">
								
								<button class="btn btn-sm btn-danger edit-profil" data-toggle="modal" data-target="#modalprofil" id="profil-<?php echo $profil->id_profil_raport;?>">Edit</button>
								<button class="btn btn-sm btn-danger">Hapus</button>
							</td>
							</tr>
        					<?php
        					$x++;
        				}
        			?>
        		</tbody>
        	</table>
        </div>
		
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalprofil" id="modalprofil" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="label-modal-profil">&nbsp;</h4>
		</div>
		<div class="modal-body" id="konten-modal" style="max-height: 80vh; overflow-y: scroll;">
		</div>
    </div>
  </div>
</div>

<!-- MODAL LOADING AJAX -->
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
<!-- END MODAL LOADING AJAX -->

<!-- MODAL ERROR AJAX -->
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

<script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js');?>" type="text/javascript"></script>

<script>
$(function(){
	$("#tambah-profil-raport").click(function(){
		$("#konten-modal").load("raport/tambah_profil");
		$("#label-modal-profil").html("Input Profil Raport");
	});
	$(".edit-profil").click(function(){
		rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idprofil 	= idsplit[1];
		$("#label-modal-profil").html("Edit Profil Raport");
		$("#konten-modal").load("raport/edit_profil/" + idprofil);
	})
	$(document).ajaxSuccess(function(event, request, options){
		if(request.responseText === "sukses tambah profil"){
			$('#modal-loader').modal('hide');
			$('#modalprofil').modal('hide');

			$("#list-profil").load("raport/refresh_profil");
		}else if(request.responseText === "profil sudah ada"){
			$('#modal-loader').modal('hide');
			alert("Profil raport dengan konfigurasi tersebut sudah ada");
		}
	});

	$('table.display').DataTable();
});
</script>
</html>
