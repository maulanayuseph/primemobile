<?php

class Tryout extends CI_Controller{
function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_pembayaran');
		$this->load->model('model_paket');
		$this->load->model('model_tryout');
		$this->load->model('model_psep');
		$this->load->model('model_sbmptn');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
	}

function index(){
	$data = array(
		'navbar_title' 	=> "Profil Try Out",
		'table_data' 	=> $this->model_adm->fetch_all_profil(),
		'table_kategori'=> $this->model_adm->fetch_kategori()
	);
	$this->load->view('pg_admin/profiltryout', $data);
}

function manajemen($aksi){
	if($aksi){
		$this->form_validation_rules();
		switch($aksi){
			case 'tambahprofil':
				$data = array(
					'page_title'		=> "Tambah Profil Try Out",
					'form_action'		=> current_url(),
					'select_options'	=> $this->model_adm->fetch_all_kelas(),
					'select_options_materi_pokok'	=> $this->model_adm->fetch_options_materi()
				);
				//jika tombol submit ditekan
				if($this->input->post('form_submit')){
					//routing ke proses tambah
					$this->proses_tambah();
				}else{
					//jika tidak submit
					$this->load->view('pg_admin/profilform', $data);
				}
			break;
			case 'tambahkategori':
				if($this->uri->segment(5) == ""){
					redirect('pg_admin/tryout');
				}else{
					$data = array(
					'idprofil' 		=> $this->uri->segment(5),
					'form_action'	=> current_url(),
					'page_title'	=> 'Tambah Kategori Try Out',
					'data_table'	=> $this->model_adm->fetch_banksoal(),					'datakelas'			=> $this->model_tryout->get_kelas()
					);
					if($this->input->post('form_submit')){
						$this->proses_tambah_kat();
					}else{
						//jika tidak submit
						$this->load->view('pg_admin/kategoriprofilform', $data);
					}
				}
			break;
			case 'managesoal':
				if($this->uri->segment(5) == ""){
					redirect('pg_admin/tryout');
				}else{
					$idkategori = $this->uri->segment(5);
					$data = array(
						'form_action'	=> current_url(),
						'page_title'	=> 'Manajemen Soal',
						'data_table'	=> $this->model_adm->fetch_soalkategori($idkategori)
					);
					if($this->input->post('form_submit')){
						$this->proses_managesoal();
					}else{
						//jika tidak submit
						$this->load->view('pg_admin/managesoal', $data);
					}
				}
			break;
			case 'aktivasi':
				if($this->uri->segment(5) == ""){
					redirect('pg_admin/tryout');
				}else{
					$idkategori = $this->uri->segment(5);
					$this->model_adm->aktivasi_kategori($idkategori);
					redirect('pg_admin/tryout');
				}
			break;
			case 'nonaktif':
				if($this->uri->segment(5) == ""){
					redirect('pg_admin/tryout');
				}else{
					$idkategori = $this->uri->segment(5);
					$this->model_adm->nonaktif($idkategori);
					redirect('pg_admin/tryout');
				}
			break;
			case 'editkategori':
				if($this->uri->segment(5) == ""){
					redirect('pg_admin/tryout');
				}else{
					$idkategori = $this->uri->segment(5);
					$data = array(
						'form_action'	=> current_url(),
						'page_title'	=> 'Manajemen Soal',
						'data_table'	=> $this->model_adm->fetch_kategoriedit($idkategori)
					);
					if($this->input->post('form_submit')){
						$this->proses_editkategori();
					}else{
						//jika tidak submit
						$this->load->view('pg_admin/edit_kategori', $data);
					}
				}
			break;
			case 'hapuskategori' :
				if($this->uri->segment(5) == ""){
					redirect('pg_admin/tryout');
				}else{
					$idkategori = $this->uri->segment(5);
					$result = $this->model_adm->hapus_kategori($idkategori);
					$result = $this->model_adm->hapus_soal($idkategori);
					redirect('pg_admin/tryout');
				}
				
			break;						case 'pilihmapel' :				$idkelas = $this->uri->segment(5);				$carimapel = $this->model_tryout->get_mapel($idkelas);				echo "<option value='semua'>Semua Mata Pelajaran</option>";				foreach($carimapel as $mapel){				?>					<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>				<?php				}			break;						case 'pilihtopik' :				$idmapel = $this->uri->segment(5);								$caritopik = $this->model_tryout->get_topik($idmapel);								echo "<option value='semua'>Semua topik</option>";								foreach($caritopik as $topik){				?>					<option value="<?php echo $topik->topik; ?>"><?php echo $topik->topik; ?></option>				<?php				}			break;						case 'pilihsoalbymapel' :				$idmapel = $this->uri->segment(5);								$carisoal = $this->model_tryout->get_soal_by_mapel($idmapel);								$no=1;				foreach($carisoal as $soal){				?>					<tr colspan="8"><?php echo $topik;?></tr>					<tr>						<td><?php echo $no;?></td>						<td><?php echo $soal->alias_kelas;?></td>						<td><?php echo $soal->pertanyaan;?></td>						<td><?php echo $soal->pembahasan_teks;?>						<p><?php echo $soal->pembahasan_video;?></td>						<td><?php echo $soal->nama_mapel;?></td>						<td><?php echo $soal->bobot_soal;?></td>						<td><?php echo $soal->kunci;?></td>						<td class="text-center"><input type="checkbox" value="<?php echo $soal->id_banksoal;?>" name="pilih[]" /></td>					</tr>									<?php								$no++;				}			break;			case 'pilihsoalbytopik' :				$topik = rawurldecode($this->uri->segment(5));								$carisoal = $this->model_tryout->get_soal_by_topik($topik);								$no=1;				foreach($carisoal as $soal){				?>					<tr colspan="8"><?php echo $topik;?></tr>					<tr>						<td><?php echo $no;?></td>						<td><?php echo $soal->alias_kelas;?></td>						<td><?php echo $soal->pertanyaan;?></td>						<td><?php echo $soal->pembahasan_teks;?>						<p><?php echo $soal->pembahasan_video;?></td>						<td><?php echo $soal->nama_mapel;?></td>						<td><?php echo $soal->bobot_soal;?></td>						<td><?php echo $soal->kunci;?></td>						<td class="text-center"><input type="checkbox" value="<?php echo $soal->id_banksoal;?>" name="pilih[]" /></td>					</tr>									<?php								$no++;				}			break;						case 'pilihkategori' :				$idmapel = $this->uri->segment(5);								$carikategori = $this->model_tryout->get_kategori($idmapel);								echo "<option value='0'> </option>";				echo "<option value='0'>Uncategorized</option>";				echo "<option value='semua'>Semua Kategori</option>";				foreach($carikategori as $kategori){				?>					<option value="<?php echo $kategori->id_kategori_bank_soal; ?>"><?php echo $kategori->nama_kategori; ?></option>				<?php				}			break;						case 'pilihsoalbykategori' :				$idkategori = rawurldecode($this->uri->segment(5));								$carisoal = $this->model_tryout->get_soal_by_kategori($idkategori);								$no=1;				foreach($carisoal as $soal){				?>					<tr>						<td><?php echo $no;?></td>						<td><?php echo $soal->alias_kelas;?></td>						<td><?php echo $soal->pertanyaan;?></td>						<td><?php echo $soal->pembahasan_teks;?>						<p><?php echo $soal->pembahasan_video;?></td>						<td><?php echo $soal->nama_mapel;?></td>						<td><?php echo $soal->bobot_soal;?></td>						<td><?php echo $soal->kunci;?></td>						<td class="text-center"><input type="checkbox" value="<?php echo $soal->id_banksoal;?>" name="pilih[]" /></td>					</tr>									<?php								$no++;				}			break;
			default:
				$this->load->view('pg_admin/profiltryout', $data);
			break;
		}
	}else{
		redirect('pg_admin/tryout');
	}
}

