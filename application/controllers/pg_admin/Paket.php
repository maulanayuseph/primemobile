<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Paket extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper('alert_helper');
    $this->load->model('model_adm');
    $this->load->model('model_security');
    $this->model_security->is_logged_in();
  }

  function index(){
    $data = array(
      'navbar_title'  => "Paket",
      'form_action'   => base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
      'table_data'    => $this->model_adm->fetch_all_paket()
      );

    $this->load->view('pg_admin/paket', $data);
  }

  function manajemen($aksi){
        //$aksi contains the value needed (tambah/ubah) to direct user to Add/Edit form
    if($aksi)
    {
      //Trigger form submission validation rules
      $this->form_validation_rules();

      switch ($aksi) {
        case 'tambah':
          $data = array(
          'navbar_title'  => "Manajemen Paket",
          'page_title'    => "Tambah Paket",
          'form_action'   => current_url()
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
            $this->load->view('pg_admin/paket_form', $data);
          }
          break;
        
        case 'ubah':
          //Passing id value from GET '?id' to variable '$id'
          $id = $this->input->get('id') ? $this->input->get('id') : null ;
          
          $data = array(
          'navbar_title'  => "Manajemen Paket",
          'page_title'    => "Ubah Paket",
          'form_action'   => current_url() . "?id=$id"
          );

          //Redirect to paket if id is not exist
          if(!$id)
          {
            redirect('pg_admin/paket');
          }
          else 
          {
            //Calling values from database by id and pass them to View
            //fetching paket by id
            $data['data'] = $this->fetch_paket_by_id($id);

            //Form submit handler. See if the user is attempting to submit a form or not
            if($this->input->post('form_submit')) 
            {
              //Form is submitted. Now routing to proses_tambah method
              $this->proses_ubah($id);
            }
            else 
            {
              //No form is submitted. Displaying the form page
              $this->load->view('pg_admin/paket_form', $data);
            }
          }
          break;
        
        default:
          redirect('pg_admin/paket');
          break;
      }
    }
    else
    {
      redirect('pg_admin/paket');
    }
  }

  public function proses_tambah()
  {
    //set the page title
    $data = array(
      'page_title'  => "Tambah Paket", 
      'form_action' => current_url()
      );
    //fetch input (make sure that the variable name is the same as column name in database!) 
    $params   = $this->input->post(null, true);
    $kode_paket = 'PM'.($params['tipe'] == 0 ? 'REG' : 'GOLD').$params['durasi'];
    $durasi   = $params['durasi'];
    $harga    = $params['harga'];
    $tipe   = $params['tipe'];

    //run the validation
    if ($this->form_validation->run() == FALSE) 
    {
      alert_error("Error", "Data gagal ditambahkan");
      $this->load->view('pg_admin/paket_form', $data);
    }
    else 
    {
      //passing input value to Model
      $result = $this->model_adm->add_paket($kode_paket, $durasi, $harga, $tipe);
      alert_success("Sukses", "Data berhasil ditambahkan");
      redirect('pg_admin/paket');
      // echo "Status Insert: " . $result;
    } 
  }

  public function proses_ubah($id)
  {
    //set the page title
    $data = array(
      'page_title'  => "Ubah Paket",
      'form_action' => current_url(). "?id=$id"
      );

    //fetch input (make sure that the variable name is the same as column name in database!) 
    $params = $this->input->post(null, true);
    $kode_paket = 'PM'.($params['tipe'] == 0 ? 'REG' : 'GOLD').$params['durasi'];
    $durasi   = $params['durasi'];
    $harga    = $params['harga'];
    $tipe   = $params['tipe'];

    //run the validation
    if ($this->form_validation->run() == FALSE) 
    {
      alert_error("Error", "Data gagal diubah");
      $this->load->view('pg_admin/paket_form', $data);
    }
    else 
    {
      //passing input value to Model
      $result = $this->model_adm->update_paket($id, $kode_paket, $durasi, $harga, $tipe);
      alert_success("Sukses", "Data berhasil diubah");
      redirect('pg_admin/paket');
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
        $id   = $this->input->post('hidden_row_id');
        $result = $this->model_adm->delete_paket($id);
        
        alert_success('Sukses', "Data berhasil dihapus");
        redirect('pg_admin/paket');
      }
    }
    
    alert_danger('Error', "Data gagal dihapus");
    redirect('pg_admin/paket');
  }

  function form_validation_rules()
  {
    //set validation rules for each input
    // $this->form_validation->set_rules('kode_paket', 'Kode Paket', 'trim|required');
    $this->form_validation->set_rules('durasi', 'Durasi Paket', 'trim|required');
    $this->form_validation->set_rules('harga', 'Harga Paket', 'trim|required');
    $this->form_validation->set_rules('tipe', 'Tipe Paket', 'trim|required');
    
    //set custom error message
    $this->form_validation->set_message('required', '%s tidak boleh kosong');
  }

  function fetch_paket_by_id($id)
  {
    $data       = new stdClass();
    $table_data   = $this->model_adm->fetch_paket_by_id($id); 
    $table_fields   = $this->model_adm->get_table_fields('paket');
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
}