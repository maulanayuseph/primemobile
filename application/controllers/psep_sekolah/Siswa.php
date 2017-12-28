<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

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
		$this->load->model('model_psep');
		$this->model_security->psep_sekolah_is_logged_in();
	}

function index(){
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'navbar_title' 		=> "Kesiswaan",
		'datakelas'			=> $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang),
		'kelasparalel'		=> $this->model_psep->fetch_kelas_paralel_by_sekolah($idsekolah),
		'sekolah'			=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
		'datatahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah)
		);
	$this->load->view('psep_sekolah/siswa', $data);
}

function ajax_siswa($idkelasparalel, $idtahunajaran){
	//echo "heheheh";
	$idsekolah = $this->session->userdata('idsekolah');
	
	if($idkelasparalel !== "0" and $idtahunajaran !== "0"){
		$datasiswa = $this->model_psep->fetch_siswa_by_kelasparalel_and_tahunajaran($idsekolah, $idkelasparalel, $idtahunajaran);
		
		$no = 1;
		foreach($datasiswa as $siswa){
		?>
			<tr>
				<td><?php echo $no;?></td>
				<td><?php echo $siswa->nama_siswa;?></td>
				<td><?php echo $siswa->alias_kelas;?> - <?php echo $siswa->kelas_paralel;?></td>
				<td><?php echo $siswa->tahun_ajaran;?></td>
				<td style="text-align: center;">
					<a href="<?php echo base_url("psep_sekolah/siswa/edit/".$siswa->id_siswa_psep);?>" class="btn btn-warning btn-sm">
						<i class="fa fa-pencil" aria-hidden="true"></i>
					</a>
					<a href="<?php echo base_url("psep_sekolah/siswa/hapus/".$siswa->id_siswa_psep);?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin untuk menghapus siswa <?php echo $siswa->nama_siswa;?>')">
						<i class="fa fa-remove" aria-hidden="true"></i>
					</a>
				</td>
			</tr>
		<?php
		$no++;
		}
	}elseif($idkelasparalel !== "0" and $idtahunajaran == "0"){
		$datasiswa = $this->model_psep->fetch_siswa_by_kelasparalel($idsekolah, $idkelasparalel, $idtahunajaran);
		
		$no = 1;
		foreach($datasiswa as $siswa){
		?>
			<tr>
				<td><?php echo $no;?></td>
				<td><?php echo $siswa->nama_siswa;?></td>
				<td><?php echo $siswa->alias_kelas;?> - <?php echo $siswa->kelas_paralel;?></td>
				<td><?php echo $siswa->tahun_ajaran;?></td>
				<td style="text-align: center;">
					<a href="<?php echo base_url("psep_sekolah/siswa/edit/".$siswa->id_siswa_psep);?>" class="btn btn-warning btn-sm">
						<i class="fa fa-pencil" aria-hidden="true"></i>
					</a>
					<a href="<?php echo base_url("psep_sekolah/siswa/hapus/".$siswa->id_siswa_psep);?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin untuk menghapus siswa <?php echo $siswa->nama_siswa;?>')">
						<i class="fa fa-remove" aria-hidden="true"></i>
					</a>
				</td>
			</tr>
		<?php
		$no++;
		}
	}elseif($idkelasparalel == "0" and $idtahunajaran !== "0"){
		$datasiswa = $this->model_psep->fetch_siswa_by_tahunajaran($idsekolah, $idkelasparalel, $idtahunajaran);
		
		$no = 1;
		foreach($datasiswa as $siswa){
		?>
			<tr>
				<td><?php echo $no;?></td>
				<td><?php echo $siswa->nama_siswa;?></td>
				<td><?php echo $siswa->alias_kelas;?> - <?php echo $siswa->kelas_paralel;?></td>
				<td><?php echo $siswa->tahun_ajaran;?></td>
				<td style="text-align: center;">
					<a href="<?php echo base_url("psep_sekolah/siswa/edit/".$siswa->id_siswa_psep);?>" class="btn btn-warning btn-sm">
						<i class="fa fa-pencil" aria-hidden="true"></i>
					</a>
					<a href="<?php echo base_url("psep_sekolah/siswa/hapus/".$siswa->id_siswa_psep);?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin untuk menghapus siswa <?php echo $siswa->nama_siswa;?>')">
						<i class="fa fa-remove" aria-hidden="true"></i>
					</a>
				</td>
			</tr>
		<?php
		$no++;
		}
	}
}