public function proses_tambah(){
	$data = array(
		'page_title' 	=> "Tambah Paket", 
		'form_action' 	=> current_url(),
		'select_options'	=> $this->model_adm->fetch_all_kelas(),
		'select_options_materi_pokok'	=> $this->model_adm->fetch_options_materi()
	);
	//mengambil semua input dari form
	$params 		= $this->input->post(null, true);
	$nama 			= $params['nama'];
	$penyelenggara 	= $params['penyelenggara'];
	$biaya			= $params['biaya'];
	$tanggal		= $params['tanggal'];
	$enddate		= $params['tanggal_akhir'];
	$jam			= 0;
	$kelas 			= $params['kelas'];
	$keterangan	 	= $params['keterangan'];
	$type			= $params['tipe'];
	$max 			= $this->model_adm->select_max('sub_materi', 'urutan_materi');
	$urutan_materi 			= ($max->urutan_materi + 1);
	$tanggalpost	 		= $params['tanggal_post']; 
	$waktupost 				= $params['waktu_post'];
	
	if($type == 3){
		$idpaket = $params['paketsbmptn'];
		$jenis = $params['jenis'];
		
		//cek apakah jenisnya dobel
		$cek = $this->model_adm->fetch_profil_by_jenis_and_paket($idpaket, $jenis);
		if($cek > 0){
			alert_error("Error", "Profil sudah ada");
			redirect('pg_admin/tryout/manajemen/tambahprofil');
		}
	}else{
		$idpaket = 0;
		$jenis = "-";
	}
	
	
	if($_FILES['banner']['name'] !== ""){
		$tipe 		 	= $this->cek_tipe($_FILES['banner']['type']);
		$img_path	 	= "assets/uploads/banner/";
		$namafile		= md5($nama).md5(time()).$tipe;
		
		
		$config['upload_path']		= $img_path;
		$config['allowed_types']    = 'gif|jpg|png';
		$config['file_name'] 		= $namafile;
		
		$this->load->library('upload', $config);
		$this->upload->do_upload('banner');
		
		$result = $this->model_adm->add_profil(
		$kelas, $nama, $keterangan, $urutan_materi,
		$penyelenggara, $tanggal, $jam, $biaya, $namafile, $tanggalpost, $waktupost, $type, $idpaket, $jenis, $enddate);
		
		redirect('pg_admin/tryout');
	}else{
		//passing input value to Model
		$result = $this->model_adm->add_profil(
		$kelas, $nama, $keterangan, $urutan_materi,
		$penyelenggara, $tanggal, $jam, $biaya, "-", $tanggalpost, $waktupost, $type, $idpaket, $jenis, $enddate);
		
		redirect('pg_admin/tryout');
		// echo "Status Insert: " . $result;
	}
}
public function proses_tambah_kat(){
	$data = array(
		'page_title' 	=> "Tambah Kategori", 
		'form_action' 	=> current_url()
	);
	
	$params			= $this->input->post(null, true);
	if(isset($params['pilih'])){
		$hitung_soal	= count($params['pilih']);
		$idbanksoal 	= $params['pilih'];
	}
	if(isset($params['random'])){
		$random 		= "1";
	}else{
		$random 		= "0";
	}
	$idprofil		= $params['idprofil'];
	$tanggal 		= $params['tanggal'];
	$jam 			= $params['jam'];
	$nama 			= $params['nama'];
	$waktu 			= $params['waktu'];
	$ketuntasan		= $params['ketuntasan'];
	
	if(!isset($params['pilih'])){
		redirect('pg_admin/tryout');
	}else{
		//passing input value to Model
		$result = $this->model_adm->add_kategori(
		$idprofil,
		$nama,
		$random,
		$tanggal,
		$jam,
		$waktu,
		$ketuntasan,
		$hitung_soal
		);
		
		for($i=0; $i <= $hitung_soal - 1; $i++){
				$kategoriterakhir = $this->model_adm->last_addedkategori();
				
				foreach($kategoriterakhir as $datakategori){
					//echo $datakategori->id_terakhir;
					$result = $this->model_adm->add_soal($datakategori->id_terakhir, $idbanksoal[$i]);
				}
		}
		
		redirect('pg_admin/tryout');
	}
	
}

