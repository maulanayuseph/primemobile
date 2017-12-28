<?php 

/**
* 
*/
class Beli_paket extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('model_paket');
		$this->load->model('model_pg');
		$this->load->model('model_pembayaran');
	}

	function index($id_paket=null){
		$data = array(
			'navbar_links' 	=> $this->model_pg->get_navbar_links(),
			'data_reguler'	=> $this->model_paket->get_paket_reguler(),
			'data_premium'	=> $this->model_paket->get_paket_premium()
		);
		//$this->load->view("pg_user/beli_paket", $data);
		$this->load->view("pg_user/beli_paket", $data);
	}

	public function proses_beli()
	{
		$now 	= new DateTime(null);
		$params	= $this->input->post(null, true);

		//PERSIAPAN 1
		$new_pembayaran = array(
			"no_tagihan"				=> '', //no_tagihan set in model_pembayaran 
			"siswa_id"					=> 0, // Umum tanpa register 
			"kelas_id"					=> 0, //temporary, ganti dengan id_kelas siswa yg sedang login(ambil dari session)
			"metode_pembayaran"			=> $params["metode_pembayaran"], // 1=transfer, 2=indomaret 
			"status"					=> 0, //status 0 untuk pembayaran yang belum dikonfirmasi oleh siswa
			"timestamp"					=> $now->format("Y-m-d H:i:00"),
			"email"						=> $params["email"]
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
					'id_paket'		=> end($sub_index),
					'harga_satuan'	=> $this->get_harga_paket(end($sub_index), $data_paket),
					'jumlah'		=> $params["{$index}"]
					);
			}
		}

		if(!empty($detail_pembelian) OR !empty($metode_pembayaran))
		{
			$result = $this->model_pembayaran->simpan($new_pembayaran, $detail_pembelian);
			$this->send_email_invoice($result, $params['email']);
			redirect("beli-paket");
		}
		else
		{
			$this->session->set_flashdata('msgemail','Pilih paket yang ingin dibeli');
			redirect("beli-paket");
		}
	}

	function send_email_invoice($id_pembelian,$email)
	{
		$data = array(
			'buy'			   => $this->model_pembayaran->get_pembelian_umum($id_pembelian),
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
		$this->email->to($email);// change it to yours
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

}

 ?>