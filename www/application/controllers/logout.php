<?php

class Logout extends CI_Controller{

	function index(){
		$this->session->unset_userdata('username');
		$this->session->set_flashdata('message', 'Session has been closed');
		redirect('login');
	}
	
}
	
?>