function proses_managesoal(){
	$data = array(
		'page_title' 	=> "Tambah Kategori", 
		'form_action' 	=> current_url()
	);
	$idkategori = $this->uri->segment(5);
	$params		= $this->input->post(null, true);
	if(isset($params['pilih'])){
		$hitung_soal	= count($params['pilih']);
		$idbanksoal 	= $params['pilih'];
	}
	echo "<p>". $idkategori;
	for($i=0; $i<=$hitung_soal - 1; $i++){
		$result = $this->model_adm->delete_soal($idkategori, $idbanksoal[$i]);
		//echo "<p>". $idbanksoal[$i];
	}
	
	$result = $this->model_adm->update_jumlahsoal($idkategori, $hitung_soal);
	redirect('pg_admin/tryout');
}

function proses_editkategori(){
	$data = array(
		'page_title' 	=> "Tambah Kategori", 
		'form_action' 	=> current_url()
	);
	
	$params			= $this->input->post(null, true);
	
	if(isset($params['random'])){
		$random 		= "1";
	}else{
		$random 		= "0";
	}
	$idkategori		= $this->uri->segment(5);
	$tanggal 		= $params['tanggal'];
	$jam 			= $params['jam'];
	$nama 			= $params['nama'];
	$waktu 			= $params['durasi'];
	$ketuntasan		= $params['ketuntasan'];
	
	$result = $this->model_adm->edit_kategori(
		$idkategori,
		$nama,
		$random,
		$tanggal,
		$jam,
		$waktu,
		$ketuntasan
		);
	redirect('pg_admin/tryout');
}

