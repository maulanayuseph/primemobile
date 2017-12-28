							<div class="row" style="margin: 20px 0px 0px 0px;">
								<div class="col-md-1 col-xs-12">
									<select name="showlimit<?=$tabs?>" id="showlimit<?=$tabs?>" class="form-control" class="form-control" style="padding:8px 3px;">
										<option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10</option>
										<option value="25" <?= $limit == 25 ? 'selected' : '' ?>>25</option>
										<option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
										<option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
									</select>
								</div>
								<div class="col-md-6 col-xs-12"></div>
								<div class="col-md-4 col-xs-12"><input type="text" class="form-control" placeholder="Cari" name="cari<?=$tabs?>" id="cari<?=$tabs?>" value="<?= $caristr ?>"></div>
								<div class="col-md-1 col-xs-12"><a href="javascript:void(0);" onclick="resetfilter(<?=$tabs?>)" class="btn btn-primary btn-block" title="Reset Filter"><i class="glyphicon glyphicon-refresh"></i></a></div>
							</div>
							<hr>
              <div class="table-responsive">

                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>No. Invoice</th>
                        <th>Nama</th>
                        <th>Total Harga (Rp)</th>
                        <th>Metode Pembayaran</th>
                        <th>Expired On</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">File Bukti</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
											if ($table_data != NULL){
                        $no = $no; 
                        foreach ($table_data as $item) 
                        {
                      ?>
                        <tr>
				<td><?php echo $no;?></td>
				<td><?php echo $item->no_tagihan?></td>
				<td>
				<?php 
					if ($item->siswa_id != 0 && $item->metode_pembayaran < 3){
						echo $item->nama_siswa.'<br>'.$item->email_siswa.'<br>'.$item->telepon_siswa;
					} else if ($item->siswa_id == 0 && $item->metode_pembayaran < 3){
						echo ($item->nama != '' ? $item->nama.'<br>' : '').($item->email != '' ? $item->email.'<br>' : '');
					} else if ($item->siswa_id != 0 && $item->metode_pembayaran == 3){
						echo ($item->nama_siswa != '' ? $item->nama_siswa.'<br>' : '').$item->email_siswa;
					} else if ($item->siswa_id == 0 && $item->metode_pembayaran == 4){
						echo ($item->nama != '' ? $item->nama.'<br>' : '').($item->email != '' ? $item->email : '');
					} else if ($item->siswa_id == 0 && $item->metode_pembayaran == 5){
						echo ($item->nama != '' ? $item->nama.'<br>' : '').($item->email != '' ? $item->email : '');
					} else {
						echo 'Unknown';
					}
				?>
				</td>
				<td class="text-right"><?php echo number_format($item->total_harga, null, null, ".");?></td>
				<td class="text-center">
					<?php
					if ($item->metode_pembayaran == 1){ 
					echo 'Transfer';
					} else if ($item->metode_pembayaran == 2){
					echo 'Indomaret';
					} else if ($item->metode_pembayaran == 3){
					echo 'Indihome';
					} else if ($item->metode_pembayaran == 4){
					echo 'Sekolah';
					} else if ($item->metode_pembayaran == 5){
					echo 'Demo/Promo';
					}
					?>
				</td>
				<td><?php echo date('d M Y, H:i:s', strtotime($item->expired_on));?></td>
				<td class='text-center'>
				<?php echo $item->status?>
				</td>
				<td class='text-center'>
				<?php
				if(strpos($item->status, 'Menunggu Konfirmasi')!==FALSE || (strpos($item->status, 'Confirmed')!==false && $item->siswa_id > 0 && $item->metode_pembayaran < 3)){
				?>
					<a type="button" class="btn btn-info btn-fill" style="padding:3px 6px;" title="Lihat Bukti Pembayaran" data-number="<?php echo $no?>" href="<?php echo base_url()."assets/uploads/verifikasi/".$item->file_bukti; ?>" target="_BLANK"><i class="glyphicon glyphicon-picture"></i></a>
				<?php
				}
				else{
					echo "-";
				}
				?>
				</td>
				<td class="text-center" style="width:10%;">
				<?php
				if(($item->siswa_id == 0 && $item->angka_status == 1 && $item->metode_pembayaran == 1) || ($item->siswa_id > 0 && $item->angka_status == 1 && $item->metode_pembayaran == 1)){
				?>
					<a type="button" class="btn btn-success btn-fill" style="padding:3px 6px;" title="Terima Pembayaran" href='<?php echo base_url()."pg_admin/transaksi/terima/".$item->id_pembelian; ?>' onclick="if (confirm('Apakah transaksi akan di approve ?')) { return true; } else {  return false; }"><i class="glyphicon glyphicon-ok"></i></a>                            
					<a type="button" class="btn btn-warning btn-fill" style="padding:3px 6px;" title="Batalkan " href='javascript:void(0)' onclick="if (confirm('Apakah transaksi akan dibatalkan ?')) batalkan(<?=$page?>,<?=$tabs?>,<?=$item->id_pembelian?>)"><i class="glyphicon glyphicon-remove"></i></a>                            
				<?php
				} else if($item->metode_pembayaran == 3 && $item->angka_status < 2){
					echo "-";
				} else if($item->metode_pembayaran < 3 && $item->angka_status < 2){
				?>
					<a type="button" class="btn btn-warning btn-fill" style="padding:3px 6px;" title="Batalkan " href='javascript:void(0)' onclick="if (confirm('Apakah transaksi akan dibatalkan ?')) batalkan(<?=$page?>,<?=$tabs?>,<?=$item->id_pembelian?>)"><i class="glyphicon glyphicon-remove"></i></a>                            
				<?php
				} else {
					echo "-";
				}
				?>
				</td>
                        </tr>
                      <?php
                        $no++;
                        }
											}
                      ?>
                    </tbody>
                  </table>
									
              </div>
							<div class="clearfix"></div>
							<div class="col-md-12 col-xs-12">
								<hr>
								<?= $paginator ?>
							</div>
							<div class="clearfix"></div>

							<script>
								$(document).ready(function() {	
										$('#cari<?php echo $tabs; ?>').keyup(function() {
											if ($(this).val().length > 1){
												var urlLink = "<?php echo base_url().'pg_admin/transaksi/tabel_ajax/'.$tabs.'/'; ?>" + $('#cari<?php echo $tabs; ?>').val() + '/' + $('#showlimit<?php echo $tabs; ?>').val();
												$.ajax({
													url:urlLink,
													beforeSend: function() {
														NProgress.start();
													},
													success:function(data) { 
														NProgress.done();
														$("#ajaxpage<?php echo $tabs ?>").html(data);
														$('#cari<?php echo $tabs; ?>').focus();
													}
												});
												return false;
											}
										});
										$('#showlimit<?php echo $tabs; ?>').change(function() {
											var c = $('#cari<?php echo $tabs; ?>').val();
											var cari = '';
											if (c !== ''){
												cari = c;
											} else {
												cari = 0;
											}
											var urlLink = "<?php echo base_url().'pg_admin/transaksi/tabel_ajax/'.$tabs.'/'; ?>" + cari + '/' + $('#showlimit<?php echo $tabs; ?>').val();
											$.ajax({
												url:urlLink,
												beforeSend: function() {
													NProgress.start();
												},
												success:function(data) { 
													NProgress.done();
													$("#ajaxpage<?php echo $tabs ?>").html(data);
												}
											});
											return false;
										});
								});
								function resetfilter(tab)
								{  
									var urlLink = "<?php echo base_url().'pg_admin/transaksi/tabel_ajax/'; ?>" + tab;
									$.ajax({
										url:urlLink,
										beforeSend: function() {
											NProgress.start();
										},
										success:function(data) { 
											NProgress.done();
											$("#ajaxpage" + tab).html(data);
										}
									});
									return false;
								}
								function batalkan(page,tab,id)
								{  
									var urlLink = "<?php echo base_url().'pg_admin/transaksi/batalkan/'; ?>" + page + "/" + tab + "/" + id;
									$.ajax({
										url:urlLink,
										beforeSend: function() {
											NProgress.start();
										},
										success:function(data) { 
											NProgress.done();
											$("#ajaxpage" + tab).html(data);
										}
									});
									return false;
								}
							</script>				

