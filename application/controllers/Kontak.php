<?php 

/**
* 
*/
class Kontak extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('model_pg');
		$this->load->model('model_kontak');
	}

	function index(){
		$data = array(
			'navbar_links' 	=> $this->model_pg->get_navbar_links(),
			'nama'			=> '',
			'email'			=> '',
			'hp'			=> '',
			'pesan'			=> '',
		);

		$this->load->view("pg_user/kontak_kami", $data);
	}

	public function proses_pesan()
	{
		$params   	= $this->input->post(null, true);
		$nama 		= $params['nama'];
		$email   	= $params['email'];
		$hp    		= $params['hp'];
		$pesan   	= $params['pesan'];

		$result = $this->model_kontak->add_pesan($nama, $email, $hp, $pesan);
		$this->session->set_flashdata('sukses','Terima kasih untuk Pesan yang telah anda sampaikan, Customer service kami akan segera merespon pesan anda');

		redirect('kontak');
	}

	function send_email($id_pesan)
	{
		$data = $this->model_kontak->get_pesan($id_pesan);

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
		$this->email->from('cs@primemobile.co.id', $email); // change it to yours
		$this->email->to('cs@primemobile.co.id');// change it to yours
		$this->email->subject('Pesan Dari Pengunjung Primemobile.co.id');

		$body .= "Pesan Dari : ".$data->nama."<br>";
		$body .= "Email : ".$data->email."<br>";
		$body .= "No. HP : ".$data->hp."<br>";
		$body .= "Isi Pesan : ".$data->pesan."<br>";
		$this->email->message($body);		
	}	 

}

 ?>