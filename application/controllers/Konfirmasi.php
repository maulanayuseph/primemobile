<?php 
/**
* 
*/
class Konfirmasi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("model_konfirmasi");
		$this->load->model("model_paket");
		// $this->load->model("model_beli");
	}

	function index(){
		show_404();
	}

	function pembayaran($id_pembayaran){
		//need paket, expired_on tabel pembayaran
		
	}
}

 ?>