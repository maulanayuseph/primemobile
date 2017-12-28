<?php 

/**
* 
*/
class Event extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_pg');
		$this->load->model('model_paket');
		$this->load->model('model_event');
		$this->load->model('model_pembayaran');
		$this->load->model('model_dashboard');
	}
	
	function sbmptn(){
		redirect(base_url());
		
		$data = array(
			'navbar_links' 	=> $this->model_pg->get_navbar_links(),
		);

		$this->load->view("pg_user/event_sbmptn", $data);
	}
	
	function register()
	{
	    redirect(base_url());
	    
		$kode1	= rand(10,20);
		$kode2	= rand(10,20);
		$hasil	= $kode1 + $kode2;
		$data = array(
			'navbar_links' 	=> $this->model_pg->get_navbar_links(),
			'data_reguler'	=> $this->model_paket->get_paket_reguler(),
			'kode1'					=> $kode1,
			'kode2'					=> $kode2,
			'hasil'					=> $hasil,
		);

		$this->load->view("pg_user/event_sbmptn_register", $data);
	}

	function proses_register()
	{
		$cemail = $this->model_event->cekusername($this->input->post('username'));
		$cuser = $this->model_event->cekemail($this->input->post('email'));
		
		if ($cuser > 0 || $cemail > 0){
			$this->session->set_flashdata('error','<div class="alert alert-danger">Email atau Username sudah pernah terdaftar sebelumnya</div>');			
			redirect('event/register');
		}
		
		/* Data Profil */
		$data_user 	= array(
			"username" => $this->input->post('username'),
			"password" => md5($this->input->post('password')),
		);
		$login_user = $this->db->insert("login_siswa", $data_user);
		$id_login 	 = $this->db->insert_id();
		
		if(isset($_COOKIE['id_affiliasi'])) {
			$id_affiliasi = $_COOKIE['id_affiliasi'];
		} else {
			$id_affiliasi = 0;
		}
		
		if ($id_login != NULL) 
		{
			$data_siswa = array(
					"nama_siswa"		=> $this->input->post('nama'),
					"email"					=> $this->input->post('email'),
					"telepon"				=> $this->input->post('phone'),
					"kelas"					=> $this->input->post('kelas'),
					"id_login"			=> $id_login,
					"timestamp"			=> date('Y-m-d H:i:s'),
					'id_affiliasi'	=> $id_affiliasi,
				);
			$this->db->insert("siswa", $data_siswa);
			$result = $this->db->insert_id();
		}
		/* Data Profil */
		
		/* Data Pemebelian */
		$now 	= new DateTime(null);
 
		//PERSIAPAN 1
		$new_pembayaran = array(
			"no_tagihan"				=> '', //no_tagihan set in model_event 
			"siswa_id"					=> $result, // Umum tanpa register 
			"kelas_id"					=> '0', //temporary, ganti dengan id_kelas siswa yg sedang login(ambil dari session)
			"metode_pembayaran"	=> '1', // 1=transfer, 2=indomaret 
			"status"						=> '1', //status 0 untuk pembayaran yang belum dikonfirmasi oleh siswa
			"file_bukti"				=> 'checksms.jpg', 
			"timestamp"					=> $now->format("Y-m-d H:i:00"),
			);

		//PERSIAPAN 2
		//Set interval 1 hari untuk batas waktu pembayaran
		$now->add(new DateInterval('P1D'));
		$new_pembayaran['expired_on'] = $now->format("Y-m-d H:i:00");

		//PERSIAPAN 3
		$detail_pembelian = array(
			'id_paket'		=> '22',
			'harga_satuan'	=> '100000',
			'jumlah'		=> '1',
		);
		/* Data Pemebelian */

		if(!empty($detail_pembelian) OR !empty($metode_pembayaran))
		{
			$result = $this->model_event->simpan($new_pembayaran, $detail_pembelian);
			$this->send_email_invoice($result);

			$this->session->set_flashdata('pesan','<div class="alert alert-success">Terima kasih atas pendaftaran yang telah anda lakukan</div>');
		} else{
			$this->session->set_flashdata('error','<div class="alert alert-danger">Proses pendaftaran gagal</div>');
		}

		redirect('event/register');
	}

	function send_email_invoice($id_pembelian)
	{
		$siswa_id 			= $this->model_pembayaran->cek_siswa_by_pembelian($id_pembelian); 
		$infosiswa 			= $this->model_dashboard->get_info_siswa($siswa_id);

		$data = array(
			'buy'			   => $this->model_pembayaran->get_pembelian($id_pembelian),
			'detail_pembelian' => $this->model_pembayaran->get_detail_pembelian($id_pembelian)
		);


		$config = Array(
			'protocol' 		=> 'smtp',
			'smtp_host' 	=> 'smtp.postmarkapp.com',
			'smtp_port' 	=> 587,
			'smtp_user' 	=> '5c0b100a-00e5-4803-b6d9-8ec6be6b5fa4', // change it to yours
			'smtp_pass' 	=> '5c0b100a-00e5-4803-b6d9-8ec6be6b5fa4', // change it to yours
			'mailtype' 		=> 'html',
			'charset' 		=> 'iso-8859-1',
			'wordwrap' 		=> TRUE
		);


		$message = '';
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");  
		$this->email->from('cs@primemobile.co.id', 'Prime Mobile Customer Service'); // change it to yours
		$this->email->to($infosiswa->email_siswa);// change it to yours
		$this->email->subject('Invoice Prime Mobile');
		$dataemail = $data;

		$body = $this->load->view('pg_user/email_invoice.php',$dataemail,TRUE);
		
		$this->email->message($body);
		if($this->email->send())
		{
			$res = $this->session->set_flashdata('pesan','<div class="alert alert-success">Terima kasih atas pendaftaran yang telah anda lakukan</div>');
		}
		else
		{
			$res = $this->session->set_flashdata('error',show_error($this->email->print_debugger()));
		}
		return $res;
	}	 

	function cekusername($username)
	{
		$this->db->select("*");
		$this->db->from("login_siswa");
    $this->db->where('username', $username);
		$result = $this->db->get();

		$hasil	= $result->num_rows();
		
		if ($hasil > 0){
			echo '<div class="alert alert-danger" style="width:100%;display:block;padding: 5px 20px; text-align:center;margin-top: 10px;">Username sudah ada</div>';
			echo '<input type="hidden" id="cuser" name="cuser" value="1">';
		} else {
			echo '<input type="hidden" id="cuser" name="cuser" value="0">';
		}
	}

	function cekemail()
	{
		$email = $this->input->post('email');
		$this->db->select("*");
		$this->db->from("siswa");
    	$this->db->where('email', $email);
		$result = $this->db->get();

		$hasil	= $result->num_rows();
		
		if ($hasil > 0){
			echo '<div class="alert alert-danger" style="width:100%;display:block;padding: 5px 20px; text-align:center;margin-top: 10px;">Email sudah terdaftar</div>';
			echo '<input type="hidden" id="cemail" name="cemail" value="1">';
		} else {
			echo '<input type="hidden" id="cemail" name="cemail" value="0">';
		}
	}


