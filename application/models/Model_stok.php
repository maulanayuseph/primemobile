<?php 

/**
* 
*/
class Model_stok extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get_paket_stok(){
		$this->db->select('paket.*, COUNT(voucher.kode_voucher) AS jumlah');
		$this->db->from('paket');
		$this->db->join('voucher', 'voucher.paket_id = paket.id_paket', 'LEFT');
		$this->db->like('voucher.ket', 'online');
		$this->db->where('voucher.status', '0');
		$this->db->where('voucher.id_pembelian', '0');
		$this->db->where('paket.id_paket !=', '20');
		$this->db->group_by('paket.id_paket');
		$query = $this->db->get();
		
		return $query->result();
	}

}
