<div class="col-sm-12">
	<table class="table table-bordered table-striped">
		<tr>
			<td class="text-center"><strong>SOAL HASIL DUPLIKASI</strong></td>
			<td class="text-center"><strong>SUMBER SOAL</strong></td>
		</tr>
		<tr>
			<td><?php echo html_entity_decode($soaltujuan->isi_soal);?></td>
			<td><?php echo html_entity_decode($soalsumber->isi_soal);?></td>
		</tr>
		<tr>
			<td class="text-center"><strong>BOBOT SOAL</strong></td>
			<td class="text-center"><strong>BOBOT SOAL</strong></td>
		</tr>
		<tr>
			<td>
				<?php 
					if($soaltujuan->bobot == 1){
						echo "Mudah";
					}elseif($soaltujuan->bobot == 2){
						echo "Sedang";
					}elseif($soaltujuan->bobot == 3){
						echo "Sulit";
					}
				?>
			</td>
			<td>
				<?php 
					if($soalsumber->bobot == 1){
						echo "Mudah";
					}elseif($soalsumber->bobot == 2){
						echo "Sedang";
					}elseif($soalsumber->bobot == 3){
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
					if($soaltujuan->kunci_jawaban == 1){
						echo "A";
					}elseif($soaltujuan->kunci_jawaban == 2){
						echo "B";
					}elseif($soaltujuan->kunci_jawaban == 3){
						echo "C";
					}elseif($soaltujuan->kunci_jawaban == 4){
						echo "D";
					}elseif($soaltujuan->kunci_jawaban == 5){
						echo "E";
					}
				?>
			</td>
			<td>
				<?php
					if($soalsumber->kunci_jawaban == 1){
						echo "A";
					}elseif($soalsumber->kunci_jawaban == 2){
						echo "B";
					}elseif($soalsumber->kunci_jawaban == 3){
						echo "C";
					}elseif($soalsumber->kunci_jawaban == 4){
						echo "D";
					}elseif($soalsumber->kunci_jawaban == 5){
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
				<?php echo html_entity_decode($soaltujuan->jawab_1);?>
			</td>
			<td>
				<?php echo html_entity_decode($soalsumber->jawab_1);?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>B</strong></td>
			<td class="text-center"><strong>B</strong></td>
		</tr>
		<tr>
			<td>
				<?php echo html_entity_decode($soaltujuan->jawab_2);?>
			</td>
			<td>
				<?php echo html_entity_decode($soalsumber->jawab_2);?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>C</strong></td>
			<td class="text-center"><strong>C</strong></td>
		</tr>
		<tr>
			<td>
				<?php echo html_entity_decode($soaltujuan->jawab_3);?>
			</td>
			<td>
				<?php echo html_entity_decode($soalsumber->jawab_3);?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>D</strong></td>
			<td class="text-center"><strong>D</strong></td>
		</tr>
		<tr>
			<td>
				<?php echo html_entity_decode($soaltujuan->jawab_4);?>
			</td>
			<td>
				<?php echo html_entity_decode($soalsumber->jawab_4);?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>E</strong></td>
			<td class="text-center"><strong>E</strong></td>
		</tr>
		<tr>
			<td>
				<?php echo html_entity_decode($soaltujuan->jawab_5);?>
			</td>
			<td>
				<?php echo html_entity_decode($soalsumber->jawab_5);?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>PEMBAHASAN</strong></td>
			<td class="text-center"><strong>PEMBAHASAN</strong></td>
		</tr>
		<tr>
			<td>
				<?php echo html_entity_decode($soaltujuan->pembahasan);?>
			</td>
			<td>
				<?php echo html_entity_decode($soalsumber->pembahasan);?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>PEMBAHASAN VIDEO</strong></td>
			<td class="text-center"><strong>PEMBAHASAN VIDEO</strong></td>
		</tr>
		<tr>
			<td>
				<?php echo html_entity_decode($soaltujuan->pembahasan_video);?>
			</td>
			<td>
				<?php echo html_entity_decode($soalsumber->pembahasan_video);?>
			</td>
		</tr>
		<tr>
			<td class="text-center"><strong>STATUS</strong></td>
			<td class="text-center"><strong>STATUS</strong></td>
		</tr>
		<tr>
			<td>
				<?php
				if($soaltujuan->status == 0){
					echo "Waiting Approval";
				}elseif($soaltujuan->status == 1){
					echo "Approved";
				}elseif($soaltujuan->status == 10){
					echo "Approved";
				}elseif($soaltujuan->status == 2){
					echo "Pembahasan tidak lengkap";
				}elseif($soaltujuan->status == 3){
					echo "Belum ada pembobotan";
				}elseif($soaltujuan->status == 4){
					echo "Soal membingungkan";
				}elseif($soaltujuan->status == 5){
					echo "Soal double (perlu dihapus)";
				}elseif($soaltujuan->status == 6){
					echo "Soal tidak layak (perlu dihapus)";
				}elseif($soaltujuan->status == 7){
					echo "Pindah soal";
				}elseif($soaltujuan->status == 8){
					echo "Soal belum di QC Tentor";
				}elseif($soaltujuan->status == 9){
					echo "Video Salah";
				}
				?>
			</td>
			<td>
				<?php
				if($soalsumber->status == 0){
					echo "Waiting Approval";
				}elseif($soalsumber->status == 1){
					echo "Approved";
				}elseif($soalsumber->status == 10){
					echo "Approved";
				}elseif($soalsumber->status == 2){
					echo "Pembahasan tidak lengkap";
				}elseif($soalsumber->status == 3){
					echo "Belum ada pembobotan";
				}elseif($soalsumber->status == 4){
					echo "Soal membingungkan";
				}elseif($soalsumber->status == 5){
					echo "Soal double (perlu dihapus)";
				}elseif($soalsumber->status == 6){
					echo "Soal tidak layak (perlu dihapus)";
				}elseif($soalsumber->status == 7){
					echo "Pindah soal";
				}elseif($soalsumber->status == 8){
					echo "Soal belum di QC Tentor";
				}elseif($soalsumber->status == 9){
					echo "Video Salah";
				}
				?>
			</td>
		</tr>
	</table>
</div>