<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_set_latihan extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

function fetch_bab_by_mapel($idmapel){
	$this->db->select("*");
	$this->db->from("materi_pokok");
	$this->db->where("materi_pokok.mapel_id", $idmapel);
	$this->db->order_by("materi_pokok.urutan", "ASC");
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_latihan_by_bab($idbab){
	$this->db->select("*");
	$this->db->from("konten_materi");
	$this->db->join("sub_materi", "konten_materi.sub_materi_id = sub_materi.id_sub_materi", "left");
	$this->db->where("sub_materi.materi_pokok_id", $idbab);
	$this->db->where("konten_materi.kategori", 3);
	$this->db->order_by("sub_materi.urutan_materi", "ASC");
	$query = $this->db->get();
	return $query->result();
}

function fetch_sub_by_id($idsub){
	$this->db->select("*");
	$this->db->from("sub_materi");
	$this->db->where("id_sub_materi", $idsub);
	
	$query = $this->db->get();
	return $query->row();
}

function set_latihan($idsub, $tipe){
	$this->db->set('tipe_latihan', $tipe);
	
	$this->db->where('id_sub_materi', $idsub);
	$query = $this->db->update('sub_materi');
	return $query;
}
}

?>