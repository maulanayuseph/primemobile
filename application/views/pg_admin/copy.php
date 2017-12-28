<html>
<head>
</head>

<body>
	<h1>Duplikat Latihan Soal</h1>
	<form action="<?php echo base_url('pg_admin/copy_soal/proses_copy');?>" method="post">
	<table>
		<tr>
			<td>ID Sub Materi Awal</td>
			<td><input type="text" name="idawal" required/></td>
		</tr>
		<tr>
			<td>ID Sub Materi Tujuan</td>
			<td><input type="text" name="idtujuan" required/></td>
		</tr>
		<tr>
			<td><input type="submit" value="Duplikasi" /></td>
			<td></td>
		</tr>
	</table>
	</form>
</form>
</body>
</html>