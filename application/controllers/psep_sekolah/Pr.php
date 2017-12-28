<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pr extends CI_Controller {

	public function __construct()
	{
    parent::__construct();
			
		//check user session

		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_security');
		$this->load->model('model_psep');
		$this->load->model('model_banksoal');
		$this->load->model('model_pr');
		$this->load->model('model_dashboard');
		$this->load->model('model_pg');
		$this->load->model('model_materi_urutan');
		$this->load->model('model_kurikulum');
		$this->load->model('model_rencana_belajar');
		$this->model_security->psep_sekolah_is_logged_in();
	}

	public function index()
	{
		$idsekolah = $this->session->userdata('idsekolah');
		$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
		$idguru = $this->session->userdata('id_guru');
		$data = array(
			'navbar_title' 		=> "Tugas",
			'sekolah'			=> $sekolah,
			'kelasparalel'		=> $this->model_psep->fetch_kelas_paralel_by_sekolah($idsekolah),
			'datatahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah),
			//'datapr'			=> $this->model_psep->fetch_pekerjaan_rumah($idsekolah)
			'datapr'			=> $this->model_psep->fetch_pekerjaan_rumah_by_guru($idguru)
			);
		$this->load->view('psep_sekolah/pr', $data);
	}

function ajax_pr($idkelasparalel, $idtahunajaran){
	//echo "hehehe";
	$idsekolah = $this->session->userdata('idsekolah');
	
	$datapr = $this->model_psep->fetch_ajax_pekerjaan_rumah($idkelasparalel, $idtahunajaran, $idsekolah);
	
	$data = array(
		"datapr"			=> $datapr,
		"idkelasparalel"	=> $idkelasparalel,
		"idtahunajaran"		=> $idtahunajaran
	);
	$this->load->view("psep_sekolah/pr_ajax_list", $data);
}

function tambah(){
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'navbar_title' 		=> "Tugas",
		'sekolah'			=> $sekolah,
		'kelasparalel'		=> $this->model_psep->fetch_kelas_paralel_by_sekolah($idsekolah),
		'datatahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah)
		);
	$this->load->view('psep_sekolah/pr_form', $data);
}

function proses_tambah(){
	$params 		= $this->input->post(null, true);
	$tipe 			= $params['tipe'];
	$kelas 			= "NULL";
	$tahun 			= "NULL";
	$namapr 		= $params['nama'];
	$deadline 		= "NULL";
	
	$tambahpr = $this->model_psep->tambah_pr($tipe, $tahun, $kelas, $namapr, $deadline);
	
	//redirect("psep_sekolah/pr/tambah_soal/".$tambahpr);
	//redirect ke edit saja biar langsung ke panel kontrol
	redirect("psep_sekolah/pr/edit/".$tambahpr);
}

function tambah_soal($idpr){
	//cek id pr apakah ada dan benar2 milik sekolah tersebut
	$idsekolah = $this->session->userdata('idsekolah');
	
	$cekpr = $this->model_psep->periksa_kepemilikan_pr($idsekolah, $idpr);
	
	if($cekpr == 0){
		redirect("psep_sekolah/pr");
	}
	
	$infopr = $this->model_psep->fetch_pr_by_id($idpr);
	
	if($infopr->tipe == 2){
		redirect("psep_sekolah/pr/tambah_soal_eksakta/" . $idpr);
	}elseif($infopr->tipe == 3){
		redirect("psep_sekolah/pr/tambah_soal_essay/" . $idpr);
	}
	
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'navbar_title' 		=> "Dashboard",
		'sekolah'			=> $sekolah,
		'kelasparalel'		=> $this->model_psep->fetch_kelas_paralel_by_sekolah($idsekolah),
		'datatahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah),
		'infopr'			=> $this->model_psep->fetch_pr_by_id($idpr)		
	);
	$this->load->view('psep_sekolah/pr_manajemen_soal', $data);
}

function tambah_soal_eksakta($idpr){
	$idsekolah = $this->session->userdata('idsekolah');
	$cekpr = $this->model_psep->periksa_kepemilikan_pr($idsekolah, $idpr);
	
	if($cekpr == 0){
		redirect("psep_sekolah/pr");
	}
	
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'navbar_title' 		=> "Dashboard",
		'sekolah'			=> $sekolah,
		'kelasparalel'		=> $this->model_psep->fetch_kelas_paralel_by_sekolah($idsekolah),
		'datatahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah),
		'infopr'			=> $this->model_psep->fetch_pr_by_id($idpr)
	);
	
	$this->load->view('psep_sekolah/pr_manajemen_soal_eksakta', $data);
}

function ajax_manage($sumbersoal, $idpr){
	$idsekolah 	= $this->session->userdata('idsekolah');
	$sekolah 	= $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$datakelas 	= $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang);
	
	if($sumbersoal == 1){
		$data = array(
			'datakelas'	=> $datakelas,
			'idpr'		=> $idpr
		);
		$this->load->view("psep_sekolah/ajax_manage_latihan_soal", $data);
	}elseif($sumbersoal == 2){
		$data = array(
			'datakelas'	=> $datakelas,
			'idpr'		=> $idpr
		);
		$this->load->view("psep_sekolah/ajax_manage_bank_soal", $data);
	}elseif($sumbersoal == 3){
		$data = array(
			'datakelas' 	=> $datakelas,
			'datamapel'		=> $this->model_psep->fetch_mapel(),
			'datakategori' 	=> $this->model_psep->fetch_atribut_sekolah($idsekolah),
			'idpr'			=> $idpr
		);
		$this->load->view("psep_sekolah/ajax_manage_bank_soal_sekolah", $data);
	}
}

