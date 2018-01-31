<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_payment extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

function fetch_siswa_by_id($idsiswa){
	$this->db->select("*");
	$this->db->from("siswa");
	$this->db->where("id_siswa", $idsiswa);
	$query = $this->db->get();
	return $query->row();
}

function fetch_paket_reguler(){
	$this->db->select("*");
	$this->db->from("paket");
	$this->db->where("tipe", 0);

	$query = $this->db->get();
	return $query->result();
}


function fetch_paket_by_id($idpaket){
	$this->db->select("*");
	$this->db->from("paket");
	$this->db->where("id_paket", $idpaket);
	$this->db->where("tipe", 0);

	$query = $this->db->get();
	return $query->row();
}

function edit_paket_siswa($idsiswa, $idpaket){
	$data = array(
		'id_paket'	=> $idpaket
	);
	$this->db->where("id_siswa", $idsiswa);
	$edit = $this->db->update("siswa", $data);
	if($edit){
		return true;
	}else{
		return false;
	}
}

function fetch_pembelian_by_id($idpembelian){
	$this->db->select("*");
	$this->db->from("pembelian");
	$this->db->where("id_pembelian", $idpembelian);

	$query = $this->db->get();
	return $query->row();
}

function fetch_detail_by_pembelian($idpembelian){
	$this->db->select("*");
	$this->db->from("pembelian_detail");
	$this->db->where("pembelian_id", $idpembelian);

	$query = $this->db->get();
	return $query->result();
}

function reqpaymentcode($dataxml, $retry = 0){
	$xml 	= '<?xml version="1.0"?>';
	$xml 	.= '<data>';
	$xml 	.= '<type>reqpaymentcode</type>';
	$xml 	.= '<bookingid>' . $dataxml['bookingid'] .'</bookingid>';
	$xml 	.= '<clientid>' . $dataxml['clientid'] .'</clientid>';
	$xml 	.= '<customer_name>' . $dataxml['customer_name'] .'</customer_name>';
	$xml 	.= '<amount>' . $dataxml['amount'] .'</amount>';
	$xml 	.= '<productid>' . $dataxml['productid'] .'</productid>';
	$xml 	.= '<interval>' . $dataxml['interval'] .'</interval>';
	$xml 	.= '<username>' . $dataxml['username'] .'</username>';
	$xml 	.= '<booking_datetime>' . $dataxml['booking_datetime'] .'</booking_datetime>';
	$xml 	.= '<signature>' . $dataxml['signature'] .'</signature>';
	$xml 	.= '</data>';

	$urlpost 	= url_reqpaymentcode;

	$headers 	= array('Content-Type' => 'application/xml');
	$options	= array('timeout' => 60000);
	$response 	= Requests::post($urlpost, $headers, $xml, $options);
	
	if($response->success){
		//var_dump($response->body);
		$xmlres 	= simplexml_load_string($response->body);
		$data = array(
			'rawxml'		=> $response->body,
			'type'			=> (string)$xmlres->type,
			'ack'			=> (string)$xmlres->ack,
			'bookingid'		=> (string)$xmlres->bookingid,
			'vaid'			=> (string)$xmlres->vaid,
			'bankcode'		=> (string)$xmlres->bankcode,
			'signature'		=> (string)$xmlres->signature
		);
		return $data;
	}else{
		return false;
	}
}

}
?>