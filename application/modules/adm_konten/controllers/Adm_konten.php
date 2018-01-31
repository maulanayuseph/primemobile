<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm_konten extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
	//$this->load->model('model_user_dashboard');
	$this->load->model('adm_konten_model');
	$this->load->model('adm_main/adm_main_model');
	$this->load->helper(array('form', 'url'));
	$this->adm_main_model->adm_login_security();
  }

function adm_data(){
	$dataadm = $this->adm_main_model->fetch_admin_by_id($this->session->userdata('idlogin'));
	return $dataadm;
}

function kur_mapel(){
	$this->adm_main_model->security_level_superadmin();
	$data = array(
		'title'			=> 'Prime Mobile Management | Konten Mata Pelajaran',
		'content'		=> 'adm_konten/kur_mapel/kur_mapel',
		'headerassets'	=> 'adm_konten/kur_mapel/kur_mapel_headerassets',
		'footerassets'	=> 'adm_konten/kur_mapel/kur_mapel_footerassets',
		'dataadmin'		=> $this->adm_data(),
		'datakelas'		=> $this->adm_konten_model->fetch_kurikulum_x_kelas_group(),
		'allkelas'		=> $this->adm_konten_model->fetch_all_kelas(),
		'allkurikulum'	=> $this->adm_konten_model->fetch_all_kurikulum(),
		'allmapel'		=> $this->adm_konten_model->fetch_all_mapel()
	);
	$this->load->view("template_admin/template_adm", $data);
}

function ajax_kur_kelas(){
	$params 	= $this->input->post(null, true);
	$idkelas 	= $params['idkelas'];

	$datakur 	= $this->adm_konten_model->fetch_kurikulum_x_kelas_by_kelas($idkelas);

	echo '<option value="">-- Pilih Kurikulum --</option>';

	foreach($datakur as $kur){
		?>
		<option value="<?php echo $kur->id_kurikulum;?>"><?php echo $kur->nama_kurikulum;?></option>
		<?php
	}
}

function ajax_kur_mapel(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['idkelas'];
	$idkurikulum	= $params['idkurikulum'];

	echo '<option value="">-- Pilih Mata Pelajaran --</option>';

	$datamapel	= $this->adm_konten_model->fetch_kur_mapel_by_kelas_and_kurikulum($idkelas, $idkurikulum);

	foreach($datamapel as $mapel){
		?>
		<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>
		<?php
	}
}

function ajax_kur_bab(){
	$params 		= $this->input->post(null, true);
	$idmapel 		= $params['idmapel'];
	$idkelas 		= $params['idkelas'];
	$idkurikulum	= $params['idkurikulum'];

	echo '<option value="">-- Pilih Bab --</option>';

	$databab 		= $this->adm_konten_model->fetch_kur_bab_by_kelas_mapel_and_kurikulum($idkelas, $idkurikulum, $idmapel);

	foreach($databab as $bab){
		?>
		<option value="<?php echo $bab->id_bab;?>"><?php echo $bab->nama_bab;?></option>
		<?php
	}
}

function ajax_kur_sub(){
	$params 		= $this->input->post(null, true);
	$idmapel 		= $params['idmapel'];
	$idkelas 		= $params['idkelas'];
	$idkurikulum	= $params['idkurikulum'];
	$idbab 			= $params['idbab'];

	$kurbab 		= $this->adm_konten_model->fetch_row_kur_bab($idkelas, $idkurikulum, $idbab);
	$kurkelas 		= $this->adm_konten_model->fetch_kurikulum_x_kelas_by_kurikulum_and_kelas($idkurikulum, $idkelas);
	$data = array(
		'datasubbab'	=> $this->adm_konten_model->fetch_kur_sub($idkelas, $idkurikulum, $idmapel, $idbab),
		'datajudul'		=> $this->adm_konten_model->fetch_judul_by_kur_bab($kurbab->id_kurikulum_x_bab),
		'judulunknown'	=> $this->adm_konten_model->fetch_judul_unknown($kurbab->id_kurikulum_x_bab),
		'kurkelas'		=> $kurkelas,
		'bab'			=> $this->adm_konten_model->fetch_row_kur_bab($idkelas, $idkurikulum, $idbab),
		'allsub'		=> $this->adm_konten_model->fetch_sub_bab_by_bab($idbab)
	);
	$this->load->view('adm_konten/kur_mapel/kur_mapel_ajax_sub', $data);
}

function ajax_urut_sub(){
	$params		= $this->input->post(null, true);
	$json 		= $params['urut'];

	$x = 1;
	foreach($json as $js){
		$this->adm_konten_model->edit_urutan_sub_bab($js['id'], $x);
		//var_dump($js['id']);
		$x++;
	}
}

