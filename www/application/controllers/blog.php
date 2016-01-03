<?php

class Blog extends CI_Controller{

	function Blog() {
        parent::__construct();

        $this->load->model('blog_model');
    }

	function _remap($method, $params = array()){

		if (method_exists($this, $method)) {

			return call_user_func_array(array($this, $method), $params);

		} else {

			$this->_getPost($method);

		}

	}

	function index(){
		// display list of blogs

		$this->load->library('pagination');


		$config['base_url'] = base_url().'blog/index/';
		$config['total_rows'] = $this->blog_model->get_blog_numrows();
		$config['per_page'] = 6;
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<div class="pagination print-hide">';
		$config['full_tag_close'] = '</div>';

		$this->pagination->initialize($config);

		if($this->uri->segment(3)==null){$offset = 0;} else {$offset = $this->uri->segment(3);}


		$data['recent_entries'] = $this->blog_model->get_blog_excerpt_list($config['per_page'], $offset, 250);
		$data['main_content'] = 'blog_list_view';

		$this->load->view('includes/template',$data);

	}

	// Legacy
	function show($url=null){

		if ($url == null) { redirect('blog'); }

		redirect('blog/' . $url);

	}

	function category($cat=null){

		if ($cat == null) { redirect('blog'); }

		$this->load->library('pagination');

		$config['base_url'] = base_url().'blog/category/' . $cat . '/';
		$config['total_rows'] = $this->blog_model->get_blog_numrows($cat);
		$config['per_page'] = 6;
		$config['num_links'] = 5;
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config);

		if($this->uri->segment(3)==null){$offset = 0;} else {$offset = $this->uri->segment(4);}


		$data['recent_entries'] = $this->blog_model->get_blog_excerpt_list($config['per_page'], $offset, 250, $cat);

		if ($data['recent_entries'] == null) { redirect('blog'); }

		$data['main_content'] = 'blog_list_view';
		$data['title'] = 'Category: ' . ucwords(str_replace('-', ' &amp; ', $cat));

		$this->load->view('includes/template',$data);

	}

	function archive($year = null) {

		if ($year == null || $year > date('Y')) { redirect('blog/archive/' . date('Y')); }

		$data['year'] 			= $year;
		$data['posts']			= $this->blog_model->get_archive($year);
		$data['main_content']	= 'blog_archive';
		$data['title']			= 'Archive: ' . $year;

		$this->load->view('includes/template',$data);


	}

	function create(){

		// Login check
        if($this->session->userdata('username')==null){
        	$this->session->set_flashdata('referrer','blog/create');
        	$this->session->set_flashdata('message','Please login to create a new post...');
        	redirect('login');
        }

		if($this->input->post('post_title')){

			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<p class="error">', '</p>');

			$this->form_validation->set_rules('post_title','title','trim|required');
			$this->form_validation->set_rules('post_schedule','schedule','trim');
			$this->form_validation->set_rules('post_content','content','trim|required');


			if($this->form_validation->run() == FALSE){

				// Return to form
				$data['main_content'] = 'blog_create';
				$this->load->view('includes/template',$data);

			} else {

				// Add blog post
				$url = $this->blog_model->insert_post();

				// Upload Image
				if($_FILES['post_header_image']['error'] != 4){
					$this->load->model('Upload_model');
					$this->Upload_model->upload_image($url);
				}

				// Redirect to blog page
				redirect('blog/show/'.$url);

			}


		} else{

			$data['main_content'] = 'blog_create';
			$this->load->view('includes/template',$data);

		}

	}

	function _getPost($url){

		$data['blog_content'] = $this->blog_model->get_page($url);

		if ($data['blog_content'] == null) { redirect('blog'); }

		$data['main_content'] = 'blog_single_view';

		$data['title'] = $data['blog_content'][0]->page_title;
		if (preg_match('%(<p[^>]*>.*?</p>)%i', $data['blog_content'][0]->page_content, $regs)) {
			$data['desc'] = trim(strip_tags($regs[1]));
		}

		$this->load->view('includes/template',$data);

	}

}

// End blog
