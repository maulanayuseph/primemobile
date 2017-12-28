<?php
	foreach($table_kategori as $kategori){
		if($kategori->id_profil == $item->id_tryout){
?>
	<tr>
		<td></td>
		<td><i><?php echo $kategori->nama_kategori;?></i></td>
		<td colspan="4">
		<span class="label label-success">waktu: <?php echo $kategori->durasi;?> menit</span> 
		<span class="label label-warning">jumlah: <?php echo $kategori->jumlah_soal;?> soal</span> 
		<span class="label label-info">ketuntasan: <?php echo $kategori->ketuntasan;?> </span> 
	<?php
		if($kategori->status == '0'){
			echo ' <a href="tryout/manajemen/aktivasi/'.$kategori->id_kategori.'"><span class="label label-default">Non Aktif</span></a>';
		}else{
			echo ' <a href="tryout/manajemen/nonaktif/'.$kategori->id_kategori.'"><span class="label label-primary">Aktif</span></a>';
		}
	?>
		</td>
		<td><a href="tryout/manajemen/managesoal/<?php echo $kategori->id_kategori;?>" class="btn btn-danger"><span class="glyphicon glyphicon-cog"></span> Manage Soal</a></td>
		<td class="text-center">
			<a href="tryout/manajemen/editkategori/<?php echo $kategori->id_kategori;?>">
			<span class="glyphicon glyphicon-pencil"></span> 
			</a>
			
			<?php
			if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
			?>
			<a href="tryout/manajemen/hapuskategori/<?php echo $kategori->id_kategori;?>" onclick="return confirm('Apakah anda yakin untuk menghapus kategori <?php echo $kategori->nama_kategori; ?>');">
			<span class="glyphicon glyphicon-trash"></span>
			</a>
			<?php
			}
			?>
			
		</td>
	</tr>
<?php
		}else{
			
		}
?>
<?php
	}
?>