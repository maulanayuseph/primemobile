<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_keuangan extends CI_Model
{

	private $insert_id;

	function __construct()
	{
		parent::__construct();
	}

function fetch_all_tagihan(){
	$this->db->select("*");
	$this->db->from("pembelian_x_sekolah");
	$this->db->join("pembelian", "pembelian_x_sekolah.id_pembelian = pembelian.id_pembelian");
	$this->db->join("sekolah", "pembelian_x_sekolah.id_sekolah = sekolah.id_sekolah");
	$this->db->order_by("pembelian.id_pembelian", "DESC");
	$query = $this->db->get();
	return $query->result();
}

function fetch_detail_by_id_pembelian($idpembelian){
	$this->db->select("*");
	$this->db->from("pembelian_detail");
	$this->db->where("pembelian_id", $idpembelian);

	$query = $this->db->get();
	return $query->result();
}

function fetch_detal_and_kelas_by_id_pembelian($idpembelian){
	$this->db->select("*");
	$this->db->from("pembelian_detail");
	$this->db->join("paket", "pembelian_detail.paket_id = paket.id_paket");
	$this->db->join("kelas_paralel", "pembelian_detail.id_kelas_paralel = kelas_paralel.id_kelas_paralel");
	$this->db->join("tahun_ajaran", "pembelian_detail.id_tahun_ajaran = tahun_ajaran.id_tahun_ajaran");
	$this->db->where("pembelian_id", $idpembelian);

	$query = $this->db->get();
	return $query->result();
}

function fetch_all_provinsi(){
	$this->db->select("*");
	$this->db->from("provinsi");
	$query = $this->db->get();
	return $query->result();
}

function fetch_kota_by_provinsi($idprovinsi){
	$this->db->select("*");
	$this->db->from("kota_kabupaten");
	$this->db->where("provinsi_id", $idprovinsi);

	$query = $this->db->get();
	return $query->result();
}

function fetch_sekolah_by_kota($idkota){
	$this->db->select("*");
	$this->db->from("sekolah");
	$this->db->where("kota_id", $idkota);

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

function fetch_tahun_ajaran_by_sekolah($idsekolah){
	$this->db->select("*");
	$this->db->from("tahun_ajaran");
	$this->db->where("id_sekolah", $idsekolah);

	$query = $this->db->get();
	return $query->result();
}

function fetch_paket(){
	$this->db->select("*");
	$this->db->from("paket");

	$query = $this->db->get();
	return $query->result();
}

function fetch_event_berlangsung(){
	$today = date("Y-m-d");
	$this->db->select("*");
	$this->db->from("event");
	$this->db->where("status", 1);
	$this->db->where("end_date >", $today);

	$query = $this->db->get();
	return $query->result();
}

function fetch_paket_by_id($idpaket){
	$this->db->select("*");
	$this->db->from("paket");
	$this->db->where("id_paket", $idpaket);

	$query = $this->db->get();
	return $query->row();
}

function fetch_event_by_id($idevent){
	$this->db->select("*");
	$this->db->from("event");
	$this->db->where("id_event", $idevent);

	$query = $this->db->get();
	return $query->row();
}

function fetch_kelas_paralel_by_id($idkelasparalel){
	$this->db->select("*");
	$this->db->from("kelas_paralel");
	$this->db->where("id_kelas_paralel", $idkelasparalel);

	$query = $this->db->get();
	return $query->row();
}

function fetch_tahun_ajaran_by_id($idtahunajaran){
	$this->db->select("*");
	$this->db->from("tahun_ajaran");
	$this->db->where("id_tahun_ajaran", $idtahunajaran);

	$query = $this->db->get();
	return $query->row();
}

function fetch_jumlah_siswa_kelas_psep($idkelasparalel, $idtahunajaran){
	$this->db->select("*");
	$this->db->from("siswa_psep");
	$this->db->where("id_kelas_paralel", $idkelasparalel);
	$this->db->where("id_tahun_ajaran", $idtahunajaran);

	return $this->db->count_all_results();
}


function simpan_tagihan($totalharga, $email, $nama, $hp, $idevent, $idsekolah){
	$now 	= new DateTime(null);
	//Set interval 2 hari untuk batas waktu pembayaran
	$now->add(new DateInterval('P2D'));
	$expired = $now->format("Y-m-d H:i:00");

	$data = array(
		'metode_pembayaran'		=> 1,
		'total_harga'			=> $totalharga,
		'status'				=> 0,
		'timestamp'				=> $now->format("Y-m-d H:i:00"),
		'expired_on'			=> $expired,
		'email'					=> $email,
		'nama'					=> $nama,
		'no_hp'					=> $hp,
		'id_event'				=> $idevent,
		'id_adm'				=> $this->session->userdata("id_admin")
	);
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
	}

	return $idpembelian;
}

function insert_pembelian_detail($idpembelian, $idkelasparalel, $idtahunajaran, $idpaket, $jumsis, $hargasatuan){
	$data = array(
		'pembelian_id'			=> $idpembelian,
		'id_kelas_paralel' 		=> $idkelasparalel,
		'id_tahun_ajaran'		=> $idtahunajaran,
		'paket_id'				=> $idpaket,
		'jumlah'				=> $jumsis,
		'harga_satuan'			=> $hargasatuan
	);
	$this->db->insert("pembelian_detail", $data);
}

function fetch_sekolah_by_id($idsekolah){
	$this->db->select("*");
	$this->db->from("sekolah");
	$this->db->where("id_sekolah", $idsekolah);

	$query = $this->db->get();
	return $query->row();
}

function insert_payment_tracking($idpembelian, $type, $xml){
	$data = array(
		'id_pembelian'	=> $idpembelian,
		'type'			=> $type,
		'xml'			=> $xml
	);
	$this->db->insert("payment_tracking", $data);
}

function edit_vaid($idpembelian, $vaid){
	$data= array(
		'vaid'	=> $vaid
	);
	$this->db->where("id_pembelian", $idpembelian);
	$this->db->update("pembelian", $data);
}

function fetch_tagihan_by_id($idpembelian){
	$this->db->select("*");
	$this->db->from("pembelian");
	$this->db->join("pembelian_x_sekolah", "pembelian.id_pembelian = pembelian_x_sekolah.id_pembelian");
	$this->db->join("sekolah", "pembelian_x_sekolah.id_sekolah = sekolah.id_sekolah");
	$this->db->join("kota_kabupaten", "sekolah.kota_id = kota_kabupaten.id_kota");
	$this->db->join("provinsi", "kota_kabupaten.provinsi_id = provinsi.id_provinsi");
	$this->db->where("pembelian.id_pembelian", $idpembelian);

	$query = $this->db->get();
	return $query->row();
}

function delete_pembelian($idpembelian){
	$this->db->where("id_pembelian", $idpembelian);
	$this->db->delete("pembelian");
}

function fetch_tagihan_by_event_and_siswa($idevent, $idsiswa){
	$this->db->select("*");
	$this->db->from("pembelian");
	$this->db->where("siswa_id", $idsiswa);
	$this->db->where("id_event", $idevent);

	$query = $this->db->get();
	return $query->row();
}

}

?>