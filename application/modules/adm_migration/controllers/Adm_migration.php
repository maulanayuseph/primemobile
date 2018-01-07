<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm_migration extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
	//$this->load->model('model_user_dashboard');
	$this->load->model('adm_migration_model');
	$this->load->model('adm_main/adm_main_model');
	$this->load->helper(array('form', 'url'));
	$this->adm_main_model->adm_login_security();
  }

function adm_data(){
	$dataadm = $this->adm_main_model->fetch_admin_by_id($this->session->userdata('idlogin'));
	return $dataadm;
}

function content(){
	$this->adm_main_model->security_level_superadmin();
	$data = array(
		'title'			=> 'Super Administrator Dashboard | Content Migration',
		'content'		=> 'adm_migration/index',
		'headerassets'	=> 'adm_migration/index_headerassets',
		'footerassets'	=> 'adm_migration/index_footerassets',
		'dataadmin'		=> $this->adm_data(),
		'datakelas'		=> $this->adm_migration_model->fetch_kelas(),
		'datakurikulum'	=> $this->adm_migration_model->fetch_kurikulum(),
		'datamapel'		=> $this->adm_migration_model->fetch_mapel()		
	);
	$this->load->view("template_admin/template_adm", $data);
}

function ajax_mapel_by_kelas_old(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['idkelas'];

	$datamapel = $this->adm_migration_model->fetch_mapel_by_kelas_old($idkelas);

	echo "<option value=''>-- Pilih Mapel --</option>";

	foreach($datamapel as $mapel){
		?>
		<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>
		<?php
	}
}

function ajax_bab_by_kurikulum(){
	$params 		= $this->input->post(null, true);
	$idmapel 		= $params['idmapel'];
	$kurikulum 		= $params['kurikulum'];

	$carimapok 	= $this->adm_migration_model->cari_mapok_by_mapel($idmapel);

	echo '<option value="">-- Pilih Materi Pokok --</option>';
	
	if($kurikulum == "K-13"){
		foreach($carimapok as $mapok){
			$jumlahsubk13 		= $this->adm_migration_model->jumlah_subk13_by_mapok($mapok->id_materi_pokok);
			$jumlahsubirisan 	= $this->adm_migration_model->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);

			if($jumlahsubk13 > 0 or $jumlahsubirisan > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?></option>
				<?php
			}
		}
	}elseif($kurikulum == "K-13 REVISI"){
		foreach($carimapok as $mapok){
			$jumlahsubk13rev = $this->adm_migration_model->jumlah_subk13rev_by_mapok($mapok->id_materi_pokok);

			if($jumlahsubk13rev > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?></option>
				<?php
			}
		}
	}elseif($kurikulum == "KTSP"){
		foreach($carimapok as $mapok){
			$jumlahsubktsp 		= $this->adm_migration_model->jumlah_ktsp_by_mapok($mapok->id_materi_pokok);
			$jumlahsubirisan 	= $this->adm_migration_model->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);

			if($jumlahsubktsp > 0 or $jumlahsubirisan > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_ktsp;?></option>
				<?php
			}
		}
	}
}

function ajax_sub_materi(){
	$params 		= $this->input->post(null, true);
	$kurikulum 		= $params['kurikulum'];
	$idmapok 		= $params['idmapok'];

	if($kurikulum == "K-13"){
		$datasub = $this->adm_migration_model->fetch_sub_k13_by_mapok($idmapok);
	}elseif($kurikulum == "KTSP"){
		$datasub = $this->adm_migration_model->fetch_sub_ktsp_by_mapok($idmapok);
	}elseif($kurikulum == "K-13 REVISI"){
		$datasub = $this->adm_migration_model->fetch_sub_k13rev_by_mapok($idmapok);
	}

	$data = array(
		'datasub'	=> $datasub,
		'kurikulum'	=> $kurikulum,
		'mapok'		=> $this->adm_migration_model->fetch_mapok_by_id($idmapok)
	);
	$this->load->view('adm_migration/index_ajax_sub_materi', $data);
}

