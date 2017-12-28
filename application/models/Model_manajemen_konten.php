<?php 

class Model_manajemen_konten extends CI_Model{
	function __construct(){

		parent::__construct();
	}

function fetch_konten_by_sub_bab($idsubbab){
	$this->db->select("*");
	$this->db->from("taksonomi_konten");
	$this->db->join("sub_materi", "taksonomi_konten.id_judul = sub_materi.id_sub_materi", "left");
	$this->db->join("sub_bab", "taksonomi_konten.id_sub = sub_bab.id_sub_bab", "left");
	$this->db->join("materi_pokok", "sub_bab.id_bab = materi_pokok.id_materi_pokok", "left");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel", "left");
	$this->db->join("kurikulum", "mata_pelajaran.id_kurikulum = kurikulum.id_kurikulum", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("tipe_konten", "mapel");
	$this->db->where("taksonomi_konten.id_sub", $idsubbab);

	$query = $this->db->get();
	return $query->result();
}

}
?>