function form_validation_rules(){
		//set validation rules untuk masing2 input
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('penyelenggara', 'penyelenggara', 'trim|required');
		$this->form_validation->set_rules('biaya', 'biaya', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
		$this->form_validation->set_rules('jam', 'jam', 'trim|required');
		$this->form_validation->set_rules('kelas', 'kelas', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
		//set custom error message
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
	}function pilihmapel($idkelas){	$carimapel = $this->model_tryout->get_mapel($idkelas);		foreach($carimapel as $mapel){	?>		<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>	<?php	}}

private function cek_tipe($tipe){

	if ($tipe == 'image/jpeg') 

		{ return ".jpg"; }

	

	else if($tipe == 'image/png') 

		{ return ".png"; }

	

	else 

		{ return false; }

}

function aktifcbt(){
	if($this->uri->segment(4) == ""){
		redirect('pg_admin/tryout');
	}
	$idprofil = $this->uri->segment(4);
	
	$aktifstatus = $this->model_tryout->aktifpendaftaran($idprofil);
	redirect('pg_admin/tryout');
}

function nonaktifcbt(){
	if($this->uri->segment(4) == ""){
		redirect('pg_admin/tryout');
	}
	$idprofil = $this->uri->segment(4);
	
	$aktifstatus = $this->model_tryout->nonaktifpendaftaran($idprofil);
	redirect('pg_admin/tryout');
}

function pembayarancbt(){
	$data = array(
		'data_bayar'	=> $this->model_tryout->get_pembayaran()
	);
	
	$this->load->view('pg_admin/cbt_pembayaran', $data);
}

function konfirmasi_cbt($iddaftar, $idsiswa){
	$this->model_tryout->konfirmasi_bayar($iddaftar, $idsiswa);
	redirect('pg_admin/tryout/pembayarancbt');
}

function tolak_cbt($iddaftar, $idsiswa){
	$this->model_tryout->tolak_bayar($iddaftar, $idsiswa);
	redirect('pg_admin/tryout/pembayarancbt');
}

function hapus_profil($idprofil){
	$carikategori = $this->model_tryout->get_kategori_by_profil($idprofil);
	
	foreach($carikategori as $kategori){
		//hapus analisis pelajaran
		$this->model_tryout->hapus_analisis_pelajaran_by_kategori($kategori->id_kategori);
		
		//hapus analisis waktu
		$this->model_tryout->hapus_analisis_waktu_by_kategori($kategori->id_kategori);
		
		//hapus analisis topik
		$this->model_tryout->hapus_analisis_topik_by_kategori($kategori->id_kategori);
		
		//hapus soal
		$this->model_tryout->hapus_soal_by_kategori($kategori->id_kategori);
	}
	//hapus kategori
	$this->model_tryout->hapus_kategori_by_profil($idprofil);
	//hapus profil
	$this->model_tryout->hapus_profil($idprofil);
	redirect('pg_admin/tryout');
}

function aktivasi_psep(){
	$data = array(
		'active'		=> 'cbtpsep',
		'datacbt'		=> $this->model_tryout->get_cbt_psep(),
		'table_data' 	=> $this->model_tryout->fetch_all_profil_psep(),
		'dataprovinsi'	=> $this->model_adm->fetch_options_provinsi()
	);
	$this->load->view("pg_admin/cbt_psep", $data);
}

function ajax_kota($idprovinsi){
	$datakota = $this->model_adm->fetch_kota_by_provinsi($idprovinsi);
	
	echo "<option value=''>-- Pilih Kota/Kabupaten Sekolah --</option>";
	foreach($datakota as $kota){
	?>
		<option value="<?php echo $kota->id_kota;?>"><?php echo $kota->nama_kota;?></option>
	<?php
	}
}

function ajax_sekolah($idkota){
	$datasekolah = $this->model_tryout->fetch_sekolah_by_kota($idkota);
	echo "<option value=''>-- Pilih Sekolah --</option>";
	foreach($datasekolah as $sekolah){
	?>
		<option value="<?php echo $sekolah->id_sekolah;?>"><?php echo $sekolah->nama_sekolah;?></option>
	<?php
	}
}

function ajax_tahun_ajaran($idsekolah){
	$caritahunajaran = $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah);
	
	echo "<option value=''>-- Pilih Tahun Ajaran --</option>";
	foreach($caritahunajaran as $tahun){
	?>
		<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
	<?php
	}
}

function proses_aktif_psep(){
	$params 		= $this->input->post(null, true);
	
	$idprofil 		= $params['profil'];
	$idsekolah 		= $params['sekolah'];
	$idtahunajaran 	= $params['tahunajaran'];
	$semester 		= $params['semester'];
	
	$this->model_tryout->aktivasi_cbt_psep($idprofil, $idsekolah, $idtahunajaran, $semester);
	redirect('pg_admin/tryout/aktivasi_psep');
}

function hapus_aktivasi_psep($idcbt){
	$this->model_tryout->hapus_aktivasi_psep($idcbt);
	redirect('pg_admin/tryout/aktivasi_psep');
}

function editprofil($idprofil){
	$data = array(
		'page_title'					=> "Edit Profil Try Out",
		'profil'						=> $this->model_tryout->fetch_profil_by_id($idprofil),
		'select_options'				=> $this->model_adm->fetch_all_kelas(),
		'select_options_materi_pokok'	=> $this->model_adm->fetch_options_materi()
	);
	$this->load->view('pg_admin/profil_edit', $data);
}

function proses_edit(){
	$params 		= $this->input->post(null, true);
	$idprofil 		= $params['idprofil'];
	$nama 			= $params['nama'];
	$penyelenggara 	= $params['penyelenggara'];
	$biaya			= $params['biaya'];
	$tanggal		= $params['tanggal'];
	$enddate		= $params['tanggal_akhir'];
	$jam			= 0;
	$kelas 			= $params['kelas'];
	$keterangan	 	= $params['keterangan'];
	$type			= $params['tipe'];
	$max 			= $this->model_adm->select_max('sub_materi', 'urutan_materi');
	$urutan_materi 			= ($max->urutan_materi + 1);
	$tanggalpost	 		= $params['tanggal_post']; 
	$waktupost 				= $params['waktu_post'];
	if($_FILES['banner']['name'] !== ""){
		$tipe 		 	= $this->cek_tipe($_FILES['banner']['type']);
		$img_path	 	= "assets/uploads/banner/";
		$namafile		= md5($nama).md5(time()).$tipe;
		
		
		$config['upload_path']		= $img_path;
		$config['allowed_types']    = 'gif|jpg|png';
		$config['file_name'] 		= $namafile;
		
		$this->load->library('upload', $config);
		$this->upload->do_upload('banner');
		
		$result = $this->model_tryout->edit_profil($idprofil, 
		$kelas, $nama, $keterangan, $urutan_materi,
		$penyelenggara, $tanggal, $jam, $biaya, $namafile, $tanggalpost, $waktupost, $type, $enddate);
		
		redirect('pg_admin/tryout');
	}else{
		//passing input value to Model
		$result = $this->model_tryout->edit_profil($idprofil, 
		$kelas, $nama, $keterangan, $urutan_materi,
		$penyelenggara, $tanggal, $jam, $biaya, "-", $tanggalpost, $waktupost, $type, $enddate);
		
		redirect('pg_admin/tryout');
		// echo "Status Insert: " . $result;
	}
}

function tambah_paket_sbmptn(){
	$data = array(
		'page_title'		=> "Paket SBMPTN",
		'datapaket'			=> $this->model_sbmptn->fetch_paket_sbmptn()
	);
	$this->load->view("pg_admin/paket_sbmptn", $data);
}

function proses_paket_sbmptn(){
	$params 	= $this->input->post(null, true);
	$paket 		= $params['paket'];
	
	$this->model_sbmptn->insert_paket($paket);
	
	redirect("pg_admin/tryout/tambah_paket_sbmptn");
}

function ajax_paket_sbmptn($tipe){
	if($tipe == 3 ){
		$datapaket = $this->model_sbmptn->fetch_paket_sbmptn();
		?>
			<select name="paketsbmptn" class="form-control" required>
				<option value="">-- Pilih Paket SBMPTN --</option>
				<?php
					$x = 1;
					foreach($datapaket as $paket){
						?>
						<option value="<?php echo $paket->id_paket_sbmptn;?>"><?php echo $paket->nama_paket_sbmptn;?></option>
						<?php
						$x++;
					}
				?>
			</select>
			<select name="jenis" class="form-control" required>
				<option value="">-- Pilih Jenis Tes --</option>
				<option value="tpa">TPA (Tes Potensi Akademik)</option>
				<option value="tkdu">TKDU (Tes Kemampuan Dasar Umum)</option>
				<option value="tkd_saintek">TKD (Tes Kemampuan Dasar) SAINTEK</option>
				<option value="tkd_soshum">TKD (Tes Kemampuan Dasar) SOSHUM</option>
			</select>
		<?php
	}else{
		echo "";
	}
}

function duplikasi(){
	$data = array(
		"dataprofil"	=>  $this->model_adm->fetch_all_profil()
	);
	$this->load->view("pg_admin/profil_duplikat", $data);
}

function proses_duplikasi(){
	$params = $this->input->post(null, true);
	if(isset($params['profil'])){
		$idprofil 	= $params['profil'];
	}
	$namaprofil		= $params['namaprofilbaru'];

	foreach($idprofil as $profil){
		$fetch = $this->model_tryout->fetch_profil_by_id($profil);

		$duplikatprofil = $this->model_adm->duplikat_profil(
		$fetch->id_kelas, $namaprofil, $fetch->keterangan,
		$fetch->penyelenggara, $fetch->start_date, $fetch->jam_acara, $fetch->biaya, $fetch->banner, $fetch->tipe, $fetch->id_paket_sbmptn, $fetch->jenis, $fetch->end_date);

		$carikategori = $this->model_tryout->get_kategori_by_profil($profil);

		foreach($carikategori as $kategori){
			$duplikatkategori = $this->model_adm->duplikat_kategori($duplikatprofil, $kategori->nama_kategori, $kategori->random, $kategori->tanggal, $kategori->jam, $kategori->durasi, $kategori->ketuntasan, $kategori->jumlah_soal);

				$fetchsoal = $this->model_adm->fetch_soal_tryout($kategori->id_kategori);

				foreach($fetchsoal as $soal){
					$result = $this->model_adm->add_soal($duplikatkategori, $soal->id_banksoal);
				}
		}
	}
	redirect("pg_admin/tryout");
}

}


?>