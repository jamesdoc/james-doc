<header class="card card--landingheader">
	<div class="card__header">
		<img src="/assets/graphics/avatar.jpg" alt="James Doc avatar" />
		<h1>James Doc</h1>
	</div>

	<div class="card__body">
		<ul class="social">
			<li class="social__icon social__icon--twitter"><a href="http://www.twitter.com/jamesdoc" target="_blank">Twitter</a></li>
			<li class="social__icon social__icon--instagram"><a href="http://www.instagram.com/thejamesdoc" target="_blank">Instagram</a></li>
			<li class="social__icon social__icon--lastfm"><a href="http://www.last.fm/user/jamesdoc" target="_blank">Last.fm</a></li>
		</ul>
	</div>
</header>

<section class="card">
	<div class="card__header">
		<h2>Who?</h2>
	</div>

	<div class="card__body">
		<p>Occasional blogger.</p>
		<p>Web Developer at the <a href="http://www.vam.ac.uk/" target="_blank">V&amp;A</a>.</p>
		<p>Studied Web Technologies at the <a href="http://lincoln.ac.uk" target="_blank">University of Lincoln</a>.</p>
		<p>Currently living in NW10.</p>
	</div>
</section>

<section class="card card--work">
	<div class="card__header">
		<h2>Work</h2>
	</div>

	<div class="card__body">

		<p>Full time employment:</p>
		<ul>
			<li>
				<h4><a href="http://www.vam.ac.uk/" target="_blank">Victoria and Albert Museum</a></h4>
				<small>2014 - present</small>
			</li>
			<li>
				<h4><a href="http://www.ifesworld.org" target="_blank">International Fellowship of Evangelical Students</a></h4>
				<small>2011 - 2014</small></li>
		</ul>

		<p>Freelance and side projects:</p>
		<ul>
			<li>
				<h4><a href="http://thriveteams.org" target="_blank">Thrive</a></h4>
				<small>2015 - present</small>
			</li>
		</ul>
	</div>
</section>

<section class="card card--words">
	<div class="card__header">
		<h2>Words</h2>
	</div>

	<div class="card__body">

		<ol>
		<? foreach ($recent_entries as $row) : ?>
			<li class="cat-<?=$row->page_category;?>">
				<h4><?=anchor('blog/' . $row->page_url, $row->page_title);?></h4>

				<small class="post__meta">
					<span class="post__meta__date">
		                Published:
		                <time datetime="<?=date('Y-m-d H:i:s', strtotime($row->page_datetime)); ?> " pubdate>
		                    <?=date('l jS F Y', strtotime($row->page_datetime)); ?>
		                </time>
		            </span>

		            <span class="post__meta__cat">
		                Category: <?=anchor('blog/category/' . $row->page_category, ucfirst($row->page_category));?>
		            </span>
	            </small>

			</li>
		<? endforeach; ?>
		</ol>

		<?=anchor('blog/archive/'.date('Y'), 'More posts...');?>

	</div>

</section>


