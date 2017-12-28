<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_psep_materi extends CI_Model
{

	private $insert_id;

	function __construct()
	{
		parent::__construct();
	}

function fetch_mapel_by_kelas($idkelas){
	$this->db->select("*");
	$this->db->from("mata_pelajaran");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("kelas.id_kelas", $idkelas);

	$query = $this->db->get();
	return $query->result();
}

function fetch_konten_by_sub($idsub){
	$this->db->select("*");
	$this->db->from("konten_materi");
	$this->db->join("sub_materi", "konten_materi.sub_materi_id = sub_materi.id_sub_materi", "left");
	$this->db->where("id_sub_materi", $idsub);

	$query = $this->db->get();
	return $query->row();
}

function fetch_soal_by_sub_materi($idsub){
	$this->db->select("*");
	$this->db->from("soal");
	$this->db->join("jawaban", "soal.id_soal = jawaban.soal_id", "left");
	$this->db->join("sub_materi", "soal.sub_materi_id = sub_materi.id_sub_materi", "left");
	$this->db->where("sub_materi.id_sub_materi", $idsub);

	$query = $this->db->get();
	return $query->result();
}

}
?>