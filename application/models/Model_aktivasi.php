<?php 

class Model_aktivasi extends CI_Model{
	function __construct(){

		parent::__construct();
	}

function fetch_aktivasi_siswa($idsiswa){
	$today = date("Y-m-d");
	$this->db->select("*");
	$this->db->from("paket_aktif");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("expired_on >=", $today);
	$this->db->where("isaktif", 1);

	$query = $this->db->get();
	return $query->row();
}



}
?>