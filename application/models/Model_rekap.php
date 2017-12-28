<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_rekap extends CI_Model
{


	function __construct()
	{
		parent::__construct();
	}

function get_jumlah_soal_by_tipe_and_kelas($tipe, $idkelas){
	$this->db->select("*");
	$this->db->from("jawaban");
	$this->db->join("soal", "jawaban.soal_id = soal.id_soal");
	$this->db->join("sub_materi", "soal.sub_materi_id = sub_materi.id_sub_materi");
	$this->db->join("materi_pokok", "sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel");
	$this->db->where("mata_pelajaran.kelas_id", $idkelas);
	$this->db->where("sub_materi.tipe_latihan", $tipe);
	
	$result = $this->db->count_all_results();
	return $result;
}

function fetch_sub_materi_by_mapel_and_kurikulum($idmapel, $kurikulum){
	$this->db->select("*");
	$this->db->from("konten_materi");
	$this->db->join("sub_materi", "konten_materi.sub_materi_id=sub_materi.id_sub_materi", "left");
	$this->db->join("materi_pokok", "sub_materi.materi_pokok_id=materi_pokok.id_materi_pokok");
	$this->db->where("materi_pokok.mapel_id", $idmapel)->where("(sub_materi.kurikulum = '".$kurikulum."' or sub_materi.kurikulum = 'KTSP, K-13')");
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_all_sub_by_mapel($idmapel){
	$this->db->select("*");
	$this->db->from("konten_materi");
	$this->db->join("sub_materi", "konten_materi.sub_materi_id=sub_materi.id_sub_materi", "left");
	$this->db->join("materi_pokok", "sub_materi.materi_pokok_id=materi_pokok.id_materi_pokok");
	$this->db->where("materi_pokok.mapel_id", $idmapel);
	
	$query = $this->db->get();
	return $query->result();
}
}
?>