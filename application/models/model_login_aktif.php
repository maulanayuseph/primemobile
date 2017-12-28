<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_login_aktif extends CI_Model{

function __construct()
{
	parent::__construct();
}

function cek_cookie($idsiswa){
	$this->db->select("*");
	$this->db->from("login_aktif");
	$this->db->where("id_siswa", $idsiswa);
	//$this->db->where("timestamp", $timestamp);
	return $this->db->count_all_results();
}

function fetch_login_aktif($idsiswa){
	$this->db->select("*");
	$this->db->from("login_aktif");
	$this->db->where("id_siswa", $idsiswa);
	//$this->db->where("timestamp", $timestamp);
	
	$query = $this->db->get();
	return $query->row();
}

function edit_cookie($idsiswa, $ip, $browser, $timestamp){
	    $data = array(
    		"ip"		=> $ip,
    		"browser"	=> $browser,
    		"timestamp"	=> $timestamp
    	);
    	$this->db->where('id_siswa', $idsiswa);
    	$result = $this->db->update('login_aktif', $data);
}

function set_cookie($idsiswa, $ip, $browser, $timestamp){
	    $data = array(
    		"id_siswa"	=> $idsiswa,
    		"ip"		=> $ip,
    		"browser"	=> $browser,
    		"timestamp"	=> $timestamp
    	);
    	$this->db->insert('login_aktif', $data);
}


}
?>