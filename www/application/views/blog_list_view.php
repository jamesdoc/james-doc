<header class="card card--post_banner">
    <a href="/">
        <img src="/assets/graphics/avatar.jpg" alt="James Doc avatar" />
        <h1>James Doc</h1>
    </a>
</header>

<? if (isset($title)) : ?>
	<div class="card">
		<div class="card__header">
			<h2 class="catHeading"><?=$title?></h2>
			<small><?=anchor('/blog','Back to all posts...');?></small>
		</div>
	</div>
<? endif; ?>

<? foreach ($recent_entries as $row) : ?>

	<article class="card post cat-<?=$row->page_category;?>">

		<div class="card__header post__header">
			<h3><?=anchor('blog/' . $row->page_url, $row->page_title);?></h3>

			<small>
				<span class="cat"><?=anchor('blog/category/' . $row->page_category, ucWords($row->page_category));?></span>

				<time datetime="<?=date('Y-m-d H:i:s', strtotime($row->page_datetime)); ?> " pubdate class="pubdate">
					<?=date('l jS F Y', strtotime($row->page_datetime)); ?>
				</time>
			</small>
		</div>

		<div class="card__body">

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
		</div>
	</article>

<? endforeach; ?>

<div class="card">
<? if($this->uri->segment(2) == 'category'): ?>
	<?=$this->pagination->create_links(); ?>
<? else : ?>
	<h3><?=anchor('blog/archive/'.date('Y'), 'Older posts');?></h3>
<? endif; ?>
</div>

