<?php

class Dashboard extends CI_Controller{
	
	function __construct(){
		parent::__construct();
        
        // Login check
        if($this->session->userdata('username')==null){
        	$this->session->set_flashdata('referrer','dashboard');
        	$this->session->set_flashdata('message','Please login to access the dashboard...');
        	redirect('login');
        }
    }
	
	function index(){
		
		$data['main_content'] = 'dashboard';
		
		$this->load->view('includes/template',$data);
		
	}
	
}

// End dashboard