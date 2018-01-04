<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="page-title">
      <div class="title_left">
        <h3>Manajemen Konten Mata Pelajaran</h3>
      </div>
    </div>

    <div class="clearfix"></div>
    
    <div class="row">
    	
    	<div class="col-sm-12">
    		<div class="x_panel"><!-- start panel -->

					<!-- filter kelas -->
    			<div class="col-sm-3">
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
    			<div class="col-sm-3">
		    		<select class="form-control" id="kurikulum">
		    			<option value="">-- Pilih Kurikulum --</option>
		    		</select>
	    		</div>
					<!-- end filter kurikulum -->

					<!-- filter kurikulum -->
    			<div class="col-sm-3">
		    		<select class="form-control" id="bab">
		    			<option value="">-- Pilih Mata Pelajaran --</option>
		    		</select>
	    		</div>
					<!-- end filter kurikulum -->
					
					<!-- filter kurikulum -->
    			<div class="col-sm-3">
		    		<select class="form-control" id="bab">
		    			<option value="">-- Pilih Bab --</option>
		    		</select>
	    		</div>
					<!-- end filter kurikulum -->


	    	</div><!-- end panel -->
    	</div>
    	
    </div>

  </div>
</div>
<!-- /page content -->

