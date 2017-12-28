<div class="table-responsive">
	<table id="" class="table table-striped table-hover display">
		<thead>
			<tr>
				<th class="text-center">Sub-Bab</th>
				<th class="text-center">Jumlah Soal</th>
				<th class="text-center">Jumlah Video</th>
				<th class="text-center">Mudah</th>
				<th class="text-center">Sedang</th>
				<th class="text-center">Sulit</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach($datasub as $sub){
					if($sub->kategori == 3){
						$jumlahsoal 	= $this->model_adm->fetch_jumlah_soal_by_sub($sub->id_sub_materi);
						if($jumlahsoal > 0){
							$mudah 			= $this->model_adm->fetch_jumlah_soal_by_bobot_and_sub($sub->id_sub_materi, 1);
							$sedang 		= $this->model_adm->fetch_jumlah_soal_by_bobot_and_sub($sub->id_sub_materi, 2);
							$sulit 			= $this->model_adm->fetch_jumlah_soal_by_bobot_and_sub($sub->id_sub_materi, 3);
							
							$persenmudah 	= number_format(($mudah/$jumlahsoal) * 100, 2, ",", ".");
							$persensedang 	= number_format(($sedang/$jumlahsoal) * 100, 2, ",", ".");
							$persensulit 	= number_format(($sulit/$jumlahsoal) * 100, 2, ",", ".");
						}else{
							$mudah 			= 0;
							$sedang 		= 0;
							$sulit 			= 0;
							
							$persenmudah 	= number_format(0, 2, ",", ".");
							$persensedang 	= number_format(0, 2, ",", ".");
							$persensulit 	= number_format(0, 2, ",", ".");
						}
					}else{
						$jumlahsoal 	= "-";
						
						$mudah 			= "-";
						$sedang 		= "-";
						$sulit 			= "-";
						
						$persenmudah 	= "-";
						$persensedang 	= "-";
						$persensulit 	= "-";
					}
					?>
					<tr>
					<td><?php echo $sub->nama_sub_materi;?></td>
					<td class="text-center"><?php echo $jumlahsoal;?></td>
					<td class="text-center">
						<?php
							if($sub->kategori == 3){
								$jumlahvideo = $this->model_adm->jumlah_pembahasan_video_by_sub_materi($sub->id_sub_materi);
								echo $jumlahvideo;
							}else{
								echo "-";
							}
						?>
					</td>
					<td class="text-center">
						<?php echo $mudah;?>
						<?php
							if($persenmudah >= 20){
								?>
								<br><strong style="color: green;">(<?php echo $persenmudah;?> %)</strong>
								<?php
							}else{
								?>
								<br><strong style="color: red;">(<?php echo $persenmudah;?> %)</strong>
								<?php
							}
						?>
					</td>
					<td class="text-center">
						<?php echo $sedang;?>
						<?php
							if($persensedang >= 40){
								?>
								<br><strong style="color: green;">(<?php echo $persensedang;?> %)</strong>
								<?php
							}else{
								?>
								<br><strong style="color: red;">(<?php echo $persensedang;?> %)</strong>
								<?php
							}
						?>
					</td>
					<td class="text-center">
						<?php echo $sulit;?>
						<?php
							if($persensulit >= 40){
								?>
								<br><strong style="color: green;">(<?php echo $persensulit;?> %)</strong>
								<?php
							}else{
								?>
								<br><strong style="color: red;">(<?php echo $persensulit;?> %)</strong>
								<?php
							}
						?>
					</td>
					</tr>
					<?php
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