<form method="post" action="<?php echo base_url("adm_konten/hapus_kurikulum_mapel_from_mapel");?>">
	<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Hapus mata pelajaran dari kurikulum ?</h4>
  </div>
  <div class="modal-body">
    <table class="table">
    	<strong><?php echo $mapel->nama_mapel;?></strong>
        (<?php echo $kurkelas->alias_kelas;?> - <?php echo $kurkelas->nama_kurikulum;?>)
    </table>
    <input type="hidden" name="idkurmapel" value="<?php echo $mapel->id_kurikulum_x_mapel;?>">
    <input type="hidden" name="key" value="<?php echo $this->security->get_csrf_hash(); ?>">
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <input type="submit" class="btn btn-danger" value="Proses Hapus"/>
  </div>
</form>