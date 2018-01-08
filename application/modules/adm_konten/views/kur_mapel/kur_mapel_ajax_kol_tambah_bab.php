<div id="select-bab-exist">
<select id="select-bab-tambah-bab" data-placeholder="-- Pilih Bab --" class="form-control" name="bab" required>
	<?php
		foreach($databab as $bab){
			?>
			<option value="<?php echo $bab->id_bab;?>"><?php echo$bab->nama_bab;?></option>
			<?php
		}
	?>
</select>
<small>Tidak menemukan bab? Klik <a href="javascript:void(0)" class="tambah-input-bab">Di Sini</a> untuk menambah bab baru</small>
<div class="clearfix"></div>
&nbsp;
</div>
<div id="kol-input-bab-baru" style="display: none;">
<input type="text" name="bab-baru" id="input-bab-baru" class="form-control" placeholder="Input Nama Bab Baru">
<small><a href="javascript:void(0)" class="batal-input-bab"><< Batal</a></small>
</div>