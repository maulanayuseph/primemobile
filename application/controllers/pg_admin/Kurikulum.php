<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum extends CI_Controller {

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
		$this->load->model('model_adm1');
		$this->load->model('model_banksoal');
		$this->load->model('model_materi_urutan');
		$this->load->model('model_kurikulum');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
  }

	public function index()
	{
		$data = array(
			'navbar_title' 			=> "Materi Pokok",
			'table_data' 			=> $this->model_adm->fetch_all_materi_pokok(),
			'select_options_kelas'	=> $this->model_banksoal->get_kelas()
			);

		$this->load->view('pg_admin/kurikulum', $data);
		//echo "hahaha";
	}

function ajax_materi_pokok($idkelas, $idmapel){
	$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($idmapel);
		
	$x = 1;
	foreach($carimapok as $mapok){
		?>
		<tr>
			<td><input type="text" name="judulk13<?php echo $mapok->id_materi_pokok;?>" value="<?php echo $mapok->judul_bab_k13;?>" class="form-control"/></td>
			<td><input type="text" name="judulktsp<?php echo $mapok->id_materi_pokok;?>" value="<?php echo $mapok->judul_bab_ktsp;?>" class="form-control"/></td>
			<td>
			<?php
				//cari apakah punya sub K13
				$jumlahsubk13 = $this->model_kurikulum->jumlah_subk13_by_mapok($mapok->id_materi_pokok);
				
				$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
				
				//echo $mapok->id_materi_pokok . " - " . $jumlahsubk13 . " - " . $jumlahsubirisan;
				if($jumlahsubk13 > 0 or $jumlahsubirisan > 0){
					?>
					<input type="number" name="babk13<?php echo $mapok->id_materi_pokok;?>" value="<?php echo $mapok->bab_k13;?>" class="form-control"/>
					<?php
				}else{
					?>
					<?php
				}
			?>
			</td>
			<td>
			<?php
				//cari apakah punya sub K13
				$jumlahsubktsp = $this->model_kurikulum->jumlah_ktsp_by_mapok($mapok->id_materi_pokok);
				
				$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
				//echo $mapok->id_materi_pokok . " - " . $jumlahsubk13 . " - " . $jumlahsubirisan;
				if($jumlahsubktsp > 0 or $jumlahsubirisan > 0){
					?>
					<input type="number" name="babktsp<?php echo $mapok->id_materi_pokok;?>" value="<?php echo $mapok->bab_ktsp;?>" class="form-control"/>
					<?php
				}else{
					?>
					<?php
				}
			?>
			</td>
		</tr>
		<?php
		$x++;
	}
	?>
		<tr>
			<td colspan="4"><input type="submit" class="btn btn-primary" value="SIMPAN"/></td>
		</tr>
	<?php
}

function ajax_materi_pokok_drop($idkelas, $idmapel){
	$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($idmapel);
	?>
		<option value="0">-- Pilih Bab --</option>
	<?php
	$x = 1;
	foreach($carimapok as $mapok){
		?>
			<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->nama_materi_pokok;?></option>
		<?php
		$x++;
	}
}

function proses_edit(){
	$params 	= $this->input->post(null, true);
	$idmapel 	= $params['idmapel'];
	
	$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($idmapel);
	
	foreach($carimapok as $mapok){
		$idmapok 	= $mapok->id_materi_pokok;
		
		if(isset($params['babk13' . $idmapok])){
			$babk13		= $params['babk13' . $idmapok];
		}else{
			$babk13		= 0;
		}
		
		if(isset($params['babktsp' . $idmapok])){
			$babktsp	= $params['babktsp' . $idmapok];
		}else{
			$babktsp		= 0;
		}
		
		$judulk13 	= $params['judulk13' . $idmapok];
		$judulktsp	= $params['judulktsp' . $idmapok];
		
		$this->model_kurikulum->edit_materi_pokok($idmapok, $babk13, $babktsp, $judulk13, $judulktsp);
	}
	//echo "hahahaha";
	redirect("pg_admin/kurikulum");
}

