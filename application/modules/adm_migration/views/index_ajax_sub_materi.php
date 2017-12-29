<?php
	if($kurikulum == "K-13" or $kurikulum == "K-13 REVISI"){
		$valuebab = $mapok->judul_bab_k13;
	}elseif($kurikulum == "KTSP"){
		$valuebab = $mapok->judul_bab_ktsp;
	}
?>
<div class="col-md-8">
	<input type="text" id="proof-bab" class="form-control" value="<?php echo $valuebab;?>">
</div>
<div class="col-md-4">
	<button class="btn btn-sm btn-success" id="buat-bab" style="width: 100%;">Transfer Bab >></button>
</div>

<div class="clearfix">
</div>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th class="column-title text-center">Sub Materi</th>
				<th class="column-title text-center">Operasi</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach($datasub as $sub){
					?>
					<tr>
						<td>
							<?php
								echo $sub->nama_sub_materi;
							?>
						</td>
						<td>
							<button class="btn btn-sm btn-success">Pindah >></button>
							<?php
								if($sub->kategori == 1){
									?>
									<button class="btn btn-sm btn-success buat-sub" id="buat-sub-<?php echo $sub->id_sub_materi;?>">Buat Sub-Bab >></button>
									<?php
								}
							?>
						</td>
					</tr>
					<?php
				}
			?>
		</tbody>
	</table>
</div>