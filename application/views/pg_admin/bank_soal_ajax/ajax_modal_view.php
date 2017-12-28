<?php
$no=1;
	foreach($datasoal as $data){
	?>
	<div class="modal fade" id="myModal<?php echo $data->id_banksoal;?>" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
		<div class="modal-content" id="modalsoal">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  </div>
		  <div class="modal-body">
			<p><?php echo $data->pertanyaan; ?></p>
			<p>&nbsp;</p>
			<table class="table table-bordered table-striped">
				<tr>
					<td style="width: 30px;"><b>A.</b></td>
					<td>
						<?php
						echo $data->jawab_1;
						?>
					</td>
				</tr>
				<tr>
					<td><b>B.</b></td>
					<td>
						<?php
						echo $data->jawab_2;
						?>
					</td>
				</tr>
				<tr>
					<td><b>C.</b></td>
					<td>
						<?php
						echo $data->jawab_3;
						?>
					</td>
				</tr>
				<tr>
					<td><b>D.</b></td>
					<td>
						<?php
						echo $data->jawab_4;
						?>
					</td>
				</tr>
				<tr>
					<td><b>E.</b></td>
					<td>
						<?php
						echo $data->jawab_5;
						?>
					</td>
				</tr>
				<tr>
					<td>Kunci Jawaban</td>
					<td>
						<b>
						<?php
							if($data->kunci == 1){
								echo "A";
							}elseif($data->kunci == 2){
								echo "B";
							}elseif($data->kunci == 3){
								echo "C";
							}elseif($data->kunci == 4){
								echo "D";
							}elseif($data->kunci == 5){
								echo "E";
							}
						?>
						</b>
					</td>
				</tr>
			</table>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<?php	
	}

?>
<script type="text/javascript" async
  src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML">
</script>