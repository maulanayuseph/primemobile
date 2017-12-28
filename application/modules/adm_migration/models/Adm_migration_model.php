<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Adm_migration_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

function fetch_kelas(){
	$this->db->select("*");
	$this->db->from("kelas");

	$query = $this->db->get();	
	return $query->result();
}

function fetch_mapel_by_kelas_old($idkelas){
	$this->db->select("*");
	$this->db->from("mata_pelajaran");
	$this->db->where("kelas_id", $idkelas);

	$query = $this->db->get();	
	return $query->result();
}

function cari_mapok_by_mapel($id){
	$this->db->select('*');
	$this->db->from('materi_pokok');
	$this->db->where('mapel_id', $id);
	$this->db->order_by('urutan', 'ASC');
	$query = $this->db->get();

	return $query->result();
}

function jumlah_subk13_by_mapok($idmapok){
	$this->db->select("*");
	$this->db->from("sub_materi");
	$this->db->where("materi_pokok_id", $idmapok);
	$this->db->where("kurikulum", "K-13");
	
	$result = $this->db->count_all_results();
	return $result;
}

function jumlah_ktsp_by_mapok($idmapok){
	$this->db->select("*");
	$this->db->from("sub_materi");
	$this->db->where("materi_pokok_id", $idmapok);
	$this->db->where("kurikulum", "KTSP");
	
	$result = $this->db->count_all_results();
	return $result;
}

function jumlah_subkirisan_by_mapok($idmapok){
	$this->db->select("*");
	$this->db->from("sub_materi");
	$this->db->where("materi_pokok_id", $idmapok);
	$this->db->where("kurikulum", "KTSP, K-13");
	
	$result = $this->db->count_all_results();
	return $result;
}

function jumlah_subk13rev_by_mapok($idmapok){
	$this->db->select("*");
	$this->db->from("sub_materi");
	$this->db->where("materi_pokok_id", $idmapok);
	$this->db->where("k_13_revisi", 1);
	
	$result = $this->db->count_all_results();
	return $result;
}

function fetch_sub_k13_by_mapok($idmapok){
	$this->db->select("*");
	$this->db->from("sub_materi");
	$this->db->where("materi_pokok_id", $idmapok)->where("(kurikulum = 'K-13' or kurikulum = 'KTSP, K-13')");

	$query = $this->db->get();
	return $query->result();
}

function fetch_sub_ktsp_by_mapok($idmapok){
	$this->db->select("*");
	$this->db->from("sub_materi");
	$this->db->where("materi_pokok_id", $idmapok)->where("(kurikulum = 'KTSP' or kurikulum = 'KTSP, K-13')");

	$query = $this->db->get();
	return $query->result();
}

function fetch_sub_k13rev_by_mapok($idmapok){
	$this->db->select("*");
	$this->db->from("sub_materi");
	$this->db->where("materi_pokok_id", $idmapok);
	$this->db->where("k_13_revisi", 1);

	$query = $this->db->get();
	return $query->result();
}

function fetch_kurikulum(){
	$this->db->select("*");
	$this->db->from("kurikulum");

	$query = $this->db->get();
	return $query->result();
}

function fetch_mapel(){
	$this->db->select("*");
	$this->db->from("mapel");

	$query = $this->db->get();
	return $query->result();
}

function fetch_mapok_by_id($idmapok){
	$this->db->select("*");
	$this->db->from("materi_pokok");
	$this->db->where("id_materi_pokok", $idmapok);

	$query = $this->db->get();
	return $query->row();
}

function fetch_kelas_by_id($idkelas){
	$this->db->select("*");
	$this->db->from("kelas");
	$this->db->where("id_kelas", $idkelas);

	$query = $this->db->get();
	return $query->row();
}

function fetch_kurikulum_by_id($idkurikulum){
	$this->db->select("*");
	$this->db->from("kurikulum");
	$this->db->where("id_kurikulum", $idkurikulum);

	$query = $this->db->get();
	return $query->row();
}

function fetch_mapel_new_by_id($idmapel){
	$this->db->select("*");
	$this->db->from("mapel");
	$this->db->where("id_mapel", $idmapel);

	$query = $this->db->get();
	return $query->row();
}
}

?>