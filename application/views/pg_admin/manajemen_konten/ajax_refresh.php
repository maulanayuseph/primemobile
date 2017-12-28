<table class="table table-responsive table-bordered table-striped">
	<thead>
		<tr>
			<th style="width: 10px;">#</th>
			<th class="text-center">Judul Konten</th>
			<th class="text-center">Tipe Konten</th>
			<th class="text-center">Akses Soal</th>
			<th class="text-center">Operasi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($datakonten as $konten){
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td><?php echo $konten->nama_sub_materi;?></td>
					<td class="text-center">
						<?php
							if($konten->kategori == 1){
								echo "Materi";
							}elseif($konten->kategori == 3){
								echo "Latihan Soal";
							}
						?>
					</td>
					<td class="text-center">
						<?php
						if($konten->kategori == 3){
							echo "Lihat Soal";
						}
						?>
					</td>
					<td class="text-center">
					</td>
				</tr>
				<?php
				$x++;
			}
		?>
	</tbody>
</table>