function ajax_mapel($idkelas){
	$carimapel = $this->model_materi_urutan->cari_mapel_by_kelas($idkelas);
	
	echo "<option value=''>-- Pilih Mata Pelajaran --</option>";
	foreach($carimapel as $mapel){
		?>
		<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>
		<?php
	}
}

function ajax_mapok($idmapel, $kurikulum){
	$kurikulum = rawurldecode($kurikulum);

	$carimapok = $this->model_materi_urutan->cari_mapok_by_mapel($idmapel);
	
	
	
	echo "<option value=''>-- Pilih Materi Pokok --</option>";
	foreach($carimapok as $mapok){
		if($kurikulum == "K-13"){
			$jumlahsubk13 = $this->model_kurikulum->jumlah_subk13_by_mapok($mapok->id_materi_pokok);
			$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
			if($jumlahsubk13 > 0 or $jumlahsubirisan > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?></option>
				<?php
			}
		}elseif($kurikulum == "KTSP"){
			$jumlahsubktsp = $this->model_kurikulum->jumlah_ktsp_by_mapok($mapok->id_materi_pokok);
			$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
			if($jumlahsubktsp > 0 or $jumlahsubirisan > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_ktsp;?></option>
				<?php
			}
		}elseif($kurikulum == "K-13 REVISI"){
			$jumlahsubk13rev = $this->model_kurikulum->jumlah_subk13rev_by_mapok($mapok->id_materi_pokok);
			if($jumlahsubk13rev > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?></option>
				<?php
			}
		}
	}
}

function ajax_latihan_soal($idmapok, $kurikulum){
	//$carilatihansoal = $this->model_materi_urutan->cari_latihan_soal_by_mapok($idmapok);
	$carilatihansoal = $this->model_rencana_belajar->fetch_sub_by_materi_pokok_and_kurikulum($idmapok, $kurikulum);

	echo "<option value=''>-- Pilih Latihan Soal --</option>";
	foreach($carilatihansoal as $latihansoal){
		if($latihansoal->kategori == 3){
			?>
			<option value="<?php echo $latihansoal->id_sub_materi;?>"><?php echo $latihansoal->nama_sub_materi;?></option>
			<?php
		}
	}
}

function ajax_soal_by_latihan($idsubmateri, $idpr){
	$datasoal = $this->model_adm->fetch_soal_by_submateri($idsubmateri);
	$data = array(
		'datasoal'	=> $datasoal,
		'idpr'		=> $idpr
	);
	$this->load->view("psep_sekolah/pr_ajax/ajax_load_latihan_soal", $data);
}

function proses_tambah_soal(){
	$params 	= $this->input->post(null, true);
	
	$idpr		= $params['idpr'];
	$sumber		= $params['sumber'];
	$checksoal		= $params['soal'];
	
	if($sumber == 1){
		foreach($checksoal as $soal){
			$datasoal = $this->model_adm->fetch_soal_by_id($soal);
			
			$insertsoalpr = $this->model_psep->insert_soal_pr($idpr, $datasoal->isi_soal, $datasoal->jawab_1, $datasoal->jawab_2, $datasoal->jawab_3, $datasoal->jawab_4, $datasoal->jawab_5, $datasoal->pembahasan, $datasoal->pembahasan_video, $datasoal->kunci_jawaban);
		}
	}elseif($sumber == 2){
		foreach($checksoal as $soal){
			$datasoal = $this->model_banksoal->cari_bank_soal_by_id($soal);
			
			$insertsoalpr = $this->model_psep->insert_soal_pr(
				$idpr,
				$datasoal->pertanyaan,
				$datasoal->jawab_1,
				$datasoal->jawab_2,
				$datasoal->jawab_3,
				$datasoal->jawab_4,
				$datasoal->jawab_5,
				$datasoal->pembahasan_teks,
				$datasoal->pembahasan_video,
				$datasoal->kunci
			);
			
			
		}
		
	}
	redirect("psep_sekolah/pr/daftar_soal/".$idpr);
}

function daftar_soal($idpr){
	$idsekolah = $this->session->userdata('idsekolah');
	
	$cekpr = $this->model_psep->periksa_kepemilikan_pr($idsekolah, $idpr);
	
	if($cekpr == 0){
		redirect("psep_sekolah/pr");
	}
	
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'navbar_title' 		=> "Dashboard",
		'sekolah'			=> $sekolah,
		'infopr'			=> $this->model_psep->fetch_pr_by_id($idpr),
		'datasoal'			=> $this->model_psep->fetch_soal_by_pr($idpr)
	);
	$this->load->view('psep_sekolah/pr_daftar_soal', $data);
}

function hapus_soal($idsoal, $idpr){
	$this->model_psep->hapus_soal_pr($idsoal);
	
	redirect("psep_sekolah/pr/daftar_soal/".$idpr);
}

function ajax_kategori($idmapel){
	$carikategori = $this->model_banksoal->get_kategori_by_mapel($idmapel);
	
	echo "<option value=''>-- Pilih Kategori Bank Soal --</option>";
	foreach($carikategori as $kategori){
	?>
		<option value="<?php echo $kategori->id_kategori_bank_soal; ?>"><?php echo $kategori->nama_kategori; ?></option>
	<?php
	}
}

function ajax_bank_soal($idkategori, $idpr){
	$carisoal = $this->model_banksoal->fetch_bank_soal_by_kategori($idkategori);
	
	$data = array(
		'datasoal'	=> $carisoal,
		'idpr'		=> $idpr
	);
	$this->load->view("psep_sekolah/pr_ajax/ajax_load_bank_soal", $data);
}

