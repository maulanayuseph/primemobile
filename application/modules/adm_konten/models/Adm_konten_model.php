<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Adm_konten_model extends CI_Model
{
	private $insert_id;
	function __construct()
	{
		parent::__construct();
	}

function fetch_kurikulum_x_kelas_group(){
	$this->db->select("*");
	$this->db->from("kurikulum_x_kelas");
	$this->db->join("kelas", "kurikulum_x_kelas.id_kelas = kelas.id_kelas", "left");
	$this->db->group_by("kelas.id_kelas");

	$query = $this->db->get();	
	return $query->result();
}

function fetch_kurikulum_x_kelas_by_kelas($idkelas){
	$this->db->select("*");
	$this->db->from("kurikulum_x_kelas");
	$this->db->join("kelas", "kurikulum_x_kelas.id_kelas = kelas.id_kelas", "left");
	$this->db->join("kurikulum", "kurikulum_x_kelas.id_kurikulum = kurikulum.id_kurikulum", "left");
	$this->db->where("kurikulum_x_kelas.id_kelas", $idkelas);

	$query = $this->db->get();	
	return $query->result();
}

function fetch_kur_mapel_by_kelas_and_kurikulum($idkelas, $idkurikulum){
	$this->db->select("*");
	$this->db->from("kurikulum_x_mapel");
	$this->db->join("kurikulum_x_kelas", "kurikulum_x_mapel.id_kurikulum_x_kelas = kurikulum_x_kelas.id_kurikulum_x_kelas", "left");
	$this->db->join("mapel", "kurikulum_x_mapel.id_mapel = mapel.id_mapel", "left");
	$this->db->where("kurikulum_x_kelas.id_kelas", $idkelas);
	$this->db->where("kurikulum_x_kelas.id_kurikulum", $idkurikulum);

	$query = $this->db->get();	
	return $query->result();
}

function fetch_kur_bab_by_kelas_mapel_and_kurikulum($idkelas, $idkurikulum, $idmapel){
	$this->db->select("*");
	$this->db->from("kurikulum_x_bab");
	$this->db->join("bab", "kurikulum_x_bab.id_bab = bab.id_bab");
	$this->db->join("mapel", "bab.id_mapel = mapel.id_mapel");
	$this->db->join("kurikulum_x_kelas", "kurikulum_x_bab.id_kurikulum_x_kelas = kurikulum_x_kelas.id_kurikulum_x_kelas");
	$this->db->where("kurikulum_x_kelas.id_kelas", $idkelas);
	$this->db->where("kurikulum_x_kelas.id_kurikulum", $idkurikulum);
	$this->db->where("mapel.id_mapel", $idmapel);

	$query = $this->db->get();	
	return $query->result();
}

function fetch_kur_sub($idkelas, $idkurikulum, $idmapel, $idbab){
	$this->db->select("*");
	$this->db->from("kurikulum_x_sub_bab");
	$this->db->join("sub_bab", "kurikulum_x_sub_bab.id_sub_bab = sub_bab.id_sub_bab");
	$this->db->join("bab", "sub_bab.id_bab = bab.id_bab");
	$this->db->join("mapel", "bab.id_mapel = mapel.id_mapel");
	$this->db->join("kurikulum_x_kelas", "kurikulum_x_sub_bab.id_kurikulum_x_kelas = kurikulum_x_kelas.id_kurikulum_x_kelas");
	$this->db->where("bab.id_bab", $idbab);
	$this->db->where("mapel.id_mapel", $idmapel);
	$this->db->where("kurikulum_x_kelas.id_kurikulum", $idkurikulum);
	$this->db->where("kurikulum_x_kelas.id_kelas", $idkelas);
	$this->db->order_by("kurikulum_x_sub_bab.urutan", "ASC");

	$query = $this->db->get();	
	return $query->result();
}

function fetch_row_kur_bab($idkelas, $idkurikulum, $idbab){
	$this->db->select("*");
	$this->db->from("kurikulum_x_bab");
	$this->db->join("bab", "kurikulum_x_bab.id_bab = bab.id_bab");
	$this->db->join("kurikulum_x_kelas", "kurikulum_x_bab.id_kurikulum_x_kelas = kurikulum_x_kelas.id_kurikulum_x_kelas");
	$this->db->where("kurikulum_x_kelas.id_kelas", $idkelas);
	$this->db->where("kurikulum_x_kelas.id_kurikulum", $idkurikulum);
	$this->db->where("kurikulum_x_bab.id_bab", $idbab);

	$query = $this->db->get();	
	return $query->row();
}

function fetch_judul_by_kur_bab($idkurbab){
	$this->db->select("*");
	$this->db->from("judul");
	$this->db->join("kurikulum_x_sub_bab", "judul.id_sub = kurikulum_x_sub_bab.id_kurikulum_x_sub_bab");
	$this->db->join("sub_bab", "kurikulum_x_sub_bab.id_sub_bab = sub_bab.id_sub_bab");
	$this->db->join("bab", "sub_bab.id_bab = bab.id_bab");
	$this->db->join("kurikulum_x_bab", "bab.id_bab = kurikulum_x_bab.id_bab");
	$this->db->where("kurikulum_x_bab.id_kurikulum_x_bab", $idkurbab);
	$query = $this->db->get();	
	return $query->result();
}

function fetch_judul_unknown($idkurbab){
	$this->db->select("*");
	$this->db->from("judul");
	$this->db->where("id_kurikulum_x_bab", $idkurbab);
	$query = $this->db->get();	
	return $query->result();
}

function edit_urutan_sub_bab($idkursub, $urutan){
	$data = array(
		'urutan'	=> $urutan
	);
	$this->db->where("id_kurikulum_x_sub_bab", $idkursub);
	$this->db->update("kurikulum_x_sub_bab", $data);
}


function fetch_materi_author_by_id_judul($idjudul){
	$this->db->select("*");
	$this->db->from("konten_materi");
	$this->db->join("login_adm", "konten_materi.id_adm = login_adm.id_adm");
	$this->db->where("id_judul", $idjudul);
	$query = $this->db->get();	
	return $query->row();
}

function fetch_materi_by_id_judul($idjudul){
	$this->db->select("*");
	$this->db->from("konten_materi");
	$this->db->where("id_judul", $idjudul);
	$query = $this->db->get();	
	return $query->row();
}

function jumlah_soal_by_judul($idjudul){
	$this->db->select("*");
	$this->db->from("judul_x_soal");
	$this->db->where("id_judul", $idjudul);

	$result = $this->db->count_all_results();
	return $result;
}

function fetch_all_kelas(){
	$this->db->select("*");
	$this->db->from("kelas");

	$query = $this->db->get();	
	return $query->result();
}

function fetch_all_kurikulum(){
	$this->db->select("*");
	$this->db->from("kurikulum");

	$query = $this->db->get();	
	return $query->result();
}

function fetch_kurikulum_x_kelas_by_kurikulum_and_kelas($idkurikulum, $idkelas){
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
	$insert = $this->db->insert("kurikulum_x_kelas", $data);
	if($insert){
		return true;
	}else{
		return false;
	}
}
}
?>