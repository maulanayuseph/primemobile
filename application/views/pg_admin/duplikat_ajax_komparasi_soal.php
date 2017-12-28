<table class="table table-bordered table-striped table-hover display">
	<thead>
		<tr>
			<th style="width: 10px;">#</th>
			<th>Soal Hasil Duplikasi</th>
			<th>Sumber Soal</th>
			<th>Lihat Komparasi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($datasoal as $soal){
				//cari sumber soal 
				$sumbersoal = $this->model_duplikat->fetch_soal_by_isi($soal->isi_soal, $soal->id_soal);
				if(isset($sumbersoal)){
					?>
					<tr>
						<td><?php echo $x;?></td>
						<td>
							<strong>ID Soal : </strong><?php echo $soal->id_soal;?>
							<br><strong>Kelas : </strong><?php echo $soal->alias_kelas;?>
							<br><strong>Mata Pelajaran : </strong><?php echo $soal->nama_mapel;?>
							<br><strong>Bab : </strong><?php echo $soal->nama_materi_pokok;?>
							<br><strong>Latihan : </strong><?php echo $soal->nama_sub_materi;?>
							<br>
							<br>Komparasi :
							<br><strong>Jawaban A : </strong>
							<?php
								if($soal->jawab_1 == $sumbersoal->jawab_1){
									echo "<span style='color: green;'>Match</span>";
								}else{
									echo "<span style='color: red;'>Not Match</span>";
								}
							?>
							<br><strong>Jawaban B : </strong>
							<?php
								if($soal->jawab_2 == $sumbersoal->jawab_2){
									echo "<span style='color: green;'>Match</span>";
								}else{
									echo "<span style='color: red;'>Not Match</span>";
								}
							?>
							<br><strong>Jawaban C : </strong>
							<?php
								if($soal->jawab_3 == $sumbersoal->jawab_3){
									echo "<span style='color: green;'>Match</span>";
								}else{
									echo "<span style='color: red;'>Not Match</span>";
								}
							?>
							<br><strong>Jawaban D : </strong>
							<?php
								if($soal->jawab_4 == $sumbersoal->jawab_4){
									echo "<span style='color: green;'>Match</span>";
								}else{
									echo "<span style='color: red;'>Not Match</span>";
								}
							?>
							<br><strong>Jawaban E : </strong>
							<?php
								if($soal->jawab_5 == $sumbersoal->jawab_5){
									echo "<span style='color: green;'>Match</span>";
								}else{
									echo "<span style='color: red;'>Not Match</span>";
								}
							?>
							<br><strong>Pembahasan : </strong>
							<?php
								if($soal->pembahasan == $sumbersoal->pembahasan){
									echo "<span style='color: green;'>Match</span>";
								}else{
									echo "<span style='color: red;'>Not Match</span>";
								}
							?>
							<br><strong>Bobot : </strong>
							<?php
								if($soal->bobot == $sumbersoal->bobot){
									echo "<span style='color: green;'>Match</span>";
								}else{
									echo "<span style='color: red;'>Not Match</span>";
								}
							?>
						</td>
						<td>
							<strong>ID Soal : </strong><?php echo $sumbersoal->id_soal;?>
							<br><strong>Kelas : </strong><?php echo $sumbersoal->alias_kelas;?>
							<br><strong>Mata Pelajaran : </strong><?php echo $sumbersoal->nama_mapel;?>
							<br><strong>Bab : </strong><?php echo $sumbersoal->nama_materi_pokok;?>
							<br><strong>Latihan : </strong><?php echo $sumbersoal->nama_sub_materi;?>
							
						</td>
						<td class="text-center">
							<button class="btn btn-sm btn-success lihat-komparasi" data-toggle="modal" data-target="#modalsoal" id="<?php echo $soal->id_soal;?>-<?php echo $sumbersoal->id_soal;?>">lihat komparasi</button>
						</td>
					</tr>
					<?php
					$x++;
				}
			}
		?>
	</tbody>
</table>

<script>
$(document).ready(function() {
    $('table.display').DataTable();

    $(".lihat-komparasi").click(function(){
		rawid		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		soaltujuan	= idsplit[0];
		soalsumber	= idsplit[1];
		$("#kontensoal").load("error_duplikasi/ajax_komparasi/" + soaltujuan + "/" + soalsumber);
	})
} );
</script>