<?php 

class Model_silabus extends CI_Model{
	function __construct(){

		parent::__construct();
	}
	
function tambah_mapel($idkelas, $idsekolah, $mapel, $idlogin){
	$data = array(
		"id_kelas"			=> $idkelas,
		"id_sekolah"		=> $idsekolah,
		"nama_psep_mapel"	=> $mapel,
		"id_login"			=> $idlogin
	);
	$this->db->insert("psep_mapel", $data);
}

function fetch_mapel_by_kelas_and_sekolah($idkelas, $idsekolah){
	$this->db->select("*");
	$this->db->from("psep_mapel");
	$this->db->join("kelas", "psep_mapel.id_kelas = kelas.id_kelas", "left");
	$this->db->join("login_sekolah", "psep_mapel.id_login = login_sekolah.id_login_sekolah", "left");
	$this->db->where("psep_mapel.id_kelas", $idkelas);
	$this->db->where("psep_mapel.id_sekolah", $idsekolah);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_mapel_by_id($idpsepmapel){
	$this->db->select("*");
	$this->db->from("psep_mapel");
	$this->db->join("kelas", "psep_mapel.id_kelas = kelas.id_kelas", "left");
	$this->db->join("login_sekolah", "psep_mapel.id_login = login_sekolah.id_login_sekolah", "left");
	$this->db->where("psep_mapel.id_psep_mapel", $idpsepmapel);
	
	$query = $this->db->get();
	return $query->row();
}

function edit_mapel($idpsepmapel, $idkelas, $mapel){
	$data = array(
		'id_kelas'		=> $idkelas,
		'nama_psep_mapel'	=> $mapel
	);
	$this->db->where("id_psep_mapel", $idpsepmapel);
	$this->db->update("psep_mapel", $data);
}

function hapus_mapel($idpsepmapel){
	$this->db->delete('psep_mapel', array('id_psep_mapel' => $idpsepmapel));
}

function fetch_bab_by_mapel_kurikulum_and_tahun_ajaran($idpsepmapel, $kurikulum, $tahunajaran){
	if($kurikulum == '0' and $tahunajaran == '0'){
		$this->db->select("*");
		$this->db->from("psep_bab");
		$this->db->join("psep_mapel", "psep_bab.id_psep_mapel = psep_mapel.id_psep_mapel", "left");
		$this->db->join("tahun_ajaran", "psep_bab.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran", "left");
		$this->db->join("kelas", "psep_mapel.id_kelas = kelas.id_kelas", "left");
		$this->db->join("login_sekolah", "psep_bab.id_login = login_sekolah.id_login_sekolah", "left");
		$this->db->where("psep_mapel.id_psep_mapel", $idpsepmapel);
		$this->db->order_by("psep_bab.id_tahun_ajaran");
		$this->db->order_by("psep_bab.kurikulum");
		$this->db->order_by("psep_bab.nama_psep_bab");
		
		$query = $this->db->get();
		return $query->result();
	}elseif($kurikulum !== '0' and $tahunajaran == '0'){
		$this->db->select("*");
		$this->db->from("psep_bab");
		$this->db->join("psep_mapel", "psep_bab.id_psep_mapel = psep_mapel.id_psep_mapel", "left");
		$this->db->join("tahun_ajaran", "psep_bab.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran", "left");
		$this->db->join("kelas", "psep_mapel.id_kelas = kelas.id_kelas", "left");
		$this->db->join("login_sekolah", "psep_bab.id_login = login_sekolah.id_login_sekolah", "left");
		$this->db->where("psep_mapel.id_psep_mapel", $idpsepmapel);
		$this->db->where("psep_bab.kurikulum", $kurikulum);
		$this->db->order_by("psep_bab.id_tahun_ajaran");
		$this->db->order_by("psep_bab.kurikulum");
		$this->db->order_by("psep_bab.nama_psep_bab");
		
		$query = $this->db->get();
		return $query->result();
	}elseif($kurikulum == '0' and $tahunajaran !== '0'){
		$this->db->select("*");
		$this->db->from("psep_bab");
		$this->db->join("psep_mapel", "psep_bab.id_psep_mapel = psep_mapel.id_psep_mapel", "left");
		$this->db->join("tahun_ajaran", "psep_bab.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran", "left");
		$this->db->join("kelas", "psep_mapel.id_kelas = kelas.id_kelas", "left");
		$this->db->join("login_sekolah", "psep_bab.id_login = login_sekolah.id_login_sekolah", "left");
		$this->db->where("psep_mapel.id_psep_mapel", $idpsepmapel);
		$this->db->where("psep_bab.id_tahun_ajaran", $tahunajaran);
		$this->db->order_by("psep_bab.id_tahun_ajaran");
		$this->db->order_by("psep_bab.kurikulum");
		$this->db->order_by("psep_bab.nama_psep_bab");
		
		$query = $this->db->get();
		return $query->result();
	}elseif($kurikulum !== '0' and $tahunajaran !== '0'){
		$this->db->select("*");
		$this->db->from("psep_bab");
		$this->db->join("psep_mapel", "psep_bab.id_psep_mapel = psep_mapel.id_psep_mapel", "left");
		$this->db->join("tahun_ajaran", "psep_bab.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran", "left");
		$this->db->join("kelas", "psep_mapel.id_kelas = kelas.id_kelas", "left");
		$this->db->join("login_sekolah", "psep_bab.id_login = login_sekolah.id_login_sekolah", "left");
		$this->db->where("psep_mapel.id_psep_mapel", $idpsepmapel);
		$this->db->where("psep_bab.id_tahun_ajaran", $tahunajaran);
		$this->db->where("psep_bab.kurikulum", $kurikulum);
		$this->db->order_by("psep_bab.id_tahun_ajaran");
		$this->db->order_by("psep_bab.kurikulum");
		$this->db->order_by("psep_bab.nama_psep_bab");
		
		$query = $this->db->get();
		return $query->result();
	}
}

function tambah_bab($idpsepmapel, $kurikulum, $bab, $tahunajaran, $semester, $idlogin){
	$data = array(
		"id_psep_mapel"		=> $idpsepmapel,
		"kurikulum"			=> $kurikulum,
		"nama_psep_bab"		=> $bab,
		"id_tahun_ajaran"	=> $tahunajaran,
		"id_login"			=> $idlogin,
		"semester"			=> $semester
	);
	$this->db->insert("psep_bab", $data);
}
function fetch_psep_bab_by_id($idpsepbab){
	$this->db->select("*");
	$this->db->from("psep_bab");
	$this->db->join("psep_mapel", "psep_bab.id_psep_mapel = psep_mapel.id_psep_mapel", "left");
	$this->db->join("tahun_ajaran", "psep_bab.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran", "left");
	$this->db->join("kelas", "psep_mapel.id_kelas = kelas.id_kelas", "left");
	$this->db->join("login_sekolah", "psep_bab.id_login = login_sekolah.id_login_sekolah", "left");
	$this->db->where("psep_bab.id_psep_bab", $idpsepbab);
	
	$query = $this->db->get();
	return $query->row();
}

function edit_bab($idpsepbab, $idpsepmapel, $kurikulum, $bab, $tahunajaran, $semester){
	$data = array(
		"id_psep_mapel"		=> $idpsepmapel,
		"kurikulum"			=> $kurikulum,
		"nama_psep_bab"		=> $bab,
		"id_tahun_ajaran"	=> $tahunajaran,
		"semester"			=> $semester
	);
	$this->db->where("id_psep_bab", $idpsepbab);
	$this->db->update("psep_bab", $data);
}

function hapus_bab($idpsepbab){
	$this->db->where("id_psep_bab", $idpsepbab);
	$this->db->delete("psep_bab");
}

function fetch_sub_by_bab($idpsepbab){
	$this->db->select("*");
	$this->db->from("psep_sub_bab");
	$this->db->where("id_psep_bab", $idpsepbab);
	
	$query = $this->db->get();
	return $query->result();
}

function tambah_sub_bab($idpsepbab, $namasub){
	$data = array(
		"id_psep_bab"			=> $idpsepbab,
		"nama_psep_sub_bab"		=> $namasub,
		"id_login"				=> $this->session->userdata('idpsepsekolah')
	);
	$this->db->insert("psep_sub_bab", $data);
}

function fetch_sub_by_id($idpsepsub){
	$this->db->select("*");
	$this->db->from("psep_sub_bab");
	$this->db->where("id_psep_sub_bab", $idpsepsub);

	$query = $this->db->get();
	return $query->row();
}

function edit_sub($idpsepsub, $namasub){
	$data = array(
		"nama_psep_sub_bab"	=> $namasub
	);
	$this->db->where("id_psep_sub_bab", $idpsepsub);
	$this->db->update("psep_sub_bab", $data);
}

function tambah_kd($idpsepmapel, $idtahunajaran, $semester, $ki, $kd, $deskripsi){
	$data = array(
		"id_psep_mapel"		=> $idpsepmapel,
		"id_tahun_ajaran"	=> $idtahunajaran,
		"semester"			=> $semester,
		"ki"				=> $ki,
		"no_kd"				=> $kd,
		"kompetensi_dasar"	=> $deskripsi,
		"id_guru"			=> $this->session->userdata('idpsepsekolah')
	);
	$this->db->insert("psep_kd", $data);
}

function fetch_kd_by_mapel_and_tahun_ajaran($idpsepmapel, $idtahunajaran){
	$this->db->select("*");
	$this->db->from("psep_kd");
	$this->db->join("psep_mapel", "psep_kd.id_psep_mapel = psep_mapel.id_psep_mapel", "left");
	$this->db->join("tahun_ajaran", "psep_kd.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran", "left");
	$this->db->where("psep_kd.id_psep_mapel", $idpsepmapel);
	$this->db->where("psep_kd.id_tahun_ajaran", $idtahunajaran);
	$this->db->order_by("psep_kd.semester", "ASC");
	$this->db->order_by("psep_kd.ki", "ASC");
	$this->db->order_by("psep_kd.no_kd", "ASC");

	$query = $this->db->get();
	return $query->result();
}

function fetch_kd_by_id($idkd){
	$this->db->select("*");
	$this->db->from("psep_kd");
	$this->db->join("psep_mapel", "psep_kd.id_psep_mapel = psep_mapel.id_psep_mapel", "left");
	$this->db->join("kelas", "psep_mapel.id_kelas = kelas.id_kelas", "left");
	$this->db->join("tahun_ajaran", "psep_kd.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran", "left");
	$this->db->where("id_kd", $idkd);

	$query = $this->db->get();
	return $query->row();
}

function proses_edit_kd($idkd, $idpsepmapel, $idtahunajaran, $semester, $ki, $kd, $deskripsi){
	$data = array(
		"id_psep_mapel"		=> $idpsepmapel,
		"id_tahun_ajaran"	=> $idtahunajaran,
		"semester"			=> $semester,
		"ki"				=> $ki,
		"no_kd"				=> $kd,
		"kompetensi_dasar"	=> $deskripsi
	);
	$this->db->where("id_kd", $idkd);
	$this->db->update("psep_kd", $data);
}

function hapus_kd($idkd){
	$this->db->where("id_kd", $idkd);
	$this->db->delete("psep_kd");
}

function fetch_bab_by_mapel_and_tahun_ajaran($idmapel = null, $idtahunajaran = null){
	$this->db->select("*");
	$this->db->from("psep_bab");
	$this->db->join("psep_mapel", "psep_bab.id_psep_mapel = psep_mapel.id_psep_mapel", "left");
	$this->db->join("tahun_ajaran", "psep_bab.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran", "left");
	$this->db->join("kelas", "psep_mapel.id_kelas = kelas.id_kelas", "left");
	$this->db->join("login_sekolah", "psep_bab.id_login = login_sekolah.id_login_sekolah", "left");
	if($idmapel !== null){
		$this->db->where("psep_mapel.id_psep_mapel", $idmapel);
	}
	if($idtahunajaran !== null){
		$this->db->where("psep_bab.id_tahun_ajaran", $idtahunajaran);
	}
	$this->db->order_by("psep_bab.nama_psep_bab");
	
	$query = $this->db->get();
	return $query->result();
}

//FUNGSI UNTUK BANK SOAL 
//#########################################
//#########################################
//#########################################
function tambah_bank_soal($idsub, $soal, $kunci, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $bahas){
	$data = array(
		'id_psep_sub_bab' 	=> $idsub,
		'soal'				=> $soal,
		'kunci'				=> $kunci,
		'jawab_1'			=> $jawab1,
		'jawab_2'			=> $jawab2,
		'jawab_3'			=> $jawab3,
		'jawab_4'			=> $jawab4,
		'jawab_5'			=> $jawab5,
		'pembahasan'		=> $bahas,
		'id_guru'			=> $this->session->userdata('idpsepsekolah')
	);
	$this->db->insert("bank_soal_sekolah", $data);
}

function filter_bank_soal($kelas = null, $mapel = null, $tahun = null, $bab = null, $sub = null){
	$this->db->select("*");
	$this->db->from("bank_soal_sekolah");
	$this->db->join("psep_sub_bab", "bank_soal_sekolah.id_psep_sub_bab = psep_sub_bab.id_psep_sub_bab", "left");
	$this->db->join("psep_bab", "psep_sub_bab.id_psep_bab = psep_bab.id_psep_bab", "left");
	$this->db->join("tahun_ajaran", "psep_bab.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran", "left");
	$this->db->join("psep_mapel", "psep_bab.id_psep_mapel = psep_mapel.id_psep_mapel", "left");
	$this->db->join("kelas", "psep_mapel.id_kelas = kelas.id_kelas", "left");

	if($kelas !== null){
		$this->db->where("kelas.id_kelas", $kelas);
	}
	if($mapel !== null){
		$this->db->where("psep_mapel.id_psep_mapel", $mapel);
	}
	if($tahun !== null){
		$this->db->where("tahun_ajaran.id_tahun_ajaran", $tahun);
	}
	if($bab !== null){
		$this->db->where("psep_bab.id_psep_bab", $bab);
	}
	if($sub !== null){
		$this->db->where("psep_sub_bab.id_psep_sub_bab", $sub);
	}

	$query = $this->db->get();
	return $query->result();
}


//END FUNGSI UNTUK BANK SOAL 
//#########################################
//#########################################
//#########################################

}
?>