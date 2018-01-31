<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_psep_uss extends CI_Model{
function __construct(){
	parent::__construct();
}


function fetch_paket_sbmptn(){
	$this->db->select("*");
	$this->db->from("paket_sbmptn");

	$query = $this->db->get();
	return $query->result();
}

function fetch_kelas_paralel_12($idsekolah){
	$this->db->select("*");
	$this->db->from("kelas_paralel");
	$this->db->join("kelas", "kelas_paralel.id_kelas = kelas.id_kelas", "left");
	$this->db->join("sekolah", "kelas_paralel.id_sekolah = sekolah.id_sekolah", "left");
	$this->db->where("kelas_paralel.id_sekolah", $idsekolah);
	$this->db->where("(kelas_paralel.id_kelas = 19 or kelas_paralel.id_kelas = 20)");

	$query = $this->db->get();
	return $query->result();
}

function fetch_paket_by_id($idpaket){
	$this->db->select("*");
	$this->db->from("paket_sbmptn");
	$this->db->where("id_paket_sbmptn", $idpaket);

	$query = $this->db->get();
	return $query->row();
}

function tambah_jadwal_sbmptn($idpaket, $idkelasparalel, $idtahunajaran, $startdate, $enddate){
	$data = array(
		"id_paket_sbmptn"		=> $idpaket,
		"id_kelas_paralel"		=> $idkelasparalel,
		"id_tahun_ajaran"		=> $idtahunajaran,
		"startdate"				=> $startdate,
		"enddate"				=> $enddate
	);
	$this->db->insert("sbmptn_config", $data);
}

function fetch_jadwal_by_paket($idpaket, $idsekolah){
	$this->db->select("*");
	$this->db->from("sbmptn_config");
	$this->db->join("paket_sbmptn", "sbmptn_config.id_paket_sbmptn = paket_sbmptn.id_paket_sbmptn", "left");
	$this->db->join("kelas_paralel", "sbmptn_config.id_kelas_paralel = kelas_paralel.id_kelas_paralel", "left");
	$this->db->join("tahun_ajaran", "sbmptn_config.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran");
	$this->db->where("sbmptn_config.id_paket_sbmptn", $idpaket);
	$this->db->where('kelas_paralel.id_sekolah', $idsekolah);

	$query = $this->db->get();
	return $query->result();
}

function hapus_jadwal($idconfig){
	$this->db->where("id_sbmptn_config", $idconfig);
	$this->db->delete("sbmptn_config");
}

function fetch_uss_berlangsung($idkelasparalel, $idtahunajaran){
	$today = date("Y-m-d H:i:s");
	$jam   = date("H:i:s");
	$this->db->select("*");
	$this->db->from("sbmptn_config");
	$this->db->join("paket_sbmptn", "sbmptn_config.id_paket_sbmptn = paket_sbmptn.id_paket_sbmptn", "left");
	$this->db->where("sbmptn_config.id_kelas_paralel", $idkelasparalel);
	$this->db->where("sbmptn_config.id_tahun_ajaran", $idtahunajaran);
	$this->db->where("sbmptn_config.startdate <=", $today);
	$this->db->where("sbmptn_config.enddate >=", $today);
	$this->db->order_by("startdate", "ASC");

	$query = $this->db->get();
	return $query->result();
}

}
?>