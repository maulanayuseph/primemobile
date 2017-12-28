<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Paket extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_paket');		
	}

	function index(){
		$data = array(
						'paket_reguler' =>  $this->model_paket->get_paket_reguler(),
						'paket_premium' => $this->model_paket->get_paket_premium()
					);
		// $this->load->view('pg_user/paket', $data);
		$this->load->view('pg_user/user_beli', $data);
	}
}

 ?>