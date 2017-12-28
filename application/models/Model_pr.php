<?php 

class Model_pr extends CI_Model{
	function __construct(){

		parent::__construct();
	}

	
function fetch_kelas_siswa($idsiswa){
	$this->db->select("*");
	$this->db->from("siswa_psep");
	$this->db->where("id_siswa", $idsiswa);
	if($this->db->count_all_results() > 0){
		$this->db->select("*");
		$this->db->from("siswa_psep");
		$this->db->where("id_siswa", $idsiswa);
		
		$query = $this->db->get();
		return $query->result();
	}else{
		return null;
	}
}

function fetch_pr_by_kelas_and_tahun_ajaran($idkelas, $idtahunajaran){
	$this->db->select("*");
	$this->db->from("config_pr");
	$this->db->join("pekerjaan_rumah", "config_pr.id_pr = pekerjaan_rumah.id_pr", "left");
	$this->db->where("config_pr.id_kelas_paralel", $idkelas);
	$this->db->where("config_pr.id_tahun_ajaran", $idtahunajaran);
	$this->db->where("config_pr.lihat", 1);
	$this->db->order_by("pekerjaan_rumah.id_pr", "DESC");
	$query = $this->db->get();
	return $query->result();
}

function cari_terjawab($idpr, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_pr");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	
	$jumlahterjawab = $this->db->count_all_results();
	if($jumlahterjawab > 0){
		$this->db->select("*");
		$this->db->from("analisis_pr");
		$this->db->where("id_pr", $idpr);
		$this->db->where("id_siswa", $idsiswa);
		
		$query = $this->db->get();
		return $query->result();	
	}else{
		return null;
	}
}

function jumlah_terjawab($idpr, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_pr");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	
	$jumlahterjawab = $this->db->count_all_results();
	return $jumlahterjawab;
}

function fetch_soal_by_pr($idpr){
	$this->db->select("*");
	$this->db->from("soal_pr");
	$this->db->where("id_pr", $idpr);
	
	$query = $this->db->get();
	return $query->result();
}

function jumlah_soal($idpr){
	$this->db->select("*");
	$this->db->from("soal_pr");
	$this->db->where("id_pr", $idpr);
	
	return $this->db->count_all_results();
}

function jumlah_soal_by_tipe($idpr){
	$this->db->select("*");
	$this->db->from("pekerjaan_rumah");
	$this->db->where("id_pr", $idpr);
	
	$query = $this->db->get();
	$pr = $query->row();
	if($pr->tipe == 1){
		$this->db->select("*");
		$this->db->from("soal_pr");
		$this->db->where("id_pr", $idpr);
		
		return $this->db->count_all_results();
	}elseif($pr->tipe == 2){
		$this->db->select("*");
		$this->db->from("soal_eksak");
		$this->db->join("intro_soal", "soal_eksak.id_intro_soal = intro_soal.id_intro_soal");
		$this->db->join("pekerjaan_rumah", "intro_soal.id_pr = pekerjaan_rumah.id_pr");
		$this->db->where("pekerjaan_rumah.id_pr", $idpr);
		
		return $this->db->count_all_results();
	}elseif($pr->tipe == 3){
		$this->db->select("*");
		$this->db->from("soal_essai");
		$this->db->where("id_pr", $idpr);
		
		return $this->db->count_all_results();
	}
}

function get_info_pr($idpr){
	$this->db->select("*");
	$this->db->from("pekerjaan_rumah");
	$this->db->join("tahun_ajaran", "pekerjaan_rumah.id_tahun_ajaran=tahun_ajaran.id_tahun_ajaran", "left");
	$this->db->join("kelas_paralel", "pekerjaan_rumah.id_kelas_paralel=kelas_paralel.id_kelas_paralel", "left");
	$this->db->where("id_pr", $idpr);
	
	$query = $this->db->get();
	return $query->row();
}

function fetch_array_id_soal($idpr){
	$this->db->select('id_soal_pr, kunci');
	$this->db->from('soal_pr');
	$this->db->where('id_pr', $idpr);
	
	$query = $this->db->get();
	return $query->result_array();
}

function cari_analisis_pr($idpr, $idsiswa, $id_soal){
	$this->db->select('*');
	$this->db->from('analisis_pr');
	$this->db->where('id_pr', $idpr);
	$this->db->where('id_siswa', $idsiswa);
	$this->db->where('id_soal_pr', $id_soal);
	$result = $this->db->count_all_results();
	//tester
	// echo $this->db->_compile_select();
	return $result;
}

function edit_analisis_pr($idpr, $idsiswa, $id_soal, $status, $jawaban){
	$this->db->set('status', $status);
	$this->db->set('terjawab', $jawaban);
	
	$this->db->where('id_pr', $idpr);
	$this->db->where('id_siswa', $idsiswa);
	$this->db->where('id_soal_pr', $id_soal);
	$query = $this->db->update('analisis_pr');
	return $query;
}

function input_analisis_pr($idpr, $idsiswa, $id_soal, $status, $jawaban){
	$data = array(
		'id_pr'			=> $idpr,
		'id_siswa'		=> $idsiswa,
		'id_soal_pr'	=> $id_soal,
		'status'		=> $status,
		'terjawab'		=> $jawaban
	);
	
	$result = $this->db->insert('analisis_pr', $data);
}

function jumlah_benar_by_siswa_and_pr($idpr, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_pr");
	$this->db->where("status", 1);
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	
	return $this->db->count_all_results();
}

function insert_status_belum($idpr, $idsiswa){
	$this->db->select("*");
	$this->db->from("status_pr");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	if($this->db->count_all_results() > 0){
		$this->db->set('status', 0);
	
		$this->db->where('id_pr', $idpr);
		$this->db->where('id_siswa', $idsiswa);
		
		$query = $this->db->update('status_pr');
		return $query;
	}else{
		$data = array(
			'id_pr' 	=> $idpr,
			'id_siswa'	=> $idsiswa,
			'status'	=> 0
		);
		$result = $this->db->insert('status_pr', $data);
	}
}

function insert_status_selesai($idpr, $idsiswa){
	$this->db->set('status', 1);
	
	$this->db->where('id_pr', $idpr);
	$this->db->where('id_siswa', $idsiswa);
	
	$query = $this->db->update('status_pr');
	return $query;
}

function fetch_status_pr($idpr, $idsiswa){
	$this->db->select("*");
	$this->db->from("status_pr");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	
	if($this->db->count_all_results() > 0){
		$this->db->select("*");
		$this->db->from("status_pr");
		$this->db->where("id_pr", $idpr);
		$this->db->where("id_siswa", $idsiswa);
		
		$query = $this->db->get();
		return $query->row();
	}else{
		return null;
	}
}

function fetch_jawaban_per_soal($idsiswa, $idsoal, $idpr){
	$this->db->select("*");
	$this->db->from("analisis_pr");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_soal_pr", $idsoal);
	$this->db->where("id_pr", $idpr);
	
	$query = $this->db->get();
	return $query->row();
}

//FUNGSI2 UNTUK PR EKSAK
function fetch_soal_eksak_by_pr($idpr){
	$this->db->select("*");
	$this->db->from("intro_soal");
	$this->db->where("intro_soal.id_pr", $idpr);
	
	$query = $this->db->get();
	return $query->result();
}


function insert_analisis_pr_eksak($idpr, $idsiswa, $idpertanyaan, $terjawab, $status){
	$this->db->select("*");
	$this->db->from("analisis_pr_eksak");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_pertanyaan", $idpertanyaan);
	if($this->db->count_all_results() > 0){
		$this->db->set('terjawab', $terjawab);
		$this->db->set('status', $status);
		
		if($status == 0){
			$this->db->set('koreksi', 0);
		}else{
			$this->db->set('koreksi', 1);
		}
	
		$this->db->where('id_pr', $idpr);
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('id_pertanyaan', $idpertanyaan);
		
		$query = $this->db->update('analisis_pr_eksak');
		return $query;
	}else{
		$data = array(
			'id_pr' 			=> $idpr,
			'id_siswa'			=> $idsiswa,
			'id_pertanyaan'		=> $idpertanyaan,
			'terjawab'			=> $terjawab,
			'status'			=> $status
		);
		
		if($status == 0){
			$data['koreksi']	= 0; 
		}else{
			$data['koreksi']	= 1; 
		}
		
		$result = $this->db->insert('analisis_pr_eksak', $data);
	}
}

function insert_analisis_pr_eksak_checked($idpr, $idsiswa, $idpertanyaan, $terjawab, $status){
	$this->db->select("*");
	$this->db->from("analisis_pr_eksak");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_pertanyaan", $idpertanyaan);
	if($this->db->count_all_results() > 0){
		$this->db->set('terjawab', $terjawab);
		$this->db->set('status', $status);
		$this->db->set('checked', 1);
		
		if($status == 0){
			$this->db->set('koreksi', 0);
		}else{
			$this->db->set('koreksi', 1);
		}
	
		$this->db->where('id_pr', $idpr);
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('id_pertanyaan', $idpertanyaan);
		
		$query = $this->db->update('analisis_pr_eksak');
		return $query;
	}else{
		$data = array(
			'id_pr' 			=> $idpr,
			'id_siswa'			=> $idsiswa,
			'id_pertanyaan'		=> $idpertanyaan,
			'terjawab'			=> $terjawab,
			'status'			=> $status,
			'checked'			=> 1
		);
		
		if($status == 0){
			$data['koreksi']	= 0; 
		}else{
			$data['koreksi']	= 1; 
		}
		
		$result = $this->db->insert('analisis_pr_eksak', $data);
	}
}

function fetch_kesempatan_eksak($idsiswa, $idsoal){
	$this->db->select("*");
	$this->db->from("kesempatan_pr_eksak");
	$this->db->where("id_intro_soal", $idsoal);
	$this->db->where("id_siswa", $idsiswa);
	if($this->db->count_all_results() > 0){
		$this->db->select("*");
		$this->db->from("kesempatan_pr_eksak");
		$this->db->where("id_intro_soal", $idsoal);
		$this->db->where("id_siswa", $idsiswa);
		$query = $this->db->get();
		return $query->row();
	}else{
		return null;
	}
}

function insert_kesempatan_eksak($idsiswa, $idsoal, $kesempatan){
	$this->db->select("*");
	$this->db->from("kesempatan_pr_eksak");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_intro_soal", $idsoal);
	if($this->db->count_all_results() > 0){
		$this->db->set('kesempatan', $kesempatan);
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('id_intro_soal', $idsoal);
		$this->db->update('kesempatan_pr_eksak');
	}else{
		$data = array(
			'id_intro_soal' 	=> $idsoal,
			'id_siswa'			=> $idsiswa,
			'kesempatan'		=> $kesempatan
		);
		$result = $this->db->insert('kesempatan_pr_eksak', $data);
	}
}

function fetch_terjawab_by_soal($idsoal, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_pr_eksak");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_pertanyaan", $idsoal);
	if($this->db->count_all_results() > 0){
		$this->db->select("*");
		$this->db->from("analisis_pr_eksak");
		$this->db->where("id_siswa", $idsiswa);
		$this->db->where("id_pertanyaan", $idsoal);
		
		$query = $this->db->get();
		return $query->row();
	}else{
		return null;
	}
}

