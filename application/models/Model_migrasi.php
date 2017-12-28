<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_migrasi extends CI_Model
{
function __construct()
{
	parent::__construct();
}

function fetch_sub_by_bab($idmapok){
	$this->db->select("*");
	$this->db->from("konten_materi");
	$this->db->join("sub_materi", "sub_materi.id_sub_materi = konten_materi.sub_materi_id", "left");
	$this->db->where("sub_materi.materi_pokok_id", $idmapok);
	$this->db->order_by("sub_materi.urutan_materi", "ASC");
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_soal_by_sub($idsub){
	$this->db->select("*");
	$this->db->from("soal");
	$this->db->where("sub_materi_id", $idsub);
	
	$query = $this->db->get();
	return $query->result();
}

function proses_pindah_soal($idsoal, $subpindah){
	$this->db->set('sub_materi_id', $subpindah);
	$this->db->where('id_soal', $idsoal);
	$this->db->update('soal');
}

function add_materi_pokok($mapel_id, $nama_materi_pokok, $judulk13, $judulktsp, $deskripsi_materi_pokok, $urutan)
{	
	//Insert data into table materi_pokok
	$data = array(
		'mapel_id' 				 => $mapel_id,
		'nama_materi_pokok' 	 => $nama_materi_pokok,
		'deskripsi_materi_pokok' => $deskripsi_materi_pokok,
		'urutan'				 => $urutan,
		'judul_bab_k13'			 => $judulk13,
		'judul_bab_ktsp'		 => $judulktsp
		);
	$result = $this->db->insert('materi_pokok', $data);

	$insert_id = $this->db->insert_id();

	return $insert_id;
}

//fetch sub materi by bab
function fetch_sub_materi_by_bab($idbab){
	$this->db->select("*");
	$this->db->from("sub_materi");
	$this->db->join("konten_materi", "konten_materi.sub_materi_id = sub_materi.id_sub_materi", "left");
	$this->db->where("sub_materi.materi_pokok_id", $idbab);
	
	$query = $this->db->get();
	return $query->result();
}


}
?>