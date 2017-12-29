<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm_migration extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
	//$this->load->model('model_user_dashboard');
	$this->load->model('adm_migration_model');
	$this->load->model('adm_main/adm_main_model');
	$this->load->helper(array('form', 'url'));
	$this->adm_main_model->adm_login_security();
  }

function adm_data(){
	$dataadm = $this->adm_main_model->fetch_admin_by_id($this->session->userdata('idlogin'));
	return $dataadm;
}

function content(){
	$this->adm_main_model->security_level_superadmin();
	$data = array(
		'title'			=> 'Super Administrator Dashboard | Content Migration',
		'content'		=> 'adm_migration/index',
		'headerassets'	=> 'adm_migration/index_headerassets',
		'footerassets'	=> 'adm_migration/index_footerassets',
		'dataadmin'		=> $this->adm_data(),
		'datakelas'		=> $this->adm_migration_model->fetch_kelas(),
		'datakurikulum'	=> $this->adm_migration_model->fetch_kurikulum(),
		'datamapel'		=> $this->adm_migration_model->fetch_mapel()		
	);
	$this->load->view("template_admin/template_adm", $data);
}

function ajax_mapel_by_kelas_old(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['idkelas'];

	$datamapel = $this->adm_migration_model->fetch_mapel_by_kelas_old($idkelas);

	echo "<option value=''>-- Pilih Mapel --</option>";

	foreach($datamapel as $mapel){
		?>
		<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>
		<?php
	}
}

function ajax_bab_by_kurikulum(){
	$params 		= $this->input->post(null, true);
	$idmapel 		= $params['idmapel'];
	$kurikulum 		= $params['kurikulum'];

	$carimapok 	= $this->adm_migration_model->cari_mapok_by_mapel($idmapel);

	echo '<option value="">-- Pilih Materi Pokok --</option>';
	
	if($kurikulum == "K-13"){
		foreach($carimapok as $mapok){
			$jumlahsubk13 		= $this->adm_migration_model->jumlah_subk13_by_mapok($mapok->id_materi_pokok);
			$jumlahsubirisan 	= $this->adm_migration_model->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);

			if($jumlahsubk13 > 0 or $jumlahsubirisan > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?></option>
				<?php
			}
		}
	}elseif($kurikulum == "K-13 REVISI"){
		foreach($carimapok as $mapok){
			$jumlahsubk13rev = $this->adm_migration_model->jumlah_subk13rev_by_mapok($mapok->id_materi_pokok);

			if($jumlahsubk13rev > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?></option>
				<?php
			}
		}
	}elseif($kurikulum == "KTSP"){
		foreach($carimapok as $mapok){
			$jumlahsubktsp 		= $this->adm_migration_model->jumlah_ktsp_by_mapok($mapok->id_materi_pokok);
			$jumlahsubirisan 	= $this->adm_migration_model->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);

			if($jumlahsubktsp > 0 or $jumlahsubirisan > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_ktsp;?></option>
				<?php
			}
		}
	}
}

function ajax_sub_materi(){
	$params 		= $this->input->post(null, true);
	$kurikulum 		= $params['kurikulum'];
	$idmapok 		= $params['idmapok'];

	if($kurikulum == "K-13"){
		$datasub = $this->adm_migration_model->fetch_sub_k13_by_mapok($idmapok);
	}elseif($kurikulum == "KTSP"){
		$datasub = $this->adm_migration_model->fetch_sub_ktsp_by_mapok($idmapok);
	}elseif($kurikulum == "K-13 REVISI"){
		$datasub = $this->adm_migration_model->fetch_sub_k13rev_by_mapok($idmapok);
	}

	$data = array(
		'datasub'	=> $datasub,
		'kurikulum'	=> $kurikulum,
		'mapok'		=> $this->adm_migration_model->fetch_mapok_by_id($idmapok)
	);
	$this->load->view('adm_migration/index_ajax_sub_materi', $data);
}

