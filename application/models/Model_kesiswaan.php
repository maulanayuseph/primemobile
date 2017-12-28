<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_kesiswaan extends CI_Model
{

	private $insert_id;

	function __construct()
	{
		parent::__construct();
	}

function cek_email($email){
	$this->db->select("*");
	$this->db->from("siswa");
	$this->db->where("email", $email);

	return $this->db->count_all_results();;
}

//FUNCTION2 UNTUK IMPORT SISWA
//############################
//############################
//############################
function add_login_siswa($nama, $email, $telepon, $teleponortu, $namaortu, $idsekolah, $idkelas, $idkelasparalel, $idtahunajaran){

	$characters = 'abcdefghijklmnopqrstuvwxyz123456789';
	$string = '';
	$max = strlen($characters) - 1;
	for ($i = 0; $i < 5; $i++) {
	  $string .= $characters[mt_rand(0, $max)];
	}

	//ambil nama awal dari siswa
	$namaarray	= explode(" ", $nama);
	$namadepan 	= strtolower($namaarray[0]);
	$username 	= $namadepan . $string;

	//cek apakah username sudah ada yang memakai
	$this->db->select("*");
	$this->db->from("login_siswa");
	$this->db->where("username", $username);
	if($this->db->count_all_results() > 0){
		$this->add_login_siswa($nama, $email, $telepon, $teleponortu, $namaortu, $idsekolah, $idkelas, $idkelasparalel, $idtahunajaran);
	}else{
		$data = array(
			'username'	=> $username,
			'password'	=> md5($string),
			'role'		=> "siswa"
		);
		$this->db->insert("login_siswa", $data);

		$this->insert_id = $this->db->insert_id();
		$insert_id = $this->insert_id;

		$this->add_siswa($insert_id, $username, $string, $nama, $email, $telepon, $teleponortu, $namaortu, $idsekolah, $idkelas, $idkelasparalel, $idtahunajaran);
	}
}

function add_siswa($idlogin, $username, $password, $nama, $email, $telepon, $teleponortu, $namaortu, $idsekolah, $idkelas, $idkelasparalel, $idtahunajaran){
	$data = array(
		"nama_siswa"	=> $nama,
		"kelas"			=> $idkelas,
		"sekolah_id"	=> $idsekolah,
		"email"			=> $email,
		"telepon"		=> $telepon,
		"telepon_ortu"	=> $teleponortu,
		"id_login"		=> $idlogin
	);
	$this->db->insert("siswa", $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;

	$this->add_ortu($insert_id, $namaortu, $teleponortu, $email, $username, $password);

	$this->add_siswa_psep($insert_id, $idsekolah, $idkelasparalel, $idtahunajaran);
}


function add_ortu($idsiswa, $namaortu, $teleponortu, $email, $username, $password){
	$data = array(
		"id_siswa"	=> $idsiswa,
		"nama_ortu"	=> $namaortu,
		"telepon"	=> $teleponortu,
		"email"		=> $email,
		"username"	=> $username,
		"password"	=> md5($password)
	);
	$this->db->insert("parents", $data);
}

function add_siswa_psep($idsiswa, $idsekolah, $idkelasparalel, $idtahunajaran){
	$data = array(
		"id_sekolah"		=> $idsekolah,
		"id_kelas_paralel"	=> $idkelasparalel,
		"id_tahun_ajaran"	=> $idtahunajaran,
		"id_siswa"			=> $idsiswa
	);
	$this->db->insert("siswa_psep", $data);
}

//END FUNCTION2 UNTUK IMPORT SISWA
//############################
//############################
//############################


function fetch_siswa_by_id($idsiswa){
	$this->db->select("*");
	$this->db->from("siswa");
	$this->db->where("id_siswa", $idsiswa);

	$query = $this->db->get();
	return $query->row();
}

function hapus_login($idlogin){
	$this->db->where("id_login", $idlogin);
	$this->db->delete("login_siswa");
}

function hapus_siswa_psep($idsiswa){
	$this->db->where("id_siswa", $idsiswa);
	$this->db->delete("siswa_psep");
}

function hapus_siswa($idsiswa){
	$this->db->where("id_siswa", $idsiswa);
	$this->db->delete("siswa");
}

//fungsi baru untuk aktivasi event

function fetch_event_berlangsung(){
	$this->db->select("*");
	$this->db->from("event");
	$this->db->where("status", 1);

	$query = $this->db->get();
	return $query->result();
}

function fetch_event_by_id($idevent){
	$this->db->select("*");
	$this->db->from("event");
	$this->db->where("id_event", $idevent);

	$query = $this->db->get();
	return $query->row();
}


//fungsi untuk otomatisasi kelas paralel
function fetch_sekolah_by_id($idsekolah){
	$this->db->select("*");
	$this->db->from("sekolah");
	$this->db->where("id_sekolah", $idsekolah);

	$query = $this->db->get();
	return $query->row();
}

function fetch_kelas_by_jenjang($jenjang){
	$this->db->select("*");
	$this->db->from("kelas");
	$this->db->where("jenjang");
	$query = $this->db->get();
	return $query->result();
}

function fetch_kelas_paralel_by_sekolah($idsekolah){
	$this->db->select("*");
	$this->db->from("kelas_paralel");
	$this->db->join("kelas", "kelas_paralel.id_kelas = kelas.id_kelas");
	$this->db->where("id_sekolah", $idsekolah);

	$query = $this->db->get();
	return $query->result();
}
//end fungsi otomatisasi kelas paralel

}
?>