<?php
$no = 1; 
foreach ($datasoal as $item) 
{
?>
<tr>
  <td><?php echo $no;?></td>
  <td>
	<?php //echo strip_tags($item->isi_soal)?>
	<?php echo html_entity_decode($item->isi_soal) ?>
  </td>
  <td class="text-center"><?php echo !empty($item->pembahasan)?"<span class='text-success glyphicon glyphicon-ok'></span>" : "<span class='text-danger glyphicon glyphicon-remove'></span>" ;?></td>
  <td class="text-center"><?php echo !empty($item->pembahasan_video)?"<span class='text-success glyphicon glyphicon-ok'></span>" : "<span class='text-danger glyphicon glyphicon-remove'></span>" ;?></td>
  <td class="text-center">
	<div class="button-group">
	
		<button class="btn btn-xs btn-primary lihat-soal" id="lihat-<?php echo $item->id_soal;?>" data-toggle="modal" data-target="#modalsoal<?php echo $item->id_soal;?>"><i class="glyphicon glyphicon-eye-open"></i></button>
		
	  <?php
	  if($this->session->userdata('level') == "adminqc"){
	  ?>
	  <button id="acc-<?php echo $item->id_soal;?>" class="btn btn-success btn-xs btn-acc" title="Ubah"><i class="glyphicon glyphicon-ok"></i></button>
	  
	  <button id="eval-<?php echo $item->id_soal;?>" class="btn btn-warning btn-xs btn-eval" title="Ubah"><i class="glyphicon glyphicon-repeat"></i></button>
	  
	  <a href="<?php echo base_url("pg_admin/quality/") . '/manajemen/ubah_soal?id=' . $item->id_soal ?>" class="btn btn-warning btn-xs" title="Ubah"><i class="glyphicon glyphicon-pencil"></i></a>
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

<script>
$(document).ready(function() {
    //$('table.display').DataTable();
	
	$(".lihat-soal").click(function(e){
		var soal = e.target.id;
		var idsoal = soal.split("-");
		//$("#isi-soal").load("quality/ajax_lihat_soal/" + idsoal[1]);
	})
	
	$(".btn-acc").click(function(e){
		var soal = e.target.id;
		var idsoal = soal.split("-");
		$("#list-soal").load("quality/ajax_acc/" + idsoal[1] + "/" + $("#bab").val());
		$("#viewmodalsoal").load("quality/ajax_modal_soal/" + $("#bab").val());
	})
	
	$(".btn-eval").click(function(e){
		var soal = e.target.id;
		var idsoal = soal.split("-");
		
		$("#list-soal").load("quality/ajax_eval/" + idsoal[1] + "/" + $("#bab").val());
	})
});
</script>