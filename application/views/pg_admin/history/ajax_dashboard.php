<div class="col-sm-12">
	<table class="table table-responsive table-bordered table-striped">
		<?php
			foreach($datahistory as $history){
				?>
					<tr>
						<td>
							<strong><?php echo $history->username;?></strong> - <i><a href="<?php echo base_url("pg_admin/history/detail_soal/" . $history->id_soal);?>" target="_BLANK"><?php echo $history->timestamp;?></a></i>
							<ul>
								<?php
								if($history->aktivitas == "edit"){
									if($history->soal_before !== $history->soal_after){
										echo "<li>Mengubah Isi Soal</li>";
									}
								?>
								<?php
									if($history->jawab_1_before !== $history->jawab_1_after){
										echo "<li>Mengubah Opsi Jawaban A</li>";
									}
								?>
								<?php
									if($history->jawab_2_before !== $history->jawab_2_after){
										echo "<li>Mengubah Opsi Jawaban B</li>";
									}
								?>
								
								<?php
									if($history->jawab_3_before !== $history->jawab_3_after){
										echo "<li>Mengubah Opsi Jawaban C</li>";
									}
								?>
								<?php
									if($history->jawab_4_before !== $history->jawab_4_after){
										echo "<li>Mengubah Opsi Jawaban D</li>";
									}
								?>
								<?php
									if($history->jawab_5_before !== $history->jawab_5_after){
										echo "<li>Mengubah Opsi Jawaban E</li>";
									}
								?>
								<?php
									if($history->bobot_before !== $history->bobot_after){
										echo "<li>Mengubah Bobot Soal</li>";
									}
								?>
								<?php
									if($history->pembahasan_before !== $history->pembahasan_after){
										echo "<li>Mengubah Pembahasan Teks</li>";
									}
								?>
								
								<?php
									if($history->pembahasan_video_before !== $history->pembahasan_video_after){
										echo "<li>Mengubah Pembahasan Video</li>";
									}
								?>
								<?php
									if($history->status_before !== $history->status_after){
										echo "<li>Mengubah Status Soal</li>";
									}
								?>
								<?php
									if($history->status_after == 1){
										echo "<li>Approval Soal</li>";
									}
								}elseif($history->aktivitas == "tambah"){
									echo "<li>Upload Soal</li>";
								}elseif($history->aktivitas == "hapus"){
									echo "<li>Menghapus Soal</li>";
								}
								?>
							</ul>
						</td>
					</tr>
				<?php
			}
		?>
	</table>
</div>
