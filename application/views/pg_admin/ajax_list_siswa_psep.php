<table class="table display table-bordered table-striped">
	<thead>
		<tr>
			<th width="min-width: 10px;">#</th>
			<th>Nama Siswa</th>
			<th>Kelas</th>
			<th>Tahun Ajaran</th>
			<th>Voucher</th>
			<th>Expired</th>
			<th>Operasi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			$tanggalsekarang = date('Y-m-d');
			foreach($datasiswa as $siswa){
				$cekaktivasi = $this->model_voucher->fetch_existing_aktivation($siswa->id_siswa, $tanggalsekarang);
				?>
				<tr id="rowsiswa-<?php echo $siswa->nama_siswa;?>">
					<td><?php echo $x;?></td>
					<td id="nama-<?php echo $siswa->id_siswa;?>"><?php echo $siswa->nama_siswa;?></td>
					<td><?php echo $siswa->kelas_paralel;?></td>
					<td><?php echo $siswa->tahun_ajaran;?></td>
					<td>
						<?php
							if($cekaktivasi !== null){
								echo $cekaktivasi->kode_voucher;
							}else{
								echo "-";
							}
						?>
					</td>
					<td>
						<?php
							if($cekaktivasi !== null){
								echo $cekaktivasi->expired_on;
							}else{
								echo "-";
							}
						?>
					</td>
					<td class="text-center">
						<?php
							if($cekaktivasi == null){
								?>
								<button class="btn btn-sm btn-danger hapus-siswa" id="siswa-<?php echo $siswa->id_siswa;?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
<script>
$(document).ready(function() {
    $('table.display').DataTable();
});
</script>