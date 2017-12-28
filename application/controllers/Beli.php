<?php 

/**
* 
*/
class Beli extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model("model_paket");
		$this->load->model("model_bank");
		$this->load->model("model_pembayaran");
	}

	function index($id_paket=null){
		if ($id_paket==null) {
			show_404();
		}
		$data = array(
				'detail_paket' => $this->model_paket->get_detail_paket($id_paket),
				'bank'=> $this->model_bank->get_bank()
			);
		$this->load->view("pg_user/beli", $data);
	}

	function simpan(){

		$this->form_validation_rules();

		$now=new DateTime(null);
		$params=$this->input->post(null, true);
		// $id_siswa=1; //temporary, ganti dengan id_siswa yg sedang login(ambil dari session)
		// $id_bank=$params["id_bank"];
		// $no_rekening=$params["no_rek"];
		// $id_paket=$params["id_paket"];
		// $status=0;
		// $timestamp=$now->format("Y-m-d H:i:s");
		
		// $expired_on=$now->format("Y-m-d H:i:s");

		$new_pembayaran=array(
			"id_siswa"=>$_SESSION['id_siswa'], //temporary, ganti dengan id_siswa yg sedang login(ambil dari session)
			"id_bank"=>$params["id_bank"],
			"no_rekening"=>$params["no_rek"],
			"id_paket"=>$params["id_paket"],
			"status"=>0,
			"timestamp"=>$now->format("Y-m-d H:i:00")
			);

		$now->add(new DateInterval('P1D'));

		$new_pembayaran['expired_on']=$now->format("Y-m-d H:i:00");
		//var_dump($new_pembayaran);exit();
		if($this->form_validation->run()==TRUE){
			$result=$this->model_pembayaran->simpan($new_pembayaran);

			redirect("beli/konfirmasi/".$result);
		}
	}

	function form_validation_rules()
	{
		//set validation rules for each input
		$this->form_validation->set_rules('id_bank', 'Kategori Materi', 'trim|required');
		$this->form_validation->set_rules('no_rek', 'Mata Pelajaran', 'trim|required');
		
		//set custom error message
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
	}

	function konfirmasi($id_pembayaran=null){
		if ($id_pembayaran===null) {
			show_404();
		}
		$this->cek_expired($id_pembayaran);
		$detail_pembayaran=$this->model_pembayaran->get_detail_pembayaran($id_pembayaran);

		switch ($detail_pembayaran[0]['status']) {
			case '0':
			// status:waiting confirmation
				$data = array(
					'detail_pembayaran' => $detail_pembayaran,
					// 'sisa_waktu' => $this->secondsToWords(strtotime($detail_pembayaran[0]['expired_on'])-strtotime(date("Y-m-d H:i:s")))
					'sisa_waktu' => $this->sisa_waktu($detail_pembayaran[0]['expired_on'])
				 );

				$this->load->view("pg_user/konfirmasi", $data);
				break;
			case '1':
				// status:file uploaded
				$data=array(
					"info_paket"=>$this->model_pembayaran->get_info_paket($id_pembayaran)
					);
				$this->load->view("pg_user/konfirmasi_waiting_confirmation", $data);
				break;
			case '2':
				# status:pembayaran accepted by admin
				$data=array(
					"info_paket"=>$this->model_pembayaran->get_info_paket_aktif($id_pembayaran)
					);
				$this->load->view("pg_user/konfirmasi_accepted", $data);
				break;
			case '3':
				# status:pembayaran rejected by admin
				$this->load->view("pg_user/konfirmasi_rejected");
				break;
			default:
				# code...
				break;
		}

	}

	function sisa_waktu($expired_on){
		if ($expired_on==null) {
			return null;
		}
		$detik=strtotime($expired_on)-strtotime(date("Y-m-d H:i:s"));
		$hari = ($detik>(86400)) ? ($detik/(86400))%24 : 0 ;
		$jam=($detik>(3600)) ? (($detik%(86400))/(3600))%60 : 0;
		$menit=($detik>(60)) ? ($detik%(3600)/60)%60 : 0;
		$result=$hari." Hari ".$jam." Jam ".$menit." Menit";
		return $result;
	}


	function simpan_konfirmasi(){
		$params=$this->input->post(null, true);
		
		// $data=array(
		// 	"file_bukti"=>$this->upload_file($params['file_bukti'])
		// 	);
		// if ($this->form_validation->run()==TRUE) {
			
			$file_bukti=$this->upload_file();
			$this->model_pembayaran->update_file_bukti($file_bukti, $params['id_pembayaran']);

			redirect("beli/konfirmasi/".$params['id_pembayaran']);
		// }
	}

	function cek_expired($id_pembayaran){
		$pembayaran=$this->model_pembayaran->get_detail_pembayaran($id_pembayaran);
		
		if (strtotime($pembayaran[0]['expired_on'])<=strtotime(date('Y-m-d H:i:00')) && $pembayaran[0]['status']==0) {
			$this->model_pembayaran->update_status("3", $id_pembayaran);
		}
	}

	function upload_file(){
		$result=null;
		$tipe=$this->cek_tipe($_FILES['file_bukti']['type']);
		// var_dump($_FILES['file_bukti']);exit();
		$img_path="assets/uploads/verifikasi/";
		$img_name="verifikasi_".substr(sha1(substr(md5($_FILES['file_bukti']['name']),0,4).rand(uniqid())), 0, 7).$tipe;
		$config['upload_path']=$img_path;
		$config['allowed_types']="png|jpg";
		$config['file_name']=$img_name;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload('file_bukti')) {
			$result=$img_name;
		}else{
			$this->upload->display_errors();
		}
		return $result;
	}

	function cek_tipe($tipe)
	{
					if ($tipe=='image/jpeg') {
						return ".jpg";
					}
					elseif($tipe=='image/png'){
						return ".png";
					}
					
					else{
						return false;
					}
	}
}

 ?>