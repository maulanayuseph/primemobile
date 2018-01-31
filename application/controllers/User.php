<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class User extends CI_Controller {



	public function __construct()

  {

    parent::__construct();

		//load library in construct. Construct method will be run everytime the controller is called 

		//This library will be auto-loaded in every method in this coajantroller. 

		//So there will be no need to call the library again in each method. 

		$this->load->library('form_validation');

		$this->load->helper('alert_helper');

		$this->load->model('model_pg');

		$this->load->model('model_paket');

		$this->load->model('model_voucher');

		$this->load->model('model_pembayaran');
		
		$this->load->model('model_dashboard');
		$this->load->model('model_signup');
		$this->load->model('model_poin');
		$this->load->model('model_bonus');
		$this->load->model('model_tryout');
		$this->load->model('model_psep');
		$this->load->model('model_pr');
		$this->load->model('model_login');
		$this->load->model('model_login_aktif');
		$this->load->model('model_rencana_belajar');
        $this->load->model('model_materi_urutan');
		$this->load->model('model_kurikulum');
		$this->load->model('model_agcu');
		$this->load->model('model_psep_cbt');
		$this->load->model('model_aktivasi');
  }


	public function index()

	{

		$data = array(

			'infosiswa' => $this->model_dashboard->get_info_siswa($this->session->userdata('id_siswa')),	

			'navbar_links' => $this->model_pg->get_navbar_links(),

			'data_user' 	 => $this->model_pg->get_data_user($this->session->userdata('id_siswa')),

			);



		$this->load->view('pg_user/user_profil', $data);

	}



	public function ubah_profil()

	{
		$idsiswa = $this->session->userdata('id_siswa');
	
		if($idsiswa == ""){
			redirect('login');
		}
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		
		$carikelas = $this->model_dashboard->get_kelas($idsiswa);
		$kelas = $carikelas->kelas;
		
		$carimapel = $this->model_dashboard->get_mapel_by_kelas($kelas);
		
		$tanggalsekarang = date('Y-m-d');
		$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
		
		$jumlahsoaltryout = $this->model_dashboard->get_jumlah_soaltryout_bykelas($kelas);
		
		$bonus_unlocked = $this->model_bonus->fetch_bonus_unlocked($idsiswa);
		if(!empty($bonus_unlocked)) {
			$bonus_unlocked = explode(',', $bonus_unlocked->unlocked);
		}
		else {
			$bonus_unlocked = array();
		}
		
		//UPDATE 20 OKTOBER 2016
		//#####################################
		$cariaktivasi = $this->model_dashboard->cari_aktivasi($idsiswa);
		
		
		if($cariaktivasi == 0){
			$statussiswa = 'tidak_aktif';
		}else{
			$statussiswa = 'aktif';
		}
		//END UPDATE 20 OKTOBER 2016
		//#####################################
		
		$data = array(
			'infosiswa'			=> $infosiswa,
			'datamapel'			=> $carimapel,
			'kelasaktif'		=> $kelasaktif,
			'data_video_motivasi' => $this->model_bonus->fetch_limit_bonus_video(5), //limit = 5
			'data_bonus' => $this->model_bonus->fetch_limit_bonus_konten(5), //limit = 5
			'quote' => $this->model_bonus->fetch_random_quote(), //limit = 5
			'bonus_unlocked' 	=> $bonus_unlocked, //limit = 5
			'status_siswa'		=> $statussiswa, //update 20 oktober 2016
			'navbar_links' 		=> $this->model_pg->get_navbar_links(),
			'select_provinsi'	=> $this->model_signup->get_provinsi(),
			'infosekolah'		=>	$this->model_pg->fetch_sekolah_by_id($infosiswa->sekolah_id)
		);


		$this->load->view('pg_user/user_ubahprofil', $data);

	}




	public function do_ubah_profil()

	{

		$data = array(

			'navbar_links' => $this->model_pg->get_navbar_links(),

			'data_user' 	 => $this->model_pg->get_data_user($_SESSION['id_siswa']),

      'select_sekolah'  => $this->model_pg->fetch_all_sekolah(),

      'select_kelas'  => $this->model_pg->fetch_all_kelas()

			);



		//checking if user has logged in

		if($_SESSION['id_siswa'])  

		{

			$this->form_validation_rules('profil');

			$foto 	= $this->upload_file('foto_profil', $_SESSION['id_siswa']);

			

			if($this->form_validation->run() == TRUE)

			{

				$params = $this->input->post(null, true);

				$data_siswa = array(

								'nama_siswa' 		=> $params['namalengkap'] ? $params['namalengkap'] : '', 

								'email' 		 		=> $params['email'] ? $params['email'] : '', 

								'telepon' 	 		=> $params['nohp'] ? $params['nohp'] : '', 

								'telepon_ortu' 	=> $params['nohp_ortu'] ? $params['nohp_ortu'] : '', 

								'sekolah_id' 		=> $params['sekolah'] ? $params['sekolah'] : '', 

								'kelas' 				=> $params['kelas'] ? $params['kelas'] : '', 

								'foto' 		 	 		=> $foto ? $foto : ''

							);

				$data_login_siswa = array(

								'username' 	 => $params['pengguna'] ? $params['pengguna'] : '', 

								'password' 	 => $params['katasandi'] ? md5($params['katasandi']) : ''

							);

				

				// for testing purpose

				// echo "w/o filter:<br>";

				// print_r($data_siswa);

				// echo "<br>";

				// print_r($data_login_siswa);

				// echo "<br>";

				// echo "<br>";

				// echo "w/ filter:<br>";

				// print_r(array_filter($data_siswa));

				// echo "<br>";

				// print_r(array_filter($data_login_siswa));

				// echo "<br>";

				// echo "<pre>";

				// print_r($_SESSION);

				// echo "</pre>";

				// die();



				$result = $this->model_pg->update_data_user($_SESSION['id_siswa'], $data_siswa, $data_login_siswa);



				if($result) 

					{

						//updating session

						$session_update = array_filter($data_siswa);

						$this->session->set_userdata($session_update);



						$session_update = array_filter($data_login_siswa);

						$this->session->set_userdata($session_update);

						$this->session->unset_userdata(array('telepon', 'telepon_ortu', 'password'));

						

						alert_success('Berhasil!', 'Profil berhasil diubah'); 

					}

				else

					{ alert_error('Gagal!', 'Profil gagal diubah'); }

			}

			else

			{

				alert_error('Gagal!', 'Profil gagal diubah');

			}

		}



		redirect('user/ubah_profil');

	}



	public function beli()

	{

		if($this->session->userdata('id_siswa') == ""){
			redirect('login');
		}
		$idsiswa = $this->session->userdata('id_siswa');
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		
		$data = array(

			'infosiswa'		=> $infosiswa,
			
			'navbar_links' 	=> $this->model_pg->get_navbar_links(),

			'data_reguler'	=> $this->model_paket->get_paket_reguler(),

			'data_premium'	=> $this->model_paket->get_paket_premium()

			);



		$this->load->view('pg_user/user_beli', $data);

	}



	public function do_beli()

	{

		$this->form_validation_rules('beli');



		$now 		= new DateTime(null);

		$params	= $this->input->post(null, true);



		//PERSIAPAN 1

		$new_pembayaran = array(

			"no_tagihan"				=> '', //no_tagihan set in model_pembayaran 

			"siswa_id"					=> isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0, 

			"kelas_id"					=> 0, //temporary, ganti dengan id_kelas siswa yg sedang login(ambil dari session)

			"metode_pembayaran"	=> $params["metode_pembayaran"], // 1=transfer, 2=indomaret 

			"status"						=> 0, //status 0 untuk pembayaran yang belum dikonfirmasi oleh siswa

			"timestamp"					=> $now->format("Y-m-d H:i:00")

			);



		//PERSIAPAN 2

		//Set interval 1 hari untuk batas waktu pembayaran

		$now->add(new DateInterval('P1D'));

		$new_pembayaran['expired_on'] = $now->format("Y-m-d H:i:00");

		

		//PERSIAPAN 3

		//fetching post with name contains 'paket_'

		$assoc_keys = preg_grep('/^paket_/', array_keys($params));

		$data_paket = $this->model_paket->get_all_paket();

		$detail_pembelian = array();

		foreach ($assoc_keys as $index) {

			if($params["{$index}"] > 0)

			{

				$sub_index = explode('_', $index);

				$detail_pembelian[] = array(

					'id_paket'			=> end($sub_index),

					'harga_satuan'	=> $this->get_harga_paket(end($sub_index), $data_paket),

					'jumlah'				=> $params["{$index}"]

					);

			}

		}



		// echo "<pre>";

		// print_r($detail_pembelian);

		// echo "</pre>";

		// die();

		// $params[current(preg_grep('/^reguler_/', array_keys($params)))];



		if(!empty($detail_pembelian) OR !empty($metode_pembayaran))

		{

			$result = $this->model_pembayaran->simpan($new_pembayaran, $detail_pembelian);

			$this->send_email_invoice($result);
		
			redirect("user/bayar/".$result);

		}

		else

		{

			alert_error("Gagal", "Pilih paket yang ingin dibeli");

			redirect("user/beli");

		}

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
			'smtp_user' 	=> 'c51e35dc-358a-4c72-9390-d36ecf7f078c', // change it to yours
			'smtp_pass' 	=> 'c51e35dc-358a-4c72-9390-d36ecf7f078c', // change it to yours
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
			$res = $this->session->set_flashdata('msgemail','Email Invoice Tagihan pembelian voucher berhasil dikirim ..');
		}
		else
		{
			$res = $this->session->set_flashdata('msgemail',show_error($this->email->print_debugger()));
		}
		return $res;
	}	 


	private function get_harga_paket($id_paket, $data_paket)

	{

		foreach ($data_paket as $item) {

			if ($item['id_paket'] == $id_paket) {

				return $item['harga'];

			}

		}

	}



	public function buylist()

	{

		if($this->session->userdata('id_siswa') == ""){
			redirect('login');
		}

		$id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;

		
		
		$data = array(

			'infosiswa' => $this->model_dashboard->get_info_siswa($id_siswa),	

			'navbar_links' 		=> $this->model_pg->get_navbar_links(),

			'data_pembelian'	=> $this->model_pembayaran->get_pembelian_by_siswa($id_siswa)

			);



		//checking for expired invoice

		foreach ($data['data_pembelian'] as $invoice) {

			if($invoice->status == 0) //invoice yang belum dibayar

			{

				$this->cek_expired($invoice->id_pembelian);

			}

		}

		//SAGAB
                $data['riwayat_cbt'] = $this->model_pembayaran->riwayat_join_cbt($id_siswa);
                //END SAGAB

		$this->load->view('pg_user/user_buylist', $data);

	}



	public function aktivasi()

	{
		
		if($this->session->userdata('id_siswa') == ""){
			redirect('login');
		}

		$id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;

		$data = array(

			'infosiswa' => $this->model_dashboard->get_info_siswa($id_siswa),	

			'navbar_links'  => $this->model_pg->get_navbar_links(),

			'select_options' => $this->model_pg->fetch_all_kelas(),
			
			'existing_aktivasi'	=> $this->model_voucher->fetch_all_existing_activation($id_siswa)
			);



		$this->load->view('pg_user/user_aktivasi', $data);

	}



	public function do_aktivasi()

	{
	    $params = $this->input->post(null, true);
        
        $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;

		$data = array(

			'infosiswa' => $this->model_dashboard->get_info_siswa($id_siswa),	

			'navbar_links'  => $this->model_pg->get_navbar_links(),

			'select_options' => $this->model_pg->fetch_all_kelas()

			);



		

		//$kode_voucher = $params['kode_voucher'];

		$nmr_aktivasi = $params['kode_aktivasi'];

		$id_kelas 		= isset($params['kelas']) ? $params['kelas'] : 0 ;

		$alias_kelas  = $this->model_voucher->get_kelas_by_id($id_kelas);



		$this->form_validation_rules('aktivasi');

	

		if($this->form_validation->run() == TRUE)

		{

			$voucher = $this->model_voucher->check_voucher_by_aktivasi($nmr_aktivasi);

			if(empty($voucher))

			{

				alert_error('Error!', 'Nomor Aktivasi salah');

				redirect('user/aktivasi');

			}

			else

			{

				if($voucher->status == 0) //if voucher status is available

				{

					if($nmr_aktivasi != $voucher->no_aktivasi)
						
					{

						alert_error('Error!', 'Nomor Aktivasi salah !');

						redirect('user/aktivasi');

					}

					else

					{
						
						$now = new DateTime(null);
						// echo 'ada bo! '.($voucher->tipe == 0 ? 'reguler' : 'premium').' '.$voucher->durasi.' bulan';
						
						//cari no_voucher
						$carivoucher = $this->model_voucher->fetch_voucher_by_aktivasi($nmr_aktivasi);
						
						if($carivoucher->ket == "fisik"){
							$url = "http://inventory.primemobile.co.id/voucher_fisik/?id=" . $carivoucher->kode_voucher;
							
							$jsonstatus = json_decode($this->curl_get_contents($url), true);
							echo $carivoucher->kode_voucher;
							//var_dump($jsonstatus);
							if($jsonstatus['status'] == true){
								$status = true;
							}else{
								alert_error('Error!', $jsonstatus['message']);
								redirect('user/aktivasi');
							}
							//echo "<p>".$jsonstatus['message'];
						}

						$data_aktivasi = array(

							'id_siswa' 		=> isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : null,

							'id_kelas' 		=> $id_kelas,

							'id_paket' 		=> $voucher->id_paket,

							'id_paket' 		=> $voucher->id_paket,

							'timestamp'		=> $now->format("Y-m-d H:i:00"),

							'isaktif'		=> 1, //diaktifkan
							
							'kode_voucher'	=> $carivoucher->kode_voucher

							);
							
							

						//add activation expired date

						
						

						$cekindihome = $this->model_dashboard->get_info_siswa($this->session->userdata('id_siswa'));	
						if ($cekindihome->id_indihome > 0){
							$now->add(new DateInterval('P'.(12*10).'M'));					
						} else {
							//cari apakah user ada aktivasi sebelumnya atau tidak, jika ada, ambil tanggal terakhir dari aktivasi yang sudah ada

							//cari dulu apakah user punya aktivasi PSEP apa tidak sebelumnya..
							$tanggalsekarang = date('Y-m-d');
							$cekaktivasi = $this->model_voucher->fetch_existing_aktivation($siswa->id_siswa, $tanggalsekarang);

							if($cekaktivasi !== null){
								$kodepaket = $cekaktivasi->kode_paket;
							}else{
								$kodepaket = "nope";
							}
							if($cekaktivasi !== null and $kodepaket !== "PSEP"){
								$now = new DateTime($cekaktivasi->expired_on);
								$now->format("Y-m-d H:i:00");
								$now->add(new DateInterval('P'.$voucher->durasi.'M'));
								$data_aktivasi['expired_on'] = $now->format("Y-m-d H:i:00");
								//echo $exp;
								//return false;
							}else{
								$now->add(new DateInterval('P'.$voucher->durasi.'M'));
								$data_aktivasi['expired_on'] = $now->format("Y-m-d H:i:00");
								//echo $now;
								//return false;
							}
						}
						
						
						
						//cek apakah ada aktivasi sebelumnya
						if(empty($this->session->userdata('akses'))){
							$result 		= $this->model_voucher->add_paket_aktif($data_aktivasi);
							$set_aktif 	= $this->model_voucher->set_status_aktivasi($nmr_aktivasi); 
							
							//edit kelas di tabel siswa sesuai dengan aktivasi
							$this->model_voucher->edit_kelas_siswa($id_siswa, $id_kelas);
							
							//update session 'akses'
							$this->update_session_akses();
						}else{
							//jika ada aktivasi sebelumnya, hapus dahulu, baru input aktivasi baru
							//$hapusaktivasi = $this->model_voucher->hapus_paket_aktif($_SESSION['id_siswa']);
							
							$result 		= $this->model_voucher->add_paket_aktif($data_aktivasi);
							$set_aktif 	= $this->model_voucher->set_status_aktivasi($nmr_aktivasi); 
							
							//edit kelas di tabel siswa sesuai dengan aktivasi
							$this->model_voucher->edit_kelas_siswa($_SESSION['id_siswa'], $id_kelas);
							
							//update session 'akses'
							$this->update_session_akses();
						}
						//end cek
						if($result)

						{

							$alert_message = "Kode Voucher telah diaktifkan".

											"<hr>".

											"Paket <b>".($voucher->tipe == 0 ? 'Reguler' : 'Premium')." ".$voucher->durasi." bulan</b>".

											" untuk <b>".($voucher->tipe == 0 ? $alias_kelas : 'semua kelas').

											"</b><br> Aktif tanggal <b>".date("d M Y")."</b> s/d <b>".$now->format("d M Y")."</b>".
											
											"<hr><br><a href='".base_url()."' class='btn btn-primary'>Mulai Belajar</a>";

							alert_success('Berhasil!', $alert_message);

						}
						
						$this->session->set_flashdata('berhasil','Ok');
						redirect('user/aktivasi');
					}

				}

				else

				{

					alert_warning('Error!', 'Voucher telah digunakan');

					redirect('user/aktivasi');

				}

			}

			die();
			
		}

		else

		{

			$this->load->view('pg_user/user_aktivasi', $data);

		}



	}
	
	function curl_get_contents($url){
	  $ch = curl_init($url);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	  $data = curl_exec($ch);
	  curl_close($ch);
	  return $data;
	}



	public function bayar($id_pembelian = '')

	{

		if($this->session->userdata('id_siswa') == ""){
			redirect('login');
		}

		$siswa_id = false;

		$id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : '';

		

		if (!empty($id_pembelian)) 

		{ 

			$siswa_id = $this->model_pembayaran->cek_siswa_by_pembelian($id_pembelian); 

		}

		//check if this pembelian is done by this siswa (check siswa in db and one in the session)

		if($siswa_id == $id_siswa)

		{

			$data = array(

				'infosiswa' => $this->model_dashboard->get_info_siswa($id_siswa),	
				
				'navbar_links'  	 => $this->model_pg->get_navbar_links(),

				'buy'							 => $this->model_pembayaran->get_pembelian($id_pembelian),

				'detail_pembelian' => $this->model_pembayaran->get_detail_pembelian($id_pembelian)

				);



			//checking for expired invoice

			if($data['buy']->status == 0) //0 = belum dibayar

			{

				$this->cek_expired($id_pembelian);

			}



			$this->load->view('pg_user/user_bayar', $data);

		}

		else

		{ 

			show_404(); 

		}

	}



	public function do_bayar($id_pembelian)

	{

		if(!empty($id_pembelian))

		{

			$params = $this->input->post(null, true);

			$file_bukti = $this->upload_file('file_bukti');

			

			if ($file_bukti != null) {

				alert_success('Berhasil!', 'File bukti pembayaran telah diupload');

				$this->model_pembayaran->update_file_bukti($file_bukti, $id_pembelian);

				redirect('user/buylist');

			}

			else {

				alert_error('Gagal!', 'Terjadi kesalahan dalam upload file');

				redirect('user/bayar/'.$id_pembelian);

			}

		}

		else

		{

			show_404();

		}

	}



	public function cetak_invoice($id_pembelian = '')

	{

		$siswa_id = false;

		$id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : '';

		

		if (!empty($id_pembelian)) 

		{ 

			$siswa_id = $this->model_pembayaran->cek_siswa_by_pembelian($id_pembelian); 

		}

		//check if this pembelian is done by this siswa (check siswa in db and one in the session)

		if($siswa_id == $id_siswa)

		{

			$data = array(

				'navbar_links'  	 => $this->model_pg->get_navbar_links(),

				'buy'							 => $this->model_pembayaran->get_pembelian($id_pembelian),

				'detail_pembelian' => $this->model_pembayaran->get_detail_pembelian($id_pembelian)

				);



			$this->load->view('pg_user/user_invoice', $data);

		}

		else

		{ 

			show_404(); 

		}

	}



	private function form_validation_rules($form)

	{

		if($form)

		{

			switch ($form) {

				case 'beli':

					//set validation rules for each input

					// $this->form_validation->set_rules('id_bank', 'Kategori Materi', 'trim|required');

					// $this->form_validation->set_rules('no_rek', 'Mata Pelajaran', 'trim|required');

					

					//set custom error message

					// $this->form_validation->set_message('required', '%s tidak boleh kosong');

					break;



				case 'aktivasi':

					//set validation rules for each input

					$this->form_validation->set_rules('kode_aktivasi', 'Nomor Aktivasi', 'trim|required');

					$this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');

					

					//set custom error message

					$this->form_validation->set_message('required', '%s tidak boleh kosong');

					break;



				case 'profil':

					//set validation rules for each input

					$this->form_validation->set_rules('namalengkap', 'Nama Lengkap', 'trim|required');

					$this->form_validation->set_rules('email', 'Email', 'trim|required');

					$this->form_validation->set_rules('pengguna', 'Username', 'trim|required');

					$this->form_validation->set_rules('nohp', 'Telepon', 'trim|numeric');

					$this->form_validation->set_rules('nohp_ortu', 'Telepon Orang Tua', 'trim|numeric');

					$this->form_validation->set_rules('sekolah', 'Sekolah', 'trim|required');

					$this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');

					

					//set custom error message

					$this->form_validation->set_message('required', '%s tidak boleh kosong');

					break;

				

				default:

					# code...

					break;

			}

		}

	}



	private function upload_file($keperluan='', $id_siswa='')

	{

		$result 	= null;

		$config['overwrite'] = FALSE;

		switch ($keperluan) {

			case 'file_bukti':

				$tipe 			= $this->cek_tipe_upload($_FILES['file_bukti']['type']);

				$img_path		= "assets/uploads/verifikasi/";

				$img_name		= "verifikasi_".substr(sha1(substr(md5($_FILES['file_bukti']['name']),0,4).getrandmax()), 0, 7).$tipe;

				$input_name 	= 'file_bukti';

				$view 			= 'pg_user/user_bayar';

				break;



			case 'foto_profil':

				$config['overwrite'] = TRUE;

				$tipe 		 	= $this->cek_tipe($_FILES['foto']['type']);

				$img_path	 	= "assets/uploads/foto_siswa/";

				$img_name		= $id_siswa.md5(time()).$tipe;

				$input_name = 'foto';

				$view 			= 'pg_user/user_ubahprofil';

				break;

			

			default:

				$img_path  	= '';

				$img_name  	= '';

				$input_name = '';

				$view 			= '';

				break;

		}

		

		$config['upload_path']		= $img_path;

		$config['allowed_types']	= "png|jpg|pdf";

		$config['file_name']			= $img_name;



		$this->load->library('upload', $config);

		$this->upload->initialize($config);



		if (!$this->upload->do_upload($input_name)) 

		{

			$error = array('error' => $this->upload->display_errors());

			$this->load->view($view, $error);

			// $this->upload->display_errors();

		}

		else {

			$result = $img_name;
			
			if ($keperluan == 'foto_profil'){
				$this->load->library('image_lib');
				$config1['image_library'] 	= 'gd2';
				$config1['source_image'] 	= 'assets/uploads/foto_siswa/'.$result;
				$config1['new_image'] 		= 'assets/uploads/foto_siswa/'.$result;
				$config1['maintain_ratio'] 	= TRUE;
				$config1['width'] 			= 200;
				$config1['height'] 			= 300;
				$this->image_lib->initialize($config1);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
		
		}



		return $result;

	}



	private function cek_tipe($tipe)

	{

		if ($tipe == 'image/jpeg') 

			{ return ".jpg"; }

		

		else if($tipe == 'image/png') 

			{ return ".png"; }

		

		else 

			{ return false; }

	}
	
	private function cek_tipe_upload($tipe)

	{

		if ($tipe == 'image/jpeg') 

			{ return ".jpg"; }

		

		else if($tipe == 'image/png') 

			{ return ".png"; }

		else if($tipe == 'application/pdf') 

			{ return ".pdf"; }

		else 

			{ return false; }

	}



	private function cek_expired($id_pembelian)

	{

		$pembelian = $this->model_pembayaran->get_pembelian($id_pembelian);

		

		if (strtotime($pembelian->expired_on) <= strtotime(date('Y-m-d H:i:00')) && ($pembelian->status == 0)) 

		{

			//set status to "dibatalkan"

			$this->model_pembayaran->update_status("3", $id_pembelian);

		}

	}



	private function update_session_akses()

	{

		$this->load->model('model_login');

		if(isset($_SESSION['id_siswa']))

    { 

      //get user access

      $siswa_access = $this->model_login->cek_user_akses($_SESSION['id_siswa']);



      $akses_kelas = array();

      foreach ($siswa_access as $item) {

        // if (strtolower($item->tipe) == 'reguler') {

        if ($item->tipe == 0 || $item->tipe == 2) { //0 = reguler || 2 = indihome

          $akses_kelas['reguler'][] = $item->id_kelas;

        }

        // if (strtolower($item->tipe) == 'premium') {

        if ($item->tipe == 1) { //1 = premium 

          $akses_kelas['premium'][] = $item->id_kelas;

        }

      }

      // proses set session

      $this->session->set_userdata('akses', $akses_kelas);

    }

	}



	function logout()

	{

		$this->model_login_aktif->edit_cookie($_SESSION['id_siswa'], $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], "0");
		
		
		setcookie("timestamp_user_pm", "0", time() - (86400 * 30), "/");
		
		$this->session->sess_destroy();
		
		
		
		redirect(base_url());

	}



	function ajax_select_kelas()

  {

    $id = $this->input->post('id', true) ? $this->input->post('id', true) : null;

    

    if($id)

    {

      $sekolah = $this->model_pg->fetch_sekolah_by_id($id);

      $dynamic_options = $this->model_pg->fetch_kelas_by_jenjang($sekolah->jenjang);



      if($dynamic_options){

        echo "<option value='' disabled selected>Pilih Kelas...</option>";

        foreach ($dynamic_options as $item) {

          echo "<option value='" . $item->id_kelas . "'> $item->alias_kelas </option>";

        }

      }

      else

      {

        echo "<option value='' disabled='disabled'>Tidak ada data</option>";

      }

    }

    else{

      return false;

    }

  }



  function link_akun_fb()

  {

    $id_siswa = $_SESSION['id_siswa'] ? $_SESSION['id_siswa'] : null;

    $fb_id = $this->input->post('id') ? $this->input->post('id') : null;

    $result = FALSE;

    

    if(!empty($fb_id)) 

    {

      $link = $this->model_pg->link_akun_fb($id_siswa, $fb_id);



      if($link) {

        $result = TRUE;        

      }

    }



    echo json_encode($result);

  }



  function unlink_akun_fb()

  {

    $fb_id = $this->input->post('id') ? $this->input->post('id') : null;

    $result = FALSE;

    

    if(!empty($fb_id)) 

    {

      $unlink = $this->model_pg->unlink_akun_fb($fb_id);



      if($unlink) {

        $result = TRUE;        

      }

    }



    echo json_encode($result);

  }

	function dashboard_old(){
		$id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
		$tanggalsekarang = date('Y-m-d');
		if(empty($this->session->userdata('akses'))){
			$datapembelian = $this->model_pembayaran->get_tagihan_by_siswa($id_siswa);
			if(empty($datapembelian)){
				redirect("user/aktivasi");
			}else{
				redirect("user/buylist");
			}
		}
		//cek apakah paket SBMPTN atau bukan
		$idsiswa = $_SESSION['id_siswa'];
		$cekpaket = $this->model_login->cek_user_sbmptn($idsiswa);
		if($cekpaket->id_paket == 22){
			redirect('sbmptn');
		}
		
		$idsiswa = $this->session->userdata('id_siswa');
		
		if($idsiswa == ""){
			redirect('login');
		}
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		
		$carikelas = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
		$kelas = $carikelas->id_kelas;
		
		$carimapel = $this->model_dashboard->get_mapel_by_kelas($kelas);
		$akses = $this->session->userdata('akses');
		
		if(array_key_exists('premium', $akses)){
			$kelasaktif = $this->model_dashboard->get_kelas_premium();
		}else{
			$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
		}
		
		$jumlahsoaltryout = $this->model_dashboard->get_jumlah_soaltryout_bykelas($kelas);
		
		$bonus_unlocked = $this->model_bonus->fetch_bonus_unlocked($idsiswa);
		if(!empty($bonus_unlocked)) {
			$bonus_unlocked = explode(',', $bonus_unlocked->unlocked);
		}
		else {
			$bonus_unlocked = array();
		}
		
		//UPDATE 20 OKTOBER 2016
		//#####################################
		$cariaktivasi = $this->model_dashboard->cari_aktivasi($idsiswa);
		
		
		if($cariaktivasi == 0){
			$statussiswa = 'tidak_aktif';
		}else{
			$statussiswa = 'aktif';
		}
		//END UPDATE 20 OKTOBER 2016
		//#####################################
		
		//cari tahun ajaran siswa
		$tahunajaransiswa = $this->model_psep->fetch_tahun_ajaran_siswa($idsiswa, $carikelas->id_kelas);
		//end cari tahun ajaran siswa
		$data = array(
			'infosiswa'				=> $infosiswa,
			'datamapel'				=> $carimapel,
			'kelasaktif'			=> $kelasaktif,
			'data_video_motivasi' 	=> $this->model_bonus->fetch_limit_bonus_video(50), //limit = 5
			'data_bonus' 			=> $this->model_bonus->fetch_limit_bonus_konten(50), //limit = 5
			'quote' 				=> $this->model_bonus->fetch_random_quote(), //limit = 5
			'bonus_unlocked' 		=> $bonus_unlocked, //limit = 5
			'status_siswa'			=> $statussiswa, //update 20 oktober 2016
			'select_provinsi'		=> $this->model_signup->get_provinsi(),
			'navbar_links' 			=> $this->model_pg->get_navbar_links(),
			'data_profil' 			=> $this->model_dashboard->fetch_all_cbtcontest(),
			'datacbtreg' 			=> $this->model_tryout->fetch_cbt_reguler(),
			'aktivasipsep'			=> $this->model_tryout->fetch_aktivasi_psep($infosiswa->id_sekolah),
			'datacbtpsep'			=> $this->model_tryout->fetch_cbt_psep(),
			'tahunajaran'			=> $tahunajaransiswa,
			'materibelajar'			=> $this->model_rencana_belajar->fetch_materi_belajar($idsiswa, $carikelas->id_kelas),
			'mapeltersimpan'		=> $this->model_rencana_belajar->fetch_mapel_by_materi_tersimpan($idsiswa)
			//'datapr'				=> $this->model_psep->fetch_pr_by_kelas_and_tahun_ajaran($tahunajaransiswa->id_kelas_paralel, $tahunajaransiswa->id_tahun_ajaran)
		);
		
		if($carikelas->id_kelas == 19 or $carikelas->id_kelas == 20){
			$data['materibelajarsaintek']	= $this->model_rencana_belajar->fetch_materi_belajar($idsiswa, 38);
			$data['materibelajarsoshum']	= $this->model_rencana_belajar->fetch_materi_belajar($idsiswa, 37);
		}else{
		   $data['materibelajarsaintek']	= null;
			$data['materibelajarsoshum']	= null; 
		}
		
		if($tahunajaransiswa !== null){
			$data['datapr'] = $this->model_psep->fetch_pr_by_kelas_and_tahun_ajaran($tahunajaransiswa->id_kelas_paralel, $tahunajaransiswa->id_tahun_ajaran);
		}
		//cari difference aktivasi sisa berapa hari
		$expired = $this->model_pg->fetch_aktivasi_siswa($idsiswa);
		
		$today 		= new DateTime(date("Y-m-d"));
		$enddate 	= new DateTime($expired->expired_on);
		//echo $expired->expired_on;
		//echo "<br>".$today;
		
		$interval = $today->diff($enddate);
		
		//echo $interval->days;
		
		$data['sisaaktivasi'] = $interval;
		$this->load->view('pg_user/dashboard_user', $data);
	}

	function pilihmapel($idkelas){
		$carimapel = $this->model_dashboard->get_mapel_by_kelas($idkelas);
		foreach($carimapel as $mapel){
			echo "
				<li class='pilih' id='".$mapel->id_mapel."'><a href='#dropmapel' id='asdasdasd'>".$mapel->nama_mapel."<span class='circle' style='background-color:#e6353c;'></span></a></li>
			";
		}
	?>
	<script>
	$(function(){
		$(".pilih").click(function() {
			$("#materi").html("<img src='<?php echo base_url('assets/pg_user/images/gears.gif');?>' style='margin: 0 auto; width: 75px;' />"); 
			$("#materi").load("materi/" + $(this).attr('id'));
		});
	});
	</script>
	<?php
	}

	function lihatmapel($idkelas){
		$carimapel = $this->model_dashboard->get_mapel_by_kelas($idkelas);
		
		echo "
		<button class='btn btn-danger kembalikelas'>Kembali</button>
		<div class='col-lg-12'>
		<p>&nbsp;
		<p>&nbsp;
		</div>";
		foreach($carimapel as $mapel){
			echo "
				<div class='mapel-container'>
					<div class='content'>
							<h4>$mapel->nama_mapel</h4>
						<button class='btn btn-danger btn-pilihmapel' style='float: right; margin: 15px 0;' id='$mapel->id_mapel'>Lihat Materi</button>
					</div>
				</div>
			";
		}
	?>
	<script>
	$(function(){
		$(".btn-pilihmapel").click(function() {
			$("#materi").html("<img src='<?php echo base_url('assets/pg_user/images/gears.gif');?>' style='margin: 0 auto; width: 75px;' />"); 
			$("#materi").load("materi/" + $(this).attr('id'));
		});
		$(".kembalikelas").click(function() {
			$("#materi").html("<img src='<?php echo base_url('assets/pg_user/images/gears.gif');?>' style='margin: 0 auto; width: 75px;' />"); 
			$("#materi").load("kembalikelas");
		});
	});
	</script>
	<?php
	}


	function kembalikelas(){
		$idsiswa = $this->session->userdata('id_siswa');
		
		$tanggalsekarang = date('Y-m-d');
		
		$akses = $this->session->userdata('akses');
		
		if(array_key_exists('premium', $akses)){
			$kelasaktif = $this->model_dashboard->get_kelas_premium();
		}else{
			$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
		}
		
		foreach($kelasaktif as $kelas){
		?>
			<div class="mapel-container">
				<div class="content">
						<h4><?php echo $kelas->alias_kelas;?></h4>
					<button class="btn btn-danger btn-kelas" type="submit" style="float: right; margin: 15px 0;" id="<?php echo $kelas->id_kelas;?>">Lihat Mata Pelajaran</button>
				</div>
			</div>
		<?php
		}
	?>
	<script>
	$(function(){
		$(".btn-kelas").click(function() {
			$("#materi").html("<img src='<?php echo base_url('assets/pg_user/images/gears.gif');?>' style='margin: 0 auto; width: 75px;' />"); 
			$("#materi").load("lihatmapel/" + $(this).attr('id'));
		});
	});
	</script>
	<?php
	}

	function kembalimapel($idkelas){
		
	}

	function carimateri($keyword){
		$keyword = rawurldecode($keyword);
		$carimateri = $this->model_dashboard->get_materi_by_keyword($keyword);
		//echo $keyword;
		foreach($carimateri as $materi){
		?>
			<div class="mapel-container">
				<div class="header"><?php echo $materi->alias_kelas;?></div>
				<div class="content">
						<h4><?php echo $materi->nama_materi_pokok;?></h4>
					<a href="../materi/tabel_konten_detail/<?php echo $materi->id_materi_pokok;?>" class="btn btn-danger" type="submit" style="float: right; margin: 15px 0;">Mulai Belajar</a>
				</div>
			</div>
		<?php
		}

	}

	function profil($idkelas){
		$cariprofil = $this->model_dashboard->get_profil_by_kelas($idkelas);
		
		foreach($cariprofil as $profil){
			echo "
				<li class='pilihprofil' id='".$profil->id_tryout."'><a href='#dropmapel' id='asdasdasd'>".$profil->nama_profil."<span class='circle' style='background-color:#e6353c;'></span></a></li>
			";
		}
	?>
	<script>
	$(function(){
		$(".pilihprofil").click(function() {
			$("#tryout").html("<img src='<?php echo base_url('assets/pg_user/images/gears.gif');?>' style='margin: 0 auto; width: 75px;' />"); 
			$("#tryout").load("tryout/" + $(this).attr('id'));
			$("#profilterpilih").val($(this).attr('id'));
			$('#submitstatistik').css('display', 'inline-block');
		});		
	});
	</script>
	<?php
	}

	function materi($idmapel){
		$carimateri =  $this->model_dashboard->get_topik_by_mapel($idmapel);
		$infomapel = $this->model_dashboard->get_info_mapel($idmapel);
		echo "
		<button class='btn btn-danger kembalimapel' id='$infomapel->kelas_id'>Kembali</button>
		<div class='col-lg-12'>
		<p>&nbsp;
		<p>&nbsp;
		</div>";
		foreach($carimateri as $materi){
		?>
			<div class="mapel-container">
				<div class="header"><?php echo $materi->alias_kelas;?></div>
				<div class="content">
						<h4><?php echo $materi->nama_materi_pokok;?></h4>
					<a href="../materi/tabel_konten_detail/<?php echo $materi->id_materi_pokok;?>" class="btn btn-danger" type="submit" style="float: right; margin: 15px 0;">Mulai Belajar</a>
				</div>
			</div>
		<?php
		}
	?>
	<script>
	$(function(){
		$(".kembalimapel").click(function() {
			$("#materi").html("<img src='<?php echo base_url('assets/pg_user/images/gears.gif');?>' style='margin: 0 auto; width: 75px;' />"); 
			$("#materi").load("lihatmapel/" + $(this).attr('id'));
		});
	});
	</script>
	<?php
	}

	function tryout($idprofil){
		$caritryout = $this->model_dashboard->get_tryout_by_profil($idprofil);
		$idsiswa = $this->session->userdata('id_siswa');
		
		foreach($caritryout as $tryout){
			?>
			<div class="mapel-container">
				<div class="header"><?php echo $tryout->jumlah_soal;?> Soal</div>
				<div class="content">
					<div class="title">
					<h5><?php echo $tryout->alias_kelas;?></h5>
					<h3><?php echo $tryout->nama_kategori;?></h3>
					
					<?php
						$cariskor 		= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
						$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
						$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
						
						$prosentase = round(($cariskor/$tryout->jumlah_soal) * 100, 2);
						
						if($cariskor > 0 and $cariwaktu > 0){
							
							echo "<h4>".$prosentase."% Tuntas</h4>
							<h6>".$cariskor."/".$tryout->jumlah_soal." Soal yang benar</h6>
							";
						}elseif($cariskor == 0 and $cariskorsalah > 0 and  $cariwaktu > 0){
							echo "
							<h4>0% progress</h4>
							<h6>0/".$tryout->jumlah_soal." Soal yang benar</h6>
							";
						}elseif($cariskor > 0 and $cariwaktu == 0){
							echo "
							<h4>0% progress</h4>
							<h6>0/".$tryout->jumlah_soal." Soal yang benar</h6>
							";
						}elseif($cariskor == 0 and $cariwaktu == 0){
							echo "
							<h4>0% progress</h4>
							<h6>0/".$tryout->jumlah_soal." Soal yang benar</h6>
							";
						}else{
							echo "
							<h4>0% progress</h4>
							<h6>0/".$tryout->jumlah_soal." Soal yang benar</h6>
							";
						}
					?>
					</div>
				 <?php
					if(($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu > 0){
					?>
						<div class="progress" style="height: 10px;">
						<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $prosentase;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prosentase;?>%;">
						<span class="sr-only"><?php echo $prosentase;?>% Complete</span>
						</div>
					</div>
					<a href="../tryout/openclass/<?php echo $tryout->id_kategori; ?>" class="btn btn-primary" style="float: right; margin: 15px 0;">Open Class</a>
					<a href="../tryout/pembahasan/<?php echo $tryout->id_kategori;?>" class="btn btn-success" type="submit" style="float: right; margin: 15px 15px;">Pembahasan</a>
					<?php
					}elseif(($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu == 0){
					?>
						<div class="progress" style="height: 10px;">
							<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
							<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<a href="../tryout/mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Lanjut Mengerjakan</a>
					<?php
					}else{
					?>
					<div class="progress" style="height: 10px;">
						<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
						<span class="sr-only">0% Complete</span>
						</div>
					</div>
					<a href="../tryout/mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Mulai</a>
					<?php
					}	
					?>
					
					
				</div>
				</div>
			<?php
		}
	}

	function statistik(){
		$idkelas 	= $this->input->get('kelas');
		$aliaskelas = $this->model_dashboard->kelas_by_id($idkelas);
		
		
		$idsiswa 	= $this->session->userdata('id_siswa');
		$carikelas 	= $this->model_dashboard->get_kelas($idsiswa);
		$kelas 		= $carikelas->kelas;
		
		$data = array(
			'navbar_links'		=> $this->model_pg->get_navbar_links(),
			'analisis_mapel'	=> $this->model_dashboard->get_analisis_mapel_bykelas($idsiswa, $idkelas),
			'analisis_waktu'	=> $this->model_dashboard->get_analisis_waktu_bykelas($idsiswa, $idkelas),
			'kategori'			=> $this->model_dashboard->get_kategori_tryout($idkelas),
			'kelas'				=> $kelas,
			'analisis_topik'	=> $this->model_dashboard->get_analisis_topik($idsiswa),
			'kelasaktif'		=> $this->model_dashboard->get_kelas_aktif($idsiswa, date('Y-m-d')),
			'aliaskelas'		=> $aliaskelas,
			'totalpeserta'		=> $this->model_dashboard->peserta_tryout($idkelas),
			'totalsoal'			=> $this->model_dashboard->total_soal_bykelas($idkelas),
			'jumlahbenar'		=> $this->model_dashboard->jumlah_benar($idsiswa),
			'dataperingkat'		=> $this->model_dashboard->peringkat($idkelas)
		);
		
		$this->load->view('pg_user/dashboard', $data);
	}

	function statistiknilai($idprofil){
		//$idprofil 	= $this->input->get('profil');
		
		if($idprofil == ""){
			redirect('user/dashboard');
		}
		
		$aliaskelas = $this->model_dashboard->kelas_by_profil($idprofil);
		
		
		
		$idsiswa 	= $this->session->userdata('id_siswa');
		$carikelas 	= $this->model_dashboard->get_kelas($idsiswa);
		$kelas 		= $carikelas->kelas;
		
		$cariidkelas	= $this->model_dashboard->get_idkelas_byprofil($idprofil);
		
		if($cariidkelas->id_kelas == ""){
			redirect('user/dashboard');
		}
		
		$idkelas = $cariidkelas->id_kelas;
		$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
		$data = array(
			'navbar_links'		=> $this->model_pg->get_navbar_links(),
			'infosiswa'			=> $this->model_dashboard->get_info_siswa($idsiswa),
			'analisis_mapel_lama'	=> $this->model_dashboard->get_analisis_mapel_byprofil($idsiswa, $idprofil),
			'analisis_waktu'	=> $this->model_dashboard->get_analisis_waktu_byprofil($idsiswa, $idprofil),
			'kategori'			=> $this->model_dashboard->get_kategori_tryout_byprofil($idprofil),
			'kelas'				=> $kelas,
			'analisis_topik'	=> $this->model_dashboard->get_analisis_topik_2($idsiswa),
			'kelasaktif'		=> $this->model_dashboard->get_kelas_aktif($idsiswa, date('Y-m-d')),
			'aliaskelas'		=> $aliaskelas,
			'totalpeserta'		=> $this->model_dashboard->peserta_tryout($idkelas),
			'totalsoal'			=> $this->model_dashboard->total_soal_byprofil($idprofil),
			'jumlahbenar'		=> $this->model_dashboard->jumlah_benar($idsiswa, $idprofil),
			'dataperingkatlama'	=> $this->model_dashboard->peringkat($idprofil),
			'dataperingkat'	=> $this->model_dashboard->peringkat_by_sekolah($idprofil, $infosiswa->id_sekolah),
			'analisis_mapel' => $this->model_dashboard->analisis_mapel_by_profil_siswa($idsiswa, $idprofil),
			'idprofil'		=> $idprofil
		);
		
		$this->load->view('pg_user/hasil_tryout', $data);
	}

	function ajax_update_bonus_unlock() {
		$result = 0;
		$msg = "Bonus gagal dibuka";
		$id_siswa = $this->session->userdata('id_siswa');
		$id_bonus = $this->input->post('id_bonus');
		$bonus_unlocked = $this->model_bonus->fetch_bonus_unlocked($id_siswa);
		if(!empty($bonus_unlocked)) {
			$unlocked = explode(',', $bonus_unlocked->unlocked); 
		}
		else {
			$unlocked = array();
		}
		
		if(!empty($id_bonus)) {
			$poin_siswa = $this->model_poin->fetch_poin_siswa($id_siswa);
			$poin_minus = $this->model_poin->fetch_poin_minus($id_bonus);
			// echo "Poin Siswa: ".$poin_siswa." - ".Poin Minus: ".$poin_minus;
			if(!in_array($id_bonus, $unlocked)) {
				if($poin_siswa >= $poin_minus) {
					//1. Cutting Siswa Poin
					$result = $this->model_poin->cut_poin_siswa($id_siswa, $id_bonus);
					//2. Unlocking Bonus
					array_push($unlocked, $id_bonus);
					$unlocked = implode(',', $unlocked);
					$data_model = array('unlocked' => $unlocked);
					$result = $this->model_bonus->update_bonus_unlock($id_siswa, $data_model);
				}
				else { $poin = $poin_minus-$poin_siswa; $msg = "Kamu masih kurang $poin poin untuk membuka bonus ini"; }
			} 
			else { $msg = "Bonus telah terbuka"; }
		}
		$response['result'] = $result;
		$response['msg'] = $msg;
		$response['poin'] = $this->model_poin->fetch_poin_siswa($id_siswa);
		echo json_encode($response);
	}


	function proses_edit_profil(){
		$idsiswa = $this->session->userdata('id_siswa');
		$params = $this->input->post(null, true);
		
		$nama			= $params['nama'];
		$phone			= $params['phone'];
		$email			= $params['email'];
		$jeniskelamin	= $params['gender'];
		$alamat			= $params['alamat'];
		
		if($_FILES['foto']['name'] !== ""){
			$tipe 		 	= $this->cek_tipe($_FILES['foto']['type']);
			$img_path	 	= "assets/uploads/foto_siswa/";
			$namafile		= $idsiswa.md5(time()).$tipe;
			
			
			$config['upload_path']		= $img_path;
			$config['allowed_types']    = 'gif|jpg|png';
			$config['file_name'] 		= $namafile;
			
			$this->load->library('upload', $config);
			$this->upload->do_upload('foto');
			
			$this->load->library('image_lib');
			$config1['image_library'] 	= 'gd2';
			$config1['source_image'] 	= 'assets/uploads/foto_siswa/'.$namafile;
			$config1['new_image'] 		= 'assets/uploads/foto_siswa/'.$namafile;
			$config1['maintain_ratio'] 	= TRUE;
			$config1['width'] 			= 200;
			$config1['height'] 			= 300;
			$this->image_lib->initialize($config1);
			$this->image_lib->resize();
			$this->image_lib->clear();
					
			$edit = $this->model_dashboard->edit_profil($idsiswa, $nama, $phone, $email, $jeniskelamin, $alamat, $namafile);
			
			redirect('user/dashboard');
		}else{
			$edit = $this->model_dashboard->edit_profil($idsiswa, $nama, $phone, $email, $jeniskelamin, $alamat, "");
			
			redirect('user/dashboard');
		}
	}
	
	function kelasbyjenjang($jenjang){
		$carikelas = $this->model_dashboard->cari_kelas_by_jenjang($jenjang);
		
		foreach($carikelas as $kelas){
			echo "
			<option value='".$kelas->id_kelas."'>".$kelas->alias_kelas."</option>
			";
		}
	}

	function kelasbysekolah($sekolah){
		$carisekolah = $this->model_dashboard->cari_sekolah($sekolah);
		
		
		$carikelas = $this->model_dashboard->cari_kelas_by_jenjang($carisekolah->jenjang);
		
		foreach($carikelas as $kelas){
			echo "
			<option value='".$kelas->id_kelas."'>".$kelas->alias_kelas."</option>
			";
		}
	}

	function proses_edit_sekolah(){
		$idsiswa = $this->session->userdata('id_siswa');
		$params = $this->input->post(null, true);
		
		$jenis	= $params['jenis'];
		
		if($jenis == "lama"){
			$sekolah 	= $params['sekolah'];
			$kelas 		= $params['kelas'];
			
			$editsekolah = $this->model_dashboard->edit_sekolah_siswa($sekolah, $kelas, $idsiswa);
		}elseif($jenis == "baru"){
			$kota 		= $params['kota'];
			$sekolah 	= $params['sekolahbaru'];
			$jenjang 	= $params['jenjang'];
			$kelas 		= $params['kelas'];
			
			$editsekolah = $this->model_dashboard->edit_sekolah_siswa_baru($kota, $jenjang, $sekolah, $kelas, $idsiswa);
		}
		$this->model_dashboard->edit_kurikulum_siswa($idsiswa, $params['kurikulum']);
		redirect('user/dashboard');
	}
	
	function liveskor(){
		$idsiswa 	= $this->session->userdata('id_siswa');
		
		$data = array(
			'navbar_links'		=> $this->model_pg->get_navbar_links(),
			'infosiswa'			=> $this->model_dashboard->get_info_siswa($idsiswa),
			'dataprofil'		=> $this->model_dashboard->cari_profil_tryout()
		);
		
		$this->load->view('pg_user/live_skor', $data);
	}
	
	function listprofil($idprofil){
		$totalsoal		= $this->model_dashboard->total_soal_byprofil($idprofil);
		$idsiswa 	= $this->session->userdata('id_siswa');
		$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);

		$dataperingkat 	= $this->model_dashboard->peringkat_by_sekolah($idprofil, $infosiswa->id_sekolah);
		$no = 1;
		foreach($dataperingkat as $peringkat){
			
			$datasiswa = $this->model_dashboard->data_peringkat($peringkat->id_siswa, $idprofil);
			
			
			if(isset($peringkat->waktu_kerja)){
				$waktu = round($peringkat->waktu_kerja / 60, 2);
		?>
			<tr>
				<td><?php echo $no; ?></td>
				<td>
				<?php
				if($datasiswa->foto !== ""){
				?>
				<img src="<?php echo base_url('assets/uploads/foto_siswa/'.$datasiswa->foto); ?>" style="width: 75px;"></img>
				<?php
				}else{
				?>
				<img src="<?php echo base_url('assets/dashboard/images/profile.jpg'); ?>" style="width: 75px;"></img>
				<?php
				}
				?>
					
				</td>
				<td>
				
				<?php 
				if($peringkat->id_siswa == $this->session->userdata('id_siswa')){
					echo "<b>".$datasiswa->nama_siswa."</b>"; 
				}else{
					echo $datasiswa->nama_siswa;
				}
				?>
				</td>
				
				<td class="text-center"><?php echo $datasiswa->nama_sekolah; ?><br> <?php echo $datasiswa->nama_kota; ?> - <?php echo $datasiswa->nama_provinsi; ?></td>
				<td class="text-center"><?php echo $waktu; ?> Menit</td>
				<td class="text-center"><?php echo number_format($peringkat->jumlah_bobot_benar, 2, '.', ''); ?>
				
				</td>
				<td class="text-center"><?php echo number_format(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2, '.', ''); ?>%</td>
			</tr>
		<?php
			$no++;
			}
		
		}
	}

	function listrekap($idprofil){
		$totalsoal		= $this->model_dashboard->total_soal_byprofil($idprofil);
		$idsiswa 	= $this->session->userdata('id_siswa');
		$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);

		$dataperingkat 	= $this->model_dashboard->peringkat_by_sekolah($idprofil, $infosiswa->id_sekolah);
		
		$no = 1;
		foreach($dataperingkat as $peringkat){
			
			$datasiswa = $this->model_dashboard->data_peringkat($peringkat->id_siswa, $idprofil);
			
			
			if(isset($peringkat->waktu_kerja)){
				$waktu = round($peringkat->waktu_kerja / 60, 2);
		?>
			<tr>
				<td><?php echo $no; ?></td>
				<td>
				
				<?php 
				if($peringkat->id_siswa == $this->session->userdata('id_siswa')){
					echo "<b>".$datasiswa->nama_siswa."</b>"; 
				}else{
					echo $datasiswa->nama_siswa;
				}
				?>
				</td>
				
				<td class="text-center"><?php echo $datasiswa->nama_sekolah; ?><br> <?php echo $datasiswa->nama_kota; ?> - <?php echo $datasiswa->nama_provinsi; ?></td>
				
				<?php
					$datanilai = $this->model_dashboard->rekap_nilai($idprofil, $peringkat->id_siswa);
				
					foreach($datanilai as $nilai){
					?>
						<td><?php echo number_format($nilai->jumlah_bobot_benar, 2, '.', '');?></td>
					<?php
					}
				?>
				
				<td class="text-center">
				<?php
				if($peringkat->jumlah_bobot_benar > 100){
					echo "100.00";
				}else{
					echo number_format($peringkat->jumlah_bobot_benar, 2, '.', '');
				}
				?>
				</td>
				<td class="text-center"><?php echo number_format(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2, '.', ''); ?>%</td>
				<td class="text-center"><?php echo $waktu; ?> Menit</td>
			</tr>
		<?php
		$no++;
			}
		
		}
	}


