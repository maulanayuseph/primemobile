<?php
if($this->session->userdata('admlevel') == 'superadmin'){
	$this->load->view('adm_global/superadmin_navigation');
}
?>