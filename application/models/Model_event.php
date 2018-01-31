<?php 

/**
* 
*/
class Model_event extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function simpan($data_pembelian, $item)
	{
		//insert data into table pembelian
		$query = $this->db->insert('pembelian', $data_pembelian);
		
		$pembelian_id = $this->db->insert_id();
		if($pembelian_id)
		{
			$grand_total  = 0;
			$no_tagihan		= 'PM'.date('md').$pembelian_id.date('s'); //pattern is PM,month,day,id_pembelian,seconds  

			$harga = ($item['jumlah'] * $item['harga_satuan']);
			//count grand total
			$grand_total = $grand_total + $harga;
			//insert each item into table pembelian_detail
			$data = array(
				'pembelian_id' => $pembelian_id, 
				'paket_id' 		 => $item['id_paket'], 
				'harga_satuan' => $item['harga_satuan'], 
				'jumlah' 		 	 => $item['jumlah']
				);
			$query = $this->db->insert('pembelian_detail', $data);

			//update data total_harga in table Pembelian
			$this->db->set('no_tagihan', $no_tagihan);
			$this->db->set('total_harga', $grand_total);
			$this->db->where('id_pembelian', $pembelian_id);
			$this->db->update('pembelian');
		}
		
		return $pembelian_id;
	}
	
	function cekusername($username)
	{
		$this->db->select("*");
		$this->db->from("login_siswa");
    	$this->db->where('username', $username);
		$result = $this->db->get();

		$hasil	= $result->num_rows();
		return $hasil;
	}

	function cekemail($email)
	{
		$this->db->select("*");
		$this->db->from("siswa");
    		$this->db->where('email', $email);
		$result = $this->db->get();

		$hasil	= $result->num_rows();
		return $hasil;
	}

function fetch_all_provinsi(){
	$this->db->select("*");
	$this->db->from("provinsi");
	$this->db->order_by("nama_provinsi", "ASC");

	$result = $this->db->get();
	$hasil	= $result->result();
	return $hasil;
}

function fetch_kota_by_provinsi($idprovinsi){
	$this->db->select("*");
	$this->db->from("kota_kabupaten");
	$this->db->where("provinsi_id", $idprovinsi);
	$this->db->order_by("nama_kota", "ASC");

	$result = $this->db->get();
	$hasil	= $result->result();
	return $hasil;
}

function fetch_sekolah_by_kota_and_jenjang($idkota, $jenjang){
	$this->db->select("*");
	$this->db->from("sekolah");
	$this->db->where("kota_id", $idkota);
	$this->db->where("jenjang", $jenjang);
	$this->db->order_by("nama_sekolah", "ASC");

	$result = $this->db->get();
	$hasil	= $result->result();
	return $hasil;
}

function set_sekolah($idsiswa, $idsekolah){
	$data = array(
		'sekolah_id'	=> $idsekolah
	);
	$this->db->where("id_siswa", $idsiswa);
	$this->db->update("siswa", $data);
}

function tambah_sekolah($idkota, $sekolah){
	$data = array(
		'kota_id'		=> $idkota,
		"nama_sekolah"	=> $sekolah
	);
	$this->db->insert("sekolah", $data);
	$this->insert_id = $this->db->insert_id();
	$insert_id = $this->insert_id;
	return $insert_id;
}

function fetch_peringkat_nasional_sd(){
	$this->db->select("*");
	$this->db->from("peringkat_sd");
	$this->db->where("id_regional", 0);
	$this->db->order_by("peringkat", "ASC");
	$result = $this->db->get();
	return $result->result();
}

function fetch_peringkat_nasional_smp(){
	$this->db->select("*");
	$this->db->from("peringkat_smp");
	$this->db->where("id_regional", 0);
	$this->db->order_by("peringkat", "ASC");
	$result = $this->db->get();
	return $result->result();
}

function fetch_peringkat_nasional_sma_ipa(){
	$this->db->select("*");
	$this->db->from("peringkat_sma_ipa");
	$this->db->where("id_regional", 0);
	$this->db->order_by("peringkat", "ASC");
	$result = $this->db->get();
	return $result->result();
}

function fetch_peringkat_nasional_sma_ips(){
	$this->db->select("*");
	$this->db->from("peringkat_sma_ips");
	$this->db->where("id_regional", 0);
	$this->db->order_by("peringkat", "ASC");
	$result = $this->db->get();
	return $result->result();
}

function fetch_peringkat_regional_sd(){
	$this->db->select("*");
	$this->db->from("peringkat_sd");
	$this->db->where("id_regional >", 0);
	$this->db->order_by("peringkat", "ASC");
	$result = $this->db->get();
	return $result->result();
}

function fetch_peringkat_regional_smp(){
	$this->db->select("*");
	$this->db->from("peringkat_smp");
	$this->db->where("id_regional >", 0);
	$this->db->order_by("peringkat", "ASC");
	$result = $this->db->get();
	return $result->result();
}

function fetch_peringkat_regional_sma_ipa(){
	$this->db->select("*");
	$this->db->from("peringkat_sma_ipa");
	$this->db->where("id_regional >", 0);
	$this->db->order_by("peringkat", "ASC");
	$result = $this->db->get();
	return $result->result();
}

function fetch_peringkat_regional_sma_ips(){
	$this->db->select("*");
	$this->db->from("peringkat_sma_ips");
	$this->db->where("id_regional >", 0);
	$this->db->order_by("peringkat", "ASC");
	$result = $this->db->get();
	return $result->result();
}

//update untuk tfp
function fetch_pembelian_by_id($idpembelian){
	$this->db->select("*");
	$this->db->from("pembelian");
	$this->db->where("id_pembelian", $idpembelian);

	$result = $this->db->get();
	return $result->row();
}
//end update tfp
}
