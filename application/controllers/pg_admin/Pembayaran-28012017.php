<?php 


/**
* 
*/
class Pembayaran extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_pembayaran');
		$this->load->model('model_paket');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
	}

	function index(){
		$data = array(
			'navbar_title' 	=> "Pembayaran",
			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'table_data' 	=> $this->model_adm->fetch_all_pembayaran()
			);
		// tester
		// alert_success('', "");
		// alert_error('danger', "isi 2");
		 // alert_warning('info', "isi 2");
		 // alert_info('info', "isi 2");

		foreach ($data['table_data'] as $pembayaran) {
			// $pembayaran->no_rekening=$this->hidden_no_rek($pembayaran->no_rekening);
			$pembayaran->status = $this->read_status($pembayaran->status);
		}

		$this->load->view('pg_admin/pembayaran', $data);
	}

	function hidden_no_rek($no_rek){
		return substr_replace(substr_replace($no_rek, "**", 5,2), "***", 0, 3);
	}

	function read_status($status){
		switch ($status) {
			case '0':
				return "<span class='label label-warning'>Menunggu Pembayaran</span>";
				break;
			case '1':
				return "<span class='label label-info'>Menunggu Konfirmasi</span>"; 
				break;
			case '2':
				return "<span class='label label-success'>Confirmed</span>";
				break;
			case '3':
				return "<span class='label label-danger'>Expired</span>";
				break;
			default:
				# code...
				break;
		}
	}

	function terima($id_pembayaran){
		$pembayaran=$this->model_pembayaran->get_info_pembayaran($id_pembayaran);
		foreach($pembayaran as $item){
			for($i=1; $i <= $item->jumlah; $i++){
					//echo "<p>".$item->paket_id . "akan digenerate voucher sbb: ";
					$result = $this->model_pembayaran->aktivasi_voucher($item->paket_id, $item->kelas_id, "online", $id_pembayaran);
			}
			if ($item->siswa_id > 0){
				$email = $item->email;
			} else {
				$email = $item->email_umum;
			}
		}
		//echo base_url();
		$result = $this->model_pembayaran->update_status("2", $id_pembayaran);
		//$this->send_MailGrid($id_pembayaran, $email);
		//$this->send_Gmail($id_pembayaran, $email); //Gmail
		$this->send_Smtp2go($id_pembayaran, $email); //SMTP2GO
		//$this->sendMail($id_pembayaran, $email); //primemobile.co.id
		
		// if ($pembayaran[0]->status!=1) {
		// 	alert_error("Gagal", "Status Failed");
		// 	redirect('pg_admin/pembayaran');
		// }
		// $result = $this->model_pembayaran->update_status(2, $id_pembayaran);
		// $select_durasi=$this->model_paket->get_durasi($pembayaran[0]->id_paket);
		// $data = array('id_pembayaran' => $id_pembayaran ,
		// 				'timestamp'	=> date("Y-m-d"),
		// 				'expired_on'=> date('Y-m-d', strtotime("+".$select_durasi[0]->durasi." months")),
		// 				'id_paket'	=> $pembayaran[0]->id_paket,
		// 				'id_siswa'	=> $pembayaran[0]->id_siswa,
		// 			 );

		// $paket_aktif=$this->model_adm->add_paket_aktif($data);
		// alert_success("Sukses", "Data berhasil diubah");
		// redirect('pg_admin/pembayaran');
	}
	
	function terimaall($id_pembayaran){
		$pembayaran=$this->model_pembayaran->get_info_pembayaran($id_pembayaran);
		foreach($pembayaran as $item){
			for($i=1; $i <= $item->jumlah; $i++){
					//echo "<p>".$item->paket_id . "akan digenerate voucher sbb: ";
					$result = $this->model_pembayaran->aktivasi_voucher($item->paket_id, $item->kelas_id, "online", $id_pembayaran);
			}
			$email = $item->email;
		}
		//echo base_url();
		$result = $this->model_pembayaran->update_status("2", $id_pembayaran);
		$this->send_MailGridAll($id_pembayaran, $email);
	}
	
	function confirmall(){
		$params = $this->input->post(null, true);
		$jumlahcheck = count($params['check']);
		$idbeli = $params['check'];
		if(isset($_POST['confirm'])) {
			for($i=0; $i<=$jumlahcheck - 1; $i++){
				//echo "<p>".$idbeli[$i];
				$pembayaran=$this->model_pembayaran->get_info_pembayaran($idbeli[$i]);
				foreach($pembayaran as $item){
					if($item->status == "1"){
					$this->terimaall($idbeli[$i]);
					}
				}
			}
		}elseif(isset($_POST['delete'])) {
				for($i=0; $i<=$jumlahcheck - 1; $i++){
				$hapus=$this->model_pembayaran->hapus_pembayaran($idbeli[$i]);
			}
		}
		
		redirect('pg_admin/pembayaran');
	}
	
	function sendMail($idbayar, $email)
	 {
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://mail.primemobile.co.id',
				'smtp_port' => 465,
				'smtp_user' => 'info@primemobile.co.id', // change it to yours
				'smtp_pass' => 'bismilah45', // change it to yours
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
			);
	
			$message = '';
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");  
      $this->email->from('cs@primemobile.co.id', 'Prime Mobile Customer Service'); // change it to yours
			$this->email->to($email);// change it to yours
			$this->email->subject('Voucher Prime Mobile');
			$dataemail = array (
				'table_data' => $this->model_pembayaran->cari_voucher($idbayar)
			);
			$body = $this->load->view('pg_admin/email.php',$dataemail,TRUE);
			$this->email->message($body);
			if($this->email->send())
			{
				redirect('pg_admin/pembayaran');
			}
			else
			{
				show_error($this->email->print_debugger());
			}
	
	 }
	 
	 function send_MailGrid($idbayar, $email)
	 {
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
	       $this->email->to($email);// change it to yours
	       $this->email->subject('Voucher Prime Mobile');
	       $dataemail = array (
			'table_data' => $this->model_pembayaran->cari_voucher($idbayar)
		);
			$body = $this->load->view('pg_admin/email.php',$dataemail,TRUE);
			$this->email->message($body);
			if($this->email->send())
			{
			  redirect('pg_admin/pembayaran');
			}
			 else
			 {
			  show_error($this->email->print_debugger());
			 }
	
	 }
	 
	 function send_MailGridAll($idbayar, $email)
	 {
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
	       $this->email->to($email);// change it to yours
	       $this->email->subject('Voucher Prime Mobile');
	       $dataemail = array (
			'table_data' => $this->model_pembayaran->cari_voucher($idbayar)
		);
			$body = $this->load->view('pg_admin/email.php',$dataemail,TRUE);
			$this->email->message($body);
			if($this->email->send())
			{
			}
			 else
			 {
			  show_error($this->email->print_debugger());
			 }
	
	 }

	 function send_Gmail($idbayar, $email)
	 {
	    $config = Array(
				'protocol' 		=> 'smtp',
				'smtp_host' 	=> 'ssl://smtp.googlemail.com',
				'smtp_port' 	=> 465,
				'smtp_user' 	=> 'primemobileid@gmail.com', // change it to yours
				'smtp_pass' 	=> 'pgmobile', // change it to yours
				'mailtype' 		=> 'html',
				'charset' 		=> 'iso-8859-1',
				'wordwrap' 		=> TRUE
			);
	
			$message = '';
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");  
			$this->email->from('cs@primemobile.co.id', 'Prime Mobile Customer Service'); // change it to yours
			$this->email->to($email);// change it to yours
			$this->email->subject('Voucher Prime Mobile');
			$dataemail = array (
				'table_data' => $this->model_pembayaran->cari_voucher($idbayar)
			);

			$body = $this->load->view('pg_admin/email.php',$dataemail,TRUE);
			$this->email->message($body);
			if($this->email->send())
			{
			  redirect('pg_admin/pembayaran');
			}
			else
			{
				show_error($this->email->print_debugger());
			}
	
	 }
	 
	 function send_Smtp2go($idbayar, $email)
	 {
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
			$this->email->to($email);// change it to yours
			$this->email->subject('Voucher Prime Mobile');
			$dataemail = array (
				'table_data' => $this->model_pembayaran->cari_voucher($idbayar)
			);

			$body = $this->load->view('pg_admin/email.php',$dataemail,TRUE);
			$this->email->message($body);
			if($this->email->send())
			{
			  redirect('pg_admin/pembayaran');
			}
			else
			{
				show_error($this->email->print_debugger());
			}
	
	 }	 

}