function ajax_cek_transfer_bab(){
	$params 		= $this->input->post(null, true);
	$idkelas		= $params['idkelas'];
	$idkurikulum	= $params['idkurikulum'];
	$idmapel		= $params['idmapel'];
	$bab			= $params['bab'];
	$idmapok 		= $params['idmapok'];
	$kurikulumold 	= $params['kurikulumold'];

	$data = array(
		'kelas'			=> $this->adm_migration_model->fetch_kelas_by_id($idkelas),
		'kurikulum'		=> $this->adm_migration_model->fetch_kurikulum_by_id($idkurikulum),
		'mapel'			=> $this->adm_migration_model->fetch_mapel_new_by_id($idmapel),
		'bab'			=> $bab,
		'mapok'			=> $this->adm_migration_model->fetch_mapok_by_id($idmapok),
		'kurikulumold'	=> $kurikulumold
	);
	$this->load->view("adm_migration/index_ajax_cek_transfer_bab", $data);
}

function proses_transfer_bab(){
	$params 		= $this->input->post(null, true);
	$idmapok 		= $params['idmapok'];
	$namabab		= $params['namabab'];
	$idmapel 		= $params['idmapel'];
	$idkelas		= $params['idkelas'];
	$idkurikulum	= $params['idkurikulum'];
	$kurikulum 		= $params['kurikulum'];

	//cek apakah kurikulum_x_kelas sudah ada
	$cekkurxkelas 	= $this->adm_migration_model->cek_kurikulum_x_kelas($idkurikulum, $idkelas);

	if($cekkurxkelas == null){
		//jika kurikulum_x_kelas tidak ada, insert baru
		$insertkurxkelas = $this->adm_migration_model->insert_kurikulum_x_kelas($idkurikulum, $idkelas);
		$idkurxkelas = $insertkurxkelas;
	}else{
		//jika kurikukulum_x_kelas ada, tangkap id_kurikulum_x_kelas
		$idkurxkelas = $cekkurxkelas->id_kurikulum_x_kelas;
	}

	//cek apakah kurikulum_x_mapel sudah ada
	$cekkurxmapel = $this->adm_migration_model->cek_kurikulum_x_mapel($idkurxkelas, $idmapel);

	if($cekkurxmapel == null){
		//jika kurikulum_x_mapel tidak ada, insert baru
		$insertkurxmapel = $this->adm_migration_model->insert_kurikulum_x_mapel($idkurxkelas, $idmapel);
	}

	//cek dulu, apakah bab sudah ada, biar tidak terduplikat di tabel bab
	$cekbab = $this->adm_migration_model->fetch_bab_by_nama_bab($namabab);

	if($cekbab == null){
		//jika tidak ada, insert bab baru, dan retun id bab barunya ke $insertbab
		$insertbab 		= $this->adm_migration_model->insert_bab($idmapel, $namabab);
	}else{
		//jika bab sudah ada di tabel bab, masukkan id_bab ke $insertbab
		$insertbab = $cekbab->id_bab;
	}

	//cek apakah kurikulum_x_bab sudah ada
	$cekkurxbab = $this->adm_migration_model->cek_kurikulum_x_bab($idkurxkelas, $insertbab);
	if($cekkurxbab == null){
		$insertkurxbab = $this->adm_migration_model->insert_kurikulum_x_bab($idkurxkelas, $insertbab);

		$idkurxbab = $insertkurxbab;
	}else{
		$idkurxbab = $cekkurxbab->id_kurikulum_x_bab;
	}

	//ganti semua rencana belajar dari materi pokok lama, ke idbab baru
	if($kurikulum == "K-13 REVISI"){
		$kurikulum = "k13rev";
	}
	$updaterencanabelajar = $this->adm_migration_model->update_rencana_belajar($idmapok, $idkurxbab, $kurikulum);
}

function ajax_bab(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['idkelas'];
	$idmapel 		= $params['idmapel'];
	$idkurikulum 	= $params['idkurikulum'];

	$databab 	= $this->adm_migration_model->fetch_kurikulum_x_bab_by_mapel($idkelas, $idkurikulum, $idmapel);
	echo '<option value="">-- Pilih Bab --</option>';
	foreach($databab as $bab){
		?>
		<option value="<?php echo $bab->id_bab;?>"><?php echo $bab->nama_bab;?></option>
		<?php
	}
}

