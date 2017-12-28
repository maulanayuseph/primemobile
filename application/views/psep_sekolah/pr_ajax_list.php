<div class="table-responsive">
  <table id="" class="table table-striped table-hover display">
	<thead>
	  <tr>
		<th style="width: 20px;">No. </th>
		<th>Pekerjaan Rumah</th>
		<th>Tipe PR</th>
		<th>Kelas</th>
		<th>Tahun Ajaran</th>
		<th>Deadline</th>
		<th>Operasi</th>
	  </tr>
	</thead>
	<tbody>
	  <?php
		$x = 1;
		foreach($datapr as $pr){
			$jumlahsiswa	= $this->model_psep->jumlah_siswa($idkelasparalel, $idtahunajaran);
			$jumlahselesai	= $this->model_psep->jumlah_selesai($pr->id_pr);
			$jumlahterkoreksi 	= $this->model_psep->jumlah_terkoreksi($pr->id_pr);
			$jumlahkoreksi 	= $this->model_psep->jumlah_koreksi($pr->id_pr);
			?>
				<tr>
					<td><?php echo $x;?></td>
					<td><strong><?php echo $pr->nama_pr;?></strong>
					<ul>
						<li><?php
						echo $jumlahselesai + $jumlahterkoreksi;
						?>/<?php echo $jumlahsiswa;?> Siswa Selesai</li>
						<?php
						if($pr->tipe == 2 or $pr->tipe == 3){
							if($jumlahkoreksi > 0){
								?>
								<li style="color: red;"><?php echo $jumlahkoreksi;?> Menunggu Koreksi</li>
								<?php
							}
						}
						?>
					</ul>
					</td>
					<td>
					<?php
					if($pr->tipe == 1){
						echo "Pilihan Ganda";
					}elseif($pr->tipe == 2){
						echo"Jawaban Eksak";
					}elseif($pr->tipe == 3){
						echo"Jawaban Essai";
					}
					?>
					</td>
					<td><?php echo $pr->kelas_paralel;?></td>
					<td><?php echo $pr->tahun_ajaran;?></td>
					<td><?php echo $pr->deadline;?></td>
					<td class="text-center">
					<?php
					if($pr->tipe == 1){
						?>
						<a href="<?php echo base_url("psep_sekolah/pr/daftar_soal/".$pr->id_pr);?>" class="btn btn-sm btn-success"><i class="fa fa-book" aria-hidden="true"></i></a>
						<?php
					}elseif($pr->tipe == 2){
						?>
						<a href="<?php echo base_url("psep_sekolah/pr/daftar_soal_eksak/".$pr->id_pr);?>" class="btn btn-sm btn-success"><i class="fa fa-book" aria-hidden="true"></i></a>
						<?php
					}elseif($pr->tipe == 3){
						?>
						<a href="<?php echo base_url("psep_sekolah/pr/daftar_soal_essai/".$pr->id_pr);?>" class="btn btn-sm btn-success"><i class="fa fa-book" aria-hidden="true"></i></a>
						<?php
					}
					?>
						<a href="<?php echo base_url("psep_sekolah/pr/edit/".$pr->id_pr);?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						<a href="<?php echo base_url("psep_sekolah/pr/hapus/".$pr->id_pr);?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus PR <?php echo $pr->nama_pr;?>? semua soal dan penilaian siswa akan ikut terhapus.');"><i class="fa fa-remove" aria-hidden="true"></i></a>
					<?php
					if($pr->tipe == 1){
						?>
						<a href="<?php echo base_url("psep_sekolah/pr/rekap/".$pr->id_pr);?>" class="btn btn-sm btn-primary"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
						<?php
					}elseif($pr->tipe == 2){
						?>
						<a href="<?php echo base_url("psep_sekolah/pr/rekap_eksak/".$pr->id_pr);?>" class="btn btn-sm btn-primary"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
						<?php
					}elseif($pr->tipe == 3){
						?>
						<a href="<?php echo base_url("psep_sekolah/pr/rekap_essai/".$pr->id_pr);?>" class="btn btn-sm btn-primary"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
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
</div>

<script>
$(document).ready(function() {
    $('table.display').DataTable();
} );
</script>