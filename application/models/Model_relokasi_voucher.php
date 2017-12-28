<?php 
class Model_relokasi_voucher extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

function fetch_all_paket(){
	$this->db->select("*");
	$this->db->from("paket");
	$result = $this->db->get();
	return $result->result();
}

function fetch_voucher_by_paket($idpaket){
	$this->db->select("*");
	$this->db->from("voucher");
	$this->db->where("paket_id", $idpaket);
	$this->db->where("status", 0);
	$this->db->where("id_pembelian", 0);
	$this->db->order_by("kode_voucher", "DESC");

	$result = $this->db->get();
	return $result->result();
}

function update_paket($kodevoucher, $idpaket){
	$data = array(
		'paket_id'	=> $idpaket
	);
	$this->db->where("kode_voucher", $kodevoucher);
	$this->db->update("voucher", $data);
}
}
?>