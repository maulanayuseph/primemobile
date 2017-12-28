<?php 

class Model_manajemen_tema extends CI_Model{
	function __construct(){

		parent::__construct();
	}

function fetch_tema_by_kelas_and_kurikulum($idkelas =  null, $idkurikulum = null){
	$this->db->select("*");
	$this->db->from("tema");
	$this->db->join("kelas", "tema.id_kelas = kelas.id_kelas", "left");
	$this->db->join("kurikulum", "tema.id_kurikulum = kurikulum.id_kurikulum", "left");
	if($idkelas !== null){
		$this->db->where("kelas.id_kelas", $idkelas);
	}
	if($idkurikulum !== null){
		$this->db->where("kurikulum.id_kurikulum", $idkurikulum);
	}

	$query = $this->db->get();
	return $query->result();
}

function tambah_tema($idkelas, $idkurikulum, $tema){
	$data = array(
		"id_kelas"		=> $idkelas,
		'id_kurikulum'	=> $idkurikulum,
		"tema"			=> $tema
	);
	$this->db->insert("tema", $data);
}

function fetch_tema_by_id($idtema){
	$this->db->select("*");
	$this->db->from("tema");
	$this->db->join("kelas", "tema.id_kelas = kelas.id_kelas", "left");
	$this->db->join("kurikulum", "tema.id_kurikulum = kurikulum.id_kurikulum", "left");
	$this->db->where("tema.id_tema", $idtema);

	$query = $this->db->get();
	return $query->row();
}

function edit_tema($idtema, $idkelas, $idkurikulum, $tema){
	$data = array(
		"id_kelas"		=> $idkelas,
		'id_kurikulum'	=> $idkurikulum,
		"tema"			=> $tema
	);
	$this->db->where('id_tema', $idtema);
	$this->db->update('tema', $data);
}

function hapus_tema($idtema){
	$this->db->where("id_tema", $idtema);
	$this->db->delete("tema");
}


function tambah_sub_tema($idtema, $subtema){
	$data = array(
		"id_tema"		=> $idtema,
		"sub_tema"		=> $subtema
	);
	$this->db->insert("sub_tema", $data);
}

function fetch_sub_tema_by_tema($idtema){
	$this->db->select("*");
	$this->db->from("sub_tema");
	$this->db->join("tema", "sub_tema.id_tema = tema.id_tema", "left");
	$this->db->join("kelas", "tema.id_kelas = kelas.id_kelas", "left");
	$this->db->join("kurikulum", "tema.id_kurikulum = kurikulum.id_kurikulum", "left");
	$this->db->where("tema.id_tema", $idtema);

	$query = $this->db->get();
	return $query->result();
}

function fetch_sub_tema_by_id($idsubtema){
	$this->db->select("*");
	$this->db->from("sub_tema");
	$this->db->join("tema", "sub_tema.id_tema = tema.id_tema", "left");
	$this->db->join("kelas", "tema.id_kelas = kelas.id_kelas", "left");
	$this->db->join("kurikulum", "tema.id_kurikulum = kurikulum.id_kurikulum", "left");
	$this->db->where("sub_tema.id_sub_tema", $idsubtema);

	$query = $this->db->get();
	return $query->row();
}

function edit_sub_tema($idsubtema, $subtema){
	$data = array(
		'sub_tema'	=> $subtema
	);
	$this->db->where('id_sub_tema', $idsubtema);
	$this->db->update('sub_tema', $data);
}

function hapus_sub_tema($idsubtema){
	$this->db->where("id_sub_tema", $idsubtema);
	$this->db->delete("sub_tema");
}

}
?>