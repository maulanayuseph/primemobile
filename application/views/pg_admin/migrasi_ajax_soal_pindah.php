<script>
	$(".pilih-kelas").change(function(e) {
		idmentah 	= e.target.id;
		splitid		= idmentah.split("-");
		
		$("#mapel-" + splitid[1]).load("../banksoal/ajax_mapel/" + $(this).val());
	});
	$(".pilih-mapel").change(function(e) {
		idmentah 	= e.target.id;
		splitid		= idmentah.split("-");
		
		$("#bab-" + splitid[1]).load("../kurikulum/ajax_materi_pokok_drop/" + $("#kelas-" + splitid[1]).val() + "/" + $(this).val());
	});
	$(".pilih-bab").change(function(e) {
		idmentah 	= e.target.id;
		splitid		= idmentah.split("-");
		
		$("#sub-" + splitid[1]).load("ajax_sub_bab/" + $(this).val());
	});
</script>
<form method="post" action="<?php echo base_url("pg_admin/migrasi/proses_pindah");?>">
<input type="hidden" name="sub-awal" value="<?php echo $idsub;?>"/>
<table class="table table-responsive table-striped table-bordered">
	<?php
		$x = 1;
		foreach($datasoal as $soal){
			?>
			<tr>
				<td rowspan="2"><?php echo $x;?></td>
				<td colspan="5">
					<?php
						echo html_entity_decode($soal->isi_soal);
					?>
					<strong>
						STATUS : 
						<?php
						if($soal->status == "0"){
							echo "Waiting Approval";
						}elseif($soal->status == "1"){
							echo "Approved";
						}elseif($soal->status == "2"){
							echo "Pembahasan Tidak Lengkap";
						}elseif($soal->status == "3"){
							echo "Belum Pembobotan";
						}elseif($soal->status == "4"){
							echo "Soal Membingungkan";
						}elseif($soal->status == "5"){
							echo "Soal double (perlu dihapus)";
						}elseif($soal->status == "6"){
							echo "Soal tidak layak (perlu dihapus)";
						}elseif($soal->status == "7"){
							echo "<span style='color: green;'>Pindah soal</span>";
						}elseif($soal->status == "8"){
							echo "Soal belum di QC Tentor";
						}elseif($soal->status == "10"){
							echo "Approved";
						}
						?>
					</strong>
				</td>
			</tr>
			<tr>
				<td>Pindah Ke</td>
				<td>
					<select class="form-control pilih-kelas" id="kelas-<?php echo $soal->id_soal;?>">
						<option>-- Pilih Kelas --</option>
						<?php
							foreach($datakelas as $kelas){
								?>
								<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
								<?php
							}
						?>
					</select>
				</td>
				<td>
					<select class="form-control pilih-mapel" id="mapel-<?php echo $soal->id_soal;?>">
						<option>-- Pilih Mata Pelajaran --</option>
					</select>
				</td>
				<td>
					<select class="form-control pilih-bab" id="bab-<?php echo $soal->id_soal;?>">
						<option>-- Pilih Bab --</option>
					</select>
				</td>
				<td>
					<select class="form-control pilih-sub" id="sub-<?php echo $soal->id_soal;?>" name="sub-<?php echo $soal->id_soal;?>">
						<option value="0">-- Pilih Sub-Bab --</option>
					</select>
				</td>
			</tr>
			<?php
			$x++;
		}
	?>
</table>
<input type="submit" class="btn btn-primary btn-sm" value="Pindah Soal" />
</form>