function proses_tambah_kur_kelas(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['kelas'];
	$idkurikulum 	= $params['kurikulum'];

	//test dulu, apakah kurikulum_x_kelas sudah ada
	$kurkelas 		= $this->adm_konten_model->fetch_kurikulum_x_kelas_by_kurikulum_and_kelas($idkurikulum, $idkelas);
	if($kurkelas == null){
		$insertkurkelas 	= $this->adm_konten_model->insert_kurikulum_x_kelas($idkurikulum, $idkelas);
		if($insertkurkelas){
			$this->session->set_flashdata('success', 'Kurikulum kelas berhasil ditambahkan');
			redirect("adm_konten/kur_mapel");
		}
	}else{
		$this->session->set_flashdata('error', 'Kurikulum kelas sudah terdaftar, input tidak diproses');
		redirect("adm_konten/kur_mapel");
	}
}

function proses_tambah_kur_mapel(){
	$params			= $this->input->post(null, true);
	$idkelas 		= $params['kelas'];
	$idkurikulum 	= $params['kurikulum'];
	$idmapel 		= $params['mapel'];

	//cek dulu apakah kurikulum_x_kelas sudah ada di tabel
	$kurxkelas = $this->adm_konten_model->fetch_kurikulum_x_kelas_by_kurikulum_and_kelas($idkurikulum, $idkelas);

	if($kurxkelas !== null){
		//jika kurikulum_x_kelas ada, insert mapelnya
		//cek dulu apakah mapel sudah ada di kurikulum_x_mapel
		$kurxmapel 	= $this->adm_konten_model->fetch_kurikulum_x_mapel_by_kelas_and_mapel($kurxkelas->id_kurikulum_x_kelas, $idmapel);

		if($kurxmapel !== null){
			$this->session->set_flashdata('success', 'Mata pelajaran berhasil ditambahkan ke kurikulum kelas');
			redirect("adm_konten/kur_mapel");
		}else{
			$insert 	= $this->adm_konten_model->insert_kurikulum_x_mapel($kurxkelas->id_kurikulum_x_kelas, $idmapel);

			if($insert){
				$this->session->set_flashdata('success', 'Mata pelajaran berhasil ditambahkan ke kurikulum kelas');
				redirect("adm_konten/kur_mapel");
			}else{
				$this->session->set_flashdata('error', 'Unknown Error');
				redirect("adm_konten/kur_mapel");
			}
		}
	}else{
		$this->session->set_flashdata('error', 'Kurikulum kelas tidak terdaftar, input tidak diproses');
		redirect("adm_konten/kur_mapel");
	}
}

function ajax_bab_by_mapel(){
	$params 	= $this->input->post(null, true);
	$idmapel 	= $params['idmapel'];
	$data = array(
		'databab'	=> $this->adm_konten_model->fetch_bab_by_mapel($idmapel)
	);
	$this->load->view("adm_konten/kur_mapel/kur_mapel_ajax_kol_tambah_bab", $data);
}

function proses_tambah_kur_bab(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['kelas'];
	$idkurikulum 	= $params['kurikulum'];
	$idmapel 		= $params['mapel'];
	$idbab 			= $params['bab'];
	$babbaru 		= $params['bab-baru'];

	if($babbaru !== ""){
		//cek dulu apakah bab sudah ada di tabel bab
		$cekbab 	= $this->adm_konten_model->fetch_bab_by_nama_and_mapel($idmapel, $babbaru);
		if($cekbab !== null){
			//jika bab sudah ada, ambil id_bab
			$insertbab = $cekbab->id_bab;
		}else{
			//insert bab baru
			$insertbab 	= $this->adm_konten_model->insert_bab($idmapel, $babbaru);
		}

		
		$kurxkelas = $this->adm_konten_model->fetch_kurikulum_x_kelas_by_kurikulum_and_kelas($idkurikulum, $idkelas);
		//cek dulu, apakah kurikulum_x_bab sudah ada
		$kurbab = $this->adm_konten_model->fetch_row_kur_bab($idkelas, $idkurikulum, $insertbab);

		if($kurbab !== null){
			//jika kurbab sudah ada, langsung redirect
			$this->session->set_flashdata('success', 'Bab berhasil ditambahkan');
			redirect("adm_konten/kur_mapel");
		}else{
			//jika kurbab tidak ada, insert dulu
			$insertkurxbab = $this->adm_konten_model->insert_kurikulum_x_bab($kurxkelas->id_kurikulum_x_kelas, $insertbab);
			if($insertkurxbab){
				$this->session->set_flashdata('success', 'Bab berhasil ditambahkan');
				redirect("adm_konten/kur_mapel");
			}else{
				$this->session->set_flashdata('error', 'Unknown Error');
				redirect("adm_konten/kur_mapel");
			}
		}
	}else{
		//insert existing bab
		//insert kurikulum_x_bab\
		$kurxkelas = $this->adm_konten_model->fetch_kurikulum_x_kelas_by_kurikulum_and_kelas($idkurikulum, $idkelas);
		$insertkurxbab = $this->adm_konten_model->insert_kurikulum_x_bab($kurxkelas->id_kurikulum_x_kelas, $idbab);
		if($insertkurxbab){
			$this->session->set_flashdata('success', 'Bab berhasil ditambahkan');
			redirect("adm_konten/kur_mapel");
		}else{
			$this->session->set_flashdata('error', 'Unknown Error');
			redirect("adm_konten/kur_mapel");
		}
	}
}

