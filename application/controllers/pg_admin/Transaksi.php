<?php 
/**
* 
*/
class Transaksi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('paginasi');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_transaksi');
		$this->load->model('model_paket');
		$this->load->model('model_security');
		$this->load->model('model_transaksi');
		$this->model_security->is_logged_in();
	}

	function index(){
		$this->tabel();
	}

	function tabel($tab=0,$cari=0,$limit=10,$page=1)
	{		
		if($page == 1){
			$offset = 0;
		} else {
			$offset = ($page-1) * $limit;
		}	
		
		$config['base_url'] 				= base_url().'pg_admin/transaksi/tabel_ajax/'.$tab.'/'.$cari.'/'.$limit.'/';
		$config['total_rows'] 			= $this->model_transaksi->get_trans($tab,$cari,0,0)->num_rows();
		$config['per_page'] 				= $limit;
		$config['uri_segment'] 			= 7;
		$config['num_links'] 				= 1;
		$config['use_page_numbers'] = TRUE;
		$config['first_link'] 			= '&lsaquo;&lsaquo;';
		$config['last_link'] 				= '&rsaquo;&rsaquo;';
		$config['next_link'] 				= '&rsaquo;';
		$config['prev_link'] 				= '&lsaquo;';
		$config['full_tag_open'] 		= "<ul class='pagination' style='width:100%;'>";
		$config['full_tag_close'] 	="</ul>";
		$config['num_tag_open'] 		= '<li>';
		$config['num_tag_close'] 		= '</li>';
		$config['cur_tag_open'] 		= "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] 		= "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] 		= "<li>";
		$config['next_tagl_close']	= "</li>";
		$config['prev_tag_open'] 		= "<li>";
		$config['prev_tagl_close']	= "</li>";
		$config['first_tag_open'] 	= "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] 		= "<li>";
		$config['last_tagl_close'] 	= "</li>";
		$config['ajax_page'] 				= 'ajaxpage'.$tab;
		
		$this->paginasi->initialize($config);

		$data = array(
			'navbar_title' 	=> "Pembayaran",
			'tabs' 	=> $tab,
			'caristr' 	=> ($cari == '0' ? '' : $cari),
			'limit' 	=> $limit,
			'page' 	=> $page,
			'no' 	=> $offset + 1,
			'table_data' 	=> $this->model_transaksi->get_trans($tab,$cari,$offset,$limit)->result(),
      'paginator'  => $this->paginasi->create_links(),
		);

		foreach ($data['table_data'] as $pembayaran) {
			$pembayaran->status = $this->read_status($pembayaran->status);
			/* SET EXPIRED
			if ($pembayaran->angka_status < 2 && ($pembayaran->metode_pembayaran < 3) && date('Y-m-d H:i:s',strtotime($pembayaran->expired_on)) < date('Y-m-d H:i:s') ){
				$dt = array(
							"status"			=> 3
						);
				$this->db->where("id_pembelian", $pembayaran->id_pembelian);
				$query = $this->db->update("pembelian", $dt);
			}
			*/
		}
		
		$this->load->view('pg_admin/transaksi_tabel', $data);
	}

	function tabel_ajax($tab=0,$cari=0,$limit=10,$page=1)
	{
		if($page == 1){
			$offset = 0;
		} else {
			$offset = ($page-1) * $limit;
		}	
		
		$config['base_url'] 				= base_url().'pg_admin/transaksi/tabel_ajax/'.$tab.'/'.$cari.'/'.$limit.'/';
		$config['total_rows'] 			= $this->model_transaksi->get_trans($tab,$cari,0,0)->num_rows();
		$config['per_page'] 				= $limit;
		$config['uri_segment'] 			= 7;
		$config['num_links'] 				= 1;
		$config['use_page_numbers'] = TRUE;
		$config['first_link'] 			= '&lsaquo;&lsaquo;';
		$config['last_link'] 				= '&rsaquo;&rsaquo;';
		$config['next_link'] 				= '&rsaquo;';
		$config['prev_link'] 				= '&lsaquo;';
		$config['full_tag_open'] 		= "<ul class='pagination' style='width:100%;'>";
		$config['full_tag_close'] 	="</ul>";
		$config['num_tag_open'] 		= '<li>';
		$config['num_tag_close'] 		= '</li>';
		$config['cur_tag_open'] 		= "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] 		= "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] 		= "<li>";
		$config['next_tagl_close']	= "</li>";
		$config['prev_tag_open'] 		= "<li>";
		$config['prev_tagl_close']	= "</li>";
		$config['first_tag_open'] 	= "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] 		= "<li>";
		$config['last_tagl_close'] 	= "</li>";
		$config['ajax_page'] 				= 'ajaxpage'.$tab;
		
		$this->paginasi->initialize($config);

		$data = array(
			'navbar_title' 	=> "Pembayaran",
			'tabs' 	=> $tab,
			'caristr' 	=> ($cari == '0' ? '' : $cari),
			'limit' 	=> $limit,
			'page' 	=> $page,
			'no' 	=> $offset + 1,
			'table_data' 	=> $this->model_transaksi->get_trans($tab,$cari,$offset,$limit)->result(),
      'paginator'  => $this->paginasi->create_links(),
		);

		foreach ($data['table_data'] as $pembayaran) {
			$pembayaran->status = $this->read_status($pembayaran->status);
			/* SET EXPIRED
			if ($pembayaran->angka_status < 2 && ($pembayaran->metode_pembayaran < 3) && date('Y-m-d H:i:s',strtotime($pembayaran->expired_on)) < date('Y-m-d H:i:s') ){
				$dt = array(
							"status"			=> 3
						);
				$this->db->where("id_pembelian", $pembayaran->id_pembelian);
				$query = $this->db->update("pembelian", $dt);
			}
			*/
		}
		
		$this->load->view('pg_admin/transaksi_tabel_ajax', $data);
	}

	function tambah(){
		$data = array(
			'data_reguler'				=> $this->model_paket->get_paket_reguler_and_dealer(),
			'data_premium'				=> $this->model_paket->get_paket_premium(),
			'nama'								=> '',
			'hp'									=> '',
			'email'								=> '',
			'metode_pembayaran'		=> '',
			'tipe'								=> '',
			'disc'								=> '0',
		);

		$this->load->view('pg_admin/transaksi_tambah', $data);
	}

	public function proses_beli()
	{
		$now 	= new DateTime(null);
		$params	= $this->input->post(null, true);

		//PERSIAPAN 1
		$new_pembayaran = array(
			"no_tagihan"				=> '', //no_tagihan set in model_transaksi 
			"siswa_id"					=> 0, // Umum tanpa register 
			"kelas_id"					=> 0, //temporary, ganti dengan id_kelas siswa yg sedang login(ambil dari session)
			"metode_pembayaran"	=> $params["metode_pembayaran"], // 1=transfer, 2=indomaret 
			"status"						=> 0, //status 0 untuk pembayaran yang belum dikonfirmasi oleh siswa
			"timestamp"					=> $now->format("Y-m-d H:i:00"),
			"nama"							=> $params["nama"],
			"no_hp"							=> $params["hp"],
			"email"							=> $params["email"],
			"tipe_customer"			=> $params["tipe"],
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
					'jumlah'		=> $params["{$index}"],
					'disc'		=> $params["disc"],
					'metode'		=> $params["metode_pembayaran"],
					);
			}
		}

		if(!empty($detail_pembelian) OR !empty($metode_pembayaran))
		{
			$this->session->set_flashdata('sukses','Data pembelian berhasil ditambahkan');

			$result = $this->model_transaksi->simpan($new_pembayaran, $detail_pembelian);
			if($result > 0){
				$dt = $this->model_transaksi->get_pembelian_umum($result);
				$this->terima($result);
			}
			redirect('pg_admin/transaksi');
		}
		else
		{
			$this->session->set_flashdata('msgpaket','Pilih paket minimal 1 paket yang ingin dibeli');
			$data = array(
				'data_reguler'				=> $this->model_paket->get_paket_reguler(),
				'data_premium'				=> $this->model_paket->get_paket_premium(),
				'nama'								=> $params["nama"],
				'hp'									=> $params["hp"],
				'email'								=> $params["email"],
				'metode_pembayaran'		=> $params["metode_pembayaran"],
				'tipe'								=> $params["tipe"],
				'disc'								=> $params["disc"],
			);

			$this->load->view('pg_admin/transaksi_tambah', $data);
		}
	}

	function batalkan($page,$tab,$id){
			$dt = array(
						"status"			=> 3
					);
			$this->db->where("id_pembelian", $id);
			$query = $this->db->update("pembelian", $dt);
			
			$this->tabel_ajax($tab,0,10,$page);
	}

	function terima($id_pembayaran){
		$pembayaran=$this->model_transaksi->get_info_pembayaran($id_pembayaran);

		foreach($pembayaran as $item){
			for($i=1; $i <= $item->jumlah; $i++){
					$result = $this->model_transaksi->aktivasi_voucher($item->paket_id, $item->kelas_id, "online", $id_pembayaran);
			}
			if ($item->siswa_id > 0){
				$email = $item->email;
			} else {
				$email = $item->email_umum;
			}
		}

		//cari apakah pembayaran ada id event'nya, jika ada, insert semua voucher dengan id pembelian tsb ke tabel voucher_x_event

		$databayar = $this->model_transaksi->fetch_pembayaran_by_id($id_pembayaran);

		if($databayar->id_event !== 0){
			//fetch semua voucher dengan id pembelian tersebut
			$datavoucher = $this->model_transaksi->cari_voucher($id_pembayaran);
			foreach($datavoucher as $voucher){
				$this->model_transaksi->insert_voucher_event($databayar->id_event, $voucher->kode_voucher);
			}
		}

		$result = $this->model_transaksi->update_status("2", $id_pembayaran);
		$this->send_Postmark($id_pembayaran, $email); //POSTMARK
	}
	
	 function send_Postmark($idbayar, $email)
	 {
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
			$this->email->subject('Prime Mobile Activation Code');
			$dataemail = array (
				'table_data' => $this->model_transaksi->cari_voucher($idbayar)
			);

			$body = $this->load->view('pg_admin/email.php',$dataemail,TRUE);
			//print_r($body);die();
			
			$this->email->message($body);
			if($this->email->send())
			{
			  redirect('pg_admin/transaksi');
			}
			else
			{
				show_error($this->email->print_debugger());
			}
	
	 }	 

	private function get_harga_paket($id_paket, $data_paket)
	{
		foreach ($data_paket as $item) {
			if ($item['id_paket'] == $id_paket) {
				return $item['harga'];
			}
		}
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
				break;
		}
	}

	function changeharga(){
		$paket = $this->model_paket->get_paket_reguler_and_dealer();
		$total = 0;
		foreach ($paket as $i){
			$id = $i->id_paket;
			if ($this->input->post('metode') != 5){
				$harga = $this->input->post('harga'.$id) * ($this->input->post('jumlah'.$id) != '' ? $this->input->post('jumlah'.$id) : 0);
			} else {
				$harga = $this->input->post('harga'.$id) * ($this->input->post('jumlah'.$id) != '' ? $this->input->post('jumlah'.$id) : 0);
			}
			$total = $total + ($harga - ($harga * ($this->input->post('disc')/100)));
			if($this->input->post('disc') == "62.8"){
			    $total =  round($total, -3);
			}
		}
		echo number_format($total);
	}
	
	function changeunit(){
		$paket = $this->model_paket->get_paket_reguler_and_dealer();
		$total = 0;
		foreach ($paket as $i){
			$id = $i->id_paket;
			$unit = ($this->input->post('jumlah'.$id) != '' ? $this->input->post('jumlah'.$id) : 0);
			$total = $total + ($unit);
		}
		echo number_format($total);
	}



}