function ajax_sub_bab($idmapok){
	$carisubbab = $this->model_materi_urutan->cari_mapem_by_mapok($idmapok);
	
	foreach($carisubbab as $sub){
		?>
			<tr>
				<td>
					<input type="text" name="namasub<?php echo $sub->id_sub_materi;?>" class="form-control" value="<?php echo $sub->nama_sub_materi;?>"/>
				</td>
				<td>
					<?php
						if($sub->kurikulum == "K-13" or $sub->kurikulum == "KTSP, K-13"){
							?>
							<input type="number" name="subbabk13<?php echo $sub->id_sub_materi;?>" value="<?php echo $sub->sub_bab_k13;?>" class="form-control"/>
							<?php
						}
					?>
				</td>
				<td>
					<?php
						if($sub->kurikulum == "KTSP" or $sub->kurikulum == "KTSP, K-13"){
							?>
							<input type="number" name="subbabktsp<?php echo $sub->id_sub_materi;?>" value="<?php echo $sub->sub_bab_ktsp;?>" class="form-control"/>
							<?php
						}
					?>
				</td>
			</tr>
		<?php
	}
	?>
		<tr>
			<td colspan="3"><input type="submit" class="btn btn-primary" value="SIMPAN"/></td>
		</tr>
	<?php
}

function proses_edit_sub(){
	$params 	= $this->input->post(null, true);
	$idmapok 	= $params['idmapok'];
	
	$carisubbab = $this->model_materi_urutan->cari_mapem_by_mapok($idmapok);
	
	foreach($carisubbab as $sub){
		$idsubbab		= $sub->id_sub_materi;
		$judulsub 		= $params['namasub' . $sub->id_sub_materi];
		$subk13			= $params['subbabk13' . $sub->id_sub_materi];
		$subktsp		= $params['subbabktsp' . $sub->id_sub_materi];
		
		$this->model_kurikulum->edit_sub_materi($idsubbab, $judulsub, $subk13, $subktsp);
	}
	
	redirect("pg_admin/kurikulum");
}

function ajax_sub_bab_kurikulum($idmapok){
	$data = array(
		"datasubbab"	=> $this->model_materi_urutan->cari_mapem_by_mapok($idmapok)
	);
	$carisubbab = $this->model_materi_urutan->cari_mapem_by_mapok($idmapok);
	
	$this->load->view("pg_admin/kurikulum_ajax_sub_bab", $data);
}

function proses_set_kurikulum(){
	$params 	= $this->input->post(null, true);
	$idmapok 	= $params['idmapok'];
	
	$carisubbab = $this->model_materi_urutan->cari_mapem_by_mapok($idmapok);
	
	foreach($carisubbab as $sub){
		$idsubbab		= $sub->id_sub_materi;
		$kurikulum		= $params['setkurikulum' . $sub->id_sub_materi];
		
		$this->model_kurikulum->set_kurikulum_sub($idsubbab, $kurikulum);
	}
	
	redirect("pg_admin/kurikulum");
}


function set_kurikulum(){
	$params		= $this->input->post(null, true);
	$idsub 		= $params['idsub'];
	$kurikulum	= $params['kurikulum'];
	$button		= $params['button'];

	$this->model_kurikulum->set_kurikulum_sub($idsub, $kurikulum);

	echo $button;
}

function set_k13_revisi(){
	$params		= $this->input->post(null, true);
	$idsub 		= $params['idsub'];
	$value		= $params['k13rev'];

	$this->model_kurikulum->set_k13_revisi($idsub, $value);
}


function ajax_tema($idkelas){
	$data = array(
		'datatema'	=> $this->model_kurikulum->fetch_tema_by_kelas($idkelas)
	);
	$this->load->view("pg_admin/kurikulum_ajax/ajax_tema", $data);
}

function ajax_tambah_tema(){
	$data = array(
		'select_options_kelas'	=> $this->model_banksoal->get_kelas()
	);
	$this->load->view("pg_admin/kurikulum_ajax/ajax_tambah_tema", $data);
}

function proses_tambah_tema(){
	$params 	= $this->input->post(null, true);
	$idkelas 	= $params['idkelas'];
	$tema 		= $params['tema'];

	$this->model_kurikulum->tambah_tema($idkelas, $tema);

	echo $idkelas;
}

