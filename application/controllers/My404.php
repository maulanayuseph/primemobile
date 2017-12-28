<?php 
class my404 extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
    	$url = $_SERVER['REQUEST_URI'];
    	$cekurl = explode('/',$_SERVER['REQUEST_URI']);
    	
    	$cekend = end($cekurl);
        if($cekend == "sbmptn."){
            redirect("event/sbmptn");
        }
        echo "404 - Not Found";
    } 
    } 
    ?>