function edit($idpr){
	$idsekolah = $this->session->userdata('idsekolah');
	
	/*
	$cekpr = $this->model_psep->periksa_kepemilikan_pr($idsekolah, $idpr);
	
	if($cekpr == 0){
		redirect("psep_sekolah/pr");
	}
	*/
	
	$fetchpr = $this->model_psep->fetch_pr_by_id($idpr);
	
	if($fetchpr->id_guru == $this->session->userdata('id_guru') or $fetchpr->id_guru == 0){
		$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
		$data = array(
			'navbar_title' 		=> "Tugas",
			'sekolah'			=> $sekolah,
			'infopr'			=> $this->model_psep->fetch_pr_by_id($idpr),
			'kelasparalel'		=> $this->model_psep->fetch_kelas_paralel_by_sekolah($idsekolah),
			'datatahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah),
			'datakelas'			=> $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang)
		);
		$this->load->view("psep_sekolah/pr_edit", $data);
	}else{
		redirect("psep_sekolah/pr");
	}
}

function proses_edit(){
	$params 		= $this->input->post(null, true);
	$idpr 			= $params['idpr'];
	$kelas 			= $params['kelas'];
	$tahun 			= $params['tahun'];
	$namapr 		= $params['nama'];
	$deadline 		= $params['deadline'];
	
	$edit = $this->model_psep->edit_pr($idpr, $kelas, $tahun, $namapr, $deadline);
	
	redirect("psep_sekolah/pr/edit/".$idpr);
}

function hapus($idpr){
	$infopr			= $this->model_psep->fetch_pr_by_id($idpr);
	
	//hapus nilai2 siswa
	if($infopr->tipe == 1){
		$hapusanalisispr = $this->model_psep->hapus_analisis_pr_by_pr($idpr);
	}elseif($infopr->tipe == 2){
		$hapusanalisispr = $this->model_psep->hapus_analisis_pr_eksak_by_pr($idpr);
	}
	
	
	//hapus soal2 pr
	//hapus berdasarkan tipe pr
	
	
	if($infopr->tipe == 1){
		$hapussoalpr 	= $this->model_psep->hapus_soal_pr_by_pr($idpr);
	}elseif($infopr->tipe == 2){
		$datasoal		= $this->model_psep->fetch_soal_eksak_by_pr($idpr);
		foreach($datasoal as $soal){
			//hapus pertanyaan soal
			$this->model_psep->hapus_soal_eksak_by_intro($datasoal->id_intro_soal);
			//hapus intro soal
			$this->model_psep->delete_intro_soal($datasoal->id_intro_soal);
		}
	}elseif($infopr->tipe == 3){
		//hapus soal2 essai
		$this->model_psep->hapus_soal_essai_by_pr($idpr);
	}
	
	
	//hapus status pr siswa
	$hapusstatusiswa = $this->model_psep->hapus_status_pr_by_pr($idpr);
	
	//hapus pr
	$hapuspr = $this->model_psep->hapus_pr($idpr);
	
	redirect("psep_sekolah/pr");
}

function rekap($idpr){
	$idsekolah = $this->session->userdata('idsekolah');
	$cekpr = $this->model_psep->periksa_kepemilikan_pr($idsekolah, $idpr);
	
	if($cekpr == 0){
		redirect("psep_sekolah/pr");
	}
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$infopr = $this->model_psep->fetch_pr_by_id($idpr);
	$datasiswa = $this->model_psep->fetch_siswa_by_kelasparalel_and_tahunajaran($idsekolah, $infopr->id_kelas_paralel, $infopr->id_tahun_ajaran);
	
	$data = array(
		'navbar_title' 		=> "Pekerjaan Rumah",
		'sekolah'			=> $sekolah,
		'infopr'			=> $infopr,
		'datasiswa'			=> $datasiswa
	);
	
	$this->load->view('psep_sekolah/pr_rekap', $data);
}

function rekap_eksak($idpr){
	$idsekolah = $this->session->userdata('idsekolah');
	$cekpr = $this->model_psep->periksa_kepemilikan_pr($idsekolah, $idpr);
	
	if($cekpr == 0){
		redirect("psep_sekolah/pr");
	}
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$infopr = $this->model_psep->fetch_pr_by_id($idpr);
	$datasiswa = $this->model_psep->fetch_siswa_by_kelasparalel_and_tahunajaran($idsekolah, $infopr->id_kelas_paralel, $infopr->id_tahun_ajaran);
	
	$data = array(
		'navbar_title' 		=> "Pekerjaan Rumah",
		'sekolah'			=> $sekolah,
		'infopr'			=> $infopr,
		'datasiswa'			=> $datasiswa
	);
	
	$this->load->view('psep_sekolah/pr_rekap_eksak', $data);
}
function detail($idpr, $idsiswa){
	//cek apakah pr benar2 sudah dikerjakan oleh siswa
	$cekpr = $this->model_pr->fetch_status_pr($idpr, $idsiswa);
	
	if($cekpr == null){
		redirect("psep_sekolah/pr/rekap");
	}else{
		if($cekpr->status == 0){
			redirect("psep_sekolah/pr");
		}
	}
	
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	
	$jumlahsoal	 	= $this->model_pr->jumlah_soal($idpr);
	$jumlahbenar 	= $this->model_pr->jumlah_benar_by_siswa_and_pr($idpr, $idsiswa);
	
	$nilai = ($jumlahbenar / $jumlahsoal) * 100;
	
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas 			= $this->model_dashboard->get_kelas($idsiswa);
	$tahunajaransiswa 	= $this->model_psep->fetch_tahun_ajaran_siswa($idsiswa, $carikelas->kelas);
	$data = array(
		'infosiswa'		=> $infosiswa,
		'navbar_links' 	=> $this->model_pg->get_navbar_links(),
		'tahunajaran'	=> $tahunajaransiswa,
		'infopr'		=> $this->model_pr->get_info_pr($idpr),
		'jumlahsoal'	=> $jumlahsoal,
		'jumlahbenar'	=> $jumlahbenar,
		'nilai'			=> $nilai,
		'sekolah'		=> $sekolah
	);
	$this->load->view("psep_sekolah/pr_detail", $data);
}

