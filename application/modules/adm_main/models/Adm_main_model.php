<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Adm_main_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

function fetch_login_adm_by_username($username){
	$this->db->select("*");
	$this->db->from("login_adm");
	$this->db->where("username", $username);

	$query = $this->db->get();
	return $query->row();
}

function fetch_login_adm_by_username_and_password($username, $password){
	$this->db->select("*");
	$this->db->from("login_adm");
	$this->db->where("username", $username);
	$this->db->where("password", $password);

	$query = $this->db->get();
	return $query->row();
}

function adm_login_security(){
	if($this->session->userdata('idlogin') == null){
		redirect('pm_admin');
	}
}

function security_level_superadmin(){
	if($this->session->userdata('admlevel') !== "superadmin"){
		redirect('pm_admin');
	}
}

function fetch_admin_by_id($idadm){
	$this->db->select("*");
	$this->db->from("login_adm");
	$this->db->where('id_adm', $idadm);
	$query = $this->db->get();
	return $query->row();
}

function fetch_kelas(){
	$this->db->select("*");
	$this->db->from("kelas");

	$query = $this->db->get();
	return $query->result();
}

function fetch_mapel_by_kelas(){
	$this->db->select("*");
	$this->db->from("mata_pelajaran");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas");

	$query = $this->db->get();
	return $query->result();
}

function fetch_materi_pokok_by_mapel($idmapel){
	$this->db->select("*");
	$this->db->from("materi_pokok");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel");;

	$query = $this->db->get();
	return $query->result();
}

}
?>