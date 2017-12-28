<?php
class Api extends CI_Controller{
	public function __construct(){
    parent::__construct();
		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->helper('alert_helper');
		$this->load->model('model_api');
  }
  
  
function index(){
	 if ($this->input->server('PHP_AUTH_USER') !== "admin" and $this->input->server('PHP_AUTH_PW') !== "admin")
   {
       header('HTTP/1.0 401 Unauthorized');
       header('HTTP/1.1 401 Unauthorized');
       header('WWW-Authenticate: Basic realm="Masukkan Username dan Password API"');
       echo 'You must login to use this service'; // User sees this if hit cancel
       die();
    }
	
    $username = $this->input->server('PHP_AUTH_USER');
    $password = $this->input->server('PHP_AUTH_PW');
	
	echo "Invalid Parameters<br>";
	echo "Masukkan parameter sesuai dengan petunjuk<br>";
}

function daftar(){
	if ($this->input->server('PHP_AUTH_USER') !== "pgapi2017" and $this->input->server('PHP_AUTH_PW') !== "pg4p12017"){
       header('HTTP/1.0 401 Unauthorized');
       header('HTTP/1.1 401 Unauthorized');
       header('WWW-Authenticate: Basic realm="Masukkan Username dan Password API"');
       echo 'You must login to use this service'; // User sees this if hit cancel
       die();
    }
	
	if(isset($_GET['id'])){
		$idindihome = urldecode($_GET['id']);
	}else{
		echo "ERROR: Nomor Indihome tidak teridentifikasi<br>";
		return "";
	}
	if(isset($_GET['nama'])){
		$nama 		= urldecode($_GET['nama']);
	}else{
		echo "ERROR: Nama tidak teridentifikasi<br>";
		return "";
	}
	if(isset($_GET['alamat'])){
		$alamat 	= urldecode($_GET['alamat']);
	}else{
		echo "ERROR: Alamat tidak teridentifikasi<br>";
		return "";
	}
	if(isset($_GET['hp'])){
		$hp 		= urldecode($_GET['hp']);
	}else{
		echo "ERROR: Nomor HP tidak teridentifikasi<br>";
		return "";
	}
	if(isset($_GET['email'])){
		$email 		= urldecode($_GET['email']);
	}else{
		echo "ERROR: Email tidak teridentifikasi<br>";
		return "";
	}
	if(isset($_GET['addon'])){
		if($_GET['addon'] == 1 or $_GET['addon'] == 2 or $_GET['addon'] == 3){
			$addon 		= urldecode($_GET['addon']);
		}else{
			echo "ERROR: Add-On tidak tersedia<br>";
			return "";
		}
	}else{
		echo "ERROR: Add-On tidak teridentifikasi<br>";
		return "";
	}
	
	//MENCARI APAKAH INDIHOME PERNAH TERDAFTAR
	if(isset($_GET['id']) && isset($_GET['nama']) && isset($_GET['alamat']) && isset($_GET['hp']) && isset($_GET['email']) && isset($_GET['addon'])){
		$cariindihome = $this->model_api->cari_indihome($idindihome);
		if($cariindihome > 0){
			echo "ERROR: user pernah terdaftar<br>";
			return "";
		}else{
			//mulai register data indihome
			$registerindihome = $this->model_api->register_indihome($idindihome, $addon, $nama, $alamat, $hp, $email);
			//end register indihome
		}
		
		//looping sebanyak jumlah addon yang didaftarkan untuk mendaftarkan username dan password
		$passworduntukemail = "";
		for($i = 1; $i <= $addon; $i++){
			$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
			$string = '';
			$string2 = '';
			$max = strlen($characters) - 1;
			for ($a = 0; $a < 8; $a++) {
				$string .= $characters[mt_rand(0, $max)];
			}
			for ($b = 0; $b < 8; $b++) {
				$string2 .= $characters[mt_rand(0, $max)];
			}
			
			$username[$i] = "pid".$string;
			$password[$i] = $string2;
			
			$registerlogin = $this->model_api->register_login($username[$i], $password[$i]);
			
			$registersiswa = $this->model_api->register_siswa($registerindihome, $registerlogin);
			
			$passworduntukemail .= $password[$i].";";
		}
		//end looping
		
		//kirim email konfirmasi berisi username dan password
		$infoindihome = $this->model_api->cari_user_indihome($registerindihome);
		$this->kirim_konfirmasi($registerindihome, $infoindihome->email, $passworduntukemail);
		//end konfirmasi
		
		//tampilkan informasi berhasil
		$infoindihome = array (
				'table_data' => $this->model_api->cari_user_indihome($registerindihome),
				'info_login'	=> $this->model_api->cari_user($registerindihome)
			);
		$this->load->view('api/sukses', $infoindihome);
		
		//end informasi berhasil
	}else{
		echo "ERROR: Incorrect Parameters";
		return "";
	}
	//end pencarian id terdaftar
	
	
	
	//looping sebanyak addon yang terbeli untuk generate username, password dan informasi siswa
	//$register 	= $this->model_api->register_siswa($nama, $alamat, $hp, $email);
	//end generate informasi siswa
	
	//kirim email konfirmasi berisi username dan password
	//$this->kirim_konfirmasi($email);
	//end konfirmasi
	
	
	
}

function cabut(){
	if(isset($_GET['id'])){
		$idindihome = urldecode($_GET['id']);
	}else{
		echo "ERROR: Nomor Indihome tidak teridentifikasi<br>";
		return "";
	}
	
	if ($this->input->server('PHP_AUTH_USER') !== "pgapi2017" and $this->input->server('PHP_AUTH_PW') !== "pg4p12017"){
       header('HTTP/1.0 401 Unauthorized');
       header('HTTP/1.1 401 Unauthorized');
       header('WWW-Authenticate: Basic realm="Masukkan Username dan Password API"');
       echo 'You must login to use this service'; // User sees this if hit cancel
       die();
    }
	
	$cariidindihome = $this->model_api->cari_id_indihome($idindihome);
	
	$carilogin = $this->model_api->cari_login($cariidindihome->id_indihome_user);
	
	foreach($carilogin as $login){
		$hapuslogin = $this->model_api->hapus_login($login->id_login);
	}
	
	$hapusindihomeuser = $this->model_api->hapus_indihome($cariidindihome->id_indihome_user);
	
	echo "Cabut Berhasil";
}

function kirim_konfirmasi($idindihome, $email, $passworduntukemail){
	$config = Array(
		'protocol' 	=> 'smtp',
	    'smtp_host' => 'smtp.sendgrid.net',
	    'smtp_port' => 587,
	    'smtp_user' => 'ftwijanarko', // change it to yours
	    'smtp_pass' => 'MerekaAdalah16', // change it to yours
	    'mailtype' 	=> 'html',
	    'charset' 	=> 'iso-8859-1',
	    'wordwrap' 	=> TRUE
	  );
	$message = '';
	$this->load->library('email', $config);
	$this->email->set_newline("\r\n");  
	$this->email->from('cs@primemobile.co.id', 'Prime Mobile Customer Service'); // change it to yours
	$this->email->to($email);// change it to yours
	$this->email->subject('Voucher Prime Mobile');
	
	$dataemail = array (
		'info_indihome' => $this->model_api->cari_user_indihome($idindihome),
		'info_login'	=> $this->model_api->cari_user($idindihome),
		'passwords'		=> $passworduntukemail
		);
	$body = $this->load->view('api/confirm_email.php',$dataemail,TRUE);
	$this->email->message($body);
	
	if($this->email->send()){
		
	}
	else{
		show_error($this->email->print_debugger());
	}
}


function testemail(){
	$config = Array(
		'protocol' => 'smtp',
	    'smtp_host' => 'smtp.sendgrid.net',
	    'smtp_port' => 587,
	    'smtp_user' => 'ftwijanarko', // change it to yours
	    'smtp_pass' => 'MerekaAdalah16', // change it to yours
	    'mailtype' => 'html',
	    'charset' => 'iso-8859-1',
	    'wordwrap' => TRUE
	  );
	$message = '';
	$this->load->library('email', $config);
	$this->email->set_newline("\r\n");  
	$this->email->from('cs@primemobile.co.id', 'Prime Mobile Customer Service'); // change it to yours
	$this->email->to('fajar.trw@gmail.com');// change it to yours
	$this->email->subject('Voucher Prime Mobile');
	
	$dataemail = array (
		'info_indihome' => $this->model_api->cari_user_indihome($registerindihome),
		'info_login'	=> $this->model_api->cari_user($registerindihome)
		);
	$body = $this->load->view('api/confirm_email.php',$dataemail,TRUE);
	$this->email->message($body);
	
	if($this->email->send()){
		
	}
	else{
		show_error($this->email->print_debugger());
	}
}

}

?>