function detail_eksak($idpr, $idsiswa){
	//cek apakah pr benar2 sudah dikerjakan oleh siswa
	$cekpr = $this->model_pr->fetch_status_pr($idpr, $idsiswa);
	
	if($cekpr == null){
		redirect("psep_sekolah/pr/rekap");
	}else{
		if($cekpr->status == 0){
			redirect("pr");
		}
	}
	
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas 			= $this->model_dashboard->get_kelas($idsiswa);
	$tahunajaransiswa 	= $this->model_psep->fetch_tahun_ajaran_siswa($idsiswa, $carikelas->kelas);
	
	$jumlahsoal = $this->model_pr->fetch_jumlah_soal_eksak_by_pr($idpr);
	$jumlahbenar = $this->model_pr->fetch_benar_eksak_by_siswa($idpr, $idsiswa);
	
	$nilai = $jumlahbenar / $jumlahsoal * 100;
	
	$data = array(
		'infosiswa'		=> $infosiswa,
		'navbar_links' 	=> $this->model_pg->get_navbar_links(),
		'tahunajaran'	=> $tahunajaransiswa,
		'infopr'		=> $this->model_pr->get_info_pr($idpr),
		'jumlahbenar'	=> $jumlahbenar,
		'jumlahsoal'	=> $jumlahsoal,
		'nilai'			=> $nilai,
		'data_soal'		=> $this->model_pr->fetch_soal_eksak_by_pr($idpr),
		'sekolah'		=> $sekolah,
		'idsiswa'		=> $idsiswa
	);
	
	$this->load->view("psep_sekolah/pr_detail_eksak", $data);
}

function ajax_append_soal(){
	$this->load->view("psep_sekolah/ajax_append_soal");
}

function proses_tambah_soal_eksakta(){
	$params 			= $this->input->post(null, true);
	$idpr 				= $params['idpr'];
	$introsoal 			= $params['intro'];
	$daftarpertanyaan 	= $params['pertanyaan'];
	$daftarjawaban 		= $params['jawaban'];
	
	$insertintro = $this->model_psep->insert_intro_eksakta($idpr, $introsoal);
	//echo $daftarpertanyaan[0];
	
	$x = 0;
	foreach($daftarpertanyaan as $pertanyaan){
		//insert jawaban2
		
		$insertjawab = $this->model_psep->insert_jawaban_eksak($insertintro, $pertanyaan, $daftarjawaban[$x]);
		$x++;
		//echo "<p>".$pertanyaan;
	}
	
	redirect("psep_sekolah/pr/edit/" . $idpr);
}

function daftar_soal_eksak($idpr){
	$idsekolah = $this->session->userdata('idsekolah');
	
	$cekpr = $this->model_psep->periksa_kepemilikan_pr($idsekolah, $idpr);
	
	if($cekpr == 0){
		redirect("psep_sekolah/pr");
	}
	
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'navbar_title' 		=> "Dashboard",
		'sekolah'			=> $sekolah,
		'infopr'			=> $this->model_psep->fetch_pr_by_id($idpr),
		'datasoal'			=> $this->model_psep->fetch_soal_eksak_by_pr($idpr)
	);
	$this->load->view('psep_sekolah/pr_daftar_soal_eksak', $data);
}

function edit_intro($idintrosoal){
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	
	$data = array(
		'navbar_title' 	=> "Dashboard",
		'sekolah'		=> $sekolah,
		'intro'			=> $this->model_psep->fetch_intro_soal_by_id($idintrosoal)
	);
	
	$this->load->view("psep_sekolah/pr_edit_intro", $data);
}

function proses_edit_intro(){
	$params 			= $this->input->post(null, true);
	$idintrosoal		= $params['idintrosoal'];
	$introsoal			= $params['intro'];
	
	$this->model_psep->edit_intro_soal($idintrosoal, $introsoal);
	
	
	$infointro 	= $this->model_psep->fetch_intro_soal_by_id($idintrosoal);
	
	redirect("psep_sekolah/pr/daftar_soal_eksak/" .$infointro->id_pr);
}

function hapus_soal_eksak($idintrosoal){
	$infointro 	= $this->model_psep->fetch_intro_soal_by_id($idintrosoal);
	$idpr = $infointro->id_pr;
	//hapus intro soal
	$this->model_psep->delete_intro_soal($idintrosoal);
	
	//hapus pertanyaan
	$this->model_psep->hapus_pertanyaan_by_intro($idintrosoal);
	
	redirect("psep_sekolah/pr/daftar_soal_eksak/" .$idpr);
}

function edit_pertanyaan_eksak($idpertanyaan){
	$datatanya = $this->model_psep->fetch_pertanyaan_eksak_by_id($idpertanyaan);
	
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	
	$data = array(
		'navbar_title' 	=> "Dashboard",
		'sekolah'		=> $sekolah,
		'tanya'			=> $datatanya
	);
	
	$this->load->view("psep_sekolah/pr_edit_pertanyaan_eksak", $data);
}

