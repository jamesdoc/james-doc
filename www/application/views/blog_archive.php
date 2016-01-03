<header class="card card--post_banner">
    <a href="/">
        <img src="/assets/graphics/avatar.jpg" alt="James Doc avatar" />
        <h1>James Doc</h1>
    </a>
</header>

<section class="card card--archive">

	<? if (isset($title)) : ?>
		<div class="card__header">
			<h2 class="catHeading"><?=$title?> <small>(<?=anchor('blog','Back to all posts...');?>)</small></h2>
		</div>
	<? endif; ?>

	<? if (isset($posts)): ?>

		<ul>
		<? foreach ($posts as $row) : ?>
			<li class="cat-<?=$row->page_category?>">
				<h4><?=anchor('blog/' . $row->page_url, $row->page_title);?></h4>
				<small>
					<span class="cat"><?=anchor('blog/category/' . $row->page_category, ucWords($row->page_category));?></span>

					<time datetime="<?=date('Y-m-d H:i:s', strtotime($row->page_datetime)); ?> " pubdate class="pubdate">
						<?=date('l jS F Y', strtotime($row->page_datetime)); ?>
					</time>
				</small>
			</li>
		<? endforeach; ?>
		</ul>

		<div class="card__footer">
			<h3><?=anchor('blog/archive/'.($year-1),'Back a year');?> | <?=anchor('blog/archive/'.($year+1),'Forward a year');?></h3>
		</div>
	<? else : ?>

		<p>Looks like you've hit an empty year... try another?</p>

		<h3><?=anchor('blog/archive/'.($year-1),'Go to '.($year-1).' archive');?></h3>

	<? endif; ?>

</section>
