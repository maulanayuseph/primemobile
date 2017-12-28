<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		//$this->load->library('usertracking');
		$this->load->helper('alert_helper');
		$this->load->model('model_pg');
		$this->load->model('model_agcu');
		$this->load->model('model_poin');
		$this->load->model('model_rencana_belajar');
  }

	public function index()
	{
		$data = array(
			'navbar_links' => $this->model_pg->get_navbar_links(),
			);

		$this->load->view('pg_user/home', $data);
	}

	public function tabel_konten($mapel)
	{
		/*
		if (count($_SESSION['akses']) == 0){
			redirect('login');
		}
		*/
		
		$data = array(
			'navbar_links'=> $this->model_pg->get_navbar_links(),
			'header'			=> $this->model_pg->get_mapel_by_id($mapel),
			'table_data'	=> $this->model_pg->get_materi_by_mapel($mapel),
			//'list_data'		=> $this->model_pg->get_all_sub_materi(),
			'list_data'		=> $this->model_pg->get_all_sub_materi_by_mapel($mapel),
			'video_demo'  => $this->model_pg->get_video_demo($mapel)
			);
		//print_r($data);exit;
		$this->load->view('pg_user/tabel_konten', $data);
	}

	public function tabel_konten_detail($materi)
	{
		/*
		if (count($_SESSION['akses']) == 0){
			redirect('login');
		}
		*/
		
		$data = array(
			'navbar_links' 	=> $this->model_pg->get_navbar_links() ,
			'header'				=> $this->model_pg->get_mapel_by_materi($materi),
			// 'data' 				=> $this->model_pg->get_sub_materi_by_materi($materi),
			//'data' 					=> $this->model_pg->get_all_materi(),
			//'list_pokok'		=> $this->model_pg->fetch_list_group_by('materi_pokok', '', 'urutan'),
			'list_sub'			=> $this->model_pg->fetch_list_konten_by_materi($materi), //ADDED BY RUSMANTO
			//'list_sub'			=> $this->model_pg->fetch_list_konten(),
			// 'table_data' 	=> $this->model_pg->get_all_konten_materi()
			// 'table_data' => $this->model_pg->fetch_kategori_konten($materi)
			
			);
		$allow_akses = $this->validasi_akses_siswa($data['header']->id_kelas);
		$data['allow_akses'] = $allow_akses;
		
		$mapel = $this->model_pg->get_mapel_by_materi($materi);
		//if($this->session->userdata('id_siswa') !== null and $_SESSION['akses']['reguler'][0] !== '38' and $_SESSION['akses']['reguler'][0] !== '37'){
		if($this->session->userdata('id_siswa') !== null){
			$data['list_pokok'] = $this->model_pg->fetch_list_pokok_by_rencana_belajar($this->session->userdata('id_siswa'));
			$data['data'] = $this->model_pg->fetch_list_pokok_by_rencana_belajar($this->session->userdata('id_siswa'));
			$data['jumlahmateribelajar'] = $this->model_rencana_belajar->get_jumlah_konten_belajar($mapel->id_mapel, $this->session->userdata('id_siswa'));
		}else{
			$data['list_pokok'] = $this->model_pg->fetch_list_group_by('materi_pokok', '', 'urutan');
			$data['data'] = $this->model_pg->get_all_materi();
		}
		
		$this->load->view('pg_user/tabel_konten_detail', $data);
	}

	public function konten_teks($id)
	{
		/*
		if (count($_SESSION['akses']) == 0){
			redirect('login');
		}
		*/
		
		$idsiswa = $this->session->userdata('id_siswa');
		
		//cari id sub materi
		$carisub = $this->model_pg->get_konten_by_id($id);
		//masukkan pencapaian siswa
		$this->model_rencana_belajar->insert_pencapaian_siswa($idsiswa, $carisub->sub_materi_id);
	
		//tracking logged user's access

		//KOMEN SEMENTARA
    	//$this->usertracking->track_this_session();
		
		$data = array(
			'navbar_links' 	=> $this->model_pg->get_navbar_links(),
			'header'		=> $this->model_pg->get_mapel_by_konten($id),
			'sidebar'		=> $this->model_pg->get_sub_materi_by_konten($id),
			'next'			=> $this->model_pg->get_next_sub_materi($id),
			'data'			=> $this->model_pg->get_konten_by_id($id)
			);
		$allow_akses = $this->validasi_akses_siswa($data['header']->id_kelas);
		$data['allow_akses'] = $allow_akses;
		//SET POIN SISWA
		if(isset($_SESSION['id_siswa'])) {
			$addpoin = $this->model_poin->add_poin_siswa($_SESSION['id_siswa'], 'akses_materi');
		}
		$this->load->view('pg_user/materi_teks', $data);
	}
    public function teks($kurikulum, $id)
	{
		/*
		if (count($_SESSION['akses']) == 0){
			redirect('login');
		}
		*/
		
		$idsiswa = $this->session->userdata('id_siswa');
		
		//cari id sub materi
		$carisub = $this->model_pg->get_konten_by_id($id);
		//masukkan pencapaian siswa
		$this->model_rencana_belajar->insert_pencapaian_siswa($idsiswa, $carisub->sub_materi_id);
	
		//tracking logged user's access
    	//$this->usertracking->track_this_session();
		
		$data = array(
			'navbar_links' 	=> $this->model_pg->get_navbar_links(),
			'header'		=> $this->model_pg->get_mapel_by_konten($id),
			'sidebar'		=> $this->model_pg->get_sub_materi_by_konten_and_kurikulum($id, $kurikulum),
			'next'			=> $this->model_pg->get_next_sub_materi($id),
			'data'			=> $this->model_pg->get_konten_by_id($id)
			);
		$allow_akses = $this->validasi_akses_siswa($data['header']->id_kelas);
		$data['allow_akses'] = $allow_akses;
		//SET POIN SISWA
		if(isset($_SESSION['id_siswa'])) {
			$addpoin = $this->model_poin->add_poin_siswa($_SESSION['id_siswa'], 'akses_materi');
		}
		$this->load->view('pg_user/materi_teks', $data);
	}
	public function konten_video($id)
	{
		/*
		if (count($_SESSION['akses']) == 0){
			redirect('login');
		}
		*/
		
		$idsiswa = $this->session->userdata('id_siswa');
		
		//masukkan pencapaian siswa
		$this->model_rencana_belajar->insert_pencapaian_siswa($idsiswa, $id);
		
		//tracking logged user's access
    	//$this->usertracking->track_this_session();
		
		$data = array(
			'navbar_links'=> $this->model_pg->get_navbar_links(),
			'header'			=> $this->model_pg->get_mapel_by_konten($id),
			'sidebar'			=> $this->model_pg->get_sub_materi_by_konten($id),
			'next'				=> $this->model_pg->get_next_sub_materi($id),
			'data'				=> $this->model_pg->get_konten_by_id($id)
			);
		$allow_akses = $this->validasi_akses_siswa($data['header']->id_kelas);
		$data['allow_akses'] = $allow_akses;
		//SET POIN SISWA
		if(isset($_SESSION['id_siswa'])) {
			$addpoin = $this->model_poin->add_poin_siswa($_SESSION['id_siswa'], 'akses_materi');
		}
		$this->load->view('pg_user/materi_video', $data);
	}
	
	function get_konten_by_sub_materi($id_sub_materi)
	{
		$this->db->select('*');
		$this->db->from('konten_materi');
		$this->db->join('sub_materi', 'sub_materi.id_sub_materi = konten_materi.sub_materi_id', 'left');
		$this->db->where('konten_materi.sub_materi_id', $id_sub_materi);
		//tester
		//echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->result();
	}

	//DIMAS
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
			}else if(array_key_exists('event', $akses)){
				$data_mapel = $id_kelas;
				
				if(in_array($data_mapel, $akses['event'])) {
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

	function ajax_change_content($id_konten=NULL) 
	{
		// header('Content-Type: application/json');
		$id 	= $this->input->post('id');
		$tipe = $this->input->post('tipe');

		if(!empty($id))
		{
		//SET POIN SISWA
			if(isset($_SESSION['id_siswa'])) {
				$addpoin = $this->model_poin->add_poin_siswa($_SESSION['id_siswa'], 'akses_materi');
			}
			//tracking logged user's access
    		//$this->usertracking->track_this_session();
			switch ($tipe) 
			{
				case 'teks':
					$result = $this->model_pg->get_konten_by_id($id);
					$result_array = array(
						'judul_materi'  => $result->nama_sub_materi,
						'isi_materi'		=> html_entity_decode($result->isi_materi),
						'lnk_download'	=> '<a href="'.base_url('materi_download/download_materi/'.$result->id_konten).'" class="btn btn-primary" target="_blank">Download PDF</a>'
						);
					header('Content-Type: application/json');
					echo json_encode($result_array);

					break;

				case 'video':
					$result = $this->model_pg->get_konten_by_id($id);
					$result_array = array(
						'judul_materi'  => $result->nama_sub_materi,
						'video_materi'	=> $result->video_materi
						);
					header('Content-Type: application/json');
					echo json_encode($result_array);

					break;
				
				default:
					echo "No such content type";
					break;
			}
		}
		else
		{
			echo "No data";
		}
	}


function ajax_view_video(){
	$urlvideo = $this->input->post('urlvideo');
	?>
	<div id="stream-tester-player-https"></div>
	<script>
	jwplayer("stream-tester-player-https").setup({
	  "playlist": [
	    {
	      "sources": [
	        {
	          "default": false,
	          "file": "<?php echo $urlvideo; ?>",
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