function proses_edit_pertanyaan_eksak(){
	$params 			= $this->input->post(null, true);
	$idsoal				= $params['idpertanyaan'];
	$pertanyaan			= $params['pertanyaan'];
	$jawaban			= $params['jawaban'];
	
	$this->model_psep->edit_soal_eksak($idsoal, $pertanyaan, $jawaban);
	
	$infosoal = $this->model_psep->fetch_pertanyaan_eksak_by_id($idsoal);
	
	redirect("psep_sekolah/pr/daftar_soal_eksak/" .$infosoal->id_pr);
}

function hapus_pertanyaan_eksak($idsoal){
	$infosoal = $this->model_psep->fetch_pertanyaan_eksak_by_id($idsoal);
	$this->model_psep->hapus_soal_eksak($idsoal);
	redirect("psep_sekolah/pr/daftar_soal_eksak/" .$infosoal->id_pr);
}

function tambah_soal_essay($idpr){
	$idsekolah = $this->session->userdata('idsekolah');
	$cekpr = $this->model_psep->periksa_kepemilikan_pr($idsekolah, $idpr);
	
	if($cekpr == 0){
		redirect("psep_sekolah/pr");
	}
	
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'navbar_title' 		=> "Dashboard",
		'sekolah'			=> $sekolah,
		'kelasparalel'		=> $this->model_psep->fetch_kelas_paralel_by_sekolah($idsekolah),
		'datatahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah),
		'infopr'			=> $this->model_psep->fetch_pr_by_id($idpr)
	);
	
	$this->load->view('psep_sekolah/pr_tambah_soal_essay', $data);
}

function proses_tambah_soal_essai(){
	$params 			= $this->input->post(null, true);
	$idpr				= $params['idpr'];
	$soal				= $params['soal'];
	$jawaban			= $params['jawaban'];
	
	$this->model_psep->tambah_soal_essai($idpr, $soal, $jawaban);
	
	redirect("psep_sekolah/pr/daftar_soal_essai/" . $idpr);
}

function daftar_soal_essai($idpr){
	$idsekolah = $this->session->userdata('idsekolah');
	
	$cekpr = $this->model_psep->periksa_kepemilikan_pr($idsekolah, $idpr);
	
	if($cekpr == 0){
		redirect("psep_sekolah/pr");
	}
	
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'navbar_title' 		=> "Dashboard",
		'sekolah'			=> $sekolah,
		'infopr'			=> $this->model_psep->fetch_pr_by_id($idpr),
		'datasoal'			=> $this->model_psep->fetch_soal_essai_by_pr($idpr)
	);
	$this->load->view('psep_sekolah/pr_daftar_soal_essai', $data);
}

function edit_soal_essai($idsoal){
	$datasoal = $this->model_psep->fetch_soal_essai_by_id($idsoal);
	
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	
	$data = array(
		'navbar_title' 	=> "Dashboard",
		'sekolah'		=> $sekolah,
		'soal'			=> $datasoal
	);
	
	$this->load->view("psep_sekolah/pr_edit_soal_essai", $data);
}

function proses_edit_soal_essai(){
	$params 			= $this->input->post(null, true);
	$idsoal				= $params['idsoalessai'];
	$soal				= $params['soal'];
	$jawaban			= $params['jawaban'];
	$datasoal = $this->model_psep->fetch_soal_essai_by_id($idsoal);
	$this->model_psep->edit_soal_essai($idsoal, $soal, $jawaban);
	
	redirect("psep_sekolah/pr/daftar_soal_essai/" . $datasoal->id_pr);
}

function hapus_soal_essai($idsoal){
	$infosoal = $this->model_psep->fetch_soal_essai_by_id($idsoal);
	$this->model_psep->hapus_soal_essai($idsoal);
	redirect("psep_sekolah/pr/daftar_soal_essai/" .$infosoal->id_pr);
}

function betulkan_eksak($idanalisis){
	$this->model_pr->revisi_eksak($idanalisis, 1);
	$infopr = $this->model_pr->fetch_analisis_eksak_by_id($idanalisis);
	
	redirect("psep_sekolah/pr/detail_eksak/" . $infopr->id_pr . "/" . $infopr->id_siswa);
}

function salahkan_eksak($idanalisis){
	$this->model_pr->revisi_eksak($idanalisis, 0);
	$infopr = $this->model_pr->fetch_analisis_eksak_by_id($idanalisis);
	
	redirect("psep_sekolah/pr/detail_eksak/" . $infopr->id_pr . "/" . $infopr->id_siswa);
}

function koreksi($idpr, $idsiswa){
	$infopr = $this->model_psep->fetch_pr_by_id($idpr);
	
	$this->model_psep->koreksi_pr($idpr, $idsiswa);
	if($infopr->tipe == 2){
		redirect("psep_sekolah/pr/edit/" . $idpr);
	}elseif($infopr->tipe == 3){
		redirect("psep_sekolah/pr/edit/" . $idpr);
	}
}

function rekap_essai(){
	$idsekolah = $this->session->userdata('idsekolah');
	$cekpr = $this->model_psep->periksa_kepemilikan_pr($idsekolah, $idpr);
	
	if($cekpr == 0){
		redirect("psep_sekolah/pr");
	}
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$infopr = $this->model_psep->fetch_pr_by_id($idpr);
	$datasiswa = $this->model_psep->fetch_siswa_by_kelasparalel_and_tahunajaran($idsekolah, $infopr->id_kelas_paralel, $infopr->id_tahun_ajaran);
	
	$data = array(
		'navbar_title' 		=> "Pekerjaan Rumah",
		'sekolah'			=> $sekolah,
		'infopr'			=> $infopr,
		'datasiswa'			=> $datasiswa
	);
	
	$this->load->view('psep_sekolah/pr_rekap_essai', $data);
}