function fetch_terjawab_essai_by_soal($idsoal, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_pr_essai");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_soal", $idsoal);
	if($this->db->count_all_results() > 0){
		$this->db->select("*");
		$this->db->from("analisis_pr_essai");
		$this->db->where("id_siswa", $idsiswa);
		$this->db->where("id_soal", $idsoal);
		
		$query = $this->db->get();
		return $query->row();
	}else{
		return null;
	}
}

function fetch_jumlah_soal_eksak_by_pr($idpr){
	$this->db->select("*");
	$this->db->from("soal_eksak");
	$this->db->join("intro_soal", "soal_eksak.id_intro_soal = intro_soal.id_intro_soal");
	$this->db->where("intro_soal.id_pr", $idpr);
	return $this->db->count_all_results();
}

function fetch_jumlah_soal_essai_by_pr($idpr){
	$this->db->select("*");
	$this->db->from("soal_essai");
	$this->db->where("id_pr", $idpr);
	return $this->db->count_all_results();
}

function fetch_benar_eksak_by_siswa($idpr, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_pr_eksak");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("status", 1);
	return $this->db->count_all_results();
}

function fetch_benar_essai_by_siswa($idpr, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_pr_essai");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("status", 1);
	return $this->db->count_all_results();
}

function revisi_eksak($idanalisis, $status){
	$this->db->set('status', $status);
	
	$this->db->where('id_analisis_pr_eksak', $idanalisis);
	
	$query = $this->db->update('analisis_pr_eksak');
	return $query;
}

