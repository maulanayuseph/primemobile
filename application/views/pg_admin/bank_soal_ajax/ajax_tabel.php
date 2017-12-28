<?php
$x = 1;
foreach($datasoal as $data){
?>
	<tr>
		<td><?php echo $x;?></td>
		<td><?php echo $data->topik; ?> ...</td>
		<td>
			<?php
				if($data->pembahasan_teks !== "" AND $data->pembahasan_video !== ""){
			?>
			<a href=""><span class="label label-success">Pembahasan Teks</span></a>
			<a href=""><span class="label label-warning">Pembahasan Video</span></a>
			<?php
				}elseif($data->pembahasan_teks == "" AND $data->pembahasan_video !== ""){
			?>
			<a href=""><span class="label label-warning">Pembahasan Video</span></a>
			<?php
				}elseif($data->pembahasan_teks !== "" AND $data->pembahasan_video == ""){
			?>
			<a href=""><span class="label label-success">Pembahasan Teks</span></a>
			<?php
				}elseif($data->pembahasan_teks == "" AND $data->pembahasan_video == ""){
					
				}
			?>
			
		</td>
		<td>
			<?php
				echo $data->nama_mapel . " - " . $data->alias_kelas;
			?>
		</td>
		
		<td>
			<?php echo $data->status;?>
		</td>
		<td>
			<?php
				echo $data->bobot_soal;
			?>
		</td>
		<td>
			<?php
				echo $data->kunci;
			?>
		</td>
		<td class="text-center">
			<!--
			<a href="#" data-toggle="modal" data-target="#modalbanksoal" class="modal-view" id="bank-<?php echo $data->id_banksoal;?>">
			<span class="glyphicon glyphicon-eye-open"></span> 
			</a>
			-->
			<a href="<?php echo base_url("pg_admin/banksoal/ajax_view_soal/" . $data->id_banksoal);;?>" target="_BLANK">
			<span class="glyphicon glyphicon-eye-open"></span> 
			</a>

			<a href="banksoal/edit/<?php echo $data->id_banksoal;?>">
			<span class="glyphicon glyphicon-pencil"></span> 
			</a>
			
			<?php
			if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
			?>
			<a href="banksoal/hapus/<?php echo $data->id_banksoal;?>" onclick="return confirm('Apakah anda yakin untuk menghapus');">
			<span class="glyphicon glyphicon-trash"></span>
			</a>
			<?php
			}
			?>
		</td>
	</tr>
<?php
	$x++;
}
?>
<script type="text/javascript">
$(function(){
	$(".modal-view").click(function(){
		rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idbanksoal 	= idsplit[1];

		$("#konten-modal").load("banksoal/ajax_view_soal/" + idbanksoal);
	})
})
</script>