function cek_hapus_kur_kelas_mapel(){
	$params			= $this->input->post(null, true);
	$idkelas 		= $params['idkelas'];
	$idkurikulum 	= $params['idkurikulum'];
	
	$data = array(
		'kurkelas'	=> $this->adm_konten_model->fetch_kurikulum_x_kelas_by_kurikulum_and_kelas($idkurikulum, $idkelas)
	);
	$this->load->view("adm_konten/kur_mapel/kur_mapel_ajax_cek_hapus_kurikulum_kelas", $data);
}

function hapus_kurikulum_kelas_from_mapel(){
	$params 	= $this->input->post(null, true);
	$idkurkelas = $params['idkurkelas'];

	$hapus = $this->adm_konten_model->hapus_kurikulum_x_kelas($idkurkelas);

	if($hapus){
		$this->session->set_flashdata('success', 'Kurikulum kelas berhasil dihapus');
		redirect("adm_konten/kur_mapel");
	}else{
		$this->session->set_flashdata('error', 'Unknown Error');
		redirect("adm_konten/kur_mapel");
	}
}

function cek_hapus_kur_mapel_mapel(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['idkelas'];
	$idkurikulum 	= $params['idkurikulum'];
	$idmapel 		= $params['idmapel'];

	$kurkelas 		= $this->adm_konten_model->fetch_kurikulum_x_kelas_by_kurikulum_and_kelas($idkurikulum, $idkelas);

	$data = array(
		'kurkelas'	=> $kurkelas,
		'mapel'		=> $this->adm_konten_model->fetch_kurikulum_x_mapel_by_kelas_and_mapel($kurkelas->id_kurikulum_x_kelas, $idmapel)
	);
	$this->load->view("adm_konten/kur_mapel/kur_mapel_ajax_cek_hapus_kurikulum_mapel", $data);
}

function hapus_kurikulum_mapel_from_mapel(	){
	$params 		= $this->input->post(null, true);
	$idkurmapel 	= $params['idkurmapel'];

	$hapus = $this->adm_konten_model->hapus_kurikulum_x_mapel($idkurmapel);

	if($hapus){
		$this->session->set_flashdata('success', 'Mata pelajaran berhasil dihapus dari kurikulum');
		redirect("adm_konten/kur_mapel");
	}else{
		$this->session->set_flashdata('error', 'Unknown Error');
		redirect("adm_konten/kur_mapel");
	}
}

function cek_hapus_kur_bab_mapel(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['idkelas'];
	$idkurikulum 	= $params['idkurikulum'];
	$idbab 			= $params['idbab'];

	$kurkelas 		= $this->adm_konten_model->fetch_kurikulum_x_kelas_by_kurikulum_and_kelas($idkurikulum, $idkelas);

	$data = array(
		'kurkelas'	=> $kurkelas,
		'bab'		=> $this->adm_konten_model->fetch_row_kur_bab($idkelas, $idkurikulum, $idbab)
	);
	$this->load->view("adm_konten/kur_mapel/kur_mapel_ajax_cek_hapus_kurikulum_bab", $data);
}

function hapus_kurikulum_bab_from_mapel(){
	$params 	= $this->input->post(null, true);
	$idkurbab 	= $params['idkurbab'];

	$hapus = $this->adm_konten_model->hapus_kurikulum_x_bab($idkurbab);
	if($hapus){
		$this->session->set_flashdata('success', 'Bab berhasil dihapus dari kurikulum');
		redirect("adm_konten/kur_mapel");
	}else{
		$this->session->set_flashdata('error', 'Unknown Error');
		redirect("adm_konten/kur_mapel");
	}
}

