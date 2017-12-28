<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php";?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title"><?php echo isset($page_title) ? $page_title : "Tambah Materi"?></h4>
                <!-- <p class="category">24 Hours performance</p> -->
              </div>
              <div class="content">
                <form method="post" action="<?php echo $form_action?>"> 
                  <div class="form-group">
                    <label>Mata Pelajaran<span class="text-danger">*</span></label>
                    <?php echo form_error('nama_mapel', '<div class="text-danger">', '</div>'); ?>
                    <div class="row">
                      <div class="col-md-6">
                        <select data-placeholder="Pilih Mata Pelajaran..." name="nama_mapel" class="chosen-select" onchange="fetch_select_materi_pokok(this.value)" style="width: 100%;" tabindex="2" required="required">
                          <option value=""></option>
                          <?php 
                          foreach ($select_options_mapel as $item) { 
                            $option_name = $item->nama_mapel . " - " . $item->alias_kelas;
                          ?>
                          <option <?php echo set_select('nama_mapel', $item->id_mapel, (!isset($data->id_mapel) ? FALSE : ($data->id_mapel == $item->id_mapel ? TRUE : FALSE)) );?> value="<?php echo $item->id_mapel ?>" > <?php echo $option_name ?> </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Materi Pokok<span class="text-danger">*</span></label>
                    <?php echo form_error('materi_pokok', '<div class="text-danger">', '</div>'); ?>
                    <div class="row">
                      <div class="col-xs-6 col-md-6">
                        <select data-placeholder="Pilih Materi Pokok..." id="materi_pokok" name="materi_pokok" class="chosen-select" style="width: 100%;" tabindex="3" required="required">
                          <option value=""></option>
                          <?php 
                          foreach ($select_options_materi_pokok as $item) { ?>
                            <option <?php echo set_select('materi_pokok', $item->id_materi_pokok, (!isset($data->id_materi_pokok) ? FALSE : ($data->id_materi_pokok == $item->id_materi_pokok ? TRUE : FALSE)) );?> value="<?php echo $item->id_materi_pokok ?>" > <?php echo $item->nama_materi_pokok ?> </option>
                          <?php } ?>
                        </select>
                      </div>
                      <div id="ajax-loading" class="col-xs-1 col-md-1" style="display:none;"> 
                        <img src="<?php echo base_url('assets/img/ajax-loading.gif')?>" alt="Loading..."></img>
                      </div>
                    </div>
                  </div> 

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Judul Materi Pembelajaran<span class="text-danger">*</span></label>
                        <?php echo form_error('judul_materi', '<div class="text-danger">', '</div>'); ?>
                        <input type="text" name="judul_materi" class="form-control" placeholder="Judul Materi Pembelajaran" value="<?php echo set_value('judul_materi', isset($data) ? $data->nama_sub_materi : '');?>" required="required">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Kurikulum<span class="text-danger">*</span></label>
                        <?php echo form_error('kurikulum', '<div class="text-danger">', '</div>'); ?>
						<div>
							<?php 
							if (isset($data)){
								if (strpos($data->kurikulum,'KTSP') !== FALSE){
									$k1 = 'checked';
								} else {
									$k1 = '';
								}
								if (strpos($data->kurikulum,'K-13') !== FALSE){
									$k2 = 'checked';
								} else {
									$k2 = '';
								}
                if ($data->k_13_revisi == 1){
                  $krev = 'checked';
                } else {
                  $krev = '';
                }
							} else {
								$k1 = '';
								$k2 = '';
                $krev = '';
							}
							?>
							<label class="checkbox-inline" style="margin-top:10px;">
								<input type="checkbox" name="kurikulum[]" value="KTSP" <?php echo $k1 ?>>KTSP
							</label>
							<label class="checkbox-inline" style="margin-top:10px;">
								<input type="checkbox" name="kurikulum[]" value="K-13" <?php echo $k2 ?>>K-13
							</label>
              <label class="checkbox-inline" style="margin-top:10px;">
                <input type="checkbox" name="k13rev" value="1" <?php echo $krev ?>>K-13 Revisi
              </label>
						</div> 
                      </div>
                    </div>
                  </div>
				  
                  <?php $hide = true;?>
                  <?php if($hide==false) { ?>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Deskripsi Materi Pembelajaran<span class="text-danger"></span></label>
                        <textarea name="deskripsi_materi" class="form-control" placeholder="Deskripsi Materi Pembelajaran" rows="4"><?php echo set_value('deskripsi_materi', isset($data->deskripsi_sub_materi) ? $data->deskripsi_sub_materi : '');?></textarea>
                      </div>
                    </div>
                  </div>
                  <?php } ?>

                  <div class="form-group">
                    <label>Kategori</label>
                    <?php echo form_error('kategori_materi', '<div class="text-danger">', '</div>'); ?>
                    <?php $id_kategori = isset($data->kategori) ? ($data->kategori-1) : 0; //$id_kategori diperlukan untuk javascript dibawah ?>
                    <div class="row">
                      <div class="col-md-6">
                        <ul class="nav nav-pills" id="kategoriKontenTab">
                          <li class="dropdown"> 
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <span id="choice">Activity</span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#kategori_teks" value="1" data-toggle="tab">Teks</a></li>
                                <li><a href="#kategori_video" value="2" data-toggle="tab">Video</a></li>
                                <li><a href="#kategori_soal" value="3" data-toggle="tab">Soal</a></li>
                            </ul>
                          </li>
                        </ul>
                        <input type="hidden" name="kategori_materi" id="kategori_materi" style="display:none;"/>
                        <input type="hidden" name="jumlah_soal" id="jumlah_soal" style="display:none;" value="<?php echo set_value('jumlah_soal', isset($jumlah_soal_submateri) ? $jumlah_soal_submateri : 0);?>" />
                      </div>
                    </div>
                  </div>

                  <label>Konten</label>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="tab-content">
                          <div class="tab-pane fade in active" id="kategori_teks">
                            <!-- TEKS -->
                            <textarea name="konten_materi" id="tinymce_konten_materi" class="form-control tinymce_textarea" style="height:400px;"><?php echo set_value('konten_materi', isset($data->isi_materi) ? html_entity_decode($data->isi_materi) : '');?></textarea>
                            <?php
                                if(!isset($data)){
                                    ?>
                                    <div class="col-sm-6">
    									Status Materi :
    									<select data-placeholder="Status Materi" name="status_konten" class="chosen-select" style="width: 100%;" tabindex="3" required="required">
    										<?php
    											if(isset($data->status_konten)){
    												if($data->status_konten == 0){
    													?>
    														<option value="0" selected>Waiting Approval</option>
    													<?php
    												}elseif($data->status_konten == 1){
    													?>
    														<option value="1" selected>Approved</option>
    													<?php
    												}elseif($data->status_konten == 2){
    													?>
    														<option value="2" selected>Perlu Revisi</option>
    													<?php
    												}elseif($data->status_konten == 3){
    													?>
    														<option value="3" selected>Belum di QC Tentor</option>
    													<?php
    												}
    											}
    										?>
    										<?php
    											if($this->session->userdata('level') !== "adminqc"){
    												?>
    												<option value="0">Waiting Approval</option>
    												<option value="2">Perlu Revisi</option>
    												<option value="3">Belum di QC Tentor</option>
    												<?php
    											}else{
    												?>
    												<option value="0">Waiting Approval</option>
    												<option value="1">Approved</option>
    												<option value="2">Perlu Revisi</option>
    												<option value="3">Belum di QC Tentor</option>
    												<?php
    											}
    										?>
    									</select>
    								</div>
    								<div class="col-sm-6">
    									Catatan Revisi :
    									<br>
    										<?php
    											if(isset($data->catatan_revisi)){
    											    ?>
    											    <textarea name="catatan_revisi"><?php echo $data->catatan_revisi;?></textarea>
    											    <?php
    												echo $data->catatan_revisi;
    											}else{
    											    ?>
    											    <textarea name="catatan_revisi"></textarea>
    											    <?php
    											}
    										?>
    								</div>
                                    <?php
                                }
                            ?>
                          </div>
                          <div class="tab-pane fade" id="kategori_video">
                            <!-- VIDEO -->
                            <label>Video URL</label>
                            <input type="url" name="konten_video" id="video_input_box" class="form-control" placeholder="Video URL" value="<?php echo set_value('konten_video', isset($data->video_materi) ? $data->video_materi : '');?>" />
                          </div>
                          <div class="tab-pane fade" id="kategori_soal">
                            <!-- SOAL -->
                            <div class="panel-group" id="accordion">

                            <?php
                            $ke = 1; 
                            $id_soal_array = array();
                            if(isset($data_soal_submateri) && $jumlah_soal_submateri!=0)
                            {
                              foreach ($data_soal_submateri as $data_soal) {
                                // echo "ID SOAL: ".$data_soal->id_soal;
                              ?>
                              <div class="panel panel-default">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $ke; ?>">
                                  <h4 class="panel-title">
                                    Item Soal Ke- <?php echo $ke; ?>
                                    <?php $id_soal_array[] = $data_soal->id_soal; ?>
                                  </h4>
                                </div>

                                <div id="collapse<?php echo $ke; ?>" class="panel-collapse collapse">
                                  <div class="panel-body">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label>Pertanyaan<span class="text-danger">*</span></label>
                                          <?php echo form_error('isi_soal<?php echo $ke; ?>', '<div class="text-danger">', '</div>'); ?>
                                          <textarea name="isi_soal<?php echo $ke; ?>" id="tinymce_soal<?php echo $ke; ?>" class="form-control tinymce_textarea" style="height:200px;"><?php echo set_value('isi_soal', isset($data_soal) ? html_entity_decode($data_soal->isi_soal) : '');?></textarea>
                                        </div>
                                      </div>
                                    </div>
                            
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Kunci Jawaban<span class="text-danger">*</span></label>
                                          <select data-placeholder="Kunci Jawaban" name="kunci_jawaban<?php echo $ke; ?>" class="form-control" >
                                            <option value="" disabled selected>Pilih Kunci Jawaban</option>
                                            <option <?php echo set_select('kunci_jawaban<?php echo $ke; ?>', '1', (!isset($data_soal->kunci_jawaban) ? FALSE : ($data_soal->kunci_jawaban == '1' ? TRUE : FALSE)) );?> value="1">Jawaban 1</option>
                                            <option <?php echo set_select('kunci_jawaban<?php echo $ke; ?>', '2', (!isset($data_soal->kunci_jawaban) ? FALSE : ($data_soal->kunci_jawaban == '2' ? TRUE : FALSE)) );?> value="2">Jawaban 2</option>
                                            <option <?php echo set_select('kunci_jawaban<?php echo $ke; ?>', '3', (!isset($data_soal->kunci_jawaban) ? FALSE : ($data_soal->kunci_jawaban == '3' ? TRUE : FALSE)) );?> value="3">Jawaban 3</option>
                                            <option <?php echo set_select('kunci_jawaban<?php echo $ke; ?>', '4', (!isset($data_soal->kunci_jawaban) ? FALSE : ($data_soal->kunci_jawaban == '4' ? TRUE : FALSE)) );?> value="4">Jawaban 4</option>
                                            <option <?php echo set_select('kunci_jawaban<?php echo $ke; ?>', '5', (!isset($data_soal->kunci_jawaban) ? FALSE : ($data_soal->kunci_jawaban == '5' ? TRUE : FALSE)) );?> value="5">Jawaban 5</option>
                                          </select>
                                        </div>
									  <label>Bobot Soal<span class="text-danger">*</span></label>
									  <select data-placeholder="Bobot Soal" name="bobot<?php echo $ke; ?>" class="form-control" required="required">
										<option value="">Pilih Bobot Soal</option>
										<option <?php echo set_select('bobot', '1', (!isset($data_soal->bobot) ? FALSE : ($data_soal->bobot == '1' ? TRUE : FALSE)) );?> value="1">Mudah</option>
										<option <?php echo set_select('bobot', '2', (!isset($data_soal->bobot) ? TRUE : ($data_soal->bobot == '2' ? TRUE : FALSE)) );?> value="2">Sedang</option>
										<option <?php echo set_select('bobot', '3', (!isset($data_soal->bobot) ? FALSE : ($data_soal->bobot == '3' ? TRUE : FALSE)) );?> value="3">Sulit</option>
									  </select>
									</div>
									<!-- FORM BUAT ATRIBUSI SOAL -->
									<!-- ####################### -->
									<div class="col-sm-6">
										<div class="col-sm-12">
										<label>Atribut : </label>
										</div>
										<div class="col-sm-12" style="height: 400px; overflow: scroll;">
											<table class="table table-striped">
												<?php
													$jumlahatribut = $this->model_atribut->fetch_jumlah_atribut();
													
													if($jumlahatribut > 0){
														$fetchatribut = $this->model_atribut->fetch_parent();
														
														foreach($fetchatribut as $parent){
															$cekatribut = $this->model_atribut->cek_atribut_soal($data_soal->id_soal, $parent->id_atribut);
															?>
															<tr id="tr-<?php echo $parent->id_atribut;?>" style="width: 10px;">
																<td class="text-center">
																	<input type="checkbox" name="checkatr[<?php echo $data_soal->id_soal;?>][<?php echo $parent->id_atribut;?>]" value="<?php echo $parent->id_atribut;?>"
																	<?php
																	if($cekatribut > 0){
																		echo "checked";
																	}
																	?>
																	>
																</td>
																<td>
																	<?php echo $parent->atribut;?>
																</td>
															</tr>
															<?php
															$fetchchild = $this->model_atribut->fetch_child($parent->id_atribut);
															
															foreach($fetchchild as $child){
																$cekatribut = $this->model_atribut->cek_atribut_soal($data_soal->id_soal, $child->id_atribut);
																?>
																<tr id="tr-<?php echo $child->id_atribut;?>">
																<td class="text-center">
																	<input type="checkbox" name="checkatr[<?php echo $data_soal->id_soal;?>][<?php echo $child->id_atribut;?>]" value="<?php echo $child->id_atribut;?>" 
																	<?php
																	if($cekatribut > 0){
																		echo "checked";
																	}
																	?>
																	>
																</td>
																<td>
																	- <?php echo $child->atribut;?>
																</td>
															</tr>
																<?php
															}
														}
													}
												?>
											</table>
										</div>
									</div>
									<!-- ####################### -->
									<!-- ####################### -->
								  </div>

                                    <div class="row">
                                      <div class="col-md-12">
                                        <label>Pilihan Jawaban<span class="text-danger">*</span></label>
                                        <ul class="nav nav-tabs">
                                          <li class="active"><a data-toggle="tab" href="#tab_jawab_1<?php echo $ke; ?>">Jawaban 1</a></li>
                                          <li><a data-toggle="tab" href="#tab_jawab_2<?php echo $ke; ?>">Jawaban 2</a></li>
                                          <li><a data-toggle="tab" href="#tab_jawab_3<?php echo $ke; ?>">Jawaban 3</a></li>
                                          <li><a data-toggle="tab" href="#tab_jawab_4<?php echo $ke; ?>">Jawaban 4</a></li>
                                          <li><a data-toggle="tab" href="#tab_jawab_5<?php echo $ke; ?>">Jawaban 5</a></li>
                                        </ul>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="tab-content">
                                          <div id="tab_jawab_1<?php echo $ke; ?>" class="tab-pane fade in active">
                                            <div class="form-group">
                                              <?php echo form_error('jawab_1<?php echo $ke; ?>', '<div class="text-danger">', '</div>'); ?>
                                              <textarea name="jawab_1<?php echo $ke; ?>" id="tinymce_jawab_1<?php echo $ke; ?>" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_1<?php echo $ke; ?>', isset($data_soal) ? html_entity_decode($data_soal->jawab_1) : '');?></textarea>
                                            </div>
                                          </div>
                                          <div id="tab_jawab_2<?php echo $ke; ?>" class="tab-pane fade ">
                                            <div class="form-group">
                                              <?php echo form_error('jawab_2<?php echo $ke; ?>', '<div class="text-danger">', '</div>'); ?>
                                              <textarea name="jawab_2<?php echo $ke; ?>" id="tinymce_jawab_2<?php echo $ke; ?>" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_2<?php echo $ke; ?>', isset($data_soal) ? html_entity_decode($data_soal->jawab_2) : '');?></textarea>
                                              <!-- <input type="text" name="jawab_2" class="form-control" placeholder="Jawaban 2" value="<?php echo set_value('jawab_2', isset($data_soal) ? $data_soal->jawab_2 : '');?>" required="required"> -->
                                            </div>
                                          </div>
                                          <div id="tab_jawab_3<?php echo $ke; ?>" class="tab-pane fade ">
                                            <div class="form-group">
                                              <?php echo form_error('jawab_3<?php echo $ke; ?>', '<div class="text-danger">', '</div>'); ?>
                                              <textarea name="jawab_3<?php echo $ke; ?>" id="tinymce_jawab_3<?php echo $ke; ?>" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_3<?php echo $ke; ?>', isset($data_soal) ? html_entity_decode($data_soal->jawab_3) : '');?></textarea>
                                            </div>
                                          </div>
                                          <div id="tab_jawab_4<?php echo $ke; ?>" class="tab-pane fade ">
                                            <div class="form-group">
                                              <?php echo form_error('jawab_4<?php echo $ke; ?>', '<div class="text-danger">', '</div>'); ?>
                                              <textarea name="jawab_4<?php echo $ke; ?>" id="tinymce_jawab_4<?php echo $ke; ?>" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_4<?php echo $ke; ?>', isset($data_soal) ? html_entity_decode($data_soal->jawab_4) : '');?></textarea>
                                            </div>
                                          </div>
                                          <div id="tab_jawab_5<?php echo $ke; ?>" class="tab-pane fade ">
                                            <div class="form-group">
                                              <?php echo form_error('jawab_5<?php echo $ke; ?>', '<div class="text-danger">', '</div>'); ?>
                                              <textarea name="jawab_5<?php echo $ke; ?>" id="tinymce_jawab_5<?php echo $ke; ?>" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_5<?php echo $ke; ?>', isset($data_soal) ? html_entity_decode($data_soal->jawab_5) : '');?></textarea>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label>Pembahasan</label>
                                          <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#tab_pembahasan_teks<?php echo $ke; ?>">Teks</a></li>
                                            <li><a data-toggle="tab" href="#tab_pembahasan_video<?php echo $ke; ?>">Video</a></li>
                                          </ul>

                                          <div class="tab-content">
                                            <div id="tab_pembahasan_teks<?php echo $ke; ?>" class="tab-pane fade in active">
                                              <div class="form-group">
                                                <textarea name="pembahasan<?php echo $ke; ?>" id="pembahasan_teks<?php echo $ke; ?>" class="form-control tinymce_textarea" rows="10"><?php echo set_value('pembahasan<?php echo $ke; ?>', isset($data_soal) ? html_entity_decode($data_soal->pembahasan) : '');?></textarea>
                                              </div>
                                            </div>
                                            <div id="tab_pembahasan_video<?php echo $ke; ?>" class="tab-pane fade ">
                                              <div class="form-group">
                                                <input type="url" name="pembahasan_video<?php echo $ke; ?>" id="pembahasan_video<?php echo $ke; ?>" class="form-control" placeholder="URL Video" value="<?php echo set_value('pembahasan_video<?php echo $ke; ?>', isset($data_soal->pembahasan_video) ? $data_soal->pembahasan_video : ''); ?>" >
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
									  
									    <div class="col-sm-6">
											  <label>Set Status<span class="text-danger">*</span> <?php echo $data_soal->status;?></label>
											  <select name="status<?php echo $ke; ?>" style="width: 100%;" required="required">
												<?php
													if($data->kategori == 3){
														?>
														<option value="<?php echo $data_soal->status;?>" selected>
														    <?php
														    if($data_soal->status == 0){
														        echo "Waiting Approval";
														    }elseif($data_soal->status == 1){
														        echo "Approved";
														    }elseif($data_soal->status == 10){
														        echo "Approved";
														    }elseif($data_soal->status == 2){
														        echo "Pembahasan tidak lengkap";
														    }elseif($data_soal->status == 3){
														        echo "Belum ada pembobotan";
														    }elseif($data_soal->status == 4){
														        echo "Soal membingungkan";
														    }elseif($data_soal->status == 5){
														        echo "Soal double (perlu dihapus)";
														    }elseif($data_soal->status == 6){
														        echo "Soal tidak layak (perlu dihapus)";
														    }elseif($data_soal->status == 7){
														        echo "Pindah soal";
														    }elseif($data_soal->status == 8){
														        echo "Soal belum di QC Tentor";
														    }elseif($data_soal->status == 9){
														        echo "Video Salah";
														    }
														    ?>
														</option>
														<?php
                            								if($this->session->userdata('level') == "adminqc"){
                            									?>
                            									<option value="10">Approved</option>
                            									<?php
                            								}
                            							?>
														<option value="0">Waiting Approval</option>
														<option value="2">Pembahasan tidak lengkap</option>
														<option value="3">Belum ada pembobotan</option>
														<option value="4">Soal membingungkan</option>
														<option value="5">Soal double (perlu dihapus)</option>
														<option value="6">Soal tidak layak (perlu dihapus)</option>
														<option value="8">Soal belum di QC Tentor</option>
														<option value="7">Pindah soal</option>
														<option value="9">Video Salah</option>
														<?php
													}else{
														?>
														<option value="0">Waiting Approval</option>
														<?php
													}
												?>
											  </select>
										</div>
                                    </div>
                                  </div>
                                
                                </div>
                              </div> <!-- /panel-default -->
                              <?php $ke++; 
                              } 
                            }
                            // form below will be used to insert soal when current submateri has no soal
                            else 
                            { ?>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Pertanyaan<span class="text-danger">*</span></label>
                                  <?php echo form_error('isi_soal', '<div class="text-danger">', '</div>'); ?>
                                  <textarea name="isi_soal" id="tinymce_soal" class="form-control tinymce_textarea" style="height:200px;"><?php echo set_value('isi_soal', isset($data->isi_soal) ? html_entity_decode($data->isi_soal) : '');?></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <label>Kunci Jawaban<span class="text-danger">*</span></label>
                                <select data-placeholder="Kunci Jawaban" name="kunci_jawaban" class="form-control">
                                  <option value="" disabled selected>Pilih Kunci Jawaban</option>
                                  <option <?php echo set_select('kunci_jawaban', '1', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '1' ? TRUE : FALSE)) );?> value="1">Jawaban 1</option>
                                  <option <?php echo set_select('kunci_jawaban', '2', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '2' ? TRUE : FALSE)) );?> value="2">Jawaban 2</option>
                                  <option <?php echo set_select('kunci_jawaban', '3', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '3' ? TRUE : FALSE)) );?> value="3">Jawaban 3</option>
                                  <option <?php echo set_select('kunci_jawaban', '4', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '4' ? TRUE : FALSE)) );?> value="4">Jawaban 4</option>
                                  <option <?php echo set_select('kunci_jawaban', '5', (!isset($data->kunci_jawaban) ? FALSE : ($data->kunci_jawaban == '5' ? TRUE : FALSE)) );?> value="5">Jawaban 5</option>
                                </select>
							  <label>Bobot Soal<span class="text-danger">*</span></label>
							  <select data-placeholder="Bobot Soal" name="bobot" class="form-control" required="required">
								<option value="">Pilih Bobot Soal</option>
								<option <?php echo set_select('bobot', '1', (!isset($data->bobot) ? FALSE : ($data->bobot == '1' ? TRUE : FALSE)) );?> value="1">Mudah</option>
								<option <?php echo set_select('bobot', '2', (!isset($data->bobot) ? TRUE : ($data->bobot == '2' ? TRUE : FALSE)) );?> value="2">Sedang</option>
								<option <?php echo set_select('bobot', '3', (!isset($data->bobot) ? FALSE : ($data->bobot == '3' ? TRUE : FALSE)) );?> value="3">Sulit</option>
							  </select>
							</div>
							
							
							<div class="col-md-6">
								<div class="col-sm-12">
								<label>Atribut : </label>
								</div>
								<div class="col-sm-12" style="height: 400px; overflow-x: scroll;">
									<table class="table table-striped">
										<?php
											$jumlahatribut = $this->model_atribut->fetch_jumlah_atribut();
											
											if($jumlahatribut > 0){
												$fetchatribut = $this->model_atribut->fetch_parent();
											
												foreach($fetchatribut as $parent){
													?>
													<tr id="tr-<?php echo $parent->id_atribut;?>" style="width: 10px;">
														<td class="text-center">
															<input type="checkbox" name="checkatr[<?php echo $parent->id_atribut;?>]" value="<?php echo $parent->id_atribut;?>">
														</td>
														<td>
															<?php echo $parent->atribut;?>
														</td>
													</tr>
													<?php
													$fetchchild = $this->model_atribut->fetch_child($parent->id_atribut);
													
													foreach($fetchchild as $child){
														?>
														<tr id="tr-<?php echo $child->id_atribut;?>">
														<td class="text-center">
															<input type="checkbox" name="checkatr[<?php echo $child->id_atribut;?>]" value="<?php echo $child->id_atribut;?>">
														</td>
														<td>
															- <?php echo $child->atribut;?>
														</td>
													</tr>
														<?php
													}
												}
											}
										?>
									</table>
								</div>
							</div>
						  </div>

                            <div class="row">
                              <div class="col-md-12">
                                <label>Pilihan Jawaban<span class="text-danger">*</span></label>

                                <ul class="nav nav-tabs">
                                  <li class="active"><a data-toggle="tab" href="#tab_jawab_1">Jawaban 1</a></li>
                                  <li><a data-toggle="tab" href="#tab_jawab_2">Jawaban 2</a></li>
                                  <li><a data-toggle="tab" href="#tab_jawab_3">Jawaban 3</a></li>
                                  <li><a data-toggle="tab" href="#tab_jawab_4">Jawaban 4</a></li>
                                  <li><a data-toggle="tab" href="#tab_jawab_5">Jawaban 5</a></li>
                                </ul>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="tab-content">
                                  <div id="tab_jawab_1" class="tab-pane fade in active">
                                    <div class="form-group">
                                      <?php echo form_error('jawab_1', '<div class="text-danger">', '</div>'); ?>
                                      <textarea name="jawab_1" id="tinymce_jawab_1" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_1', isset($data->jawab_1) ? html_entity_decode($data->jawab_1) : '');?></textarea>
                                    </div>
                                  </div>
                                  <div id="tab_jawab_2" class="tab-pane fade ">
                                    <div class="form-group">
                                      <?php echo form_error('jawab_2', '<div class="text-danger">', '</div>'); ?>
                                      <textarea name="jawab_2" id="tinymce_jawab_2" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_2', isset($data->jawab_2) ? html_entity_decode($data->jawab_2) : '');?></textarea>
                                      <!-- <input type="text" name="jawab_2" class="form-control" placeholder="Jawaban 2" value="<?php echo set_value('jawab_2', isset($data) ? $data->jawab_2 : '');?>" required="required"> -->
                                    </div>
                                  </div>
                                  <div id="tab_jawab_3" class="tab-pane fade ">
                                    <div class="form-group">
                                      <?php echo form_error('jawab_3', '<div class="text-danger">', '</div>'); ?>
                                      <textarea name="jawab_3" id="tinymce_jawab_3" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_3', isset($data->jawab_3) ? html_entity_decode($data->jawab_3) : '');?></textarea>
                                    </div>
                                  </div>
                                  <div id="tab_jawab_4" class="tab-pane fade ">
                                    <div class="form-group">
                                      <?php echo form_error('jawab_4', '<div class="text-danger">', '</div>'); ?>
                                      <textarea name="jawab_4" id="tinymce_jawab_4" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_4', isset($data->jawab_4) ? html_entity_decode($data->jawab_4) : '');?></textarea>
                                    </div>
                                  </div>
                                  <div id="tab_jawab_5" class="tab-pane fade ">
                                    <div class="form-group">
                                      <?php echo form_error('jawab_5', '<div class="text-danger">', '</div>'); ?>
                                      <textarea name="jawab_5" id="tinymce_jawab_5" class="form-control tinymce_textarea" style="height:150px;"><?php echo set_value('jawab_5', isset($data->jawab_5) ? html_entity_decode($data->jawab_5) : '');?></textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <hr>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Pembahasan</label>
                                  <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab_pembahasan_teks">Teks</a></li>
                                    <li><a data-toggle="tab" href="#tab_pembahasan_video">Video</a></li>
                                  </ul>

                                  <div class="tab-content">
                                    <div id="tab_pembahasan_teks" class="tab-pane fade in active">
                                      <div class="form-group">
                                        <textarea name="pembahasan" id="pembahasan_teks" class="form-control tinymce_textarea" rows="10"><?php echo set_value('pembahasan', isset($data->pembahasan) ? html_entity_decode($data->pembahasan) : '');?></textarea>
                                      </div>
                                    </div>
                                    <div id="tab_pembahasan_video" class="tab-pane fade ">
                                      <div class="form-group">
                                        <input type="url" name="pembahasan_video" id="pembahasan_video" class="form-control" placeholder="URL Video" value="<?php echo set_value('pembahasan_video', isset($data->pembahasan_video) ? $data->pembahasan_video : '');?>"></input>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                              </div>
							  
							  <div class="col-sm-6">
								  <label>Set Status<span class="text-danger">*</span></label>
								  <select data-placeholder="Status Soal" name="status" class="chosen-select" style="width: 100%;" tabindex="3" required="required">
									<?php
										if($data->kategori == 3){
											?>
											<option value="">-- SET STATUS --</option>
											<option value="0">Waiting Approval</option>
											<?php
										}else{
											?>
											<option value="0">Waiting Approval</option>
											<?php
										}
									?>
								  </select>
							</div>
							  
                            </div>
                            <?php
                            }

                            echo "<input name='id_soal_array' type='hidden' style='display:none;' value='".(!empty($id_soal_array) ? join(',', $id_soal_array) : '0')."' />";
                            // var_dump($id_soal_array);
                            ?>

                          </div> <!-- /accordion -->

                          </div> <!-- /Tab Pane Fade -->

                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                    <!-- PANEL UNTUK SET STATUS MATER -->
                    <?php
						if(isset($data) and $data->kategori == 1){
							?>
							<div class="row">
								<div class="col-sm-6">
									Status Materi :
									<select data-placeholder="Status Materi" name="status_konten" class="chosen-select" style="width: 100%;" tabindex="3" required="required">
										<?php
											if(isset($data->status_konten)){
												if($data->status_konten == 0){
													?>
														<option value="0" selected>Waiting Approval</option>
													<?php
												}elseif($data->status_konten == 1){
													?>
														<option value="1" selected>Approved</option>
													<?php
												}elseif($data->status_konten == 2){
													?>
														<option value="2" selected>Perlu Revisi</option>
													<?php
												}elseif($data->status_konten == 3){
													?>
														<option value="3" selected>Belum di QC Tentor</option>
													<?php
												}
											}
										?>
										<?php
											if($this->session->userdata('level') !== "adminqc"){
												?>
												<option value="0">Waiting Approval</option>
												<option value="2">Perlu Revisi</option>
												<option value="3">Belum di QC Tentor</option>
												<?php
											}else{
												?>
												<option value="0">Waiting Approval</option>
												<option value="1">Approved</option>
												<option value="2">Perlu Revisi</option>
												<option value="3">Belum di QC Tentor</option>
												<?php
											}
										?>
									</select>
								</div>
								<div class="col-sm-6">
									Catatan Revisi :
									<br>
										<?php
											if(isset($data->catatan_revisi)){
											    ?>
											    <textarea name="catatan_revisi"><?php echo $data->catatan_revisi;?></textarea>
											    <?php
												echo $data->catatan_revisi;
											}else{
											    ?>
											    <textarea name="catatan_revisi"></textarea>
											    <?php
											}
										?>
								</div>
							</div>
							<?php
						}
					?>
					<!-- END PANEL UNTUK SET STATUS MATER -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Gambar Thumbnail</label>
                        <div class="input-group">
                          <input class="form-control" type="text" id="gambar_materi" name="gambar_materi" value="<?php echo set_value('gambar_materi', isset($data) ? $data->gambar_materi : '');?>" >
                          <span class="input-group-btn">
                            <span class="btn btn-success" onclick="openKCFinder(gambar_materi);">Cari Gambar</span>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Tanggal Post <span class="text-danger">*</span></label>
                        <?php echo form_error('tanggal_post', '<div class="text-danger">', '</div>'); ?>
                        <input class="form-control" type="date" id="tanggal_post" name="tanggal_post" value="<?php echo set_value('tanggal_post', (!isset($data) ? date('Y-m-d') : (($data->tanggal!=0) ? $data->tanggal : date('Y-m-d'))) );?>" required="required">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Waktu Post <span class="text-danger">*</span></label>
                        <?php echo form_error('waktu_post', '<div class="text-danger">', '</div>'); ?> 
                        <input class="form-control" type="time" id="waktu_post" name="waktu_post" value="<?php echo set_value('waktu_post', (!isset($data) ? date('H:i') : (($data->waktu!=0) ? $data->waktu : date('H:i'))) );?>" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <button type="submit" name="form_submit" value="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                      <button type="reset" class="btn btn-danger pull-right" onclick="return resetForm(this.form);"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                  </div>
                </form>

                <div class="footer">
                  <hr>
                  <div class="stats">
                    <i class="fa fa-history"></i> Updated 3 minutes ago
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
	
	<form method="post" enctype='multipart/form-data' id="frmupload">
		<input name="filegambar" type="file" id="filegambar" onchange="" style="display:none;">
	</form>
	
    <?php include "footer.php"; ?>

  </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url('assets/js/demo.js');?>"></script>