function ganti_password(){
	$idsiswa = $this->session->userdata('id_siswa');
	$params = $this->input->post(null, true);
	
	$oldpassword = $params['oldpassword'];
	$newpassword = $params['newpassword'];
	$renewpassword = $params['renewpassword'];
	
	if($newpassword == $renewpassword){
		$caripasslama = $this->model_pg->cari_password_lama($idsiswa, $oldpassword);
		if(!empty($caripasslama)){
			//echo "old password cocok";
			$this->model_pg->ganti_password($caripasslama->id_login, $newpassword);
			alert_success('Berhasil!', 'Password telah diganti');
			redirect('user/ubah_profil');
		}else{
			//echo "old password tidak cocok";
			alert_error('Gagal!', 'Password lama salah');
			redirect('user/ubah_profil');
		}	
	}else{
		alert_error('Gagal!', 'Perulangan password baru tidak sama');
		redirect('user/ubah_profil');
		//echo "perulangan tidak sama";
	}
	
}

function ajax_rencana_belajar_awal(){
	$idsiswa 			= $this->session->userdata('id_siswa');
	$carikelas 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$data = array(
		'materibelajar'			=> $this->model_rencana_belajar->fetch_materi_belajar($idsiswa, $carikelas->kelas),
		'mapeltersimpan'		=> $this->model_rencana_belajar->fetch_mapel_by_materi_tersimpan($idsiswa)
	);
	$this->load->view("pg_user/ajax_rencana_belajar", $data);
}

