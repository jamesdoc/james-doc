<?php

class Blog_model extends CI_Model{

	function get_recent_entries($number){

		$date = date('Y-m-d H:i:s');

		$q = 'SELECT page_id, page_title, page_url, LEFT(page_content,250) AS page_excerpt, page_header_image, page_datetime, page_author FROM page WHERE page_type = "blog" AND page_datetime < "'.$date.'" ORDER BY page_datetime DESC LIMIT '.$number;
		$q = $this->db->query($q);

		if($q->num_rows() > 0){

			foreach ($q->result() as $row){
				$data[] = $row;
			}

			return $data;

		}

	}

	function get_blog_numrows($cat = null) {

		date_default_timezone_set('Europe/London');

		$this->db->where('page_type', 'blog');
		$this->db->where('page_status', 'published');
		$this->db->where('page_datetime <',date('Y-m-d H:i:s'));

		if($cat != null){
			$this->db->where('page_category',$cat);
		}

		return $this->db->get('page')->num_rows();
	}

	function get_blog_excerpt_list($per_page, $offset, $characters, $cat = null){

		date_default_timezone_set('Europe/London');

		$this->db->select('page_id, page_title, page_url, LEFT(page_content,' . $characters . ') AS page_excerpt, page_header_image, page_datetime, page_category',FALSE);
		$this->db->from('page');

		$this->db->where('page_type', 'blog');
		$this->db->where('page_status', 'published');
		$this->db->where('page_datetime <',date('Y-m-d H:i:s'));

		if($cat != null){
			$this->db->where('page_category',$cat);
		}

		$this->db->order_by('page_datetime','DESC');

		$this->db->limit($per_page,$offset);

		//$q = 'SELECT page_id, page_title, page_url, LEFT(page_content,'.$characters.') AS page_excerpt, page_header_image, page_datetime, page_author FROM page WHERE page_type="blog" AND page_status="published" AND page_datetime < "'.$date.'" ORDER BY page_datetime DESC LIMIT '.$offset.','.$per_page;
		$q = $this->db->get();


		if($q->num_rows() > 0){

			foreach ($q->result() as $row){
				$data[] = $row;
			}

			return $data;

		}
	}

	function get_archive($year){

		$this->db->select('page_title, page_url, page_datetime, page_category');
		$this->db->from('page');
		$this->db->where('page_type','blog');
		$this->db->where('page_status','published');
		$this->db->where("YEAR(page_datetime) = '".$year."'");

		$this->db->order_by('page_datetime','DESC');

		$q = $this->db->get();

		if($q->num_rows() > 0){

			foreach ($q->result() as $row){
				$data[] = $row;
			}

			return $data;

		}

	}

	function get_page($url){


		$this->db->where('page_url', $url);

		$q = $this->db->get('page');

		if($q->num_rows() > 0){

			foreach ($q->result() as $row){
				$data[] = $row;
			}

			return $data;

		}

	}

	function get_page_info($url=null, $id=null)
	{

		if($id!=NULL){$this->db->where('page_id',$id);}
		if($url!=NULL){$this->db->where('page_url',$url);}

		$this->db->select('page_id, page_url, page_title');

		$q = $this->db->get('page');

		if($q->num_rows() > 0){
			return $q->row();
		}
	}

	function insert_post(){

		$illegal_char = array('\'','\\','/','.',',','!','(',')','[',']','{','}','+','@','£','&','$','%','^','!',':',';','|','"','?','<','>','`','~','±','¤','=');

		$url = url_title(iconv("UTF-8", "ASCII//TRANSLIT",$this->input->post('post_title')),'dash',TRUE);

		// Schedule post
		if($this->input->post('post_schedule')!=null){ $datetime = date('Y-m-d H:i:s',strtotime($this->input->post('post_schedule'))); }
		else { $datetime = date('Y-m-d H:i:s'); }

		$status = 'published';

		$search  = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');
		$replace = array('>', '<', '\\1');
		$content = preg_replace($search, $replace, $this->input->post('post_content'));

		$data = array(
		   'page_title' => trim($this->input->post('post_title')),
		   'page_url' => $url,
		   'page_content' => $content,
		   'page_datetime' => $datetime,
		   'page_type' => 'blog',
		   'page_status' => $status,
		   'page_comments' => 'enabled',
		   'page_category' => $this->input->post('post_category')
		);

		// If banner image exists then add entry into db
		if($_FILES['post_header_image']['error'] != 4){$data['page_header_image'] = site_url('assets/uploads/banners/'.$url.'.'.substr($_FILES['post_header_image']['name'],-3));}

		$this->db->insert('page', $data);

		return $url;

	}

	function rss_get($count = 10){

		date_default_timezone_set('Europe/London');

		$this->db->select('page_id, page_title, page_url, page_content, page_header_image, page_datetime, page_category');
		$this->db->from('page');

		$this->db->where('page_type', 'blog');
		$this->db->where('page_status', 'published');
		$this->db->where('page_datetime <',date('Y-m-d H:i:s'));

		$this->db->order_by('page_datetime','DESC');

		$this->db->limit($count);

		$q = $this->db->get();


		if($q->num_rows() > 0){

			foreach ($q->result() as $row){
				$data[] = $row;
			}

			return $data;

		}

	}

	function rss_helper($last_date)
	{
		//SELECT * FROM page WHERE page_datetime >= '2011-05-28 13:27:37'

		$this->db->select('page_id');
		$this->db->where('page_datetime >= "'.$last_date.'"');

		return $q = $this->db->get('page')->num_rows();

	}
}

// end blog_model
