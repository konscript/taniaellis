<?php

function te_home_meta() {
  add_action('init', function() { remove_post_type_support('page', 'editor'); });
  
  $video_query = new WP_Query('post_type=te_video');
  if($video_query->have_posts()) {
    $videos[''] = '';
    while($video_query->have_posts()) {
      $video_query->the_post();
      $videos[get_the_ID()] = get_the_title();
    }
  }
  
  $header_prefix = 'te_home-header-text';
  
  $meta_boxes[] = array(
  	'id' => $header_prefix,
  	'title' => 'Header Text Options',
  	'pages' => array('page'),
  	'context' => 'normal',

  	'fields' => array(
  		array(
  			'name' => 'Title',
  			'id' => $header_prefix . '-title',
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
  		),
  		array(
  		  'name' => 'Header Vimeo',
  		  'id' => $header_prefix . '-video',
  		  'type' => 'select',
  		  'options' => $videos
  		)
  	)
  );
  
  $box_prefix = 'te_home-box-text';
  
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
  		)
  	)
  );

  foreach($meta_boxes as $meta_box) {
    $my_box = new RW_Meta_Box($meta_box);
  }
}

?>