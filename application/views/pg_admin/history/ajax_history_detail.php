<div class="col-sm-12">
	Editor : <?php echo $soal->username;?> - <?php echo $soal->timestamp;?>
</div>

<div class="col-sm-12">
	<table class="table table-bordered table-striped">
		<tr>
			<td class="text-center"><strong>BEFORE</strong></td>
			<td class="text-center"><strong>AFTER</strong></td>
		</tr>
		<tr>
			<td><?php echo html_entity_decode($soal->soal_before);?></td>
			<td><?php echo html_entity_decode($soal->soal_after);?></td>
		</tr>
		<tr>
			<td class="text-center"><strong>BOBOT SOAL</strong></td>
			<td class="text-center"><strong>BOBOT SOAL</strong></td>
		</tr>
		<tr>
			<td>
				<?php 
					if($soal->bobot_before == 1){
						echo "Mudah";
					}elseif($soal->bobot_before == 2){
						echo "Sedang";
					}elseif($soal->bobot_before == 3){
						echo "Sulit";
					}
				?>
			</td>
			<td>
				<?php 
					if($soal->bobot_after == 1){
						echo "Mudah";
					}elseif($soal->bobot_after == 2){
						echo "Sedang";
					}elseif($soal->bobot_after == 3){
						echo "Sulit";
					}
				?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>KUNCI JAWABAN</strong></td>
			<td class="text-center"><strong>KUNCI JAWABAN</strong></td>
		</tr>
		<tr>
			<td>
				<?php
					if($soal->kunci_jawaban_before == 1){
						echo "A";
					}elseif($soal->kunci_jawaban_before == 2){
						echo "B";
					}elseif($soal->kunci_jawaban_before == 3){
						echo "C";
					}elseif($soal->kunci_jawaban_before == 4){
						echo "D";
					}elseif($soal->kunci_jawaban_before == 5){
						echo "E";
					}
				?>
			</td>
			<td>
				<?php
					if($soal->kunci_jawaban_after == 1){
						echo "A";
					}elseif($soal->kunci_jawaban_after == 2){
						echo "B";
					}elseif($soal->kunci_jawaban_after == 3){
						echo "C";
					}elseif($soal->kunci_jawaban_after == 4){
						echo "D";
					}elseif($soal->kunci_jawaban_after == 5){
						echo "E";
					}
				?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>A</strong></td>
			<td class="text-center"><strong>A</strong></td>
		</tr>
		<tr>
			<td>
				<?php echo html_entity_decode($soal->jawab_1_before);?>
			</td>
			<td>
				<?php echo html_entity_decode($soal->jawab_1_after);?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>B</strong></td>
			<td class="text-center"><strong>B</strong></td>
		</tr>
		<tr>
			<td>
				<?php echo html_entity_decode($soal->jawab_2_before);?>
			</td>
			<td>
				<?php echo html_entity_decode($soal->jawab_2_after);?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>C</strong></td>
			<td class="text-center"><strong>C</strong></td>
		</tr>
		<tr>
			<td>
				<?php echo html_entity_decode($soal->jawab_3_before);?>
			</td>
			<td>
				<?php echo html_entity_decode($soal->jawab_3_after);?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>D</strong></td>
			<td class="text-center"><strong>D</strong></td>
		</tr>
		<tr>
			<td>
				<?php echo html_entity_decode($soal->jawab_4_before);?>
			</td>
			<td>
				<?php echo html_entity_decode($soal->jawab_4_after);?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>E</strong></td>
			<td class="text-center"><strong>E</strong></td>
		</tr>
		<tr>
			<td>
				<?php echo html_entity_decode($soal->jawab_5_before);?>
			</td>
			<td>
				<?php echo html_entity_decode($soal->jawab_5_after);?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>PEMBAHASAN</strong></td>
			<td class="text-center"><strong>PEMBAHASAN</strong></td>
		</tr>
		<tr>
			<td>
				<?php echo html_entity_decode($soal->pembahasan_before);?>
			</td>
			<td>
				<?php echo html_entity_decode($soal->pembahasan_after);?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>PEMBAHASAN VIDEO</strong></td>
			<td class="text-center"><strong>PEMBAHASAN VIDEO</strong></td>
		</tr>
		<tr>
			<td>
				<?php echo html_entity_decode($soal->pembahasan_video_before);?>
			</td>
			<td>
				<?php echo html_entity_decode($soal->pembahasan_video_after);?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>STATUS</strong></td>
			<td class="text-center"><strong>STATUS</strong></td>
		</tr>
		<tr>
			<td>
				<?php
				if($soal->status_before == 0){
					echo "Waiting Approval";
				}elseif($soal->status_before == 1){
					echo "Approved";
				}elseif($soal->status_before == 10){
					echo "Approved";
				}elseif($soal->status_before == 2){
					echo "Pembahasan tidak lengkap";
				}elseif($soal->status_before == 3){
					echo "Belum ada pembobotan";
				}elseif($soal->status_before == 4){
					echo "Soal membingungkan";
				}elseif($soal->status_before == 5){
					echo "Soal double (perlu dihapus)";
				}elseif($soal->status_before == 6){
					echo "Soal tidak layak (perlu dihapus)";
				}elseif($soal->status_before == 7){
					echo "Pindah soal";
				}elseif($soal->status_before == 8){
					echo "Soal belum di QC Tentor";
				}elseif($soal->status_before == 9){
					echo "Video Salah";
				}
				?>
			</td>
			<td>
				<?php
				if($soal->status_after == 0){
					echo "Waiting Approval";
				}elseif($soal->status_after == 1){
					echo "Approved";
				}elseif($soal->status_after == 10){
					echo "Approved";
				}elseif($soal->status_after == 2){
					echo "Pembahasan tidak lengkap";
				}elseif($soal->status_after == 3){
					echo "Belum ada pembobotan";
				}elseif($soal->status_after == 4){
					echo "Soal membingungkan";
				}elseif($soal->status_after == 5){
					echo "Soal double (perlu dihapus)";
				}elseif($soal->status_after == 6){
					echo "Soal tidak layak (perlu dihapus)";
				}elseif($soal->status_after == 7){
					echo "Pindah soal";
				}elseif($soal->status_after == 8){
					echo "Soal belum di QC Tentor";
				}elseif($soal->status_after == 9){
					echo "Video Salah";
				}
				?>
			</td>
		</tr>
	</table>
</div>