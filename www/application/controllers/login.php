<?php

class Login extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		
		$this->load->model('login_model');
		if ($this->login_model->login_check()==true){
			redirect('dashboard');
		}
	}
	
	function index(){
		
		$data['main_content'] = 'login_view';
		$data['message'] = $this->session->flashdata('message');
		$this->session->keep_flashdata('referrer');
		
		$this->load->view('includes/template',$data);
		
	}
	
	function validate(){
		
		$this->load->model('login_model');
		$q = $this->login_model->validate_login();
		
		if($q){	// Username and pass = correct
			$referrer = $this->session->flashdata('referrer');
			$data = array(
				'username' => $this->input->post('username')
			);
			
			$this->session->set_userdata($data);
			if($referrer!=null){
				//redirect($referrer);
				redirect($referrer);
			} else {
				redirect('dashboard');
			}
			
		} else {
			$this->session->set_flashdata('message', 'Username or password incorrect');
			redirect('login');
		}
	}
	
}