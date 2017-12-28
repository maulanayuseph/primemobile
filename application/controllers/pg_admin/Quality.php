<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quality extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		
		//check user session

		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_kurikulum');
		$this->load->model('model_adm');
		$this->load->model('model_banksoal');
		$this->load->model('model_atribut');
		$this->load->model('model_security');
		$this->load->model("model_qc_user");
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->model_security->is_logged_in();
  }
  
function index(){
	if($this->session->userdata('level') == "qc"){
		$datakelas = $this->model_qc_user->fetch_kelas_qc($this->session->userdata('id_admin'));
	}else{
		$datakelas = $this->model_banksoal->get_kelas();
	}
	$data = array(
		'navbar_title' 	=> "Latihan Soal",
		'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
		'table_data'	=> $this->model_kurikulum->fetch_queue_soal(),
		'jumlahsoal'	=> $this->model_kurikulum->hitung_queue_soal(),
		'datakelas'		=> $datakelas
	);

	$this->load->view('pg_admin/qc', $data);
}

function dashboard(){
	$data = array(
		'navbar_title' 	=> "Quality Control Dashboard",
		'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
		'table_data'	=> $this->model_kurikulum->fetch_queue_soal(),
		'jumlahsoal'	=> $this->model_kurikulum->hitung_queue_soal(),
		'datakelas'		=> $this->model_banksoal->get_kelas()
	);

	$this->load->view('pg_admin/qc_dashboard', $data);
}

function qc_dashboard(){
	$data = array(
		'navbar_title' 	=> "Quality Control Dashboard",
		'antrianqc'		=> $this->model_qc_user->count_antrian_approval($this->session->userdata('id_admin'))
	);

	$this->load->view('pg_admin/qc/dashboard', $data);
}

public function manajemen($aksi)
{
	//$aksi contains the value needed (tambah/ubah) to direct user to Add/Edit form
	if($aksi)
	{
		//Trigger form submission validation rules
		$this->form_validation_rules();

		switch ($aksi) {
			case 'tambah':
				$data = array(
				'navbar_title'								=> "Manajemen Latihan Soal",
				'page_title' 									=> "Buat Latihan Soal",
				'form_action' 								=> current_url(),
				'select_options_mapel'				=> $this->model_adm->fetch_options_materi_pokok(),
				'select_options_materi_pokok'	=> $this->model_adm->fetch_options_materi(),
				'submateri'										=> $this->model_adm->fetch_all_materi()
				);

				//Form materi submit handler. See if the user is attempting to submit a form or not
				if($this->input->post('form_submit')) 
				{
					//Form is submitted. Now routing to proses_tambah method
					$this->proses_tambah();
				}
				else 
				{
					//No form is submitted. Displaying the form page
					$this->load->view('pg_admin/latihansoal_form', $data);
				}
				break;
			
			case 'tambah_soal':
				//Passing id value from GET '?id' to variable '$id'
				$id = $this->input->get('id') ? $this->input->get('id') : null ;

				$data = array(
					'navbar_title'	=> "Manajemen Latihan Soal",
					'page_title' 		=> "Tambah Soal",
					'form_action' 	=> current_url() . "?id=$id",
					'sub_materi_id' => $id
				);

				//Form materi submit handler. See if the user is attempting to submit a form or not
				if($this->input->post('form_submit')) 
				{
					//Form is submitted. Now routing to proses_tambah method
					$this->proses_tambah_soal($id);
				}
				else 
				{
					//No form is submitted. Displaying the form page
					$this->load->view('pg_admin/latihansoal_detail_form', $data);
				}
				break;
			
			case 'ubah_soal':
				//Passing id value from GET '?id' to variable '$id'
				$id = $this->input->get('id') ? $this->input->get('id') : null ;
				
				$data = array(
				'navbar_title'	=> "Manajemen Latihan Soal",
				'page_title' 		=> "Ubah Latihan Soal",
				'form_action' 	=> current_url() . "?id=$id"
				);

				//Redirect to materi if id is not exist
				if(!$id)
				{
					redirect('pg_admin/latihansoal/');
				}
				else 
				{
					//Calling values from database by id and pass them to View
					//fetching jawaban by id
					$data['data'] = $this->model_adm->fetch_soal_by_id($id);

					//Form materi submit handler. See if the user is attempting to submit a form or not
					if($this->input->post('form_submit')) 
					{
						//Form is submitted. Now routing to proses_tambah method
						$this->proses_ubah_soal($id);
					}
					else
					{
						//No form is submitted. Displaying the form page
						$this->load->view('pg_admin/latihansoal_detail_form', $data);
					}
				}
				break;
			
			default:
				redirect('pg_admin/materi');
				break;
		}
	}
	else
	{
		redirect('pg_admin/materi');
	}

}

