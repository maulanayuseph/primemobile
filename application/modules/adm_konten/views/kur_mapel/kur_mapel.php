<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="page-title">
      <div class="title_left">
        <h3>Manajemen Konten Mata Pelajaran</h3>
      </div>
    </div>

    <div class="row">
    	<div class="col-sm-12">
    		<div class="x_panel"><!-- start panel -->

					<!-- filter kelas -->
    			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		    		<select class="form-control" id="kelas">
		    			<option value="">-- Pilih Kelas --</option>
		    			<?php
		    				foreach($datakelas as $kelas){
		    					?>
		    					<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
		    					<?php
		    				}
		    			?>
		    		</select>
	    		</div>
					<!-- end filter kelas -->

					<!-- filter kurikulum -->
    			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		    		<select class="form-control" id="kurikulum">
		    			<option value="">-- Pilih Kurikulum --</option>
		    		</select>
	    		</div>
					<!-- end filter kurikulum -->

					<!-- filter kurikulum -->
    			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		    		<select class="form-control" id="mapel">
		    			<option value="">-- Pilih Mata Pelajaran --</option>
		    		</select>
	    		</div>
					<!-- end filter kurikulum -->
					
					<!-- filter kurikulum -->
    			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		    		<select class="form-control" id="bab">
		    			<option value="">-- Pilih Bab --</option>
		    		</select>
	    		</div>
					<!-- end filter kurikulum -->


	    	</div><!-- end panel -->
    	</div>
    </div>
		<div class="clearfix"></div>

		<div class="row">
	    <div class="col-sm-12">
	    		<div class="x_panel">
	    			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    				<div class="btn-group">
	    					<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button" aria-expanded="false">Tambah <span class="caret"></span>
            		</button>
            		<ul role="menu" class="dropdown-menu">
                  <li>
                  	<a href="#" data-toggle="modal" data-target=".modal-tambah-kur-kelas">Kurikulum Kelas</a>
                  </li>
                  <li>
                  	<a href="#" data-toggle="modal" data-target=".modal-tambah-kur-mapel">Mata Pelajaran</a>
                  </li>
                  <li>
                  	<a href="#" data-toggle="modal" data-target=".modal-tambah-kur-bab">Bab</a>
                  </li>
                </ul>
	    				</div>

	    				<div class="btn-group">
	    					<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle btn-sm" type="button" aria-expanded="false">Hapus <span class="caret"></span>
            		</button>
            		<ul role="menu" class="dropdown-menu">
                  <li>
                  	<a href="#" data-toggle="modal" id="hapus-kurkelas">Kurikulum Kelas</a>
                  </li>
                  <li>
                  	<a href="#" id="hapus-kurmapel">Mata Pelajaran</a>
                  </li>
                  <li>
                  	<a href="#" id="hapus-kurbab">Bab</a>
                  </li>
                </ul>
	    				</div>
	    			</div>
	    		</div>
	    </div>
  	</div>

		<div class="clearfix"></div>
		<div class="row">
			<div class="col-xs-12 col-sm-12" id="list-sub">
			</div>
    </div>
												
  </div>
</div>
<!-- /page content -->

<!-- modal tambah kurikulum kelas -->
<div class="modal modal-tambah-kur-kelas" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
    	<form method="post" action="<?php echo base_url('adm_konten/proses_tambah_kur_kelas');?>">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Tambah Kurikulum Kelas</h4>
	      </div>
	      <div class="modal-body">
	        <select class="form-control" name="kelas" required>
	        	<option value="">-- Pilih Kelas --</option>
	        	<?php
	        		foreach($allkelas as $kelas){
	        			?>
	        			<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
	        			<?php
	        		}
	        	?>
	        </select>
	        <div class="clearfix">
	        </div>
	        &nbsp;
	        <select class="form-control" name="kurikulum" required>
        		<option value="">-- Pilih Kurikulum --</option>
        		<?php
        			foreach($allkurikulum as $kurikulum){
        				?>
        				<option value="<?php echo $kurikulum->id_kurikulum;?>"><?php echo $kurikulum->nama_kurikulum;?></option>
        				<?php
        			}
        		?>
        	</select>
        	<input type="hidden" name="key" value="<?php echo $this->security->get_csrf_hash(); ?>">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <input type="submit" class="btn btn-primary" value="Simpan"/>
	      </div>
      </form>
    </div>
  </div>
</div>
<!-- /modal tambah kurikulum kelas -->

<!-- modal tambah pelajaran -->
<div class="modal modal-tambah-kur-mapel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
    	<form method="post" action="<?php echo base_url('adm_konten/proses_tambah_kur_mapel');?>">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Tambah Mata Pelajaran</h4>
	      </div>
	      <div class="modal-body">
	        <select class="form-control" name="kelas" id="select-kelas-tambah-mapel" required>
	        	<option value="">-- Pilih Kelas --</option>
	        	<?php
	    				foreach($datakelas as $kelas){
	    					?>
	    					<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
	    					<?php
	    				}
	    			?>
	        </select>
	        <div class="clearfix">
	        </div>
	        &nbsp;
	        <select class="form-control" name="kurikulum" id="select-kurikulum-tambah-mapel" required>
        		<option value="">-- Pilih Kurikulum --</option>
        	</select>
        	<div class="clearfix">
	        </div>
	        &nbsp;
	        <select class="form-control" name="mapel" required>
	        	<option value="" required>-- Pilih Mapel --</option>
	        	<?php
	        		foreach($allmapel as $mapel){
	        			?>
	        			<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>
	        			<?php
	        		}
	        	?>
	        </select>
        	<input type="hidden" name="key" value="<?php echo $this->security->get_csrf_hash(); ?>">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <input type="submit" class="btn btn-primary" value="Simpan"/>
	      </div>
      </form>
    </div>
  </div>
</div>
<!-- /modal tambah pelajaran -->

<!-- modal tambah bab -->
<div class="modal modal-tambah-kur-bab" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
    	<form method="post" action="<?php echo base_url('adm_konten/proses_tambah_kur_bab');?>">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Tambah Bab</h4>
	      </div>
	      <div class="modal-body">
	        <select class="form-control" name="kelas" id="select-kelas-tambah-bab" required>
	        	<option value="">-- Pilih Kelas --</option>
	        	<?php
	    				foreach($datakelas as $kelas){
	    					?>
	    					<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
	    					<?php
	    				}
	    			?>
	        </select>
	        <div class="clearfix">
	        </div>
	        &nbsp;
	        <select class="form-control" name="kurikulum" id="select-kurikulum-tambah-bab" required>
        		<option value="">-- Pilih Kurikulum --</option>
        	</select>
        	<div class="clearfix">
	        </div>
	        &nbsp;
	        <select class="form-control" name="mapel" id="select-mapel-tambah-bab" required>
	        	<option value="" required>-- Pilih Mata Pelajaran --</option>
	        </select>
        	<input type="hidden" name="key" value="<?php echo $this->security->get_csrf_hash(); ?>">
        	<div class="clearfix">
	        </div>
	        &nbsp;
	        <div id="kol-tambah-bab">
	        	
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <input type="submit" class="btn btn-primary" value="Simpan"/>
	      </div>
      </form>
    </div>
  </div>
</div>
<!-- /modal tambah bab -->

<!-- modal hapus -->
<div class="modal modal-hapus" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" id="konten-cek-hapus">
    	
    </div>
  </div>
</div>
<!-- /modal hapus -->

