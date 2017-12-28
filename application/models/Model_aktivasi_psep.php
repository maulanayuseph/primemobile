<?php 

class Model_aktivasi_psep extends CI_Model{
	function __construct(){

		parent::__construct();
	}


function fetch_sekolah_by_id($idsekolah){
	$this->db->select("*");
	$this->db->from("sekolah");
	$this->db->where("id_sekolah", $idsekolah);

	$query = $this->db->get();
	return $query->row();
}

function fetch_paket_by_id($idpaket){
	$this->db->select("*");
	$this->db->from("paket");
	$this->db->where("id_paket", $idpaket);

	$query = $this->db->get();
	return $query->row();
}

}
?>