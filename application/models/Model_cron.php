<?php 

class Model_cron extends CI_Model{
	function __construct(){

		parent::__construct();
	}

function test_cron(){
	$data = array(
		'task'	=> "hehe"
	);
	$this->db->insert("test_cron", $data);
}

function fetch_login_aktif(){
	$this->db->select("*");
	$this->db->from("login_aktif");
	$this->db->where("timestamp !=", 0);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_login_aktif_siswa(){
	$this->db->select("*, login_aktif.timestamp as last_time");
	$this->db->from("login_aktif");
	$this->db->join("siswa", "login_aktif.id_siswa = siswa.id_siswa");
	$this->db->join("login_siswa", "siswa.id_login = login_siswa.id_login");
	$this->db->where("login_aktif.timestamp !=", 0);
	
	$query = $this->db->get();
	return $query->result();
}

function delete_login_aktif($idsiswa){
	$data = array(
		"timestamp"	=> 0
	);
	$this->db->where('id_siswa', $idsiswa);
	$result = $this->db->update('login_aktif', $data);
}

function fetch_paket_aktif(){
	$this->db->select("*");
	$this->db->from("paket_aktif");
	$this->db->where("isaktif", 1);

	$query = $this->db->get();
	return $query->result();
}

function update_expired_paket_aktif($idpaketaktif){
	$data = array(
		'isaktif'	=> 0
	);
	$this->db->where("id_paket_aktif", $idpaketaktif);
	$this->db->update("paket_aktif", $data);
}

}
?>