function proses_tambah_kur_sub(){
	$params 		= $this->input->post(null,true);
	$idkelas 		= $params['idkelas'];
	$idkurikulum 	= $params['idkurikulum'];
	$idbab 			= $params['idbab'];
	$subbaru 		= $params['sub-baru'];

	$kurkelas 		= $this->adm_konten_model->fetch_kurikulum_x_kelas_by_kurikulum_and_kelas($idkurikulum, $idkelas);

	if($subbaru !== ""){
		//cek dulu apakah sub bab ada di tabel sub_bab untuk menghilangkan resiko sub bab terduplikat
		$ceksub = $this->adm_konten_model->fetch_sub_bab_by_nama($subbaru);
		if($ceksub == null){
			//insert sub_bab
			$insertsub = $this->adm_konten_model->insert_sub_bab($idbab, $subbaru);

			//insert kurikulum_x_sub_bab
			$insertkursub = $this->adm_konten_model->insert_kurikulum_x_sub_bab($kurkelas->id_kurikulum_x_kelas, $insertsub);
			if($insertkursub){
				//redirect
				//$this->session->set_flashdata('succes', 'Sub bab berhasil ditambahkan ke kurikulum');
				//redirect("adm_konten/kur_mapel");
				echo 'sukses';
			}else{
				//redirect
				//$this->session->set_flashdata('error', 'Unknown Error');
				//redirect("adm_konten/kur_mapel");
				echo 'gagal';
			}
		}else{
			//cek apakah sub sudah ada di kurikulum_x_sub
			$cekkursub = $this->adm_konten_model->fetch_kur_sub_by_sub_and_kur_kelas($kurkelas->id_kurikulum_x_kelas, $ceksub->id_sub_bab);
			if($cekkursub !== null){
				//redirect
				//$this->session->set_flashdata('succes', 'Sub bab berhasil ditambahkan ke kurikulum');
				//redirect("adm_konten/kur_mapel");
				echo 'sukses';
			}else{
				//insert kurikulum_x_sub_bab
				$insertkursub = $this->adm_konten_model->insert_kurikulum_x_sub_bab($kurkelas->id_kurikulum_x_kelas, $ceksub->id_sub_bab);
				if($insertkursub){
					//redirect
					//$this->session->set_flashdata('succes', 'Sub bab berhasil ditambahkan ke kurikulum');
					//redirect("adm_konten/kur_mapel");
					echo 'sukses';
				}else{
					//redirect
					//$this->session->set_flashdata('error', 'Unknown Error');
					//redirect("adm_konten/kur_mapel");
					echo 'gagal';
				}
			}
		}
	}else{
		$idsubbab		= $params['idsubbab'];
		//cek apakah sub sudah ada di kurikulum_x_sub
		$cekkursub = $this->adm_konten_model->fetch_kur_sub_by_sub_and_kur_kelas($kurkelas->id_kurikulum_x_kelas, $idsubbab);
		if($cekkursub !== null){
			//redirect
			//$this->session->set_flashdata('succes', 'Sub bab berhasil ditambahkan ke kurikulum');
			//redirect("adm_konten/kur_mapel");
			echo 'sukses';
		}else{
			//insert kurikulum_x_sub_bab
			$insertkursub = $this->adm_konten_model->insert_kurikulum_x_sub_bab($kurkelas->id_kurikulum_x_kelas, $idsubbab);
			if($insertkursub){
				//redirect
				//$this->session->set_flashdata('succes', 'Sub bab berhasil ditambahkan ke kurikulum');
				//redirect("adm_konten/kur_mapel");
				echo 'sukses';
			}else{
				//redirect
				//$this->session->set_flashdata('error', 'Unknown Error');
				//redirect("adm_konten/kur_mapel");
				echo 'gagal';
			}
		}
	}
}

function tambah_judul(){
	$params 	= $this->input->get(null, true);
	$key 		= $params['key'];
	$idkursub 	= $params['idkursub'];
	$tipe 		= $params['tipe'];
	$konten 	= $params['konten'];

	if($key !== $this->security->get_csrf_hash()){
		redirect("adm_konten/kur_mapel");
	}

	if($konten == "mapel"){
		if($tipe == "materi"){
			$data = array(
				'title'			=> 'Prime Mobile Management | Editor Materi',
				'content'		=> 'adm_konten/editor/materi',
				'headerassets'	=> 'adm_konten/editor/materi_headerassets',
				'footerassets'	=> 'adm_konten/editor/materi_footerassets',
				'dataadmin'		=> $this->adm_data(),
				'datakur'		=> $this->adm_konten_model->fetch_datakur_by_kursubbab($idkursub),
				'formaction'	=> 'proses_tambah_materi_mapel'
			);
			$this->load->view("template_admin/template_adm", $data);
		}elseif($tipe == "latihan"){
			$data = array(
				'title'			=> 'Prime Mobile Management | Editor Materi',
				'content'		=> 'adm_konten/editor/latihan',
				'headerassets'	=> 'adm_konten/editor/latihan_headerassets',
				'footerassets'	=> 'adm_konten/editor/latihan_footerassets',
				'dataadmin'		=> $this->adm_data(),
				'datakur'		=> $this->adm_konten_model->fetch_datakur_by_kursubbab($idkursub),
				'formaction'	=> 'proses_tambah_materi_mapel',
				'parentgroup'	=> $this->adm_konten_model->fetch_parent_group()
			);
			$this->load->view("template_admin/template_adm", $data);
		}
	}elseif($konten == "tematik"){
		
	}else{
		redirect("adm_konten/kur_mapel");
	}
}

