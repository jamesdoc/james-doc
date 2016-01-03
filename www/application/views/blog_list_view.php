<? if (isset($title)) : ?>

	<h2 class="catHeading"><?=$title?> <small>(<?=anchor('blog','Back to main page...');?>)</small></h2>

<? endif; ?>

<? foreach ($recent_entries as $row) : ?>
		
	<article class="cat-<?=$row->page_category;?>">
		<h3>
			<?=anchor('blog/' . $row->page_url, $row->page_title);?>
		</h3>
		
		<span class="cat"><?=anchor('blog/category/' . $row->page_category, $row->page_category);?></span>
		
		<time datetime="<?=date('Y-m-d H:i:s', strtotime($row->page_datetime)); ?>" class="pubdate">
			<?=date('jS F Y', strtotime($row->page_datetime)); ?>
		</time>
		
		<p>
		<?
			$excerpt = strip_tags($row->page_excerpt);
			$t = strrpos($excerpt, ' '); // Find last occurrence of the space
			echo substr($excerpt,0,$t) . '...';
		?>
		</p>
		
		<p>
			<?=anchor('blog/' . $row->page_url, 'Keep reading...');?>
		</p>
	</article>

<? endforeach; ?>

<? if($this->uri->segment(2) == 'category'): ?>
	<?=$this->pagination->create_links(); ?>
<? else : ?>
	<h3><?=anchor('blog/archive/'.date('Y'), 'Older posts');?></h3>
<? endif; ?>