public function proses_tambah_soal($id)
{
	//fetch input (make sure that the variable name is the same as column name in database!) 
	$params = $this->input->post(null, false);
	$isi_soal 		 	= $params['isi_soal'];
	$kunci_jawaban 		= $params['kunci_jawaban'];
	$bobot 				= $params['bobot'];
	$jawab_1 			= $params['jawab_1'];
	$jawab_2 			= $params['jawab_2'];
	$jawab_3 			= $params['jawab_3'];
	$jawab_4 			= $params['jawab_4'];
	$jawab_5 			= $params['jawab_5'];
	$sub_materi_id		= $this->input->get('id');
	$pembahasan			= $params['pembahasan'];
	$pembahasan_video	= $params['pembahasan_video'];
	
	//set the page title
	$data = array(
		'page_title' 	=> "Tambah Soal", 
		'form_action' => current_url() . "?id=$id",
		);

	//set validation rules
	$this->form_validation->set_rules('isi_soal', 'Isi Soal', 'required');
	// $this->form_validation->set_rules('pembahasan', 'Pembahasan', 'required');
	$this->form_validation->set_rules('kunci_jawaban', 'Kunci Jawaban', 'required');
		
	//run the validation
	if ($this->form_validation->run() == FALSE) 
	{
		alert_error("Error", "Data gagal ditambahkan");
		$this->load->view('pg_admin/latihansoal_detail_form', $data);
	}
	else 
	{
		//passing input value to Model
		$result = $this->model_adm->add_item_soal($isi_soal,$jawab_1,$jawab_2,$jawab_3,$jawab_4,$jawab_5,$kunci_jawaban,$sub_materi_id,$pembahasan,$pembahasan_video,$bobot);
		alert_success("Sukses", "Data berhasil ditambahkan");
		redirect('pg_admin/latihansoal/detail/'.$id);
		// echo "Status Insert: " . $result;
	}	
}