function ajax_assignment($idkelas, $idtahunajaran, $idpr){
	if($idkelas !== "0" and $idtahunajaran !== "0"){
		$idsekolah = $this->session->userdata('idsekolah');
		$idsekolah = $this->session->userdata('idsekolah');
		$data = array(
			'kelasparalel'		=> $this->model_psep->fetch_kelas_paralel_by_sekolah_and_jenjang($idsekolah, $idkelas),
			'tahunajaran'		=> $this->model_psep->fetch_tahun_ajaran_by_id($idtahunajaran, $idsekolah),
			'idpr'				=> $idpr
		);
		$this->load->view("psep_sekolah/pr_ajax_kelas_assignment", $data);
	}
}

function set_assignment(){
	//echo "hahaha";
	$params 			= $this->input->post(null, true);
	$idpr				= $params['idpr'];
	$idkelasparalel		= $params['kelasparalel'];
	$idtahunajaran		= $params['tahunajaran'];
	$action				= $params['action'];
	$operasi			= $params['operasi'];
	
	$hasil = $this->model_psep->set_assignment($idpr, $idkelasparalel, $idtahunajaran, $action, $operasi);
	
	echo $hasil;
}

function ajax_daftar_soal($idpr){
	$infopr = $this->model_psep->fetch_pr_by_id($idpr);
	if($infopr->tipe == 1){
		//echo "Pilihan Ganda";
		$data = array(
			'datasoal'			=> $this->model_psep->fetch_soal_by_pr($idpr)
		);
		$this->load->view('psep_sekolah/pr_ajax_daftar_soal_pilihan_ganda', $data);
	}elseif($infopr->tipe == 2){
		 $data = array(
			'datasoal'	=> $this->model_psep->fetch_soal_eksak_by_pr($idpr),
			'idpr'		=> $idpr
		 );
		 $this->load->view("psep_sekolah/pr_ajax_daftar_soal_eksak", $data);
	}elseif($infopr->tipe == 3){
		 $data = array(
			'datasoal'	=> $this->model_psep->fetch_soal_essai_by_pr($idpr),
			'idpr'		=> $idpr
		 );
		 $this->load->view("psep_sekolah/pr_ajax/ajax_daftar_soal_essai", $data);
	}
}
function proses_tambah_soal_pilihan_ganda(){
	$params 	= $this->input->post(null, true);
	
	$idpr		= $params['idpr'];
	$sumber		= $params['sumber'];
	$idsoal		= $params['idsoal'];
	
	if($sumber == 1){
		$datasoal = $this->model_adm->fetch_soal_by_id($idsoal);
		
		$insertsoalpr = $this->model_psep->insert_soal_pr($idpr, $datasoal->isi_soal, $datasoal->jawab_1, $datasoal->jawab_2, $datasoal->jawab_3, $datasoal->jawab_4, $datasoal->jawab_5, $datasoal->pembahasan, $datasoal->pembahasan_video, $datasoal->kunci_jawaban);
	}elseif($sumber == 2){
		$datasoal = $this->model_banksoal->cari_bank_soal_by_id($idsoal);
		
		$insertsoalpr = $this->model_psep->insert_soal_pr(
			$idpr,
			$datasoal->pertanyaan,
			$datasoal->jawab_1,
			$datasoal->jawab_2,
			$datasoal->jawab_3,
			$datasoal->jawab_4,
			$datasoal->jawab_5,
			$datasoal->pembahasan_teks,
			$datasoal->pembahasan_video,
			$datasoal->kunci
		);

		//insert relasi bank soal dan soal_pr
		$this->model_psep->insert_taksonomi_bank_soal_pr($idsoal, $insertsoalpr);
	}
	//redirect("psep_sekolah/pr/daftar_soal/".$idpr);
}

function hapus_soal_pilihan_ganda(){
	$params 	= $this->input->post(null, true);
	
	$idsoal		= $params['idsoal'];
	
	
	$this->model_psep->hapus_soal_pr($idsoal);
	
	echo "soal-" . $idsoal;
	//redirect("psep_sekolah/pr/daftar_soal/".$idpr);
}

function ajax_dropdown_kelas_paralel($idkelas){
	$idsekolah = $this->session->userdata('idsekolah');
	$kelasparalel = $this->model_psep->fetch_kelas_paralel_by_sekolah_and_jenjang($idsekolah, $idkelas);
	
	?>
	<option value="0">-- Pilih Kelas Paralel --</option>
	<?php
	foreach($kelasparalel as $kelas){
		?>
		<option value="<?php echo $kelas->id_kelas_paralel;?>"><?php echo $kelas->kelas_paralel;?></option>
		<?php
	}
}

function ajax_penilaian($idkelas, $idtahunajaran, $idpr){
	if($idkelas !== "0" and $idtahunajaran !== "0"){
		//cek status pr, apakah di assignment'kan di kelas
		$idsekolah = $this->session->userdata('idsekolah');
		$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
		$infopr = $this->model_psep->fetch_pr_by_id($idpr);
		$datasiswa = $this->model_psep->fetch_siswa_by_kelasparalel_and_tahunajaran($idsekolah, $idkelas, $idtahunajaran);
		
		$data = array(
			'infopr'			=> $infopr,
			'datasiswa'			=> $datasiswa
		);
		
		if($infopr->tipe == 1){
			$this->load->view('psep_sekolah/pr_ajax/ajax_penilaian_pilihan_ganda', $data);
		}elseif($infopr->tipe == 2){
			$this->load->view('psep_sekolah/pr_ajax/ajax_penilaian_eksak', $data);
		}elseif($infopr->tipe == 3){
			$this->load->view('psep_sekolah/pr_ajax/ajax_penilaian_essai', $data);
		}
		
	}
}

