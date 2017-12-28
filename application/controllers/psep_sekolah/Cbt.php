<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cbt extends CI_Controller {

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
		$this->load->model('model_psep');
		$this->load->model('model_dashboard');
		$this->load->model('model_agcu');
		$this->load->model('model_lstest');
		$this->load->model('model_pg');
		$this->load->model('model_tryout');
		$this->load->model('model_fronttryout');
		$this->load->model('model_security');
		$this->load->model('model_psep_cbt');
		$this->model_security->psep_sekolah_is_logged_in();
	}
	
function index(){
	$idpsep = $this->session->userdata('idpsepsekolah');
	$idsekolah = $this->session->userdata('idsekolah');
	$carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);
	$data = array(
		'navbar_title' 	=> "Report CBT",
		'sekolah'		=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
		'datacbt'		=> $this->model_psep->fetch_profil_by_sekolah($idsekolah),
		'tahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah)
	);
	
	$this->load->view("psep_sekolah/cbt", $data);
}

function listkategori($idprofil){
	$datakategori = $this->model_psep->get_tryout_by_profil2($idprofil);
	
	echo '
		<tr>
			<th style="text-align: center; width: 10px;">No.</th>
			<th style="text-align: center;">Nama</th>
			<th style="text-align: center;">Kelas</th>
	';
	foreach($datakategori as $kategori){
		echo "
			<th>".$kategori->nama_kategori."</th>
		";
	}
	echo '
			<th style="text-align: center;">Jumlah Nilai</th>
			<th style="text-align: center;">Skor</th>
			<th style="text-align: center;">Waktu</th>
			<th style="text-align: center;">Operasi</th>
		</tr>
	';
}

function ajax_kelas_by_profil($idprofil){
	$dataprofil	= $this->model_tryout->fetch_profil_by_id($idprofil);
	$idsekolah 	= $this->session->userdata('idsekolah');
	$datakelas 	= $this->model_psep->fetch_kelas_paralel_by_kelas($idsekolah, $dataprofil->id_kelas);
	
	echo "<option value='0'>-- Pilih Kelas --</option>";
	foreach($datakelas as $kelas){
		?>
		<option value="<?php echo $kelas->id_kelas_paralel;?>"><?php echo $kelas->kelas_paralel;?></option>
		<?php
	}
}

function ajax_peringkat($idprofil){
	$totalsoal		= $this->model_dashboard->total_soal_byprofil($idprofil);

	$idsekolah = $this->session->userdata('idsekolah');
	$dataperingkat 	= $this->model_dashboard->peringkat_by_sekolah($idprofil, $idsekolah);
	
	
	
	$no = 1;
	foreach($dataperingkat as $peringkat){
		
		$datasiswa = $this->model_dashboard->data_peringkat_psep($peringkat->id_siswa, $idprofil);
		
		
		if(isset($peringkat->waktu_kerja)){
			$waktu = round($peringkat->waktu_kerja / 60, 2);
	?>
		<tr>
			<td><?php echo $no; ?></td>
			<td>
			
			<?php 
				echo $datasiswa->nama_siswa;
			?>
			</td>
			
			<td class="text-center"><?php echo $datasiswa->alias_kelas; ?><br> </td>
			
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
				echo number_format($peringkat->jumlah_bobot_benar, 2, '.', '');
			?>
			</td>
			<td class="text-center"><?php echo number_format(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2, '.', ''); ?>%</td>
			<td class="text-center"><?php echo $waktu; ?> Menit</td>
			<td class="text-center">
				<a href="<?php echo base_url("psep_sekolah/cbt/detail/" .$idprofil . "/".$peringkat->id_siswa);?>" class="btn btn-primary btn-sm">
				<i class="fa fa-bars" aria-hidden="true"></i>
				</a>
				<a href="<?php echo base_url("psep_sekolah/cbt/download/" .$idprofil . "/".$peringkat->id_siswa);?>" class="btn btn-success btn-sm" target="_BLANK">
				<i class="fa fa-print" aria-hidden="true"></i>
				</a>
			</td>
		</tr>
	<?php
		$no++;
		}
	}
}

