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
	$this->db->order_by('kategori', 'ASC');

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

function fetch_bab_by_nama_bab($namabab, $idmapel){
	$this->db->select("*");
	$this->db->from("bab");
	$this->db->where("nama_bab", $namabab);
	$this->db->where("id_mapel", $idmapel);

	$query = $this->db->get();
	return $query->row();
}


function insert_bab($idmapel, $namabab){
	$data= array(
		'id_mapel'	=> $idmapel,
		'nama_bab'	=> $namabab,
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

function insert_kurikulum_x_bab($idkurxkelas, $idbab, $urutan){
	$data = array(
		'id_kurikulum_x_kelas'	=> $idkurxkelas,
		'id_bab'				=> $idbab,
		'urutan'				=> $urutan
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

function fetch_sub_bab_by_nama_and_bab($namasub, $idbab){
	$this->db->select("*");
	$this->db->from("sub_bab");
	$this->db->where("nama_sub_bab", $namasub);
	$this->db->where("id_bab", $idbab);

	$query = $this->db->get();
	return $query->row();
}

function insert_sub_bab($namasubbab, $idbab){
	$data = array(
		'nama_sub_bab'	=> $namasubbab,
		'id_bab'		=> $idbab
	);
	$this->db->insert("sub_bab", $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function cek_kurikulum_x_sub_bab($idkurxkelas, $idsubbab){
	$this->db->select("*");
	$this->db->from("kurikulum_x_sub_bab");
	$this->db->where("id_kurikulum_x_kelas", $idkurxkelas);
	$this->db->where("id_sub_bab", $idsubbab);

	$query = $this->db->get();
	return $query->row();
}

function insert_kurikulum_x_sub_bab($idkurxkelas, $idsubbab){
	$data = array(
		'id_kurikulum_x_kelas'	=> $idkurxkelas,
		'id_sub_bab'			=> $idsubbab
	);
	$this->db->insert("kurikulum_x_sub_bab", $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function insert_judul($idkurxsubbab, $judul, $tipe){
	$data = array(
		'tema_or_mapel'	=> 'mapel',
		'id_sub'		=> $idkurxsubbab,
		'judul'			=> $judul,
		'tipe'			=> $tipe
	);

	$this->db->insert("judul", $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function edit_id_judul_materi($idsubmateri, $idjudul){
	$data = array(
		'id_judul'	=> $idjudul
	);
	$this->db->where("sub_materi_id", $idsubmateri);
	$this->db->update("konten_materi", $data);
}

function insert_judul_soal($idkurxsubbab, $judul, $tipe, $uji){
	$data = array(
		'tema_or_mapel'		=> 'mapel',
		'id_sub'			=> $idkurxsubbab,
		'judul'				=> $judul,
		'tipe'				=> $tipe,
		'uji_kompetensi'	=> $uji
	);

	$this->db->insert("judul", $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function insert_judul_unknown($idkurxbab, $judul, $tipe, $uji){
	$data = array(
		'tema_or_mapel'			=> 'mapel',
		'id_sub'				=> 0,
		'judul'					=> $judul,
		'tipe'					=> $tipe,
		'id_kurikulum_x_bab'	=> $idkurxbab,
		'uji_kompetensi'		=> $uji
	);

	$this->db->insert("judul", $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function fetch_soal_by_sub_materi($idsubmateri){
	$this->db->select("*");
	$this->db->from("jawaban");
	$this->db->join("soal", "jawaban.soal_id = soal.id_soal", "left");
	$this->db->where("soal.sub_materi_id", $idsubmateri);

	$query = $this->db->get();
	return $query->result();
}

function insert_bank_soal($pertanyaan, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $kunci, $bobot, $bahasteks, $bahasvideo, $qcstatus, $idadm){
	$data = array(
		'kategori'			=> 'latihan',
		'pertanyaan'		=> $pertanyaan,
		'jawab_1'			=> $jawab1,
		'jawab_2'			=> $jawab2,
		'jawab_3'			=> $jawab3,
		'jawab_4'			=> $jawab4,
		'jawab_5'			=> $jawab5,
		'pembahasan_teks'	=> $bahasteks,
		'pembahasan_video'	=> $bahasvideo,
		'bobot_soal'		=> $bobot,
		'kunci'				=> $kunci,
		'qc_status'			=> $qcstatus,
		'id_adm'			=> $idadm
	);
	$this->db->insert("bank_soal", $data);

	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function edit_qc_history($idsoallama, $idsoalbaru){
	$data = array(
		'id_soal'	=> $idsoalbaru
	);
	$this->db->where('id_soal', $idsoallama);

	$this->db->update('qc_history',$data);
}

function insert_judul_x_soal($idjudul, $idbanksoal){
	$data = array(
		'id_judul'	=> $idjudul,
		'id_soal'	=> $idbanksoal
	);

	$this->db->insert("judul_x_soal", $data);
}

function insert_soal_x_kelas($idkelas, $idsoal){
	$data = array(
		'id_kelas'	=> $idkelas,
		'id_soal'	=> $idsoal
	);
	$this->db->insert("soal_x_kelas", $data);
}

function insert_soal_x_kurikulum($idkurikulum, $idsoal){
	$data = array(
		'id_kurikulum'		=> $idkurikulum,
		'id_soal'			=> $idsoal
	);
	$this->db->insert("soal_x_kurikulum", $data);
}

function insert_soal_x_mapel($idmapel, $idsoal){
	$data = array(
		'id_mapel'	=> $idmapel,
		'id_soal'	=> $idsoal
	);
	$this->db->insert("soal_x_mapel", $data);
}

function insert_soal_x_bab($idbab, $idsoal){
	$data = array(
		'id_bab'	=> $idbab,
		'id_soal'	=> $idsoal
	);
	$this->db->insert("soal_x_bab", $data);
}

function insert_soal_x_sub_bab($idsubbab, $idsoal){
	$data = array(
		'id_sub_bab'	=> $idsubbab,
		'id_soal'		=> $idsoal
	);
	$this->db->insert("soal_x_sub_bab", $data);
}
}

?>