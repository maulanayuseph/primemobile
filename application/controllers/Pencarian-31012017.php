<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencarian extends CI_Controller {

  public function __construct()
  {
  parent::__construct();
    //load library in construct. Construct method will be run everytime the controller is called 
    //This library will be auto-loaded in every method in this controller. 
    //So there will be no need to call the library again in each method. 
    $this->load->library('pagination');
    $this->load->helper('alert_helper');
    $this->load->model('model_pg');
  }

  public function index()
  {
    $data = array(
      'navbar_links' => $this->model_pg->get_navbar_links() 
      );

    $this->load->view('pg_user/search', $data);
  }
  
  public function index_old()
  {
    $data = array(
      'navbar_links' => $this->model_pg->get_navbar_links() 
      );

    //catch GET variable for pencarian
    $key = $this->input->get('key', true) ? $this->input->get('key', true) : null;
    if($key)
    {
      $data['search_result'] = $this->search_materi($key);
      $data['count_result'] = count($data['search_result']);
      $data['limit_result'] = 10;
      $data['mod_result'] = fmod($data['count_result'], $data['limit_result']);
      $data['total_page'] = ((floor($data['count_result']/$data['limit_result'])) + ($data['mod_result']==0 ? 0 : 1));
    }

    $this->load->view('pg_user/search', $data);
  }

  private function search_materi($key)
  {
    $kata_kunci     = $key;
    $search_result  = null;
    
    if(!empty($kata_kunci))
    {
      $search_result = $this->model_pg->search_materi($kata_kunci);
    }

    return $search_result;
  }

  public function cari() 
  {
    $data = array(
      'navbar_links' => $this->model_pg->get_navbar_links() 
      );

    $key = $this->input->get('key');
    $tipe = $this->input->get('tipe');
    if($tipe == 'teks') { 
      $tipe = 1; 
    } 
    else if($tipe == 'video') { 
      $tipe = 2; 
    }
    else { 
      $tipe = null; 
    }

     //pagination settings
    $config['base_url'] = base_url('pencarian/cari');
    $config['suffix'] = (count($_GET) > 0) ? $config['suffix'] = '?'.http_build_query($_GET, '', "&") : '';
    $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
    $config["uri_segment"] = 3;
    
    $config['per_page'] = "8";
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $search_result = (!empty($key)) ? ($this->model_pg->search_materi($config["per_page"], $page, $key, $tipe)) : null;
    
    $config['total_rows'] = (!empty($key)) ? count($this->model_pg->search_materi(0, 0, $key, $tipe)) : 0;
    $choice = $config["total_rows"]/$config["per_page"];
    $config["num_links"] = floor($choice);

    // integrate bootstrap pagination
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '«';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '»';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);

    $data['page'] = $page;
    $data['search_result'] = $search_result;
    $data['total_rows'] = $config['total_rows'];
    $data['pagination'] = $this->pagination->create_links();

    // print_r($data['pagination']);
    
    // load view
    $this->load->view('pg_user/search',$data);
  }
    
  private function pagination_config() 
  {
    // integrate bootstrap pagination
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '«';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '»';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);
  }

}

 ?>