function ajax_edit_intro($idintrosoal){
	$data = array(
		'intro'			=> $this->model_psep->fetch_intro_soal_by_id($idintrosoal)
	);
	
	$this->load->view("psep_sekolah/pr_ajax/ajax_edit_intro", $data);
}

function ajax_proses_edit_intro(){
	$params 			= $this->input->post(null, true);
	$idintrosoal		= $params['idintrosoal'];
	$introsoal			= $params['introsoal'];
	
	$this->model_psep->edit_intro_soal($idintrosoal, $introsoal);
	
	$infointro 	= $this->model_psep->fetch_intro_soal_by_id($idintrosoal);
	//echo "SUKSES EDIT";
	?>
	<p><strong>Pendahuluan:</strong></p>
	<?php echo $infointro->intro_soal;?>
	<?php
	//redirect("psep_sekolah/pr/daftar_soal_eksak/" .$infointro->id_pr);
}

function ajax_hapus_soal_eksak(){
	$params 			= $this->input->post(null, true);
	$idintrosoal		= $params['idintrosoal'];
	
	$infointro 	= $this->model_psep->fetch_intro_soal_by_id($idintrosoal);
	$idpr = $infointro->id_pr;
	//hapus intro soal
	$this->model_psep->delete_intro_soal($idintrosoal);
	
	//HAPUS PERTANYAAN DARI ANALISIS SISWA
	$caripertanyaan = $this->model_psep->fetch_soal_by_intro($idintrosoal);
	foreach($caripertanyaan as $tanya){
		$this->model_psep->hapus_soal_eksak($tanya->id_soal_eksak);
	}
	
	//hapus pertanyaan
	$this->model_psep->hapus_pertanyaan_by_intro($idintrosoal);
	
	//redirect("psep_sekolah/pr/daftar_soal_eksak/" .$idpr);
}

function ajax_tambah_pertanyaan_eksak($idintrosoal, $idpr){
	$data = array(
		'idintrosoal'	=> $idintrosoal,
		'idpr'			=> $idpr
	);
	$this->load->view("psep_sekolah/pr_ajax/ajax_tambah_pertanyaan_eksak", $data);
}

function ajax_proses_tambah_pertanyaan_eksak(){
	$params 			= $this->input->post(null, true);
	$idintrosoal		= $params['idintrosoal'];
	$pertanyaan			= $params['pertanyaan'];
	$jawaban			= $params['jawaban'];
	
	$this->model_psep->insert_jawaban_eksak($idintrosoal, $pertanyaan, $jawaban);
}

function ajax_edit_pertanyaan_eksak($idpertanyaan, $idpr){
	$datatanya = $this->model_psep->fetch_pertanyaan_eksak_by_id($idpertanyaan);
	
	$data = array(
		'tanya'			=> $datatanya,
		'idpr'			=> $idpr
	);
	
	$this->load->view("psep_sekolah/pr_ajax/ajax_edit_pertanyaan_eksak", $data);
}

function ajax_proses_edit_pertanyaan_eksak(){
	$params 			= $this->input->post(null, true);
	$idsoal				= $params['idpertanyaan'];
	$pertanyaan			= $params['pertanyaan'];
	$jawaban			= $params['jawaban'];
	
	$this->model_psep->edit_soal_eksak($idsoal, $pertanyaan, $jawaban);
	
	$infosoal = $this->model_psep->fetch_pertanyaan_eksak_by_id($idsoal);
	$data = json_encode($infosoal);
	echo $data;
	//redirect("psep_sekolah/pr/daftar_soal_eksak/" .$infosoal->id_pr);
}

function ajax_hapus_pertanyaan_eksak(){
	$params 			= $this->input->post(null, true);
	$idsoal				= $params['idsoal'];
	
	$this->model_psep->hapus_soal_eksak($idsoal);
	
}

function ajax_proses_tambah_soal_essai(){
	$params 			= $this->input->post(null, true);
	$idpr				= $params['idpr'];
	$soal				= $params['soal'];
	$jawaban			= $params['jawaban'];
	
	$this->model_psep->tambah_soal_essai($idpr, $soal, $jawaban);
	
	//redirect("psep_sekolah/pr/daftar_soal_essai/" . $idpr);
}

function ajax_edit_soal_essai($idsoal){
	$datasoal = $this->model_psep->fetch_soal_essai_by_id($idsoal);
	
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	
	$data = array(
		'sekolah'		=> $sekolah,
		'soal'			=> $datasoal
	);
	
	$this->load->view("psep_sekolah/pr_ajax/ajax_edit_soal_essai", $data);
}

function ajax_edit_jawaban_essai($idsoal){
	$datasoal = $this->model_psep->fetch_soal_essai_by_id($idsoal);
	
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	
	$data = array(
		'sekolah'		=> $sekolah,
		'soal'			=> $datasoal
	);
	
	$this->load->view("psep_sekolah/pr_ajax/ajax_edit_jawaban_essai", $data);
}

function ajax_proses_edit_soal_essai(){
	$params 			= $this->input->post(null, true);
	$idsoal				= $params['idsoal'];
	$soal				= $params['soal'];
	
	
	$datasoal = $this->model_psep->fetch_soal_essai_by_id($idsoal);
	
	$this->model_psep->edit_soal_essai($idsoal, $soal, $datasoal->jawaban);
	
	$fetchnewsoal = $this->model_psep->fetch_soal_essai_by_id($idsoal);
	echo json_encode($fetchnewsoal);
	//redirect("psep_sekolah/pr/daftar_soal_essai/" . $datasoal->id_pr);
}

