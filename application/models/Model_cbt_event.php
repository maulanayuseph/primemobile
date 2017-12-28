<?php 
class Model_cbt_event extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

function cek_event($idevent){
	$this->db->select("*");
	$this->db->from("event");
	$this->db->where("id_event", $idevent);
	$result = $this->db->get();
	return $result->row();
}

function cek_aktivasi_event_siswa($idsiswa, $idevent){
	$this->db->select("*");
	$this->db->from("paket_aktif");
	$this->db->join("siswa", "paket_aktif.id_siswa = siswa.id_siswa", "left");
	$this->db->join("event_x_voucher", "paket_aktif.kode_voucher = event_x_voucher.kode_voucher", "left");
	$this->db->where("event_x_voucher.id_event", $idevent);
	$this->db->where("paket_aktif.id_siswa", $idsiswa);

	return $this->db->count_all_results();
}

function cek_pembelian_aktivasi_event($idsiswa, $idevent){
	$today = date("Y-m-d H:i:s");
	$this->db->select("*");
	$this->db->from("pembelian");
	$this->db->where("siswa_id", $idsiswa);
	$this->db->where("id_event", $idevent);
	$this->db->where("expired_on >=", $today);

	$result = $this->db->get();
	return $result->row();
}

function cek_pembelian_aktivasi_event_not_cancel($idsiswa, $idevent){
	$today = date("Y-m-d H:i:s");
	$this->db->select("*");
	$this->db->from("pembelian");
	$this->db->where("siswa_id", $idsiswa);
	$this->db->where("id_event", $idevent);
	$this->db->where("expired_on >=", $today);
	$this->db->where("status !=", 3);

	$result = $this->db->get();
	return $result->row();
}

function cek_verifikasi($idsiswa, $idevent){
	$today = date("Y-m-d H:i:s");
	$this->db->select("*");
	$this->db->from("pembelian");
	$this->db->where("siswa_id", $idsiswa);
	$this->db->where("id_event", $idevent);
	$this->db->where("status", 2);

	$result = $this->db->get();
	return $result->row();
}

function fetch_event_by_id($idevent){
	$this->db->select("*");
	$this->db->from("event");
	$this->db->where("id_event", $idevent);

	$result = $this->db->get();
	return $result->row();
}

function fetch_cbt_by_event($idevent){
	$this->db->select("*");
	$this->db->from("event_x_cbt");
	$this->db->join("profil_tryout", "event_x_cbt.id_profil = profil_tryout.id_tryout", "left");
	$this->db->join("kelas", "kelas.id_kelas=profil_tryout.id_kelas", "left");
	$this->db->where("id_event", $idevent);
	$result=$this->db->get();
	return $result->result();
}

function fetch_cbt_berlangsung($idsekolah){
	$today = date("Y-m-d H:i:s");
	$jam   = date("H:i:s");
	$this->db->select("*");
	$this->db->from("jadwal_event_cbt");
	$this->db->join("profil_tryout", "jadwal_event_cbt.id_profil = profil_tryout.id_tryout", "left");
	$this->db->where("jadwal_event_cbt.id_sekolah", $idsekolah);
	$this->db->where("jadwal_event_cbt.start_date <=", $today);
	$this->db->where("jadwal_event_cbt.end_date >=", $today);
	$this->db->order_by("jadwal_event_cbt.start_date", "ASC");

	$query = $this->db->get();
	return $query->result();
}

function cek_jadwal_sekolah($idsekolah){
	$this->db->select("*");
	$this->db->from("jadwal_event_cbt");
	$this->db->where("id_sekolah", $idsekolah);
	return $this->db->count_all_results();
}

function fetch_aktivasi_event_aktif($idevent, $idsiswa){
	$today = date("Y-m-d H:i:s");
	$this->db->select("*");
	$this->db->from("paket_aktif");
	$this->db->join("siswa", "paket_aktif.id_siswa = siswa.id_siswa", "left");
	$this->db->join("event_x_voucher", "paket_aktif.kode_voucher = event_x_voucher.kode_voucher", "left");
	$this->db->where("event_x_voucher.id_event", $idevent);
	$this->db->where("paket_aktif.id_siswa", $idsiswa);
	$this->db->where("paket_aktif.expired_on >=", $today);

	return $this->db->count_all_results();
}

}
?>