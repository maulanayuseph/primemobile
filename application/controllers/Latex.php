<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Latex extends CI_Controller {

	public function __construct()
	{
    parent::__construct();
			
		//check user session

		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
	}

function replace_space(){
	$latex = $_POST['latex'];
	$latex = str_replace("&space;", " ", $latex);

	echo $latex;
}
}

?>