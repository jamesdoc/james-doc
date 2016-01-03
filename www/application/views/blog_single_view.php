<header class="card card--post_banner">
    <a href="/">
        <img src="/assets/graphics/avatar.jpg" alt="James Doc avatar" />
        <h1>James Doc</h1>
    </a>
</header>

<article class="post card cat-<?=$blog_content[0]->page_category;?>">

    <div class="card__header post__header">
    	<h2><?=$blog_content[0]->page_title?></h2>

        <div class="post__meta">

            <span class="post__meta__date">
                Published:
                <time datetime="<?=date('Y-m-d H:i:s', strtotime($blog_content[0]->page_datetime)); ?> " pubdate>
                    <?=date('l jS F Y', strtotime($blog_content[0]->page_datetime)); ?>
                </time>
            </span>

            <span class="post__meta__cat">
                Category: <?=anchor('blog/category/' . $blog_content[0]->page_category, ucfirst($blog_content[0]->page_category));?>
            </span>
        </div>
    </div>

    <div class="card__body">

        <? if($blog_content[0]->page_header_image != null) : ?>
        <img src="<?=$blog_content[0]->page_header_image?>" alt="<?=$blog_content[0]->page_title?>" class="banner" />
        <? endif; ?>

        <?=$blog_content[0]->page_content?>

    </div>

</article>

<section class="card">
    <div class="card__header">
        <h2>Recent entries...</h2>
    </div>

    <div class="card__body">

        <ol>
        <? foreach ($recent_entries as $row) : ?>
            <li class="cat-<?=$row->page_category;?>">
                <p><?=anchor('blog/' . $row->page_url, $row->page_title);?></p>
            </li>
        <? endforeach; ?>
        </ol>

        <?=anchor('blog/archive/'.date('Y'), 'More posts...');?>

    </div>

</section>