function ajax_tambah_rencana_belajar(){
	$this->load->view("pg_user/ajax_tambah_rencana_belajar");
}

function ajax_simpan_rencana_belajar($rencanabelajar){
	$rencanabelajar 	= rawurldecode($rencanabelajar);
	$idsiswa 			= $this->session->userdata('id_siswa');
	
	$carikelassiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	
	//input rencana belajar baru
	$input = $this->model_rencana_belajar->insert_rencana_belajar($idsiswa, $carikelassiswa->kelas, $rencanabelajar);
	
	$data = array(
		'inforencana'	=> $this->model_rencana_belajar->fetch_rencana_belajar_by_id($input),
		'datamapel' 	=> $this->model_dashboard->get_mapel_by_kelas($carikelassiswa->kelas)
	);
	
	$this->load->view("pg_user/ajax_tambah_materi_rencana_belajar", $data);
}

function ajax_tambah_materi(){
	$idsiswa 			= $this->session->userdata('id_siswa');
	
	$tanggalsekarang = date('Y-m-d');
	
	$carikelas = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
	$kelas = $carikelas->id_kelas;
	
	//$carikelassiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	
	$data = array(
		'datamapel' 	=> $this->model_dashboard->get_mapel_by_kelas($kelas)
	);
	
	//jika SMA includeka SBMPTN
	if($kelas == 19 or $kelas == 20){
		$data['datasaintek']	= $this->model_dashboard->get_mapel_by_kelas(38);	
		$data['datasoshum']		= $this->model_dashboard->get_mapel_by_kelas(37);	
	}
	if($kelas == 6){
	    $data['datausm']	= $this->model_dashboard->get_mapel_by_kelas(39);	
	}
	
	$this->load->view("pg_user/ajax_tambah_materi_rencana_belajar", $data);
}