function ajax_proses_edit_jawaban_essai(){
	$params 			= $this->input->post(null, true);
	$idsoal				= $params['idsoal'];
	$jawaban			= $params['jawaban'];
	
	
	$datasoal = $this->model_psep->fetch_soal_essai_by_id($idsoal);
	
	$this->model_psep->edit_soal_essai($idsoal, $datasoal->soal, $jawaban);
	
	$fetchnewsoal = $this->model_psep->fetch_soal_essai_by_id($idsoal);
	echo json_encode($fetchnewsoal);
	//redirect("psep_sekolah/pr/daftar_soal_essai/" . $datasoal->id_pr);
}

function ajax_proses_hapus_soal_essai(){
	$params 			= $this->input->post(null, true);
	$idsoal				= $params['idsoal'];
	
	$this->model_psep->hapus_soal_essai($idsoal);
	echo $idsoal;
}

function detail_essai($idpr, $idsiswa){
	$idsekolah 			= $this->session->userdata('idsekolah');
	$sekolah 			= $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$data = array(
		'sekolah'		=> $sekolah,
		'infopr'		=> $this->model_pr->get_info_pr($idpr),
		'infosiswa'		=> $infosiswa,
		'data_soal'		=> $this->model_psep->fetch_soal_essai_by_pr($idpr),
		'idpr'			=> $idpr,
		'idsiswa'		=> $idsiswa,
		'jumlahsoal'	=> $this->model_psep->fetch_jumlah_soal_essai($idpr),
		'jumlahbenarsiswa'	=> $this->model_psep->fetch_jumlah_benar_essai_siswa($idpr, $idsiswa)
	 );
	 $this->load->view("psep_sekolah/pr_detail_essai", $data);
}

function ajax_koreksi_jawaban_essai(){
	$params 		= $this->input->post(null, true);
	$idanalisis		= $params['idanalisis'];
	$status			= $params['status'];
	
	$this->model_psep->koreksi_analisis_essai($idanalisis, $status);
	
	echo $idanalisis . "-" . $status;
}

function ajax_reload_grafik_essai($idpr, $idsiswa){
	$idsekolah 			= $this->session->userdata('idsekolah');
	$sekolah 			= $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$data = array(
		'sekolah'		=> $sekolah,
		'infopr'		=> $this->model_pr->get_info_pr($idpr),
		'infosiswa'		=> $infosiswa,
		'data_soal'		=> $this->model_psep->fetch_soal_essai_by_pr($idpr),
		'idpr'			=> $idpr,
		'idsiswa'		=> $idsiswa,
		'jumlahsoal'	=> $this->model_psep->fetch_jumlah_soal_essai($idpr),
		'jumlahbenarsiswa'	=> $this->model_psep->fetch_jumlah_benar_essai_siswa($idpr, $idsiswa)
	 );
	 $this->load->view("psep_sekolah/pr_ajax/ajax_load_grafik_essai", $data);
}



//FUNCTION BARU UNTUK SET PENJADWALAN TUGAS
//#########################################
//#########################################
//#########################################
function ajax_set_jadwal($idconfig){
	$data = array(
		'config'	=> $this->model_psep->fetch_config_pr_by_id($idconfig)
	);
	$this->load->view("psep_sekolah/pr_ajax/ajax_set_jadwal", $data);
}

function proses_set_jadwal(){
	$params 		= $this->input->post(null, true);
	$idconfig		= $params['id_config_pr'];
	$tanggalmulai	= new DateTime($params['akses_start']);
	$tanggalakhir	= new DateTime($params['akses_end']);
	$bahas			= new DateTime($params['bahas_start']);

	$akses_start	= date_format($tanggalmulai, 'Y-m-d H:i:s');
	$akses_end		= date_format($tanggalakhir, 'Y-m-d H:i:s');
	$bahas_start	= date_format($bahas, 'Y-m-d H:i:s');

	if($akses_start <= $akses_end){
		$this->model_psep->set_jadwal($idconfig, $akses_start, $akses_end, $bahas_start);
	}else{
		echo "failed";
	}
}
//END FUNCTION PENJADWALAN TUGAS
//#########################################
//#########################################
//#########################################

//ajax filter latihan soal by bobot
function ajax_soal_by_latihan_and_bobot($idsubmateri, $idpr, $bobot){
	if($bobot == "semua"){
		$this->ajax_soal_by_latihan($idsubmateri, $idpr);
		return true;
	}
	$datasoal = $this->model_adm->fetch_soal_by_submateri($idsubmateri);
	$data = array(
		'datasoal'	=> $datasoal,
		'idpr'		=> $idpr,
		'bobot'		=> $bobot
	);
	$this->load->view("psep_sekolah/pr_ajax/ajax_load_latihan_soal_by_bobot", $data);
}
//end ajax filter latihan soal by bobot

//fungsi baru untuk filter bank soal sekolah
function filter_bank_soal_sekolah(){
	$params 	= $this->input->post(null, true);
	$idmapel 	= $params['idmapel'];
	$idatribut	= $params['idatribut'];
	$idpr 		= $params['idpr'];

	$datasoal 	= $this->model_psep->fetch_bank_soal_sekolah_by_mapel_and_atribut($idmapel, $idatribut);
	$data = array(
		'datasoal'	=> $datasoal,
		'idpr'		=> $idpr
	);
	$this->load->view("psep_sekolah/pr_ajax/ajax_load_bank_soal", $data);

}
//end fungsi filter bank soal sekolah

//fungsi reset tugas siswa
function ajax_reset(){
	$params 	= $this->input->post(null, true);
	$idpr 		= $params['idpr'];
	$idsiswa 	= $params['idsiswa'];

	$this->model_psep->reset_pr($idpr, $idsiswa);
}
//end fungsi reset tugas siswa
}