function ajax_peringkat_by_kelas($idprofil, $idkelasparalel, $idtahunajaran){
	$totalsoal		= $this->model_dashboard->total_soal_byprofil($idprofil);

	$idsekolah = $this->session->userdata('idsekolah');
	$dataperingkat 	= $this->model_dashboard->peringkat_by_sekolah($idprofil, $idsekolah);
	
	
	
	$no = 1;
	foreach($dataperingkat as $peringkat){
		
		$datasiswa = $this->model_dashboard->data_peringkat_psep($peringkat->id_siswa, $idprofil);
		
		
		if(isset($peringkat->waktu_kerja)){
			$waktu = round($peringkat->waktu_kerja / 60, 2);

		//cek dulu apakah siswa ada di kelas dan tahun ajaran
		$ceksiswa = $this->model_psep_cbt->cek_kelas_and_tahun_siswa($peringkat->id_siswa, $idkelasparalel, $idtahunajaran);

		if($ceksiswa > 0){
			?>
				<tr>
					<td><?php echo $no; ?></td>
					<td>
					
					<?php 
						echo $datasiswa->nama_siswa;
					?>
					</td>
					
					<td class="text-center"><?php echo $datasiswa->alias_kelas; ?><br> </td>
					
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
						echo number_format($peringkat->jumlah_bobot_benar, 2, '.', '');
					?>
					</td>
					<td class="text-center"><?php echo number_format(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2, '.', ''); ?>%</td>
					<td class="text-center"><?php echo $waktu; ?> Menit</td>
					<td class="text-center">
						<a href="<?php echo base_url("psep_sekolah/cbt/detail/" .$idprofil . "/".$peringkat->id_siswa);?>" class="btn btn-primary btn-sm">
						<i class="fa fa-bars" aria-hidden="true"></i>
						</a>
						<a href="<?php echo base_url("psep_sekolah/cbt/download/" .$idprofil . "/".$peringkat->id_siswa);?>" class="btn btn-success btn-sm" target="_BLANK">
						<i class="fa fa-print" aria-hidden="true"></i>
						</a>
					</td>
				</tr>
			<?php
				$no++;
				}
		}
	}
}

function abs(){
	if($this->input->get('kelas') == null or $this->input->get('profil') == null){
		alert_error("Error", "Pilih Profil dan Kelas untuk melihat Analisis Butir Soal");
		redirect("psep_sekolah/cbt");
	}
	
	$kelas 			= $this->input->get('kelas');
	$profil 		= $this->input->get('profil');
	$tahunajaran 	= $this->input->get('tahun');
	$idsekolah 		= $this->session->userdata('idsekolah');
	
	//cek value kelas dan profil apakah 0
	if($kelas == 0 or $profil == 0 or $tahunajaran == 0){
		alert_error("Error", "Pilih Profil, Kelas dan Tahun Ajaran untuk melihat Analisis Butir Soal");
		redirect("psep_sekolah/cbt");
	}
	
	//cek apakah kelas paralel benar2 milik sekolah tersebut
	$cekkelas 	= $this->model_psep->fetch_kelas_paralel_by_id($kelas, $idsekolah);
	if(empty($cekkelas)){
		alert_error("Error", "Kelas tidak teridentifikasi");
		redirect("psep_sekolah/cbt");
	}
	
	//cek apakah profil benar2 berelasi dengan kelas
	$dataprofil	= $this->model_tryout->fetch_profil_by_id($profil);
	
	if($dataprofil->id_kelas !== $cekkelas->id_kelas){
		alert_error("Error", "Kelas tidak berelasi dengan profil CBT");
		redirect("psep_sekolah/cbt");
	}
	
	$data = array(
		'kategori'			=> $this->model_dashboard->get_kategori_tryout_byprofil($profil),
		'datasiswa'			=> $this->model_psep->fetch_siswa_by_kelasparalel_and_tahunajaran($idsekolah, $kelas, $tahunajaran)
	);
	
	$this->load->view("psep_sekolah/cbt_abs", $data);
}

function detail($idprofil, $idsiswa){
	$idsekolah = $this->session->userdata('idsekolah');
	if($idprofil == "" or $idsiswa == ""){
		redirect('psep_sekolah/cbt');
	}
	
	$aliaskelas = $this->model_dashboard->kelas_by_profil($idprofil);
	$carikelas 	= $this->model_dashboard->get_kelas($idsiswa);
		$kelas 		= $carikelas->kelas;
		
		$cariidkelas	= $this->model_dashboard->get_idkelas_byprofil($idprofil);
		
		if($cariidkelas->id_kelas == ""){
			redirect('user/dashboard');
		}
		
		$idkelas = $cariidkelas->id_kelas;
		
		$data = array(
			'navbar_title' 	=> "Report CBT",
			'sekolah'		=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
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
			'dataperingkat'	=> $this->model_dashboard->peringkat_by_sekolah($idprofil, $idsekolah),
			'analisis_mapel' => $this->model_dashboard->analisis_mapel_by_profil_siswa($idsiswa, $idprofil),
			'idprofil'		=> $idprofil
		);
	$this->load->view("psep_sekolah/cbt_detail", $data);
}