function ajax_bab_by_mapel($idmapel){
	$caribab 	=  $this->model_dashboard->get_topik_by_mapel($idmapel);
	$infomapel 	= $this->model_dashboard->get_info_mapel($idmapel);
	
	$data = array(
		'databab'	=> $caribab
	);
	
	$this->load->view("pg_user/ajax_bab_rencana_belajar", $data);
}
function ajax_loader(){
	$this->load->view("pg_user/ajax_loader");
}
function ajax_simpan_bab($idmateripokok){
	$idsiswa 			= $this->session->userdata('id_siswa');
	$carikelassiswa 	= $this->model_dashboard->get_info_siswa($idsiswa);
	//simpan materi
	$simpan = $this->model_rencana_belajar->simpan_materi($idsiswa, $idmateripokok);
	
	$data = array(
		'datamapel'			=> $this->model_rencana_belajar->fetch_mapel_by_materi_tersimpan($idsiswa),
		'materitersimpan'	=> $this->model_rencana_belajar->fetch_materi_belajar($idsiswa, $carikelassiswa->kelas)
	);
	
	$this->load->view("pg_user/ajax_materi_tersimpan", $data);
}

function ajax_hapus_bab($idmateripokok){
	$idsiswa 			= $this->session->userdata('id_siswa');
	$carikelassiswa 	= $this->model_dashboard->get_info_siswa($idsiswa);
	//simpan materi
	$hapus = $this->model_rencana_belajar->hapus_materi($idsiswa, $idmateripokok);
	
	$data = array(
		'datamapel'			=> $this->model_rencana_belajar->fetch_mapel_by_materi_tersimpan($idsiswa),
		'materitersimpan'	=> $this->model_rencana_belajar->fetch_materi_belajar($idsiswa, $carikelassiswa->kelas)
	);
	
	$this->load->view("pg_user/ajax_materi_tersimpan", $data);
}

