<?php 

class Model_psep_cbt extends CI_Model{
	function __construct(){

		parent::__construct();
	}

function fetch_cbt_by_jenjang($jenjang){
	$this->db->select("*");
	$this->db->from("profil_tryout");
	$this->db->join("kelas", "profil_tryout.id_kelas = kelas.id_kelas");
	$this->db->where("kelas.jenjang", $jenjang);
	$this->db->where("profil_tryout.tipe", 0)->or_where("profil_tryout.tipe", 2);
	
	$query = $this->db->get();
	return $query->result();
}

function tambah_jadwal($idtryout, $kelas, $tahun, $startdate, $enddate){
	$data = array(
		'id_profil'			=> $idtryout,
		'id_kelas_paralel'	=> $kelas,
		'id_tahun_ajaran'	=> $tahun,
		'startdate'			=> $startdate,
		'enddate'			=> $enddate
	);
	$this->db->insert("cbt_sekolah", $data);
}


function fetch_jadwal_by_profil($idprofil, $idsekolah){
	$this->db->select("*");
	$this->db->from("cbt_sekolah");
	$this->db->join("kelas_paralel", "cbt_sekolah.id_kelas_paralel = kelas_paralel.id_kelas_paralel", "left");
	$this->db->join("tahun_ajaran", "cbt_sekolah.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran", "left");
	$this->db->where("cbt_sekolah.id_profil", $idprofil);
	$this->db->where("kelas_paralel.id_sekolah", $idsekolah);
	$query = $this->db->get();
	return $query->result();
}

function hapus_jadwal($idcbtsekolah){
	$this->db->where('id_cbt_sekolah', $idcbtsekolah);
	$this->db->delete('cbt_sekolah');
}

function fetch_kategori_by_profil($idprofil){
	$this->db->select("*");
	$this->db->from("kategori_tryout");
	$this->db->where("id_profil", $idprofil);

	$query = $this->db->get();
	return $query->result();
}

function cek_kkm($idkategori, $idsekolah){
	$this->db->select("*");
	$this->db->from("kkm_cbt_psep");
	$this->db->where("id_kategori", $idkategori);
	$this->db->where("id_sekolah", $idsekolah);

	$query = $this->db->get();
	return $query->row();
}

function fetch_kategori_by_id($idkategori){
	$this->db->select("*");
	$this->db->from("kategori_tryout");
	$this->db->where("id_kategori", $idkategori);

	$query = $this->db->get();
	return $query->row();
}

function set_kkm($idsekolah, $idkategori, $kkm){
	$this->db->select("*");
	$this->db->from("kkm_cbt_psep");
	$this->db->where("id_kategori", $idkategori);
	$this->db->where("id_sekolah", $idsekolah);
	$cek = $this->db->count_all_results();

	if($cek > 0){
		$data = array(
			'ketuntasan'	=> $kkm
		);
		$this->db->where("id_sekolah", $idsekolah);
		$this->db->where("id_kategori", $idkategori);
		$this->db->update("kkm_cbt_psep", $data);
	}else{
		$data = array(
			'id_sekolah'	=> $idsekolah,
			'id_kategori'	=> $idkategori,
			'ketuntasan'	=> $kkm
		);
		$this->db->insert("kkm_cbt_psep", $data);
	}
}

function fetch_cbt_berlangsung($idkelasparalel, $idtahunajaran){
	$today = date("Y-m-d H:i:s");
	$jam   = date("H:i:s");
	$this->db->select("*");
	$this->db->from("cbt_sekolah");
	$this->db->join("profil_tryout", "cbt_sekolah.id_profil = profil_tryout.id_tryout", "left");
	$this->db->where("cbt_sekolah.id_kelas_paralel", $idkelasparalel);
	$this->db->where("cbt_sekolah.id_tahun_ajaran", $idtahunajaran);
	$this->db->where("cbt_sekolah.startdate <=", $today);
	$this->db->where("cbt_sekolah.enddate >=", $today);
	$this->db->order_by("startdate", "ASC");

	$query = $this->db->get();
	return $query->result();
}

function fetch_cbt_psep_by_id_profil($idprofil, $idsekolah){
	$this->db->select("*");
	$this->db->from("cbt_psep");
	$this->db->where("id_profil", $idprofil);
	$this->db->where("id_sekolah", $idsekolah);
	
	return $this->db->count_all_results();
}


function cek_akses_pembahasan($idprofil, $idkelasparalel, $idtahunajaran){
	$this->db->select("*");
	$this->db->from("cbt_sekolah_bahas");
	$this->db->where("id_profil", $idprofil);
	$this->db->where("id_kelas_paralel", $idkelasparalel);
	$this->db->where("id_tahun_ajaran", $idtahunajaran);

	return $this->db->count_all_results();
}

function tambah_akses_bahas($idprofil, $idkelasparalel, $idtahunajaran, $date){
	$data = array(
		'id_profil'			=> $idprofil,
		'id_kelas_paralel' 	=> $idkelasparalel,
		'id_tahun_ajaran'	=> $idtahunajaran,
		'bahasdate'			=> $date
	);
	$this->db->insert("cbt_sekolah_bahas", $data);
}

function fetch_akses_bahas_by_profil($idprofil, $idsekolah){
	$this->db->select("*");
	$this->db->from("cbt_sekolah_bahas");

	$this->db->join("kelas_paralel", "kelas_paralel.id_kelas_paralel = cbt_sekolah_bahas.id_kelas_paralel", "left");
	$this->db->join("tahun_ajaran", "tahun_ajaran.id_tahun_ajaran = cbt_sekolah_bahas.id_tahun_ajaran", "left");
	$this->db->join("sekolah", "kelas_paralel.id_sekolah = sekolah.id_sekolah", "left");

	$this->db->where("sekolah.id_sekolah", $idsekolah);
	$this->db->where("cbt_sekolah_bahas.id_profil", $idprofil);

	$query = $this->db->get();
	return $query->result();
}


function hapus_bahas($idbahas){
	$this->db->where("id_cbt_sekolah_bahas", $idbahas);
	$this->db->delete("cbt_sekolah_bahas");
}

function fetch_cbt_bahas($idkelasparalel, $idtahunajaran){
	$today = date("Y-m-d H:i:s");
	$jam   = date("H:i:s");
	$this->db->select("*");
	$this->db->from("cbt_sekolah_bahas");
	$this->db->join("profil_tryout", "cbt_sekolah_bahas.id_profil = profil_tryout.id_tryout", "left");
	$this->db->where("cbt_sekolah_bahas.id_kelas_paralel", $idkelasparalel);
	$this->db->where("cbt_sekolah_bahas.id_tahun_ajaran", $idtahunajaran);
	$this->db->where("cbt_sekolah_bahas.bahasdate <=", $today);
	$this->db->order_by("bahasdate", "ASC");

	$query = $this->db->get();
	return $query->result();
}

function cek_kelas_and_tahun_siswa($idsiswa, $idkelasparalel, $idtahunajaran){
	$this->db->select("*");
	$this->db->from("siswa_psep");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_kelas_paralel", $idkelasparalel);
	$this->db->where("id_tahun_ajaran", $idtahunajaran);

	return $this->db->count_all_results();
}

}
?>