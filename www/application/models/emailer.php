<?php

class Emailer extends CI_Model
{
	
	function send_email($data)
	{
		$config = array(
			'protocol' => 'sendmail',
			'smtp_host' => 'mail.jamesdoc.com',
			'smtp_port' => 25,
			'smtp_user' => 'webserver@jamesdoc.com',
			'smtp_pass' => 'stargazer',
			'mailtype' => 'html'
		);
		
		$this->load->library('email',$config);
		
		$this->email->set_newline("/r/n");
		
		$this->email->from('webserver@jamesdoc.com','JamesDoc.com');
		$this->email->to($data['to']);
		$this->email->subject($data['subject']);
		$this->email->message($data['message']);
		
		if($this->email->send()){
			return;
		} else {
			show_error($this->email->print_debugger());
		}
	}
	
}