public function proses_ubah_soal($id)
{
	//set the page title
	$data = array(
		'page_title' 	=> "Ubah Soal",
		'form_action' => current_url(). "?id=$id"
		);

	//fetch input (make sure that the variable name is the same as column name in database!) 
	$params = $this->input->post(null, false);
	$isi_soal 		 	= $params['isi_soal'];
	$jawab_1 			= $params['jawab_1'];
	$jawab_2 			= $params['jawab_2'];
	$jawab_3 			= $params['jawab_3'];
	$jawab_4 			= $params['jawab_4'];
	$jawab_5 			= $params['jawab_5'];
	$kunci_jawaban 		= $params['kunci_jawaban'];
	$bobot 				= $params['bobot'];
	$id_soal			= $id;
	$sub_materi_id		= $params['sub_materi_id'];
	$pembahasan			= $params['pembahasan'];
	$pembahasan_video	= $params['pembahasan_video'];
	$status				= $params['status'];

	//set validation rules
	$this->form_validation->set_rules('isi_soal', 'Isi Soal', 'required');
	// $this->form_validation->set_rules('pembahasan', 'Pembahasan', 'required');
	$this->form_validation->set_rules('kunci_jawaban', 'Kunci Jawaban', 'required');
		
	//run the validation
	if ($this->form_validation->run() == FALSE) 
	{
		alert_error("Error", "Data gagal diubah");
		$this->load->view('pg_admin/latihansoal_detail_form', $data);
	}
	else 
	{
		//passing input value to Model
		$result = $this->model_adm->update_item_soal($isi_soal,$jawab_1,$jawab_2,$jawab_3,$jawab_4,$jawab_5,$kunci_jawaban,$pembahasan,$pembahasan_video,$id_soal,$bobot, $status);
		
		$this->model_kurikulum->update_status_soal($id_soal, $status);
		//ubah status soal menjadi publish
		
		//mulai penambahan atribut soal
			//#############################
			//#############################
			$dataatribut = $this->model_atribut->fetch_all_atribut();
			foreach($dataatribut as $atribut){
				$checkatr = $this->input->post("checkatr", true);
				if(isset($checkatr[$atribut->id_atribut])){
					//echo "<p>" . $atribut->id_atribut;
					$this->model_atribut->insert_atribut_soal($result, $checkatr[$atribut->id_atribut]);
				}
			}
			//#############################
			//#############################
		//$this->model_kurikulum->update_status_soal($id_soal);
        //simpan tracking ke db
		if($this->session->userdata('level') == "adminqc"){
			$this->model_adm->update_track($this->session->userdata('id_admin'), $id_soal, $status);
		}
		alert_success("Sukses", "Data berhasil diubah");
		redirect('pg_admin/quality', $data);
		// echo "Status Update: " . $result;
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
			$id 	= $this->input->post('hidden_row_id');
			$result = $this->model_adm->delete_item_soal($id);
			
			alert_success('Sukses', "Data berhasil dihapus");
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	alert_danger('Error', "Data gagal dihapus");
	redirect('pg_admin/materi');
}


public function proses_tambah()
{
	//set the page title
	$data = array(
		'page_title' 	=> "Tambah Latihan Soal", 
		'form_action' => current_url(),
		'submateri'		=> $this->model_adm->fetch_all_materi()
		);

	//fetch input (make sure that the variable name is the same as column name in database!) 
	$params 				= $this->input->post(null, true);
	$sub_materi 		 		= $params['sub_materi'];

	$this->form_validation->set_rules('sub_materi', 'Sub Materi', 'required');
	
	//run the validation
	if ($this->form_validation->run() == FALSE) 
	{
		alert_error("Error", "Data gagal ditambahkan");
		$this->load->view('pg_admin/latihansoal_form', $data);
	}
	else 
	{
		//passing input value to Model
		$result = $this->model_adm->add_latihan_soal($sub_materi);
		alert_success("Sukses", "Data berhasil ditambahkan");
		redirect('pg_admin/latihansoal');
		// echo "Status Insert: " . $result;
	}	
}


public function proses_ubah($id)
{
	//set the page title
	$data = array(
		'page_title' 	=> "Tambah Soal", 
		'form_action' => current_url() . "?id=$id"
		);

	//fetch input (make sure that the variable name is the same as column name in database!) 
	$params = $this->input->post(null, true);
	$kategori 		 			= $params['kategori_materi'];
	$mapel_id 					= $params['nama_mapel'];
	$materi_pokok_id		= $params['materi_pokok'];
	$nama_sub_materi 		= $params['judul_materi'];
	$isi_materi 	 			= $params['konten_materi'];
	$gambar_materi	 		= $params['gambar_materi']; 
	$tanggal	 					= $params['tanggal_post']; 
	$waktu	 						= $params['waktu_post']; 

	//run the validation
	if ($this->form_validation->run() == FALSE) 
	{
		alert_error("Error", "Data gagal ditambahkan");
		$this->load->view('pg_admin/materi_form', $data);
	}
	else 
	{
		//passing input value to Model
		$result = $this->model_adm->add_materi($kategori, $mapel_id, $materi_pokok_id, $nama_sub_materi, $isi_materi, $gambar_materi, $tanggal, $waktu);
		alert_success("Sukses", "Data berhasil ditambahkan");
		redirect('pg_admin/materi');
		// echo "Status Insert: " . $result;
	}	
}


function preview_konten($sub_materi_id)
{
	if($sub_materi_id)
	{
		$data['content_preview'] 	= $this->model_adm->fetch_content_by_id($sub_materi_id);
		$gambar_materi = isset($data['content_preview']->gambar_materi) ? $data['content_preview']->gambar_materi : '';
		$data['thumbnail_dir'] 		= base_url('') . "assets/img/no-image.jpg";
		
		if($gambar_materi)
		{
			$data['thumbnail_dir'] 	= base_url('') . "assets/js/plugins/kcfinder/upload/images/" . $data['content_preview']->gambar_materi;
		}

		$this->load->view('preview/content_preview', $data);
	}
	else
	{
		redirect('pg_admin/materi');
	}
}

function form_validation_rules()
{
	//set custom error message
	$this->form_validation->set_message('required', '%s tidak boleh kosong');
}

function fetch_materi_by_id($id)
{
	$data 					= new stdClass();
	$table_data 		= $this->model_adm->fetch_materi_by_id($id); 
	$table_fields 	= $this->model_adm->get_table_fields('mata_pelajaran', 'materi_pokok', 'sub_materi', 'konten_materi');
	//tester
	// var_dump($table_data);
	// var_dump($table_fields);
	if($table_data)
	{
		foreach ($table_fields as $field) {
			$data->{$field} = $table_data->{$field} ? $table_data->{$field} : ''; 
			// echo "$field -> " . ${$field} . ", "; 
		}
	}
	else { $data = null; }

	return $data; 
}

function ajax_select_materi_pokok()
{
	$id = $this->input->post('id', true) ? $this->input->post('id', true) : null;
	
	if($id)
	{
		$dynamic_options = $this->model_adm->fetch_materi_pokok_by_mapel($id);

		if($dynamic_options){
			foreach ($dynamic_options as $item) {
				echo "<option value=''></option>";
				echo "<option value='" . $item->id_materi_pokok . "'> $item->nama_materi_pokok </option>";
			}
		}
		else
		{
			echo "<option value=''></option>";
			echo "<option value='' disabled='disabled'>Tidak ada data</option>";
		}
	}
	else{
		return false;
	}
}

function ajax_select_sub_materi()
{
	$id = $this->input->post('id', true) ? $this->input->post('id', true) : null;
	
	if($id)
	{
		$dynamic_options = $this->model_adm->fetch_submateri_by_materi_pokok($id);

		if($dynamic_options){
			$no = 1;
			foreach ($dynamic_options as $item) {
				echo "<option value=''></option>";
				echo "<option value='" . $item->id_sub_materi . "'> $no". ". " ." $item->nama_sub_materi </option>";
				$no++;
			}
		}
		else
		{
			echo "<option value=''></option>";
			echo "<option value='' disabled='disabled'>Tidak ada data</option>";
		}
	}
	else{
		return false;
	}
}

function set_status($idsoal, $status){
	//ubah status soal menjadi publish
	$this->model_kurikulum->update_status_soal($idsoal, $status);
	
	redirect('pg_admin/quality', $data);
}

function ajax_lihat_soal($idsoal){
	$soal = $this->model_kurikulum->fetch_soal_by_id($idsoal);
	?>
	<table class="table table-striped table-bordered">
		<tr>
			<td>Kelas</td>
			<td>:</td>
			<td><?php echo $soal->alias_kelas;?></td>
		</tr>
		<tr>
			<td>Mata Pelajaran</td>
			<td>:</td>
			<td><?php echo $soal->nama_mapel;?></td>
		</tr>
		<tr>
			<td>Bab</td>
			<td>:</td>
			<td><?php echo $soal->nama_materi_pokok;?></td>
		</tr>
		<tr>
			<td>Sub-Bab</td>
			<td>:</td>
			<td><?php echo $soal->nama_sub_materi;?></td>
		</tr>
	</table>
	<table class="table table-striped table-bordered">
		<tr>
			<td colspan="2" width="15cm"><?php echo html_entity_decode($soal->isi_soal);?></td>
		</tr>
		<tr>
			<td style="width: 0.5cm;" valign="top"><strong>A.</strong></td>
			<td valign="top"><?php echo html_entity_decode($soal->jawab_1);?></td>
		</tr>
		<tr>
			<td width="0.5cm" valign="top"><strong>B.</strong></td>
			<td valign="top"><?php echo html_entity_decode($soal->jawab_2);?></td>
		</tr>
		<tr>
			<td width="0.5cm" valign="top"><strong>C.</strong></td>
			<td valign="top"><?php echo html_entity_decode($soal->jawab_3);?></td>
		</tr>
		<tr>
			<td width="0.5cm" valign="top"><strong>D.</strong></td>
			<td valign="top"><?php echo html_entity_decode($soal->jawab_4);?></td>
		</tr>
		<tr>
			<td width="0.5cm" valign="top"><strong>E.</strong></td>
			<td valign="top"><?php echo html_entity_decode($soal->jawab_5);?></td>
		</tr>
		<tr>
			<td colspan="2">
			<strong>Kunci Jawaban :
			<?php 
			if($soal->kunci_jawaban == 1){
				echo "A";
			}elseif($soal->kunci_jawaban == 2){
				echo "B";
			}elseif($soal->kunci_jawaban == 3){
				echo "C";
			}elseif($soal->kunci_jawaban == 4){
				echo "D";
			}elseif($soal->kunci_jawaban == 5){
				echo "E";
			}
			?>
			</strong>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<p><strong>Pembahasan Teks : </strong><?php echo html_entity_decode($soal->pembahasan);?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<p><strong>Pembahasan Video :</strong><?php echo $soal->pembahasan_video;?>
			<hr>
			</td>
		</tr>
	</table>
	<?php
}

function ajax_soal_by_bab($idmapok){
	$data = array(
		"datasoal"	=> $this->model_kurikulum->fetch_queue_soal_by_bab($idmapok)
	);
	
	$this->load->view("pg_admin/ajax_antrian_qc", $data);
}

function ajax_modal_soal($idmapok){
	$datasoal	= $this->model_kurikulum->fetch_queue_soal_by_bab($idmapok);
	foreach($datasoal as $item){
		$soal = $this->model_kurikulum->fetch_soal_by_id($item->id_soal);
		?>
<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="modalsoal<?php echo $item->id_soal;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered">
			<tr>
				<td>Kelas</td>
				<td>:</td>
				<td><?php echo $soal->alias_kelas;?></td>
			</tr>
			<tr>
				<td>Mata Pelajaran</td>
				<td>:</td>
				<td><?php echo $soal->nama_mapel;?></td>
			</tr>
			<tr>
				<td>Bab</td>
				<td>:</td>
				<td><?php echo $soal->nama_materi_pokok;?></td>
			</tr>
			<tr>
				<td>Sub-Bab</td>
				<td>:</td>
				<td><?php echo $soal->nama_sub_materi;?></td>
			</tr>
		</table>
		<table class="table table-striped table-bordered">
			<tr>
				<td colspan="2" width="15cm"><?php echo html_entity_decode($soal->isi_soal);?></td>
			</tr>
			<tr>
				<td style="width: 0.5cm;" valign="top"><strong>A.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_1);?></td>
			</tr>
			<tr>
				<td width="0.5cm" valign="top"><strong>B.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_2);?></td>
			</tr>
			<tr>
				<td width="0.5cm" valign="top"><strong>C.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_3);?></td>
			</tr>
			<tr>
				<td width="0.5cm" valign="top"><strong>D.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_4);?></td>
			</tr>
			<tr>
				<td width="0.5cm" valign="top"><strong>E.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_5);?></td>
			</tr>
			<tr>
				<td colspan="2">
				<strong>Kunci Jawaban :
				<?php 
				if($soal->kunci_jawaban == 1){
					echo "A";
				}elseif($soal->kunci_jawaban == 2){
					echo "B";
				}elseif($soal->kunci_jawaban == 3){
					echo "C";
				}elseif($soal->kunci_jawaban == 4){
					echo "D";
				}elseif($soal->kunci_jawaban == 5){
					echo "E";
				}
				?>
				</strong>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<p><strong>Pembahasan Teks : </strong><?php echo html_entity_decode($soal->pembahasan);?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<p><strong>Pembahasan Video :</strong><?php echo $soal->pembahasan_video;?>
				<hr>
				</td>
			</tr>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
		<?php
	}
}
function sort_soal($status, $idmapok){
	$data = array(
		"datasoal"	=> $this->model_kurikulum->fetch_queue_soal_by_bab_status($status, $idmapok),
		"status"	=> $status
	);
	
	$this->load->view("pg_admin/ajax_sortir_qc", $data);
}