function cbt(){
	$this->load->view("landing_page/cbt2017/index");
}

function existing_user(){
	$email 		= $this->input->post('email');
	$username 	= $this->input->post('username');

	//cek email 
	$this->db->select("*");
	$this->db->from("siswa");
	$this->db->where('email', $email);
	$result = $this->db->get();
	$hasilemail	= $result->num_rows();

	//cek username
	$this->db->select("*");
	$this->db->from("login_siswa");
	$this->db->where('username', $username);
	$result = $this->db->get();
	$hasilusername	= $result->num_rows();

	$respon = array(
		'email'			=> $hasilemail,
		'username'		=> $hasilusername
	);

	$data = json_encode($respon);
	echo $data;
}


function proses_register_event(){
	$params 	= $this->input->post(null, true);
	$idpaket 	= $params['idpaket'];
	$idevent 	= $params['idevent'];
	$nama 		= $params['nama'];
	$email 		= $params['email'];
	$hp 		= $params['hp'];
	$username 	= $params['username'];
	$password 	= $params['password'];

	$data_user 	= array(
		"username" => $username,
		"password" => md5($password),
	);
	$login_user = $this->db->insert("login_siswa", $data_user);
	$id_login 	 = $this->db->insert_id();

	if ($id_login != NULL) 
	{
		//input data siswa
		$data_siswa = array(
			"nama_siswa"		=> $nama,
			"email"				=> $email,
			"telepon"			=> $hp,
			"id_login"			=> $id_login,
			"timestamp"			=> date('Y-m-d H:i:s')
		);
		$this->db->insert("siswa", $data_siswa);
		$idsiswa = $this->db->insert_id();

		//input data orang tua
		$dataortu = array(
			'id_siswa'		=> $idsiswa,
			'nama_ortu'		=> $nama,
			'telepon'		=> $hp,
			'email'			=> $email,
			'username'		=> $username,
			'password'		=> md5($password)
		);
		$this->db->insert("parents", $dataortu);
	}

	$now 	= new DateTime(null);
 
	//PERSIAPAN 1
	$new_pembayaran = array(
		"no_tagihan"				=> '', //no_tagihan set in model_event 
		"siswa_id"					=> $idsiswa, // Umum tanpa register 
		"kelas_id"					=> '0', //temporary, ganti dengan id_kelas siswa yg sedang login(ambil dari session)
		"metode_pembayaran"			=> '1', // 1=transfer, 2=indomaret 
		"status"					=> '1', //status 0 untuk pembayaran yang belum dikonfirmasi oleh siswa
		"file_bukti"				=> 'checksms.jpg', 
		"timestamp"					=> $now->format("Y-m-d H:i:00"),
		'id_event'					=> $idevent
		);

	//PERSIAPAN 2
	//Set interval 1 hari untuk batas waktu pembayaran
	$now->add(new DateInterval('P1D'));
	$new_pembayaran['expired_on'] = $now->format("Y-m-d H:i:00");

	//PERSIAPAN 3
	

	//cari harga paket
	$this->db->select("*");
	$this->db->from("paket");
	$this->db->where("id_paket", $idpaket);
	$result 	= $this->db->get();
	$datapaket	= $result->row();

	if($datapaket->kode_paket == "EVENT"){
		$this->db->select("*");
		$this->db->from("event");
		$this->db->where("id_event", $idevent);
		$resultevent	= $this->db->get();
		$dataevent		= $resultevent->row();
		$hargasatuan 	= $dataevent->harga;
	}else{
		$hargasatuan 	= $datapaket->harga;
	}
	$detail_pembelian = array(
		'id_paket'		=> $idpaket,
		'harga_satuan'	=> $hargasatuan,
		'jumlah'		=> '1',
	);
	/* Data Pemebelian */

	if(!empty($detail_pembelian) OR !empty($metode_pembayaran))
	{
		$result = $this->model_event->simpan($new_pembayaran, $detail_pembelian);
		$this->send_invoice_event($result);

		$this->session->set_userdata("nama", $nama);
		$this->session->set_userdata("username", $username);
		$this->session->set_userdata("password", $password);
		$this->session->set_userdata("idsiswa", $idsiswa);

		$respon = array(
			'status'	=> 'success'
		);
		$data = json_encode($respon);
		echo $data;
	}else{
		$respon = array(
			'status'	=> 'failed'
		);
		$data = json_encode($respon);
		echo $data;
	}
}