function download($idprofil, $idsiswa){
	$idsekolah = $this->session->userdata('idsekolah');
	if($idprofil == "" or $idsiswa == ""){
		redirect('psep_sekolah/cbt');
	}
	
	$aliaskelas = $this->model_dashboard->kelas_by_profil($idprofil);
	$carikelas 	= $this->model_dashboard->get_kelas($idsiswa);
		$kelas 		= $carikelas->kelas;
		
		$cariidkelas	= $this->model_dashboard->get_idkelas_byprofil($idprofil);
		
		if($cariidkelas->id_kelas == ""){
			redirect('user/dashboard');
		}
		
		$idkelas = $cariidkelas->id_kelas;
		
		$data = array(
			'navbar_title' 	=> "Report CBT",
			'sekolah'		=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
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
			'dataperingkat'	=> $this->model_dashboard->peringkat_by_sekolah($idprofil, $idsekolah),
			'analisis_mapel' => $this->model_dashboard->analisis_mapel_by_profil_siswa($idsiswa, $idprofil),
			'idprofil'		=> $idprofil,
			'idsiswa'		=> $idsiswa
		);
		
	$this->load->library('pdf');
	
	$html = $this->load->view('psep_sekolah/cbt_pdf', $data, true);
	$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	$this->pdf->pdf_create($html,url_title("Raport Siswa - " . $infosiswa->nama_siswa,'-',TRUE),'A4','potrait');
}

function reguler(){
    $idpsep = $this->session->userdata('idpsepsekolah');
	$idsekolah = $this->session->userdata('idsekolah');
	$carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);
	$data = array(
		'navbar_title' 	=> "Report CBT",
		'sekolah'		=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
		'datacbt'		=> $this->model_psep->fetch_cbt_by_jenjang($carisekolah->jenjang),
		'tahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah)
	);
	
	$this->load->view("psep_sekolah/cbt_reguler", $data);
}

function config(){
	$idpsep = $this->session->userdata('idpsepsekolah');
	$idsekolah = $this->session->userdata('idsekolah');
	$carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);
	$data = array(
		'navbar_title' 	=> "Computer Based Test",
		'sekolah'		=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
		'datacbt'		=> $this->model_psep_cbt->fetch_cbt_by_jenjang($carisekolah->jenjang),
		'tahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah)
	);
	
	$this->load->view("psep_sekolah/cbt_config", $data);
}

function tambah_jadwal($idtryout){
	$dataprofil	= $this->model_tryout->fetch_profil_by_id($idtryout);
	$idsekolah 	= $this->session->userdata('idsekolah');
	$datakelas 	= $this->model_psep->fetch_kelas_paralel_by_kelas($idsekolah, $dataprofil->id_kelas);

	$data = array(
		'idtryout'		=> $idtryout,
		'datakelas'		=> $datakelas,
		'tahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah)
	);
	$this->load->view("psep_sekolah/cbt_ajax/ajax_tambah_jadwal", $data);
}

function proses_tambah_jadwal(){
	$params 		= $this->input->post(null, true);
	$idtryout		= $params['idtryout'];
	$kelas 			= $params['kelas'];
	$tahun 			= $params['tahun'];
	$tanggalmulai	= new DateTime($params['startdate']);
	$tanggalakhir	= new DateTime($params['enddate']);
	$startdate 		= date_format($tanggalmulai, 'Y-m-d H:i:s');
	$enddate 		= date_format($tanggalakhir, 'Y-m-d H:i:s');

	//cek dulu apakah end date lebih dari startdate
	if($startdate <= $enddate){
		//echo "bisa " . $startdate;
		$this->model_psep_cbt->tambah_jadwal($idtryout, $kelas, $tahun, $startdate, $enddate);
		$respon = array(
			'idprofil'	=> $idtryout
		);
		$data = json_encode($respon);
		echo $data;
	}else{
		echo "tanggal error";
	}
}


