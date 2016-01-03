<?php

class Landing extends CI_Controller{

	function Landing() {
        parent::__construct();

        $this->load->model('blog_model');
    }

	function index(){
		// display list of blogs

		$data['recent_entries'] = $this->blog_model->get_blog_excerpt_list(5, 0, 250);

		$data['main_content'] = 'landing';

		$this->load->view('includes/template',$data);

	}
}

// End blog
