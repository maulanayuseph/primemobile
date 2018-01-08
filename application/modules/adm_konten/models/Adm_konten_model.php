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
	$this->db->join("mapel", "bab.id_mapel = mapel.id_mapel");
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
	$this->db->join("kelas", "kurikulum_x_kelas.id_kelas = kelas.id_kelas", "left");
	$this->db->join("kurikulum", "kurikulum_x_kelas.id_kurikulum = kurikulum.id_kurikulum", "left");
	$this->db->where("kurikulum_x_kelas.id_kurikulum", $idkurikulum);
	$this->db->where("kurikulum_x_kelas.id_kelas", $idkelas);

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

function fetch_all_mapel(){
	$this->db->select("*");
	$this->db->from("mapel");
	$query = $this->db->get();	
	return $query->result();
}

function fetch_kurikulum_x_mapel_by_kelas_and_mapel($idkurxkelas, $idmapel){
	$this->db->select("*");
	$this->db->from("kurikulum_x_mapel");
	$this->db->join("mapel", "kurikulum_x_mapel.id_mapel = mapel.id_mapel");
	$this->db->where("id_kurikulum_x_kelas", $idkurxkelas);
	$this->db->where("kurikulum_x_mapel.id_mapel", $idmapel);

	$query = $this->db->get();	
	return $query->row();
}

function insert_kurikulum_x_mapel($idkurxkelas, $idmapel){
	$data = array(
		'id_kurikulum_x_kelas'	=> $idkurxkelas,
		'id_mapel'				=> $idmapel
	);

	$insert 	= $this->db->insert("kurikulum_x_mapel", $data);
	if($insert){
		return true;
	}else{
		return false;
	}
}

function fetch_bab_by_mapel($idmapel){
	$this->db->select("*");
	$this->db->from("bab");
	$this->db->where("id_mapel", $idmapel);

	$query = $this->db->get();	
	return $query->result();
}

function insert_bab($idmapel, $bab){
	$data = array(
		'id_mapel'	=> $idmapel,
		'nama_bab'	=> $bab
	);
	$this->db->insert("bab", $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function insert_kurikulum_x_bab($idkurxkelas, $idbab){
	$data = array(
		'id_kurikulum_x_kelas'	=> $idkurxkelas,
		'id_bab'				=> $idbab
	);
	$insert = $this->db->insert("kurikulum_x_bab", $data);
	if($insert){
		return true;
	}else{
		return false;
	}
}

function hapus_kurikulum_x_kelas($idkurkelas){
	$this->db->where("id_kurikulum_x_kelas", $idkurkelas);
	$hapus = $this->db->delete("kurikulum_x_kelas");
	if($hapus){
		return true;
	}else{
		return false;
	}
}

function hapus_kurikulum_x_mapel($idkurmapel){
	$this->db->where("id_kurikulum_x_mapel", $idkurmapel);
	$hapus = $this->db->delete("kurikulum_x_mapel");
	if($hapus){
		return true;
	}else{
		return false;
	}
}

function fetch_bab_by_nama_and_mapel($idmapel, $namabab){
	$this->db->select("*");
	$this->db->from("bab");
	$this->db->where("id_mapel", $idmapel);
	$this->db->where("nama_bab", $namabab);

	$query = $this->db->get();	
	return $query->row();
}

function hapus_kurikulum_x_bab($idkurbab){
	$this->db->where("id_kurikulum_x_bab", $idkurbab);
	$hapus = $this->db->delete("kurikulum_x_bab");
	if($hapus){
		return true;
	}else{
		return false;
	}
}

function fetch_sub_bab_by_bab($idbab){
	$this->db->select("*");
	$this->db->from("sub_bab");
	$this->db->where("id_bab", $idbab);

	$query = $this->db->get();	
	return $query->result();
}

function fetch_sub_bab_by_nama($namasub){
	$this->db->select("*");
	$this->db->from("sub_bab");
	$this->db->where("nama_sub_bab", $namasub);

	$query = $this->db->get();	
	return $query->row();
}

function insert_sub_bab($idbab, $namasub){
	$data = array(
		'id_bab'		=> $idbab,
		'nama_sub_bab'	=> $namasub
	);
	$this->db->insert("sub_bab", $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function fetch_kur_sub_by_sub_and_kur_kelas($idkurkelas, $idsub){
	$this->db->select("*");
	$this->db->from("kurikulum_x_sub_bab");
	$this->db->where("id_kurikulum_x_kelas", $idkurkelas);
	$this->db->where("id_sub_bab", $idsub);

	$query = $this->db->get();	
	return $query->row();
}

function insert_kurikulum_x_sub_bab($idkurkelas, $idsub){
	$data = array(
		'id_kurikulum_x_kelas'	=> $idkurkelas,
		'id_sub_bab'			=> $idsub
	);
	$insert = $this->db->insert("kurikulum_x_sub_bab", $data);
	if($insert){
		return true;
	}else{
		return false;
	}
}

function fetch_kurikulum_x_sub_bab_by_id($idkursub){
	$this->db->select("*");
	$this->db->from("kurikulum_x_sub_bab");
	$this->db->where("id_kurikulum_x_sub_bab", $idkursub);

	$query = $this->db->get();	
	return $query->row();
}

}
?>