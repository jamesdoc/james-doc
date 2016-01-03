<?php

class login_model extends CI_model{
	
	function validate_login(){
		$this->db->where('userName', $this->input->post('username'));
		$this->db->where('userPass', md5($this->input->post('password')));
		
		$q = $this->db->get('author');
		
		if($q->num_rows==1){
			return true;
		}
	}
	
	function login_check(){
		$username = $this->session->userdata('username');
			
		if(!isset($username) || $username == ""){
			//echo 'not logged in';
			return false;	// not logged in
		} else {
			//echo 'logged in';
			return true;	// are logged in
		}
	}
	
}

// End login_model