function ajax_materi_tersimpan_by_mapel($idmapel){
	$idsiswa 			= $this->session->userdata('id_siswa');
	$carimapok 			= $this->model_rencana_belajar->fetch_rencana_belajar_by_mapel($idmapel, $idsiswa);
	
	$data = array(
		'datamapel'			=> $this->model_rencana_belajar->fetch_mapel_by_materi_tersimpan($idsiswa),
		'jumlahkonten'		=> $this->model_rencana_belajar->get_jumlah_konten_belajar($idmapel, $idsiswa),
		'pencapaian'		=> $this->model_rencana_belajar->get_pencapaian_siswa_by_mapel($idmapel, $idsiswa),
		'datamapok'	=> $carimapok,
		'infomapel'			=> $this->model_dashboard->get_info_mapel($idmapel)
	);
	
	

	$this->load->view("pg_user/ajax_materi_pokok_tersimpan", $data);
}

function ajax_bab_tersimpan_by_mapel($idmapel){
	$caribab 	=  $this->model_dashboard->get_topik_by_mapel($idmapel);
	$infomapel 	= $this->model_dashboard->get_info_mapel($idmapel);
	
	$data = array(
		'databab'	=> $caribab
	);
	
	$this->load->view("pg_user/ajax_bab_rencana_belajar_tersimpan", $data);
}