function ajax_acc($idsoal, $idmapok){
	$this->model_kurikulum->update_status_soal($idsoal, 10);
	
	$this->ajax_soal_by_bab($idmapok);
	//redirect('pg_admin/quality', $data);
	if($this->session->userdata('level') == "adminqc"){
		$this->model_adm->update_track($this->session->userdata('id_admin'), $idsoal, 10);
	}
}
function ajax_eval($idsoal, $idmapok){
	$this->model_kurikulum->update_status_soal($idsoal, 11);
	
	$this->ajax_soal_by_bab($idmapok);
	//redirect('pg_admin/quality', $data);
	if($this->session->userdata('level') == "adminqc"){
		$this->model_adm->update_track($this->session->userdata('id_admin'), $idsoal, 11);
	}
}

function ajax_overview(){
	$data = array(
		'antrikelas'	=> $this->model_kurikulum->fetch_kelas_antrian(),
		'antrimapel'	=> $this->model_kurikulum->fetch_mapel_antrian(),
		'antrimapok'	=> $this->model_kurikulum->fetch_materi_pokok_antrian()
	);
	$this->load->view("pg_admin/ajax_overview_approval", $data);
}

function ajax_overview_by_kelas($idkelas){
	if($this->session->userdata('level') == "qc"){
		$antrimapel 	= $this->model_qc_user->fetch_mapel_antrian_by_admin_and_kelas($this->session->userdata('id_admin'), $idkelas);
	}else{
		$antrimapel 	= $this->model_kurikulum->fetch_mapel_antrian_by_kelas($idkelas);
	}
	$data = array(
		'antrimapel'	=> $antrimapel
	);
	$this->load->view("pg_admin/ajax_overview_approval_by_kelas", $data);
}