function fetch_analisis_eksak_by_id($idanalisis){
	$this->db->select("*");
	$this->db->from("analisis_pr_eksak");
	$this->db->where("id_analisis_pr_eksak", $idanalisis);
	
	$query = $this->db->get();
	return $query->row();
}
//END FNGSI PR EKSAK

//FUNGSI PR ESSAI
function fetch_soal_essai_by_pr($idpr){
	$this->db->select("*");
	$this->db->from("soal_essai");
	$this->db->where("id_pr", $idpr);
	
	$query = $this->db->get();
	return $query->result();
}

function simpan_analisis_essai($idpr, $idsoal, $idsiswa, $jawaban){
	$this->db->select("*");
	$this->db->from("analisis_pr_essai");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_soal", $idsoal);
	$this->db->where("id_siswa", $idsiswa);
	
	if($this->db->count_all_results() == 1){
		$this->db->set('jawaban', $jawaban);
		$this->db->where("id_pr", $idpr);
		$this->db->where("id_soal", $idsoal);
		$this->db->where("id_siswa", $idsiswa);
		
		$query = $this->db->update('analisis_pr_essai');
		return $query;
	}else{
		$data = array(
			'id_pr'		=> $idpr,
			'id_soal'	=> $idsoal,
			'id_siswa'	=> $idsiswa,
			'jawaban'	=> $jawaban
		);
		$this->db->insert('analisis_pr_essai', $data);
	}
}

