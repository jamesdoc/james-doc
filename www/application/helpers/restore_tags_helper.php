<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('restore_tags'))
{
	function restore_tags($input)
	{
	$opened = array();
	
	// loop through opened and closed tags in order
	if(preg_match_all("/<(\/?[a-z]+)>?/i", $input, $matches)) {
	  foreach($matches[1] as $tag) {
		if(preg_match("/^[a-z]+$/i", $tag, $regs)) {
		  // a tag has been opened
		  if(strtolower($regs[0]) != 'br') $opened[] = $regs[0];
		} elseif(preg_match("/^\/([a-z]+)$/i", $tag, $regs)) {
		  // a tag has been closed
		  unset($opened[array_pop(array_keys($opened, $regs[1]))]);
		}
	  }
	}
	
	// close tags that are still open
	if($opened) {
	  $tagstoclose = array_reverse($opened);
	  foreach($tagstoclose as $tag) $input .= "</$tag>";
	}
	
	return $input;
	}
}

if ( ! function_exists('str_lreplace'))
{
	function str_lreplace($search, $replace, $subject)
	{
		$pos = strrpos($subject, $search);
	
		if($pos === false)
		{
			return $subject;
		}
		else
		{
			return substr_replace($subject, $replace, $pos, strlen($search));
		}
	}
}

if (!function_exists('link_tweets'))
{
 	function link_tweets($tweet)
	{
		$tweet= preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $tweet);
		$tweet= preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $tweet);
		$tweet= preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $tweet);
		$tweet= preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $tweet);
		return $tweet;
	}
}

?>