function send_invoice_event($id_pembelian)
	{
		$siswa_id 			= $this->model_pembayaran->cek_siswa_by_pembelian($id_pembelian); 
		$infosiswa 			= $this->model_dashboard->get_info_siswa($siswa_id);

		$data = array(
			'buy'			   => $this->model_pembayaran->get_pembelian($id_pembelian),
			'detail_pembelian' => $this->model_pembayaran->get_detail_pembelian($id_pembelian)
		);

		$config = Array(
			'protocol' 		=> 'smtp',
			'smtp_host' 	=> 'smtp.postmarkapp.com',
			'smtp_port' 	=> 587,
			'smtp_user' 	=> '5c0b100a-00e5-4803-b6d9-8ec6be6b5fa4', // change it to yours
			'smtp_pass' 	=> '5c0b100a-00e5-4803-b6d9-8ec6be6b5fa4', // change it to yours
			'mailtype' 		=> 'html',
			'charset' 		=> 'iso-8859-1',
			'wordwrap' 		=> TRUE
		);

		$message = '';
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");  
		$this->email->from('cs@primemobile.co.id', 'Prime Mobile Customer Service'); // change it to yours
		$this->email->to($infosiswa->email_siswa);// change it to yours
		$this->email->subject('Invoice Prime Mobile');
		$dataemail = $data;

		$body = $this->load->view('pg_user/email_invoice.php',$dataemail,TRUE);
		


		$this->email->message($body);
		
		if($this->email->send())
		{
			$res = $this->session->set_flashdata('pesan','<div class="alert alert-success">Terima kasih atas pendaftaran yang telah anda lakukan</div>');
		}
		else
		{
			$res = $this->session->set_flashdata('error',show_error($this->email->print_debugger()));
		}
		return $res;
		
	}

function register_sekolah(){
	$data = array(
		'dataprovinsi'	=> $this->model_event->fetch_all_provinsi()
	);
	$this->load->view("landing_page/cbt2017/ajax_register_sekolah", $data);
}

function filter_kota($idprovinsi){
	$datakota = $this->model_event->fetch_kota_by_provinsi($idprovinsi);

	echo "<option value=''>-- Pilih Kota --</option>";

	foreach($datakota as $kota){
		?>
		<option value="<?php echo $kota->id_kota;?>"><?php echo $kota->nama_kota;?></option>
		<?php
	}
}

function filter_sekolah($idkota, $jenjang){
	$datasekolah = $this->model_event->fetch_sekolah_by_kota_and_jenjang($idkota, $jenjang);

	echo "<option value=''>-- Pilih Sekolah --</option>";

	foreach($datasekolah as $sekolah){
		?>
		<option value="<?php echo $sekolah->id_sekolah;?>"><?php echo $sekolah->nama_sekolah;?></option>
		<?php
	}
}

function set_sekolah(){
	$params 		= $this->input->post(null, true);
	$tipesekolah 	= $params['tipesekolah'];
	$idsiswa 		= $this->session->userdata('idsiswa');
	if($tipesekolah == "lama"){
		$idsekolah 		= $params['sekolah'];

		$this->model_event->set_sekolah($idsiswa, $idsekolah);
	}elseif($tipesekolah == "baru"){
		$sekolah 		= $params['sekolah'];
		$idkota 		= $params['idkota'];

		$sekolahbaru = $this->model_event->tambah_sekolah($idkota, $sekolah);
		$this->model_event->set_sekolah($idsiswa, $sekolahbaru);
	}
	
}

}
