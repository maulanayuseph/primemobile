<?php
	foreach($datagroup as $group){
		?>
		<div><input type="checkbox" name="group" class="check-group" id="gcheck-<?php echo $group->id_group;?>">
		<?php
		//cek apakah punya child
		$jumlahchild = $this->adm_konten_model->hitung_child_group($group->id_group);
		if($jumlahchild > 0){
			?>
			<a href="javascript:void(0)" class="expand-group" id="group-<?php echo $group->id_group;?>"><span id="gnama-<?php echo $group->id_group;?>"><?php echo $group->group;?></span></a>
			<div id="expanded-<?php echo $group->id_group;?>" style="padding-left: 10px; display: none;"></div>
			<?php
		}else{
			?>
			<span id="gnama-<?php echo $group->id_group;?>"><?php echo $group->group;?></span>
			<?php
		}
		?>
		</div>
		<?php
	}
?>