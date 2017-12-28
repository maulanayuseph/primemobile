<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_psep extends CI_Model
{

	private $insert_id;

	function __construct()
	{
		parent::__construct();
	}
	
function do_login($username, $password){	
	$cred = array('username' => $username,
				   'password' => md5($password),
				   'status' => 1
			);
	
	$this->db->select('*');
	$this->db->from('login_sekolah');
	
	$this->db->where($cred);
	
	$query = $this->db->get();
	$exist = $query->num_rows();
	
	if($exist > 0){
		return $query->result();
	}
	else{
		return false;
	}
}

function data_login($username, $password){
	$cred = array('username' => $username,
				   'password' => md5($password)
			);
	
	$this->db->select('*');
	$this->db->from('login_sekolah');
	$this->db->join("sekolah", "login_sekolah.id_sekolah=sekolah.id_sekolah");
	
	$this->db->where($cred);
	
	$query = $this->db->get();
	return $query->row();
}


function cari_sekolah_by_login($idpsep){
	$this->db->select("*");
	$this->db->from("login_sekolah");
	$this->db->join("sekolah", "login_sekolah.id_sekolah=sekolah.id_sekolah");
	$this->db->where('id_login_sekolah', $idpsep);
	
	$query = $this->db->get();
	return $query->row();
}
function fetch_sekolah_by_id($idsekolah){
	$this->db->select("*");
	$this->db->from("sekolah");
	$this->db->where('id_sekolah', $idsekolah);
	
	$query = $this->db->get();
	return $query->row();
}

function cari_kelas_by_jenjang($jenjang){
	$this->db->select("*");
	$this->db->from("kelas");
	$this->db->where("jenjang", $jenjang);
	
	$query = $this->db->get();
	return $query->result();
}

function cari_siswa_by_kelas($kelas, $idsekolah){
	$this->db->select("*");
	$this->db->from("siswa");
	$this->db->join("kelas", "siswa.kelas=kelas.id_kelas");
	$this->db->where("kelas.id_kelas", $kelas);
	$this->db->where("sekolah_id", $idsekolah);
	
	$query = $this->db->get();
	return $query->result();
}

function hitung_siswa_by_kelas($kelas, $idsekolah){
	$this->db->select("*");
	$this->db->from("siswa");
	$this->db->where("kelas", $kelas);
	$this->db->where("sekolah_id", $idsekolah);
	
	$result = $this->db->count_all_results();
	return $result;
}




//#########################################################################
//#########################################################################
function fetch_kelas_by_jenjang($jenjang){
	$this->db->order_by('tingkatan_kelas', 'ASC');
	$this->db->where("jenjang", $jenjang);
	$query = $this->db->get('kelas');
	
	return $query->result();
}
// model untuk manajemen guru di akun psep sekolah
// ##################################################
// ##################################################
// ##################################################
function fetch_all_guru($idsekolah){
	$this->db->select("*");
	$this->db->from("login_sekolah");
	$this->db->where("login_sekolah.level", "guru");
	$this->db->where("login_sekolah.id_sekolah", $idsekolah);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_kelas_by_id($idkelas){
	$this->db->select("*");
	$this->db->from("kelas");
	$this->db->where("id_kelas", $idkelas);
	
	$query = $this->db->get();
	return $query->row();
}

function tambah_guru($idsekolah, $nama, $email, $username, $password, $identitas){
	$data = array(
		'id_sekolah' 			=> $idsekolah,
		'username' 				=> $username,
		'password' 				=> md5($password),
		'nama' 					=> $nama,
		'kartu_identitas' 		=> $identitas,
		'email' 				=> $email,
		'status'				=> 0,
		'level'					=> 'guru'
		);
	$result = $this->db->insert('login_sekolah', $data);
}
// end model untuk manajemen guru di akun psep sekolah
// ##################################################
// ##################################################
// ##################################################

// MODEL UNTUK TAHUN AJARAN
// ##################################################
// ##################################################
// ##################################################

function fetch_tahun_ajaran_by_sekolah($idsekolah){
	$this->db->select("*");
	$this->db->from("tahun_ajaran");
	$this->db->where("id_sekolah", $idsekolah);
	
	$query = $this->db->get();
	return $query->result();
}

function tambah_tahun_ajaran($idsekolah, $tahun){
	$data = array(
		'id_sekolah' 	=> $idsekolah,
		'tahun_ajaran'	=> $tahun
	);
	$result = $this->db->insert('tahun_ajaran', $data);
}

function fetch_tahun_ajaran_by_id($idtahunajaran, $idsekolah){
	$this->db->select("*");
	$this->db->from("tahun_ajaran");
	$this->db->where("id_tahun_ajaran", $idtahunajaran);
	$this->db->where("id_sekolah", $idsekolah);
	
	$query = $this->db->get();
	return $query->row();
}

function edit_tahun_ajaran($idtahunajaran, $tahun){
	$data = array(
		'tahun_ajaran'	=> $tahun
	);
	$this->db->where('id_tahun_ajaran', $idtahunajaran);
	$result = $this->db->update('tahun_ajaran', $data);
	return $result;
}

function hapus_tahun_ajaran($idtahunajaran){
		$this->db->delete('tahun_ajaran', array('id_tahun_ajaran' => $idtahunajaran));
}
// end model untuk tahun ajaran
// ##################################################
// ##################################################
// ##################################################

// MODEL UNTUK KELAS paralel
// ##################################################
// ##################################################
// ##################################################

function fetch_kelas_paralel_by_sekolah($idsekolah){
	$this->db->select("*");
	$this->db->from("kelas_paralel");
	$this->db->join("kelas", "kelas_paralel.id_kelas=kelas.id_kelas");
	$this->db->where("id_sekolah", $idsekolah);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_kelas_paralel_by_sekolah_and_jenjang($idsekolah, $idkelas){
	$this->db->select("*");
	$this->db->from("kelas_paralel");
	$this->db->join("kelas", "kelas_paralel.id_kelas=kelas.id_kelas");
	$this->db->where("id_sekolah", $idsekolah);
	$this->db->where("kelas_paralel.id_kelas", $idkelas);
	
	$query = $this->db->get();
	return $query->result();
}

function tambah_kelas_paralel($idsekolah, $idkelas, $kelasparalel){
	$data = array(
		'id_sekolah' 	=> $idsekolah,
		'id_kelas'		=> $idkelas,
		'kelas_paralel'	=> $kelasparalel
	);
	$result = $this->db->insert('kelas_paralel', $data);
}

function fetch_kelas_paralel_by_id($idkelasparalel, $idsekolah){
	$this->db->select("*");
	$this->db->from("kelas_paralel");
	$this->db->join("kelas", "kelas_paralel.id_kelas=kelas.id_kelas");
	$this->db->where("id_kelas_paralel", $idkelasparalel);
	$this->db->where("id_sekolah", $idsekolah);
	
	$query = $this->db->get();
	return $query->row();
}

function edit_kelas_paralel($idkelasparalel, $idsekolah, $idkelas, $kelasparalel){
	$data = array(
		'id_kelas'		=> $idkelas,
		'kelas_paralel'	=> $kelasparalel
	);
	$this->db->where('id_kelas_paralel', $idkelasparalel);
	$result = $this->db->update('kelas_paralel', $data);
	return $result;
}

function hapus_kelas_paralel($idkelasparalel){
		$this->db->delete('kelas_paralel', array('id_kelas_paralel' => $idkelasparalel));
}

function hapus_siswa_psep_by_kelas(){
	$this->db->delete('siswa_psep', array('id_kelas_paralel' => $idkelasparalel));
}
// END MODEL KELAS paralel
// ##################################################
// ##################################################
// ##################################################

// MODEL UNTUK siswa psep
// ##################################################
// ##################################################
// ##################################################

function fetch_kelas_paralel_by_kelas($idsekolah, $idkelas){
	$this->db->select("*");
	$this->db->from("kelas_paralel");
	$this->db->join("kelas", "kelas_paralel.id_kelas=kelas.id_kelas");
	$this->db->where("id_sekolah", $idsekolah);
	$this->db->where("kelas_paralel.id_kelas", $idkelas);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_siswa_by_nama($nama, $idsekolah){
	$this->db->select("*");
	$this->db->from("siswa");
	$this->db->join("kelas", "siswa.kelas=kelas.id_kelas");
	$this->db->where('nama_siswa LIKE', '%'.$nama.'%');
	$this->db->where("sekolah_id", $idsekolah);
	
	$query = $this->db->get();
	return $query->result();
}

function cek_siswa_psep($idsekolah, $kelasparalel, $tahunajaran, $siswa){
	$this->db->select("*");
	$this->db->from("siswa_psep");
	$this->db->where("id_sekolah", $idsekolah);
	$this->db->where("id_kelas_paralel", $kelasparalel);
	$this->db->where("id_tahun_ajaran", $tahunajaran);
	$this->db->where("id_siswa", $siswa);
	
	
	$result = $this->db->count_all_results();
	return $result;
}

function insert_siswa_paralel($idsekolah, $idkelasparalel, $idtahunajaran, $siswa){
	$data = array(
		'id_sekolah' 		=> $idsekolah,
		'id_kelas_paralel'	=> $idkelasparalel,
		'id_tahun_ajaran'	=> $idtahunajaran,
		'id_siswa'			=> $siswa
	);
	$result = $this->db->insert('siswa_psep', $data);
}


function fetch_siswa_by_kelasparalel_and_tahunajaran($idsekolah, $idkelasparalel, $idtahunajaran){
	$this->db->select("*");
	$this->db->from("siswa_psep");
	$this->db->join("tahun_ajaran", "siswa_psep.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran");
	$this->db->join("kelas_paralel", "siswa_psep.id_kelas_paralel = kelas_paralel.id_kelas_paralel");
	$this->db->join("siswa", "siswa_psep.id_siswa = siswa.id_siswa", "left");
	$this->db->join("kelas", "siswa.kelas = kelas.id_kelas");
	$this->db->where("siswa.sekolah_id", $idsekolah);
	$this->db->where("siswa_psep.id_kelas_paralel", $idkelasparalel);
	$this->db->where("siswa_psep.id_tahun_ajaran", $idtahunajaran);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_siswa_by_kelasparalel_and_tahunajaran2($idsekolah, $idkelasparalel, $idtahunajaran){
	$this->db->select("*");
	$this->db->from("siswa_psep");
	$this->db->join("tahun_ajaran", "siswa_psep.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran");
	$this->db->join("kelas_paralel", "siswa_psep.id_kelas_paralel = kelas_paralel.id_kelas_paralel");
	$this->db->join("siswa", "siswa_psep.id_siswa = siswa.id_siswa");
	$this->db->join("kelas", "siswa.kelas = kelas.id_kelas");
	$this->db->join("login_siswa", "siswa.id_login = login_siswa.id_login");
	$this->db->where("siswa.sekolah_id", $idsekolah);
	$this->db->where("siswa_psep.id_kelas_paralel", $idkelasparalel);
	$this->db->where("siswa_psep.id_tahun_ajaran", $idtahunajaran);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_siswa_by_kelasparalel($idsekolah, $idkelasparalel, $idtahunajaran){
	$this->db->select("*");
	$this->db->from("siswa_psep");
	$this->db->join("tahun_ajaran", "siswa_psep.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran");
	$this->db->join("kelas_paralel", "siswa_psep.id_kelas_paralel = kelas_paralel.id_kelas_paralel");
	$this->db->join("siswa", "siswa_psep.id_siswa = siswa.id_siswa");
	$this->db->join("kelas", "siswa.kelas = kelas.id_kelas");
	$this->db->where("siswa.sekolah_id", $idsekolah);
	$this->db->where("siswa_psep.id_kelas_paralel", $idkelasparalel);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_siswa_by_tahunajaran($idsekolah, $idkelasparalel, $idtahunajaran){
	$this->db->select("*");
	$this->db->from("siswa_psep");
	$this->db->join("tahun_ajaran", "siswa_psep.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran");
	$this->db->join("kelas_paralel", "siswa_psep.id_kelas_paralel = kelas_paralel.id_kelas_paralel");
	$this->db->join("siswa", "siswa_psep.id_siswa = siswa.id_siswa");
	$this->db->join("kelas", "siswa.kelas = kelas.id_kelas");
	$this->db->where("siswa.sekolah_id", $idsekolah);
	$this->db->where("siswa_psep.id_tahun_ajaran", $idtahunajaran);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_siswa_by_id_siswa_psep($idsiswapsep){
	$this->db->select("*");
	$this->db->from("siswa_psep");
	$this->db->join("tahun_ajaran", "siswa_psep.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran");
	$this->db->join("kelas_paralel", "siswa_psep.id_kelas_paralel = kelas_paralel.id_kelas_paralel");
	$this->db->join("siswa", "siswa_psep.id_siswa = siswa.id_siswa");
	$this->db->join("kelas", "siswa.kelas = kelas.id_kelas");
	$this->db->where("siswa_psep.id_siswa_psep", $idsiswapsep);
	
	$query = $this->db->get();
	return $query->row();
}

function edit_siswa_psep($idsiswapsep, $kelasparalel, $tahunajaran){
	$data = array(
		'id_kelas_paralel'		=> $kelasparalel,
		'id_tahun_ajaran'		=> $tahunajaran
	);
	$this->db->where('id_siswa_psep', $idsiswapsep);
	$result = $this->db->update('siswa_psep', $data);
	return $result;
}

function hapus_siswa_psep($idsiswapsep){
		$this->db->delete('siswa_psep', array('id_siswa_psep' => $idsiswapsep));
}
// END MODEL siswa psep
// ##################################################
// ##################################################
// ##################################################


// MODEL UNTUK PERHITUNGAN DAN URUSAN AGCU!!!!!!!!!!!!
// ##################################################
// ##################################################
// ##################################################
function get_jumlah_soal_benar_by_kelas_paralel($idkelasparalel){
	$this->db->select('
	hasil_diagnostic.id_diagnostic,
	hasil_diagnostic.id_siswa,
	hasil_diagnostic.id_soal
	');
	$this->db->from('hasil_diagnostic');
	$this->db->join("siswa", "hasil_diagnostic.id_siswa=siswa.id_siswa");
	$this->db->join("siswa_psep", "siswa.id_siswa=siswa_psep.id_siswa");
	$this->db->where('hasil_diagnostic.status', 1);
	$this->db->where('siswa_psep.id_kelas_paralel', $idkelasparalel);
	
	$query = $this->db->get();
	return $query->result();
}

//BUAT FUNGSI UNTUK MENCARI DAN MENGHITUNG SISWA YANG SUDAH MELAKUKAN AGCU
//#########################################################################
//#########################################################################

//hitung jumlah soal diagnostic untuk dibandingkan dengan hasil diagnostic apakah jumlahnya sama dengan yang dikerjakan siswa, jika sama, berarti siswa sudah mengerjakan diagnostic
function hitung_soal_diagnostic($idkelas){
	$this->db->select("*");
	$this->db->from("soal_diagnostic");
	$this->db->join("kategori_diagnostic", "soal_diagnostic.id_diagnostic = kategori_diagnostic.id_diagnostic");
	$this->db->join("mata_pelajaran", "kategori_diagnostic.id_mapel = mata_pelajaran.id_mapel");
	$this->db->where("mata_pelajaran.kelas_id", $idkelas);
	
	$result = $this->db->count_all_results();
	return $result;
}

//jumlah soal per kategori diagnostic
function fetch_diagnostic_by_kelas($idkelas){
	$this->db->select("*");
	$this->db->from("kategori_diagnostic");
	$this->db->join("mata_pelajaran", "kategori_diagnostic.id_mapel=mata_pelajaran.id_mapel");
	$this->db->where("mata_pelajaran.kelas_id", $idkelas);
	$query = $this->db->get();
	return $query->result();
}
function hitung_soal_diagnostic_by_kategori($iddiagnostic){
	$this->db->select("*");
	$this->db->from("soal_diagnostic");
	$this->db->where("id_diagnostic", $iddiagnostic);
	$result = $this->db->count_all_results();
	return $result;
}
function hitung_soal_diagnostic_terjawab_by_kategori_and_siswa($iddiagnostic, $idsiswa){
	$this->db->select("*");
	$this->db->from("hasil_diagnostic");
	$this->db->where("id_diagnostic", $iddiagnostic);
	$this->db->where("id_siswa", $idsiswa);
	
	$result = $this->db->count_all_results();
	return $result;
}


function hitung_jumlah_soal_terjawab_eq_siswa($idsiswa){
	$this->db->select("*");
	$this->db->from("hasil_eq");
	$this->db->where("id_siswa", $idsiswa);
	
	$result = $this->db->count_all_results();
	return $result;
}

function hitung_jumlah_soal_terjawab_ls_siswa($idsiswa){
	$this->db->select("*");
	$this->db->from("hasil_ls");
	$this->db->where("id_siswa", $idsiswa);
	
	$result = $this->db->count_all_results();
	return $result;
}

// END MODEL UNTUK PERHITUNGAN DAN URUSAN AGCU!!!!!!!!!!!!
// ##################################################
// ##################################################
// ##################################################

//MODEL UNTUK DASHBOARD SISWA
function fetch_tahun_ajaran_siswa($idsiswa, $idkelas){
	$this->db->select("*");
	$this->db->from("siswa_psep");
	$this->db->join("kelas_paralel", "siswa_psep.id_kelas_paralel = kelas_paralel.id_kelas_paralel");
	
	$this->db->where("siswa_psep.id_siswa", $idsiswa);
	$this->db->where("kelas_paralel.id_kelas", $idkelas);
	
	if($this->db->count_all_results() > 0){
		$this->db->select("*");
		$this->db->from("siswa_psep");
		$this->db->join("kelas_paralel", "siswa_psep.id_kelas_paralel = kelas_paralel.id_kelas_paralel");
		
		$this->db->where("siswa_psep.id_siswa", $idsiswa);
		$this->db->where("kelas_paralel.id_kelas", $idkelas);
		
		$query = $this->db->get();
		return $query->row();
	}else{
		return null;
	}
}
//END MODEL UNTUK DASHBOARD SISWA

//model untuk rekapitulasi psep
function fetch_profil_by_sekolah($idsekolah){
	$this->db->select("*");
	$this->db->from("cbt_psep");
	$this->db->join("profil_tryout", "cbt_psep.id_profil = profil_tryout.id_tryout", "left");
	$this->db->where("cbt_psep.id_sekolah", $idsekolah);
	
	$query = $this->db->get();
	return $query->result();
}

function get_tryout_by_profil2($idprofil){
	$this->db->select("*");
	$this->db->from("kategori_tryout");
	$this->db->join("profil_tryout", "kategori_tryout.id_profil=profil_tryout.id_tryout", "left");
	$this->db->join("kelas", "profil_tryout.id_kelas=kelas.id_kelas", "left");
	$this->db->where("profil_tryout.id_tryout", $idprofil);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_abs_by_kategori($idkategori, $idsoal, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_topik");
	$this->db->where("id_kategori", $idkategori);
	$this->db->where("id_soal", $idsoal);
	$this->db->where("id_siswa", $idsiswa);
	
	$query = $this->db->get();
	return $query->row();
}

//end model untuk rekapitulasi psep

//MODEL UNTUK PEKERJAAN RUMAH
//################################
//################################

function fetch_ajax_pekerjaan_rumah($idkelasparalel, $idtahunajaran, $idsekolah){
	if($idkelasparalel !== 0 and $idtahunajaran !== 0){
		$this->db->select("*");
		$this->db->from("pekerjaan_rumah");
		$this->db->join("tahun_ajaran", "pekerjaan_rumah.id_tahun_ajaran=tahun_ajaran.id_tahun_ajaran", "left");
		$this->db->join("kelas_paralel", "pekerjaan_rumah.id_kelas_paralel=kelas_paralel.id_kelas_paralel", "left");
		$this->db->where("kelas_paralel.id_sekolah", $idsekolah);
		$this->db->where("pekerjaan_rumah.id_kelas_paralel", $idkelasparalel);
		$this->db->where("pekerjaan_rumah.id_tahun_ajaran", $idtahunajaran);
		$this->db->group_start();
		$this->db->where("pekerjaan_rumah.id_guru", 0);
		$this->db->or_where("pekerjaan_rumah.id_guru", $this->session->userdata("id_guru"));
		$this->db->group_end();
		$this->db->order_by("id_pr", "DESC");
		
		$query = $this->db->get();
		return $query->result();
	}elseif($idkelasparalel !== 0 and $idtahunajaran == 0){
		$this->db->select("*");
		$this->db->from("pekerjaan_rumah");
		$this->db->join("tahun_ajaran", "pekerjaan_rumah.id_tahun_ajaran=tahun_ajaran.id_tahun_ajaran", "left");
		$this->db->join("kelas_paralel", "pekerjaan_rumah.id_kelas_paralel=kelas_paralel.id_kelas_paralel", "left");
		$this->db->where("kelas_paralel.id_sekolah", $idsekolah);
		$this->db->where("pekerjaan_rumah.id_kelas_paralel", $idkelasparalel);
		$this->db->group_start();
		$this->db->where("pekerjaan_rumah.id_guru", 0);
		$this->db->or_where("pekerjaan_rumah.id_guru", $this->session->userdata("id_guru"));
		$this->db->group_end();
		
		$query = $this->db->get();
		return $query->result();
	}elseif($idkelasparalel == 0 and $idtahunajaran !== 0){
		$this->db->select("*");
		$this->db->from("pekerjaan_rumah");
		$this->db->join("tahun_ajaran", "pekerjaan_rumah.id_tahun_ajaran=tahun_ajaran.id_tahun_ajaran", "left");
		$this->db->join("kelas_paralel", "pekerjaan_rumah.id_kelas_paralel=kelas_paralel.id_kelas_paralel", "left");
		$this->db->where("kelas_paralel.id_sekolah", $idsekolah);
		$this->db->where("pekerjaan_rumah.id_tahun_ajaran", $idtahunajaran);
		$this->db->group_start();
		$this->db->where("pekerjaan_rumah.id_guru", 0);
		$this->db->or_where("pekerjaan_rumah.id_guru", $this->session->userdata("id_guru"));
		$this->db->group_end();
		
		$query = $this->db->get();
		return $query->result();
	}
}

function tambah_pr($tipe, $tahun, $kelas, $namapr, $deadline){
	$data = array(
		'id_tahun_ajaran'	=> $tahun,
		'id_kelas_paralel'	=> $kelas,
		'nama_pr'			=> $namapr,
		'deadline'			=> $deadline,
		'tipe'				=> $tipe,
		'id_guru'			=> $this->session->userdata("id_guru")
	);
	$result = $this->db->insert('pekerjaan_rumah', $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function periksa_kepemilikan_pr($idsekolah, $idpr){
	$this->db->select("*");
	$this->db->from("pekerjaan_rumah");
	$this->db->join("tahun_ajaran", "pekerjaan_rumah.id_tahun_ajaran=tahun_ajaran.id_tahun_ajaran", "left");
	$this->db->join("kelas_paralel", "pekerjaan_rumah.id_kelas_paralel=kelas_paralel.id_kelas_paralel", "left");
	$this->db->where("kelas_paralel.id_sekolah", $idsekolah);
	$this->db->where("id_pr", $idpr);
	
	$result = $this->db->count_all_results();
	return $result;
}

function fetch_pr_by_id($idpr){
	$this->db->select("*");
	$this->db->from("pekerjaan_rumah");
	$this->db->join("tahun_ajaran", "pekerjaan_rumah.id_tahun_ajaran=tahun_ajaran.id_tahun_ajaran", "left");
	$this->db->join("kelas_paralel", "pekerjaan_rumah.id_kelas_paralel=kelas_paralel.id_kelas_paralel", "left");
	$this->db->join("kelas", "kelas_paralel.id_kelas=kelas.id_kelas", "left");
	$this->db->where("id_pr", $idpr);
	
	$query = $this->db->get();
	return $query->row();
}

function insert_soal_pr($idpr, $pertanyaan, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $pembahasanteks, $pembahasanvideo, $kunci ){
	$data = array(
		'id_pr'				=> $idpr,
		'pertanyaan'		=> $pertanyaan,
		'jawab_1'			=> $jawab1,
		'jawab_2'			=> $jawab2,
		'jawab_3'			=> $jawab3,
		'jawab_4'			=> $jawab4,
		'jawab_5'			=> $jawab5,
		'pembahasan_teks'	=> $pembahasanteks,
		'pembahasan_video'	=> $pembahasanvideo,
		'kunci'				=> $kunci
	);
	$result = $this->db->insert('soal_pr', $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function fetch_pekerjaan_rumah($idsekolah){
	$this->db->select("*");
	$this->db->from("pekerjaan_rumah");
	$this->db->join("kelas_paralel", "pekerjaan_rumah.id_kelas_paralel = kelas_paralel.id_kelas_paralel");
	$this->db->join("tahun_ajaran", "pekerjaan_rumah.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran");
	$this->db->where("kelas_paralel.id_sekolah", $idsekolah);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_pekerjaan_rumah_by_guru($idguru){
	$this->db->select("*");
	$this->db->from("pekerjaan_rumah");
	$this->db->where("id_guru", $idguru);
	$this->db->order_by("id_pr", "DESC");
	$query = $this->db->get();
	return $query->result();
}

function fetch_soal_by_pr($idpr){
	$this->db->select("*");
	$this->db->from("soal_pr");
	$this->db->where("id_pr", $idpr);
	
	$query = $this->db->get();
	return $query->result();
}

function hapus_soal_pr($idsoal){
	$this->db->delete('soal_pr', array('id_soal_pr' => $idsoal));
	$this->db->delete('analisis_pr', array('id_soal_pr' => $idsoal));
}

function fetch_pr_by_kelas_and_tahun_ajaran($idkelasparalel, $idtahunajaran){
	$this->db->select("*");
	$this->db->from("pekerjaan_rumah");
	$this->db->where("id_kelas_paralel", $idkelasparalel);
	$this->db->where("id_tahun_ajaran", $idtahunajaran);
	
	if($this->db->count_all_results() > 0){
		$this->db->select("*");
		$this->db->from("pekerjaan_rumah");
		$this->db->where("id_kelas_paralel", $idkelasparalel);
		$this->db->where("id_tahun_ajaran", $idtahunajaran);
		$this->db->order_by("id_pr", "DESC");
		$query = $this->db->get();
		return $query->result();
	}else{
		return null;
	}
}

function edit_pr($idpr, $kelas, $tahun, $namapr, $deadline){
	$data = array(
		'id_kelas_paralel'	=> $kelas,
		'id_tahun_ajaran'	=> $tahun,
		'nama_pr'			=> $namapr,
		'deadline'			=> $deadline
	);
	$this->db->where('id_pr', $idpr);
	$result = $this->db->update('pekerjaan_rumah', $data);
	return $result;
}

function hapus_analisis_pr_by_pr($idpr){
	$this->db->delete('analisis_pr', array('id_pr' => $idpr));
}
function hapus_analisis_pr_eksak_by_pr($idpr){
	$this->db->delete('analisis_pr_eksak', array('id_pr' => $idpr));
}

function hapus_soal_pr_by_pr($idpr){
	$this->db->delete('soal_pr', array('id_pr' => $idpr));
}

function hapus_status_pr_by_pr($idpr){
	$this->db->delete('status_pr', array('id_pr' => $idpr));
}

function hapus_pr($idpr){
	$this->db->delete('pekerjaan_rumah', array('id_pr' => $idpr));
}

function insert_intro_eksakta($idpr, $introsoal){
	$data = array(
		'id_pr'				=> $idpr,
		'intro_soal'		=> $introsoal
	);
	$result = $this->db->insert('intro_soal', $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	
	return $insert_id;
}

function  insert_jawaban_eksak($idintro, $pertanyaan, $jawaban){
	$data = array(
		"id_intro_soal"	=> $idintro,
		"pertanyaan"	=> $pertanyaan,
		"jawaban"		=> $jawaban
	);
	$this->db->insert('soal_eksak', $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function fetch_soal_eksak_by_id($idpertanyaan){
	$this->db->select("*");
	$this->db->from("soal_eksak");
	$this->db->where("id_soal_eksak", $idpertanyaan);
	
	$query = $this->db->get();
	return $query->row();
}

function fetch_soal_eksak_by_pr($idpr){
	$this->db->select("*");
	$this->db->from("intro_soal");
	$this->db->where("intro_soal.id_pr", $idpr);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_soal_by_intro($idintro){
	$this->db->select("*");
	$this->db->from("soal_eksak");
	$this->db->where("id_intro_soal", $idintro);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_intro_soal_by_id($idintrosoal){
	$this->db->select("*");
	$this->db->from("intro_soal");
	$this->db->where("id_intro_soal", $idintrosoal);
	
	$query = $this->db->get();
	return $query->row();
}

function edit_intro_soal($idintrosoal, $introsoal){
	$data = array(
		'intro_soal'	=> $introsoal
	);
	$this->db->where('id_intro_soal', $idintrosoal);
	$result = $this->db->update('intro_soal', $data);
	return $result;
}

function delete_intro_soal($idintrosoal){
	$this->db->delete('intro_soal', array('id_intro_soal' => $idintrosoal));
}

function hapus_pertanyaan_by_intro($idintrosoal){
	$this->db->delete('soal_eksak', array('id_intro_soal' => $idintrosoal));
}

function fetch_pertanyaan_eksak_by_id($idpertanyaan){
	$this->db->select("*");
	$this->db->from("soal_eksak");
	$this->db->join("intro_soal", "soal_eksak.id_intro_soal = intro_soal.id_intro_soal");
	$this->db->where("id_soal_eksak", $idpertanyaan);
	
	$query = $this->db->get();
	return $query->row();
}

function edit_soal_eksak($idsoal, $pertanyaan, $jawaban){
	$data = array(
		'pertanyaan'	=> $pertanyaan,
		'jawaban'		=> $jawaban
	);
	$this->db->where('id_soal_eksak', $idsoal);
	$result = $this->db->update('soal_eksak', $data);
	return $result;
}

function hapus_soal_eksak($idsoal){
	$this->db->delete('soal_eksak', array('id_soal_eksak' => $idsoal));
	$this->db->delete('analisis_pr_eksak', array('id_pertanyaan' => $idsoal));
}



function tambah_soal_essai($idpr, $soal, $jawaban){
	$data = array(
		"id_pr"			=> $idpr,
		"soal"			=> $soal,
		"jawaban"		=> $jawaban
	);
	$this->db->insert('soal_essai', $data);
}

function fetch_soal_essai_by_pr($idpr){
	$this->db->select("*");
	$this->db->from("soal_essai");
	$this->db->where("id_pr", $idpr);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_soal_essai_by_id($idsoal){
	$this->db->select("*");
	$this->db->from("soal_essai");
	$this->db->where("id_soal_essai", $idsoal);
	
	$query = $this->db->get();
	return $query->row();
}

function edit_soal_essai($idsoal, $soal, $jawaban){
	$data = array(
		'soal'		=> $soal,
		'jawaban'	=> $jawaban
	);
	$this->db->where('id_soal_essai', $idsoal);
	$result = $this->db->update('soal_essai', $data);
	return $result;
}
function hapus_soal_essai($idsoal){
	$this->db->delete('soal_essai', array('id_soal_essai' => $idsoal));
	$this->db->delete('analisis_pr_essai', array('id_soal' => $idsoal));
}
function hapus_soal_essai_by_pr($idpr){
	$this->db->delete('soal_essai', array('id_pr' => $idpr));
	$this->db->delete('analisis_pr_essai', array('id_pr' => $idpr));
}

function jumlah_selesai($idpr){
	$this->db->select("*");
	$this->db->from("status_pr");
	$this->db->where("id_pr", $idpr);
	$this->db->where("status", 1);
	//$this->db->or_where("status", 2);
	//bukan pakai or where gini
	$result = $this->db->count_all_results();
	return $result;
}

function jumlah_terkoreksi($idpr){
	$this->db->select("*");
	$this->db->from("status_pr");
	$this->db->where("id_pr", $idpr);
	$this->db->where("status", 2);
	//$this->db->or_where("status", 2);
	//bukan pakai or where gini
	$result = $this->db->count_all_results();
	return $result;
}

function jumlah_siswa($idkelasparalel, $idtahunajaran){
	$this->db->select("*");
	$this->db->from("siswa_psep");
	$this->db->where("id_kelas_paralel", $idkelasparalel);
	$this->db->where("id_tahun_ajaran", $idtahunajaran);
	
	$result = $this->db->count_all_results();
	return $result;
}

function jumlah_koreksi($idpr){
	$this->db->select("*");
	$this->db->from("status_pr");
	$this->db->where("id_pr", $idpr);
	$this->db->where("status", 1);
	
	$result = $this->db->count_all_results();
	return $result;
}

function koreksi_pr($idpr, $idsiswa){
	$this->db->set('status', 2);
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	
	$query = $this->db->update('status_pr');
	return $query;
}

function set_assignment($idpr, $idkelasparalel, $idtahunajaran, $action, $operasi){
	if($operasi == "set"){
		$operasi = 1;
	}elseif($operasi == "unset"){
		$operasi = 0;
	}
	$this->db->select("*");
	$this->db->from("config_pr");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_kelas_paralel", $idkelasparalel);
	$this->db->where("id_tahun_ajaran", $idtahunajaran);
	if($this->db->count_all_results() > 0){
		$this->db->set($action, $operasi);
		$this->db->where("id_pr", $idpr);
		$this->db->where("id_kelas_paralel", $idkelasparalel);
		$this->db->where("id_tahun_ajaran", $idtahunajaran);
		
		if($this->db->update('config_pr')){
			return "sukses";
		}else{
			return "gagal";
		}
	}else{
		$data = array(
			"id_pr"					=> $idpr,
			"id_kelas_paralel"		=> $idkelasparalel,
			"id_tahun_ajaran"		=> $idtahunajaran,
			$action					=> $operasi
		);
		if($this->db->insert('config_pr', $data)){
			return "sukses";
		}else{
			return "gagal";
		}
	}
}

function fetch_config_pr_by_kelas_and_tahun($idpr, $idkelasparalel, $idtahunajaran){
	$this->db->select("*");
	$this->db->from("config_pr");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_kelas_paralel", $idkelasparalel);
	$this->db->where("id_tahun_ajaran", $idtahunajaran);
	
	$query = $this->db->get();
	return $query->row();
}


function koreksi_analisis_essai($idanalisis, $status){
	$this->db->set('status', $status);
	$this->db->where("id_analisis_pr_essai", $idanalisis);
	
	$this->db->update('analisis_pr_essai');
}

function fetch_jumlah_soal_essai($idpr){
	$this->db->select("*");
	$this->db->from("soal_essai");
	$this->db->where("id_pr", $idpr);
	return $this->db->count_all_results();
}

function fetch_jumlah_benar_essai_siswa($idpr, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_pr_essai");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_pr", $idpr);
	$this->db->where("status", 1);
	return $this->db->count_all_results();
}
//END MODEL UNTUK PEKERJAAN RUMAH
//################################
//################################

//MODEL UNTUK FUNGSI CBT
function fetch_cbt_by_jenjang($jenjang){
    $this->db->select("*");
	$this->db->from("profil_tryout");
	$this->db->join("kelas", "profil_tryout.id_kelas = kelas.id_kelas");
	$this->db->where("kelas.jenjang", $jenjang);
	$this->db->where("profil_tryout.tipe", 0);
	
	$query = $this->db->get();
	return $query->result();
}
//END MODEL UNTUK FUNGSI CBT



//MODEL UNTUK AGCU BARU, FETCH KURIKULUM PER KELAS DARI SEKOLAH DLL..
//#################################################
//#################################################
//#################################################
function fetch_profil_agcu_by_jenjang($jenjang){
	$this->db->select("*");
	$this->db->from("profil_diagnostic");
	$this->db->join("kelas", "profil_diagnostic.id_kelas = kelas.id_kelas", "left");
	$this->db->where("kelas.jenjang", $jenjang);

	$query = $this->db->get();
	return $query->result();
}
//END MODEL UNTUK AGCU BARU, FETCH KURIKULUM PER KELAS DARI SEKOLAH DLL..
//#################################################
//#################################################
//#################################################



//MODEL BARU UNTUK SET PENJADWALAN TUGAS
//#################################################
//#################################################
//#################################################
function fetch_config_pr_by_id($idconfig){
	$this->db->select("*");
	$this->db->from("config_pr");
	$this->db->where("id_config_pr", $idconfig);

	$query = $this->db->get();
	return $query->row();
}

function set_jadwal($idconfig, $aksesstart, $aksesend, $bahasstart){
	$data = array(
		"akses_start"	=> $aksesstart,
		"akses_end"		=> $aksesend,
		"bahas_start"	=> $bahasstart
	);
	$this->db->where("id_config_pr", $idconfig);
	$this->db->update("config_pr", $data);
}
//END MODEL BARU UNTUK SET PENJADWALAN TUGAS
//#################################################
//#################################################
//#################################################


//MODEL BARU UNTUK FILTERING BANK SOAL SEKOLAH
//#################################################
//#################################################
//#################################################
function fetch_mapel(){
	$this->db->select("*");
	$this->db->from("mapel");
	$this->db->order_by("nama_mapel", "ASC");
	$query = $this->db->get();
	return $query->result();
}

function fetch_atribut_sekolah($idsekolah){
	$this->db->select("*");
	$this->db->from("atribut_x_sekolah");
	$this->db->join("atribut", "atribut_x_sekolah.id_atribut = atribut.id_atribut");
	$this->db->where("id_sekolah", $idsekolah);
	$query = $this->db->get();
	return $query->result();
}

function fetch_bank_soal_sekolah_by_mapel_and_atribut($idmapel, $idatribut){
	$this->db->select("*");
	$this->db->from('bank_soal');
	$this->db->join("atribut_soal", "bank_soal.id_banksoal = atribut_soal.id_soal");
	$this->db->join("soal_x_mapel", "bank_soal.id_banksoal = soal_x_mapel.id_soal");
	$this->db->where('atribut_soal.id_atribut', $idatribut);
	$this->db->where('soal_x_mapel.id_mapel', $idmapel);

	$query = $this->db->get();
	return $query->result();
}

function insert_taksonomi_bank_soal_pr($idbanksoal, $idsoalpr){
	$data = array(
		'id_soal'		=> $idbanksoal,
		'id_soal_pr'	=> $idsoalpr
	);
	$this->db->insert('taksonomi_soal_pr', $data);
}
//END MODEL BARU UNTUK FILTERING BANK SOAL SEKOLAH
//#################################################
//#################################################
//#################################################


//MODEL BARU UNTUK PROFIL GURU
//#################################################
//#################################################
//#################################################
function cek_tabel_guru($idlogin){
	$this->db->select("*");
	$this->db->from("guru");
	$this->db->where("id_login_sekolah", $idlogin);
	
	$result = $this->db->count_all_results();
	return $result;
}

function cek_email($email){
	$this->db->select("*");
	$this->db->from("guru");
	$this->db->where("email", $email);
	
	$result = $this->db->count_all_results();
	return $result;
}
function cek_hp($hp){
	$this->db->select("*");
	$this->db->from("guru");
	$this->db->where("hp", $hp);
	
	$result = $this->db->count_all_results();
	return $result;
}

function insert_guru($nama,$email, $hp, $idkota, $alamat, $filename){
	$data = array(
		'nama'				=> $nama,
		'email'				=> $email,
		'hp'				=> $hp,
		'id_kota'			=> $idkota,
		'alamat'			=> $alamat,
		'foto'				=> $filename,
		'id_login_sekolah'	=> $this->session->userdata('idpsepsekolah')
	);
	$insert = $this->db->insert('guru', $data);
	if($insert){
		return true;
	}else{
		return false;
	}
}

function edit_guru($idlogin, $nama,$email, $hp, $idkota, $alamat, $filename){
	$data = array(
		'nama'				=> $nama,
		'email'				=> $email,
		'hp'				=> $hp,
		'id_kota'			=> $idkota,
		'alamat'			=> $alamat,
		'foto'				=> $filename
	);
	$this->db->where("id_login_sekolah", $idlogin);
	$update = $this->db->update('guru', $data);
	if($update){
		return true;
	}else{
		return false;
	}
}

function fetch_guru_by_id_login($idlogin){
	$this->db->select("*");
	$this->db->from("guru");
	$this->db->where("id_login_sekolah", $idlogin);

	$query = $this->db->get();
	return $query->row();
}

function edit_crop_image($idlogin, $gambar){
	$data = array(
		'foto_crop'	=> $gambar
	);
	$this->db->where("id_login_sekolah", $idlogin);
	$edit = $this->db->update('guru', $data);
	if($edit){
		return true;
	}else{
		return false;
	}
}

function fetch_kota_by_id($idkota){
	$this->db->select("*");
	$this->db->from("kota_kabupaten");
	$this->db->where("id_kota", $idkota);

	$query = $this->db->get();
	return $query->row();
}

function edit_foto_guru($idlogin, $filename){
	$data = array(
		'foto'		=> $filename
	);
	$this->db->where("id_login_sekolah", $idlogin);
	$edit = $this->db->update("guru", $data);
	if($edit){
		return true;
	}else{
		return false;
	}
}
//END MODEL BARU UNTUK PROFIL GURU
//#################################################
//#################################################
//#################################################


//model untuk reset pr
function reset_pr($idpr, $idsiswa){
	$data = array(
		'status'	=> 0
	);
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	$this->db->update("status_pr", $data);
}
//end model reset pr
}

?>