function ajax_edit_tema($idtema){
	$data = array(
		'select_options_kelas'	=> $this->model_banksoal->get_kelas(),
		"tema"					=> $this->model_kurikulum->fetch_tema_by_id($idtema)
	);
	$this->load->view("pg_admin/kurikulum_ajax/ajax_edit_tema", $data);
}

function proses_edit_tema(){
	$params 	= $this->input->post(null, true);
	$idtema		= $params['idtema'];
	$idkelas	= $params['idkelas'];
	$tema		= $params['tema'];

	$this->model_kurikulum->edit_tema($idtema, $idkelas, $tema);

	echo $idkelas;
}

function proses_hapus_tema(){
	$params 	= $this->input->post(null, true);
	$idtema		= $params['idtema'];

	$this->model_kurikulum->hapus_tema($idtema);
}

function tambah_sub_tema($idtema){
	$data = array(
		"tema"	=> $this->model_kurikulum->fetch_tema_by_id($idtema)
	);
	$this->load->view("pg_admin/kurikulum_ajax/ajax_tambah_sub_tema", $data);
}

function proses_tambah_sub_tema(){
	$params 	= $this->input->post(null, true);
	$idtema 	= $params['idtema'];
	$subtema 	= $params['subtema'];

	$this->model_kurikulum->tambah_sub_tema($idtema, $subtema);
}

function edit_sub_tema($idsubtema){
	$data = array(
		"subtema"	=> $this->model_kurikulum->fetch_sub_tema_by_id($idsubtema)
	);
	$this->load->view("pg_admin/kurikulum_ajax/ajax_edit_sub_tema", $data);
}

function proses_edit_sub_tema(){
	$params 	= $this->input->post(null, true);
	$idsubtema 	= $params['idsub'];
	$subtema 	= $params['subtema'];

	$this->model_kurikulum->edit_sub_tema($idsubtema, $subtema);
}

function proses_hapus_sub_tema(){
	$params = $this->input->post(null, true);
	$idsub 	= $params['idsub'];

	$this->model_kurikulum->hapus_sub_tema($idsub);
}


//FUNGSI UNTUK TEMA BAB
//#####################
//#####################
//#####################
function bab_k13_rev($idmapel){
	$data = array(
		"datamapok" 	=> $this->model_materi_urutan->cari_mapok_by_mapel($idmapel)
	);
	$this->load->view("pg_admin/kurikulum_ajax/ajax_bab_tema", $data);
}

function edit_tema_bab($idmapok, $idkelas){
	$data = array(
		"datatema"	=> $this->model_kurikulum->fetch_tema_by_kelas($idkelas),
		"bab"		=> $this->model_kurikulum->fetch_materi_pokok_by_id($idmapok)
	);
	$this->load->view("pg_admin/kurikulum_ajax/ajax_edit_tema_bab", $data);
}

function proses_edit_tema_bab(){
	$params		= $this->input->post(null, true);
	$idmapok 	= $params['idmapok'];
	$idtema 	= $params['tema'];

	$this->model_kurikulum->edit_tema_bab($idmapok, $idtema);
}

function edit_sub_bab_tema($idsub, $idmapok){
	$datamapok = $this->model_kurikulum->fetch_materi_pokok_by_id($idmapok);
	$data = array(
		"submateri"		=> $this->model_kurikulum->fetch_sub_materi_by_id($idsub),
		"mapok"			=> $datamapok,
		"datasubtema"	=> $this->model_kurikulum->fetch_sub_tema_by_tema($datamapok->id_tema)
	);
	$this->load->view("pg_admin/kurikulum_ajax/ajax_edit_sub_bab_tema", $data);
}


function proses_edit_sub_bab_tema($idsub, $idsubtema){
	$params 	= $this->input->post(null, true);
	$idsub 		= $params['idsub'];
	$idsubtema 	= $params['idsubtema'];

	$this->model_kurikulum->edit_sub_bab_tema($idsub, $idsubtema);
}
//END FUNGSI UNTUK TEMA BAB
//#####################
//#####################
//#####################
}
