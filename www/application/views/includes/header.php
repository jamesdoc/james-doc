<?

	if(isset($title)){
		$title = $title . ' | ' . $this->config->item('site_title');
	} else {
		$title = $this->config->item('site_title');
	}

	if(!isset($desc)){
		$desc = 'Web Developer | Studied Web Technologies at the University of Lincoln | Currently living in London | Lover of tea | Tweeting @jamesdoc';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width" />

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
	<![endif]-->

	<link href="<?=site_url('assets/screen.css')?>" rel="stylesheet" media="screen" type="text/css">
	<link href="<?=site_url('rss')?>" rel="alternate" type="application/rss+xml" title="Blog RSS feed." />

	<title><?=$title?></title>
	<meta name="description" content="<?=$desc?>" />

	<meta itemprop="description" content="<?=$desc?>">


	<meta property="og:site_name" content="<?=$this->config->item('site_title');?>" />
	<meta property="og:title" content="<?=$title?>" />

	<meta property="og:url" content="<?=current_url()?>" />
	<meta property="og:type" content="website" />

	<link rel="author" href="https://plus.google.com/100482726574378941628/posts">

	<meta name="twitter:card" content="summary">
	<meta name="twitter:url" content="<?=current_url()?>">
	<meta name="twitter:title" content="<?=$title?>">
	<meta name="twitter:description" content="<?=$desc?>">
	<meta name="twitter:creator" content="@jamesdoc">

	<? if(isset($blog_content[0]->page_header_image)) : ?>
	<meta name="twitter:image" content="<?=$blog_content[0]->page_header_image?>">
	<meta property="og:image" content="<?=$blog_content[0]->page_header_image?>" />
	<? endif; ?>

</head>

<body>

	<section class="container">
