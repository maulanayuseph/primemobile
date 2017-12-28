<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_duplikat extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

function fetch_soal_awal($idawal){
	$this->db->select("*");
	$this->db->from("soal");
	$this->db->where("sub_materi_id", $idawal);
	
	$result=$this->db->get();
	return $result->result();
}

function insert_soal($idsubbab, $isisoal, $status){
	$data = array(
		'sub_materi_id'		=> $idsubbab,
		'isi_soal'			=> $isisoal,
		'status'			=> $status
	);
	$result = $this->db->insert('soal', $data);
	$this->insert_id = $this->db->insert_id();
	return $this->insert_id;
}

function fetch_jawaban_by_id_soal($idsoal){
	$this->db->select("*");
	$this->db->from("jawaban");
	$this->db->where("soal_id", $idsoal);
	
	$result=$this->db->get();
	return $result->row();
}

function insert_jawaban($idsoal, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $kunci, $pembahasan, $pembahasanvideo, $bobot){
	$data = array(
		'soal_id'			=> $idsoal,
		'jawab_1'			=> $jawab1,
		'jawab_2'			=> $jawab2,
		'jawab_3'			=> $jawab3,
		'jawab_4'			=> $jawab4,
		'jawab_5'			=> $jawab5,
		'kunci_jawaban'		=> $kunci,
		'pembahasan'		=> $pembahasan,
		'pembahasan_video'	=> $pembahasanvideo,
		'bobot'				=> $bobot
	);
	$result = $this->db->insert('jawaban', $data);
}

function insert_submateri($materipokok, $namasoal){
	$data = array(
		'materi_pokok_id'		=> $materipokok,
		'nama_sub_materi'		=> $namasoal,
		'status_materi'			=> 1
	);
	$result = $this->db->insert('sub_materi', $data);
	
	$this->insert_id = $this->db->insert_id();
	return $this->insert_id;
}

function insert_konten_materi($idsubmateri, $tanggal, $waktu){
	$data = array(
		'sub_materi_id'		=> $idsubmateri,
		'kategori'			=> 3,
		'is_demo'			=> 0,
		'tanggal'			=> $tanggal,
		'waktu'				=> $waktu	
	);
	$result = $this->db->insert('konten_materi', $data);
	
	$this->insert_id = $this->db->insert_id();
	return $this->insert_id;
}

function hapus_jawaban_by_soal($idsoal){
	$this->db->where('soal_id', $idsoal);
	$result = $this->db->delete('jawaban');
}

function hapus_soal_by_id($idsoal){
	$this->db->where('id_soal', $idsoal);
	$result = $this->db->delete('soal');
}

function fetch_soal_by_mapel($idmapel){
	$this->db->select("*");
	$this->db->from("jawaban");
	$this->db->join("soal", "jawaban.soal_id = soal.id_soal", "left");
	$this->db->join("sub_materi", "soal.sub_materi_id = sub_materi.id_sub_materi", "left");
	$this->db->join("materi_pokok", "sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok", "left");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("mata_pelajaran.id_mapel", $idmapel);

	$result=$this->db->get();
	return $result->result();
}

function fetch_soal_by_isi($isisoal, $idsoal){
	$this->db->select("*");
	$this->db->from("jawaban");
	$this->db->join("soal", "jawaban.soal_id = soal.id_soal", "left");
	$this->db->join("sub_materi", "soal.sub_materi_id = sub_materi.id_sub_materi", "left");
	$this->db->join("materi_pokok", "sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok", "left");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("soal.isi_soal", $isisoal);
	$this->db->where("soal.id_soal <", $idsoal);

	$result=$this->db->get();
	return $result->row();
}

}
?>