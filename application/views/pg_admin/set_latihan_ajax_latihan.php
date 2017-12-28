<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Latihan Soal</th>
			<th style="width: 20px;">Uji Kompetensi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($databab as $bab){
				?>
				<tr>
					<td colspan='2'><strong><?php echo $bab->nama_materi_pokok;?></strong></td>
				</tr>
				<?php
				$carilatihan = $this->model_set_latihan->fetch_latihan_by_bab($bab->id_materi_pokok);
				
				foreach($carilatihan as $latihan){
					?>
					<tr>
						<td><?php echo $latihan->nama_sub_materi;?></td>
						<td class="text-center">
						<?php
							if($latihan->tipe_latihan == 1){
								?>
								<input type="checkbox" class="cek-uji" id="<?php echo $latihan->id_sub_materi;?>" checked>
								<?php
							}else{
								?>
								<input type="checkbox" class="cek-uji" id="<?php echo $latihan->id_sub_materi;?>">
								<?php
							}
						?>
						</td>
					</tr>
					<?php
				}
			}
		?>
	</tbody>
</table>

<script>
$(function(){
	$(".cek-uji").click(function(e){
		idsub = e.target.id;
		
		$.ajax({
			type: 'POST',
			url: 'set_latihan/set_uji',
			data:{
				'idsub' 	: idsub
			}
		});
	});
});
</script>