<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('social_sidebar'))
{

	function social_sidebar(){
		$CI =& get_instance();
    	$CI->load->model('social_model');
    	return $CI->social_model->sidebar_stream();
	}
	
	function get_instagram(){
		
		$CI =& get_instance();
		$CI->load->model('social_model');
		return $CI->social_model->instagram();
		
	}
	
}