function ajax_list_eval(){
	$table_eval	= $this->model_kurikulum->fetch_evaluation_soal();
	
	$data = array(
		"table_eval"	=> $table_eval
	);
	
	$this->load->view("pg_admin/ajax_list_eval", $data);
}

function ajax_filter_eval($status){
	$table_eval	= $this->model_kurikulum->fetch_evaluation_soal_by_status($status);
	
	$data = array(
		"table_eval"	=> $table_eval
	);
	
	$this->load->view("pg_admin/ajax_list_eval", $data);
}

function export_approval(){
	$params 	= $this->input->post(null, true);
	$idkelas 	= $params['idkelas'];
	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("PRIME MOBILE")->setTitle("Prime Mobile");
	
	$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
    $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
	
	$objget->setTitle('Sample Sheet'); //sheet title
	
	$objset->setCellValue("A1", "Mata Pelajaran / Bab");
	$objset->setCellValue("B1", "Jumlah Antrian Approval");
	
	
	
	$infokelas	= $this->model_adm->get_kelas_by_id($idkelas);
	
	if($this->session->userdata('level') == "qc"){
		$antrimapel 	= $this->model_qc_user->fetch_mapel_antrian_by_admin_and_kelas($this->session->userdata('id_admin'), $idkelas);
	}else{
		$antrimapel 	= $this->model_kurikulum->fetch_mapel_antrian_by_kelas($idkelas);
	}
	$x = 2;
	foreach($antrimapel as $mapel){
		$carijumlahantrimapel = $this->model_kurikulum->fetch_jumlah_antri_by_mapel($mapel->id_mapel);
		
		$objset->setCellValue("A" . $x, $mapel->nama_mapel);
		$objset->setCellValue("B" . $x, $carijumlahantrimapel);
		
		$mapokantri = $this->model_kurikulum->fetch_antri_mapok_by_mapel($mapel->id_mapel);
		
		$y = $x+1;
		foreach($mapokantri as $mapok){
			$objset->setCellValue("A" . $y, $mapok->nama_materi_pokok);
			
			$carijumlahantri = $this->model_kurikulum->fetch_jumlah_antri_by_mapok($mapok->id_materi_pokok);
			
			$objset->setCellValue("B" . $y, $carijumlahantri);
			
			$y++;
		}
		$x = $y+1;
	}
	
	$objPHPExcel->getActiveSheet()->setTitle(str_replace("/", " ", $infokelas->alias_kelas));
	
	$objPHPExcel->setActiveSheetIndex(0);
	$filename = str_replace("/", " ", "Rekap Approval" . $infokelas->alias_kelas)."_".date("Y-m-d").".xls";
	   
	  header('Content-Type: application/vnd.ms-excel'); //mime type
	  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	  header('Cache-Control: max-age=0'); //no cache

	$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
	$objWriter->save('php://output');
}

