<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_kurikulum extends CI_Model
{

	private $insert_id;

	function __construct()
	{
		parent::__construct();
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

function edit_materi_pokok($idmapok, $babk13, $babktsp, $judulk13, $judulktsp){
	$this->db->set('bab_k13', $babk13);
	$this->db->set('bab_ktsp', $babktsp);
	$this->db->set('judul_bab_k13', $judulk13);
	$this->db->set('judul_bab_ktsp', $judulktsp);
	
	$this->db->where('id_materi_pokok', $idmapok);
	
	$query = $this->db->update('materi_pokok');
	return $query;
}

function edit_sub_materi($idsubbab, $judulsub, $subk13, $subktsp){
	$this->db->set('nama_sub_materi', $judulsub);
	$this->db->set('sub_bab_k13', $subk13);
	$this->db->set('sub_bab_ktsp', $subktsp);
	
	$this->db->where('id_sub_materi', $idsubbab);
	$query = $this->db->update('sub_materi');
	return $query;
}

function fetch_queue_soal(){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->where('soal.status', 0);
	//tester
	//echo $this->db->_compile_select();exit;
	$query = $this->db->get();

	return $query->result();
}

function fetch_queue_soal_by_bab($idmapok){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->where('soal.status', 0);
	$this->db->where('materi_pokok.id_materi_pokok', $idmapok);
	//tester
	//echo $this->db->_compile_select();exit;
	$query = $this->db->get();

	return $query->result();
}

function fetch_queue_soal_by_bab_status($status, $idmapok){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->where('soal.status', $status);
	$this->db->where('materi_pokok.id_materi_pokok', $idmapok);
	//tester
	//echo $this->db->_compile_select();exit;
	$query = $this->db->get();

	return $query->result();
}

function fetch_evaluation_soal(){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
	$this->db->where('soal.status', 2);
	$this->db->or_where('soal.status', 3);
	$this->db->or_where('soal.status', 4);
	$this->db->or_where('soal.status', 5);
	$this->db->or_where('soal.status', 6);
	$this->db->or_where('soal.status', 7);
	//tester
	//echo $this->db->_compile_select();exit;
	$query = $this->db->get();

	return $query->result();
}

function fetch_evaluation_soal_by_status($status){
	if($status == "all"){
		$this->db->select('*');
		$this->db->from('jawaban');
		$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
		$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
		$this->db->where('soal.status', 2);
		$this->db->or_where('soal.status', 3);
		$this->db->or_where('soal.status', 4);
		$this->db->or_where('soal.status', 5);
		$this->db->or_where('soal.status', 6);
		$this->db->or_where('soal.status', 7);
		//tester
		//echo $this->db->_compile_select();exit;
		$query = $this->db->get();

		return $query->result();
	}else{
		$this->db->select('*');
		$this->db->from('jawaban');
		$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
		$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
		$this->db->where('soal.status', $status);
		//tester
		//echo $this->db->_compile_select();exit;
		$query = $this->db->get();

		return $query->result();
	}
}

function hitung_queue_soal(){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->where('soal.status', 0);
	//tester
	//echo $this->db->_compile_select();exit;
	$result = $this->db->count_all_results();
	return $result;
}



function update_status_soal($idsoal, $status){
	$this->db->set('status', $status);
	
	$this->db->where('id_soal', $idsoal);
	$query = $this->db->update('soal');
	return $query;
}

function set_kurikulum_sub($idsubbab, $kurikulum){
	$this->db->set('kurikulum', $kurikulum);
	
	$this->db->where('id_sub_materi', $idsubbab);
	$query = $this->db->update('sub_materi');
	return $query;
}

function fetch_soal_by_id($id_soal){
	$this->db->select('*');
	$this->db->from('soal');
	$this->db->join('jawaban', 'soal.id_soal = jawaban.soal_id', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
	$this->db->where('soal.id_soal', $id_soal);
	//tester
	//echo $this->db->_compile_select();exit;
	$query = $this->db->get();

	return $query->row();
}

function fetch_materi_pokok_antrian(){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
	$this->db->where('soal.status', 0);
	$this->db->group_by('materi_pokok.id_materi_pokok');
	//tester
	//echo $this->db->_compile_select();exit;
	$query = $this->db->get();
	return $query->result();
}

function fetch_antri_mapok_by_mapel($idmapel){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
	$this->db->where('soal.status', 0);
	$this->db->where('materi_pokok.mapel_id', $idmapel);
	$this->db->group_by('materi_pokok.id_materi_pokok');
	//tester
	//echo $this->db->_compile_select();exit;
	$query = $this->db->get();
	return $query->result();
}

function fetch_kelas_antrian(){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
	$this->db->where('soal.status', 0);
	$this->db->group_by('kelas.id_kelas');
	//tester
	//echo $this->db->_compile_select();exit;
	$query = $this->db->get();
	return $query->result();
}

function fetch_mapel_antrian(){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
	$this->db->where('soal.status', 0);
	$this->db->group_by('mata_pelajaran.id_mapel');
	//tester
	//echo $this->db->_compile_select();exit;
	$query = $this->db->get();
	return $query->result();
}

function fetch_mapel_antrian_by_kelas($idkelas){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
	$this->db->where('soal.status', 0);
	$this->db->where('mata_pelajaran.kelas_id', $idkelas);
	$this->db->group_by('mata_pelajaran.id_mapel');
	//tester
	//echo $this->db->_compile_select();exit;
	$query = $this->db->get();
	return $query->result();
}

function fetch_jumlah_antri_by_mapok($idmapok){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->where('soal.status', 0);
	$this->db->where('materi_pokok.id_materi_pokok', $idmapok);
	//tester
	//echo $this->db->_compile_select();exit;
	$result = $this->db->count_all_results();
	return $result;
}

function hitung_soal_by_status($status){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->where('soal.status', $status);
	//tester
	//echo $this->db->_compile_select();exit;
	$result = $this->db->count_all_results();
	return $result;
}

function hitung_soal_by_status_and_kelas($status, $kelas){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->where('soal.status', $status);
	$this->db->where('mata_pelajaran.kelas_id', $kelas);
	//tester
	//echo $this->db->_compile_select();exit;
	$result = $this->db->count_all_results();
	return $result;
}

function hitung_soal_ditolak_by_kelas($kelas){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->where('mata_pelajaran.kelas_id', $kelas)->where("(soal.status != 1 and soal.status != 10 and soal.status != 0 and soal.status != 11)");
	//tester
	//echo $this->db->_compile_select();exit;
	$result = $this->db->count_all_results();
	return $result;
}

function hitung_soal_by_status_and_sub($idsub, $status){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->where('soal.status', $status);
	$this->db->where('sub_materi.id_sub_materi', $idsub);
	//tester
	//echo $this->db->_compile_select();exit;
	$result = $this->db->count_all_results();
	return $result;
}

function hitung_soal_by_status_and_sub_kur($idsub, $status){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->where('soal.status', $status);
	$this->db->where('sub_materi.id_sub_materi', $idsub);
	$this->db->where('sub_materi.kurikulum !=', "");
	//tester
	//echo $this->db->_compile_select();exit;
	$result = $this->db->count_all_results();
	return $result;
}

function hitung_soal_by_status_and_sub_not_kur($idsub, $status){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->where('sub_materi.id_sub_materi', $idsub);
	$this->db->where('sub_materi.kurikulum =', "");
	//tester
	//echo $this->db->_compile_select();exit;
	$result = $this->db->count_all_results();
	return $result;
}

function fetch_jumlah_antri_by_mapel($idmapel){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->where('soal.status', 0);
	$this->db->where('mata_pelajaran.id_mapel', $idmapel);
	//tester
	//echo $this->db->_compile_select();exit;
	$result = $this->db->count_all_results();
	return $result;
}

function hitung_soal_by_status_and_mapel($idmapel, $status){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->where('mata_pelajaran.id_mapel', $idmapel);
	$this->db->where('soal.status', $status);
	//tester
	//echo $this->db->_compile_select();exit;
	$result = $this->db->count_all_results();
	return $result;
}

function fetch_soal_by_status_and_mapel($idmapel, $status){
	$this->db->select("*");
	$this->db->from("soal");
	$this->db->join("jawaban", "soal.id_soal=jawaban.soal_id", "left");
	$this->db->join("sub_materi", "soal.sub_materi_id=sub_materi.id_sub_materi", "left");
	$this->db->join("materi_pokok", "sub_materi.materi_pokok_id=materi_pokok.id_materi_pokok", "left");
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
	$this->db->where('soal.status', $status);
	$this->db->where('materi_pokok.mapel_id', $idmapel);
	$this->db->order_by('sub_materi.id_sub_materi', "ASC");
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_soal_ditolak_by_mapel($kelas){
	$this->db->select('*');
	$this->db->from('jawaban');
	$this->db->join('soal', 'jawaban.soal_id = soal.id_soal', 'left');
	$this->db->join('sub_materi', 'soal.sub_materi_id = sub_materi.id_sub_materi', 'left');
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('mata_pelajaran', 'materi_pokok.mapel_id = mata_pelajaran.id_mapel', 'left');
	$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
	$this->db->where('mata_pelajaran.id_mapel', $kelas)->where("(soal.status != 1 and soal.status != 10 and soal.status != 0 and soal.status != 11)");
	//tester
	//echo $this->db->_compile_select();exit;
	$query = $this->db->get();
	return $query->result();
}

function set_k13_revisi($idsub, $value){
	$this->db->set('k_13_revisi', $value);
	
	$this->db->where('id_sub_materi', $idsub);
	$query = $this->db->update('sub_materi');
	return $query;
}


//FUNSI BARU UNTUK FILTET K-13 REVISI
//#######################################
//#######################################
//#######################################
function jumlah_subk13rev_by_mapok($idmapok){
	$this->db->select("*");
	$this->db->from("sub_materi");
	$this->db->where("materi_pokok_id", $idmapok);
	$this->db->where("k_13_revisi", 1);
	
	$result = $this->db->count_all_results();
	return $result;
}
//END FUNSI BARU UNTUK FILTET K-13 REVISI
//#######################################
//#######################################
//#######################################

//FUNGSI UNTUK TEMATIK K13 REVISI
//#######################################
//#######################################
//#######################################

function fetch_tema_by_kelas($idkelas){
	$this->db->select("*");
	$this->db->from("tema");
	$this->db->join("kelas", "tema.id_kelas = kelas.id_kelas");
	$this->db->where("kelas.id_kelas", $idkelas);

	$query = $this->db->get();
	return $query->result();
}

function tambah_tema($idkelas, $tema){
	$data = array(
		"id_kelas"	=> $idkelas,
		"tema"		=> $tema
	);
	$this->db->insert("tema", $data);
}

function fetch_tema_by_id($idtema){
	$this->db->select("*");
	$this->db->from("tema");
	$this->db->join("kelas", "tema.id_kelas = kelas.id_kelas");
	$this->db->where("tema.id_tema", $idtema);

	$query = $this->db->get();
	return $query->row();
}

function edit_tema($idtema, $idkelas, $tema){
	$data = array(
		"id_kelas"		=> $idkelas,
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
	$this->db->join("tema", "sub_tema.id_tema = tema.id_tema");
	$this->db->join("kelas", "tema.id_kelas = kelas.id_kelas");
	$this->db->where("tema.id_tema", $idtema);

	$query = $this->db->get();
	return $query->result();
}

function fetch_sub_tema_by_id($idsubtema){
	$this->db->select("*");
	$this->db->from("sub_tema");
	$this->db->join("tema", "sub_tema.id_tema = tema.id_tema");
	$this->db->join("kelas", "tema.id_kelas = kelas.id_kelas");
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

function fetch_sub_k13rev_by_mapok($idmapok){
	$this->db->select("*");
	$this->db->from("sub_materi");
	$this->db->where("materi_pokok_id", $idmapok);
	//$this->db->where("k_13_revisi", 1);
	$query = $this->db->get();
	return $query->result();
}

function fetch_materi_pokok_by_id($idmapok){
	$this->db->select("*");
	$this->db->from("materi_pokok");
	$this->db->where("id_materi_pokok", $idmapok);
	$query = $this->db->get();
	return $query->row();
}

function edit_tema_bab($idmapok, $idtema){
	$this->db->set("id_tema", $idtema);
	$this->db->where("id_materi_pokok", $idmapok);
	$this->db->update("materi_pokok");
}

function fetch_sub_materi_by_id($idsubmateri){
	$this->db->select("*");
	$this->db->from("sub_materi");
	$this->db->where("id_sub_materi", $idsubmateri);

	$query = $this->db->get();
	return $query->row();
}

function edit_sub_bab_tema($idsub, $idsubtema){
	$this->db->set("id_sub_tema", $idsubtema);
	$this->db->where("id_sub_materi", $idsub);
	$this->db->update("sub_materi");
}
//END FUNGSI UNTUK TEMATIK K13 REVISI
//#######################################
//#######################################
//#######################################
}