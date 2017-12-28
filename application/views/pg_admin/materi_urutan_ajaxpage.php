									<script type="text/javascript">
										$(function(){
											$("#kelas").change(function(){
												var urlSearch = "<?php echo base_url().'pg_admin/materi_urutan/ajax_view/'; ?>" + $("#kelas").val() + "/0/";
												$.ajax({
													url:urlSearch,
													beforeSend: function() {
														NProgress.start();
													},
													success:function(data) {
														NProgress.done(); 
														$("#containerajax").html(data)
													}
												});
												return false;
											});
											$("#mapel").change(function(){
												var urlSearch = "<?php echo base_url().'pg_admin/materi_urutan/ajax_view/'; ?>" + $("#kelas").val() + "/" + $("#mapel").val() + "/0/";
												$.ajax({
													url:urlSearch,
													beforeSend: function() {
														NProgress.start();
													},
													success:function(data) {
														NProgress.done(); 
														$("#containerajax").html(data)
													}
												});
												return false;
											});
											$("#mapok").change(function(){
												var urlSearch = "<?php echo base_url().'pg_admin/materi_urutan/ajax_view/'; ?>" + $("#kelas").val() + "/" + $("#mapel").val() + "/" + $("#mapok").val();
												$.ajax({
													url:urlSearch,
													beforeSend: function() {
														NProgress.start();
													},
													success:function(data) {
														NProgress.done(); 
														$("#containerajax").html(data)
													}
												});
												return false;
											});
										});
									</script>
									<div class="row" style="margin-bottom:20px;">
										<div class="col-md-3">
											<select id="kelas" class="form-control">
												<option value="">Pilih Kelas...</option>
													<?php 
													foreach ($select_options_kelas as $item) { 
													?>
													<option value="<?php echo $item->id_kelas;?>" <?= $idkelas > 0 ? ($item->id_kelas == $idkelas ? 'selected' : '') : '' ?>> <?php echo $item->alias_kelas; ?> </option>
													<?php } ?>
											</select>
										</div>
										<div class="col-md-3">
											<select id="mapel" class="form-control">
												<option value="">Pilih Mata Pelajaran...</option>
												<? if ($idkelas > 0){ ?>
												<? foreach($carimapel as $mapel){	?>
													<option value="<?php echo $mapel->id_mapel; ?>" <?= $idmapel == $mapel->id_mapel ? 'selected' : '' ?>><?php echo $mapel->nama_mapel; ?></option>
												<? } ?>
											<? } ?>
											</select>
										</div>
										<div class="col-md-6">
											<select id="mapok" class="form-control">
												<option value="">Pilih Materi Pokok...</option>
												<? if ($idkelas > 0 && $idmapel > 0){ ?>
												<? foreach($carimapok as $mapok){	?>
													<option value="<?php echo $mapok->id_materi_pokok; ?>" <?= $idmapok == $mapok->id_materi_pokok ? 'selected' : '' ?>><?php echo $mapok->nama_materi_pokok; ?></option>
												<? } ?>
											<? } ?>
											</select>
										</div>
									</div>

									<div class="row" style="margin-bottom:20px;">
										<div class="col-md-12">
                                            <div class="cf nestable-lists">
                                              <div class="dd" id="nestable_<?php echo $idmapel;?>" >
                                                <ol class="dd-list">
                                                <?php 
                                                if ($list_materi_pokok != NULL){
												  foreach ($list_materi_pokok as $makok) {
                                                  ?>
                                                    <li class="dd-item" data-id="pok-<?php echo $makok->id_materi_pokok?>">
                                                      <div class="dd-handle"><?php echo (strlen($makok->nama_materi_pokok) > 45) 
                                                        ? substr($makok->nama_materi_pokok, 0, 45)."..." 
                                                        : $makok->nama_materi_pokok ?></div>

                                                        <!--SUB MATERI-->
                                                        <ol class="dd-list">
                                                        <?php
                                                        if ($list_sub_materi != NULL){ 
															foreach ($list_sub_materi as $submateri) {
																if($submateri->materi_pokok_id == $makok->id_materi_pokok){
                                                        ?>
                                                              <?php 
                                                              $icon;
                                                              if ($submateri->kategori == 1) { $icon = "glyphicon glyphicon-file"; }
                                                              else if ($submateri->kategori == 2) { $icon = "glyphicon glyphicon-play-circle"; }
                                                              else if ($submateri->kategori == 3) { $icon = "glyphicon glyphicon-star"; }
                                                             
                                                              if(strlen($submateri->nama_sub_materi) > 45) {
                                                                $string_start = substr($submateri->nama_sub_materi, 0, 35);
                                                                $string_end = substr($submateri->nama_sub_materi, -15);
                                                                $nama_sub_materi = substr($string_start, 0, strrpos($string_start, ' ')) . '...' . substr($string_end, strpos($string_end, ' '));
                                                              }
                                                              else {
                                                                $nama_sub_materi = $submateri->nama_sub_materi;
                                                              }
                                                              ?>
                                                             <li class="dd-item" data-id="sub-<?php echo $submateri->id_sub_materi?>">
                                                              <!-- <div class="btn-sub"> -->
                                                                <div class="dd-handle">
                                                                  <span class="<?php echo $icon; ?>"></span> <?php echo $nama_sub_materi?>
                                                                </div>
                                                                
                                                                <?php if($submateri->kategori == 999) //jika kategori == 2 (video)
                                                                { 
                                                                  $toggle = ($submateri->is_demo == 0) ? 'btn-fill' : '';
                                                                  ?>
                                                                  <div class="btn btn-xs btn-success <?php echo $toggle; ?>" id="demo-<?php echo $submateri->id_sub_materi;?>" title="Set video sebagai Demo">
                                                                    <span class="glyphicon glyphicon-play"></span>
                                                                  </div>
                                                                <?php } ?>
                                                              
                                                              <!-- </div> -->
                                                            </li>                                                          
                                                        <?php
																}
															}
                                                        }
                                                        ?>
                                                        </ol>
                                                        <!--SUB MATERI-->

                                                    </li>
                                                  <?php
                                                  }
												}
                                                ?>
                                                </ol>
                                              </div>

                                            </div>
                                            
                                            <?php if ($idmapel > 0){ ?>
											<button type="button" name="map-<?php echo $idmapel;?>" class="btn btn-primary btn-fill pull-right" value="<?php echo $idmapel;?>">Simpan Perubahan</button>
                                            <?php } ?>
											
										</div>
									</div>


