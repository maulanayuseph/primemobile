<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		
		//check user session

		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
  }

	public function index()
	{
		$data = array(
			'navbar_title' 	=> "Log Akses",
			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'table_data' 		=> $this->model_adm->fetch_log_siswa()
			);

		$this->load->view('pg_admin/log_siswa', $data);
	}

	public function grafik()
	{
		$id = 'ALL';
		$date_start = date('Ym', strtotime(date('M Y').'-4 months'));
		$date_end = date('Ym');
		$result_teks = $this->model_adm->track_akses_by_date($date_start, $date_end, 1);	
		$result_video = $this->model_adm->track_akses_by_date($date_start, $date_end, 2);	
		$result_soal = $this->model_adm->track_akses_soal_by_date($date_start, $date_end);	

		$data = array(
			'navbar_title' 	=> "Log Akses",
			'navbar_title'	=> "Log Akses Siswa",
			'page_title' 		=> "Detail Log Siswa",
			'form_action' 	=> current_url() . "?id=$id",
			'group_log_teks' => $this->model_adm->group_akses_by_id($id, 1, $date_start, $date_end),
			'group_log_video' => $this->model_adm->group_akses_by_id($id, 2, $date_start, $date_end),
			'group_log_soal' => $this->model_adm->group_akses_soal_by_id($id, $date_start, $date_end),
			);

		$start    = new DateTime(date('M Y', strtotime(date('M Y').'-4 months')));
		$start->modify('first day of this month');
		$end      = new DateTime(date('M Y'));
		$end->modify('first day of next month');
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);

		$response = array();
		foreach ($period as $dt) {

			$jumlah_akses_teks = 0;
			foreach ($result_teks as $teks) {
				if($dt->format("Y-m") == $teks['bulan']) {
					$jumlah_akses_teks = $teks['jumlah_akses'];
				}
			}
			$jumlah_akses_video = 0;
			foreach ($result_video as $video) {
				if($dt->format("Y-m") == $video['bulan']) {
					$jumlah_akses_video = $video['jumlah_akses'];
				}
			}
			$jumlah_akses_soal = 0;
			foreach ($result_soal as $soal) {
				if($dt->format("Y-m") == $soal['bulan']) {
					$jumlah_akses_soal = $soal['jumlah_akses'];
				}
			}

			$data['bulan'][] = $dt->format('M'); 
			$data['log_teks'][] = $jumlah_akses_teks; 
			$data['log_video'][] = $jumlah_akses_video; 
			$data['log_soal'][] = $jumlah_akses_soal; 
			$data['log_total'][] = $jumlah_akses_teks + $jumlah_akses_video + $jumlah_akses_soal; 
		}

		$this->load->view('pg_admin/log_grafik_detail', $data);
	}

	public function ajax_grafik()
	{
		header("Content-type: text/json");
		$log_date_start = $this->input->post('log_date_start');
		$log_date_end = $this->input->post('log_date_end');

		$date_start = date('Ym', strtotime($log_date_start));
		$date_end = date('Ym', strtotime($log_date_end));
		$result_teks = $this->model_adm->track_akses_by_date($date_start, $date_end, 1);	
		$result_video = $this->model_adm->track_akses_by_date($date_start, $date_end, 2);	
		$result_soal = $this->model_adm->track_akses_soal_by_date($date_start, $date_end);	

		$start    = new DateTime($log_date_start);
		$start->modify('first day of this month');
		$end      = new DateTime($log_date_end);
		$end->modify('first day of next month');
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);

		$response = array();
		foreach ($period as $dt) {

			$jumlah_akses_teks = 0;
			foreach ($result_teks as $teks) {
				if($dt->format("Y-m") == $teks['bulan']) {
					$jumlah_akses_teks = $teks['jumlah_akses'];
				}
			}
			$jumlah_akses_video = 0;
			foreach ($result_video as $video) {
				if($dt->format("Y-m") == $video['bulan']) {
					$jumlah_akses_video = $video['jumlah_akses'];
				}
			}
			$jumlah_akses_soal = 0;
			foreach ($result_soal as $soal) {
				if($dt->format("Y-m") == $soal['bulan']) {
					$jumlah_akses_soal = $soal['jumlah_akses'];
				}
			}

			$response['bulan'][] = $dt->format('M'); 
			$response['range_teks'][] = $jumlah_akses_teks; 
			$response['range_video'][] = $jumlah_akses_video; 
			$response['range_soal'][] = $jumlah_akses_soal;
			$response['range_total'][] = $jumlah_akses_teks + $jumlah_akses_video + $jumlah_akses_soal; 
		}

		echo json_encode($response, JSON_NUMERIC_CHECK);
	}


	public function manajemen($aksi)
	{
		//$aksi contains the value needed (tambah/ubah) to direct user to Add/Edit form
		if($aksi)
		{
			switch ($aksi) {
				case 'detail_log':
					//Passing id value from GET '?id' to variable '$id'
					$id = $this->input->get('id') ? $this->input->get('id') : null ;
					
					$data = array(
					'navbar_title'	=> "Log Akses Siswa",
					'page_title' 		=> "Detail Log Siswa",
					'form_action' 	=> current_url() . "?id=$id",
					'data_siswa' 		=> $this->model_adm->fetch_siswa_by_id($id),
					'log_teks' 			=> $this->model_adm->track_akses_by_id($id, 1), // 1=teks 
					'log_video' 		=> $this->model_adm->track_akses_by_id($id, 2), // 2=video 
					'log_soal' 			=> $this->model_adm->track_akses_soal_by_id($id), // 3=soal 
					'group_log_teks' => $this->model_adm->group_akses_by_id($id, 1),
					'group_log_video' => $this->model_adm->group_akses_by_id($id, 2),
					'group_log_soal' => $this->model_adm->group_akses_soal_by_id($id),
					'akses_terakhir' 	=> $this->model_adm->last_akses_by_id($id),
					);

					//Redirect to siswa if id is not exist
					if(!$id)
					{
						redirect('pg_admin/log');
					}
					else 
					{
						$this->load->view('pg_admin/log_siswa_detail', $data);
					}
					break;
				
				default:
					redirect('pg_admin/log');
					break;
			}
		}
		else
		{
			redirect('pg_admin/log');
		}
	}
	
	public function proses_hapus()
	{

		if($this->input->post('deleteRow_submit'))
		{
			//set form validation rules 
			$this->form_validation->set_rules('hidden_row_id', "Nomor Baris", 'trim|required|numeric');

			if($this->form_validation->run())
			{
				$id 		= $this->input->post('hidden_row_id');
				$result = $this->model_adm->delete_log_siswa($id);
				
				alert_success('Sukses', "Data berhasil dihapus");
				redirect('pg_admin/log');
			}
		}
		
		alert_danger('Error', "Data gagal dihapus");
		redirect('pg_admin/log');
	}

	public function log_by_date()
	{
		$id_siswa = $this->input->post('id');
		$log_date_start = $this->input->post('log_date_start');
		$log_date_end = $this->input->post('log_date_end');
		
		if($id_siswa && $log_date_start && $log_date_end) {
			$date_start = date('Ym', strtotime($log_date_start));
			$date_end = date('Ym', strtotime($log_date_end));
			
			$group_teks = $this->model_adm->group_akses_by_id($id_siswa, 1, $date_start, $date_end);
			$group_video = $this->model_adm->group_akses_by_id($id_siswa, 2, $date_start, $date_end);
			$group_soal = $this->model_adm->group_akses_soal_by_id($id_siswa, $date_start, $date_end);
			
			$ranged_data = array('data_teks'=>'', 'data_video'=>'', 'data_soal'=>'','count_teks'=>0,'count_video'=>0,'count_soal'=>0 
				);
			foreach ($group_teks as $teks) {
				$ranged_data['data_teks'] .= 
				"<tr>".
          "<td>".$teks['alias_kelas']."</td>".
          "<td>".$teks['nama_mapel']."</td>".
          "<td class='text-center'>".$teks['jumlah_akses']." x</td>".
        "</tr>";
				$ranged_data['count_teks'] += $teks['jumlah_akses'];
			}
			foreach ($group_video as $video) {
				$ranged_data['data_video'] .= 
				"<tr>".
          "<td>".$video['alias_kelas']."</td>".
          "<td>".$video['nama_mapel']."</td>".
          "<td class='text-center'>".$video['jumlah_akses']." x</td>".
        "</tr>";
				$ranged_data['count_video'] += $video['jumlah_akses'];
			}
			foreach ($group_soal as $soal) {
				$ranged_data['data_soal'] .= 
				"<tr>".
          "<td>".$soal['alias_kelas']."</td>".
          "<td>".$soal['nama_mapel']."</td>".
          "<td class='text-center'>".$soal['jumlah_akses']." x</td>".
        "</tr>";
				$ranged_data['count_soal'] += $soal['jumlah_akses'];
			}

			echo json_encode($ranged_data);
		}
	}

}
