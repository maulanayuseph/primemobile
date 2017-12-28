<?php 
class Model_manajemen_user extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

function search($where, $keyword){
	$this->db->select("*");
	$this->db->from("siswa");
	$this->db->join("login_siswa", "siswa.id_login = login_siswa.id_login", "left");
	$this->db->join("sekolah", "siswa.sekolah_id = sekolah.id_sekolah", "left");
	$this->db->join("kota_kabupaten", "sekolah.kota_id = kota_kabupaten.id_kota", "left");
	$this->db->join("paket_aktif", "siswa.id_siswa = paket_aktif.id_siswa", "left");
	$this->db->join("voucher", "paket_aktif.kode_voucher = voucher.kode_voucher", "left");
	$this->db->like($where, $keyword);
	$result = $this->db->get();
	return $result->result();
}

function reset_password($idlogin){
	$data = array(
		'password'	=> md5(123456)
	);
	$this->db->where("id_login", $idlogin);
	$this->db->update("login_siswa", $data);
}

function fetch_siswa_by_sekolah($idsekolah){
	$this->db->select("*");
	$this->db->from("siswa");
	$this->db->where("sekolah_id", $idsekolah);

	$result = $this->db->get();
	return $result->result();
}

function custom_reset_password($idlogin, $password){
	$data = array(
		'password'	=> md5($password)
	);
	$this->db->where("id_login", $idlogin);
	$this->db->update("login_siswa", $data);
}
}
?>