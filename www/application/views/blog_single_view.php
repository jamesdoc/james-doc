<article class="cat-<?=$blog_content[0]->page_category;?>">

	<h2><?=$blog_content[0]->page_title?></h2>

	<span class="cat"><?=anchor('blog/category/' . $blog_content[0]->page_category, $blog_content[0]->page_category);?></span>

	<time datetime="<?=date('Y-m-d H:i:s', strtotime($blog_content[0]->page_datetime)); ?> " pubdate class="pubdate">
		<?=date('l jS F Y', strtotime($blog_content[0]->page_datetime)); ?>
	</time>

	<? if($blog_content[0]->page_header_image != null) : ?>
	<img src="<?=$blog_content[0]->page_header_image?>" alt="<?=$blog_content[0]->page_title?>" class="banner" />
	<? endif; ?>

	<?=$blog_content[0]->page_content?>

</article>
