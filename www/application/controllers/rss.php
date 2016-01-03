<?php

	class RSS extends CI_Controller
	{
	
		function index(){
			$rss_filepath = "assets/rss.xml";
			
			$file = fopen($rss_filepath, 'r');		// Open file for read write (r+)
			
			header("Content-Type: application/xml; charset=ISO-8859-1"); 
			
			echo fread($file, filesize($rss_filepath));
			
			fclose($file);
		}
		
		function generate(){
			
			$this->load->model('blog_model');
			
			// Get latest entry in existing XML feed
			$rss_filepath = "assets/rss.xml";
			
			$file = fopen($rss_filepath, 'r');			// Open file for reading
			
			$current_data = fread($file, filesize($rss_filepath));
			$pieces = explode("\n",$current_data);
			
			$latest_pubdate = str_replace('		<pubDate>','',$pieces[12]);
			$latest_pubdate = str_replace('</pubDate>','',$latest_pubdate);
			
			fclose($file);
			unset($current_data);
			unset($pieces);
			
			$latest_pubdate = date('Y-m-d H:i:s',strtotime($latest_pubdate));
			
			// If returned value > than 1 then the RSS feed is out of date
			if ($this->blog_model->rss_helper($latest_pubdate)!=1)
			{
			
				$file = fopen($rss_filepath, 'w');		// Open file for overwrite (w)
				
				
				
				// If latest entry != to latest entry in the database then
				
					// Get last 20 entries in DB (Limit to 500 characters)
					
					$q = $this->blog_model->rss_get(20);
					
					// Overwrite current RSS feed
					$xml = '<?xml version="1.0" encoding="utf-8"?>'."\n";
					$xml.= '<?xml-stylesheet type="text/xsl" href="' . base_url() . 'assets/rss.xsl" media="screen"?>'."\n";
					$xml.= '<rss version="2.0" xmlns:creativeCommons="http://backend.userland.com/creativeCommonsRssModule">'."\n";
					$xml.= '<channel>'."\n";
					$xml.= "\t".'<title>' . $this->config->item('site_title') . '</title>'."\n";
					$xml.= "\t".'<link>' . base_url() . '</link>'."\n";
					$xml.= "\t".'<description>Blog feed for ' . $this->config->item('site_title') . ' - ' . $this->config->item('site_tagline') . '</description>'."\n";
					$xml.= "\t".'<language>en-gb</language>'."\n";
					$xml.= "\t".'<lastBuildDate>' . date('r') . '</lastBuildDate>'."\n";
					
					foreach ($q as $row){
						
						$this->load->helper('restore_tags');
						$excerpt = strip_tags($row->page_content,'<h1><h2>h3><h4><h5><h6><p><ul><ol><strike><del><li><em><strong><b><u><br><a><blockquote>');
						
						$search  = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');
						$replace = array('>', '<', '\\1');
						$excerpt = preg_replace($search, $replace, $excerpt);
						
						$xml.= "\n\t".'<item>'."\n";
						
						$xml.= "\t\t".'<title>' . $row->page_title . '</title>'."\n";
						$xml.= "\t\t".'<pubDate>' . date('r',strtotime($row->page_datetime)) . '</pubDate>'."\n";
						$xml.= "\t\t".'<link>' . base_url() . 'blog/' . $row->page_url . '</link>'."\n";
						$xml.= "\t\t".'<guid isPermaLink="true">' . base_url() . 'blog/' . $row->page_url . '</guid>'."\n";
						$xml.= "\t\t".'<comments>' . base_url() . 'blog/' . $row->page_url . '#comments</comments>'."\n";
						$xml.= "\t\t".'<description><![CDATA[ ';
						
						if($row->page_header_image != null)
						{
							$xml.='<p><img src="' . $row->page_header_image . '" alt="Banner image - ' . $row->page_title . '" width="100%" /></p>';
						}
						
						$xml.= $excerpt;
						
						$xml.= '<p>What are your thoughts? Share them at <a href="' . base_url() . 'blog/' . $row->page_url . '">'. base_url() .'</a></p>';
						
						$xml.= ' ]]></description>'."\n";
						$xml.= "\t".'</item>'."\n";
				
					}
					
					$xml.= '</channel>'."\n";
					$xml.= '</rss>';
					
					
					fwrite($file,$xml);
				
				
				fclose($file);
				
			
			
			}
			
			redirect('rss');
			
		}
	
	}

// End RSS