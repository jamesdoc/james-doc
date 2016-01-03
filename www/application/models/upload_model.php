<?php

class Upload_model extends CI_Model{
	
	function upload_image($title){
		
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => realpath(APPPATH . '../assets/uploads/banners/'),
			'file_name' => $title
		);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload('post_header_image');
		
	}
	
}

// End upload_model