function fetch_terjawab($idpr, $idsoal, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_pr_essai");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_soal", $idsoal);
	$this->db->where("id_siswa", $idsiswa);
	
	if($this->db->count_all_results() == 1){
		$this->db->select("*");
		$this->db->from("analisis_pr_essai");
		$this->db->where("id_pr", $idpr);
		$this->db->where("id_soal", $idsoal);
		$this->db->where("id_siswa", $idsiswa);
	
		$query = $this->db->get();
		return $query->row();
	}else{
		return null;
	}
}

function set_status_essai($idpr, $idsiswa, $status){
	$this->db->select("*");
	$this->db->from("status_pr");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);
	if($this->db->count_all_results() == 1){
		$this->db->set('status', $status);
		$this->db->where("id_pr", $idpr);
		$this->db->where("id_siswa", $idsiswa);
		
		$query = $this->db->update('status_pr');
		return $query;
	}else{
		$data = array(
			'id_pr'		=> $idpr,
			'id_siswa'	=> $idsiswa,
			'status'	=> $status
		);
		$this->db->insert('status_pr', $data);
	}
}

function fetch_jawaban_essai_siswa_by_soal($idsoal, $idsiswa){
	$this->db->select("*");
	$this->db->from("analisis_pr_essai");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_soal", $idsoal);
	$query = $this->db->get();
	return $query->row();
}
//END FUNGSI PR ESSAI

function fetch_status_pr_siswa($idpr, $idsiswa){
	$this->db->select("*");
	$this->db->from("status_pr");
	$this->db->where("id_pr", $idpr);
	$this->db->where("id_siswa", $idsiswa);

	$query = $this->db->get();
	return $query->row();
}

//FUNGSI UNTUK FETCH PENJADWALAN PR
function fetch_pr_berlangsung_siswa($idkelas, $idtahunajaran){
	$today = date("Y-m-d H:i:s");
	$this->db->select("*");
	$this->db->from("config_pr");
	$this->db->join("pekerjaan_rumah", "config_pr.id_pr = pekerjaan_rumah.id_pr", "left");
	$this->db->where("config_pr.id_kelas_paralel", $idkelas);
	$this->db->where("config_pr.id_tahun_ajaran", $idtahunajaran);
	$this->db->where("config_pr.lihat", 1);
	$this->db->where("akses_start <=", $today);
	$this->db->where("akses_end >=", $today);

	$this->db->order_by("pekerjaan_rumah.id_pr", "DESC");
	$query = $this->db->get();
	return $query->result();
}
}