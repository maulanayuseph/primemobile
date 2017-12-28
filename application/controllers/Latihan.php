<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Latihan extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method.
		$this->load->library('usertracking');
		$this->load->library('session');
		$this->load->helper('alert_helper');
		$this->load->model('model_pg');
		$this->load->model('model_poin');
		$this->load->model('model_rencana_belajar');
		$this->load->model('model_komentar_soal');
		$this->output->delete_cache();
  }

	public function index($id_sub_materi)
	{
		if(!$id_sub_materi)
		{
			//Redirect history back -1
			redirect($_SERVER['HTTP_REFERER']);
		}

		$data = array(
			'navbar_links' 	=> $this->model_pg->get_navbar_links(), 
			'data'			=> $this->model_pg->get_sub_materi_by_id($id_sub_materi),						
			'infolatihan'	=> $this->model_pg->get_info_latihan($id_sub_materi),						
			'jumlahsoal'	=> $this->model_pg->get_jumlah_soal_latihan($id_sub_materi)
			);
		$id_kelas = $this->model_pg->get_mapel_by_materi($data['data']->materi_pokok_id);
		$allow_akses = $this->validasi_akses_siswa($id_kelas->id_kelas);
		$data['allow_akses'] = $allow_akses;
		//echo $id_kelas->id_kelas;
		//tester
		// echo "<pre>";
		// print_r($_SESSION);
		// echo "</pre>";

		$this->load->view('pg_user/latihan_soal_mulai', $data);
	}

	public function soal($id_sub_materi)
	{
		$data = array(
			'navbar_links' 	=> $this->model_pg->get_navbar_links(),
			'data_soal'			=> $this->model_pg->fetch_soal_by_submateri_random($id_sub_materi),
			'header'				=> $this->model_pg->get_sub_materi_by_id($id_sub_materi),
			'poin'			=> $this->model_poin->fetch_poin_bonus('jawaban_benar'),
			'infolatihan'	=> $this->model_pg->get_info_latihan($id_sub_materi)
			);
		$id_kelas = $this->model_pg->get_mapel_by_materi($data['header']->materi_pokok_id);
		$allow_akses = $this->validasi_akses_siswa($id_kelas->id_kelas);
		$data['allow_akses'] = $allow_akses;

		//jika soal UN dan pembahasan fetch semua soal, jangan cuma 10
		if($id_kelas->id_kelas == 42 or $id_kelas->id_kelas == 43 or $id_kelas->id_kelas == 39 or $id_kelas->id_kelas == 41){
            $data['data_soal']  = $this->model_pg->fetch_soalun_by_submateri_random($id_sub_materi);
        }

		// if(!isset($_SESSION['data_latihan']))
		// {
			//preparing list jawaban
			$list_jawaban = array();
			for($i=1; $i<=count($data['data_soal']); $i++) {
				$list_jawaban[] = 0;
			}

			$session = array(
				'data_latihan' => array(
					'list_jawaban' => $list_jawaban,
					'sedang_mengerjakan' 	=> true,
					'skor'								=> 0,
					'id_materi'						=> $id_sub_materi,
					'id_pokok'						=> $this->model_pg->get_sub_materi_by_id($id_sub_materi)->materi_pokok_id
					),
				'kunci_soal' => $this->model_pg->fetch_array_id_soal($id_sub_materi) 
				// 'kunci' 	=> $this->model_pg->fetch_array_kunci
				);
				$this->session->set_userdata("benar-" . $id_sub_materi, 0);
				$this->session->set_userdata("salah-" . $id_sub_materi, 0);
			$this->session->set_userdata($session);
			session_write_close();
		// }

		if((!$id_sub_materi) OR (!$_SESSION['data_latihan']['sedang_mengerjakan']))
		{
			//Redirect history back -1
			redirect($_SERVER['HTTP_REFERER']);
		}

		// print_r(json_encode($_SESSION));
		//tester
		// echo "<pre>";
		// print_r($_SESSION);
		// echo "</pre>";
		// die();
		
		$this->load->view('pg_user/latihan_soal', $data);
	}

	public function penilaian()
	{
		$submit = $_POST['submit_form_soal'];
		if(!$submit)
		{	
			redirect($_SERVER['HTTP_REFERER']);
		}	

		$skor = $this->input->post('skor');
		//id sub materi dari latihan soal
		$id_sub_materi = $_SESSION['data_latihan']['id_materi'] ? $_SESSION['data_latihan']['id_materi'] : 0;
		// $jumlah_soal = $this->model_pg->jumlah_soal($id_sub_materi);
		$data_soal = $this->model_pg->fetch_soal_by_submateri($id_sub_materi);
		$jumlah_soal = count($data_soal);
		
		
		
		$idsiswa = $_SESSION['id_siswa'];
		
		//cari jumlah bobot soal
		$jumlahbobot 	= $this->model_pg->fetch_jumlah_bobot($id_sub_materi);
		$bobotsiswa		= $this->model_pg->fetch_bobot_siswa($id_sub_materi, $idsiswa);
		$nilaisiswa		= number_format(($bobotsiswa->bobot_siswa / $jumlahbobot->jumlah_bobot) * 100, 2, '.', ',');
		
		
		$jumlahbenar = $_SESSION["benar-" . $id_sub_materi];
		$jumlahsalah = $_SESSION["salah-" . $id_sub_materi];
		$totalsoal = $jumlahbenar + $jumlahsalah;
		$skorterakhir = round((($jumlahbenar/$totalsoal)*100), 1);
		
		//insert status latihan
		/*
		if($nilaisiswa < 70){
			$this->model_pg->insert_status_latihan($idsiswa, $id_sub_materi, 0, $skorterakhir);
			$this->model_rencana_belajar->delete_pencapaian_siswa($idsiswa, $id_sub_materi);
		}else{
			$this->model_pg->insert_status_latihan($idsiswa, $id_sub_materi, 1, $skorterakhir);
			$this->model_rencana_belajar->insert_pencapaian_siswa($idsiswa, $id_sub_materi);
		}
		*/
		if($skorterakhir < 70){
			$this->model_pg->insert_status_latihan($idsiswa, $id_sub_materi, 0, $skorterakhir);
			$this->model_rencana_belajar->delete_pencapaian_siswa($idsiswa, $id_sub_materi);
		}else{
			$this->model_pg->insert_status_latihan($idsiswa, $id_sub_materi, 1, $skorterakhir);
			$this->model_rencana_belajar->insert_pencapaian_siswa($idsiswa, $id_sub_materi);
		}
		
		
		// $data_latihan = array('skor' => $skor);
		// $session 			= array($data_latihan);
		// $this->session->set_userdata(array('data_latihan' => array('skor' => 700)));
		
		
		//NEW WAY TO CALCULATE FINAL SKOR
		if(isset($_SESSION['data_latihan']['list_jawaban'])) {
			$jwb = 0;
			foreach ($_SESSION['data_latihan']['list_jawaban'] as $list) {
				if($list) {
					$jwb += 1;
				}
			}
			$skor = $jwb;
		} 
		
		
		if(($jumlah_soal > 0) && ($skor > 0))
			{ $final_skor = round(((100/$jumlah_soal) * $skor), 1); }
		else 
			{ $final_skor = 0; }



		$_SESSION['data_latihan']['skor'] = $skor;

		//tester
		// echo "Jumlah soal: ". " -> ". $jumlah_soal;
		// print_r($_SESSION['data_latihan']);
		// $this->session->set_userdata('data_latihan')['sedang_mengerjakan'] = false;
		// print_r($this->session->userdata('data_latihan')['sedang_mengerjakan']);
		
		$data = array(
			'navbar_links' 	=> $this->model_pg->get_navbar_links(),
			//'skor'					=> $final_skor
			//'skor'					=> $nilaisiswa
			'skor'					=> $skorterakhir,
			'jumlah_soal'			=> $totalsoal,
			'jumlah_benar'			=> $_SESSION['benar-'.$id_sub_materi],
			'jumlah_salah'			=> $_SESSION['salah-'.$id_sub_materi],
			'idsubmateri'			=> $id_sub_materi,
			);

		// echo "<pre>";
		// print_r($_SESSION);
		// echo "</pre>";
		$this->load->view('pg_user/latihan_soal_selesai', $data);
	}

	public function validasi_akses_siswa($id_kelas)
	{
		$allow_akses = FALSE;
		
		if(isset($_SESSION['akses']))
		{
			$akses = $this->session->userdata('akses');
		
			if(array_key_exists('premium', $akses))
			{
				// echo "Premium ADA!";
				$allow_akses = TRUE;
			}
			else if(array_key_exists('reguler', $akses))
			{
				$data_mapel = $id_kelas;
				
				if(in_array($data_mapel, $akses['reguler'])) {
					// echo "$data_mapel ADA!";
					$allow_akses = TRUE;
				}
				else {
					// echo "$data_mapel GAK ADA!";
					$allow_akses = FALSE;
				}
			}
			else {
				// echo "Reguler GAK ADA!";
				$allow_akses = FALSE;
			}
		}

		return $allow_akses;
	}

	public function ajax_check_jawaban()
	{
		$result 	= "No data";
		$id_soal 	= $this->input->post('id');
		$jawaban 	= $this->input->post('jawaban');
	
		$idsiswa = $_SESSION['id_siswa'];
		$idsubmateri = $_SESSION['data_latihan']['id_materi'];
		
		if(!empty($id_soal) && !empty($jawaban))
		{
				$kunci_soal = $this->session->userdata('kunci_soal');
				foreach ($kunci_soal as $key=>$item) 
				{
					if($item['id_soal'] == $id_soal)
					{
						if($item['kunci_jawaban'] == $jawaban)
						{
							$_SESSION['data_latihan']['list_jawaban'][$key] = 1;
							$_SESSION["benar-" . $idsubmateri] += 1;
							// $this->session->set_userdata('data_latihan')['skor'];
							session_write_close();
							
							$result = "benar";
							//SET POIN SISWA
							if(isset($_SESSION['id_siswa'])){
						      	$addpoin = $this->model_poin->add_poin_siswa($_SESSION['id_siswa'], 'jawaban_benar');
						      	}
							$insertanalisislatihan = $this->model_pg->insert_analisis_latihan($idsiswa, $id_soal, $idsubmateri, $jawaban, 1);
						}
						else
						{
							$_SESSION["salah-" . $idsubmateri] += 1;
							$_SESSION['data_latihan']['list_jawaban'][$key] = 0; 
							$result = "salah";
							$insertanalisislatihan = $this->model_pg->insert_analisis_latihan($idsiswa, $id_soal, $idsubmateri, $jawaban, 0);
						}
					}
				}
				// print_r($kunci_soal);

				//Implode Multidimensional Array
				// $kunci = implode(', ', array_map(function ($entry) {
				//   return $entry['kunci_jawaban'];
				// }, $_SESSION['kunci_soal']));

			//FETCH DATA FROM DB
			// $row = $this->model_pg->fetch_jawaban_by_soal($id_soal);
			// if ($jawaban == $row->kunci_jawaban) 
			// {
			// 	$result = "benar";
			// }
		}
		
		echo $result;
	}

	public function ajax_fetch_pembahasan()
	{
		$id_soal 					= $this->input->post('id');
		$tipe_pembahasan 	= $this->input->post('tipe');

		if(!empty($id_soal) && !empty($tipe_pembahasan))
		{
			$row = $this->model_pg->fetch_jawaban_by_soal($id_soal);
			
			if (!empty($row)) 
			{
				//if tipe pembahasan == teks
				if($tipe_pembahasan == 'teks')
				{
					echo html_entity_decode($row->pembahasan);
				}

				//if tipe pembahasan == video
				elseif($tipe_pembahasan == 'video')
				{
				?>
					<div id="stream-tester-player-https"></div>
					<script>
					jwplayer("stream-tester-player-https").setup({
					  "playlist": [
					    {
					      "sources": [
					        {
					          "default": false,
					          "file": "<?php echo str_replace('manifest.mpd','playlist.m3u8',$row->pembahasan_video) ?>",
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
					//echo $row->pembahasan_video;
				}
			}
		}
		else
		{
			echo "No data"; 
		}
	}



function komentar($idsoal){
	$data = array(
		"idsoal"	=> $idsoal
	);
	$this->load->view("pg_user/latihan_ajax/ajax_komentar", $data);
}

function submit_komentar(){
	$params 	= $this->input->post(null, true);
	$idsoal 	= $params['idsoal'];
	$tipe 		= $params['tipe'];
	$komentar 	= $params['komentar'];

	$this->model_komentar_soal->submit_komentar($idsoal, $tipe, $komentar, $this->session->userdata('id_siswa'));
}


}

 ?>