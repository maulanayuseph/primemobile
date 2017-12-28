<?php 

class Model_raport extends CI_Model{
	function __construct(){

		parent::__construct();
	}


function fetch_all_profil_by_sekolah($idsekolah){
	$this->db->select("*");
	$this->db->from("profil_raport");
	$this->db->join("login_sekolah", "profil_raport.id_guru = login_sekolah.id_login_sekolah", "left");
	$this->db->join("kelas", "profil_raport.id_kelas = kelas.id_kelas", "left");
	$this->db->join("tahun_ajaran", "profil_raport.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran", "left");
	$this->db->where("login_sekolah.id_sekolah", $this->session->userdata('idsekolah'));
	$this->db->order_by("tahun_ajaran.tahun_ajaran", "DESC");
	$this->db->order_by("kelas.id_kelas", "ASC");
	$this->db->order_by("semester", "DESC");

	$query = $this->db->get();
	return $query->result();
}
function tambah_profil($kelas, $tahun, $semester){
	$data = array(
		'id_kelas'			=> $kelas,
		"id_tahun_ajaran"	=> $tahun,
		"semester"			=> $semester,
		"id_guru"			=> $this->session->userdata("idpsepsekolah")
	);

	$this->db->insert("profil_raport", $data);
}

function cek_raport($kelas, $tahun, $semester){
	$this->db->select("*");
	$this->db->from("profil_raport");
	$this->db->join("login_sekolah", "profil_raport.id_guru = login_sekolah.id_login_sekolah", "left");
	$this->db->where("id_kelas", $kelas);
	$this->db->where("id_tahun_ajaran", $tahun);
	$this->db->where("semester", $semester);
	$this->db->where("id_sekolah", $this->session->userdata('idsekolah'));

	return $this->db->count_all_results();
}

function cek_kebenaran($idprofil){
	$this->db->select("*");
	$this->db->from("profil_raport");
	$this->db->join("login_sekolah", "profil_raport.id_guru = login_sekolah.id_login_sekolah", "left");
	$this->db->where("id_profil_raport", $idprofil);
	$this->db->where("id_sekolah", $this->session->userdata('idsekolah'));

	return $this->db->count_all_results();
}

function fetch_profil_by_id($idprofil){
	$this->db->select("*");
	$this->db->from("profil_raport");
	$this->db->join("login_sekolah", "profil_raport.id_guru = login_sekolah.id_login_sekolah", "left");
	$this->db->join("kelas", "profil_raport.id_kelas = kelas.id_kelas", "left");
	$this->db->join("tahun_ajaran", "profil_raport.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran", "left");
	$this->db->where("profil_raport.id_profil_raport", $idprofil);

	$query = $this->db->get();
	return $query->row();
}



}
?>