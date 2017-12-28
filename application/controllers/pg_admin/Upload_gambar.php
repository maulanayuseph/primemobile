<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Upload_gambar extends CI_Controller{



	function __construct(){

		parent::__construct();

		  $this->load->helper(array('form', 'url'));

	}



	public function index(){

		$tipe 		 					= $this->cek_tipe($_FILES['filegambar']['type']);

		if($this->session->userdata('id_admin') !== null){
			$namafile	= $this->session->userdata('id_admin') . md5(date('Y-m-d H:i:s')) . $tipe;
		}else{
			$namafile	= "psep" . md5(date('Y-m-d H:i:s')) . $tipe;
		}
		

		$config['upload_path']          = 'assets/uploads/materi/';

		$config['allowed_types']        = 'gif|jpg|png';

		$config['max_size']             = 2048;

		$config['max_width']            = 1024;

		$config['max_height']           = 768;

		$config['overwrite']            = TRUE;

		$config['file_name'] 		= $namafile;					

		$this->load->library('upload', $config);



		if ( !$this->upload->do_upload('filegambar')){

			$error = array('error' => $this->upload->display_errors());

		}else{

			$data = array('upload_data' => $this->upload->data());
			echo base_url("assets/uploads/materi/" . $namafile);
		}

	}

private function cek_tipe($tipe){

		if ($tipe == 'image/jpeg') 

			{ return ".jpg"; }

		

		else if($tipe == 'image/png') 

			{ return ".png"; }

		

		else 

			{ return false; }

	}

}