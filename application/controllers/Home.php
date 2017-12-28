<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->helper('alert_helper');
    $this->load->model('model_pg');
		$this->load->model('model_login');
		$this->load->model('model_signup');
  }

	public function indexlama()

	{

		$data = array(

			'navbar_links' => $this->model_pg->get_navbar_links(),

			'video_demo'  => $this->model_pg->get_video_demo(null)

			);



		$this->load->view('pg_user/home', $data);

	}
	
	function index(){
		$idsiswa = $this->session->userdata('id_siswa');
		
		if($idsiswa == ""){
			$data = array(

				'navbar_links' => $this->model_pg->get_navbar_links(),

				'video_demo'  => $this->model_pg->get_video_demo(null),
				'select_sekolah'  => $this->model_pg->fetch_all_sekolah(),
			  'select_kelas'  	=> $this->model_pg->fetch_all_kelas(),
			  'select_provinsi'	=> $this->model_signup->get_provinsi()
				);



			$this->load->view('pg_user/homebaru', $data);
		}else{
			redirect('user/dashboard');
		}
	}

	function do_login()
  {
    $params = $this->input->post(null, true);
    $do_login = $this->model_login->cek_login($params['username'], $params['password']);
    $akses_kelas = array();

    if($do_login != null)
    { 
      //get user access
      $siswa_access = $this->model_login->cek_user_akses($do_login['id_siswa']);

      foreach ($siswa_access as $item) {
        //firstly, let's check the paket's expiration date
        $sedang_aktif = $this->cek_masa_aktif($item);
        // print_r($item);
        if($sedang_aktif == TRUE) //paket siswa masih aktif
        {
          //assemble id_kelas into 'akses' session array 
          // if (strtolower($item->tipe) == 'reguler') {
          if ($item->tipe == 0) { //0 = reguler
            $akses_kelas['reguler'][] = $item->id_kelas;
          }
          
          // if (strtolower($item->tipe) == 'premium') {
          if ($item->tipe == 1) { //1 = premium 
            $akses_kelas['premium'][] = $item->id_kelas;
          }
        }
      }

      // proses set session
      $this->session->set_userdata($do_login);
      $this->session->set_userdata('akses', $akses_kelas);
      // $this->session->set_userdata();
              
      redirect("home");
    }
    else
    {
      alert_error("Gagal Login", "Username dan/atau Password yang anda masukkan tidak sesuai");
      redirect("home");
    }
  }

  private function cek_masa_aktif($data)
  {
    $sedang_aktif = TRUE;

    if(date('Y-m-d') > $data->expired_on) //paket telah melebihi expiration date
    {
      // return $data->id_kelas.", " . date('Y-m-d').", " . $data->expired_on."<br>";
      $result = $this->model_login->set_to_inactive($data->id_paket_aktif);
      print_r($result);

      if($result)
        { $sedang_aktif = FALSE; }
      
    }
    return $sedang_aktif;
  }

}
