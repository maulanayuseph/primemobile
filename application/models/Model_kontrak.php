<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_kontrak extends CI_Model
{

	private $insert_id;

	function __construct()
	{
		parent::__construct();
	}


function fetch_provinsi(){
	$this->db->select("*");
	$this->db->from("provinsi");
	$this->db->order_by("nama_provinsi", "ASC");
	$query = $this->db->get();
	return $query->result();
}

function fetch_kota_by_provinsi($idprovinsi){
	$this->db->select("*");
	$this->db->from("kota_kabupaten");
	$this->db->where("provinsi_id", $idprovinsi);
	$this->db->order_by("nama_kota", "ASC");
	$query = $this->db->get();
	return $query->result();
}

function fetch_sekolah_by_kota($idkota){
	$this->db->select("*");
	$this->db->from("sekolah");
	$this->db->where("kota_id", $idkota);
	$this->db->order_by("nama_sekolah", "ASC");
	$query = $this->db->get();
	return $query->result();
}

function fetch_akun_sekolah($idsekolah){
	$this->db->select("*");
	$this->db->from("login_sekolah");
	$this->db->where("id_sekolah", $idsekolah);

	$query = $this->db->get();
	return $query->result();
}

function fetch_sekolah_by_id($idsekolah){
	$this->db->select("*");
	$this->db->from("sekolah");
	$this->db->where("id_sekolah", $idsekolah);

	$query = $this->db->get();
	return $query->row();
}

function fetch_kelas_by_jenjang($jenjang){
	$this->db->select("*");
	$this->db->from("kelas");
	$this->db->where("jenjang", $jenjang);

	$query = $this->db->get();
	return $query->result();
}

function fetch_tahun_ajaran_by_sekolah($idsekolah){
	$this->db->select("*");
	$this->db->from("tahun_ajaran");
	$this->db->where("id_sekolah", $idsekolah);

	$query = $this->db->get();
	return $query->result();
}

function fetch_kelas_by_id($idkelas){
	$this->db->select("*");
	$this->db->from("kelas");
	$this->db->where("id_kelas", $idkelas);

	$query = $this->db->get();
	return $query->row();
}

function fetch_kelas_paralel_by_kelas_and_sekolah($idsekolah, $idkelas){
	$this->db->select("*");
	$this->db->from("kelas_paralel");
	$this->db->where("id_sekolah", $idsekolah);
	$this->db->where("id_kelas", $idkelas);

	$query = $this->db->get();
	return $query->result();
}

function fetch_tahun_ajaran_by_id($idtahunajaran){
	$this->db->select("*");
	$this->db->from("tahun_ajaran");
	$this->db->where("id_tahun_ajaran", $idtahunajaran);

	$query = $this->db->get();
	return $query->row();
}

function jumlah_siswa_kelas_paralel($idkelasparalel, $idtahunajaran){
	$this->db->select("*");
	$this->db->from("siswa_psep");
	$this->db->where("id_kelas_paralel", $idkelasparalel);
	$this->db->where("id_tahun_ajaran", $idtahunajaran);

	return $this->db->count_all_results();
}

function fetch_admin_pa(){
	$this->db->select("*");	
	$this->db->from("login_adm");
	$this->db->where('level', 'adminpa');

	$query = $this->db->get();
	return $query->result();
}

function jumlah_siswa_psep($idkelasparalel, $idtahunajaran){
	$this->db->select("*");
	$this->db->from("siswa_psep");
	$this->db->where("id_kelas_paralel", $idkelasparalel);
	$this->db->where("id_tahun_ajaran", $idtahunajaran);

	return $this->db->count_all_results();
}

function insert_kontrak($data){
	$this->db->insert("kontrak", $data);
	return $this->db->insert_id();
}

function insert_kontrak_detail($data){
	$this->db->insert("kontrak_detail", $data);
}

function fetch_all_kontrak(){
	$this->db->select("*");
	$this->db->from("kontrak");
	$this->db->join("sekolah", "kontrak.id_sekolah = sekolah.id_sekolah");
	$this->db->join("kota_kabupaten", "sekolah.kota_id = kota_kabupaten.id_kota");
	$this->db->join("provinsi", "kota_kabupaten.provinsi_id = provinsi.id_provinsi");
	$this->db->join("login_adm", "kontrak.pic_pm = login_adm.id_adm");
	$this->db->join("referral", "kontrak.id_referral = referral.id_referral");
	$this->db->where("kontrak.deleted", 0);

	$query = $this->db->get();
	return $query->result();
}


function fetch_kontrak_by_id($idkontrak){
	$this->db->select("*");
	$this->db->from("kontrak");
	$this->db->join("sekolah", "kontrak.id_sekolah = sekolah.id_sekolah");
	$this->db->join("kota_kabupaten", "sekolah.kota_id = kota_kabupaten.id_kota");
	$this->db->join("provinsi", "kota_kabupaten.provinsi_id = provinsi.id_provinsi");
	$this->db->join("login_adm", "kontrak.pic_pm = login_adm.id_adm");
	$this->db->join("referral", "kontrak.id_referral = referral.id_referral");
	$this->db->where("kontrak.id_kontrak", $idkontrak);

	$query = $this->db->get();
	return $query->row();
}

function fetch_detail_kontrak_by_kontrak($idkontrak){
	$this->db->select("*");
	$this->db->from("kontrak_detail");
	$this->db->join("kelas", "kontrak_detail.id_kelas = kelas.id_kelas");
	$this->db->where("id_kontrak", $idkontrak);

	$query = $this->db->get();
	return $query->result();
}

function fetch_referral(){
	$this->db->select("*");
	$this->db->from("referral");

	$query = $this->db->get();
	return $query->result();
}

function edit_kontrak($idkontrak, $data){
	$this->db->where("id_kontrak", $idkontrak);
	$this->db->update("kontrak", $data);
}

function delete_detail_kontrak_by_kontrak($idkontrak){
	$this->db->where("id_kontrak", $idkontrak);
	$this->db->delete("kontrak_detail");
}

function hapus_kontrak($idkontrak){
	$data = array(
		'deleted'	=> 1
	);
	$this->db->where("id_kontrak", $idkontrak);
	$this->db->update("kontrak", $data);
}


function fetch_siswa_psep($idtahunajaran, $idkelasparalel){
	$this->db->select("*");
	$this->db->from("siswa_psep");
	$this->db->where("id_tahun_ajaran", $idtahunajaran);
	$this->db->where("id_kelas_paralel", $idkelasparalel);

	$query = $this->db->get();
	return $query->result();
}

function fetch_kelas_paralel_by_sekolah($idsekolah){
	$this->db->select("*");
	$this->db->from("kelas_paralel");
	$this->db->where("id_sekolah", $idsekolah);

	$query = $this->db->get();
	return $query->result();
}

function edit_tagihan_kontrak_kolektif_siswa($idsiswa, $idpaket){
	$data = array(
		'tagihan'	=> 'kolektif_kontrak',
		'id_paket'	=> $idpaket
	);
	$this->db->where("id_siswa", $idsiswa);
	$this->db->update("siswa", $data);
}
//model untuk cron job
function fetch_kontrak_aktif(){
	$today = date("Y-m-d");
	$this->db->select("*");
	$this->db->from("kontrak");
	$this->db->join("sekolah", "kontrak.id_sekolah = sekolah.id_sekolah");
	$this->db->join("kota_kabupaten", "sekolah.kota_id = kota_kabupaten.id_kota");
	$this->db->join("provinsi", "kota_kabupaten.provinsi_id = provinsi.id_provinsi");
	$this->db->join("login_adm", "kontrak.pic_pm = login_adm.id_adm");
	$this->db->join("referral", "kontrak.id_referral = referral.id_referral");
	$this->db->where("kontrak.deleted", 0);
	$this->db->where("kontrak.status", 1);
	$this->db->where("kontrak.end_date >=", $today);
	$query = $this->db->get();
	return $query->result();
}

function fetch_tahun_ajaran_aktif_by_sekolah($idsekolah){
	$this->db->select("*");
	$this->db->from("tahun_ajaran");
	$this->db->where("id_sekolah", $idsekolah);
	$this->db->where("kontrak_aktif", 1);

	$query = $this->db->get();
	return $query->result();
}

function cek_siswa_kolektif_kontrak($idsiswa){
	$this->db->select("*");
	$this->db->from("siswa");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("tagihan", "kolektif_kontrak");

	return $this->db->count_all_results();
}

function insert_pembelian($data){
	$this->db->insert('pembelian', $data);
	$idpembelian = $this->db->insert_id();
	if($idpembelian){
		$datapembelianxsekolah = array(
			'id_pembelian'	=> $idpembelian,
			'id_sekolah'	=> $idsekolah
		);
		$this->db->insert("pembelian_x_sekolah", $datapembelianxsekolah);
		//pattern id pembelian is PM,month,day,id_pembelian,seconds
		$no_tagihan		= 'PM'.date('md').$idpembelian.date('s');
		$this->db->set('no_tagihan', $no_tagihan);
		$this->db->where('id_pembelian', $idpembelian);
		$this->db->update('pembelian');

		return $idpembelian;
	}else{
		return false;
	}
}

function hapus_pembelian($idpembelian){
	$this->db->where("id_pembelian", $idpembelian);
	$this->db->delete("pembelian");
}

function fetch_detail_kontrak_by_kelas($idkontrak, $idkelas){
	$this->db->select("*");
	$this->db->from("kontrak_detail");
	$this->db->where("id_kontrak", $idkontrak);
	$this->db->where("id_kelas", $idkelas);

	$query = $this->db->get();
	return $query->row();
}

function edit_total_harga_pembelian($idpembelian, $totalharga){
	$data = array(
		'total_harga'		=> $totalharga
	);
	$this->db->where("id_pembelian", $idpembelian);
	$this->db->update("pembelian", $data);

}
//end model cron job

}
?>