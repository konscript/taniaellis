<?php

function te_blog_meta() {
  add_action('init', function() { remove_post_type_support('page', 'editor'); });
   
  $header_prefix = 'te_blog-header-text';
  
  $meta_boxes[] = array(
  	'id' => $header_prefix,
  	'title' => 'Header Text Options',
  	'pages' => array('page'),
  	'context' => 'normal',

  	'fields' => array(
  		array(
  			'name' => 'Title (first line)',
  			'id' => $header_prefix . '-titleA',
  			'type' => 'text',					
  		),
			array(
				'name' => 'Title (second line)',
				'id' => $header_prefix . '-titleB',
				'type' => 'text',					
			),
			array(
  			'name' => 'Title (right side)',
  			'id' => $header_prefix . '-title-right',
  			'type' => 'text',					
  		),
  		array(
  			'name' => 'Content',
  			'id' => $header_prefix . '-content',
  			'type' => 'textarea'
  		),
  		array(
  		  'name' => 'Link Address',
  		  'id' => $header_prefix . '-link-address',
  		  'type' => 'text',
  		  'desc' => 'Remember http://'
  		),
  		array(
  		  'name' => 'Link Text',
  		  'id' => $header_prefix . '-link-text',
  		  'type' => 'text',
  		)
  	)
  );
  
  $box_prefix = 'te_blog-box-text';
  
  $meta_boxes[] = array(
  	'id' => $box_prefix,
  	'title' => 'Box Text Options',
  	'pages' => array('page'),
  	'context' => 'normal',

  	'fields' => array(
  		array(
  			'name' => 'Title Line 1',
  			'id' => $box_prefix . '-title-line-1',
  			'type' => 'text',					
  		),
  		array(
  			'name' => 'Title Line 2',
  			'id' => $box_prefix . '-title-line-2',
  			'type' => 'text'
  		),
  		array(
  		  'name' => 'Content',
  		  'id' => $box_prefix . '-content',
  		  'type' => 'textarea',
  		),
  		array(
  		  'name' => 'Link Address',
  		  'id' => $box_prefix . '-link-address',
  		  'type' => 'text',
  		  'desc' => 'Remember http://'
  		),
  		array(
  		  'name' => 'Link Text',
  		  'id' => $box_prefix . '-link-text',
  		  'type' => 'text'
  		),
			array(
				'name'	=> 'Subscribe to blog on/off',
				'desc'	=> 'If subscribe to blog is on, the link set in "Link address" and "Link text" won\'t show',
				'id'		=> $box_prefix . '-subscribe',
				'type'	=> 'checkbox'
			),
			array(
				'name'	=> 'Subscription feed address',
				'desc'	=> 'The feed that that people sign up to when registering their e-mail. Should only be the feed slug',
				'id'		=> $box_prefix . '-subscription-address',
				'type'	=> 'text'
			),
  		array(
  		  'name' => 'Bonus Sticker On/Off',
  		  'id' => $box_prefix . '-bonus-sticker',
  		  'type' => 'checkbox'
  		),
  		array(
  		  'name'  => 'Bonus Sticker Image',
  		  'id'    => $box_prefix . '-bonus-sticker-image',
  		  'type'  => 'image'
  		)
  	)
  );

  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
}

?>