function proses_tambah_materi_mapel(){
	$params 	= $this->input->post(null, true);
	$idkursub	= $params['idkursub'];
	$judul 		= $params['judul'];
	$materi 	= $_POST['materi'];
	$idadm 		= $this->session->userdata('idlogin');
	$tanggal 	= date("Y-m-d");
	$waktu 		= date("H:i:s");

	//insert judul
	$insertjudul = $this->adm_konten_model->insert_judul('mapel', $idkursub, $judul, 'materi');

	//insert materi
	$insertmateri = $this->adm_konten_model->insert_materi($insertjudul, $materi, $tanggal, $waktu, $idadm);
	if($insertmateri){
		$this->session->set_flashdata('success', 'Materi ' . $judul . ' berhasil ditambahkan');
		redirect("adm_konten/kur_mapel");
	}else{
		$this->session->set_flashdata('error', 'Materi ' . $judul . ' gagal ditambahkan');
		redirect("adm_konten/kur_mapel");
	}
}

function edit_materi_mapel($idjudul = null){
	if($idjudul == null){
		redirect("adm_konten/kur_mapel");
	}

	$data = array(
		'title'			=> 'Prime Mobile Management | Editor Materi',
		'content'		=> 'adm_konten/editor/materi',
		'headerassets'	=> 'adm_konten/editor/materi_headerassets',
		'footerassets'	=> 'adm_konten/editor/materi_footerassets',
		'dataadmin'		=> $this->adm_data(),
		'datakur'		=> $this->adm_konten_model->fetch_materi_by_judul($idjudul),
		'materi'		=> $this->adm_konten_model->fetch_materi_by_judul($idjudul),
		'author'		=> $this->adm_konten_model->fetch_author_materi($idjudul),
		'formaction'	=> '../proses_edit_materi_mapel'
	);
	$this->load->view("template_admin/template_adm", $data);
}

function proses_edit_materi_mapel(){
	$params 	= $this->input->post(null, true);
	$idjudul 	= $params['idjudul'];
	$idkursub	= $params['idkursub'];
	$judul 		= $params['judul'];
	$materi 	= $_POST['materi'];
	$idadm 		= $this->session->userdata('idlogin');

	$fetchmateri = $this->adm_konten_model->fetch_materi_by_judul($idjudul);
	//edit judul
	$editjudul 	= $this->adm_konten_model->edit_judul($idjudul, $judul);
	//edit materi
	$editmateri = $this->adm_konten_model->edit_materi($fetchmateri->id_konten, $materi);

	if($editmateri){
		$this->session->set_flashdata('success', 'Materi ' . $judul . ' berhasil diubah');
		redirect("adm_konten/kur_mapel");
	}else{
		$this->session->set_flashdata('error', 'Materi ' . $judul . ' gagal diubah');
		redirect("adm_konten/kur_mapel");
	}
}

function ajax_expand_group_latihan(){
	$params 	= $this->input->post(null, true);
	$idgroup 	= $params['idgroup'];

	$data = array(
		'datagroup'	=> $this->adm_konten_model->fetch_group_by_parent($idgroup)
	);
	$this->load->view("adm_konten/editor/latihan_ajax_expand_group", $data);
}

function proses_tambah_latihan_soal_mapel(){
	$params 	= $this->input->post(null, true);
	$judul 		= $params['judul'];
	$soal 		= $_POST['soal'];
	$jawab1 	= $_POST['jawab1'];
	$jawab2 	= $_POST['jawab2'];
	$jawab3 	= $_POST['jaawb3'];
	$jawab4 	= $_POST['jawab4'];
	$jawab5 	= $_POST['jawab5'];
	$kunci 		= $params['kunci'];
	$bobot 		= $params['bobot'];

	
}

}
?>