function ajax_cek_buat_sub(){
	$params 		= $this->input->post(null, true);
	$idsubmateri 	= $params['idsubmateri'];
	$idbab 			= $params['idbab'];
	$idkelas 		= $params['idkelas'];
	$idkurikulum 	= $params['idkurikulum'];

	$data = array(

	);

	$this->load->view("adm_migration/index_ajax_cek_buat_sub", $data);
}

function mass_migration(){
	$this->adm_main_model->security_level_superadmin();
	$data = array(
		'title'			=> 'Super Administrator Dashboard | Content Migration',
		'content'		=> 'adm_migration/mass_index',
		'headerassets'	=> 'adm_migration/mass_headerassets',
		'footerassets'	=> 'adm_migration/mass_footerassets',
		'dataadmin'		=> $this->adm_data(),
		'datakelas'		=> $this->adm_migration_model->fetch_kelas(),
		'datakurikulum'	=> $this->adm_migration_model->fetch_kurikulum(),
		'datamapel'		=> $this->adm_migration_model->fetch_mapel()		
	);
	$this->load->view("template_admin/template_adm", $data);
}

function proses_mass_migrasi(){
	$params 		= $this->input->post(null, true);
	$kurikulumold 	= $params['kurikulumold'];
	$mapelold 		= $params['mapelold'];
	$kelasnew		= $params['kelasnew'];
	$kurikulumnew	= $params['kurikulumnew'];
	$mapelnew 		= $params['mapelnew'];


	//cek apakah kurikulum_x_kelas sudah ada
	$cekkurxkelas 	= $this->adm_migration_model->cek_kurikulum_x_kelas($kurikulumnew, $kelasnew);

	if($cekkurxkelas == null){
		//jika kurikulum_x_kelas tidak ada, insert baru
		$insertkurxkelas = $this->adm_migration_model->insert_kurikulum_x_kelas($kurikulumnew, $kelasnew);
		$idkurxkelas = $insertkurxkelas;
	}else{
		//jika kurikukulum_x_kelas ada, tangkap id_kurikulum_x_kelas
		$idkurxkelas = $cekkurxkelas->id_kurikulum_x_kelas;
	}

	//cek apakah kurikulum_x_mapel sudah ada
	$cekkurxmapel = $this->adm_migration_model->cek_kurikulum_x_mapel($idkurxkelas, $mapelnew);

	if($cekkurxmapel == null){
		//jika kurikulum_x_mapel tidak ada, insert baru
		$insertkurxmapel = $this->adm_migration_model->insert_kurikulum_x_mapel($idkurxkelas, $mapelnew);

		$lanjut = "lanjut";
	}else{
		$lanjut	= "nope";
	}

	$carimapok 	= $this->adm_migration_model->cari_mapok_by_mapel($mapelold);

	if($lanjut == "lanjut"){
		if($kurikulumold == "K-13"){
			foreach($carimapok as $mapok){
				$jumlahsubk13 		= $this->adm_migration_model->jumlah_subk13_by_mapok($mapok->id_materi_pokok);
				$jumlahsubirisan 	= $this->adm_migration_model->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);

				if($jumlahsubk13 > 0 or $jumlahsubirisan > 0){
					//looping bab
					//cek dulu, apakah bab sudah ada, biar tidak terduplikat di tabel bab
					$cekbab = $this->adm_migration_model->fetch_bab_by_nama_bab($mapok->judul_bab_k13, $mapelnew);
					if($cekbab == null){
						//jika tidak ada, insert bab baru, dan retun id bab barunya ke $insertbab
						$insertbab 		= $this->adm_migration_model->insert_bab($mapelnew, $mapok->judul_bab_k13);
					}else{
						//jika bab sudah ada di tabel bab, masukkan id_bab ke $insertbab
						$insertbab = $cekbab->id_bab;
					}

					//cek apakah kurikulum_x_bab sudah ada
					$cekkurxbab = $this->adm_migration_model->cek_kurikulum_x_bab($idkurxkelas, $insertbab);
					if($cekkurxbab == null){
						$insertkurxbab = $this->adm_migration_model->insert_kurikulum_x_bab($idkurxkelas, $insertbab, $mapok->bab_k13);

						$idkurxbab = $insertkurxbab;
					}else{
						$idkurxbab = $cekkurxbab->id_kurikulum_x_bab;
					}

					//ganti semua rencana belajar dari materi pokok lama, ke idbab baru
					if($kurikulumold == "K-13 REVISI"){
						$kurikulumsiswa = "k13rev";
					}
					$updaterencanabelajar = $this->adm_migration_model->update_rencana_belajar($mapok->id_materi_pokok, $idkurxbab, $kurikulumsiswa);

					//mulai transfer sub materi
					//*************************
					//*************************
					$datasub = $this->adm_migration_model->fetch_sub_k13_by_mapok($mapok->id_materi_pokok);

					foreach($datasub as $sub){
						if($sub->kategori == 1){
							//cek dulu apakah nama sub bab sudah ada
							$ceksubbab = $this->adm_migration_model->fetch_sub_bab_by_nama_and_bab($sub->nama_sub_materi, $insertbab);

							if($ceksubbab == null){
								//jika sub bab tidak ada di tabel sub_bab
								$insertsubbab 	= $this->adm_migration_model->insert_sub_bab($sub->nama_sub_materi, $insertbab);

								$idsubbab = $insertsubbab;

								//insert sub bab ke tabel kurikulum_x_sub_bab
								$insertkurxsubbab = $this->adm_migration_model->insert_kurikulum_x_sub_bab($idkurxkelas, $idsubbab);

								$idkurxsubbab = $insertkurxsubbab;
							}else{
								$idsubbab = $ceksubbab->id_sub_bab;

								//cek apakah sub bab sudah ada di tabel kurikulum_x_sub_bab
								$cekkurxsubbab = $this->adm_migration_model->cek_kurikulum_x_sub_bab($idkurxkelas, $idsubbab);

								if($cekkurxsubbab == null){
									//insert sub bab ke tabel kurikulum_x_sub_bab
									$insertkurxsubbab = $this->adm_migration_model->insert_kurikulum_x_sub_bab($idkurxkelas, $idsubbab);

									$idkurxsubbab = $insertkurxsubbab;
								}else{
									$idkurxsubbab = $cekkurxsubbab->id_kurikulum_x_sub_bab;
								}
							}
							
							//setelah mendapat id_kurikulum_x_sub_bab, sekarang waktunya membuat judul
							//cek dulu, apakah materi sudah memiliiki id_judul, jika sudah, insert materi baru...
							$materiexist  		= $this->adm_migration_model->cek_existing_materi($sub->id_sub_materi);

							$insertjudul 	= $this->adm_migration_model->insert_judul($idkurxsubbab, $sub->nama_sub_materi, 'materi');
							if($materiexist->id_judul == 0){
								
								$editjudulmateri = $this->adm_migration_model->edit_id_judul_materi($sub->id_sub_materi, $insertjudul);
							}else{
								$insertmateri = $this->adm_migration_model->insert_materi($insertjudul, $materiexist->isi_materi, $materiexist->tanggal, $materiexist->waktu, $materiexist->status_konten, $materiexist->id_adm);	
							}
							
						}elseif($sub->kategori == 3){
							$strsubbab 	= str_ireplace("latihan soal ", "", $sub->nama_sub_materi);

							$cekuji = substr($sub->nama_sub_materi, 0, 14);

							if($cekuji == "uji kompetensi"){
								$uji = 1;
							}else{
								$uji = 0;
							}

							//cari apakah sub-bab tersebut ada
							$ceksubbab = $this->adm_migration_model->fetch_sub_bab_by_nama_and_bab($strsubbab, $insertbab);
							var_dump($ceksubbab);
							if($ceksubbab !== null){
								//cek apakah sub bab sudah ada di kurikulum_x_sub_bab
								$cekkurxsubbab = $this->adm_migration_model->cek_kurikulum_x_sub_bab($idkurxkelas, $ceksubbab->id_sub_bab);

								$idkurxsubbab = $cekkurxsubbab->id_kurikulum_x_sub_bab;
							}

							if($ceksubbab !== null){
								$insertjudul = $this->adm_migration_model->insert_judul_soal($idkurxsubbab, $sub->nama_sub_materi, 'latihan', $uji);
								$idjudul = $insertjudul;
							}else{
								$insertjudulunknown = $this->adm_migration_model->insert_judul_unknown($idkurxbab, $sub->nama_sub_materi, 'latihan', $uji);
								$idjudul = $insertjudulunknown;
							}

							//mulai pemindahan soal

							//fetch soalnya dulu
							$datasoal = $this->adm_migration_model->fetch_soal_by_sub_materi($sub->id_sub_materi);

							foreach($datasoal as $soal){
								$transfer = $this->adm_migration_model->insert_bank_soal($soal->isi_soal, $soal->jawab_1, $soal->jawab_2, $soal->jawab_3, $soal->jawab_4, $soal->jawab_5, $soal->kunci_jawaban, $soal->bobot, $soal->pembahasan, $soal->pembahasan_video, $soal->status, $soal->id_adm);


								//edit qc history
								$updatehistory = $this->adm_migration_model->edit_qc_history($soal->id_soal, $transfer);

								//masukkan judul_x_soal
								$insertjudulxsoal = $this->adm_migration_model->insert_judul_x_soal($idjudul, $transfer);

								//mulai transfer manajemen mapel ke soal
								//**************************************
								//**************************************
								//**************************************

								//id_kelas
								//insert soal_x_kelas
								$insertsoalxkelas = $this->adm_migration_model->insert_soal_x_kelas($kelasnew, $transfer);

								//id_kurikulum
								//insert soal_x_kurikulum
								$insertsoalxkurikulum = $this->adm_migration_model->insert_soal_x_kurikulum($kurikulumnew, $transfer);

								//id_mapel
								//insert soal_x_mapel
								$insertsoalxmapel = $this->adm_migration_model->insert_soal_x_mapel($mapelnew, $transfer);

								//id_bab
								//insert soal_x_bab
								$insertsoalxbab = $this->adm_migration_model->insert_soal_x_bab($insertbab, $transfer);

								//id_sub_bab
								//insert soal_x_sub_bab
								if($ceksubbab !== null){
									$insertsoalxsubbab = $this->adm_migration_model->insert_soal_x_sub_bab($ceksubbab->id_sub_bab, $transfer);
								}
								//end transfer manajemen mapel ke soal
								//**************************************
								//**************************************
								//**************************************
							}
						}
					}
					//end transfer sub materi
					//*************************
					//*************************
				}
			}
		}elseif($kurikulumold == "K-13 REVISI"){
			foreach($carimapok as $mapok){
				$jumlahsubk13rev = $this->adm_migration_model->jumlah_subk13rev_by_mapok($mapok->id_materi_pokok);

				if($jumlahsubk13rev > 0){
					//looping bab
					//cek dulu, apakah bab sudah ada, biar tidak terduplikat di tabel bab
					$cekbab = $this->adm_migration_model->fetch_bab_by_nama_bab($mapok->judul_bab_k13, $mapelnew);
					if($cekbab == null){
						//jika tidak ada, insert bab baru, dan retun id bab barunya ke $insertbab
						$insertbab 		= $this->adm_migration_model->insert_bab($mapelnew, $mapok->judul_bab_k13);
					}else{
						//jika bab sudah ada di tabel bab, masukkan id_bab ke $insertbab
						$insertbab = $cekbab->id_bab;
					}

					//cek apakah kurikulum_x_bab sudah ada
					$cekkurxbab = $this->adm_migration_model->cek_kurikulum_x_bab($idkurxkelas, $insertbab);
					if($cekkurxbab == null){
						$insertkurxbab = $this->adm_migration_model->insert_kurikulum_x_bab($idkurxkelas, $insertbab, $mapok->bab_k13);

						$idkurxbab = $insertkurxbab;
					}else{
						$idkurxbab = $cekkurxbab->id_kurikulum_x_bab;
					}

					//ganti semua rencana belajar dari materi pokok lama, ke idbab baru
					if($kurikulumold == "K-13 REVISI"){
						$kurikulumsiswa = "k13rev";
					}
					$updaterencanabelajar = $this->adm_migration_model->update_rencana_belajar($mapok->id_materi_pokok, $idkurxbab, $kurikulumsiswa);

					//mulai transfer sub materi
					//*************************
					//*************************
					$datasub = $this->adm_migration_model->fetch_sub_k13rev_by_mapok($mapok->id_materi_pokok);

					foreach($datasub as $sub){
						if($sub->kategori == 1){
							//cek dulu apakah nama sub bab sudah ada
							$ceksubbab = $this->adm_migration_model->fetch_sub_bab_by_nama_and_bab($sub->nama_sub_materi, $insertbab);

							if($ceksubbab == null){
								//jika sub bab tidak ada di tabel sub_bab
								$insertsubbab 	= $this->adm_migration_model->insert_sub_bab($sub->nama_sub_materi, $insertbab);

								$idsubbab = $insertsubbab;

								//insert sub bab ke tabel kurikulum_x_sub_bab
								$insertkurxsubbab = $this->adm_migration_model->insert_kurikulum_x_sub_bab($idkurxkelas, $idsubbab);

								$idkurxsubbab = $insertkurxsubbab;
							}else{
								$idsubbab = $ceksubbab->id_sub_bab;

								//cek apakah sub bab sudah ada di tabel kurikulum_x_sub_bab
								$cekkurxsubbab = $this->adm_migration_model->cek_kurikulum_x_sub_bab($idkurxkelas, $idsubbab);

								if($cekkurxsubbab == null){
									//insert sub bab ke tabel kurikulum_x_sub_bab
									$insertkurxsubbab = $this->adm_migration_model->insert_kurikulum_x_sub_bab($idkurxkelas, $idsubbab);

									$idkurxsubbab = $insertkurxsubbab;
								}else{
									$idkurxsubbab = $cekkurxsubbab->id_kurikulum_x_sub_bab;
								}
							}
							
							//setelah mendapat id_kurikulum_x_sub_bab, sekarang waktunya membuat judul
							$insertjudul 	= $this->adm_migration_model->insert_judul($idkurxsubbab, $sub->nama_sub_materi, 'materi');
							$editjudulmateri = $this->adm_migration_model->edit_id_judul_materi($sub->id_sub_materi, $insertjudul);
						}elseif($sub->kategori == 3){
							$strsubbab 	= str_ireplace("latihan soal ", "", $sub->nama_sub_materi);

							$cekuji = substr($sub->nama_sub_materi, 0, 14);

							if($cekuji == "uji kompetensi"){
								$uji = 1;
							}else{
								$uji = 0;
							}

							//cari apakah sub-bab tersebut ada
							$ceksubbab = $this->adm_migration_model->fetch_sub_bab_by_nama_and_bab($strsubbab, $insertbab);
							var_dump($ceksubbab);
							if($ceksubbab !== null){
								//cek apakah sub bab sudah ada di kurikulum_x_sub_bab
								$cekkurxsubbab = $this->adm_migration_model->cek_kurikulum_x_sub_bab($idkurxkelas, $ceksubbab->id_sub_bab);

								$idkurxsubbab = $cekkurxsubbab->id_kurikulum_x_sub_bab;
							}

							if($ceksubbab !== null){
								$insertjudul = $this->adm_migration_model->insert_judul_soal($idkurxsubbab, $sub->nama_sub_materi, 'latihan', $uji);
								$idjudul = $insertjudul;
							}else{
								$insertjudulunknown = $this->adm_migration_model->insert_judul_unknown($idkurxbab, $sub->nama_sub_materi, 'latihan', $uji);
								$idjudul = $insertjudulunknown;
							}

							//mulai pemindahan soal

							//fetch soalnya dulu
							$datasoal = $this->adm_migration_model->fetch_soal_by_sub_materi($sub->id_sub_materi);

							foreach($datasoal as $soal){
								$transfer = $this->adm_migration_model->insert_bank_soal($soal->isi_soal, $soal->jawab_1, $soal->jawab_2, $soal->jawab_3, $soal->jawab_4, $soal->jawab_5, $soal->kunci_jawaban, $soal->bobot, $soal->pembahasan, $soal->pembahasan_video, $soal->status, $soal->id_adm);


								//edit qc history
								$updatehistory = $this->adm_migration_model->edit_qc_history($soal->id_soal, $transfer);

								//masukkan judul_x_soal
								$insertjudulxsoal = $this->adm_migration_model->insert_judul_x_soal($idjudul, $transfer);

								//mulai transfer manajemen mapel ke soal
								//**************************************
								//**************************************
								//**************************************

								//id_kelas
								//insert soal_x_kelas
								$insertsoalxkelas = $this->adm_migration_model->insert_soal_x_kelas($kelasnew, $transfer);

								//id_kurikulum
								//insert soal_x_kurikulum
								$insertsoalxkurikulum = $this->adm_migration_model->insert_soal_x_kurikulum($kurikulumnew, $transfer);

								//id_mapel
								//insert soal_x_mapel
								$insertsoalxmapel = $this->adm_migration_model->insert_soal_x_mapel($mapelnew, $transfer);

								//id_bab
								//insert soal_x_bab
								$insertsoalxbab = $this->adm_migration_model->insert_soal_x_bab($insertbab, $transfer);

								//id_sub_bab
								//insert soal_x_sub_bab
								if($ceksubbab !== null){
									$insertsoalxsubbab = $this->adm_migration_model->insert_soal_x_sub_bab($ceksubbab->id_sub_bab, $transfer);
								}
								//end transfer manajemen mapel ke soal
								//**************************************
								//**************************************
								//**************************************
							}
						}
					}
					//end transfer sub materi
					//*************************
					//*************************
					
				}
			}
		}elseif($kurikulumold == "KTSP"){
			foreach($carimapok as $mapok){
				$jumlahsubktsp 		= $this->adm_migration_model->jumlah_ktsp_by_mapok($mapok->id_materi_pokok);
				$jumlahsubirisan 	= $this->adm_migration_model->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);

				if($jumlahsubktsp > 0 or $jumlahsubirisan > 0){
					//looping bab
					//cek dulu, apakah bab sudah ada, biar tidak terduplikat di tabel bab
					$cekbab = $this->adm_migration_model->fetch_bab_by_nama_bab($mapok->judul_bab_ktsp, $mapelnew);
					if($cekbab == null){
						//jika tidak ada, insert bab baru, dan retun id bab barunya ke $insertbab
						$insertbab 		= $this->adm_migration_model->insert_bab($mapelnew, $mapok->judul_bab_ktsp);
					}else{
						//jika bab sudah ada di tabel bab, masukkan id_bab ke $insertbab
						$insertbab = $cekbab->id_bab;
					}

					//cek apakah kurikulum_x_bab sudah ada
					$cekkurxbab = $this->adm_migration_model->cek_kurikulum_x_bab($idkurxkelas, $insertbab);
					if($cekkurxbab == null){
						$insertkurxbab = $this->adm_migration_model->insert_kurikulum_x_bab($idkurxkelas, $insertbab, $mapok->bab_ktsp);

						$idkurxbab = $insertkurxbab;
					}else{
						$idkurxbab = $cekkurxbab->id_kurikulum_x_bab;
					}

					//ganti semua rencana belajar dari materi pokok lama, ke idbab baru
					if($kurikulumold == "K-13 REVISI"){
						$kurikulumsiswa = "k13rev";
					}
					$updaterencanabelajar = $this->adm_migration_model->update_rencana_belajar($mapok->id_materi_pokok, $idkurxbab, $kurikulumsiswa);

					//mulai transfer sub materi
					//*************************
					//*************************
					$datasub = $this->adm_migration_model->fetch_sub_ktsp_by_mapok($mapok->id_materi_pokok);

					foreach($datasub as $sub){
						if($sub->kategori == 1){
							//cek dulu apakah nama sub bab sudah ada
							$ceksubbab = $this->adm_migration_model->fetch_sub_bab_by_nama_and_bab($sub->nama_sub_materi, $insertbab);

							if($ceksubbab == null){
								//jika sub bab tidak ada di tabel sub_bab
								$insertsubbab 	= $this->adm_migration_model->insert_sub_bab($sub->nama_sub_materi, $insertbab);

								$idsubbab = $insertsubbab;

								//insert sub bab ke tabel kurikulum_x_sub_bab
								$insertkurxsubbab = $this->adm_migration_model->insert_kurikulum_x_sub_bab($idkurxkelas, $idsubbab);

								$idkurxsubbab = $insertkurxsubbab;
							}else{
								$idsubbab = $ceksubbab->id_sub_bab;

								//cek apakah sub bab sudah ada di tabel kurikulum_x_sub_bab
								$cekkurxsubbab = $this->adm_migration_model->cek_kurikulum_x_sub_bab($idkurxkelas, $idsubbab);

								if($cekkurxsubbab == null){
									//insert sub bab ke tabel kurikulum_x_sub_bab
									$insertkurxsubbab = $this->adm_migration_model->insert_kurikulum_x_sub_bab($idkurxkelas, $idsubbab);

									$idkurxsubbab = $insertkurxsubbab;
								}else{
									$idkurxsubbab = $cekkurxsubbab->id_kurikulum_x_sub_bab;
								}
							}
							
							//setelah mendapat id_kurikulum_x_sub_bab, sekarang waktunya membuat judul
							$insertjudul 	= $this->adm_migration_model->insert_judul($idkurxsubbab, $sub->nama_sub_materi, 'materi');
							$editjudulmateri = $this->adm_migration_model->edit_id_judul_materi($sub->id_sub_materi, $insertjudul);
						}elseif($sub->kategori == 3){
							$strsubbab 	= str_ireplace("latihan soal ", "", $sub->nama_sub_materi);

							$cekuji = substr($sub->nama_sub_materi, 0, 14);

							if($cekuji == "uji kompetensi"){
								$uji = 1;
							}else{
								$uji = 0;
							}

							//cari apakah sub-bab tersebut ada
							$ceksubbab = $this->adm_migration_model->fetch_sub_bab_by_nama_and_bab($strsubbab, $insertbab);
							var_dump($ceksubbab);
							if($ceksubbab !== null){
								//cek apakah sub bab sudah ada di kurikulum_x_sub_bab
								$cekkurxsubbab = $this->adm_migration_model->cek_kurikulum_x_sub_bab($idkurxkelas, $ceksubbab->id_sub_bab);

								$idkurxsubbab = $cekkurxsubbab->id_kurikulum_x_sub_bab;
							}

							if($ceksubbab !== null){
								$insertjudul = $this->adm_migration_model->insert_judul_soal($idkurxsubbab, $sub->nama_sub_materi, 'latihan', $uji);
								$idjudul = $insertjudul;
							}else{
								$insertjudulunknown = $this->adm_migration_model->insert_judul_unknown($idkurxbab, $sub->nama_sub_materi, 'latihan', $uji);
								$idjudul = $insertjudulunknown;
							}

							//mulai pemindahan soal

							//fetch soalnya dulu
							$datasoal = $this->adm_migration_model->fetch_soal_by_sub_materi($sub->id_sub_materi);

							foreach($datasoal as $soal){
								$transfer = $this->adm_migration_model->insert_bank_soal($soal->isi_soal, $soal->jawab_1, $soal->jawab_2, $soal->jawab_3, $soal->jawab_4, $soal->jawab_5, $soal->kunci_jawaban, $soal->bobot, $soal->pembahasan, $soal->pembahasan_video, $soal->status, $soal->id_adm);


								//edit qc history
								$updatehistory = $this->adm_migration_model->edit_qc_history($soal->id_soal, $transfer);

								//masukkan judul_x_soal
								$insertjudulxsoal = $this->adm_migration_model->insert_judul_x_soal($idjudul, $transfer);

								//mulai transfer manajemen mapel ke soal
								//**************************************
								//**************************************
								//**************************************

								//id_kelas
								//insert soal_x_kelas
								$insertsoalxkelas = $this->adm_migration_model->insert_soal_x_kelas($kelasnew, $transfer);

								//id_kurikulum
								//insert soal_x_kurikulum
								$insertsoalxkurikulum = $this->adm_migration_model->insert_soal_x_kurikulum($kurikulumnew, $transfer);

								//id_mapel
								//insert soal_x_mapel
								$insertsoalxmapel = $this->adm_migration_model->insert_soal_x_mapel($mapelnew, $transfer);

								//id_bab
								//insert soal_x_bab
								$insertsoalxbab = $this->adm_migration_model->insert_soal_x_bab($insertbab, $transfer);

								//id_sub_bab
								//insert soal_x_sub_bab
								if($ceksubbab !== null){
									$insertsoalxsubbab = $this->adm_migration_model->insert_soal_x_sub_bab($ceksubbab->id_sub_bab, $transfer);
								}
								//end transfer manajemen mapel ke soal
								//**************************************
								//**************************************
								//**************************************
							}
						}
					}
					//end transfer sub materi
					//*************************
					//*************************
				}
			}
		}
	}
}

}
?>