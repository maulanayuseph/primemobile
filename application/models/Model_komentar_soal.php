<?php 

class Model_komentar_soal extends CI_Model{
	function __construct(){

		parent::__construct();
	}

function submit_komentar($idsoal, $tipe, $komentar, $idsiswa){
	$data = array(
		"id_soal"		=> $idsoal,
		"tipe_komentar"	=> $tipe,
		"komentar"		=> $komentar,
		"id_siswa"		=> $idsiswa
	);
	$this->db->insert("komentar_soal", $data);
}

function fetch_komentar_limit($page){
	$this->db->select("*, komentar_soal.timestamps as waktu_komen");
	$this->db->from("komentar_soal");
	$this->db->join("siswa", "komentar_soal.id_siswa = siswa.id_siswa", "left");
	$this->db->join("sekolah", "siswa.sekolah_id = sekolah.id_sekolah", "left");
	$this->db->join("soal", "komentar_soal.id_soal = soal.id_soal", "left");
	$this->db->join("jawaban", "soal.id_soal = jawaban.soal_id", "left");
	$this->db->join("sub_materi", "soal.sub_materi_id = sub_materi.id_sub_materi", "left");
	$this->db->join("materi_pokok", "sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok", "left");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");

	$this->db->order_by("id_komentar_soal", "DESC");
	//$this->db->limit(10);
	$query = $this->db->get();
	return $query->result();
}

function fetch_komentar_by_id($idkomentar){
	$this->db->select("*, komentar_soal.timestamps as waktu_komen");
	$this->db->from("komentar_soal");
	$this->db->join("siswa", "komentar_soal.id_siswa = siswa.id_siswa", "left");
	$this->db->join("sekolah", "siswa.sekolah_id = sekolah.id_sekolah", "left");
	$this->db->join("soal", "komentar_soal.id_soal = soal.id_soal", "left");
	$this->db->join("jawaban", "soal.id_soal = jawaban.soal_id", "left");
	$this->db->join("sub_materi", "soal.sub_materi_id = sub_materi.id_sub_materi", "left");
	$this->db->join("materi_pokok", "sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok", "left");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("komentar_soal.id_komentar_soal", $idkomentar);
	//$this->db->limit(10);
	$query = $this->db->get();
	return $query->row();
}

function check_komentar($idkomentar){
	$date = Date("Y-m-d H:i:s");

	$data = array(
		'status_komentar'	=> 1,
		'checked_by'		=> $this->session->userdata('id_admin'),
		'check_timestamp'	=> $date,
	);
	$this->db->where("id_komentar_soal", $idkomentar);
	$this->db->update('komentar_soal', $data);
}

function fetch_admin_by_id($idadmin){
	$this->db->select("*");
	$this->db->from("login_adm");
	$this->db->where("id_adm", $idadmin);

	$query = $this->db->get();
	return $query->row();
}

function fetch_jumlah_komentar(){
	$this->db->select("
		mata_pelajaran.id_mapel,
		mata_pelajaran.id_mapel as idmapel,
		mata_pelajaran.nama_mapel,
		kelas.alias_kelas,
		(select count(komentar_soal.id_komentar_soal)
		from komentar_soal
		inner join soal on komentar_soal.id_soal = soal.id_soal
		inner join sub_materi on soal.sub_materi_id = sub_materi.id_sub_materi
		inner join materi_pokok on sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok
		inner join mata_pelajaran on materi_pokok.mapel_id = mata_pelajaran.id_mapel
		where mata_pelajaran.id_mapel = idmapel and komentar_soal.tipe_komentar = 'salah' and komentar_soal.status_komentar = 0
		)as jumlah_laporan_salah
		");
	$this->db->from('komentar_soal');
	$this->db->join("soal", "komentar_soal.id_soal = soal.id_soal", "left");
	$this->db->join("jawaban", "soal.id_soal = jawaban.soal_id", "left");
	$this->db->join("sub_materi", "soal.sub_materi_id = sub_materi.id_sub_materi", "left");
	$this->db->join("materi_pokok", "sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok", "left");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("komentar_soal.tipe_komentar", "salah");
	$this->db->where("komentar_soal.status_komentar", 0);
	$this->db->group_by("mata_pelajaran.id_mapel");
	$query = $this->db->get();
	return $query->result();
}

function fetch_komentar_by_mapel_and_status($idmapel, $status){
	$this->db->select("*, komentar_soal.timestamps as waktu_komen");
	$this->db->from("komentar_soal");
	$this->db->join("siswa", "komentar_soal.id_siswa = siswa.id_siswa", "left");
	$this->db->join("sekolah", "siswa.sekolah_id = sekolah.id_sekolah", "left");
	$this->db->join("soal", "komentar_soal.id_soal = soal.id_soal", "left");
	$this->db->join("jawaban", "soal.id_soal = jawaban.soal_id", "left");
	$this->db->join("sub_materi", "soal.sub_materi_id = sub_materi.id_sub_materi", "left");
	$this->db->join("materi_pokok", "sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok", "left");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("mata_pelajaran.id_mapel", $idmapel);
	$this->db->where("komentar_soal.status_komentar", $status);
	$this->db->where("komentar_soal.tipe_komentar", 'salah');

	$this->db->order_by("id_komentar_soal", "DESC");
	//$this->db->limit(10);
	$query = $this->db->get();
	return $query->result();
}

function fetch_komentar_by_soal($idsoal){
	$this->db->select("*, komentar_soal.timestamps as waktu_komen");
	$this->db->from("komentar_soal");
	$this->db->join("siswa", "komentar_soal.id_siswa = siswa.id_siswa", "left");
	$this->db->join("sekolah", "siswa.sekolah_id = sekolah.id_sekolah", "left");
	$this->db->join("soal", "komentar_soal.id_soal = soal.id_soal", "left");
	$this->db->join("jawaban", "soal.id_soal = jawaban.soal_id", "left");
	$this->db->join("sub_materi", "soal.sub_materi_id = sub_materi.id_sub_materi", "left");
	$this->db->join("materi_pokok", "sub_materi.materi_pokok_id = materi_pokok.id_materi_pokok", "left");
	$this->db->join("mata_pelajaran", "materi_pokok.mapel_id = mata_pelajaran.id_mapel", "left");
	$this->db->join("kelas", "mata_pelajaran.kelas_id = kelas.id_kelas", "left");
	$this->db->where("komentar_soal.status_komentar", 0);
	$this->db->where("komentar_soal.tipe_komentar", 'salah');
	$this->db->where("komentar_soal.id_soal", $idsoal);

	$this->db->order_by("id_komentar_soal", "DESC");
	//$this->db->limit(10);
	$query = $this->db->get();
	return $query->result();
}

function set_status_by_soal($idsoal, $status){
	$date = Date("Y-m-d H:i:s");

	$data = array(
		'status_komentar'	=> $status,
		'checked_by'		=> $this->session->userdata('id_admin'),
		'check_timestamp'	=> $date,
	);
	$this->db->where('id_soal', $idsoal);
	$this->db->update('komentar_soal', $data);
}
}