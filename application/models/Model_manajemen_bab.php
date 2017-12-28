<?php 

class Model_manajemen_bab extends CI_Model{
	function __construct(){

		parent::__construct();
	}

function filter_bab_by_mapel($idmapel){
	$this->db->select("*");
	$this->db->from("materi_pokok");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel", "left");
	$this->db->join("kurikulum", "mata_pelajaran.id_kurikulum = kurikulum.id_kurikulum", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("materi_pokok.mapel_id", $idmapel);
	$query = $this->db->get();
	return $query->result();
}

function tambah_bab($idmapel, $bab){
	$data = array(
		'mapel_id'			=> $idmapel,
		'nama_materi_pokok'	=> $bab
	);
	$this->db->insert("materi_pokok", $data);
}

function fetch_bab_by_id($idbab){
	$this->db->select("*");
	$this->db->from("materi_pokok");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel", "left");
	$this->db->join("kurikulum", "mata_pelajaran.id_kurikulum = kurikulum.id_kurikulum", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("materi_pokok.id_materi_pokok", $idbab);
	
	$query = $this->db->get();
	return $query->row();
}

function edit_bab($idbab, $idmapel, $bab){
	$data = array(
		'mapel_id'			=> $idmapel,
		'nama_materi_pokok'	=> $bab
	);
	$this->db->where("id_materi_pokok", $idbab);
	$this->db->update("materi_pokok", $data);
}


function hapus_bab($idbab){
	$this->db->where("id_materi_pokok", $idbab);
	$this->db->delete("materi_pokok");
}

function tambah_sub_bab($idbab, $subbab){
	$data = array(
		"id_bab"		=> $idbab,
		"nama_sub_bab"	=> $subbab
	);
	$this->db->insert("sub_bab", $data);
}

function fetch_sub_bab_by_bab($idbab){
	$this->db->select("*");
	$this->db->from("sub_bab");
	$this->db->join("materi_pokok", "sub_bab.id_bab = materi_pokok.id_materi_pokok", "left");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel", "left");
	$this->db->join("kurikulum", "mata_pelajaran.id_kurikulum = kurikulum.id_kurikulum", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("sub_bab.id_bab", $idbab);

	$query = $this->db->get();
	return $query->result();
}

function fetch_sub_bab_by_id($idsub){
	$this->db->select("*");
	$this->db->from("sub_bab");
	$this->db->join("materi_pokok", "sub_bab.id_bab = materi_pokok.id_materi_pokok", "left");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel", "left");
	$this->db->join("kurikulum", "mata_pelajaran.id_kurikulum = kurikulum.id_kurikulum", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("id_sub_bab", $idsub);

	$query = $this->db->get();
	return $query->row();
}

function edit_sub_bab($idsubbab, $namasubbab){
	$data = array(
		'nama_sub_bab'	=> $namasubbab
	);
	$this->db->where("id_sub_bab", $idsubbab);
	$this->db->update("sub_bab", $data);
}

function hapus_sub_bab($idsubbab){
	$this->db->where("id_sub_bab", $idsubbab);
	$this->db->delete("sub_bab");
}

}
?>