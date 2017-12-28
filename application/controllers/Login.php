<?php
class Login extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
    $this->load->model("model_login");
    $this->load->model("model_login_aktif");
    $this->load->model("model_poin");
    $this->load->model("model_pg");
    $this->load->model("model_pembayaran");
    $this->load->model("model_dashboard");
    $this->load->library("form_validation");
    $this->load->library("session");
    $this->load->helper("alert_helper");
    $this->load->helper("socmed_helper");
  }

  function index()
  {
    $data = array(
      'navbar_links' => $this->model_pg->get_navbar_links(),
      );

    $this->load->view("pg_user/login", $data);
  }

  function do_login()
  {
    $this->form_validation_rules(); 

    if ($this->form_validation->run() == FALSE) 
    {
      alert_error("Gagal Login", "Terjadi Kesalahan Saat Login");
      redirect("login");
    } 
    else 
    {
		$params = $this->input->post(null, true);
		
		//cek apakah yang login adalah orang tua?
		//***************************************
		if($params['akses'] == 'parent'){
			$cek_parent = $this->model_login->cek_login_ortu($params['username'], $params['password']);
			
			$cekortu = $this->model_login->cek_login_ortu($params['username'], $params['password']);
			if($cekortu != null){
				//echo $cekortu->id_ortu;
				$this->session->set_userdata('parent_logged_in', TRUE);
				$this->session->set_userdata('id_ortu', $cekortu->id_ortu);
				$this->session->set_userdata('id_ortu_siswa', $cekortu->id_siswa);
				
				redirect('parents/dashboard');
			}else{
				alert_error("Gagal Login", "Username dan/atau password yang anda masukan tidak sesuai");
				redirect("login");
			}
		//end
		//***************************************
		}else{
			$do_login = $this->model_login->cek_login($params['username'], $params['password']);
			if($do_login != null)
		  { 
		    //cek apakah user login di browser/device lain
			$cekloginaktif = $this->model_login_aktif->cek_cookie($do_login['id_siswa']);
			
			$timestamp = date("d-m-Y H:i:s");
			
			if($cekloginaktif == 1){
				
				//jika ada login aktif, cek apakah ada timestamp terdaftar
				$fetchloginaktif = $this->model_login_aktif->fetch_login_aktif($do_login['id_siswa']);
				if($fetchloginaktif->timestamp !== "0"){
					//cek apakah browser memiliki cookie dengan timestamp yang sama dengan di table
					if(!isset($_COOKIE['timestamp_user_pm']) or (isset($_COOKIE['timestamp_user_pm']) and $_COOKIE['timestamp_user_pm'] !== $fetchloginaktif->timestamp)){
						alert_error("Gagal Login", "Akun sedang digunakan di browser/device lain, silahkan logout terlebih dahulu sebelum menggunakan akun di browser/device ini");
						redirect("login");
						return null;
					}
				}elseif($fetchloginaktif->timestamp == "0"){
					//edit login aktif yang sudah ada
					$this->model_login_aktif->edit_cookie($do_login['id_siswa'], $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], $timestamp);
					
					setcookie("timestamp_user_pm", $timestamp, time() + (86400 * 30), "/");
				}
			}else{
				//tambahkan login aktif baru
				$this->model_login_aktif->set_cookie($do_login['id_siswa'], $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], $timestamp);
				
				setcookie("timestamp_user_pm", $timestamp, time() + 31556926, "/");
			}
			
			$this->set_siswa_akses($do_login);
			
			if(empty($this->session->userdata('akses'))){
				$id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
				$datapembelian = $this->model_pembayaran->get_tagihan_by_siswa($id_siswa);
				if(empty($datapembelian)){
					redirect("user/aktivasi");
				}else{
					redirect("user/buylist");
				}
			}else{
				//cek apakah user SBMPTN atau user reguler
				$idsiswa = $this->session->userdata("id_siswa");
				$getpaket = $this->model_login->cek_user_sbmptn($idsiswa);
				if($getpaket->id_paket == 22){
					redirect("sbmptn");
				}else{
				    $infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
					if($infosiswa->walkthrough == 0){
						$this->session->set_flashdata('walkthrough',0);
					}else{
						$this->session->set_flashdata('walkthrough',1);
					}
					redirect("user/dashboard");
				}
			}
			
		  }
		  else
		  {
			alert_error("Gagal Login", "Username dan/atau password yang anda masukan tidak sesuai");
			redirect("login");
		  }
		}
      
    }
  }

  private function set_siswa_akses($do_login)
  {
    //get user access
    $siswa_access = $this->model_login->cek_user_akses($do_login['id_siswa']);
    $akses_kelas = array();

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
        
        //akses kelas psep
        if($item->tipe == 3){
          $akses_kelas['psep'][] = $item->id_kelas;
        }

        //akses kelas psep
        if($item->tipe == 4){
          $akses_kelas['event'][] = $item->id_kelas;
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
    //SET POIN SISWA
    if(date("Y-m-d", strtotime($do_login['last_login'])) != date("Y-m-d")) {
      $addpoin = $this->model_poin->add_poin_siswa($do_login['id_siswa'], 'login');
    }
  }

  private function form_validation_rules()
  {
    //set validation rules for each input
    $this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    //set custom error message
    $this->form_validation->set_message('required', '%s tidak boleh kosong');
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

  function cek_akun_fb()
  {
    $fb_id = $this->input->post('id') ? $this->input->post('id') : null;
    $result = FALSE;
    
    if(!empty($fb_id)) 
    {
      $do_login = $this->model_login->cek_akun_fb($fb_id);

      if(!empty($do_login)) {
        $this->set_siswa_akses($do_login);
        $_SESSION['fb_login'] = TRUE; 
        $_SESSION['fb_id'] = $do_login['fb_id']; 

        $result = TRUE;      
      }
    }

    echo json_encode($result);
  }

  function post_fb() {
    $fb_config = array(
          'href'        => base_url(),
          'picture'     => base_url().'assets/dashboard/images/sma.jpg',
          'title'       => '[Nama] Menyelesaikan [Judul Latihan]!',
          'description' => 'Aku sudah menyelesaikan latihan di PrimeMobile. Ayo kamu juga!',
          'caption'     => 'primemobile.co.id'
      );

    $twt_config = array(
          'url'   => base_url(),
          'text'  => "Aku sudah menyelesaikan latihan di PrimeMobile. Ayo kamu juga!",
      );

    $data = array(
      'navbar_links' => $this->model_pg->get_navbar_links(),
      'fb_config' => $fb_config,
      'twt_config' => $twt_config
      // 'fb_config' => fb_share_config('default')
      );

    $this->load->view("pg_user/post_fb_trial_ver", $data);
  }
  
function login_from_signup($username, $password, $nama){
	$do_login = $this->model_login->cek_login($username, $password);
	if($do_login != null)
	  { 
		$this->set_siswa_akses($do_login);
		
		if(empty($this->session->userdata('akses'))){
			$id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
			
			$datapembelian = $this->model_pembayaran->get_tagihan_by_siswa($id_siswa);
			if(empty($datapembelian)){
				$alert_message = "Selamat datang, ".rawurldecode($nama).". Akun anda telah terdaftar, Silahkan melakukan aktivasi untuk memulai belajar di Prime Mobile";
			    alert_success('Berhasil!', $alert_message);
			    $this->session->set_flashdata('berhasil','daftar');
				
				redirect("user/aktivasi");
			}else{
				redirect("user/buylist");
			}
		}else{
			redirect("user/dashboard");
		}
		
	  }
	  else
	  {
		alert_error("Gagal Login", "Username dan/atau password yang anda masukan tidak sesuai");
		redirect("login");
	  }
}

}

 ?>