<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Adm_migration_model extends CI_Model
{
	private $insert_id;
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
	$this->db->join("konten_materi", "konten_materi.sub_materi_id = sub_materi.id_sub_materi", "left");
	$this->db->where("materi_pokok_id", $idmapok)->where("(kurikulum = 'K-13' or kurikulum = 'KTSP, K-13')");

	$query = $this->db->get();
	return $query->result();
}

function fetch_sub_ktsp_by_mapok($idmapok){
	$this->db->select("*");
	$this->db->from("sub_materi");

	$this->db->join("konten_materi", "konten_materi.sub_materi_id = sub_materi.id_sub_materi", "left");
	$this->db->where("materi_pokok_id", $idmapok)->where("(kurikulum = 'KTSP' or kurikulum = 'KTSP, K-13')");

	$query = $this->db->get();
	return $query->result();
}

function fetch_sub_k13rev_by_mapok($idmapok){
	$this->db->select("*");
	$this->db->from("sub_materi");
	$this->db->join("konten_materi", "konten_materi.sub_materi_id = sub_materi.id_sub_materi", "left");
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
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
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

function fetch_bab_by_nama_bab($namabab){
	$this->db->select("*");
	$this->db->from("bab");
	$this->db->where("nama_bab", $namabab);

	$query = $this->db->get();
	return $query->row();
}


function insert_bab($idmapel, $namabab){
	$data= array(
		'id_mapel'	=> $idmapel,
		'nama_bab'	=> $namabab
	);
	$this->db->insert("bab", $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function cek_kurikulum_x_kelas($idkurikulum, $idkelas){
	$this->db->select("*");
	$this->db->from("kurikulum_x_kelas");
	$this->db->where("id_kurikulum", $idkurikulum);
	$this->db->where("id_kelas", $idkelas);

	$query = $this->db->get();
	return $query->row();
}

function insert_kurikulum_x_kelas($idkurikulum, $idkelas){
	$data = array(
		'id_kurikulum'	=> $idkurikulum,
		'id_kelas'		=> $idkelas
	);
	$this->db->insert("kurikulum_x_kelas", $data);

	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function cek_kurikulum_x_mapel($idkurxkelas, $idmapel){
	$this->db->select("*");
	$this->db->from("kurikulum_x_mapel");
	$this->db->where("id_kurikulum_x_kelas", $idkurxkelas);
	$this->db->where("id_mapel", $idmapel);

	$query = $this->db->get();
	return $query->row();
}

function insert_kurikulum_x_mapel($idkurxkelas, $idmapel){
	$data = array(
		'id_kurikulum_x_kelas'		=> $idkurxkelas,
		'id_mapel'					=> $idmapel
	);
	$this->db->insert("kurikulum_x_mapel", $data);
}

function cek_kurikulum_x_bab($idkurxkelas, $idbab){
	$this->db->select("*");
	$this->db->from("kurikulum_x_bab");
	$this->db->where("id_kurikulum_x_kelas", $idkurxkelas);
	$this->db->where("id_bab", $idbab);

	$query = $this->db->get();
	return $query->row();
}

function insert_kurikulum_x_bab($idkurxkelas, $idbab){
	$data = array(
		'id_kurikulum_x_kelas'	=> $idkurxkelas,
		'id_bab'				=> $idbab
	);
	$this->db->insert('kurikulum_x_bab', $data);

	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function update_rencana_belajar($idmapok, $idkurxbab, $kurikulum){
	$data = array(
		'id_materi_pokok'	=> $idkurxbab
	);
	$this->db->where("id_materi_pokok", $idmapok);
	$this->db->where("kurikulum", $kurikulum);
	$this->db->update("rencana_belajar", $data);
}

function fetch_kurikulum_x_bab_by_mapel($idkelas, $idkurikulum, $idmapel){
	$this->db->select("*");
	$this->db->from("kurikulum_x_bab");
	$this->db->join("bab", "kurikulum_x_bab.id_bab = bab.id_bab", "left");
	$this->db->join("kurikulum_x_kelas", "kurikulum_x_bab.id_kurikulum_x_kelas = kurikulum_x_kelas.id_kurikulum_x_kelas", "left");
	$this->db->join("kurikulum_x_mapel", "kurikulum_x_kelas.id_kurikulum_x_kelas = kurikulum_x_mapel.id_kurikulum_x_kelas", "left");
	$this->db->where("kurikulum_x_mapel.id_mapel", $idmapel);
	$this->db->where("kurikulum_x_kelas.id_kelas", $idkelas);
	$this->db->where("kurikulum_x_kelas.id_kurikulum", $idkurikulum);

	$query = $this->db->get();
	return $query->result();
}

}

?>