function detailkelas($idkelas){
	$data = array(
		"mapelkelas"	=> $this->model_adm->fetch_mapel_by_kelas($idkelas),
		"idkelas"		=> $idkelas,
		"detailkelas"	=> $this->model_adm->get_kelas_by_id($idkelas)
	);
	$this->load->view("pg_admin/qc_detail_kelas", $data);
}

function printsoalditolak($idkelas, $idmapel, $status){
	$data = array(
		"detailkelas"	=> $this->model_adm->get_kelas_by_id($idkelas),
		"status"		=> $status,
		"infomapel"		=> $this->model_adm->fetch_mapel_by_id($idmapel),
		"datasoal"		=> $this->model_kurikulum->fetch_soal_by_status_and_mapel($idmapel, $status)
	);
	$this->load->view("pg_admin/qc_cetak_soal_ditolak", $data);
}

function ajax_status(){
	?>
	<option>-- Pilih Status --</option>
	<option value="all">Semua</option>
	<option value="2">Pembahasan Tidak Lengkap</option>
	<option value="3">Belum Ada Pembobotan</option>
	<option value="4">Soal Membingungkan</option>
	<option value="5">Soal Dobel</option>
	<option value="6">Soal Tidak Layak</option>
	<option value="8">Soal Belum di QC Tentor</option>
	<option value="7">Soal Perlu Dipindah</option>
	<?php
}

function ajax_soal_by_status_and_mapel($idmapel, $status){	
	if($status == "all"){
		$data = array(
			"table_eval"	=> $this->model_kurikulum->fetch_soal_ditolak_by_mapel($idmapel)
		);
		$this->load->view("pg_admin/ajax_list_eval", $data);
	}else{
		$data = array(
			"table_eval"	=> $this->model_kurikulum->fetch_soal_by_status_and_mapel($idmapel, $status)
		);
		$this->load->view("pg_admin/ajax_list_eval", $data);
	}
}

function reload_dashboard(){
	$data = array(
		'navbar_title' 	=> "Quality Control Dashboard",
		'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
		'table_data'	=> $this->model_kurikulum->fetch_queue_soal(),
		'jumlahsoal'	=> $this->model_kurikulum->hitung_queue_soal(),
		'datakelas'		=> $this->model_banksoal->get_kelas()
	);

	$this->load->view('pg_admin/qc_reload_dashboard', $data);
}
}