function no_walkthrough(){
	$params = $this->input->post(null, true);
	$idsiswa = $params["idsiswa"];
	//set walkthrough siswa jadi 2;
	$this->model_pg->set_walkthrough($idsiswa, 1);
}

function dashboard(){
	$id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
	$tanggalsekarang = date('Y-m-d');
	if(empty($this->session->userdata('akses'))){
		$datapembelian = $this->model_pembayaran->get_tagihan_by_siswa($id_siswa);
		if(empty($datapembelian)){
			redirect("user/aktivasi");
		}else{
			redirect("user/buylist");
		}
	}
	//cek apakah paket SBMPTN atau bukan
	$idsiswa = $_SESSION['id_siswa'];
	$cekpaket = $this->model_login->cek_user_sbmptn($idsiswa);
	if($cekpaket->id_paket == 22){
		redirect('sbmptn');
	}
	$idsiswa = $this->session->userdata('id_siswa');
	
	if($idsiswa == ""){
		redirect('login');
	}
	$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	
	$carikelas = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
	$kelas = $carikelas->id_kelas;
	
	$carimapel = $this->model_dashboard->get_mapel_by_kelas($kelas);
	$akses = $this->session->userdata('akses');
	
	if(array_key_exists('premium', $akses)){
		$kelasaktif = $this->model_dashboard->get_kelas_premium();
	}else{
		$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
	}
	
	$jumlahsoaltryout = $this->model_dashboard->get_jumlah_soaltryout_bykelas($kelas);
	
	$bonus_unlocked = $this->model_bonus->fetch_bonus_unlocked($idsiswa);
	if(!empty($bonus_unlocked)) {
		$bonus_unlocked = explode(',', $bonus_unlocked->unlocked);
	}
	else {
		$bonus_unlocked = array();
	}
	
	//UPDATE 20 OKTOBER 2016
	//#####################################
	$cariaktivasi = $this->model_dashboard->cari_aktivasi($idsiswa);
	
	
	if($cariaktivasi == 0){
		$statussiswa = 'tidak_aktif';
	}else{
		$statussiswa = 'aktif';
	}
	//END UPDATE 20 OKTOBER 2016
	//#####################################
	
	//cari tahun ajaran siswa
	$tahunajaransiswa = $this->model_psep->fetch_tahun_ajaran_siswa($idsiswa, $carikelas->id_kelas);
	//end cari tahun ajaran siswa

	if($kelasaktif->id_kelas == 6){
		$datamapelun = $this->model_dashboard->get_mapel_by_kelas(39);
	}elseif($kelasaktif->id_kelas == 6){
		$datamapelun = $this->model_dashboard->get_mapel_by_kelas(41);
	}elseif($kelasaktif->id_kelas == 19){
		$datamapelun = $this->model_dashboard->get_mapel_by_kelas(42);
	}elseif($kelasaktif->id_kelas == 20){
		$datamapelun = $this->model_dashboard->get_mapel_by_kelas(43);
	}else{
		$datamapelun = null;
	}

	//sbmptn
	if($kelasaktif->id_kelas == 20 or $kelasaktif->id_kelas == 19){
		$datasbmptn = $this->model_dashboard->get_mapel_sbmptn();
	}else{
		$datasbmptn = null;
	}
	$data = array(
		'infosiswa'				=> $infosiswa,
		'datamapel'				=> $carimapel,
		'datamapelun'			=> $datamapelun,
		'kelasaktif'			=> $kelasaktif,
		'data_video_motivasi' 	=> $this->model_bonus->fetch_limit_bonus_video(50), //limit = 5
		'data_bonus' 			=> $this->model_bonus->fetch_limit_bonus_konten(50), //limit = 5
		'quote' 				=> $this->model_bonus->fetch_random_quote(), //limit = 5
		'bonus_unlocked' 		=> $bonus_unlocked, //limit = 5
		'status_siswa'			=> $statussiswa, //update 20 oktober 2016
		'select_provinsi'		=> $this->model_signup->get_provinsi(),
		'navbar_links' 			=> $this->model_pg->get_navbar_links(),
		'data_profil' 			=> $this->model_dashboard->fetch_all_cbtcontest(),
		'datacbtreg' 			=> $this->model_tryout->fetch_cbt_reguler(),
		'aktivasipsep'			=> $this->model_tryout->fetch_aktivasi_psep($infosiswa->id_sekolah),
		'datacbtpsep'			=> $this->model_tryout->fetch_cbt_psep(),
		'tahunajaran'			=> $tahunajaransiswa,
		'materibelajar'			=> $this->model_rencana_belajar->fetch_materi_belajar($idsiswa, $carikelas->id_kelas),
		'mapeltersimpan'		=> $this->model_rencana_belajar->fetch_mapel_by_materi_tersimpan_and_kelas_aktif($idsiswa, $kelas),
		'datasbmptn'			=> $datasbmptn
		//'datapr'				=> $this->model_psep->fetch_pr_by_kelas_and_tahun_ajaran($tahunajaransiswa->id_kelas_paralel, $tahunajaransiswa->id_tahun_ajaran)
	);
	
	if($carikelas->id_kelas == 19 or $carikelas->id_kelas == 20){
		$data['materibelajarsaintek']	= $this->model_rencana_belajar->fetch_materi_belajar($idsiswa, 38);
		$data['materibelajarsoshum']	= $this->model_rencana_belajar->fetch_materi_belajar($idsiswa, 37);
	}else{
	   $data['materibelajarsaintek']	= null;
		$data['materibelajarsoshum']	= null; 
	}
	
	if($tahunajaransiswa !== null){
		$data['datapr'] = $this->model_psep->fetch_pr_by_kelas_and_tahun_ajaran($tahunajaransiswa->id_kelas_paralel, $tahunajaransiswa->id_tahun_ajaran);
	}
	
	//cari difference aktivasi sisa berapa hari
	$expired = $this->model_pg->fetch_aktivasi_siswa($idsiswa);
	
	$today 		= new DateTime(date("Y-m-d"));
	$enddate 	= new DateTime($expired->expired_on);
	//echo $expired->expired_on;
	//echo "<br>".$today;
	
	$interval = $today->diff($enddate);
	
	//echo $interval->days;
	
	$data['sisaaktivasi'] = $interval;
	
	$this->load->view('pg_user/dashboard_user_new', $data);
}

function ajax_bonus_video(){
	$params = $this->input->post(null, true);
	$src 	= $params["urlvideo"];
	?>
	<div id="stream-tester-player-https"></div>
		<script>
		jwplayer("stream-tester-player-https").setup({
		  "playlist": [
			{
			  "sources": [
				{
				  "default": false,
				  "file": "<?php echo str_replace('manifest.mpd','playlist.m3u8',$src) ?>",
				  "label": "0",
				  "type": "hls",
				  "preload": "none"
				}
			  ]
			}
		  ],
		  "primary": "html5",
		  "hlshtml": true
		});
		</script>
	<?php
}

}
?>