function ajax_cek_transfer_bab(){
	$params 		= $this->input->post(null, true);
	$idkelas		= $params['idkelas'];
	$idkurikulum	= $params['idkurikulum'];
	$idmapel		= $params['idmapel'];
	$bab			= $params['bab'];
	$idmapok 		= $params['idmapok'];
	$kurikulumold 	= $params['kurikulumold'];

	$data = array(
		'kelas'			=> $this->adm_migration_model->fetch_kelas_by_id($idkelas),
		'kurikulum'		=> $this->adm_migration_model->fetch_kurikulum_by_id($idkurikulum),
		'mapel'			=> $this->adm_migration_model->fetch_mapel_new_by_id($idmapel),
		'bab'			=> $bab,
		'mapok'			=> $this->adm_migration_model->fetch_mapok_by_id($idmapok),
		'kurikulumold'	=> $kurikulumold
	);
	$this->load->view("adm_migration/index_ajax_cek_transfer_bab", $data);
}

function proses_transfer_bab(){
	$params 		= $this->input->post(null, true);
	$idmapok 		= $params['idmapok'];
	$namabab		= $params['namabab'];
	$idmapel 		= $params['idmapel'];
	$idkelas		= $params['idkelas'];
	$idkurikulum	= $params['idkurikulum'];
	$kurikulum 		= $params['kurikulum'];

	//cek apakah kurikulum_x_kelas sudah ada
	$cekkurxkelas 	= $this->adm_migration_model->cek_kurikulum_x_kelas($idkurikulum, $idkelas);

	if($cekkurxkelas == null){
		//jika kurikulum_x_kelas tidak ada, insert baru
		$insertkurxkelas = $this->adm_migration_model->insert_kurikulum_x_kelas($idkurikulum, $idkelas);
		$idkurxkelas = $insertkurxkelas;
	}else{
		//jika kurikukulum_x_kelas ada, tangkap id_kurikulum_x_kelas
		$idkurxkelas = $cekkurxkelas->id_kurikulum_x_kelas;
	}

	//cek apakah kurikulum_x_mapel sudah ada
	$cekkurxmapel = $this->adm_migration_model->cek_kurikulum_x_mapel($idkurxkelas, $idmapel);

	if($cekkurxmapel == null){
		//jika kurikulum_x_mapel tidak ada, insert baru
		$insertkurxmapel = $this->adm_migration_model->insert_kurikulum_x_mapel($idkurxkelas, $idmapel);
	}

	//cek dulu, apakah bab sudah ada, biar tidak terduplikat di tabel bab
	$cekbab = $this->adm_migration_model->fetch_bab_by_nama_bab($namabab);

	if($cekbab == null){
		//jika tidak ada, insert bab baru, dan retun id bab barunya ke $insertbab
		$insertbab 		= $this->adm_migration_model->insert_bab($idmapel, $namabab);
	}else{
		//jika bab sudah ada di tabel bab, masukkan id_bab ke $insertbab
		$insertbab = $cekbab->id_bab;
	}

	//cek apakah kurikulum_x_bab sudah ada
	$cekkurxbab = $this->adm_migration_model->cek_kurikulum_x_bab($idkurxkelas, $insertbab);
	if($cekkurxbab == null){
		$insertkurxbab = $this->adm_migration_model->insert_kurikulum_x_bab($idkurxkelas, $insertbab);

		$idkurxbab = $insertkurxbab;
	}else{
		$idkurxbab = $cekkurxbab->id_kurikulum_x_bab;
	}

	//ganti semua rencana belajar dari materi pokok lama, ke idbab baru
	if($kurikulum == "K-13 REVISI"){
		$kurikulum = "k13rev";
	}
	$updaterencanabelajar = $this->adm_migration_model->update_rencana_belajar($idmapok, $idkurxbab, $kurikulum);
}

function ajax_bab(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['idkelas'];
	$idmapel 		= $params['idmapel'];
	$idkurikulum 	= $params['idkurikulum'];

	$databab 	= $this->adm_migration_model->fetch_kurikulum_x_bab_by_mapel($idkelas, $idkurikulum, $idmapel);
	echo '<option value="">-- Pilih Bab --</option>';
	foreach($databab as $bab){
		?>
		<option value="<?php echo $bab->id_bab;?>"><?php echo $bab->nama_bab;?></option>
		<?php
	}
}

function ajax_cek_buat_bab(){
	$params = $this->input->post(null, true);
}

}
?>