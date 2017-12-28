<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_rencana_belajar extends CI_Model{
function __construct(){
	parent::__construct();
}

function insert_rencana_belajar($idsiswa, $idkelas, $rencanabelajar){
	$data = array(
		'id_siswa'			=> $idsiswa,
		'id_kelas'			=> $idkelas,
		'rencana_belajar'	=> $rencanabelajar
	);
	$this->db->insert("rencana_belajar", $data);
	$idrencanabelajar 	 	= $this->db->insert_id();
	return $idrencanabelajar;
}

function fetch_rencana_belajar_by_id($idrencanabelajar){
	$this->db->select("*");
	$this->db->from("rencana_belajar");
	$this->db->join("kelas", "rencana_belajar.id_kelas = kelas.id_kelas");
	$this->db->where("id_rencana_belajar", $idrencanabelajar);
	
	$result=$this->db->get();
	return $result->row();
}

function simpan_materi($idsiswa, $idmateripokok){
	$this->db->select("*");
	$this->db->from("rencana_belajar");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_materi_pokok", $idmateripokok);
	if($this->db->count_all_results() > 0){
		$this->db->delete('rencana_belajar', array('id_siswa' => $idsiswa, 'id_materi_pokok' => $idmateripokok));
	}else{
		$data = array(
			'id_siswa'			=> $idsiswa,
			'id_materi_pokok'	=> $idmateripokok
		);
		$this->db->insert("rencana_belajar", $data);
		$idrencanabelajar 	 	= $this->db->insert_id();
		return $idrencanabelajar;
	}
}

function fetch_mapel_by_materi_tersimpan($idsiswa){
	$this->db->select("mata_pelajaran.nama_mapel, mata_pelajaran.id_mapel");
	$this->db->from("rencana_belajar");
	$this->db->join("materi_pokok", "rencana_belajar.id_materi_pokok=materi_pokok.id_materi_pokok");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id=mata_pelajaran.id_mapel");
	$this->db->where("rencana_belajar.id_siswa", $idsiswa);
	$this->db->group_by("mata_pelajaran.id_mapel");
	
	
	if($this->db->count_all_results() > 0){
		$this->db->select("mata_pelajaran.nama_mapel, mata_pelajaran.id_mapel, kelas.alias_kelas");
		$this->db->from("rencana_belajar");
		$this->db->join("materi_pokok", "rencana_belajar.id_materi_pokok=materi_pokok.id_materi_pokok");
		$this->db->join("mata_pelajaran", "materi_pokok.mapel_id=mata_pelajaran.id_mapel");
		$this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas");
		$this->db->where("rencana_belajar.id_siswa", $idsiswa);
		$this->db->group_by("mata_pelajaran.id_mapel");
		
		$result=$this->db->get();
		return $result->result();
	}else{
		return null;
	}
}

function fetch_mapel_by_materi_tersimpan_and_kelas_aktif($idsiswa, $idkelas){
	$this->db->select("mata_pelajaran.nama_mapel, mata_pelajaran.id_mapel");
	$this->db->from("rencana_belajar");
	$this->db->join("materi_pokok", "rencana_belajar.id_materi_pokok=materi_pokok.id_materi_pokok");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id=mata_pelajaran.id_mapel");
	$this->db->where("rencana_belajar.id_siswa", $idsiswa);
	$this->db->group_by("mata_pelajaran.id_mapel");
	
	
	if($this->db->count_all_results() > 0){
		$this->db->select("mata_pelajaran.nama_mapel, mata_pelajaran.id_mapel, kelas.alias_kelas");
		$this->db->from("rencana_belajar");
		$this->db->join("materi_pokok", "rencana_belajar.id_materi_pokok=materi_pokok.id_materi_pokok");
		$this->db->join("mata_pelajaran", "materi_pokok.mapel_id=mata_pelajaran.id_mapel");
		$this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas");
		if($idkelas == 6){
			$this->db->where("rencana_belajar.id_siswa", $idsiswa)->where("kelas.id_kelas = " . $idkelas . " or mata_pelajaran.id_mapel = 171");
		}else{
			$this->db->where("rencana_belajar.id_siswa", $idsiswa);
			$this->db->where("kelas.id_kelas", $idkelas);
		}
		$this->db->group_by("mata_pelajaran.id_mapel");
		
		$result=$this->db->get();
		return $result->result();
	}else{
		return null;
	}
}

function fetch_materi_belajar($idsiswa, $idkelas){
	$this->db->select("*, rencana_belajar.kurikulum as rencana_kurikulum");
	$this->db->from("rencana_belajar");
	$this->db->join("materi_pokok", "rencana_belajar.id_materi_pokok=materi_pokok.id_materi_pokok", "left");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id=mata_pelajaran.id_mapel", "left");
	$this->db->where("rencana_belajar.id_siswa", $idsiswa);
	$this->db->where("mata_pelajaran.kelas_id", $idkelas);
	if($this->db->count_all_results() > 0){
		$this->db->select("*, rencana_belajar.kurikulum as rencana_kurikulum");
		$this->db->from("rencana_belajar");
		$this->db->join("materi_pokok", "rencana_belajar.id_materi_pokok=materi_pokok.id_materi_pokok", "left");
		$this->db->join("mata_pelajaran", "materi_pokok.mapel_id=mata_pelajaran.id_mapel", "left");
		$this->db->where("rencana_belajar.id_siswa", $idsiswa);
		$this->db->where("mata_pelajaran.kelas_id", $idkelas);
		
		$result=$this->db->get();
		return $result->result();
	}else{
		return null;
	}
}

function hapus_materi($idsiswa, $idmateripokok){
	$this->db->delete('rencana_belajar', array('id_siswa' => $idsiswa, 'id_materi_pokok' => $idmateripokok));
}

function cari_materi($idsiswa, $idmateripokok){
	$this->db->select("*");
	$this->db->from("rencana_belajar");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_materi_pokok", $idmateripokok);
	
	return $this->db->count_all_results();
}

function fetch_rencana_belajar_by_mapel($idmapel, $idsiswa){
	$this->db->select("*");
	$this->db->from("rencana_belajar");
	$this->db->join("materi_pokok", "rencana_belajar.id_materi_pokok=materi_pokok.id_materi_pokok", "left");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id=mata_pelajaran.id_mapel", "left");
	$this->db->where("rencana_belajar.id_siswa", $idsiswa);
	$this->db->where("mata_pelajaran.id_mapel", $idmapel);
	if($this->db->count_all_results() > 0){
		$this->db->select("*, rencana_belajar.kurikulum as rencana_kurikulum");
		$this->db->from("rencana_belajar");
		$this->db->join("materi_pokok", "rencana_belajar.id_materi_pokok=materi_pokok.id_materi_pokok", "left");
		$this->db->join("mata_pelajaran", "materi_pokok.mapel_id=mata_pelajaran.id_mapel", "left");
		$this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
		$this->db->where("rencana_belajar.id_siswa", $idsiswa);
		$this->db->where("mata_pelajaran.id_mapel", $idmapel);
		
		$result=$this->db->get();
		return $result->result();
	}else{
		return null;
	}
}
function fetch_sub_by_materi_pokok($idmateripokok) //ADDED BY FAJAR
	{
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', "konten_materi.sub_materi_id = sub_materi.id_sub_materi", "left");
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->where('materi_pokok.id_materi_pokok', $idmateripokok);
		$this->db->order_by("sub_materi.urutan_materi", "ASC");
		$query = $this->db->get();
		return $query->result();
	}

function fetch_sub_by_materi_pokok_and_kurikulum($idmateripokok, $kurikulum){
	if($kurikulum == "K-13" or $kurikulum == "KTSP"){
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', "konten_materi.sub_materi_id = sub_materi.id_sub_materi", "left");
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->where('materi_pokok.id_materi_pokok', $idmateripokok)->where("(sub_materi.kurikulum = '" . $kurikulum . "' or sub_materi.kurikulum = 'KTSP, K-13')");
		$this->db->order_by("sub_materi.urutan_materi", "ASC");
		$query = $this->db->get();
		return $query->result();
	}elseif($kurikulum == "K-13 REVISI"){
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', "konten_materi.sub_materi_id = sub_materi.id_sub_materi", "left");
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->where('materi_pokok.id_materi_pokok', $idmateripokok)->where("(sub_materi.k_13_revisi = 1)");
		$this->db->order_by("sub_materi.urutan_materi", "ASC");
		$query = $this->db->get();
		return $query->result();
	}else{
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', "konten_materi.sub_materi_id = sub_materi.id_sub_materi", "left");
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->where('materi_pokok.id_materi_pokok', $idmateripokok);
		$this->db->order_by("sub_materi.urutan_materi", "ASC");
		$query = $this->db->get();
		return $query->result();
	}
}

function get_jumlah_konten($idmateripokok){
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', "konten_materi.sub_materi_id = sub_materi.id_sub_materi", "left");
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->where('materi_pokok.id_materi_pokok', $idmateripokok);
		$this->db->order_by("sub_materi.urutan_konten", "ASC");
		
		return $this->db->count_all_results();
}

function get_jumlah_konten_by_kurikulum($idmateripokok, $kurikulum){
	if($kurikulum == "K-13" or $kurikulum == "KTSP"){
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', "konten_materi.sub_materi_id = sub_materi.id_sub_materi", "left");
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->where('materi_pokok.id_materi_pokok', $idmateripokok)->where("(sub_materi.kurikulum = '" . $kurikulum . "' or sub_materi.kurikulum = 'KTSP, K-13')");
		$this->db->order_by("sub_materi.urutan_materi", "ASC");
		
		return $this->db->count_all_results();
	}else{
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', "konten_materi.sub_materi_id = sub_materi.id_sub_materi", "left");
		$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
		$this->db->where('materi_pokok.id_materi_pokok', $idmateripokok);
		$this->db->order_by("sub_materi.urutan_konten", "ASC");
		
		return $this->db->count_all_results();
	}
}

function get_jumlah_belajar_selesai($idsiswa, $idmateripokok){
	$this->db->select("*");
	$this->db->from("pencapaian_belajar");
	$this->db->join("sub_materi", "pencapaian_belajar.id_sub_materi = sub_materi.id_sub_materi");
	$this->db->where("pencapaian_belajar.id_siswa", $idsiswa);
	$this->db->where("sub_materi.materi_pokok_id", $idmateripokok);
	
	return $this->db->count_all_results();
}

function insert_pencapaian_siswa($idsiswa, $idsubmateri){
	//cari dulu, apakah sub sudah pernah di akses
	$this->db->select("*");
	$this->db->from("pencapaian_belajar");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_sub_materi", $idsubmateri);
	
	//jika belum, insert pencapaiannya
	if($this->db->count_all_results() > 0){
		return false;
	}else{
		$data = array(
			'id_siswa'		=> $idsiswa,
			'id_sub_materi'	=> $idsubmateri
		);
		$this->db->insert("pencapaian_belajar", $data);
	}
}

function delete_pencapaian_siswa($idsiswa, $idsubmateri){
	$this->db->where('id_siswa', $idsiswa);
	$this->db->where('id_sub_materi', $idsubmateri);
	$result = $this->db->delete('pencapaian_belajar');
}

function get_pencapaian($idsiswa, $idsubmateri){
	//cari dulu, apakah sub sudah pernah di akses
	$this->db->select("*");
	$this->db->from("pencapaian_belajar");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_sub_materi", $idsubmateri);
	
	return $this->db->count_all_results();
}

function get_jumlah_konten_belajar($idmapel, $idsiswa){
	$this->db->select('*');
	$this->db->from('konten_materi');
	$this->db->join('sub_materi', "konten_materi.sub_materi_id = sub_materi.id_sub_materi", "left");
	$this->db->join('materi_pokok', 'sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok', 'left');
	$this->db->join('rencana_belajar', 'rencana_belajar.id_materi_pokok = materi_pokok.id_materi_pokok', 'left');
	$this->db->where('materi_pokok.mapel_id', $idmapel);
	$this->db->where('rencana_belajar.id_siswa', $idsiswa);
	
	return $this->db->count_all_results();
}

function get_pencapaian_siswa_by_mapel($idmapel, $idsiswa){
	$this->db->select("*");
	$this->db->from("pencapaian_belajar");
	$this->db->join("sub_materi", "pencapaian_belajar.id_sub_materi = sub_materi.id_sub_materi");
	$this->db->join("materi_pokok", "sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok");
	$this->db->join("rencana_belajar", "materi_pokok.id_materi_pokok = rencana_belajar.id_materi_pokok");
	$this->db->where("rencana_belajar.id_siswa", $idsiswa);
	$this->db->where("materi_pokok.mapel_id", $idmapel);
	
	return $this->db->count_all_results();
}

//RENCANA BELAJAR BARU MENGGUNAKAN KURIKULUM
function simpan_materi_pokok($idsiswa, $idmateripokok, $kurikulum){
	//cek dulu apakah sudah pernah di insert
	if($kurikulum == "ktsp"){
		$kurikulum = "KTSP";
	}elseif($kurikulum == "k13"){
		$kurikulum = "K-13";
	}elseif($kurikulum == "k13rev"){
		$kurikulum = "K-13 REVISI";
	}
	$this->db->select("*");
	$this->db->from("rencana_belajar");
	$this->db->where("id_siswa", $this->session->userdata('id_siswa'));
	$this->db->where("id_materi_pokok", $idmapok)->where("(kurikulum = '" . $kurikulum . "' or kurikulum = '')");
	if($this->db->count_all_results() == 0){
		$data = array(
			'id_siswa'			=> $idsiswa,
			'id_materi_pokok'	=> $idmateripokok,
			'kurikulum'			=> $kurikulum
		);
		$this->db->insert("rencana_belajar", $data);
	}
}

function cek_rencana($kurikulum, $idmapok){
	if($kurikulum == "ktsp"){
		$kurikulum = "KTSP";
	}elseif($kurikulum == "k13"){
		$kurikulum = "K-13";
	}
	$this->db->select("*");
	$this->db->from("rencana_belajar");
	$this->db->where("id_siswa", $this->session->userdata('id_siswa'));
	$this->db->where("id_materi_pokok", $idmapok)->where("(kurikulum = '" . $kurikulum . "' or kurikulum = '')");
	return $this->db->count_all_results();
}

function hapus_materi_pokok($idsiswa, $idmateripokok, $kurikulum){
	if($kurikulum == "ktsp"){
		$kurikulum = "KTSP";
	}elseif($kurikulum == "k13"){
		$kurikulum = "K-13";
	}
	$this->db->delete('rencana_belajar', array(
		'id_siswa'	 		=> $idsiswa,
		'id_materi_pokok' 	=> $idmateripokok,
		'kurikulum'			=> $kurikulum
		)
	);
	$this->db->delete('rencana_belajar', array(
		'id_siswa'	 		=> $idsiswa,
		'id_materi_pokok' 	=> $idmateripokok,
		'kurikulum'			=> ''
		)
	);
}
function cek_pencapaian($idsiswa, $idsubmateri){
	$this->db->select("*");
	$this->db->from("pencapaian_belajar");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_sub_materi", $idsubmateri);
	return $this->db->count_all_results();
}
//END RENCANA BELAJAR BARU MENGGUNAKAN KURIKULUM
}