function rancangan_studi(){
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'navbar_title' 		=> "Rancangan Studi Siswa",
		'datakelas'			=> $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang),
		'sekolah'			=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
		'datatahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah)
		);
	$this->load->view('psep_sekolah/rancangan_studi', $data);
}
function ajax_kelas_paralel_by_kelas($idkelas){
	$idsekolah = $this->session->userdata('idsekolah');
	$datakelasparalel = $this->model_psep->fetch_kelas_paralel_by_kelas($idsekolah, $idkelas);
	
	echo "<option value=''>-- Pilih Kelas Paralel --</option>";
	foreach($datakelasparalel as $kelas){
	?>
		<option value="<?php echo $kelas->id_kelas_paralel;?>"><?php echo $kelas->kelas_paralel;?></option>
	<?php
	}
}
function ajax_siswa_by_kelas($idkelas){
	$idsekolah = $this->session->userdata('idsekolah');
	$datasiswa = $this->model_psep->cari_siswa_by_kelas($idkelas, $idsekolah);
	
	$x = 1;
	foreach($datasiswa as $siswa){
	?>
		<tr>
			<td><?php echo $x;?></td>
			<td><?php echo $siswa->alias_kelas;?></td>
			<td><?php echo $siswa->nama_siswa;?></td>
			<td style="text-align: center;"><input type="checkbox" id="checksiswa" name="siswa[]" value="<?php echo $siswa->id_siswa;?>"/></td>
		</tr>
	<?php
	$x++;
	}
}

function ajax_siswa_by_nama($nama = null){
	if($nama == null){
		
	}else{
	$nama = rawurldecode($nama);
	$idsekolah = $this->session->userdata('idsekolah');
	//echo $nama;
	$datasiswa = $this->model_psep->fetch_siswa_by_nama($nama, $idsekolah);
	
	$x = 1;
	foreach($datasiswa as $siswa){
	?>
		<tr>
			<td><?php echo $x;?></td>
			<td><?php echo $siswa->alias_kelas;?></td>
			<td><?php echo $siswa->nama_siswa;?></td>
			<td style="text-align: center;"><input type="checkbox" id="checksiswa" name="siswa[]" value="<?php echo $siswa->id_siswa;?>"/></td>
		</tr>
	<?php
	$x++;
	}
	}
}

function insert_siswa_paralel(){
	$idsekolah 	= $this->session->userdata('idsekolah');
	$params 	= $this->input->post(null, true);
	
	$checksiswa		= $params['siswa'];
	$kelasparalel	= $params['kelasparalel'];
	$tahunajaran	= $params['tahunajaran'];
	
	foreach($checksiswa as $siswa){
		//cek dulu apakah siswa sudah terdaftar
		$ceksiswa = $this->model_psep->cek_siswa_psep($idsekolah, $kelasparalel, $tahunajaran, $siswa);
		if($ceksiswa == 0){
			$insertsiswa = $this->model_psep->insert_siswa_paralel($idsekolah, $kelasparalel, $tahunajaran, $siswa);
		}		
	}
	redirect("psep_sekolah/siswa");
}

function edit($idsiswapsep){
	$idsekolah 	= $this->session->userdata('idsekolah');
	$sekolah 	= $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$siswa 		= $this->model_psep->fetch_siswa_by_id_siswa_psep($idsiswapsep);
	$data = array(
		'navbar_title' 		=> "Edit Siswa",
		'kelasparalel'		=> $this->model_psep->fetch_kelas_paralel_by_kelas($idsekolah, $siswa->kelas),
		'sekolah'			=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
		'datatahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah),
		'siswa'				=> $this->model_psep->fetch_siswa_by_id_siswa_psep($idsiswapsep)
	);
	$this->load->view("psep_sekolah/siswa_edit", $data);
}

function proses_edit(){
	$params 		= $params 	= $this->input->post(null, true);
	$idsekolah 		= $this->session->userdata('idsekolah');
	$idsiswapsep 	= $params['idsiswapsep'];
	$kelasparalel 	= $params['kelasparalel'];
	$tahunajaran 	= $params['tahunajaran'];
	
	$datasiswa = $this->model_psep->fetch_siswa_by_id_siswa_psep($idsiswapsep);
	//cek dulu apakah ada
	$ceksiswa = $this->model_psep->cek_siswa_psep($idsekolah, $kelasparalel, $tahunajaran, $datasiswa->id_siswa);
	
	if($ceksiswa == 0){
		$edit = $this->model_psep->edit_siswa_psep($idsiswapsep, $kelasparalel, $tahunajaran);
	}	
	redirect("psep_sekolah/siswa");
}
function hapus($idsiswapsep){
	$this->model_psep->hapus_siswa_psep($idsiswapsep);
	redirect("psep_sekolah/siswa");
}


}