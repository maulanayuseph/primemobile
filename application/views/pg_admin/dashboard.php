<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Manajemen Materi</h4>
                <p class="category">Pengorganisasian Struktur Materi</p>
              </div>
              <div class="content">
              
                <!-- TESTING -->
                
                <!-- 
                <div class="col-md-12">
                  <textarea id="nestable-output" readonly></textarea>
                  <button type="button" id="ajax-run" class="btn btn-secondary">Simpan Perubahan</button>
                </div> -->
                <!-- /TESTING -->

                <div class="row">
                  <div class="col-md-12">
                    <ul class="nav nav-tabs">
                      <?php foreach ($list_jenjang_kelas as $kelas) {
                        ?>
                          <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $kelas->jenjang;?>
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <?php foreach ($list_tingkatan_kelas as $item) {
                                if($item->jenjang == $kelas->jenjang){
                              ?>
                                <li><a href="#<?php echo $kelas->jenjang?>_<?php echo $item->tingkatan_kelas?>" data-toggle="tab">Kelas <?php echo $item->tingkatan_kelas?></a></li>
                              <?php 
                                }
                              }?>
                            </ul>
                          </li>
                        <?php
                      }?>
                      <li class="pull-right">
                        <div class="btn-group nestable-menu" role="group">
                          <button data-action="expand-all" title="Expand All" class="btn btn-sm btn-default btn-fill nestable-menu">
                            <span class="glyphicon glyphicon-collapse-down"></span> Expand
                          </button>
                          <button data-action="collapse-all" title="Collapse All" class="btn btn-sm btn-default btn-fill nestable-menu">
                            <span class="glyphicon glyphicon-collapse-up"></span> Collapse
                          </button>
                        </div>
                      </li>
                    </ul>

                    <div class="tab-content">
                      <?php 
                      foreach ($list_jenjang_kelas as $kelas2) {
                        foreach ($list_tingkatan_kelas as $item2) {
                          if($item2->jenjang == $kelas2->jenjang){
                          ?>
                            <div id="<?php echo $kelas2->jenjang?>_<?php echo $item2->tingkatan_kelas?>" class="tab-pane fade <?php echo ($item2->id_kelas=='1' ? 'in active' : '');?>" >
                              <div class="row">
                                <div class="col-xs-3">
                                  <h4><?php echo $item2->alias_kelas;?></h4>
                                  <ul class="nav nav-pills nav-stacked">
                                    <?php
                                    foreach ($list_mapel as $mapel) {
                                      if($mapel->kelas_id == $item2->id_kelas){
                                      ?>
                                      <li class="<?php echo $mapel->id_mapel==1?'active':'';?>">
                                        <a data-toggle="pill" href="#mp<?php echo $mapel->kelas_id?>-<?php echo $mapel->id_mapel?>"><?php echo $mapel->nama_mapel?></a>
                                      </li>
                                      <?php 
                                      }
                                    }?>
                                  </ul>
                                </div>
                                <div class="col-xs-9">
                                  <div class="tab-content">
                                    <?php
                                    foreach ($list_mapel as $mapel2) {
                                      if($mapel2->kelas_id == $item2->id_kelas){
                                      ?>
                                      <div id="mp<?php echo $mapel2->kelas_id?>-<?php echo $mapel2->id_mapel?>" class="tab-pane fade <?php echo $mapel2->id_mapel==1?'in active':'';?>">
                                        <h4><?php echo $mapel2->nama_mapel?></h4>
                                        
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="cf nestable-lists">
                                              <div class="dd" id="nestable_<?php echo $mapel2->id_mapel;?>" >
                                                <ol class="dd-list">
                                                <?php foreach ($list_materi_pokok as $makok) {
                                                  if($makok->mapel_id == $mapel2->id_mapel){
                                                  ?>
                                                    <li class="dd-item" data-id="pok-<?php echo $makok->id_materi_pokok?>">
                                                      <div class="dd-handle"><?php echo (strlen($makok->nama_materi_pokok) > 45) 
                                                        ? substr($makok->nama_materi_pokok, 0, 45)."..." 
                                                        : $makok->nama_materi_pokok ?></div>
                                                        <?php /* Disable sementara
                                                        <ol class="dd-list">
                                                        <?php 
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
                                                            </li>                                                          <?php
                                                          }
                                                        }
                                                        ?>
                                                        */ ?>
                                                        </ol>
                                                    </li>
                                                  <?php
                                                  }
                                                }
                                                ?>
                                                </ol>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        <button type="button" name="map-<?php echo $mapel2->id_mapel;?>" class="btn btn-primary btn-fill pull-right" value="<?php echo $mapel2->id_mapel;?>">Simpan Perubahan</button>
                                      </div>
                                      <?php 
                                      }
                                    }?>

                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php 
                          }
                        }
                      }
                      ?>
                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div>
</div>

<?php include "alert_modal.php"; ?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!-- PLUGINS FUNCTION -->
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
      $.post("<?=base_url('pg_admin/dashboard/ajax_handler');?>",
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

  // activate Nestable for list 1
  // $('#nestable').nestable({ group: 1, maxDepth: 2 }).on('change', updateOutput);
  
  // activate Nestable per id_mapel
  <?php foreach ($list_mapel as $init_mapel) {
    ?>
    $('<?php echo "#nestable_".$init_mapel->id_mapel;?>').nestable({ 
      group: 1, 
      maxDepth: 3,
      enableHMove: false 
    }).on('change', updateOutput);

    // updateOutput($('<?php echo "#nestable_".$init_mapel->id_mapel;?>').data('output', $('#nestable-output')));
    <?php
  }?>

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

    $.post("<?php echo base_url('pg_admin/dashboard/ajax_set_demo'); ?>",
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


</html>
