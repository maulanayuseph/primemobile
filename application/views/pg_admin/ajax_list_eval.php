<div class="table-responsive">
  <table id="" class="table table-striped table-hover display">
	<thead>
	  <tr>
		<th>#</th>
		<th>Soal</th>
		<th>Kelas</th>
		<th>Mapel</th>
		<th>Bab</th>
		<th>Sub-Bab</th>
		<th>Status</th>
		<th class="text-center">Aksi</th>
	  </tr>
	</thead>
	<tbody>
	  <?php
		$no = 1; 
		foreach($table_eval as $item){
			?>
			<tr>
			  <td><?php echo $no;?></td>
			  <td>
				<?php //echo strip_tags($item->isi_soal)?>
				<?php echo html_entity_decode($item->isi_soal) ?>
			  </td>
			  <td>
				<?php echo $item->alias_kelas;?>
			  </td>
			  <td>
				<?php echo $item->nama_mapel;?>
			  </td>
			  <td>
				<?php echo $item->nama_materi_pokok;?>
			  </td>
			  <td>
				<?php echo $item->nama_sub_materi;?>
			  </td>
			  <td>
				<?php
					if($item->status == 2){
						echo "Pembahasan Tidak Lengkap";
					}elseif($item->status == 3){
						echo "Belum Ada Pembobotan";
					}elseif($item->status == 4){
						echo "Membingungkan";
					}elseif($item->status == 5){
						echo "Dobel";
					}elseif($item->status == 6){
						echo "Tidak Layak";
					}elseif($item->status == 8){
						echo "Belum di QC Tentor";
					}elseif($item->status == 7){
						echo "Perlu Dipindah";
					}
				?>
			  </td>
			  <td class="text-center">
				<div class="button-group">
					<a href="<?php echo base_url("pg_admin/quality/") . '/manajemen/ubah_soal?id=' . $item->id_soal ?>" class="btn btn-warning btn-xs" title="Ubah"><i class="glyphicon glyphicon-pencil"></i></a>
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

<script>
$(document).ready(function() {
    $('table.display').DataTable();
} );
</script>