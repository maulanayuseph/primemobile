<?php 

class Model_user_dashboard extends CI_Model{
	function __construct(){

		parent::__construct();
	}
	
function get_info_siswa($idsiswa){
	$this->db->select("siswa.*, sekolah.*, kelas.*, siswa.telepon as telepon_siswa, siswa.email as email_siswa");
	$this->db->from("siswa");
	$this->db->join("kelas", "siswa.kelas=kelas.id_kelas", "left");
	$this->db->join("sekolah", "siswa.sekolah_id=sekolah.id_sekolah", "left");
	$this->db->where("siswa.id_siswa", $idsiswa);

	$query = $this->db->get();
	return $query->row();
}
}