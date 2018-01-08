<form method="post" action="<?php echo base_url("adm_konten/hapus_kurikulum_bab_from_mapel");?>">
	<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Hapus Bab Dari Kurikulum ?</h4>
  </div>
  <div class="modal-body">
    <table class="table">
    	<tbody>
    		<tr>
    			<td>Bab</td>
    			<td>:</td>
    			<td><strong><?php echo $bab->nama_bab;?></strong></td>
    		</tr>
    		<tr>
    			<td>Mata Pelajaran</td>
    			<td>:</td>
    			<td><?php echo $bab->nama_mapel;?></td>
    		</tr>
    		<tr>
    			<td>Kurikulum Kelas</td>
    			<td>:</td>
    			<td><?php echo $kurkelas->alias_kelas;?> - <?php echo $kurkelas->nama_kurikulum;?></td>
    		</tr>
    	</tbody>
    </table>
    <input type="hidden" name="idkurbab" value="<?php echo $bab->id_kurikulum_x_bab;?>">
    <input type="hidden" name="key" value="<?php echo $this->security->get_csrf_hash(); ?>">
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <input type="submit" class="btn btn-danger" value="Proses Hapus"/>
  </div>
</form>