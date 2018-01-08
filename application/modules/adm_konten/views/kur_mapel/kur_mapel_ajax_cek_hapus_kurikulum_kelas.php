<form method="post" action="<?php echo base_url("adm_konten/hapus_kurikulum_kelas_from_mapel");?>">
	<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Hapus Kurikulum Kelas</h4>
  </div>
  <div class="modal-body">
    <table class="table">
    	<tbody>
    		<tr>
    			<td>Kelas</td>
    			<td>:</td>
    			<td><?php echo $kurkelas->alias_kelas;?></td>
    		</tr>
    		<tr>
    			<td>Kurikulum</td>
    			<td>:</td>
    			<td><?php echo $kurkelas->nama_kurikulum;?></td>
    		</tr>
    	</tbody>
    </table>
    <input type="hidden" name="idkurkelas" value="<?php echo $kurkelas->id_kurikulum_x_kelas;?>">
    <input type="hidden" name="key" value="<?php echo $this->security->get_csrf_hash(); ?>">
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <input type="submit" class="btn btn-danger" value="Proses Hapus"/>
  </div>
</form>