function refresh_jadwal($idprofil){
	$data = array(
		'carijadwal'	=> $this->model_psep_cbt->fetch_jadwal_by_profil($idprofil, $this->session->userdata('idsekolah')),
		'idprofil'		=> $idprofil,
	);
	$this->load->view("psep_sekolah/cbt_ajax/ajax_refresh_jadwal", $data);
}

function hapus_jadwal(){
	$params 		= $this->input->post(null, true);
	$idjadwal		= $params['idjadwal'];
	$idtryout		= $params['idtryout'];

	$this->model_psep_cbt->hapus_jadwal($idjadwal);

	$respon = array(
		'idprofil'	=> $idtryout
	);
	$data = json_encode($respon);
	echo $data;
}

function detail_profil($idtryout){
	$data = array(
		'datakategori'	=> $this->model_psep_cbt->fetch_kategori_by_profil($idtryout)
	);
	$this->load->view("psep_sekolah/cbt_ajax/ajax_kategori", $data);
}

function set_kkm($idprofil, $idkategori){
	$idsekolah = $this->session->userdata("idsekolah");
	$data = array(
		'kategori'		=> $this->model_psep_cbt->fetch_kategori_by_id($idkategori),
		'idkategori'	=> $idkategori,
		'kkm'			=> $this->model_psep_cbt->cek_kkm($idkategori, $idsekolah)
	);
	$this->load->view("psep_sekolah/cbt_ajax/ajax_set_kkm", $data);
}

function proses_set_kkm(){
	$params 		= $this->input->post(null, true);
	$idsekolah 		= $this->session->userdata("idsekolah");
	$idkategori		= $params['idkategori'];
	$kkm			= $params['kkm'];
	$idprofil		= $params['idprofil'];
	$this->model_psep_cbt->set_kkm($idsekolah, $idkategori, $kkm);

	echo $idprofil;
}


function akses_pembahasan($idtryout){
	$dataprofil	= $this->model_tryout->fetch_profil_by_id($idtryout);
	$idsekolah 	= $this->session->userdata('idsekolah');
	$datakelas 	= $this->model_psep->fetch_kelas_paralel_by_kelas($idsekolah, $dataprofil->id_kelas);

	$data = array(
		'idtryout'		=> $idtryout,
		'datakelas'		=> $datakelas,
		'tahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah)
	);
	$this->load->view("psep_sekolah/cbt_ajax/ajax_akses_pembahasan", $data);
}

function proses_akses_pembahasan(){
	$params 		= $this->input->post(null, true);
	$idtryout		= $params['idtryout'];
	$kelas 			= $params['kelas'];
	$tahun 			= $params['tahun'];
	$tanggalmulai	= new DateTime($params['startdate']);
	$startdate 		= date_format($tanggalmulai, 'Y-m-d H:i:s');

	//cek dulu apakah sudah dibuka akses pembahasan untuk kelas dan tahun ajaran tersebut
	$cekaksespembahasan = $this->model_psep_cbt->cek_akses_pembahasan($idtryout, $kelas, $tahun);

	if($cekaksespembahasan > 0){
		echo "ada";
	}else{
		$this->model_psep_cbt->tambah_akses_bahas($idtryout, $kelas, $tahun, $startdate);
		$respon = array(
			'idprofil'	=> $idtryout
		);
		$data = json_encode($respon);
		echo $data;
	}
}

function refresh_bahas($idprofil){
	$data = array(
		'databahas'	=> $this->model_psep_cbt->fetch_akses_bahas_by_profil($idprofil, $this->session->userdata('idsekolah'))
	);
	$this->load->view("psep_sekolah/cbt_ajax/ajax_refresh_bahas", $data);
}

function hapus_bahas(){
	$params 	= $this->input->post(null, true);
	$idbahas	= $params['idbahas'];
	$idtryout	= $params['idtryout'];

	$this->model_psep_cbt->hapus_bahas($idbahas);

	$respon = array(
		'idprofil'	=> $idtryout
	);
	$data = json_encode($respon);
	echo $data;
}

function tambah_cbt(){
	$idpsep = $this->session->userdata('idpsepsekolah');
	$idsekolah = $this->session->userdata('idsekolah');
	$carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);
	$data = array(
		'navbar_title' 	=> "Computer Based Test",
		'sekolah'		=> $this->model_psep->fetch_sekolah_by_id($idsekolah)
	);
}

}
?>