<!-- Progress -->
<script src="<?= base_url('assets/js/nprogress.js')?>" ></script>

<!-- CUSTOM JS FUNCTION -->
<!-- Reset Form -->
<script type="text/javascript">
  function resetForm(form){
    // clearing Chosen selects
    $('.chosen-select').val('').trigger('chosen:updated');

  }
</script>

<script type="text/javascript">
  // needed to change dropdown text on Kategori select box AND-
  // to pass the id into #kategori_materi input 
  $(document).ready(function(){ 
    $("#kategoriKontenTab .dropdown .dropdown-menu li a").click(function(){
      $('#kategori_materi').val($(this).attr('value'));
      $('.dropdown a span#choice').text($(this).text());
      // console.log($(this).text());
    });

    //set default selected kategori konten (Teks)
    $("#kategoriKontenTab .dropdown .dropdown-menu li a")<?php echo "[".$id_kategori."]"; ?>.click();
    // $("#kategoriKontenTab .dropdown .dropdown-menu li a")<?php echo "[0]"; ?>.click();
  });
</script>

<script type="text/javascript">
  $().ready(function(){
    $('#video_upload_form').submit(function(){
        var video_url_params = '&lightbox[width]=610&lightbox[height]=360';
        var video_url = $('#video_input_box').val() + video_url_params;
        $('#video_preview').attr('href', video_url);
        return false;
    });
});
</script>

