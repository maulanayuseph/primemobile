<?php 

class Model_pa extends CI_Model{
	function __construct(){

		parent::__construct();
	}



function fetch_paket_psep(){
	$this->db->select("*");
	$this->db->from("paket");
	$this->db->where("kode_paket", "PSEP");

	$query = $this->db->get();
	return $query->result();
}

}
?>