<form action="<?php echo base_url('pg_admin/relokasi_voucher/proses_relokasi');?>" method="post">
	<table>
		<tr>
			<td>Paket voucher yang mau di relokasi</td>
			<td>:</td>
			<td>
				<select name="idawal" required>
					<?php
						foreach($datapaket as $paket){
							?>
							<option value="<?php echo $paket->id_paket;?>"><?php echo $paket->kode_paket;?></option>
							<?php
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Jumlah Relokasi</td>
			<td>:</td>
			<td>
				<input type="number" name="jumlah" required />
			</td>
		</tr>
		<tr>
			<td>Relokasi ke paket</td>
			<td>:</td>
			<td>
				<select name="idakhir" required>
					<?php
						foreach($datapaket as $paket){
							?>
							<option value="<?php echo $paket->id_paket;?>"><?php echo $paket->kode_paket;?></option>
							<?php
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="3"><input type="submit" value="Mulai Relokasi"></td>
		</tr>
	</table>
</form>