<script type="text/javascript">
  //Show/Hide loading image (.gif) on AJAX process
  $(document).ready(function(){
    $(document).ajaxStart(function(){
        $("#ajax-loading").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#ajax-loading").css("display", "none");
    });
  });
</script>

<script type="text/javascript">
  function fetch_select_materi_pokok(val)
  {
    $.ajax({
      type: 'POST',
      url: "<?=base_url('pg_admin/materi/ajax_select_materi_pokok')?>",
      data: { id:val },
      success: function(response){
        document.getElementById('materi_pokok').innerHTML=response;
        
        $("#materi_pokok").trigger("chosen:updated");
      }
    });
  }
</script>

<script type="text/javascript">
  // Used to get the video preview. But get discontinued
  // function fetch_preview_konten_video(url)
  // {
  //   console.log(url)
  //   $.ajax({
  //     type: 'POST',
  //     url: "<?=base_url('pg_admin/materi/ajax_konten_video')?>",
  //     data: { data:url },
  //     success: function(response){
  //       document.getElementById('video_preview').innerHTML=response;
  //     }
  //   });
  // }
</script>

<!-- PLUGINS FUNCTION -->
 <!-- Chosen - select box plugin  -->
 <script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>" type="text/javascript"></script>
 <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>

 <!-- TinyMCE - WYSIWYG plugin  -->
 <script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js');?>" type="text/javascript"></script>
 <script type="text/javascript">
  tinymce.init({
    selector: '.tinymce_textarea',
    skin: 'lightgray',
    menubar: false,
    plugins: [
        "eqneditor advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor",
        "code fullscreen youtube autoresize"
      ],
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table | fullscreen" ,
    toolbar2: "| fontsizeselect | styleselect | link unlink anchor | eqneditor image media youtube | forecolor backcolor | code",
    extended_valid_elements: "+iframe[src|width|height|name|align|class]",
    image_advtab: true,
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
    relative_urls: false,
    remove_script_host: false,
	
	file_picker_callback: function(callback, value, meta) {
      if (meta.filetype == 'image') {
        $('#filegambar').trigger('click');
        $('#filegambar').on('change', function() {
		  
          var path = "<?php echo base_url('assets/uploads/materi') ?>/";
		  var fileInput = document.getElementById('filegambar');   
		  var filename = fileInput.files[0].name;
		  filename = filename.replace(/ /g, "_");
		  fullpath = path + filename;

		  var url = "<?php echo base_url('pg_admin/upload_gambar') ?>";

		  $.ajax({
				type: "POST",
				url: url,
				data: new FormData($('#frmupload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					NProgress.start();
				},
				success: function(data){
					NProgress.done(); 
					callback(fullpath);
				}
		  });

        });
      }
    },

	/*
		//Filemanager
		external_filemanager_path: "<?php echo base_url();?>assets/js/plugins/filemanager/",
		filemanager_title: "Data Filemanager" ,
		external_plugins: { "filemanager" : "<?php echo base_url();?>assets/js/plugins/filemanager/plugin.min.js" },
	 
    //integrating tinymce 4 and kcfinder
    file_browser_callback: function(field, url, type, win) {
      console.log("<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type);
      tinyMCE.activeEditor.windowManager.open({
          file:  "<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
          title: 'KCFinder',
          width: 700,
          height: 250,
          inline: true,
          close_previous: false
      }, {
          window: win,
          input: field
      });
      return false;
    }
	*/
  });
  </script>

  <!-- Manually open kcfinder -->
  <script type="text/javascript">
    function openKCFinder(field) {
      console.log("OPENKCFINDER" + field);
      window.KCFinder = {
        callBack: function(url) {
            // field.value = url; DEFAULT (Full URL)
            field.value = url.substr(url.lastIndexOf("/")+1); //(Get filename only)
            window.KCFinder = null;
        }
      };
      window.open("<?php echo base_url()?>assets/js/plugins/kcfinder/browse.php?type=images&dir=images", 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
      );
    }
  </script>
</html>
