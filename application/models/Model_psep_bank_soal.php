<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_psep_bank_soal extends CI_Model
{
	private $insert_id;
	function __construct()
	{
		parent::__construct();
	}

function fetch_mapel(){
	$this->db->select("*");
	$this->db->from("mapel");

	$query = $this->db->get();
	return $query->result();
}

function insert_atribut($kategori){
	$data = array(
		'atribut'	=> $kategori,
		'kategori'	=> 'sekolah'
	);
	$this->db->insert("atribut", $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function insert_atribut_sekolah($idsekolah, $idatribut){
	$data = array(
		'id_sekolah'	=> $idsekolah,
		'id_login'		=> $this->session->userdata('idpsepsekolah'),
		'id_atribut'	=> $idatribut
	);
	$this->db->insert("atribut_x_sekolah", $data);
	return true;
}

function fetch_kategori($idsekolah){
	$this->db->select("*");
	$this->db->from("atribut_x_sekolah");
	$this->db->join("atribut", "atribut_x_sekolah.id_atribut = atribut.id_atribut");
	$this->db->where("id_sekolah", $idsekolah);

	$query = $this->db->get();
	return $query->result();
}

function fetch_kategori_by_id($idatribut){
	$this->db->select("*");
	$this->db->from("atribut_x_sekolah");
	$this->db->join("atribut", "atribut_x_sekolah.id_atribut = atribut.id_atribut", 'left');
	$this->db->where("atribut.id_atribut", $idatribut);

	$query = $this->db->get();
	return $query->row();
}

function edit_atribut($idatribut, $atribut){
	$data = array(
		'atribut'	=> $atribut
	);
	$this->db->where("id_atribut", $idatribut);
	$this->db->update("atribut", $data);
	return true;
}

function hapus_atribut($idatribut){
	$this->db->where('id_atribut', $idatribut);
	$this->db->delete("atribut");
	return true;
}

function hapus_atribut_sekolah($idatribut){
	$this->db->where('id_atribut', $idatribut);
	$this->db->delete("atribut_x_sekolah");
	return true;
}

function fetch_topik(){
	$this->db->select("topik");
	$this->db->from("bank_soal");
	$this->db->group_by("topik");
	$query = $this->db->get();
	return $query->result();
}

function insert_soal($soal, $topik, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $pembahasan, $bobot, $kunci){
	$data = array(
		'kategori'			=> 'sekolah',
		'pertanyaan'		=> $soal,
		'topik'				=> $topik,
		'jawab_1'			=> $jawab1,
		'jawab_2'			=> $jawab2,
		'jawab_3'			=> $jawab3,
		'jawab_4'			=> $jawab4,
		'jawab_5'			=> $jawab5,
		'pembahasan_teks'	=> $pembahasan,
		'bobot_soal'		=> $bobot,
		'kunci'				=> $kunci
	);
	$this->db->insert("bank_soal", $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function insert_soal_atribut($idsoal, $idatribut){
	$data = array(
		'id_soal'		=> $idsoal,
		'id_atribut'	=> $idatribut
	);
	$this->db->insert("atribut_soal", $data);
	return true;
}

function insert_soal_kelas($idsoal, $idkelas){
	$data = array(
		'id_soal'	=> $idsoal,
		'id_kelas'	=> $idkelas
	);
	$this->db->insert('soal_x_kelas', $data);
	return true;
}

function insert_soal_mapel($idsoal, $idmapel){
	$data = array(
		'id_soal'	=> $idsoal,
		'id_mapel'	=> $idmapel
	);
	$this->db->insert("soal_x_mapel", $data);
	return true;
}

function insert_soal_sekolah($idsoal){
	$data = array(
		'id_sekolah'	=> $this->session->userdata('idsekolah'),
		'id_login'		=> $this->session->userdata('idpsepsekolah'),
		'id_soal'		=> $idsoal
	);
	$this->db->insert('soal_x_sekolah', $data);
	return true;
}

function filter_bank_soal($idkelas, $idmapel, $idatribut){
	$this->db->select("*");
	$this->db->from('bank_soal');
	$this->db->join("atribut_soal", "bank_soal.id_banksoal = atribut_soal.id_soal", "left");
	$this->db->join('soal_x_kelas', "bank_soal.id_banksoal = soal_x_kelas.id_soal", "left");
	$this->db->join("soal_x_mapel", "bank_soal.id_banksoal = soal_x_mapel.id_soal", "left");
	$this->db->join("soal_x_sekolah", "bank_soal.id_banksoal = soal_x_sekolah.id_soal", "left");
	$this->db->where("soal_x_kelas.id_kelas", $idkelas);
	$this->db->where("soal_x_mapel.id_mapel", $idmapel);
	$this->db->where("atribut_soal.id_atribut", $idatribut);
	$this->db->where("soal_x_sekolah.id_sekolah", $this->session->userdata('idsekolah'));
	$this->db->where("bank_soal.deleted", 0);
	$query = $this->db->get();
	return $query->result();
}

function fetch_soal_by_id($idsoal){
	$this->db->select("*");
	$this->db->from('bank_soal');
	$this->db->join("atribut_soal", "bank_soal.id_banksoal = atribut_soal.id_soal", "left");
	$this->db->join('soal_x_kelas', "bank_soal.id_banksoal = soal_x_kelas.id_soal", "left");
	$this->db->join("soal_x_mapel", "bank_soal.id_banksoal = soal_x_mapel.id_soal", "left");
	$this->db->join("soal_x_sekolah", "bank_soal.id_banksoal = soal_x_sekolah.id_soal", "left");
	$this->db->where("bank_soal.id_banksoal", $idsoal);
	$query = $this->db->get();
	return $query->row();
}


function edit_soal($soal, $topik, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $pembahasan, $bobot, $kunci, $idsoal){
	$data = array(
		'kategori'			=> 'sekolah',
		'pertanyaan'		=> $soal,
		'topik'				=> $topik,
		'jawab_1'			=> $jawab1,
		'jawab_2'			=> $jawab2,
		'jawab_3'			=> $jawab3,
		'jawab_4'			=> $jawab4,
		'jawab_5'			=> $jawab5,
		'pembahasan_teks'	=> $pembahasan,
		'bobot_soal'		=> $bobot,
		'kunci'				=> $kunci
	);
	$this->db->where("id_banksoal", $idsoal);
	$this->db->update("bank_soal", $data);
	return true;
}

function edit_soal_atribut($idsoal, $idatribut){
	$data = array(
		'id_atribut'	=> $idatribut
	);
	$this->db->where("id_soal", $idsoal);
	$this->db->update("atribut_soal", $data);
	return true;
}

function edit_soal_kelas($idsoal, $idkelas){
	$data = array(
		'id_kelas'	=> $idkelas
	);
	$this->db->where("id_soal", $idsoal);
	$this->db->update("soal_x_kelas", $data);
	return true;
}

function edit_soal_mapel($idsoal, $idmapel){
	$data = array(
		'id_mapel'	=> $idmapel
	);
	$this->db->where("id_soal", $idsoal);
	$this->db->update("soal_x_mapel", $data);
	return true;
}

function delete_soal($idsoal){
	$data = array(
		'deleted'	=> 1
	);
	$this->db->where('id_banksoal', $idsoal);
	$this->db->update("bank_soal", $data);
	return true;
}


//MODEL UNTUK EDIT SOAL PR
//#################################################
//#################################################
//#################################################
function fetch_soal_pr_by_id($idsoal){
	$this->db->select("*");
	$this->db->from("taksonomi_soal_pr");
	$this->db->where("id_soal", $idsoal);

	$query = $this->db->get();
	return $query->result();
}

function edit_soal_pr($idsoalpr, $pertanyaan, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $pembahasanteks, $kunci ){
	$data = array(
		'pertanyaan'		=> $pertanyaan,
		'jawab_1'			=> $jawab1,
		'jawab_2'			=> $jawab2,
		'jawab_3'			=> $jawab3,
		'jawab_4'			=> $jawab4,
		'jawab_5'			=> $jawab5,
		'pembahasan_teks'	=> $pembahasanteks,
		'kunci'				=> $kunci
	);
	$this->db->where("id_soal_pr", $idsoalpr);
	$this->db->update("soal_pr", $data);
}
//END MODEL UNTUK EDIT SOAL PR
//#################################################
//#################################################
//#################################################
}
?>