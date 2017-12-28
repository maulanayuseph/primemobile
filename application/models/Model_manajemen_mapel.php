<?php 

class Model_manajemen_mapel extends CI_Model{
	function __construct(){

		parent::__construct();
	}

function fetch_all_mapel(){
	$this->db->select("*");
	$this->db->from("mata_pelajaran");
	$this->db->join("kelas", "mapel.kelas_id = kelas.id_kelas", "left");
	$this->db->join("kurikulum", "mapel.id_kurikulum = kurikulum.id_kurikulum", "left");

	$query = $this->db->get();
	return $query->result();
}


function fetch_mapel_by_filter($idkelas = null, $idkurikulum = null){
	$this->db->select("*");
	$this->db->from("mata_pelajaran");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->join("kurikulum", "mata_pelajaran.id_kurikulum = kurikulum.id_kurikulum", "left");

	if($idkelas !== null){
		$this->db->where("mata_pelajaran.kelas_id", $idkelas);
	}

	if($idkurikulum !== null){
		$this->db->where("mata_pelajaran.id_kurikulum", $idkurikulum);
	}

	$query = $this->db->get();
	return $query->result();
}

function fetch_mapel_by_id($idmapel){
	$this->db->select("*");
	$this->db->from("mata_pelajaran");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->join("kurikulum", "mata_pelajaran.id_kurikulum = kurikulum.id_kurikulum", "left");
	$this->db->where("mata_pelajaran.id_mapel", $idmapel);

	$query = $this->db->get();
	return $query->row();
}

function tambah_mapel($idkelas, $idkurikulum, $mapel){
	$data = array(
		'kelas_id'		=> $idkelas,
		'id_kurikulum'	=> $idkurikulum,
		'nama_mapel'	=> $mapel
	);
	$this->db->insert("mata_pelajaran", $data);
}

function edit_mapel($idmapel, $idkelas, $idkurikulum, $mapel){
	$data = array(
		"kelas_id"		=> $idkelas,
		"id_kurikulum"	=> $idkurikulum,
		"nama_mapel"	=> $mapel
	);
	$this->db->where("id_mapel", $idmapel);
	$this->db->update("mata_pelajaran", $data);
}

function hapus_mapel($idmapel){
	$this->db->where("id_mapel", $idmapel);
	$this->db->delete("mata_pelajaran");
}



}

?>