<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_qc_user extends CI_Model
{

	private $insert_id;

	function __construct()
	{
		parent::__construct();
	}


function fetch_level_qc(){
	$this->db->select("*");
	$this->db->from("login_adm");
	$this->db->where("level", "qc");

	$query = $this->db->get();
	return $query->result();
}

function fetch_admin_by_username($username){
	$this->db->select("*");
	$this->db->from("login_adm");
	$this->db->where("username", $username);

	return $this->db->count_all_results();
}

function fetch_admin_by_id($idadmin){
	$this->db->select("*");
	$this->db->from("login_adm");
	$this->db->where("id_adm", $idadmin);

	$query = $this->db->get();
	return $query->row();
}

function tambah_user($nama, $username, $password){
	$data = array(
		'nama'		=> $nama,
		'username'	=> $username,
		'password'	=> md5($password),
		'level'		=> "qc"
	);
	$tambah = $this->db->insert("login_adm", $data);
	if($tambah){
		return true;
	}else{
		return false;
	}
}

function edit_admin($idadmin, $nama, $username){
	$data = array(
		'nama'		=> $nama,
		'username'	=> $username
	);
	$this->db->where('id_adm', $idadmin);
	$edit = $this->db->update("login_adm", $data);
	if($edit){
		return true;
	}else{
		return false;
	}
}

function edit_password($idadmin, $password){
	$data = array(
		'password'	=> md5($password)
	);
	$this->db->where('id_adm', $idadmin);
	$edit = $this->db->update("login_adm", $data);
	if($edit){
		return true;
	}else{
		return false;
	}
}

function cek_admin_x_mapel($idadmin, $idmapel){
	$this->db->select("*");
	$this->db->from("admin_x_mapel");
	$this->db->where("id_admin", $idadmin);
	$this->db->where("id_mapel", $idmapel);

	return $this->db->count_all_results();
}

function assign_mapel($idadmin, $idmapel){
	$data = array(
		'id_admin'	=> $idadmin,
		'id_mapel'	=> $idmapel
	);
	$insert = $this->db->insert("admin_x_mapel", $data);
	if($insert){
		return true;
	}else{
		return false;
	}
}

function fetch_admin_x_mapel_by_admin($idadmin){
	$this->db->select("*");
	$this->db->from("admin_x_mapel");
	$this->db->join("mata_pelajaran", "admin_x_mapel.id_mapel = mata_pelajaran.id_mapel", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("admin_x_mapel.id_admin", $idadmin);

	$query = $this->db->get();
	return $query->result();
}

function hapus_assign_mapel($idadmin, $idmapel){
	$this->db->where('id_admin', $idadmin);
	$this->db->where('id_mapel', $idmapel);
	$hapus = $this->db->delete("admin_x_mapel");
	if($hapus){
		return true;
	}else{
		return false;
	}
}

function count_antrian_approval($idadmin){
	$this->db->select("*");
	$this->db->from("jawaban");
	$this->db->join("soal", "jawaban.soal_id = soal.id_soal");
	$this->db->join("sub_materi", "soal.sub_materi_id = sub_materi.id_sub_materi");
	$this->db->join("materi_pokok", "sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok");
	$this->db->join("admin_x_mapel", "materi_pokok.mapel_id = admin_x_mapel.id_mapel");
	$this->db->where("id_admin", $idadmin);
	$this->db->where("soal.status", 0);

	return $this->db->count_all_results();
}

function fetch_mapel_antrian_by_admin_and_kelas($idadmin, $idkelas){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('admin_x_mapel', 'materi_pokok.mapel_id = admin_x_mapel.id_mapel', 'left');
	$this->db->join('mata_pelajaran', 'admin_x_mapel.id_mapel = mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
	$this->db->where("admin_x_mapel.id_admin", $idadmin);
	$this->db->where('soal.status', 0);
	$this->db->where('mata_pelajaran.kelas_id', $idkelas);
	$this->db->group_by('mata_pelajaran.id_mapel');
	//tester
	//echo $this->db->_compile_select();exit;
	$query = $this->db->get();
	return $query->result();
}

function fetch_kelas_qc($idadmin){
	$this->db->select("*");
	$this->db->from("admin_x_mapel");
	$this->db->join("mata_pelajaran", "admin_x_mapel.id_mapel = mata_pelajaran.id_mapel");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("admin_x_mapel.id_admin", $idadmin);
	$this->db->group_by("kelas.id_kelas");

	$query = $this->db->get();
	return $query->result();
}


function fetch_mapel_qc_by_kelas($idadmin, $idkelas){
	$this->db->select("*");
	$this->db->from("admin_x_mapel");
	$this->db->join("mata_pelajaran", "admin_x_mapel.id_mapel = mata_pelajaran.id_mapel", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("admin_x_mapel.id_admin", $idadmin);
	$this->db->where("kelas.id_kelas", $idkelas);

	$query = $this->db->get();
	return $query->result();
}
}
?>