<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th class="text-center" style="width: 20px;">No.</th>
			<th class="text-center">Sub-Bab</th>
			<th class="text-center">Jumlah Soal</th>
			<th class="text-center">Operasi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($datasub as $sub){
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td>
						<?php
							if($sub->kategori == 3){
								?>
								<strong><?php echo $sub->nama_sub_materi;?></strong>
								<?php
							}else{
								echo $sub->nama_sub_materi;
							}
						?>
					</td>
					<td class="text-center">
						<?php
							if($sub->kategori == 3){
								//cari jumlah soal per author
								$jumlah = $this->model_author->get_jumlah_soal_by_sub_and_author($sub->id_sub_materi, $this->session->userdata('id_admin'));
								
								echo $jumlah;
							}else{
								echo "-";
							}
						?>
					</td>
					<td class="text-center">
						<?php
							if($sub->kategori == 3){
								?>
								<a class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/author/list_soal/" . $sub->id_sub_materi);?>">Lihat Soal</a>
								<?php
							}
						?>
					</td>
				</tr>
				<?php
				$x++;
			}
		?>
	</tbody>
</table>