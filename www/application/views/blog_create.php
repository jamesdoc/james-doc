<div class="card">
	<div class="card__header">
		<h3>Write an Entry</h3>
	</div>

	<div class="card__body">

	<?php

		$this->load->helper('form');
		$this->load->helper('ckeditor');

		$ckeditor = array(
			'id'	=>	'post_content',
			'path'	=>	'assets/js/ckeditor',
			'config' => array(
					'width'		=>	'100%',
					'toolbar' 	=> 	array(	//Setting a custom toolbar
						array('Source'),
						array('Link'),
						array('Bold', 'Italic','Underline', 'Strike'),
						array('NumberedList','BulletedList','Blockquote'),
						array('Format','FontSize')
					)
				)
		);

		echo validation_errors();

		echo form_open_multipart('blog/create/','class="styled-form post-form"');
	?>

	<p>
	<?php
		echo form_label('Post Title', 'post_title');
		echo form_input('post_title',set_value('post_title'),'id="post_title" placeholder="Post Title"');
	?>
	</p>

	<p>
	<?php
		echo form_label('Post Banner', 'post_header_image');
		echo form_upload('post_header_image',set_value('post_header_image'),'id="post_header_image" placeholder="Post Banner Image"');
	?>
	</p>

	<p>
	<?php
		echo form_label('Post Category', 'post_category');
		$options = array(
			'personal'	=> 'Personal',
			'tech'		=> 'Tech',
			'quote'		=> 'Quote',
			'film-tv'	=> 'Film & TV',
			'reading'	=> 'Reading',
			'design'	=> 'Design',
			'music'		=> 'Music',
			'code'		=> 'Code',
			'misc'		=> 'Misc'
	    );
		echo form_dropdown('post_category', $options, 'personal', 'id="post_category"');
	?>
	</p>

	<p>
	<?php
		echo form_label('Schedule Post', 'post_schedule');
		echo form_input('post_schedule',set_value('post_schedule'),'id="post_schedule" placeholder="'.date('Y-m-d H:i:s').' (If left empty will be published now)"');
	?>
	</p>
	<p>
	<?php
		echo form_label('Post Content', 'post_content', $attrib=array('class'=>'post_content'));
		echo form_textarea('post_content',set_value('post_content'),'id="post_content"');
		echo display_ckeditor($ckeditor);
	?>
	</p>


	<p>
	<?php
		echo form_submit('post_submit','Post it!','class="btn"');
	?>
	</p>


	<?php

		echo form_close();

	?>

	</div>
</div>
