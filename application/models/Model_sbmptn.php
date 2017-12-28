<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_sbmptn extends CI_Model
{

	private $insert_id;

	function __construct()
	{
		parent::__construct();
	}

function insert_paket($paket){
	$data = array(
		'nama_paket_sbmptn' 		=> $paket
		);
	$this->db->insert('paket_sbmptn', $data);
}

function fetch_paket_sbmptn(){
	$this->db->select("*");
	$this->db->from("paket_sbmptn");
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_paket_by_id($idpaket){
	$this->db->select("*");
	$this->db->from("paket_sbmptn");
	$this->db->where("id_paket_sbmptn", $idpaket);
	
	$query = $this->db->get();
	return $query->row();
}

function fetch_panlok(){
	$this->db->select("*");
	$this->db->from("panlok");
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_ptn(){
	$this->db->select("*");
	$this->db->from("ptn");
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_ptn_by_panlok($idpanlok){
	$this->db->select("*");
	$this->db->from("ptn");
	$this->db->where("id_panlok", $idpanlok);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_prodi_by_ptn($idptn){
	$this->db->select("*");
	$this->db->from("program_studi");
	$this->db->where("id_ptn", $idptn);
	
	$query = $this->db->get();
	return $query->result();
}

function insert_set_prodi($idpaket, $idsiswa, $idprodi){
	$data = array(
		'id_paket' 		=> $idpaket,
		'id_siswa'		=> $idsiswa,
		'id_prodi'		=> $idprodi
	);
	$this->db->insert('set_prodi', $data);
}

function cek_set_prodi_by_paket($idpaket, $idsiswa){
	$this->db->select("*");
	$this->db->from("set_prodi");
	$this->db->where("id_paket", $idpaket);
	$this->db->where("id_siswa", $idsiswa);
	
	$result = $this->db->count_all_results();
	return $result;
}

function fetch_set_prodi_by_paket($idpaket, $idsiswa){
	$this->db->select("*");
	$this->db->from("set_prodi");
	$this->db->join("program_studi", "set_prodi.id_prodi = program_studi.id_prodi");
	$this->db->join("ptn", "program_studi.id_ptn = ptn.id_ptn", "left");
	$this->db->join("panlok", "ptn.id_panlok = panlok.id_panlok", "left");
	$this->db->join("provinsi", "ptn.id_provinsi = provinsi.id_provinsi");
	$this->db->where("id_paket", $idpaket);
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("set_prodi.id_prodi !=", 0);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_profil_by_jenis_and_paket($idpaketsbmptn, $jenis){
	$this->db->select("*");
	$this->db->from("profil_tryout");
	$this->db->where("id_paket_sbmptn", $idpaketsbmptn);
	$this->db->where("jenis", $jenis);
	if($this->db->count_all_results() > 0 ){
		$this->db->select("*");
		$this->db->from("profil_tryout");
		$this->db->where("id_paket_sbmptn", $idpaketsbmptn);
		$this->db->where("jenis", $jenis);
		
		$query = $this->db->get();
		return $query->row();
	}else{
		return null;
	}
}

function fetch_set_panlok($idpaket, $idsiswa){
	$this->db->select("*");
	$this->db->from("set_prodi");
	$this->db->join("program_studi", "set_prodi.id_prodi = program_studi.id_prodi");
	$this->db->join("ptn", "program_studi.id_ptn = ptn.id_ptn");
	$this->db->join("panlok", "ptn.id_panlok = panlok.id_panlok", "left");
	$this->db->where("id_paket", $idpaket);
	$this->db->where("id_siswa", $idsiswa);
	
	$query = $this->db->get();
	return $query->row();
}
function get_tryout_by_profil($idprofil){
	$this->db->select("*");
	$this->db->from("kategori_tryout");
	$this->db->join("profil_tryout", "kategori_tryout.id_profil=profil_tryout.id_tryout", "left");
	$this->db->join("kelas", "profil_tryout.id_kelas=kelas.id_kelas", "left");
	$this->db->where("profil_tryout.id_tryout", $idprofil);
	$this->db->where("kategori_tryout.status", 1);
	
	$result = $this->db->count_all_results();
	return $result;
}

function get_tryout_by_profil2($idprofil){
	$this->db->select("*");
	$this->db->from("kategori_tryout");
	$this->db->join("profil_tryout", "kategori_tryout.id_profil=profil_tryout.id_tryout", "left");
	$this->db->join("kelas", "profil_tryout.id_kelas=kelas.id_kelas", "left");
	$this->db->where("profil_tryout.id_tryout", $idprofil);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_set_kelompok_hasil($kelompok){
	$this->db->select("*");
	$this->db->from("set_prodi");
	$this->db->join("program_studi", "set_prodi.id_prodi=program_studi.id_prodi");
	$this->db->where("program_studi.kelompok", $kelompok);
	$this->db->group_by("set_prodi.id_siswa");
	
	$query = $this->db->get();
	return $query->result();
}

function cek_tuntas_siswa($idsiswa, $idkategori){
	$this->db->select("*");
	$this->db->from("analisis_pelajaran");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("id_kategori", $idkategori);
	
	$result = $this->db->count_all_results();
	return $result;
}

}