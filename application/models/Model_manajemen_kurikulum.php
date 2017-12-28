<?php 

class Model_manajemen_kurikulum extends CI_Model{
	function __construct(){

		parent::__construct();
	}

function fetch_all_kurikulum(){
	$this->db->select("*");
	$this->db->from("kurikulum");

	$query = $this->db->get();
	return $query->result();
}

function fetch_kurikulum_by_id($idkurikulum){
	$this->db->select("*");
	$this->db->from("kurikulum");
	$this->db->where("id_kurikulum", $idkurikulum);

	$query = $this->db->get();
	return $query->row();
}

function tambah_kurikulum($kurikulum){
	$data = array(
		"nama_kurikulum"	=> $kurikulum
	);
	$this->db->insert("kurikulum", $data);
}

function edit_kurikulum($idkurikulum, $kurikulum){
	$data = array(
		'nama_kurikulum'	=> $kurikulum
	);
	$this->db->where('id_kurikulum', $idkurikulum);
	$this->db->update("kurikulum", $data);
}

function hapus_kurikulum($idkurikulum){
	$this->db->where("id_kurikulum", $idkurikulum);
	$this->db->delete("kurikulum");
}


}
?>