<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!-- Nestable plugin  -->
<script type="text/javascript">
$(document).ready(function()
{
    var parentTab = $('ul.nav.nav-tabs li:first-child ul.dropdown-menu li:first-child a');
    parentTab.click(function() {
      $('.nav-pills.nav-stacked li:first-child a').trigger('click');
    });
    parentTab.trigger('click');
  // console.log("opo:" + opo);

  //disable all update button
  $("button[name*='map-']").prop('disabled', true);

  $("button[name*='map-']").click(function(e){
      var target_name = e.target.name;
      var target_val = e.target.value;
      var id = parseInt(target_name.replace(/map-/g, ''))
      // console.log("TRGET_name= " + e.target.name);
      // console.log("TRGET_val = " + e.target.value);
      // console.log("parseInt= " + i);
      // console.log("isNan&= " + isNaN(target_name));
      if(id == target_val)
      { 
        sendAjaxPost(target_val, $('#nestable_' + id)); 
      }
      
      //disable update button        
      $("button[name='"+target_name+"']").prop('disabled', true);
  });

  var sendAjaxPost = function(id, e)
  {
    // var target_id = e.length ? e : e.target.id;
      var target_id = e;
      $.post("<?=base_url('pg_admin/materi_urutan/ajax_handler');?>",
      {
        id_mapel: id, 
        json: window.JSON.stringify(target_id.nestable('serialize'))
      },
      function(data, status){
          console.log("\nStatus: " + status + "\nData: " + data);
      });
  }

  var disableButton = function(target_id)
  {
      console.log("target_id :" + target_id);
      target_name = target_id.replace(/nestable_/g, 'map-');
      console.log("target_name :" + target_name);
      $('button[name='+target_name+']').prop('disabled', false);
  }

  var updateOutput = function(e)
  {
      var list   = e.length ? e : $(e.target),
          output = list.data('output'),
          target_id = e.length ? e : e.target.id;
      if (window.JSON) {
          console.log(target_id);
          disableButton(target_id);
          // output.val(target_id + ": \n" + window.JSON.stringify(list.nestable('serialize')));//, null, 2));
      } else {
          output.val('JSON browser support required for this demo.');
      }
  };

  // activate Nestable per id_mapel
  <?php 
  if ($list_mapel != NULL){	
	foreach ($list_mapel as $init_mapel) {
  ?>
    $('<?php echo "#nestable_".$init_mapel->id_mapel;?>').nestable({ 
      group: 1, 
      maxDepth: 3,
      enableHMove: false 
    }).on('change', updateOutput);

    // updateOutput($('<?php echo "#nestable_".$init_mapel->id_mapel;?>').data('output', $('#nestable-output')));
  <?php
	}
  }
  ?>

  // output initial serialised data
  // updateOutput($('#nestable').data('output', $('#nestable-output')));

  $('.nestable-menu').on('click', function(e)
  {
      var target = $(e.target),
          action = target.data('action');
      if (action === 'expand-all') {
          $('.dd').nestable('expandAll');
      }
      if (action === 'collapse-all') {
          $('.dd').nestable('collapseAll');
      }
  });

  $("[id*='demo-']").on('click', function(e)
  {
    var e_id = $(this).attr('id');
    var element = $("[id^='"+e_id+"'");

    var ids = e_id.split('-');
    var id_sub = ids[1];

    console.log(id_sub);

    $.post("<?php echo base_url('pg_admin/materi_urutan/ajax_set_demo'); ?>",
      {
        id: id_sub, 
      },
      function(data, status) {
          console.log("\nStatus: " + status + "\nData: " + data);
          if(data == 1)
          {
            console.log(element);
            if(element.hasClass('btn-fill')) {
              element.removeClass('btn-fill');
            }
            else {
              element.addClass('btn-fill');
            }
          }
      })

  });

});
</script>

