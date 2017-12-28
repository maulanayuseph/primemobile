<?php 

/**
* 
*/
class Model_wilayah extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

function fetch_all_wilayah(){
	$this->db->select("*");
	$this->db->from("wilayah");

	$result = $this->db->get();
	return $result->result();
}

function insert_wilayah($namawilayah){
	$data = array(
		"nama_wilayah"	=> $namawilayah
	);
	$this->db->insert("wilayah", $data);
}

function fetch_wilayah_by_id($idwilayah){
	$this->db->select("*");
	$this->db->from("wilayah");
	$this->db->where("id_wilayah", $idwilayah);

	$result = $this->db->get();
	return $result->row();
}

function edit_wilayah($idwilayah, $namawilayah){
	$data = array(
		'nama_wilayah'	=> $namawilayah
	);
	$this->db->where("id_wilayah", $idwilayah);
	$this->db->update("wilayah", $data);
}

function hapus_wilayah($idwilayah){
	$this->db->where("id_wilayah", $idwilayah);
	$this->db->delete("wilayah");
}

function hapus_wilayah_x_kota_by_wilayah($idwilayah){
	$this->db->where("id_wilayah", $idwilayah);
	$this->db->delete("wilayah_x_kota");
}

function fetch_kota_by_wilayah($idwilayah){
	$this->db->select("*");
	$this->db->from("wilayah_x_kota");
	$this->db->join("kota_kabupaten", "wilayah_x_kota.id_kota = kota_kabupaten.id_kota", "left");
	$this->db->where("id_wilayah", $idwilayah);

	$result = $this->db->get();
	return $result->result();
}

function count_kota_by_wilayah($idkota){
	$this->db->select("*");
	$this->db->from("wilayah_x_kota");
	$this->db->where("id_kota", $idkota);

	return $this->db->count_all_results();
}

function fetch_kota_and_wilayah($idkota){
	$this->db->select("*");
	$this->db->from("wilayah_x_kota");
	$this->db->join("kota_kabupaten", "wilayah_x_kota.id_kota = kota_kabupaten.id_kota", "left");
	$this->db->join("wilayah", "wilayah_x_kota.id_wilayah = wilayah.id_wilayah", "left");
	$this->db->where("kota_kabupaten.id_kota", $idkota);

	$result = $this->db->get();
	return $result->row();
}

function hapus_kota($idkota){
	$this->db->where("id_kota", $idkota);
	$this->db->delete("wilayah_x_kota");
}

function insert_kota_by_wilayah($idkota, $idwilayah){
	$data = array(
		"id_kota"		=> $idkota,
		"id_wilayah"	=> $idwilayah
	);
	$this->db->insert("wilayah_x_kota", $data);
}

}
?>