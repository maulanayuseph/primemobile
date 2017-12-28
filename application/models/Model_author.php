<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_author extends CI_Model
{
function __construct()
{
	parent::__construct();
}


function get_role_by_id_adm($idadm){
	$this->db->select("*");
	$this->db->from("author_role");
	$this->db->where("id_login_adm", $idadm);
	
	$result=$this->db->get();
	return $result->result();
}

function fetch_sub_by_bab_and_kurikulum($idbab, $kurikulum){
	$this->db->select("*");
	$this->db->from("sub_materi");
	$this->db->join("konten_materi", "sub_materi.id_sub_materi = konten_materi.sub_materi_id", "left");
	$this->db->where("sub_materi.materi_pokok_id", $idbab)->where("(sub_materi.kurikulum = '" . $kurikulum . "' or sub_materi.kurikulum = 'KTSP, K-13')");
	$this->db->order_by("urutan_materi", "ASC");
	
	$result=$this->db->get();
	return $result->result();
}

function get_jumlah_soal_by_sub_and_author($idsub, $idadm){
	$this->db->select("*");
	$this->db->from("soal");
	$this->db->where("sub_materi_id", $idsub);
	$this->db->where("id_adm", $idadm);
	
	$result = $this->db->count_all_results();
	return $result;
}

function fetch_soal_by_sub_and_author($idsub, $idadm){
	$this->db->select("*");
	$this->db->from("soal");
	$this->db->where("sub_materi_id", $idsub);
	$this->db->where("id_adm", $idadm);
	
	$result=$this->db->get();
	return $result->result();
}

function fetch_rekap_author($startdate, $enddate){
	$this->db->select('count(soal.id_adm) as jumlah_soal, login_adm.username');
	$this->db->from("soal");
	$this->db->join("login_adm", "soal.id_adm = login_adm.id_adm", "left");
	$this->db->where("soal.id_adm !=", 0);
	$this->db->where("soal.timestamp >=", $startdate);
	$this->db->where("soal.timestamp <=", $enddate);
	
	$result=$this->db->get();
	return $result->result();
}

}


?>