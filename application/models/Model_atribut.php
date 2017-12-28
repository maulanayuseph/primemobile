<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_atribut extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

function fetch_jumlah_atribut(){
	$this->db->select("*");
	$this->db->from("atribut");
	
	$result = $this->db->count_all_results();
	return $result;
}

function fetch_all_atribut(){
	$this->db->select("*");
	$this->db->from("atribut");
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_parent(){
	$this->db->select("*");
	$this->db->from("atribut");
	$this->db->where("parent", 0);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_child($idparent){
	$this->db->select("*");
	$this->db->from("atribut");
	$this->db->where("parent", $idparent);
	
	$query = $this->db->get();
	return $query->result();
}

function tambah_atribut($atribut, $parent){
	$data = array(
		'atribut'			=> $atribut,
		'parent'			=> $parent
	);
	$this->db->insert("atribut", $data);
}

function cek_atribut($atribut){
	$this->db->select("*");
	$this->db->from("atribut");
	$this->db->where("atribut", $atribut);
	
	$result = $this->db->count_all_results();
	return $result;
}

function hapus_atribut($idatribut){
	$this->db->delete('atribut', array('id_atribut' => $idatribut));
	//tambahkan fungsi untuk menghapus atribut dari taksonomi soal
	$this->db->delete('atribut_soal', array('id_atribut' => $idatribut));
}

function fetch_atribut_by_id($idatribut){
	$this->db->select("*");
	$this->db->from("atribut");
	$this->db->where("id_atribut", $idatribut);
	
	$query = $this->db->get();
	return $query->row();
}

function edit_atribut($idatribut, $atribut, $parent){
	if($parent > 0){
		$this->db->set('parent', 0);
		
		$this->db->where('parent', $idatribut);
		$this->db->update('atribut');
	}
	$this->db->set('atribut', $atribut);
	$this->db->set('parent', $parent);
	
	$this->db->where('id_atribut', $idatribut);
	$query = $this->db->update('atribut');
	return $query;
}

function insert_atribut_soal($idsoal, $idatribut){
	$data = array(
		'id_soal'			=> $idsoal,
		'id_atribut'		=> $idatribut
	);
	$this->db->insert("atribut_soal", $data);
}
function cek_atribut_soal($idsoal, $idatribut){
	$this->db->select("*");
	$this->db->from("atribut_soal");
	$this->db->where("id_soal", $idsoal);
	$this->db->where("id_atribut", $idatribut);
	
	$result = $this->db->count_all_results();
	return $result;
}
function hapus_atribut_soal($idsoal){
	$this->db->delete('atribut_soal', array('id_soal' => $idsoal));
}

function hitung_soal_by_atribut($idatribut){
	$this->db->select("*");
	$this->db->from("atribut_soal");
	$this->db->where("id_atribut", $idatribut);
	$result = $this->db->count_all_results();
	return $result;
}
}
?>