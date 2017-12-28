<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->helper('alert_helper');
		$this->load->model('model_pg');
  }

	public function index()
	{
		$data = array(
			);

		$this->load->view('pg_user/home', $data);
	}

	public function tabel_konten()
	{
		$data = array(
			);

		$this->load->view('pg_user/tabel_konten', $data);
	}

	public function tabel_konten_detail()
	{
		$data = array(
			);

		$this->load->view('pg_user/tabel_konten_detail', $data);
	}

	public function konten_teks()
	{
		$data = array(
			);

		$this->load->view('pg_user/materi_teks', $data);
	}

	public function konten_video()
	{
		$data = array(
			);

		$this->load->view('pg_user/materi_video', $data);
	}

}

 ?>